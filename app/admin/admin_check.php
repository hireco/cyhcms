<?php 
session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
if(!isset($_SESSION['root'])) { require_once(dirname(__FILE__)."/login_wrong.php");  exit; }
?>