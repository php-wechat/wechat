<?php

/**
 * 方便打印，直接pp($arr1,$arr2,$arr3) 可以分别打印出三个或则多个数组、对象等
 */
function pp()
{
    $arr = func_get_args();
    echo '<pre>';
    foreach($arr as $val){
        print_r($val);
        echo '</pre>';
        echo '<pre>';
    }
    echo '</pre>';
    die();
}


/**
 * @content socketLog函数
 * @param $log
 * @param string $type
 * @param string $css
 * @return mixed|void
 * @throws Exception
 */
function slog($log,$type='log',$css='')
{

    if(is_string($type))
    {
        $socket = \Think\SocketLog::getInstance();

        $type=preg_replace_callback('/_([a-zA-Z])/',create_function('$matches', 'return strtoupper($matches[1]);'),$type);
        if(method_exists($socket,$type) || in_array($type,\Think\SocketLog::$log_types))
        {
            return  call_user_func(array($socket,$type),$log,$css);
        }
    }
    if(is_object($type) && 'mysqli'==get_class($type))
    {
        return \Think\SocketLog::mysqlilog($log,$type);
    }
    if(is_resource($type) && ('mysql link'==get_resource_type($type) || 'mysql link persistent'==get_resource_type($type)))
    {
        return \Think\SocketLog::mysqllog($log,$type);
    }
    if(is_object($type) && 'PDO'==get_class($type))
    {
        return \Think\SocketLog::pdolog($log,$type);
    }
    throw new Exception($type.' is not SocketLog method');
}