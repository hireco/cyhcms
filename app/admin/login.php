<?php error_reporting(0); ?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
    session_start(); 
    require_once("setting.php");
    require_once(dirname(__FILE__)."/function/getip.php"); 
    require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
  
	$admin_id=$_POST['admin']; $password=md5($_POST['password']);
	$query="select * from ".$table_suffix."admin where admin_id='$admin_id' and admin_password='$password' and life >= '1'";
    $result=@mysql_query($query);
    
	if(!@mysql_num_rows($result)) 
	{ echo "<script>location.replace(\"login_wrong.php\");</script>"; return ;} //这里的return如果没有可能会执行后面的某个句子,例如写数据库,奇怪! 
    
	$admin_id=@mysql_result($result,0,"admin_id");
	$real_name=@mysql_result($result,0,"real_name");
	$writer_name=@mysql_result($result,0,"writer_name");
    $admin_level=@mysql_result($result,0,"admin_level");
	$last_login_time=@mysql_result($result,0,"last_login");
    $last_login_ip=@mysql_result($result,0,"last_ip");
	
	if($admin_level=="9") { session_register("root"); $_SESSION['root']="super_administrator";}
	else { session_register("root"); $_SESSION['root']="administrator"; }
	
	session_register("admin_valid"); $_SESSION['admin_valid']=$admin_id;
	session_register("pass_valid");  $_SESSION['pass_valid']=$password;
	session_register("real_name");  $_SESSION['real_name']=$real_name; 
	session_register("writer_name");  $_SESSION['writer_name']=$writer_name; 
	session_register("admin_level");  $_SESSION['admin_level']=$admin_level; 
	session_register("last_login_time");  $_SESSION['last_login_time']=$last_login_time; 
	session_register("last_login_ip");  $_SESSION['last_login_ip']=$last_login_ip; 
	
    $login_time=date("y-m-d H:i:s");
    @mysql_query("update ".$table_suffix."admin set last_login='$login_time',last_ip='$ip' where admin_id='$admin_id'");  
    @mysql_query("insert into ".$table_suffix."admin_record (real_name,admin_id,login_time,login_ip) values ('$real_name','$admin_id','$login_time','$ip')");    
	echo "<script>location.replace(\"index.php\");</script>";
?>


