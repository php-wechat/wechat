<?php
namespace Server\Controller;
use Think\Controller;
class SiteController extends BaseController {

   public function index()
   {
     $this->assign('is_on','site');
	 $this->display();
   }

    public function alipay()
    {
        $this->assign('is_on','alipay');
        $this->display();
    }

    public function email()
    {
        $this->assign('is_on','email');
        $this->display();
    }

    public function common()
    {
        $this->display();
    }

    public function weixin()
    {
        $this->assign('is_on','weixin');
        $this->display();
    }

    public function upfile()
    {
        $this->assign('is_on','upfile');
        $this->display();
    }


    public function update()
    {
        $file = I('get.act').'.php';
        $res = $this->update_config($_POST,SERVER_CONFIG.$file);
        if($res['status'] == 'ok'){
            die('操作成功');
//            $this->success('操作成功',U('Site/index'));
        }else{
            die($res['msg']);
//            $this->error('操作失败',U('Site/index'));
        }
    }

    public function update_config($paramsArr, $config_file)
    {
        if(!is_file($config_file)){
            return array('status' => 'error', 'msg' => '没有此配置文件');
        }
        if (is_writable($config_file)) {
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($paramsArr, true)) . ";", LOCK_EX);
            return array('status' => 'ok', 'msg' => '修改成功！');
        } else {
            return array('status' => 'error', 'msg' => $config_file.'配置文件不可写入！');
        }
    }
}
