<?php 
require_once("setting.php");
session_register("input_string"); 
echo "<IFRAME frameBorder=0 id=code_check scrolling=no name=code_check src='".RROOT."/code_check/code_image.php' style='HEIGHT: 30px; VISIBILITY: inherit; WIDTH: 250px; Z-INDEX: 2'></IFRAME>"; 
echo "<input name=\"check_input\" type=\"hidden\" id=\"check_input\" value=\"check_input\">";
require_once(dirname(__FILE__)."/../inc/md5.php"); 
?>