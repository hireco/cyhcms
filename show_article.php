<?php 
 session_start();
 require_once("setting.php");
 require_once(dirname(__FILE__)."/config/base_cfg.php");
 require_once(dirname(__FILE__)."/inc/show_msg.php");
 require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
 ?>
<?php  
  $id=$_REQUEST['id'];
  $article_id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."article where id=$article_id and hide_type='0'";
  $result=mysql_query($query);
  $num_of_article=@mysql_num_rows($result); 
  $row=mysql_fetch_object($result);  
  $infor_class="article";
  $class_id=$row->class_id;
  $article_title=$row->article_title;
  $keywords=$row->keywords;
  $abstract=$row->abstract; 
  
  if($row->template<>"")  $template_file="template/article/".$row->template;
  else $template_file="template/article/default.php";
  
  if(is_file($template_file)) require_once($template_file);
  else echo "对不起，模板加载失败！";
?>