<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://iask.sina.com.cn/b/14938688.html -->
<HTML><HEAD><TITLE>选择问题的答案 博学知识人</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK href="style/zhishib.css" type=text/css rel=stylesheet>
<LINK href="style/z2.css" type=text/css rel=stylesheet>
<LINK href="style/grzx_v2.css" type=text/css rel=stylesheet>
<LINK href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3492" name=GENERATOR></HEAD>
<BODY>
<?php 
 require_once("../config/base_cfg.php");
 require_once("../config/auto_set.php");
 require_once("include/showmsg.php");
 require_once("../".$cfg_admin_root."scripts/constant.php"); 
 require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
 if(isset($_SESSION['user_name'])) {
  if(isset($_POST['set_submit'])){
    showmsg("成功的设置最佳答案","set_best_ok"); 
    showmsg("设置最佳答案失败","set_best_false");
    $answer_comment=strip_tags($_POST['answer_comment']);
	$star_num=$_POST['star_num'];
	$done_time=date("y-m-d H:i:s");
	
	$query="select question_id from  ".$table_suffix."ask_answer where id={$_POST['answer_id']}";
	$question_id=mysql_result(mysql_query($query),0,"question_id");
	
	$query="update  ".$table_suffix."ask set answer_comment='$answer_comment', star_num=$star_num, finished='1',done_time='$done_time'
	where id=$question_id and poster='{$_SESSION['user_name']}'	";
    $result=mysql_query($query);
	
	if($result){
	$query="select score from ".$table_suffix."ask where  id=$question_id";
	$score=mysql_result(mysql_query($query),0,"score");
	
	$query="update  ".$table_suffix."ask_answer set accept='0',score=0 where question_id=$question_id";
	$result=mysql_query($query);
	
	$query="update  ".$table_suffix."ask_answer set accept='1',score=$score where question_id=$question_id and id={$_REQUEST['id']}";
	$result=mysql_query($query);
	if($result)	echo "<script>document.getElementById('set_best_ok').style.display='block';</script>";
    else  echo "<script>document.getElementById('set_best_false').style.display='block';</script>";
	}
	else  echo "<script>document.getElementById('set_best_false').style.display='block';</script>";
  }
  
  $query="select * from ".$table_suffix."ask_answer where id={$_REQUEST['id']}";
  $result_a=mysql_query($query);
  if($row_answer=mysql_fetch_object($result_a)) { 
   $poster=$row_answer->poster;
   $query="select * from  ".$table_suffix."member where user_name='{$poster}'";
   $result_poster=mysql_query($query);
   $row_poster=mysql_fetch_object($result_poster);  
   $img_default="user.files/120_1570632011.gif";
   $sample_pic=$row_poster->pic_checked=='1'?(empty($row_poster->sample_pic)?$img_default:$row_poster->sample_pic):$img_default;
   
   $question_id=$row_answer->question_id;
   $query="select * from ".$table_suffix."ask where id=$question_id";
   $result_q=mysql_query($query);
   if($row_question=mysql_fetch_object($result_q)) { 
    if($row_question->poster==$_SESSION['user_name']) {
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="10">
<FORM name=form_a method=post>
  <tr>
    <td colspan="2" valign="top">
<DIV class=cl_ans2>
<DIV class=ans_t3>
<DIV class=fl></DIV>
</DIV>
<DIV class=qus_c2>
<DIV class=usr_info>
<DIV class=wpb5><A class=c7f 
href="user_infor.php?user_id=<?=$row_poster->id?>" target=_blank><IMG width=70%
class=img1 src=<?=$sample_pic?> align=absMiddle><BR>
  <?=$row_poster->nick_name?></A><BR>[<?=$mem_level[$row_poster->user_level]?>] </DIV></DIV>
<DIV class=usr_qus>
<DIV class=pb5>
<?=$row_answer->content?>
</DIV>
<DIV class=twsj>回答：<SPAN class=ar>20<?=$row_answer->post_time?></SPAN></DIV>
</DIV>
</DIV>
</DIV>	
	</td>
    </tr>
  <tr>
    <td width="100" valign="top">评价该答案</td>
    <td width="85%" valign="top"><textarea name="answer_comment" cols=30 rows=9 ></textarea></td>
  </tr>
  <tr>
    <td valign="top">答案满意度</td>
    <td valign="top"><input name="star_num" type="radio" value="1" checked>
      一颗星
        <input type="radio" name="star_num" value="2">
        两颗星
        <input type="radio" name="star_num" value="3">
        三颗星
        <input type="radio" name="star_num" value="4">
        四颗星
        <input type="radio" name="star_num" value="5">
      五颗星</td>
  </tr>
  <tr>
    <td>确定并提交</td>
    <td><input type="hidden" name="answer_id" value="<?=$_REQUEST['id']?>">
	    <input type="submit" name="set_submit" value="提  交" onClick="return check_form();"></td>
  </tr>
  </form>
</table>
   <?php   } else show_message("对不起，您没有权限",-1);
       }
     else show_message("对不起，该问题不存在",-1);
   } 
  else show_message("该问题答案不存在",-1);
} else show_message("没有权限，请先登录",-1);
?>
</body></html>
<script>
function check_form() {

}
</script>