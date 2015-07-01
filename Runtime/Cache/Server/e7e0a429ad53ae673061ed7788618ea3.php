<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站点配置</title>
<link href="/Public/server/images/main.css" type="text/css" rel="stylesheet">
<link href="/Public/common/js/jquery-1.4.2.min.js" type="text/css" rel="stylesheet">
<link href="/Public/server/images/jquery.form.js" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<style>
.set_top{background:url('/Public/server/images/set_top.png');height:60px;}
.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('/Public/server/images/set_top_li.png');}
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
 <form id="myform" action="{viicms::U('Site/insert')}" method="post">

    <tr> 
      <td  height="48" align="right"><strong>文件上传大小：</strong></td>
      <td><input type="text" name="up_size" value="{viicms::C('up_size')}" class="ipt" size="45" /><span>&nbsp;&nbsp;例：20480（2M）</span>
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>上传文件类型：</strong></td>
      <td><input type="text" name="up_exts" value="{viicms::C('up_exts')}" class="ipt" size="45" /><span>&nbsp;&nbsp;多类型用,隔开</span>
	  
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>文件存储路径：</strong></td>
      <td><input type="text" name="up_path" value="{viicms::C('up_path')}" class="ipt" size="45" /><span>&nbsp;&nbsp;例:./data/upload</span>
    </tr> 
	<tr> 
      <td  height="48" align="right"><strong>微信过期提醒：</strong></td>
      <td><input type="text" name="connectnum" value="{viicms::C('connectnum')}" class="ipt" size="45" /><span>&nbsp;&nbsp;释：当微信请求超过或用户费用到期提示信息</span>
    </tr>
   <input type="hidden" name="files" value="upfile.php" />
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