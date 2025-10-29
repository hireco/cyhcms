<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<?php 
  $id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."album where id=$id and hide_type='0'";
  $result=mysql_query($query);
  $row=mysql_fetch_object($result);
  $article_title=$row->article_title;
  $keywords=$row->keywords;
  $abstract=$row->abstract;
  $result_class=mysql_query("select class_name,id from  ".$table_suffix."infor where id={$row->class_id}");
  $class_name=mysql_result($result_class,0,"class_name");
  $infor_class="album";
  $class_id=mysql_result($result_class,0,"id");
  $query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$id}";
  $result_picture=mysql_query($query); 
  
  if($row->template<>"")  $template_file="template/album/".$row->template;
  else $template_file="template/album/default.php";
  
  if(is_file($template_file)) require_once($template_file);
  else echo "对不起，模板加载失败！";
  
?>