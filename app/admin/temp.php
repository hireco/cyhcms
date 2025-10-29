<?php 
//try scripts
$_POST['kk']="aa";
if($_POST['kk']=="aa") echo $_POST['kk']; echo "<br>";
$url_string='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
echo ereg_replace("&page_id=[0-9]*[1-9][0-9]*","",$url_string);
echo "<br>";
echo $url_suffix=!empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : str_replace($_SERVER["SCRIPT_NAME"], '', $_SERVER["REQUEST_URI"]); 
echo "<br>";
    $url_string=$url_suffix;
echo ereg_replace("&page_id=[0-9]*[1-9][0-9]*","",$url_string);
?>
