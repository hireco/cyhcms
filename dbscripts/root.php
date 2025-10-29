<?php 
  require_once("db_connect.php");
  
  $password=md5("123456");
   
  echo $password;
  
  $login_time=date("y-m-d H:i:s");
  @mysql_query("insert into cyhcms_admin (admin_id,real_name,admin_password,register_time,last_login,last_ip,admin_level,life)  
                          values ('root','³ÌÔË»ª','$password','00-00-00 00-00-00','00-00-00 00-00-00','127.0.0.1','9','1')");
   
?>

