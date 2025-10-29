<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");

if(isset($_REQUEST['action'])) {
 $top_time=date("y-m-d H:i:s");
 if($_REQUEST['action']=="delete") {
 $num=mysql_num_rows(mysql_query("select id from ".$table_suffix.$_REQUEST['infor_class']." where class_id={$_REQUEST['class_id']}"));
 $num=$num+mysql_num_rows(mysql_query("select id from ".$table_suffix."infor  where upper_class_id={$_REQUEST['class_id']}"));
 if($num) { echo "<script>alert(\"非空栏目不能删除!\"); history.go(-1);</script>"; exit;}
 $result=mysql_query("delete from ".$table_suffix."infor  where id={$_REQUEST['class_id']}");
  }
 else if($_REQUEST['action']=="hide")
 $result=mysql_query("update ".$table_suffix."infor  set hide_type='1' where id={$_REQUEST['class_id']}");
 else if($_REQUEST['action']=="top") { 
 $top=mysql_result(mysql_query("select max(top) as max_top from ".$table_suffix."infor where id!={$_REQUEST['class_id']}"),0,"max_top");
 $result=mysql_query("update ".$table_suffix."infor  set top='$top'+'1', top_time='$top_time' where id={$_REQUEST['class_id']}");
  }
}

elseif(isset($_POST['submit_class']))  { 
//head files
$infor_class=$_POST['infor_class'];
$upper_class_id=$_POST['upper_class_id'];
$upper_class_level=$_POST['upper_class_level'];

$class_id=$_POST['class_id'];
if($class_id==$upper_class_id) { echo "<script>alert(\"Sorry! 无法移动到自身下!\"); location.replace(\"infor.php?infor_class=$infor_class\");</script>"; exit;} 

$class_level_old=$_POST['class_level'];
$class_level_new=$upper_class_level+1;
$class_level_change=$class_level_new-$class_level_old;

$class_name=trim($_POST['class_name']);
$introduction=ereg_replace("[\"><'\r\n]","",strip_tags(trim($_POST['introduction'])));
$class_attribute=$_POST['class_attribute'];
$keywords=trim($_POST['keywords']);
$post_type=$_POST['post_type'];
$hide_type=$_POST['hide_type'];
$template=$_POST['template'];

$top_input=$_POST['top_input'];
if($top_input=="") $top=$_POST['top']; else $top=$top_input;

$top_navi=$_POST['top_navi'];
$left_navi=$_POST['left_navi'];
$index_block=$_POST['index_block'];
$select_or_input=$_POST['select_or_input'];
//get form variables 

$top_time=date("y-m-d H:i:s");
$creator=$_SESSION['real_name'];
$create_time=$top_time;
//variables default

if($select_or_input=="select") {
$picture=$_POST['picture_select'];
$picture_title=$_POST['picture_title_select'];
$picture_link=$_POST['picture_link_select'];
}
 //select files from server

else {
  $upload_child_dir=$cfg_cosmimg_root;
  require_once(dirname(__FILE__)."/../file_do/image_upload.php");
}//ftp file from local

$query="update ".$table_suffix."infor 
 set class_name='$class_name',upper_class_id='$upper_class_id',top='$top',
 top_time='$top_time',picture='$picture',picture_link='$picture_link',
 picture_title='$picture_title',top_navi='$top_navi',index_block='$index_block',
 left_navi='$left_navi',class_attribute='$class_attribute',creator='$creator',create_time='$create_time',introduction='$introduction',
 keywords='$keywords',post_type='$post_type',hide_type='$hide_type',infor_class='$infor_class',template='$template'  where id='$class_id'";
$result=mysql_query($query);
if(!$result) { echo "<script>alert(\"Sorry! 修改栏目失败,请重来!\"); history.go(-1);</script>";   exit; }
//insert the class infor

function refresh_child($class_id,$level_change) {
global $table_suffix;
$result0=mysql_query("select * from ".$table_suffix."infor where upper_class_id = $class_id");
if(!@mysql_num_rows($result0))
    { $result=mysql_query("update  ".$table_suffix."infor set class_level=class_level+($level_change) where id=$class_id"); 
	  if($result) return;
	  else { echo "<script>alert(\"Sorry! 移动失败!\"); location.replace(\"article_class.php\");</script>"; exit;} 
	}
else{ $result=mysql_query("update  ".$table_suffix."infor set class_level=class_level+($level_change) where id=$class_id"); 
	  while($row0=mysql_fetch_object($result0))
	  refresh_child($row0->id,$level_change);
    }
 }

refresh_child($class_id,$class_level_change);
 
 }
if($result) echo "<script>alert(\"恭喜您! 成功修改栏目!\");location.replace(\"infor.php?infor_class=$infor_class\");</script>"; 
?>
