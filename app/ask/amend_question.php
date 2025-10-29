<?php 
 require_once("../config/base_cfg.php");
 require_once("../config/auto_set.php");
 require_once("include/showmsg.php");
 require_once("../file_do/pic_upload.php");
 require_once("../".$cfg_admin_root."scripts/constant.php"); 
 require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
 if(isset($_SESSION['user_name'])) { 
  $query="select * from ".$table_suffix."ask where id={$_REQUEST['id']}";
  $result_q=mysql_query($query);
  if($row_question=mysql_fetch_object($result_q)) { 
   if($row_question->poster==$_SESSION['user_name']) {
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://iask.sina.com.cn/b/14938688.html -->
<HTML><HEAD><TITLE>修改问题"<?=$row_question->question?>" 博学知识人</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK href="style/zhishib.css" type=text/css rel=stylesheet>
<LINK href="style/z2.css" type=text/css rel=stylesheet>
<LINK href="style/grzx_v2.css" type=text/css rel=stylesheet>
<LINK href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3492" name=GENERATOR></HEAD>
<BODY>
<?php 
   showmsg("成功提交您的答案","question_ok");
   showmsg("提交失败，请重来","question_false");
?>
<DIV class=cl_qus>
<DIV class=qus_t>
<DIV class="f14 fl"><STRONG>问题:<?=$row_question->question?></STRONG></DIV>
<DIV class=cr></DIV></DIV>
<DIV class=qusi><IMG alt=问题logo src="question.files/ques.gif"></DIV>
<DIV class=qus_c>
<DIV class=usr_info>
<?php if(isset($_POST['amend_submit'])) { 
   
   $question=strip_tags($_POST['content']);
   
   if($_POST['pic_to_up']=="1") {
   $upload_child_dir=$cfg_img_root;
   $dir_relate="../";
   $imgurl=image_upload($dir_relate,$upload_child_dir,"img_upload","","");
   
   $question=$question."<br>相关图片：<br><img src=".$imgurl." width=400>";
   }
   
   $amend_time=date("y-m-d H:i:s");
   $question=$row_question->question_content."<br><br><br><strong>".$row_poster_q->nick_name."</strong> 在<font color=gray>20".$amend_time."</font>对此问题补充内容如下：<hr><br>".$question;
  
   $query="update  ".$table_suffix."ask set question_content='$question',amend='1',amend_time='$amend_time' where id={$_POST['question_id']} and poster='{$_SESSION['user_name']}'";
   
   $result=mysql_query($query);
   if($result)	{ 
     echo "<script>document.getElementById('question_ok').style.display='block';</script>";
     $row_question->question_content=$question;
   }   
   else  echo "<script>document.getElementById('question_false').style.display='block';</script>";   
   }
?>
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
<?php if(!isset($_POST['amend_submit'])){ 
      showmsg("请填写内容","question_content");
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="10">
<FORM name=form_a method=post  encType=multipart/form-data>
  <tr>
    <td colspan="3">填写表单下面的补充您的问题</td>
    </tr>
  <tr>
    <td width="100" valign="top">文字内容</td>
    <td><textarea name="content" rows="5" style="width:100%;"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2" valign="top">附加图片</td>
    <td><FONT  color=#668342>上传相关图片</FONT><IMG src="post.files/z2_tw_tjfj.gif" align=absMiddle border=0 onClick="showdiv('howgetFile');"></td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><DIV id=howgetFile style="display:none;">
                    <INPUT name=img_upload 
                  type=file id="img_upload" 
                  style="WIDTH: 350px; height:20px" size=50> 
                    </DIV></td>
  </tr>
  <tr>
    <td>提交内容</td>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="center">
          <input type="hidden" name="question_id" value="<?=$_REQUEST['id']?>">
          <input name="pic_to_up" type="hidden" id="pic_to_up" value="0">
		  <input type="submit" name="amend_submit" value="提  交" onClick="return check_form();">
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center">
          <input type="reset" name="cancel" value="放  弃">
        </div></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  </form>
</table>
<?php } ?>
</DIV>
</DIV>
</body></html>
   <?php  } else show_message("您没有操作的权利",-1);  
   } 
  else show_message("该问题不存在",-1);
 }
 else  show_message("对不起，请先登录",-1);
?>
<script>
function showdiv(divid) {
var obj = document.getElementById(divid);
if(obj.style.display=="none")  { obj.style.display="block"; document.all.pic_to_up.value="1";}
else { obj.style.display="none"; document.all.pic_to_up.value="0"; }
}

function check_form() {
 if(document.form_a.content.value=="") {
   showobj(question_content);
   return false;
  }
}
</script>