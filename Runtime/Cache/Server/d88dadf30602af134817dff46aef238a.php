<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限管理</title>
    <link href="/Public/server/images/main.css" type="text/css" rel="stylesheet">
    <script src="/Public/common/js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="/Public/server/js/function.js" type="text/javascript"></script>
    <meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<div id="artlist">
    <div class="mod kjnav">
        <a href="<?php echo U('Group/add');?>">创建用户</a>
        <a href="<?php echo U('Group/index');?>">用户列表</a>
    </div>
</div>
<div class="cr"></div>
<form action="{viicms::U('Group/role_sort')}" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
	<tr>
		<td width="70">排序权重</td>
		<td width="70">ID</td>
		<td width="350">角色名称</td>
		<td >角色描述</td>
		<td width="70">状态</td>
		<td width="200">管理操作</td>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td align='center'>
				<input type='text' value='{viicms:$vo.sort}' size='3' name='sort[{viicms:$vo.id}]'></td>
			<td align='center'>{viicms:$vo.id}</td>
			<td >{viicms:$vo.name}</td>
			<td >{viicms:$vo.remark}</td>
			<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
			</td>
			<td align='center'>
				<a href="javascript:setting_access({viicms:$vo.id}, '{viicms:$vo.name}')">权限设置</a>
				| <a href="{viicms::U('Group/edit/',array('id'=>$vo['id']))}">修改</a>
				| <a href="javascript:void(0)" onclick="return confirmurl('{viicms::U('Group/del/',array('id'=>$vo['id']))}','确定删除该角色吗?')">删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

<script type="text/javascript">
//权限设置
function setting_access(id, name) {
	window.top.art.dialog.open('{viicms::U("Group/access")}'+'&roleid='+id,{title: name+'权限设置', width: 600, height: 500});
}
</script>
<div class="bottom">
<input type="submit" value="排序" class="bginput" />
</div>
</form>
</body>
</html>