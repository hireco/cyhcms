<?php 
    session_start(); 
    require_once(dirname(__FILE__)."/../config/base_cfg.php");
    require_once(dirname(__FILE__)."/../inc/show_msg.php"); 
	require_once(dirname(__FILE__)."/../inc/main_fun.php");
    require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
 if(isset($_SESSION['user_name'])) { 
	if(isset($_POST['reply_liuyan'])) {
    $query="select * from ".$table_suffix."member_guestbook where id={$_POST['infor_id']} and to_user_name='{$_SESSION['user_name']}'";
	$result=mysql_query($query);
    if($row=mysql_fetch_object($result)){
	
	$content=trim(strip_tags($_POST['content']));
	$infor_title=msubstr(trim(strip_tags($_POST['infor_title'])),0,100);
	$post_time=date("y-m-d H:i:s");
	$post_ip=$ip;
	$hide="0";
	$to_user_name=$row->from_user_name;
	$whisper=$row->whisper;
	
	if($to_user_name==$_SESSION['user_name'])   { ShowMsg("对不起,不能回复自己","-1"); echo "<br>";  exit; }
	$person=$_SESSION['nick_name']; $from_user_name=$_SESSION['user_name']; 
	
	$result=mysql_query("select black_list from ".$table_suffix."member where user_name='{$to_user_name}'");
	$black_list=mysql_result($result,0,"black_list");
	$black_list=explode(",",$black_list); 
	if(in_array($_SESSION['user_id'],$black_list))  { ShowMsg("抱歉,对方已经屏蔽了您的信件",-1); echo "<br>";  exit;}
	
	if(empty($content))   { ShowMsg("对不起,您的回复内容丢失或为空白","-1");  echo "<br>";   exit; 	 }
	
    
	$query="insert into  ".$table_suffix."member_guestbook 
	(infor_title, content,to_user_name,person, from_user_name,post_time,post_ip,hide,whisper) 
	 values 
	('$infor_title','$content','$to_user_name','$person','$from_user_name','$post_time','$post_ip','$hide','$whisper')";
    
	$result=mysql_query($query); 
	if($result) $result=mysql_query("update ".$table_suffix."member_guestbook set replied='1' where id={$_POST['infor_id']} and to_user_name='{$_SESSION['user_name']}'");
    if($result)  { ShowMsg("恭喜您,您的回复已经提交","-1");  echo "<br>";  exit; }
     
	} else { ShowMsg("对不起,您要回复的对象不存在!","-1");  echo "<br>";  exit; }
  }  else { ShowMsg("您的访问来路不明或出错!","-1");  echo "<br>";  exit; }
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>