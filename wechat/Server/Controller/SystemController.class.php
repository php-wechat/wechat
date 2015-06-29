<?php
namespace Server\Controller;
use Think\Controller;
class SystemController extends Controller {

   public function index()
   {
	$this->display();
   }

    public function menu()
    {
        $this->display();
    }

    public function main()
    {
        $this->display();
    }
}
