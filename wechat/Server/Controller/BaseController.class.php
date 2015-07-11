<?php
namespace Server\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize(){

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
            $jumpUrl = ' ';
        }

        $this->assign('message',$msg);
        $this->assign('jumpUrl',$jumpUrl);
        $this->assign('waitSecond',$timeout);
        $this->display('Common/success');
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
            $jumpUrl = ' ';
        }
        $this->assign('error',$msg);
        $this->assign('jumpUrl',$jumpUrl);
        $this->assign('waitSecond',$timeout);
        $this->display('Common/error');
    }

}
