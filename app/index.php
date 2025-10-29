<?php require_once("config/base_cfg.php");?>
<?php 
  if(is_file($cfg_index_style))  require($cfg_index_style);
  else require("index_sytle1.php");
?>