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
 $query="select * from ".$table_suffix."test where id={$_POST['id']}";
 $result=mysql_query($query);
 if($row=mysql_fetch_object($result)) { 
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/inc_action_test.php");
 
//写数据库
$last_time=date("y-m-d H:i:s");
$last_editor=$_SESSION['admin_valid'];

if($body=="")  { ShowMsg("试题内容为空，发布失败","../test.php");  exit;}

$query="update ".$table_suffix."test set 
  degree='$degree',
  point='$point',
  section='$section',
  chapter='$chapter',
  part='$part',
  problem_content='$body',
  answer='$answer',
  last_editor='$last_editor',
  last_time='$last_time'
  where id={$_POST['id']}
  ";

$result=mysql_query($query);

if($result) { 
  if($_COOKIE['goto']=="l") ShowMsg("试题编辑成功,将自动进入试题列表","../test_admin.php");
  else  if($_COOKIE['goto']=="a") ShowMsg("试题编辑成功,进入继续添加页面","../test.php");
  else  if($_COOKIE['goto']=="r") ShowMsg("试题编辑成功,将显示试题","../test_view.php?id=".$_POST['id']);
  else  ShowMsg("试题编辑成功,进入继续添加页面","../test.php");
 }
else  ShowMsg("试题编辑失败,请重来！","-1");
   }
   else {
    ShowMsg("编辑对象不存在！","-1");
    exit(); 
    }
 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>