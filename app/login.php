<?php session_start(); 
	   require_once("dbscripts/db_connect.php"); 
       require_once("inc/show_msg.php");
	   require_once("inc/main_fun.php"); 
	   if(isset($_POST['user_name'])&&(isset($_POST['user_pass'])))
	   {  
	     if(empty($_POST['user_name'])||empty($_POST['user_pass'])) ShowMsg("±§Ç¸£¬´íÎóµÄµÇÂ¼£¡",-1);
		 else {
		  $result=mysql_query("select * from ".$table_suffix."member where user_name='{$_POST['user_name']}' and user_pass='{$_POST['user_pass']}'");
		  if($row=mysql_fetch_object($result))   
		    { 
		     $user_name=$row->user_name;
			 $user_pass=$row->user_pass;
			 $nick_name=$row->nick_name; 
			 $user_id=$row->id;
			 if(($user_name==$_POST['user_name'])&&($user_pass==$_POST['user_pass'])) 
			   { 
			     session_register("user_id","user_name","user_pass","nick_name","last_ip","last_time","login_times","user_level","user_score");
				 $_SESSION['user_id']=$user_id;
				 $_SESSION['user_name']=$user_name;
				 $_SESSION['user_pass']=$user_pass;
				 $_SESSION['nick_name']=$nick_name;
				 $_SESSION['last_ip']=$row->last_ip;
				 $_SESSION['last_time']=$row->last_time;
				 $_SESSION['login_times']=1+$row->login_times;
				 $_SESSION['user_level']=$row->user_level;
				 $_SESSION['user_score']=$row->score;
				 
				 $last_time=date("y-m-d H:i:s"); 
				 mysql_query("update ".$table_suffix."member set login_times=login_times+1,last_ip='$ip',last_time='$last_time' where user_name='{$_POST['user_name']}'");
			     
				 if($_POST['savelogin']=="1"){  
				 setcookie("user_name",$user_name,time()+3600*24*365); 
				 setcookie("user_pass",$user_pass,time()+3600*24*365);
		          }
				  
				 ShowMsg("³É¹¦µÇÂ¼£¬ÕýÔÚÌø×ª...",$_REQUEST['to_go']);
			   }
		     else ShowMsg("±§Ç¸£¬´íÎóµÄµÇÂ¼£¡",-1);
			 }
		  else ShowMsg("±§Ç¸£¬´íÎóµÄµÇÂ¼£¡",-1);
		 }
	   }
	  else   ShowMsg("±§Ç¸£¬´íÎóµÄµÇÂ¼£¡",-1);
?>
