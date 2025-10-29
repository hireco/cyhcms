<?php session_start(); 
       session_destroy(); 
	   session_start(); 
	   setcookie("user_name","", time()); 
       setcookie("user_pass","", time());
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php require_once("inc/show_msg.php");
if(isset($_REQUEST['to_go'])) ShowMsg("成功退出用户中心",$_REQUEST['to_go']); 
else ShowMsg("成功退出用户中心",-1); 
?>
