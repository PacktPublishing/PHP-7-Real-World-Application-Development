<?php
// php 7 to php 5 code conversion class
namespace Application\Parse;

use Exception;

/*
 * This class contains methods to convert PHP 5 syntax to PHP 7
 * 
 * NOTE: for the most part PHP 5 code will run untouched under PHP 7
 *       There are a number of compatibility breaks documented here:
 *       http://php.net/manual/en/migration70.incompatible.php
 * 
 * WARNING: assumes all params for a function are on a single line!!!
 *          If that is not the case, to use this, either modify the patterns
 *          to account for \n between the params, or remove all \n and replace with /* \n */
 /*
 * 
 */

class Convert
{
    
    const EXCEPTION_FILE_NOT_EXISTS = 'File does not exist';

    /**
     * Scans $filename
     * 
     * Rewrites code when possible
     * Otherwise adds "// WARNING: xxx" before offending lines
     * 
     * @param string $filename
     * @return string $contents with re-writes + warning comments
     */
    public function scan($filename)
    {
        if (!file_exists($filename)) {
            throw new Exception(self::EXCEPTION_FILE_NOT_EXISTS);
        }
        
        // pull contents of file into an array
        $contents = file($filename);
        echo 'Processing: ' . $filename . PHP_EOL;
        
        // new function added in PHP 7
        $result = preg_replace_callback_array(
            [
            
                // NOTE: using '!' for delimiters
                // replace no-longer-supported opening tags
                '!^\<\%(\n| )!' =>
                    function ($match) {
                        return '<?php' . $match[1];
                    },
                
                // replace no-longer-supported opening tags
                '!^\<\%=(\n| )!' =>
                    function ($match) {
                        return '<?php echo ' . $match[1];
                    },
                
                // replace no-longer-supported closing tag
                '!\%\>!' =>
                    function ($match) {
                        return '?>';
                    },
                
                // adds warning about changes in how $$xxx interpretation is handled
                '!(.*?)\$\$!' =>
                    function ($match) {
                        return '// WARNING: variable interpolation now occurs left-to-right' . PHP_EOL
                               . '// see: http://php.net/manual/en/migration70.incompatible.php' . PHP_EOL
                               . $match[0];
                    },
                
                // adds warning about changes in how the list() operator is handled
                '!(.*?)list(\s*?)?\(!' =>
                    function ($match) {
                        return '// WARNING: changes have been made in how the list() operator is handled' . PHP_EOL
                               . '// see: http://php.net/manual/en/migration70.incompatible.php' . PHP_EOL
                               . $match[0];
                    },

                // adds warnings in front of instances of \u{
                '!(.*?)\\\u\{!' =>
                function ($match) {
                    return '// WARNING: \\u{xxx} is now considered unicode escape syntax' . PHP_EOL
                           . '// see: http://php.net/manual/en/migration70.new-features.php#migration70.new-features.unicode-codepoint-escape-syntax' . PHP_EOL
                           . $match[0];
                },
                
                // adds warning about relying upon set_error_handler()
                '!(.*?)set_error_handler(\s*?)?.*\(!' =>
                    function ($match) {
                        return '// WARNING: might not catch all errors' . PHP_EOL
                               . '// see: http://php.net/manual/en/language.errors.php7.php' . PHP_EOL
                               . $match[0];
                    },
                
                // adds warning about session_set_save_handler(xxx)
                // 1                 2        3
                '!(.*?)session_set_save_handler(\s*?)?\((.*?)\)!' =>
                    function ($match) {
                        if (isset($match[3])) {
                            return '// WARNING: a bug introduced in PHP 5.4 which affects the handler assigned by '
                                   . '// session_set_save_handler() and where ignore_user_abort() is TRUE has been fixed in PHP 7.' . PHP_EOL
                                   . '// This could potentially break your code under certain circumstances.' . PHP_EOL
                                   . '// see: http://php.net/manual/en/migration70.incompatible.php' . PHP_EOL
                                   . $match[0];
                        } else {
                            return $match[0];
                        }
                    },

                // wraps bit shift operations in try / catch
                //  1    2                          3
                '!^(.*?)(\d+\s*(\<\<|\>\>)\s*-?\d+)(.*?)$!' =>
                    function ($match) {
                        return '// WARNING: negative and out-of-range bitwise shift operations will now throw an ArithmeticError' . PHP_EOL
                               . '// see: http://php.net/manual/en/migration70.incompatible.php' . PHP_EOL
                               . 'try {' . PHP_EOL
                               . "\t" . $match[0] . PHP_EOL
                               . '} catch (\\ArithmeticError $e) {' . PHP_EOL
                               . "\t" . 'error_log("File:" . $e->getFile() . " Line:" . $e->getLine() . " Message:" . $e->getMessage());' . PHP_EOL
                               . '}' . PHP_EOL;
                    },
                
                // replaces "call_user_method()" with "call_user_func()"
                //                   1     2    3
                '!call_user_method\((.*?),(.*?)(,.*?)\)(\b|;)!' =>
                    function ($match) {
                        $params = $match[3] ?? '';
                        return '// WARNING: call_user_method() has been removed from PHP 7' . PHP_EOL
                               . 'call_user_func(['. trim($match[2]) . ',' . trim($match[1]) . ']' . $params . ');';
                    },
                
                // replaces "call_user_method_array()" with "call_user_func_array()"
                //                         1     2     3
                '!call_user_method_array\((.*?),(.*?),(.*?)\)(\b|;)!' =>
                    function ($match) {
                        return '// WARNING: call_user_method_array() has been removed from PHP 7' . PHP_EOL
                               . 'call_user_func_array([' . trim($match[2]) . ',' . trim($match[1]) . '], ' . $match[3] . ');';
                    },
                
                // replace any references to PCRE "e" modifier
                // example (from old version of phpLDAPAdmin)
                // PHP 5: preg_replace('/[0-9]{1,3}/e','sprintf("%03d",$1)',$ids)
                // PHP 7: preg_replace('/[0-9]{1,3}/', function ($m) { return sprintf("%03d",$m); },$ids)

                //  1                     2
                '!^(.*?)preg_replace.*?/e(.*?)$!' =>
                    function ($match) {
                        $last = strrchr($match[2], ',');
                        $arg2 = substr($match[2], 2, -1 * (strlen($last)));
                        $arg1 = substr($match[0], strlen($match[1]) + 12, -1 * (strlen($arg2) + strlen($last)));
                        $arg1 = trim($arg1, '(');
                        $arg1 = str_replace('/e', '/', $arg1);
                        return '// WARNING: preg_replace() "/e" modifier has been removed from PHP 7' . PHP_EOL
                                . $match[1]
                                . 'preg_replace_callback('
                                . $arg1
                                . 'function ($m) { return ' . str_replace(['$1','\\1'], '$m') . trim($arg2, '"\'') . '; }, '
                                . trim($last, ',');
                    },
                
                // add any additional transformations here in this form:
                // '!Any PCRE regex!' => function ($match) { return <replacement>; },
                
            ],
            $contents
        );
        return implode('', $result);
    }

}
