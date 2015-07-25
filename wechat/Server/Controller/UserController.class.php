<?php
namespace Server\Controller;
use Think\Controller;
class UserController extends BaseController {

   public function index()
   {
     $data = M('root_admin')->select();
     $roleArr = M('root_role')->select();
     $role = array();
     foreach($roleArr as $row)
     {
         $role[$row['role_id']] = $row['role_name'];
     }
	 $this->assign('role',$role);
	 $this->assign('data',$data);
	 $this->display();
   }

    public function add()
    {
        $role = M('root_role')->select();
        $this->assign('role',$role);
        $this->display();
    }

    public function doAdd()
    {
        if($_POST['pwd'] != $_POST['repwd'])
        {
            $this->error('对不起，两次密码不一致！');
        }
        unset($_POST['repwd']);
        $_POST['pwd'] = I('post.pwd', '', 'mypwd');
        $_POST['ip'] = get_client_ip();
        $_POST['last_time'] = $_POST['this_time'] = time();

        $res = M('root_admin')->add($_POST);
        if($res)
        {
            $this->success('添加成功！',U('User/index'));
        }else{
            $this->error('添加失败！');
        }
    }

    public function edit()
    {
        $role = M('root_role')->select();
        $user=M('root_admin')->find(I('get.id'));
        $this->assign('role',$role);
        $this->assign('user',$user);
        $this->display();
    }

    public function update()
    {
        $wh ="id=".$_POST['id'];
        unset($_POST['id']);
        $res = M('root_admin')->where($wh)->save($_POST);
        if($res)
        {
            $this->success('修改成功！',U('User/index'));
        }else{
            $this->error('修改失败！');
        }
    }


}
