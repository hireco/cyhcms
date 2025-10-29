<?php session_start(); 
require_once("setting.php");
require_once("inc.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<style>
.navPoint {
 COLOR: white; CURSOR: hand; FONT-FAMILY: Webdings; FONT-SIZE: 9pt
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>后台管理系统</title>
</head>

<frameset name=topwin  framespacing="0" border="0" cols="169,8,*" frameborder="0">
  	<frame name="frmleft"  src="menu.php" target="frmright" scrolling="no">
	<frame name="frmcenter" noresize scrolling="no" src="click.php">
	<frame name="frmright" src="admin.php">
</frameset>
<noframes><body>
</body></noframes>
</html>


