<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
//------------------------------------------------------------
//此为提供会员发布文章功能
//-------------------------------------------------------------
require_once("setting.php");//对于路径非常重要,用在is_file,is_dir等处
require_once(dirname(__FILE__)."/../config/base_cfg.php");
session_start();
require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../".$cfg_admin_root."function/inc_function.php");
require_once(dirname(__FILE__)."/../".$cfg_admin_root."function/getip.php");

$cfg_basehost=ereg_replace("/$","",$cfg_base_url);

if(isset($_SESSION['user_name'])){

if(isset($_POST['submit'])) {
 if(($_POST['action']=="amend")&&($_POST['article_id']<>"")) { 
  $query="select * from ".$table_suffix."article where id={$_POST['article_id']} and poster='{$_SESSION['user_name']}' and locked='0'";
  $result=mysql_query($query);
  if(!mysql_num_rows($result)) {
    ShowMsg("不存在或者无效的编辑对象！","-1");
    exit(); 
   }
    $row=mysql_fetch_object($result);
 } 
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/../".$cfg_admin_root."action/inc_action.php");
 
//写数据库
 
$article_title=msubstr(trim($title),0,100);
$content=addslashes($body);
$keywords=addslashes(strip_tags(msubstr(trim($keywords),0,60)));
$abstract=addslashes(strip_tags(msubstr(trim($abstract),0,250)));
$article_from=$source_input==""?"本站网友":$source_input;
$pen_name=$writer_input==""?$_SESSION['nick_name']:$writer_input;
// some values from the form submitted,apart from those do not need to be changed before submit to the database

$post_time=date("y-m-d H:i:s");
$top_time="00-00-00 00:00:00";
$poster=$_SESSION['user_name'];
$last_ip=$ip;
$last_editor=$poster;
$last_time=$post_time;
$title_color="#000000";
$short_title="";
$show_attribute="0";
$vice_title="";
$jump_url="";
$new_or_not="1";
$visit_times="0";
$checked="0";
$comment_or_not="1";
$keep_style="0";
$locked="0";
$top="0";
$recommend='0';
$similar_id="";
$refer_url="";
// default value for common users to input

if($action=="amend") $query="update ".$table_suffix."article
 set 
 last_ip='$last_ip',last_editor='$last_editor',last_time='$last_time',article_from='$article_from',pen_name='$pen_name',
 article_title='$article_title',title_bold='$title_bold', content='$content',checked='$checked',
 hide_type='$hide_type',keywords='$keywords',abstract='$abstract',class_id='$class_id' where id = {$article_id}";

else $query="insert into ".$table_suffix."article
 (poster,top_time,last_ip,last_editor,last_time,article_from,article_title,title_bold,title_color,pen_name,content,short_title,show_attribute,vice_title,hide_type,jump_url,new_or_not,read_times,checked,comment_or_not,post_time,new_or_not_time,recommend_time,show_attribute_time,keep_style,locked,top,recommend,keywords,abstract,similar_id,refer_url,class_id)
 values
 ('$poster','$top_time','$last_ip','$last_editor','$last_time','$article_from','$article_title','$title_bold','$title_color','$pen_name','$content','$short_title','$show_attribute','$vice_title','$hide_type','$jump_url','$new_or_not','$visit_times','$checked','$comment_or_not','$post_time','$post_time','$post_time','$post_time','$keep_style','$locked','$top','$recommend','$keywords','$abstract','$similar_id','$refer_url','$class_id')";

$result=mysql_query($query);

if($action=="amend") $object_id=$article_id;  else $object_id=@mysql_insert_id();

//文章索引
$infor_class="article";

if($action=="amend")  $query="update ".$table_suffix."infor_index 
set article_title='$article_title',hide_type='$hide_type',keywords='$keywords',title_bold='$title_bold', checked='$checked' where 
infor_id=$object_id and class_id=$class_id and infor_class='$infor_class'";

else $query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
($object_id,$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query);

if($action=="amend") { if($picture_input<>"") require_once(dirname(__FILE__)."/../".$cfg_admin_root."action/image_action.php"); } //写入图片 
else  require_once(dirname(__FILE__)."/../".$cfg_admin_root."action/image_action.php");


if($result) ShowMsg("文章发表成功,将自动进入该文章栏目！","../tougao_admin.php?class_id={$class_id}&infor_class=article&class_name={$class_name}");
else  ShowMsg("文章发表失败,请重来！","-1");

 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
    }
} else ShowMsg("对不起,您没有权限!",-1);
?>
