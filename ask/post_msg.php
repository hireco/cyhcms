<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once("../inc/show_msg.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  if(!isset($_SESSION['user_name'])) require_once("login.php");
  else { 
    if(isset($_POST['submit_msg'])) {
	$content=trim(strip_tags($_POST['content']));
	$post_time=date("y-m-d H:i:s");
	$query="select user_name from ".$table_suffix."member where id={$_POST['msgtowho']}";
	$to_who=mysql_result(mysql_query($query),0,"user_name");
	if(!empty($to_who))
	$query="insert into ".$table_suffix."member_msg (content,user_name,post_time,to_who) values ('$content','{$_SESSION['user_name']}','$post_time','$to_who')";
	$result=mysql_query($query);
	if($result) echo "
	 <script>
	 window.parent.document.getElementById('msg_true').style.display='block';
	 window.parent.document.member_msg.content.value='';
	 </script>"; 
	else echo "<script>window.parent.document.getElementById('msg_false').style.display='block'</script>";
     }
    else ShowMsg("´íÎóµÄ·ÃÎÊ£¡",-1); 
  }
?>