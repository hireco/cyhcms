<?php session_start(); ?>
<?php require_once("../config/base_cfg.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php require_once("../dbscripts/db_connect.php"); ?>
<?php require_once("../config/auto_set.php");?>
<?php require_once("../inc/hometown.php");?>
<?php require_once("../inc/show_msg.php");?>
<?php require_once("../inc/main_fun.php"); ?>
<?php 
  if(!isset($_SESSION['user_name']))   ShowMsg("您还没有登录,请先登录再操作!",-1);
  else{ 
    if(isset($_REQUEST['host_id'])) {
	 if(empty($_REQUEST['host_id']))  ShowMsg("对象不存在!",-1);
	 elseif($_REQUEST['host_id']==$_SESSION['user_id'])  ShowMsg("不能加自己为好友!",-1); 
	 else {
      $query="select * from ".$table_suffix."member  where id={$_REQUEST['host_id']}";
	  $host_name=mysql_result(mysql_query($query),0,"user_name"); 
	  $host_nick=mysql_result(mysql_query($query),0,"nick_name");
     
	  if(md5($host_name)<>$_REQUEST['idkey'])  ShowMsg("对不起,错误的访问",-1); 
      else { 
       $result=mysql_query("select friend_list,black_list from ".$table_suffix."member where user_name='{$_SESSION['user_name']}'");
	   $friend_list=mysql_result($result,0,"friend_list");
	   $black_list=mysql_result($result,0,"black_list");
	   if($friend_list) {
		$friend_list=explode(",",$friend_list);
		$black_list=explode(",",$black_list);
		if(in_array($_REQUEST['host_id'],$black_list))  { ShowMsg("请先将".$host_nick."从您的黑名单中去掉",-1); exit;}
		if(in_array($_REQUEST['host_id'],$friend_list))  { ShowMsg($host_nick."已经是您的好友",-1); exit;}
		else { 
		$friend_list=implode(",",$friend_list);
		$friend_list=$friend_list.",".$_REQUEST['host_id']; 
	    $friend_list=explode(",",$friend_list);
	    $friend_list=array_unique($friend_list);
	    $friend_list=implode(",",$friend_list);
          } 
		}
	   else  $friend_list=$_REQUEST['host_id'];
	   
	   $result=mysql_query("update  ".$table_suffix."member set friend_list='$friend_list' where user_name='{$_SESSION['user_name']}'");
       if($result)  ShowMsg("恭喜,成功加".$host_nick."为好友!",-1); 
	   else  ShowMsg("对不起,操作没有成功,请重试!",-1); 
	   
	   }
	 }
   }
  else  ShowMsg("对不起,错误的操作对象!",-1); 
 }
?>