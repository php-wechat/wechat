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
        $top_menu = M('top_menu')->field('id,menu_name')->select();
        $cat = M('sys_class')->order(array('top_menu_id'=>'asc','path'=>'asc'))
                ->field('id,name,top_menu_id,level,pid')->select();

        $data = array();
        foreach($top_menu as $menu_arr)
        {
            $top_menu_id = $menu_arr['id'];
            $data[$top_menu_id]['menu_name'] = $menu_arr['menu_name'];
            $data[$top_menu_id]['top_menu_id'] = $top_menu_id;

            foreach($cat as &$cat_arr)
            {
                //根据level设置层次关系 间隔
                if($cat_arr['level'] == 1)
                {
                    $cat_arr['jiange'] = '';
                }else{
                    $cat_arr['jiange'] = str_repeat('|---', $cat_arr['level']-1);
                }

                if($cat_arr['top_menu_id'] == $top_menu_id)
                {
                    if($cat_arr['pid'] == 0)
                    {
                        $data[$top_menu_id]['hasSon'][] = $cat_arr;
                    }
                }
            }
        }

        //重新组合一个数组去除pid为0的
        $new_cat = array();
        foreach($cat as $row)
        {
             if($row['pid'] != 0)
                 $new_cat[$row['pid']][] = $row;
        }

//        pp($new_cat);
        //再把它的孩子加进data数组中去
        foreach($data as &$row_arr)
        {
            if(isset($row_arr['hasSon']))
            {
                foreach($row_arr['hasSon'] as &$col_arr)
                {
                    if(array_key_exists($col_arr['id'],$new_cat))
                    {
                        $col_arr['hasSon'] = $new_cat[$col_arr['id']];
                    }
                }
            }
        }
//        pp($data);


        //找出要加权限的角色
        $role = M('root_role')->find(I('get.role_id'));

        $this->assign('role',$role);
        $this->assign('data',$data);
        $this->display();
    }


    //设置权限，处理表单提交的数据
    public function addRoleSet()
    {
        $_POST['role_auth_ids'] = implode(',',$_POST['role_auth_ids']);

        //通过role_auth_ids找到对应的模块和方法
        $data = M('sys_class')->where(array('id'=>array('in',$_POST['role_auth_ids'])))
            ->field("id,blong_c,blong_a,concat(blong_c,'-',blong_a) as blong_ca")->select();

        $role_auth_ac = '';
        foreach($data as $row)
        {
            $role_auth_ac .= $row['blong_ca']."," ;
        }
        $_POST['role_auth_ac'] = rtrim($role_auth_ac,',');

        $role_id = $_POST['role_id'];
        unset($_POST['role_id']);

        $res = M('root_role')->where("role_id={$role_id}")->save($_POST);

        if($res)
        {
            $this->success('权限添加成功！',U('Group/index'));
        }else{
            $this->error('权限添加失败！');
        }
    }
}
