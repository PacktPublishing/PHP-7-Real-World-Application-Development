<?php
// developing functions library

// it's a best practice to place all functions definitions at the top of the file
// any procedural code should go at the end

// single mandatory param
function someName($parameter)
{
     $result = 'INIT';
    // one or more statements which do something
    // to affect $result
    $result .= ' and also ' . $parameter;
    return $result; 
}

// two params: one mandatory the other optional
function someOtherName ($requiredParam, $optionalParam = NULL)
{ 
    $result = 0;
    $result += $requiredParam;
    $result += $optionalParam ?? 0;
    return $result; 
}

// infinite number of params
function someInfinite(...$params)
{
    // any params passed go into an array $params
    return var_export($params, TRUE);
}

// recursion
function someDirScan($dir)
{
    // uses "static" to retain value of $list
    static $list = array();
    // get a list of files and directories for this path
    $scan = glob($dir . DIRECTORY_SEPARATOR . '*');
    // loop through
    foreach ($scan as $item) {
        if (is_dir($item)) {
            $list[] = $item;
            someDirScan($item);
        } else {
            $list[] = $item;            
        }
    }
    return $list;
}
