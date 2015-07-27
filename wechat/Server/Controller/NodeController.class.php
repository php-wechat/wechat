<?php
namespace Server\Controller;
use Think\Controller;
class NodeController extends BaseController {

   public function index()
   {
       $top_menu_arr = M('top_menu')->field('id,menu_name')->select();
       $cat = M('sys_class')->order(array('top_menu_id'=>'asc','path'=>'asc'))->select();

       $top_menu = array();
       foreach($top_menu_arr as $row)
       {
           $top_menu[$row['id']] = $row['menu_name'];
       }

       foreach($cat as &$row)
       {
           //根据level设置层次关系 间隔
           if($row['level'] == 1)
           {
               $row['jiange'] = '';
           }else{
               $row['jiange'] = str_repeat('|---', $row['level']-1);
           }
       }

	   $this->assign('top_menu',$top_menu);
	   $this->assign('cat',$cat);
	   $this->display();
   }

    public function add()
    {
        $top_menu = M('top_menu')->field('id,menu_name')->order('id asc')->select();
        $wh['top_menu_id'] = $top_menu[0]['id'];
        $cat =M('sys_class')->where($wh)->order(array('path'=>'asc'))->select();
        foreach($cat as &$row)
        {
            //根据level设置层次关系 间隔
            if($row['level'] == 1)
            {
                $row['jiange'] = '';
            }else{
                $row['jiange'] = str_repeat('|---', $row['level']-1);
            }
        }

        $this->assign('top_menu',$top_menu);
        $this->assign('cat',$cat);
        $this->display();
    }

    public function doAdd()
    {
       $cat =M('sys_class');
       $id = $cat->add($_POST);
       if($id)
       {
            //然后更新path用于无限分类的排序
           $arr = array();
           if($_POST['pid'] == 0)
            {
                $arr['path'] = $id;
                $arr['level'] = 1;
            }else{
               $data = $cat->field('path')->find($_POST['pid']);
               $arr['path'] = $data['path'].'-'.$id;
               $arr['level'] = substr_count($arr['path'],'-')+1;
           }

           $res = $cat->where("id={$id}")->save($arr);
           if($res)
           {
               $this->success('添加成功！',U('Node/index'));
           }
       }else{
           $this->error('添加失败！');
       }
    }

    public function edit()
    {
        $this->display();
    }

    public function ajaxTopMenu()
    {
        $wh['top_menu_id'] = I('post.id');
        $cat =M('sys_class')->where($wh)->order(array('path'=>'asc'))->select();
        $str = "<option value='0'>父级节点</option>";
        if(is_array($cat))
        {
            foreach($cat as $row)
            {
                //根据level设置层次关系 间隔
                if($row['level'] == 1)
                {
                    $jiange = '';
                }else{
                    $jiange = str_repeat('|---', $row['level']-1);
                }
                $str .= "<option value='{$row['id']}'>{$jiange}{$row['name']}</option>";
            }
        }

        echo $str;
    }
}
