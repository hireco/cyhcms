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


//��ȡ��ַ�б�
$i=1; $url_str="url".$i; $server_str="server".$i;
		    $url="";
		    while(($_POST[$url_str]<>"")&&(isset($_POST[$url_str]))) 
		   {
		    $_POST[$url_str]=trim($_POST[$url_str]);
			$_POST[$server_str]=trim($_POST[$server_str])==""?"������δ֪":trim($_POST[$server_str]);
			if($i<>1)
			$url=$url.",".$_POST[$server_str]."*".$_POST[$url_str];
			else $url=$_POST[$server_str]."*".$_POST[$url_str];
			$i++; $url_str="url".$i; $server_str="server".$i;
		    }
			
//д���ݿ�
 
$article_title=msubstr(trim($article_title),0,100);
$content=addslashes($body);
$jump_url=msubstr(trim($jump_url),0,100);
$read_times=trim($read_times);
$post_time=$post_time==""?date("y-m-d H:i:s"):$post_time;
$top=trim($top); 
$keywords=strip_tags(msubstr(trim($keywords),0,60));
$abstract=strip_tags(msubstr(trim($abstract),0,250));
$similar_id=strip_tags(msubstr(trim($similar_id),0,250));

if($top) $top_time=$post_time; else $top_time="00-00-00 00:00:00";
$poster=$_SESSION['admin_valid'];
$last_ip=$ip;
$soft_from=$source_input;

$query="insert into ".$table_suffix."soft
 (class_id,article_title,file_type,file_lang,soft_type,soft_right,os,top,official_url,official_demo,file_links,content,read_times,poster,post_time,new_or_not_time,recommend_time,show_attribute_time,saved_url,top_time,locked,similar_id,hide_type,title_bold,title_color,recommend,comment_or_not,checked,keywords,abstract,new_or_not,soft_from,jump_url,show_attribute,soft_level,refer_url,template)
 values
 ('$class_id','$article_title','$file_type','$file_lang','$soft_type','$soft_right','$os','$top','$official_url','$official_demo','$url','$content','$read_times','$poster','$post_time','$post_time','$post_time','$post_time','$rurl','$top_time','$locked','$similar_id','$hide_type','$title_bold','$title_color','$recommend','$comment_or_not','$checked','$keywords','$abstract','$new_or_not','$soft_from','$jump_url','$show_attribute','$soft_level','$refer_url','$template')";

$result=mysql_query($query);

//��������
$object_id=@mysql_insert_id();
$infor_class="soft";
$query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
($object_id,$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query);

require_once(dirname(__FILE__)."/image_action.php"); //д��ͼƬ

if($result) ShowMsg("����ɹ�,���Զ�������Ӧ��Ŀ��","../content_list.php?class_id={$class_id}&infor_class=soft&class_name={$class_name}");
else  ShowMsg("���Ϸ���ʧ��,��������","-1");

 }
else {
  ShowMsg("����ʧ�ܻ���Ч�ķ��ʣ�","-1");
  exit(); 
  }
?>
