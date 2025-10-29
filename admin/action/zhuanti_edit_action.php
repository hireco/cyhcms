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
$query="select * from ".$table_suffix."zhuanti where id={$_REQUEST['article_id']}";
$result=mysql_query($query);
if(!mysql_num_rows($result)) {
  ShowMsg("不存在或者无效的编辑对象！","-1");
  exit(); 
  }
 $row=mysql_fetch_object($result);
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/inc_action.php");

//获取地址列表
$i=1; $rows_str="row".$i; $title_str="title".$i; $id_list_str="id_list".$i;
		    $archive_list="";
		    while(($_POST[$title_str]<>"")&&(isset($_POST[$title_str]))) 
		   {
		    $_POST[$title_str]=trim($_POST[$title_str]);
			$_POST[$id_list_str]=trim($_POST[$id_list_str]);
			$_POST[$rows_str]=trim($_POST[$rows_str]);
			if($i<>1)
			$archive_list=$archive_list.";".$_POST[$title_str]."-".$_POST[$rows_str]."-".$_POST[$id_list_str];
			else $archive_list=$_POST[$title_str]."-".$_POST[$rows_str]."-".$_POST[$id_list_str];
			$i++; $rows_str="row".$i; $title_str="title".$i; $id_list_str="id_list".$i;
		    }
			
//写数据库
 
$article_title=msubstr(trim($article_title),0,100);
$content=addslashes($body);
$jump_url=msubstr(trim($jump_url),0,100);
$read_times=trim($read_times);
$post_time=$post_time==""?$row->post_time:$post_time;
$last_time=$last_time==""?date("y-m-d H:i:s"):$last_time;
$top=trim($top); 
$keywords=strip_tags(msubstr(trim($keywords),0,50));
$abstract=strip_tags(msubstr(trim($abstract),0,250));

if($top) $top_time=$post_time; else $top_time="00-00-00 00:00:00";
$poster=$row->poster;
$last_ip=$ip;

$result=mysql_query("delete from ".$table_suffix."zhuanti where id={$_REQUEST['article_id']}");
if(!$result) { ShowMsg("数据库写失败！","-1");  exit();  }

$query="insert into ".$table_suffix."zhuanti
 (id,class_id,article_title,top,archive_list,content,read_times,poster,post_time,new_or_not_time,recommend_time,show_attribute_time,top_time,locked,hide_type,title_bold,title_color,recommend,comment_or_not,checked,keywords,abstract,new_or_not,jump_url,show_attribute,refer_url,template)
 values
 ({$_REQUEST['article_id']},'$class_id','$article_title','$top','$archive_list','$content','$read_times','$poster','$post_time','$post_time','$post_time','$post_time','$top_time','$locked','$hide_type','$title_bold','$title_color','$recommend','$comment_or_not','$checked','$keywords','$abstract','$new_or_not','$jump_url','$show_attribute','$refer_url','$template')";

$result=mysql_query($query);

//文章索引
mysql_query("delete from ".$table_suffix."infor_index where infor_id={$_REQUEST['article_id']} and infor_class='zhuanti'");
$infor_class="zhuanti";
$query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
({$_REQUEST['article_id']},$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query);

$object_id=$_REQUEST['article_id'];
require_once(dirname(__FILE__)."/image_action.php"); //写入图片

if($result) ShowMsg("修改成功,将自动进入相应栏目！","../content_list.php?class_id={$class_id}&infor_class=zhuanti&class_name={$class_name}");
else  ShowMsg("资料修改失败,请重来！","-1");

 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>
