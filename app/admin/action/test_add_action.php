<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../../config/base_cfg.php");
require_once(dirname(__FILE__)."/../inc.php");
require_once(dirname(__FILE__)."/../function/inc_function.php");
require_once(dirname(__FILE__)."/../../config/auto_set.php");
require_once(dirname(__FILE__)."/../function/getip.php");

 $cfg_basehost=ereg_replace("/$","",$cfg_base_url);
if(isset($_POST['submit'])) {
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/inc_action_test.php");
 
//写数据库
$post_time=date("y-m-d H:i:s");
$poster=$_SESSION['admin_valid'];
$last_editor=$poster;
$last_time=$post_time;

if($body=="")  { ShowMsg("试题内容为空，发布失败","../test.php");  exit;}

$query="insert into ".$table_suffix."test
 (degree,point,section,chapter,part,problem_content,answer,poster,post_time,last_editor,last_time,checked,locked,test_times,right_times) values
 ('$degree','$allpoint','$section','$chapter','$part','$body','$answer','$poster','$post_time','$last_editor','$last_time','0','0','0','0')";

$result=mysql_query($query);
$test_id=@mysql_insert_id();

if($result) { 
  if($_COOKIE['goto']=="l") ShowMsg("试题发布成功,将自动进入试题列表","../test_admin.php");
  else  if($_COOKIE['goto']=="a") ShowMsg("试题发布成功,进入继续添加页面","../test.php");
  else  if($_COOKIE['goto']=="r") ShowMsg("试题发布成功,将显示试题","../test_view.php?id=".$test_id);
  else ShowMsg("试题发布成功,进入继续添加页面","../test.php");
 }
else  ShowMsg("试题发表失败,请重来！","-1");

 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>