<?php
// autoload classes as needed
namespace Application\Autoload;

class Loader
{
    const UNABLE_TO_LOAD = 'Unable to load class';
    // array of directories
    protected static $dirs = array();
    protected static $registered = 0;
    public function __construct(array $dirs = array())
    {
        self::init($dirs);
    }
    public static function addDirs($dirs)
    {
        if (is_array($dirs)) {
            self::$dirs = array_merge(self::$dirs, $dirs);
        } else {
            self::$dirs[] = $dirs;
        }
    }
    /**
     * Adds a directory to the list of supported directories
     * Also registers "autoload" as an autoloading method
     * 
     * @param array | string $dirs
     */
    public static function init($dirs = array())
    {
        if ($dirs) {
            self::addDirs($dirs);
        }
        if (self::$registered == 0) {
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$registered++;
        }
    }
    public static function autoLoad($class)
    {
        $success = FALSE;
        $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        foreach (self::$dirs as $start) {
            $file = $start . DIRECTORY_SEPARATOR . $fn;
            if (self::loadFile($file)) {
                $success = TRUE;
                break;
            }
        }
        if (!$success) {
            if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR . $fn)) {
                throw new \Exception(self::UNABLE_TO_LOAD . ' ' . $class);
            }
        }
        return $success;
    }
    protected static function loadFile($file)
    {
        if (file_exists($file)) {
            require_once $file;
            return TRUE;
        }
        return FALSE;
    }
}
    
