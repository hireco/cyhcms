<META http-equiv=Content-Type content="text/html; charset=gb2312">
<?php 
     session_start(); 
	 require_once("../dbscripts/db_connect.php"); 
     require_once("../inc/show_msg.php");
	 require_once("../inc/main_fun.php"); 
	 require_once("../file_do/pic_upload.php");
	 require_once("../config/auto_set.php");
	 require_once("../config/base_cfg.php");
	 
	 $flag_suc=1;
	 
	 if(!isset($_SESSION['user_name'])) {
	   if(isset($_POST['user_name'])&&(isset($_POST['user_pass'])))
	   {  
	     if(empty($_POST['user_name'])||empty($_POST['user_pass']))  $flag_suc=0;
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
			   }
		     else  $flag_suc=0;
			 }
		  else $flag_suc=0;
		 }
	   }
	  else   $flag_suc=0;
   } 
   
   if(!$flag_suc)  { 
   echo "<script>  
    window.parent.document.form_a.user_name.value=\"\";
    window.parent.document.form_a.user_pass.value=\"\";
	window.parent.document.getElementById('login_false').style.display='block';  
	</script>"; 
   exit; 
   }
   
    $query="select * from  ".$table_suffix."ask where id={$_POST['question_id']} and finished='0'";
   
   $question_result=mysql_query($query);
   if(!mysql_num_rows($question_result)) { 
   echo "<script>  
    window.parent.document.getElementById('id_false').style.display='block';  
	</script>"; 
   exit; 
   } 
   
   $ask_poster=mysql_result($question_result,0,"poster");
   if($ask_poster==$_SESSION['user_name']) {
    echo "<script>  
    window.parent.document.getElementById('answer_self').style.display='block';  
	</script>"; 
   exit; 
   }
   
   $answer=strip_tags($_POST['answer']);
   
   if($_POST['pic_to_up']=="1") {
   $upload_child_dir=$cfg_img_root;
   $dir_relate="../";
   $imgurl=image_upload($dir_relate,$upload_child_dir,"img_upload","","");
   
   $answer=$answer."<br>相关图片：<br><img src=".$imgurl." width=400>";
   
   }
   
   
   $poster=$_SESSION['user_name'];
   $post_time=date("y-m-d H:i:s");
   $score=$_POST['score']; 
   
   $query="insert into ".$table_suffix."ask_answer (question_id, content,poster,post_time) values
   ('{$_POST['question_id']}', '$answer','$poster','$post_time')";
   
   $result=mysql_query($query);
   
   $query="update  ".$table_suffix."ask set daan_num=daan_num+1 where id={$_POST['question_id']} and finished='0'";
   
   if($result) $result=mysql_query($query);
   
   if($result) echo "
	 <script>
	 window.parent.document.getElementById('answer_ok').style.display='block';
	 window.parent.document.form_a.reset();
	 </script>"; 
	else echo "<script>window.parent.document.getElementById('answer_false').style.display='block'</script>";
?>