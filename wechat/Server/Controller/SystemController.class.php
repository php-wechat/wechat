<?php
namespace Server\Controller;
use Think\Controller;
class SystemController extends BaseController {

    public function index()
    {
        $top_menu_info = M('top_menu')->order(array('order'=>'asc'))->select();
        $this->assign('top_nume_info',$top_menu_info);
        $this->display();
    }

    public function menu()
    {
        if(isset($_GET['nav_id']))
        {
            $nav_id = $_GET['nav_id'];
        }else{
            $nav_id = 1;
        }

        $this->assign('nav_id',$nav_id);
        $this->display();
    }

    public function main()
    {
        $this->display();
    }

    public function set()
    {
        $this->display();
    }
}
