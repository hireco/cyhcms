<?php
require_once(dirname(__FILE__)."/config/base_cfg.php");
require_once(dirname(__FILE__)."/config/auto_set.php");
require_once(dirname(__FILE__)."/{$cfg_admin_root}inc.php");
require_once(dirname(__FILE__)."/inc/show_msg.php");

if(isset($_REQUEST['infor_class']))  require_once("show_".$_REQUEST['infor_class'].".php");
else { 
  ShowMsg("ÇëÑ¡Ôñ²Ù×÷À¸Ä¿£¡","-1");
  exit();
 }
?>
