<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<title>
	微cms后台管理登录
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="微cms微信营销系统" />
<meta name="Description" content="微cms微信营销系统" />
<link type="text/css" rel="stylesheet" href="/Public/server/css/reset.css" />
<link type="text/css" rel="stylesheet" href="/Public/server/css/common.css" />
<link type="text/css" rel="stylesheet" href="/Public/server/css/page.css" />
<script type="text/javascript" src="/Public/server/js/jquery-1.4.2.min.js"></script>
<!--[if IE 6]>
 
<script language="javascript" type="text/javascript" src="/Public/server/js/DD_belatedPNG.js"></script>
 
<script language="javascript" type="text/javascript">
 
DD_belatedPNG.fix(".logo a img,.shade img");
 
</script>
 
<![endif]-->
<script type="text/javascript">
    $(function () {
        $("input").focus(function () {
            $(this).addClass("inputFocus");
        }).blur(function () {
            $(this).removeClass("inputFocus");
        });
    });

    function refresh() {
        var randomRZ = Math.random();
        $("#imgCheckB").attr("src", "/index.php?g=Admin&m=Admin&a=verify&rz=" + randomRZ);
    }
</script>
</head>
<body style="background: #378ECD url(tpl/Admin/common/login/A001.jpg)repeat-x;">
<!--container-->
<div class="container bc">
	<div class="loginBox">
			<div class="top clearfix">
				<div class="tl"></div>
				<div class="tr"></div>
				<div class="t"></div>
			</div>
			<div class="content">
            	<form name="form1" method="post" action=" " id="form1" class="myform">

                	<fieldset>
                		<legend><h1>viicms 后台管理系统</h1></legend>
                       
                  		<p><span><input name="username" type="text" id="username" class="username_input" /></span></p>
                   	    <p><span><input name="password" type="password" id="pw" class="ps_input" /></span></p>
                    	<p>
                        	<span><input name="code" type="text" id="txtCheckCode" class="chk_input" maxlength="4" /></span>
                        	<span class="chk_img"><img src="11.png" id="imgCheckB"/></span>
                            <span class="chk_txt"><a href="javascript:refresh();" style="color: #0033CC">看不清？换一张</a></span>
                        </p>
                      
               <input type="submit" name="Button1" value="" id="Button1" class="subBtn" />

                    </fieldset>

                </form>	
			</div>
			<div class="bottom clearfix">
				<div class="bl"></div>
				<div class="br"></div>
				<div class="b"></div>
			</div>
		</div>

        
</div>

<!--footer-->
<div class="footer pt30">
	CopyRight 2013 微cms All Rights Reserved 版权所有 微cms<br />
	
</div>
</body>
</html>