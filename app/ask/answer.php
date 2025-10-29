<?php 
 require_once("../config/base_cfg.php");
 require_once("../config/auto_set.php");
 require_once("include/showmsg.php");
 require_once("../".$cfg_admin_root."scripts/constant.php"); 
 require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
  $query="select * from ".$table_suffix."ask_answer where id={$_REQUEST['id']}";
  $result_a=mysql_query($query);
  if($row_answer=mysql_fetch_object($result_a)) { 
   $answer_poster=$row_answer->poster;
   $query="select * from  ".$table_suffix."member where user_name='{$answer_poster}'";
   $result_poster_a=mysql_query($query);
   $row_poster_a=mysql_fetch_object($result_poster_a);  
   $img_default="user.files/120_1570632011.gif";
   $sample_pic_a=$row_poster_a->pic_checked=='1'?(empty($row_poster_a->sample_pic)?$img_default:$row_poster_a->sample_pic):$img_default;
   
   $question_id=$row_answer->question_id;
   $query="select * from ".$table_suffix."ask where id=$question_id";
   $result_q=mysql_query($query);
   if($row_question=mysql_fetch_object($result_q)) { 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://iask.sina.com.cn/b/14938688.html -->
<HTML><HEAD><TITLE>您对问题"<?=$row_question->question?>"给出的答案 博学知识人</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK href="style/zhishib.css" type=text/css rel=stylesheet>
<LINK href="style/z2.css" type=text/css rel=stylesheet>
<LINK href="style/grzx_v2.css" type=text/css rel=stylesheet>
<LINK href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3492" name=GENERATOR></HEAD>
<BODY>
<!---问题内容--------------------------------------------------->
<?php 
   $question_poster=$row_question->poster;
   $query="select * from  ".$table_suffix."member where user_name='{$question_poster}'";
   $result_poster_q=mysql_query($query);
   $row_poster_q=mysql_fetch_object($result_poster_q);  
   $img_default="user.files/120_1570632011.gif";
   $sample_pic_q=$row_poster_q->pic_checked=='1'?(empty($row_poster_q->sample_pic)?$img_default:$row_poster_q->sample_pic):$img_default;
   
   $query="select * from  ".$table_suffix."ask_answer where question_id={$row_question->id} order by accept desc, post_time desc";
   $result_answer=mysql_query($query);
   $num_of_answer=mysql_num_rows($result_answer);
?>
<DIV class=cl_qus>
<DIV class=qus_t>
<DIV class="f14 fl"><STRONG>问题:<?=$row_question->question?></STRONG></DIV>
<DIV class=cr></DIV></DIV>
<DIV class=qusi><IMG alt=问题logo src="question.files/ques.gif"></DIV>
<DIV class=qus_c>
<DIV class=usr_info>
<DIV class=wpb5><A class=c7f 
href="user_infor.php?user_id=<?=$row_poster_q->id?>" target=_blank><IMG width=70%
class=img1 src=<?=$sample_pic_q?> align=absMiddle><BR><?=$row_poster_q->nick_name?></A><BR>[<?=$mem_level[$row_poster_q->user_level]?>]</DIV></DIV>
<DIV class=usr_qus><IMG alt=问题 src="index.files/zt_<?=$row_question->finished=="0"?"jjz":"yjj"?>.gif" align=absMiddle> 
<STRONG><?=$row_question->question?></STRONG> <SPAN id=zsqprize><IMG src="question.files/money.gif" 
align=absMiddle><STRONG class=o><?=$row_question->score?>分</STRONG></SPAN>
 
<DIV class=twsj style="TEXT-ALIGN: left">回答：<?=$num_of_answer?> &nbsp; 浏览：<?=$row_question->read_times?> &nbsp; 提问时间：<SPAN 
class=ar>20<?=$row_question->post_time?></SPAN></DIV>
<DIV class=pb5><?=$row_question->question_content?></DIV>
</DIV>
<DIV class=cb></DIV></DIV></DIV>

<!---您给出的答案--------------------------------------------------->
<DIV class=cl_ans2>
<DIV class=ans_t3>
<DIV class=fl><strong>您的回答:</strong></DIV>
<?php if($_SESSION['user_name']==$answer_poster) {?>
<DIV class="plsz">
<a href="amend_answer.php?id=<?=$_REQUEST['id']?>" class="c9,c6nul" id=<?=$_REQUEST['id']?>>补充内容</a>
</DIV>
<?php } ?>
</DIV>
<DIV class=qus_c2>
<DIV class=usr_info>
<DIV class=wpb5><A class=c7f 
href="user_infor.php?user_id=<?=$row_poster_a->id?>" target=_blank><IMG width=70%
class=img1 src=<?=$sample_pic_a?> align=absMiddle><BR>
  <?=$row_poster_a->nick_name?></A><BR>[<?=$mem_level[$row_poster_a->user_level]?>] </DIV></DIV>
<DIV class=usr_qus>
<DIV class=pb5>
<?=$row_answer->content?>
</DIV>
<DIV class=twsj>回答时间：<SPAN class=ar>20<?=$row_answer->post_time?></SPAN></DIV>
</DIV>
</DIV>
</DIV>
</body></html>
   <?php        }
     else show_message("对不起，该问题不存在",-1);
   } 
  else show_message("该问题答案不存在",-1);
?>