<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 15-7-10
 * Time: 下午2:55
 */
namespace Think;


class LogTool
{

    public function __construct(){
        if(!class_exists('Seaslog')){
            throw new \Exception('SeasLog没有开启');
        }
        //SeaaLog::BasePath();
    }


    public function error($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::error($message, $content, $module);
        } else {
            SeasLog::error($message, $content);
        }
    }


    public function debug($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::debug($message, $content, $module);
        } else {
            SeasLog::debug($message, $content);
        }
    }


    public function info($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::info($message, $content, $module);
        } else {
            SeasLog::info($message, $content);
        }
    }


    public function warning($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::warning($message, $content, $module);
        } else {
            SeasLog::warning($message, $content);
        }
    }

    public function critical($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::critical($message, $content, $module);
        } else {
            SeasLog::critical($message, $content);
        }
    }

    public function alert($message,array $content = array(),$module = '')
    {

        if ($module != '') {
            SeasLog::alert($message, $content, $module);
        } else {
            SeasLog::alert($message, $content);
        }

    }

    public function emergency($message,array $content = array(),$module = '')
    {
        if ($module != '') {
            SeasLog::emergency($message, $content, $module);
        } else {
            SeasLog::emergency($message, $content);
        }
    }


    /**
     * 通用日志方法
     * @param $level
     * @param $message
     * @param array $content
     * @param string $module
     */
    public function log($level,$message,array $content = array(),$module = '')
    {
        if ($module) {
            SeasLog::$level($message, $content, $module);
        } else {
            SeasLog::$level($message, $content);
        }
    }
}