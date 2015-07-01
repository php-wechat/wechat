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
        <a href="">公总号</a>
    </div>
</div>
<div class="cr"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
	  <tr>
		<td >ID</td>
		<td>公众号名称</td>
		<td >所属等级</td>
		<td >所属用户名</td>
		<td >使用次数</td>
		
		<td>状态</td>
		<td>管理操作</td>
	  </tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td align='center'>{viicms:$vo.id}</td>
				<td >{viicms:$vo.wxname}</td>
				<td ><?php if($vo['usr']['gid'] == -1): ?>0<?php else: ?>{viicms:$vo.user.gid}<?php endif; ?></td>
				<td >{viicms:$vo.user.username}</td>
				<td align='center'>{viicms:$vo.usenum}</td>
				<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
				</td>
				<td align='center'>
					
					| <?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('{viicms::U('Token/del/',array('id'=>$vo['id']))}','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<style>
			.current{border: 0;padding: 1px 9px;color: #fff;background: #3F8EF3 url(main/pageh.png) no-repeat;}
		</style>
     <tr bgcolor="#FFFFFF"> 
	 
      <td colspan="7"><div class="listpage">{viicms:$page}</div></td>
     
    </tr>
   
</table>

<div class="bottom">
<span>功能详细说明：</span>
</div>

</body>
</html>