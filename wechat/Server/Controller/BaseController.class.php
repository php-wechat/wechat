<?php
namespace Server\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize(){

        $login = session('isLogin');
        $symbol = cookie('symbol');
        if(!isset($symbol))
        {
             if(!isset($login))
             {
                 //die('还没登陆！');
                 $this->error('请先登陆',U('Admin/index'));
                 die();
             }
        }else{
            //如果有cookie，这时候登陆进来后，设置本次session
            $admin = D('root_admin');
            $id = cookie(C('ROOT_ADMIN_ID'));
            $data = $admin->find($id);
            session('admin',$data);
        }

    }


    /**
     * @content 当路径是空时，默认返回上一页
     * @param string $msg
     * @param string $jumpUrl
     * @param int $timeout
     * @demo 调用方式 success('成功',U('Index/login'),3) 或者 success('成功',3) 或则 success('成功')
     */
    public function success($msg='操作成功',$jumpUrl='',$timeout=1)
    {
        if(is_integer($jumpUrl))
        {
            $timeout = $jumpUrl;
            $jumpUrl = '';
        }

        $this->assign('message',$msg);
        $this->assign('jumpUrl',$jumpUrl);
        $this->assign('waitSecond',$timeout);
        $this->display('Common/success');
        die();
    }

    /**
     * @param string $msg
     * @param string $jumpUrl
     * @param int $timeout
     * @demo 调用方式 error('失败',U('Index/login'),3) 或者 error('失败',3) 或则 error('成功')
     */
    public function error($msg='操作失败',$jumpUrl='',$timeout=2)
    {
        if(is_integer($jumpUrl))
        {
            $timeout = $jumpUrl;
            $jumpUrl = '';
        }
        $this->assign('error',$msg);
        $this->assign('jumpUrl',$jumpUrl);
        $this->assign('waitSecond',$timeout);
        $this->display('Common/error');
        die();
    }

}
