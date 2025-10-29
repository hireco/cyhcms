<?php 
    session_start();require_once(dirname(__FILE__)."/../config/base_cfg.php");
    require_once(dirname(__FILE__)."/show_msg.php"); 
	require_once(dirname(__FILE__)."/main_fun.php");
    require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>回复评论</title>
<meta name="keywords" content="回复评论" />
<meta name="description" content="回复评论" />
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
	if(isset($_POST['submit_comment'])) {  
    if(($_SESSION['input_string']<>$_POST['check_input'])||(!isset($_SESSION['input_string']))) 
	{ ShowMsg("对不起,您的评论被取消","-1");   
      exit;
	 }
	 
	$person=trim($_POST['person']);
	$content=msubstr(trim(strip_tags($_POST['content'])),0,500);
	$infor=$_POST['infor'];
	$infor_class=$_POST['infor_class'];
	$infor_id=$_POST['infor_id'];
	$post_time=date("y-m-d H:i:s");
	$post_ip=$ip;
	$hide="1";
	$comment_or_not="1";
	$face=$_POST['face'];
	
	$person_old=trim($_POST['person_old']);
	$content_old=msubstr(trim(strip_tags($_POST['content_old'])),0,500);
	$post_time_old=$_POST['post_time_old'];
	$post_ip_old=$_POST['post_ip_old'];
	$face_old=$_POST['face_old'];
	
	
	if(isset($_SESSION['root'])) { $user_type="s";  $hide="0"; } 
	if(isset($_SESSION['user_name'])&&($_SESSION['nick_name']==$_POST['person']))  
	$user_type="r"; else $user_type="a";
	
	if(empty($person)||empty($content))   { ShowMsg("对不起,您的评论内容丢失或为空白","-1");   exit; 	 }
	
	$query="select id from  ".$table_suffix.$infor_class."  where  id=$infor_id  and  class_id=$infor";
	if(!mysql_num_rows(mysql_query($query)))  { ShowMsg("对不起,您要评论的对象不存在","-1");   exit; 	 }
    
	if($_REQUEST['reply_mode']=="insert") {
	  $content_old=comment_sql_mode($person_old,$face_old,$post_ip_old,$post_time_old,$content_old);
	  $content_old=ereg_replace("<!-content2->","",$content_old);
	  $content_insert=comment_sql_mode($person,$face,$post,$post_time,$content);
	  $content_insert=ereg_replace("<!-content2->","",$content_insert);
	  $content_insert.=$content_old;
	  $query="select * from  ".$table_suffix."comment where id={$_REQUEST['id']}";
	  $row=mysql_fetch_object(mysql_query($query));
	  $content=$row->content;
	  $content=ereg_replace($content_old,$content_insert,$content);
	  $content=$content."<!-content2->";
	  $query="update ".$table_suffix."comment set
	   content='$content',
	   hide='1' where id={$_REQUEST['id']}
	   ";
     }
	 else {
	    $query="select * from  ".$table_suffix."comment where id={$_REQUEST['id']}";
		$row=mysql_fetch_object(mysql_query($query));
		$content_old=comment_sql_mode($row->person,$row->face,$row->post_ip,$row->post_time,$row->content);
		$content.=$content_old;		
		$query="update ".$table_suffix."comment set 
		person='$person',
		content='$content',
		post_time='$post_time',
		post_ip='$post_ip',
		comment_or_not='$comment_or_not',
		face='$face',
		user_type='$user_type',
		hide='$hide' where id={$_REQUEST['id']}			
		";	 
	  } 
	
	$result=mysql_query($query);
    if($result)  { ShowMsg("恭喜您,您的评论已经提交审核","-1");   exit; }
  } 
  elseif(!isset($_REQUEST['id']))  {ShowMsg("无效的访问",-1);  exit;}
  else { 
    if($_REQUEST['reply_mode']=="insert") { if(empty($_REQUEST['content']))  {ShowMsg("无效的访问",-1);  exit;} }
    $query="select * from  ".$table_suffix."comment where id={$_REQUEST['id']}";
	$result=mysql_query($query);
	if(!mysql_num_rows($result))   {ShowMsg("无效的访问",-1);  exit;}
	$row=mysql_fetch_object($result);
	
	if($_REQUEST['reply_mode']=="insert") { 
	  $content=$_REQUEST['content'];
	  $post_ip=$_REQUEST['post_ip'];
	  $person=$_REQUEST['person'];
	  $post_time=$_REQUEST['post_time'];
	  $face=$_REQUEST['face'];	  
	  }	 	 
	  
	  $infor=$row->infor;
	  $infor_id=$row->infor_id;
	  $infor_class=$row->infor_class;
	  
?>
<TABLE class=table height=30 cellSpacing=0 cellPadding=0 width="<?=$cfg_body_width?>" 
      align=center background=../image/detailtitle.gif border=0>
        <TBODY>
        <TR>
          <TD align=middle width=10></TD>
<TD>回复评论</TD>
        </TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="<?=$cfg_body_width?>" align=center border=0>
        <TBODY>
        <TR vAlign=top>
          <TD class=downintro colSpan=2><table width="100%"  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td valign="top">您要回复的评论是
                <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#EBEEF3">
                  <tr>
                    <td bgcolor="#FFFFFF">
					<?php 
					  if($_REQUEST['reply_mode']=="add")   
					    comment_reply_mode($row->content,$row->user_type,$row->person,$row->face,$row->post_ip,$row->post_time,""); 
					  else comment_reply_mode(comment_sql_mode($person,$face,$post_ip,$post_time,$content),"","","","","",1);
					?>
				   </td>
                  </tr>
                </table></td>
            </tr>
          </table>          
            <table width="<?=$cfg_body_width?>" border=0 
            align=center cellpadding=3 cellspacing=1 class=bbstable>
            <form  name="form" action="?reply_mode=<?=$_REQUEST['reply_mode']?>&id=<?=$_REQUEST['id']?>" method=post enctype=multipart/form-data>
              <tbody>
                <tr>
                  <td class=bbstitle align=middle width=80 height=25>评论人</td>
                  <td class=bbscon height=25>
				  <?php if(isset($_SESSION['root'])||isset($_SESSION['user_name'])) { 
				    if(isset($_SESSION['root']))           echo  $person=$_SESSION['writer_name']==""?"匿名的主人":$_SESSION['writer_name'];  
				    elseif(isset($_SESSION['user_name']))  echo  $person=$_SESSION['nick_name']; ?>
				  <input name="person" type="hidden" id="registered_name" value="<?=$person?>">
				  <?php } else { ?>
				  <input name=person id="annony_name"  size=20> 
				  您目前是匿名发表		<a href="../member.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" target="_self" style="text-decoration:underline">登录</a> | <a href="../register.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" style="text-decoration:underline"> 注册</a>
                  <?php }?>
				</td>
                </tr>
                <tr>
                  <td class=bbstitle align=middle width=80 height=25>评论内容</td>
                  <td class=bbscon height=25><textarea name=content cols=59 rows=9 id="content" style="BORDER-RIGHT: #a2a2a2 1px solid; BORDER-TOP: #a2a2a2 1px solid; BORDER-LEFT: #a2a2a2 1px solid; BORDER-BOTTOM: #a2a2a2 1px solid"></textarea>
                    <input name="infor_class" type="hidden" id="infor_class" value="<?=$infor_class?>">
                    <input name="infor" type="hidden" id="infor" value="<?=$infor?>">
                    <input name="infor_id" type="hidden" id="infor_id" value="<?=$infor_id?>">
                    <input name="content_old" type="hidden" id="content_old" value="<?=$content?>">
                    <input name="person_old" type="hidden" id="person_old" value="<?=$person?>">
                    <input name="post_ip_old" type="hidden" id="post_ip_old" value="<?=$post_ip?>">
                    <input name="post_time_old" type="hidden" id="post_time_old" value="<?=$post_time?>">
                    <input name="face_old" type="hidden" id="face_old" value="<?=$face?>"></td>
                </tr>
                <tr>
                  <td class=bbstitle align=middle width=80 height=25>表情图标</td>
                  <td class=bbscon height=25>
                    <table cellspacing=1 cellpadding=3 width=450 border=0>
                      <tbody>
                        <tr>
                          <td><input type=radio checked value=1 name=face>
                              <img 
                        src="../image/face/1.gif"> </td>
                          <td><input type=radio value=2 name=face>
                              <img 
                        src="../image/face/2.gif"> </td>
                          <td><input type=radio value=3 name=face>
                              <img 
                        src="../image/face/3.gif"> </td>
                          <td><input type=radio value=4 name=face>
                              <img 
                        src="../image/face/4.gif"> </td>
                          <td><input type=radio value=5 name=face>
                              <img 
                        src="../image/face/5.gif"> </td>
                          <td><input type=radio value=6 name=face>
                              <img 
                        src="../image/face/6.gif"> </td>
                          <td><input type=radio value=7 name=face>
                              <img 
                        src="../image/face/7.gif"> </td>
                          <td><input type=radio value=8 name=face>
                              <img 
                        src="../image/face/8.gif"> </td>
                        </tr>
                        <tr>
                          <td><input type=radio value=9 name=face>
                              <img 
                        src="../image/face/9.gif"> </td>
                          <td><input type=radio value=10 name=face>
                              <img 
                        src="../image/face/10.gif"> </td>
                          <td><input type=radio value=11 name=face>
                              <img 
                        src="../image/face/11.gif"> </td>
                          <td><input type=radio value=12 name=face>
                              <img 
                        src="../image/face/12.gif"> </td>
                          <td><input type=radio value=13 name=face>
                              <img 
                        src="../image/face/13.gif"> </td>
                          <td><input type=radio value=14 name=face>
                              <img 
                        src="../image/face/14.gif"> </td>
                          <td><input type=radio value=15 name=face>
                              <img 
                        src="../image/face/15.gif"> </td>
                          <td><input type=radio value=16 name=face>
                              <img 
                        src="../image/face/16.gif"> </td>
                        </tr>
                      </tbody>
                  </table>                  </td>
                </tr>
                <tr>
                  <td class=bbstitle align=middle width=80 height=25>输入验证</td>
                  <td class=bbscon height=25><?php require_once(dirname(__FILE__)."/../code_check/code.php");?></td>
                </tr>
                <tr>
                  <td class=bbstitle align=middle height=25>&nbsp;</td>
                  <td class=bbscon height=25><input name="submit_comment" type=submit class=button id="submit_comment7" value="提 交" onclick="return check_form();"></td>
                </tr>
            </form>
          </table></TD>
</TR></TABLE>
<?php } ?>
</body>
</html>
<script>
function check_form() {
   if(document.form.content.value=="") { 
     alert("内容不能为空白!");
	 document.form.content.focus();
	 return false;
    }
	
   if(document.code_check.form.check_code_hide.value!=hex_md5(document.code_check.form.check_code.value))
	{alert("验证码填写不对，如果看不清，请刷新！");
	 return false;
	} 
	
	else {
	 document.form.check_input.value=document.code_check.form.check_code.value;
	 return true;
	}
}
</script>
