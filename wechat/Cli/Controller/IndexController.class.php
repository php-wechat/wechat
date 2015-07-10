<?php
namespace Cli\Controller;
use Think\Controller;
use Think\WechatAuth;
use Think\Wechat;
class IndexController extends Controller {

    private $weixin     =   null;
    private $weixinTool     =   null;

    public function __construct(){

        $this->weixinTool = D('WeixinTool','Service');

        $this->weixin   =  new WechatAuth(C('appid'),C('appsecret'),$this->weixinTool->getToken());
    }

    public function index(){

        $wechat = new Wechat(C('token'));
        //获取客户端数据
        $data = $wechat->request();

        if($data && is_array($data)){

            // 客户传来的数据进行保存
            $this->weixinTool->receive_data($data);

            switch ($data['MsgType']) {
                case 'text':
                    $response = $this->weixinTool->reply_text($data);
                    break;

                case 'image':
                    $response = $this->weixinTool->reply_image($data);
                    break;

                case 'voice':
                    $response = $this->weixinTool->reply_voice($data);
                    break;

                case 'video':
                    $response = $this->weixinTool->reply_video($data);
                    break;

                case 'location':
                    $response = $this->weixinTool->reply_location($data);
                    break;
                case 'link':
                    $response = $this->weixinTool->reply_link($data);
                    break;
                case 'event':
                    $response = $this->weixinTool->reply_event($data);
                    break;
            }

            $content = $response['content'];
            $type    = $response['type'];
            $wechat->response($content, $type);
        }

    }


}





