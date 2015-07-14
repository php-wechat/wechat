<?php
namespace Server\Controller;
use Think\Controller;
use Think\WechatAuth;
class IndexController extends Controller {

   public function index(){
       echo \Think\LogTool::getlogPath();
        \Think\LogTool::error('a bug',array(),'Login/index');
	    //$this->display();
   }
    //用户管理
    public function uers(){
        $userarray=array('event','image','link','location','text','video','voice');
        foreach ( $userarray as  $v ) {
          $user[$v]= M('wx_log_'.$v)->group('fromusername')->select();
        }

        $this->assign('user',$user);

        $this->display();
    }

    public function sendmsg(){
        $postData=I('post.');

        $wechatAuth = new WechatAuth(C('WX_APPID'),C('WX_APPSECRET'),$this->get_token());

        $wechatAuth->sendText($postData['toid'],$postData['content']);
        echo "{'status':200}";
    }

    public function menu(){
        $str='{
    "button": [
        {
            "name": "扫码",
            "sub_button": [
                {
                    "type": "scancode_waitmsg",
                    "name": "扫码带提示",
                    "key": "rselfmenu_0_0",
                    "sub_button": [ ]
                },
                {
                    "type": "scancode_push",
                    "name": "扫码推事件",
                    "key": "rselfmenu_0_1",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                   "sub_button": [ ]
                 },
                {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_weixin",
                    "name": "微信相册发图",
                    "key": "rselfmenu_1_2",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发送位置",
            "type": "location_select",
            "key": "rselfmenu_2_0"
        },
        {
           "type": "media_id",
           "name": "图片",
           "media_id": "MEDIA_ID1"
        },
        {
           "type": "view_limited",
           "name": "图文消息",
           "media_id": "MEDIA_ID2"
        }
    ]
}';
        $array=json_decode($str,true);
        echo "<pre>";
         var_dump($array);
        echo "</pre>";

    }


    private function get_token(){
        $weixin=new WechatAuth(C('WX_APPID'),C('WX_APPSECRET'));
        $config   =  M('wx_sys_config')->where(array('appid'=>C('WX_APPID'),'appsecret'=> C('WX_APPSECRET')))->order('id desc')->find();
        if (is_null($config) || $config['over_time']<time()) {
            $data['appid']=C('WX_APPID');
            $data['appsecret']=C('WX_APPSECRET');
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
}
