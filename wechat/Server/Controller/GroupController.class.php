<?php
namespace Server\Controller;
use Think\Controller;
class GroupController extends BaseController {

   public function index()
   {
       $data = M('root_role')->select();
       $this->assign('data',$data);
	  $this->display();
   }

    public function add()
    {
        $this->display();
    }

    public function doAdd()
    {
        $res = M('root_role')->add($_POST);
        if($res)
        {
            $this->success('添加成功！',U('Group/index'));
        }else{
            $this->error('添加失败');
        }
    }

    public function edit()
    {
        $this->display();
    }

    //设置权限
    public function roleSet()
    {
        die('设置权限');
        $this->display();
    }
}
