<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<?php 
  $id=$_REQUEST['id'];
  $ftp_id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."ftp where id=$ftp_id and hide_type='0'";
  $result=mysql_query($query);
  $num_of_ftp=@mysql_num_rows($result);
  $row=mysql_fetch_object($result);  
  $infor_class="ftp";
  $class_id=$row->class_id;
  $article_title=$row->article_title;
  $keywords=$row->keywords;
  $abstract=$row->abstract;
  
  if($row->template<>"")  $template_file="template/ftp/".$row->template;
  else $template_file="template/ftp/default.php";
  
  if(is_file($template_file)) require_once($template_file);
  else echo "对不起，模板加载失败！";
?>