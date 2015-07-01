<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站点配置</title>
<link href="/Public/server/images/main.css" type="text/css" rel="stylesheet">
<link href="/Public/server/images/jquery-1.4.2.min.js" type="text/css" rel="stylesheet">
<link href="/Public/server/images/jquery.form.js" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<style>
.set_top{background:url('/Public/server/images/set_top.png');height:60px;}
.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('{viicms::RES}/images/set_top_li.png');}
#set_top_li_bg{background:url('/Public/server/images/set_top_li_hover.png');}
</style>
<div class="set_top">
		<li id="set_top_li_bg"><a href="<?php echo U('Site/index');?>">基本信息设置</a></li>
		<li><a href="<?php echo U('Site/safe');?>">安全设置</a></li>
		<li><a href="<?php echo U('Site/email');?>">邮箱设置</a></li>
		<li><a href="<?php echo U('Site/upfile');?>">附件设置</a></li>
		<li><a href="<?php echo U('Site/alipay');?>">在线支付接口</a></li>
</div>
<div id="artlist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">
 <form id="myform" action=" " method="post">

    <tr> 
      <td  height="48" align="right"><strong>网站名称：</strong></td>
      <td><input type="text" name="site_name" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;例：百合网</span>
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>网站标题：</strong></td>
      <td><input type="text" name="site_title" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;一般不超过80个字符</span>
	  
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>网站地址：</strong></td>
      <td><input type="text" name="site_url" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;例:http://www.viicms.com</span>
    </tr>  
	<tr> 
      <td  height="48" align="right"><strong>机器人名称：</strong></td>
      <td><input type="text" name="site_my" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;例:http://www.viicms.com</span>
    </tr> 
	<tr> 
      <td  height="48" align="right"><strong>审核用户：</strong></td>
      <td><input type="radio" name="ischeckuser" value="true" <?php if(C('ischeckuser')==='true')echo checked; ?> />注册时无需要审核<input type="radio" name="ischeckuser" value="false" <?php if(C('ischeckuser')==='false')echo checked; ?> />注册时需要审核</td>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>网站备案：</strong></td>
      <td><input type="text" name="ipc" value="{viicms::C('ipc')}" class="ipt" size="45" /><span>&nbsp;&nbsp;例：沪IPC备12587号</span>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>站长QQ：</strong></td>
      <td><input type="text" name="site_qq" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;例如:QQ:8888888</span>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>站长Email：</strong></td>
      <td><input type="text" name="site_email" value="" class="ipt" size="45" /><span>&nbsp;&nbsp;例如:QQ:server@viicms.com</span>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>网站关键词：</strong></td>
      <td><textarea	 type="text" name="keyword" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" /></textarea><span>&nbsp;&nbsp;一般不超过100个字符</span>
    </tr>	
	<tr> 
      <td  height="48" align="right"><strong>网站　描述：</strong></td>
      <td><textarea	 type="text" name="content" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" /></textarea><span>&nbsp;&nbsp;一般不超过200个字符</span>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>统计　代码：</strong></td>
      <td><textarea	 type="text" name="counts" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" />{viicms::C('counts')}</textarea><span>&nbsp;&nbsp;例:51啦统计,cnzz统计</span>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>底部　版权：</strong></td>
      <td><textarea	 type="text" name="copyright" class="ipt" style="width:450px;height:60px;margin:5px 0 5px 0;" />{viicms::C('copyright')}</textarea><span>&nbsp;&nbsp;例:微cms版权所有</span>
    </tr>
   <input type="hidden" name="files" value="info.php" />
    <tr> 
      <td height="48" colspan="2">
		  <div id="addkey"></div>
		  <div style="padding-left:100px;">
			<input type="submit" value="保存设置" />
		  </div>
	  </td>
    </tr>
	</form>
</table><br />
<br />
<br />

</div>
</body>
</html>