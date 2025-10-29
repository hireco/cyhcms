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
$query="select * from ".$table_suffix."article where id={$_REQUEST['article_id']}";
$result=mysql_query($query);
if(!mysql_num_rows($result)) {
  ShowMsg("不存在或者无效的编辑对象！","-1");
  exit(); 
  }
 $row=mysql_fetch_object($result);
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/inc_action.php");

//写数据库

$article_title=msubstr(trim($title),0,100);
$content=addslashes($body);
$short_title=msubstr(trim($short_title),0,50);
$vice_title=msubstr(trim($vice_title),0,100);
$jump_url=msubstr(trim($jump_url),0,100);
$visit_times=trim($visit_times);
$post_time=$post_time==""?$row->post_time:$post_time;
$last_time=$last_time==""?date("y-m-d H:i:s"):$last_time;
$top=trim($top); 
$keywords=strip_tags(msubstr(trim($keywords),0,60));
$abstract=strip_tags(msubstr(trim($abstract),0,250));
$similar_id=strip_tags(msubstr(trim($similar_id),0,250));

if($top) $top_time=date("y-m-d H:i:s"); else $top_time="00-00-00 00:00:00";
$poster=$row->poster;
$last_ip=$ip;
$last_editor=$_SESSION['real_name'];
$article_from=$source_input;
$pen_name=$writer_input;
$query="update ".$table_suffix."article
 set 
 top_time='$top_time',last_ip='$last_ip',last_editor='$last_editor',last_time='$last_time',article_from='$article_from',pen_name='$pen_name',
 article_title='$article_title',title_bold='$title_bold',title_color='$title_color', content='$content',
 short_title='$short_title',show_attribute='$show_attribute',vice_title='$vice_title',hide_type='$hide_type',jump_url='$jump_url',
 new_or_not='$new_or_not',read_times='$visit_times',checked='$checked',comment_or_not='$comment_or_not',post_time='$post_time',new_or_not_time='$post_time',recommend_time='$post_time',show_attribute_time='$post_time',keep_style='$keep_style',
 locked='$locked',top='$top',recommend='$recommend',keywords='$keywords',abstract='$abstract',similar_id='$similar_id',refer_url='$refer_url',class_id='$class_id',template='$template' where id = {$article_id}";

$result=mysql_query($query);

//更新索引
mysql_query("delete from ".$table_suffix."infor_index where infor_id=$article_id and infor_class='article'");
$infor_class="article";
$query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
($article_id,$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query);

$object_id=$article_id;
require_once(dirname(__FILE__)."/image_action.php"); //写入图片


if($result) ShowMsg("文章修改成功,将自动进入该文章栏目！","../content_list.php?class_id={$class_id}&infor_class=article&class_name={$class_name}");
else  ShowMsg("文章修改失败,请重来！","-1");
 }
  else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>
