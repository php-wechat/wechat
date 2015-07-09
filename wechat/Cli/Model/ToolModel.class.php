<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 15-7-9
 * Time: 下午11:11
 */
namespace Cli\Model;

use Think\Model;
use Think\WechatAuth;
//常用工具模块
class ToolModel extends Model{


    // 接收的数据进行存储
    public function receive_data($data){
        M('wx_log_'.$data['MsgType'])->add($data);
    }


    /**
     * @content 获取token
     * @return mixed
     * @throws \Exception
     */
    private function getToken(){
        $weixin=new WechatAuth(C('appid'),C('appsecret'));
        $config   =  M('wx_sys_config')->where(array('appid'=>C('appid'),'appsecret'=> C('appsecret')))->order('id desc')->find();
        if (is_null($config) || $config['over_time']<time()) {
            $data['appid']=C('appid');
            $data['appsecret']=C('appsecret');
            $data['update_time']    =   time();
            $data['over_time']     	=   $data['update_time'] + 7200;
            $data['access_token']   =   $weixin->getAccessToken()['access_token'];
            $add=M('wx_sys_config')->add($data);
            if ($add) {
                $access_token      =    $data['access_token'];
            }else{
                throw new \Exception('保存access失败！请手动保存'.$data['access_token']);
            }
        }else{
            $access_token    =    $config['access_token'] ;
        }
        return $access_token;
    }


    /*************以下进行逻辑处理后，可进行对应回复*******************/

    public function  reply_text($data){
        $response['content']=$data['Content'];
        $response['type']='text';
        return $response;
    }

    public function  reply_image($data){
        $response['content']='这是一张图片';
        $response['type']='text';
        return $response;
    }

    public function  reply_voice($data){
        $response['content']=$data['MediaId'];
        $response['type']='voice';
        return $response;
    }

    public function  reply_video($data){
        $response['content']='12312313';
        $response['type']='text';
        return $response;
    }

    public function  reply_location($data){
        $response['content']='12312313';
        $response['type']='text';
        return $response;
    }

    public function  reply_link($data){
        $response['content']='12312313';
        $response['type']='text';
        return $response;
    }

    public function  reply_event($data){
        $response['content']='12312313';
        $response['type']='text';
        return $response;
    }




}



 ?>