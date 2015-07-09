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
