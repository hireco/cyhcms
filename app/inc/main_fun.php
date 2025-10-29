<?php 
 require_once(dirname(__FILE__)."/often_function.php");
//GET THE IP ADDRESS OF THE VISITORS
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
    $ip = getenv('HTTP_CLIENT_IP');} 
    
    elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');} 
    
    elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
    $ip = getenv('REMOTE_ADDR');} 
    
    elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
    $ip = $_SERVER['REMOTE_ADDR'];}

function msubstr($str, $start, $len) {
 $tmpstr = "";
 $strlen = $start + $len;
 for($i = 0; $i < $strlen; $i++) {
 if(ord(substr($str, $i, 1)) > 0xa0) {
  $tmpstr .= substr($str, $i, 2);
   $i++;
  } else
 $tmpstr .= substr($str, $i, 1);
 }
 return $tmpstr;
}

//评论的回复模式的获取
function comment_reply_mode($content,$user_type,$person,$face,$post_ip,$post_time,$flag) { 
      global $cfg_mainsite; 
	  if($flag=="") {
   ?>
   <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><font color=blue><?php if($user_type=="a")  echo "匿名"; elseif($user_type=="s") echo "管理员"; else echo "注册用户"; ?>： <strong><?=$person;?></strong></font> <img src="<?=$cfg_mainsite?>image/face/<?=$face?>.gif" align="absmiddle"> IP：<?=$post_ip;?></td>
                      <td> <div align="right"><?=$post_time;?> 发表</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF">				  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td>
   <?php }	    
	$content=stripslashes($content);
	$person1="<table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#CCCCCC\"><tr><td bgcolor=\"#FFF8F5\"><!-comment-><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"2\"><tr><td><div align=\"right\">评论人："; 
	$content=ereg_replace("<!-person1->",$person1,$content);
	
	$person2="</div></td>"; 
	$content=ereg_replace("<!-person2->",$person2,$content);
	
	$ip1="<td><div align=\"right\">IP："; 
	$content=ereg_replace("<!-ip1->",$ip1,$content);
	
	$ip2="</div></td>"; 
	$content=ereg_replace("<!-ip2->",$ip2,$content);
	
	$time1="<td><div align=\"right\">时间："; 
	$content=ereg_replace("<!-time1->",$time1,$content);
	
	$time2="</div></td>"; 
	$content=ereg_replace("<!-time2->",$time2,$content);
	
	$content1="</tr><tr><td colspan=\"3\">"; 
	$content=ereg_replace("<!-content1->",$content1,$content);
	
	$content2="</td></tr></table></td></tr></table>"; 
	$content=ereg_replace("<!-content2->",$content2,$content);
	
	$content=ereg_replace("<!-face"," <img src=\"".$cfg_mainsite."image/face/",$content);
	$content=ereg_replace("face->",".gif\" align=\"absmiddle\">",$content);
	echo $content; 
	if($flag=="") { ?>
	</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
	<?php }
   }
 
//评论内容的数据库格式转换  
  function comment_sql_mode($person,$face,$post_ip,$post_time,$content) {
    return "<!-person1->"."$person"."<!-face"."$face"."face-><!-person2->
                              <!-ip1->"."$post_ip"."<!-ip2->
                              <!-time1->"."$post_time"."<!-time2->
                              <!-content1->"."$content"."<!-content2->";
  }
  
 function date_of_week($i) {
     $week[1]="Mon";
	 $week[2]="Tue";
	 $week[3]="Wen";
	 $week[4]="Thu";
	 $week[5]="Fri";
	 $week[6]="Sat";
	 $week[7]="Sun";
	 return $week[$i];
 } 
?>

