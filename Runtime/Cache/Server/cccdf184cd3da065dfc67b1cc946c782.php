<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限管理</title>

<div class="cr"></div>
<form action="{viicms::U('Node/sort')}" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
  <tr>
    <th width="5%">排序权重</th>
    <th width="5%" class="xtit">ID</th>
    <th width="40%">菜单名称</th>
    <th width="6%">类型</th>
    <th width="6%">状态</th>
    <th width="6%">显示</th>
    <th width="24%">操作</th>
  </tr>
	{viicms:$html_tree}
   
</table>

<div class="bottom">
<span><input type="submit" value="排序" class="bginput"></span>
</div>
</form>
</body>
</html>