<?php
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");

if(isset($_REQUEST['add_apply'])) { 
if(is_file($_REQUEST['add_apply']))  require_once($_REQUEST['add_apply']);
   else { ShowMsg("�ø��ӹ��ܵĲ����ļ������ڣ�","-1"); exit(); }  
 }
else { 
  ShowMsg("��ѡ������ĸ��ӹ��ܶ���","-1");
  exit();
 }
?>
