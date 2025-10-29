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
require_once(dirname(__FILE__)."/inc_action.php");
//写数据库
 
$article_title=msubstr(trim($title),0,100);
$content=addslashes($body);
$jump_url=msubstr(trim($jump_url),0,100);
$visit_times=trim($visit_times);
$post_time=$post_time==""?date("y-m-d H:i:s"):$post_time;
$top=trim($top); 
$keywords=strip_tags(msubstr(trim($keywords),0,60));
$abstract=strip_tags(msubstr(trim($abstract),0,250));
$similar_id=strip_tags(msubstr(trim($similar_id),0,250));

if($top) $top_time=$post_time; else $top_time="00-00-00 00:00:00";
$poster=$_SESSION['admin_valid'];
$last_ip=$ip;
$ftp_from=$source_input;

$query="insert into ".$table_suffix."ftp
 (poster,filename,top_time,last_ip,ftp_from,article_title,title_bold,title_color,content,show_attribute,hide_type,jump_url,new_or_not,read_times,checked,comment_or_not,post_time,new_or_not_time,recommend_time,show_attribute_time,locked,top,recommend,keywords,abstract,similar_id,refer_url,class_id,template)
 values
 ('$poster','$rurl','$top_time','$last_ip','$ftp_from','$article_title','$title_bold','$title_color','$content','$show_attribute','$hide_type','$jump_url','$new_or_not','$visit_times','$checked','$comment_or_not','$post_time','$post_time','$post_time','$post_time','$locked','$top','$recommend','$keywords','$abstract','$similar_id','$refer_url','$class_id','$template')";

$result=mysql_query($query);

//文章索引
$object_id=@mysql_insert_id();
$infor_class="ftp";
$query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
($object_id,$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query);

require_once(dirname(__FILE__)."/image_action.php"); //写入图片

if($result) ShowMsg("发表成功,将自动进入相应栏目！","../content_list.php?class_id={$class_id}&infor_class=ftp&class_name={$class_name}");
else  ShowMsg("资料发布失败,请重来！","-1");

 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>
