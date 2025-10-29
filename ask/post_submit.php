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
    window.parent.document.form_q.user_name.value=\"\";
    window.parent.document.form_q.user_pass.value=\"\";
	window.parent.document.getElementById('login_false').style.display='block';  
	</script>"; 
   exit; 
   }
   
   $question=msubstr(strip_tags(trim($_POST['question'])),0,100);
   $question_content=strip_tags($_POST['question_content']);
   
   if($_POST['pic_to_up']=="1") {
   $upload_child_dir=$cfg_img_root;
   $dir_relate="../";
   $imgurl=image_upload($dir_relate,$upload_child_dir,"img_upload","","");
   
   $question_content=$question_content."<br>œ‡πÿÕº∆¨£∫<br><img src=".$imgurl." width=400>";
   
   }
   
   $chapter=$_POST['chapter'];
   $section=$_POST['section'];
   $points=$_POST['allpoint'];
   $end_time=$_POST['end_time'];
   $poster=$_SESSION['user_name'];
   $post_time=date("y-m-d H:i:s");
   $score=$_POST['score']; 
   
   $query="select part_name from  ".$table_suffix."chapter  where chapter_name='{$chapter}'";
   $part=mysql_result(mysql_query($query),0,"part_name");
   
   $query="insert into ".$table_suffix."ask (part,chapter, section, points, question, question_content,poster,post_time,score, end_time) values
   ('$part','$chapter','$section','$points','$question','$question_content','$poster','$post_time','$score','$end_time') ";
    
   $result=mysql_query($query);
   if($result) echo "
	 <script>
	 window.parent.document.getElementById('ask_true').style.display='block';
	 window.parent.document.form_q.reset();
	 </script>"; 
	else echo "<script>window.parent.document.getElementById('ask_false').style.display='block'</script>";
?>

