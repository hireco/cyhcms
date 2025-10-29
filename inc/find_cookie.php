<?php 
//GET THE IP ADDRESS OF THE VISITORS
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
    $ip = getenv('HTTP_CLIENT_IP');} 
    
    elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');} 
    
    elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
    $ip = getenv('REMOTE_ADDR');} 
    
    elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
    $ip = $_SERVER['REMOTE_ADDR'];}
	
if(!isset($_SESSION['user_name'])) {
 if(isset($_COOKIE['user_name'])&&isset($_COOKIE['user_pass'])) {
   $query="select * from ".$table_suffix."member where user_name='{$_COOKIE['user_name']}' and user_pass='{$_COOKIE['user_pass']}'";
   $result=mysql_query($query);
   if($row=mysql_fetch_object($result)) {
     session_register("user_id","user_name","user_pass","nick_name","last_ip","last_time","login_times","user_level","user_score");
	 $_SESSION['user_id']=$row->id;
	 $_SESSION['user_name']=$row->user_name;
	 $_SESSION['user_pass']=$row->user_pass;
	 $_SESSION['nick_name']=$row->nick_name;
	 $_SESSION['last_ip']=$row->last_ip;
	 $_SESSION['last_time']=$row->last_time;
	 $_SESSION['login_times']=1+$row->login_times;
	 $_SESSION['user_level']=$row->user_level;
	 $_SESSION['user_score']=$row->score;
				 
	 $last_time=date("y-m-d H:i:s"); 
	 mysql_query("update ".$table_suffix."member set login_times=login_times+1,last_ip='$ip',last_time='$last_time' where user_name='{$_COOKIE['user_name']}'");
    }
 }
} 
?>