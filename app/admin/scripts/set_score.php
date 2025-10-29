<?php 
 if(isset($_SESSION['root'])) {
 $query="select user_name from ".$table_suffix."ask_score where id={$temp2}";
 $result=mysql_query($query);
 $user_name_i=mysql_result($result,0,"user_name");
 
 $result_get=mysql_query("select score from  ".$table_suffix."ask_answer where accept='1' and poster='{$user_name_i}'");
 $result_put=mysql_query("select score from  ".$table_suffix."ask where finished='1' and poster='{$user_name_i}'");
 
 $score_get=300; 
 $score_put=0;
 $last_time=date("y-m-d H:i:s");
   
 while($row=mysql_fetch_object($result_get))  $score_get=$row->score+$score_get;
 while($row=mysql_fetch_object($result_put))  $score_put=$row->score+$score_put;
 
 $result=mysql_query("update  ".$table_suffix."ask_score set income=$score_get, payout=$score_put,last_time='{$last_time}' where user_name='{$user_name_i}'");
 }
?>