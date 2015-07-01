<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导航</title>
<link href="/Public/server/images/style.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script lanuage="JScript">
function tourl(url){
	parent.main.location.href=url;
}
</script>
</head>
<body style="background:none">

<div class="mbox">

    <?php if($nav_id == 1): ?><h3>站点管理</h3>
        <ul>
            <li><a href="<?php echo U('Site/index');?>" target="main" >站点设置</a></li>
            <li><a href="<?php echo U('Node/index');?>" target="main" >节点设置</a></li>
        </ul>

    <?php elseif($nav_id == 2): ?>

        <h3>用户管理</h3>
        <ul>
            <li><a href="<?php echo U('User/index');?>" target="main" >用户中心</a></li>
            <li><a href="<?php echo U('Group/index');?>" target="main" >管理组</a></li>
            <li><a href="<?php echo U('UserGroup/index');?>" target="main" >会员组</a></li>
            <li><a href="<?php echo U('Users/index');?>" target="main" >前台用户</a></li>
        </ul>

    <?php elseif($nav_id == 3): ?>


        <h3>内容管理</h3>
        <ul>
            <li><a href="<?php echo U('Article/index');?>" target="main" >微信图文</a></li>
            <li><a href="<?php echo U('Text/index');?>" target="main" >微信文本</a></li>
            <li><a href="<?php echo U('Custom/index');?>" target="main" >自定义页面</a></li>
        </ul>

    <?php elseif($nav_id == 4): ?>

        <h3>公总号管理</h3>
        <ul>
            <li><a href="<?php echo U('Token/index');?>" target="main" >公总号管理</a></li>
        </ul>

    <?php elseif($nav_id == 5): ?>

        <h3>功能模块</h3>
        <ul>
            <li><a href="<?php echo U('Function/index');?>" target="main" >功能模块</a></li>
        </ul>

    <?php elseif($nav_id == 6): ?>

        <h3>zhifu管理</h3>
        <ul>
            <li><a href="<?php echo U('Site/index');?>" target="main" >站点设置</a></li>
            <li><a href="<?php echo U('Node/index');?>" target="main" >节点设置</a></li>
        </ul><?php endif; ?>

<p class="m_b"></p>
</div>
<!--/mbox-->

<!--/mbox-->

</body>
</html>