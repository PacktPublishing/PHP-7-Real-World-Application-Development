<%
date_default_timezone_set('Europe/Berlin');
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    // some code
}
$old_error_handler = set_error_handler("myErrorHandler");

$php5  = 'Works in PHP 5';
$foo   = ['bar' => ['baz' => 'php5']];
echo $$foo['bar']['baz'];
echo PHP_EOL;

list() = $a;

echo '\u{xxx} has a special meaning in PHP 7';
echo PHP_EOL;

var_dump(1 << -1);
echo PHP_EOL;
var_dump(1 >> 65);
echo PHP_EOL;

$now = new DateTime();
call_user_method_array('setDate', $now, array(2016, 11, 11));
call_user_method_array('setTime', $now, array(11, 11, 11));
echo call_user_method('format', $now, 'Y-m-d H:i:s');
echo PHP_EOL;

$ids = 'Alice = 1, Dick = 33, Jane = 102, Fred = 88';
echo preg_replace('/([0-9]{1,3})/e','sprintf("%03d",$1)',$ids);
echo PHP_EOL;

%>
