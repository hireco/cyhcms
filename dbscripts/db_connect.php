<?php
 require_once("config.php"); 
 require_once("Error_msg.php");
 function  db_connect($db_name,$db_user,$db_password,$db_url) {
 $result=@mysql_pconnect($db_url,$db_user,$db_password);
 if(!$result)  
 { Error_msg("���棡������ʱ�޷����ӣ�<br>����վ�㱻�رգ����Ժ����ԣ�","about:blank"); exit(0); } 
 if(!@mysql_select_db($db_name)) 
 { Error_msg("���棡���ݿ����رգ�����ϵ����Ա��","about:blank"); exit(0); } 
 return $result;
 }

 db_connect($db_name,$db_user,$db_password,$db_url);
?>