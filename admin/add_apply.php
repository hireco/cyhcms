<?php
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");

if(isset($_REQUEST['add_apply'])) { 
if(is_file($_REQUEST['add_apply']))  require_once($_REQUEST['add_apply']);
   else { ShowMsg("该附加功能的操作文件不存在！","-1"); exit(); }  
 }
else { 
  ShowMsg("请选择操作的附加功能对象！","-1");
  exit();
 }
?>
