<?php if (!defined('THINK_PATH')) exit();?>﻿<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>-微cms后台管理系统</title>
<meta name="keywords" content="-微cms后台管理系统" />
<meta name="description" content="-微cms后台管理系统" />
<link href="/Public/server/images/style.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script src="/Public/common/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="/Public/server/js/frame.js" type=text/javascript></script>
<script type="text/javascript" src="/Public/common/artDialog/jquery.artDialog.js?skin=default"></script>
<script type="text/javascript" src="/Public/common/artDialog/plugins/iframeTools.js"></script>
</head>
<body class="showmenu">
<table width="100%" height="100%" border=0 cellpadding="0" cellSpacing=0>
  <tr>
    <td><div id="header">
	<div class="top">
    	<a href="/" class="logo" title="首页">首页</a>
		 <div class="login">
			<li>您好：<b>asdas</b> ，欢迎来到 微cms！</li>
			<li><a href="http://www.viicms.com">访问首页</a></li>
			<li><a href="{viicms::C('site_url')}/">登陆前台</a></li>
			<li><a href="http://www.viicms.com">官方网址</a></li>
			<li><a href="http://www.viicms.com">官方论坛</a></li>
			<li><a href="{viicms::U('Admin/logout')}">[退出]</a></li>
		</div>

      
    </div>
    <div class="tm">
    	<ul>

        	<li class="nav" id="link{viicms:$nav_val['id']}">
			<a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">站点设置</a></li>

            <li class="nav" id="link{viicms:$nav_val['id']}">
                <a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">用户管理</a></li>

            <li class="nav" id="link{viicms:$nav_val['id']}">
                <a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">内容管理</a></li>

            <li class="nav" id="link{viicms:$nav_val['id']}">
                <a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">公总号管理</a></li>

            <li class="nav" id="link{viicms:$nav_val['id']}">
                <a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">功能模块</a></li>

            <li class="nav" id="link{viicms:$nav_val['id']}">
                <a href="#" onClick="JumpleftFrame('{viicms::U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode
($nav_val['title'])))}',{viicms:$nav_val['id']});">扩展管理</a></li>
        </ul>
    </div>
<div class="topnav">
    	<p><a href="#" id="togglemenu">隐藏菜单</a> 加班加点升级中,更多功能，开发中</div>
        <div class="fr"><a href="#">官方论坛</a> <a href="#">在线帮助</a></div>
    </div>
    <i class="tico"></i>
</div></td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#ffffff"><table width="100%" height="100%" cellpadding="0" cellSpacing=0 border=0 borderColor="#ff0000">
        <tbody>
          <tr>
            <td noWrap id="frmTitle" bgcolor="#ff0000" width="213"><IFRAME frameBorder="0" id="left" name="left" scrolling="auto" src="<?php echo U('System/menu');?>" style="HEIGHT:100%;VISIBILITY:inherit;width:200px;Z-INDEX:2" allowtransparency="true"></IFRAME></td>
            <td></td>
            <td width="100%"><table height="100%" cellSpacing=0 cellPadding=0 width="100%" align="right" border=0>
                <tbody>
                  <tr>
                    <td align=right><IFRAME id="main" name="main" style="width: 100%; HEIGHT: 100%" src="<?php echo U('System/main');?>" frameBorder=0></IFRAME></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
  <tr>
    <td><div id="footer"><i class="tico"></i>

<p class="fr"> Copyright &copy; 2012-2013 微cms版权所有  </p>
</div></td>
  </tr>
</table>
</body>
</html>