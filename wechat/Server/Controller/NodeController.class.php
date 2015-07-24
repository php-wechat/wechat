<?php
namespace Server\Controller;
use Think\Controller;
class NodeController extends Controller {

   public function index()
   {
	    $this->display();
   }

    public function add()
    {
        $top_menu = M('top_menu')->field('id,menu_name')->select();
        $this->assign('top_menu',$top_menu);
        $this->display();
    }

    public function edit()
    {
        $this->display();
    }

    public function set()
    {
        $this->display();
    }
}
