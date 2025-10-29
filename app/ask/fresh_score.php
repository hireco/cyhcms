<?php 
 require_once("../config/base_cfg.php");
 require_once("../config/auto_set.php");
 require_once("../".$cfg_admin_root."scripts/constant.php"); 
 require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
 if(isset($_SESSION['user_name'])) {
 $query="select * from ".$table_suffix."ask_score where user_name={$_SESSION['user_name']}";
 $result=mysql_query($query);
 $num_of_score=mysql_num_rows($result);
 
 if(!$num_of_score)    mysql_query("insert into  ".$table_suffix."ask_score  (user_name) values ('{$_SESSION['user_name']}')");
 
 $result_get=mysql_query("select score from  ".$table_suffix."ask_answer where accept='1' and poster='{$_SESSION['user_name']}'");
 $result_put=mysql_query("select score from  ".$table_suffix."ask where finished='1' and poster='{$_SESSION['user_name']}'");
 
 $score_get=300; 
 $score_put=0;
 $last_time=date("y-m-d H:i:s");
   
 while($row=mysql_fetch_object($result_get))  $score_get=$row->score+$score_get;
 while($row=mysql_fetch_object($result_put))  $score_put=$row->score+$score_put;
 
 $result=mysql_query("update  ".$table_suffix."ask_score set income=$score_get, payout=$score_put,last_time='{$last_time}' where user_name='{$_SESSION['user_name']}'");
 
 if($result) echo "<script> 
 window.parent.location.reload();
 </script>"; 
	    else echo "<script>window.parent.document.getElementById('score_false').style.display='block'</script>";
 }
else  echo "<script>window.parent.document.getElementById('score_false').style.display='block'</script>";
?>