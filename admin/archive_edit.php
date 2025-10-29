<?php
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");

if(isset($_REQUEST['infor_class'])) { 
 $query="select * from ".$table_suffix."infor_class where class_name='{$_REQUEST['infor_class']}'";
 $result=mysql_query($query); 
 if($row=mysql_fetch_object($result)) { 
   if(is_file($row->mate_file."_edit.php"))  require_once($row->mate_file."_edit.php");
   else { ShowMsg("没有找到对象的操作文件！","-1"); exit(); } 
    }
  else {
    ShowMsg("错误的操作栏目！","-1");
    exit();
    }	 
 }
else { 
  ShowMsg("请选择操作栏目！","-1");
  exit();
 }
?>
