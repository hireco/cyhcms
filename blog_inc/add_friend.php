<?php session_start(); ?>
<?php require_once("../config/base_cfg.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php require_once("../dbscripts/db_connect.php"); ?>
<?php require_once("../config/auto_set.php");?>
<?php require_once("../inc/hometown.php");?>
<?php require_once("../inc/show_msg.php");?>
<?php require_once("../inc/main_fun.php"); ?>
<?php 
  if(!isset($_SESSION['user_name']))   ShowMsg("����û�е�¼,���ȵ�¼�ٲ���!",-1);
  else{ 
    if(isset($_REQUEST['host_id'])) {
	 if(empty($_REQUEST['host_id']))  ShowMsg("���󲻴���!",-1);
	 elseif($_REQUEST['host_id']==$_SESSION['user_id'])  ShowMsg("���ܼ��Լ�Ϊ����!",-1); 
	 else {
      $query="select * from ".$table_suffix."member  where id={$_REQUEST['host_id']}";
	  $host_name=mysql_result(mysql_query($query),0,"user_name"); 
	  $host_nick=mysql_result(mysql_query($query),0,"nick_name");
     
	  if(md5($host_name)<>$_REQUEST['idkey'])  ShowMsg("�Բ���,����ķ���",-1); 
      else { 
       $result=mysql_query("select friend_list,black_list from ".$table_suffix."member where user_name='{$_SESSION['user_name']}'");
	   $friend_list=mysql_result($result,0,"friend_list");
	   $black_list=mysql_result($result,0,"black_list");
	   if($friend_list) {
		$friend_list=explode(",",$friend_list);
		$black_list=explode(",",$black_list);
		if(in_array($_REQUEST['host_id'],$black_list))  { ShowMsg("���Ƚ�".$host_nick."�����ĺ�������ȥ��",-1); exit;}
		if(in_array($_REQUEST['host_id'],$friend_list))  { ShowMsg($host_nick."�Ѿ������ĺ���",-1); exit;}
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
       if($result)  ShowMsg("��ϲ,�ɹ���".$host_nick."Ϊ����!",-1); 
	   else  ShowMsg("�Բ���,����û�гɹ�,������!",-1); 
	   
	   }
	 }
   }
  else  ShowMsg("�Բ���,����Ĳ�������!",-1); 
 }
?>