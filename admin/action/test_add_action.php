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
 
//д���ݿ�
$post_time=date("y-m-d H:i:s");
$poster=$_SESSION['admin_valid'];
$last_editor=$poster;
$last_time=$post_time;

if($body=="")  { ShowMsg("��������Ϊ�գ�����ʧ��","../test.php");  exit;}

$query="insert into ".$table_suffix."test
 (degree,point,section,chapter,part,problem_content,answer,poster,post_time,last_editor,last_time,checked,locked,test_times,right_times) values
 ('$degree','$allpoint','$section','$chapter','$part','$body','$answer','$poster','$post_time','$last_editor','$last_time','0','0','0','0')";

$result=mysql_query($query);
$test_id=@mysql_insert_id();

if($result) { 
  if($_COOKIE['goto']=="l") ShowMsg("���ⷢ���ɹ�,���Զ����������б�","../test_admin.php");
  else  if($_COOKIE['goto']=="a") ShowMsg("���ⷢ���ɹ�,����������ҳ��","../test.php");
  else  if($_COOKIE['goto']=="r") ShowMsg("���ⷢ���ɹ�,����ʾ����","../test_view.php?id=".$test_id);
  else ShowMsg("���ⷢ���ɹ�,����������ҳ��","../test.php");
 }
else  ShowMsg("���ⷢ��ʧ��,��������","-1");

 }
else {
  ShowMsg("����ʧ�ܻ���Ч�ķ��ʣ�","-1");
  exit(); 
  }
?>