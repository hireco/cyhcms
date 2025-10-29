<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
if(!isset($_POST['submit_class']))  { echo "<script>alert(\"Sorry! 访问出错!\"); history.go(-1);</script>"; exit;} 
//head files
$infor_class=$_POST['infor_class'];
$upper_class_id=$_POST['upper_class_id'];
$class_level=$_POST['class_level'];
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

$query="insert into ".$table_suffix."infor 
(class_name,class_level,upper_class_id,top,
 top_time,picture,picture_link,
 picture_title,top_navi,index_block,
 left_navi,class_attribute,creator,create_time,introduction,keywords,post_type,hide_type,infor_class,template)
 values 
 ('$class_name','$class_level',$upper_class_id,'$top',
 '$top_time','$picture','$picture_link',
 '$picture_title','$top_navi','$index_block',
 '$left_navi','$class_attribute','$creator','$create_time','$introduction','$keywords','$post_type','$hide_type','$infor_class','$template')";
$result=mysql_query($query);
if(!$result) { echo "<script>alert(\"Sorry! 建立栏目失败,请重来!\"); history.go(-1);</script>";   exit; }
//insert the class infor

echo "<script>alert(\"恭喜您! 成功建立栏目!\"); location.replace(\"infor.php?infor_class=$infor_class\");</script>";   
?>
