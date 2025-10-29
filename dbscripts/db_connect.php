<?php
 require_once("config.php"); 
 require_once("Error_msg.php");
 function  db_connect($db_name,$db_user,$db_password,$db_url) {
 $result=@mysql_pconnect($db_url,$db_user,$db_password);
 if(!$result)  
 { Error_msg("警告！主机暂时无法连接，<br>可能站点被关闭，请稍后重试！","about:blank"); exit(0); } 
 if(!@mysql_select_db($db_name)) 
 { Error_msg("警告！数据库服务关闭，请联系管理员！","about:blank"); exit(0); } 
 return $result;
 }

 db_connect($db_name,$db_user,$db_password,$db_url);
?>