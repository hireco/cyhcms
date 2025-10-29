<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
  require_once(dirname(__FILE__)."/show_msg.php"); 
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  $query="select infor_class,class_attribute from ".$table_suffix."infor where id={$_REQUEST['class_id']}";
  $result=mysql_query($query); 
  if(!mysql_num_rows($result)) { ShowMsg("不存在的栏目！",-1);  exit; }   
  $class_row=@mysql_fetch_object($result);
  if($class_row->class_attribute=="1") { 
  $_REQUEST['id']=mysql_result(mysql_query("select id from  ".$table_suffix.$class_row->infor_class." where class_id={$_REQUEST['class_id']}"),0,"id");
  require_once("show_".$class_row->infor_class.".php");
  exit;
  }
?>
