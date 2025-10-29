<?php 
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/fckeditor.php");
$fck = new FCKeditor("test");
$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
$fck->Width		= '100%' ;
$fck->Height		= "500" ;
$fck->ToolbarSet	= "Default" ;
$fck->Value = "" ;
$fck->Create();
?>
