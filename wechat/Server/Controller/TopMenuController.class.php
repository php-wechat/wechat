<?php
namespace Server\Controller;
use Think\Controller;
class TopMenuController extends BaseController {

   public function index()
   {
        $list = M('top_menu')->order(array('order'=>'asc'))->select();
	    $this->assign('list',$list);
	    $this->display();
   }

    public function add()
    {
        if(IS_POST)
        {
            if(M('top_menu')->add($_POST))
            {
                $this->success('添加成功！',U('TopMenu/index'));
            }else{
                $this->error('添加失败！');
            }
        }else{
            $this->display();
        }

    }

    public function edit()
    {

        if(IS_POST)
        {
            $id = $_POST['id'];
            unset($_POST['id']);
            if(M('top_menu')->where("id={$id}")->save($_POST))
            {
                $this->success('修改成功！',U('TopMenu/index'));
            }else{
                $this->error('修改失败！');
            }
        }else{
            $menu = M('top_menu')->find($_GET['id']);
            $this->assign('menu',$menu);
            $this->display();
        }

    }

    public function order()
    {

        $menu = M('top_menu');
       foreach($_POST['id'] as $key => $id)
       {
            $menu->where("id={$id}")->save(array('order',$_POST['order'][$key]));
       }
       $this->success('排序成功！',U('TopMenu/index'));
    }

    public function del()
    {
        if(M('top_menu')->delete($_GET['id']))
        {
            $this->success('删除成功！',U('TopMenu/index'));
        }else{
            $this->success('删除失败！',U('TopMenu/index'));
        }
    }
}
