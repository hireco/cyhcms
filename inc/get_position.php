<?php  
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  function class_position($class_id,$upper_class_id,$class_level,$out_string) {
    global $table_suffix;
	if(($upper_class_id==0)||($class_level=="0")) {
	  $query="select class_name,infor_class from ".$table_suffix."infor where id={$class_id}";
	  $class_name=mysql_result(mysql_query($query),0,"class_name");
	  $infor_class=mysql_result(mysql_query($query),0,"infor_class");
	  return  " > <a href=\"$infor_class.php?class_id=$class_id\">$class_name</a> ".$out_string;
	  }
	 else {
	  $query="select class_name,infor_class from ".$table_suffix."infor where id={$class_id}";
	  $class_name=mysql_result(mysql_query($query),0,"class_name");
	  $infor_class=mysql_result(mysql_query($query),0,"infor_class");
	  $out_string_next="> <a href=\"$infor_class.php?class_id=$class_id\">$class_name</a> ".$out_string;
	  
	  $class_id_next=$upper_class_id;
	  $query="select class_level,upper_class_id from ".$table_suffix."infor where id={$class_id_next}";
	  $class_level_next=mysql_result(mysql_query($query),0,"class_level");
	  $upper_class_id_next=mysql_result(mysql_query($query),0,"upper_class_id");
	  
	  return class_position($class_id_next,$upper_class_id_next,$class_level_next,$out_string_next);
	 } 
  }

   if(isset($class_id))  { 
    $query_class_position="select class_level,upper_class_id from ".$table_suffix."infor where id={$class_id}";
	$class_level=mysql_result(mysql_query($query_class_position),0,"class_level");
	$upper_class_id=mysql_result(mysql_query($query_class_position),0,"upper_class_id");
    echo class_position($class_id,$upper_class_id,$class_level,"");
   }  
   
   if(isset($article_title))    echo " > ".$article_title;
    
?>