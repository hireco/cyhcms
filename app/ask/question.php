<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once("include/showmsg.php");
  require_once("../".$cfg_admin_root."scripts/constant.php"); 
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  if(!isset($_REQUEST['id']))  show_message("�����ڵ������ѯ��",-1);
  else { 
   $query="select * from ".$table_suffix."ask where id={$_REQUEST['id']}";
   $result=mysql_query($query);
   if(!mysql_num_rows($result)) show_message("�����ڵ������ѯ��",-1); 
     else { 
	 $row_q=mysql_fetch_object($result);
	 if(($row_q->hide=='1')&&($row_q->poster<>$_SESSION['user_name'])&&(!isset($_SESSION['root'])))  
	 show_message("�����Ѿ����ػ������Ʒ��ʣ�",-1);
	 else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0039)http://iask.sina.com.cn/b/14938688.html -->
<HTML><HEAD><TITLE><?=$row_q->question?> ��ѧ֪ʶ��</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK href="style/zhishib.css" type=text/css rel=stylesheet>
<LINK href="style/z2.css" type=text/css rel=stylesheet>
<LINK href="style/grzx_v2.css" type=text/css rel=stylesheet>
<LINK href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3492" name=GENERATOR></HEAD>
<BODY>
<DIV id=head>
<DIV class="fl hd1"><A href="./"><IMG height=45 alt=����֪ʶ�� 
src="user.files/z2_logo.gif" width=145 border=0></A></DIV>
<?php  if(isset($_SESSION['user_name'])) { ?>
<DIV class=fr style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; Z-INDEX: 11; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; POSITION: relative"><FONT  color=#000000>���ã�</FONT><A href="../member.php"><?=$_SESSION['user_name']?></A><SPAN 
class=c9 style="MARGIN: 10px">|</SPAN><A href="../logout.php">�˳�</A><SPAN  class=c9 style="MARGIN: 10px">|</SPAN> <A title=֪ʶ����ҳ  href="./" target=_blank>֪ʶ����ҳ</A> </DIV>
<?php } ?>
<DIV class=cb></DIV></DIV>
<DIV id=nav>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 52px"><A title=��ҳ 
href="./">��ҳ</A></DIV>
  <DIV class=fl><IMG height=29 src="ask_class.files/v2_nav_l.gif" width=2></DIV>
  <DIV class="fl nav_n" title=������� style="WIDTH: 78px">�������</DIV>
  <DIV class=fl><IMG height=29 src="ask_class.files/v2_nav_r.gif" width=2></DIV>
  <DIV class=fl style="WIDTH: 91px"><A title=�������а� 
href="ask_rank.php">�������а�</A></DIV>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 65px"><A title=�û��� 
href="ask_star.php">�û���</A></DIV>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 65px"><A title=ר���� 
href="ask_expert.php">ר����</A></DIV>
<DIV class=fr style="PADDING-TOP: 4px"><A title=�������� 
href="user.php"><IMG height=19 
src="ask_class.files/grzx.gif" width=78 border=0></A></DIV>
  <DIV class=cb></DIV>
</DIV>
<DIV id=nav2><A title=������� 
href="ask_class.php">�������</FONT></A>&nbsp;&gt;&nbsp;<A href="ask_chapter.php?part=<?=urlencode($row_q->part)?>"><?=$row_q->part?></A> 
&nbsp;&gt;&nbsp;<A href="ask_section.php?part=<?=urlencode($row_q->part)?>&chapter=<?=urlencode($row_q->chapter)?>"><?=$row_q->chapter?></A>&nbsp;&gt;&nbsp;<A href="ask_point.php?part=<?=urlencode($_REQUEST['part'])?>&chapter=<?=urlencode($row_q->chapter)?>&section=<?=urlencode($row_q->section)?>"><?=$row_q->section?></A>
&nbsp;&gt;&nbsp;<?=$row_q->points?>
</DIV>
<DIV id=main> 
<?php 
   $poster=$row_q->poster;
   $query="select * from  ".$table_suffix."member where user_name='{$poster}'";
   $result_poster=mysql_query($query);
   $row_poster=mysql_fetch_object($result_poster);  
   $img_default="user.files/120_1570632011.gif";
   $sample_pic=$row_poster->pic_checked=='1'?(empty($row_poster->sample_pic)?$img_default:$row_poster->sample_pic):$img_default;
   
   $query="select * from  ".$table_suffix."ask_answer where question_id={$_REQUEST['id']} order by accept desc, post_time desc";
   $result_answer=mysql_query($query);
   $num_of_answer=mysql_num_rows($result_answer);
?>
<DIV id=cont_left>
<DIV class=cl_qus>
<DIV class=qus_t>
<DIV class="f14 fl"><STRONG>����:</STRONG></DIV>
<?php if(($_SESSION['user_name']==$poster)&&($row_q->finished=="0")) { ?>
<DIV class="plsz">
<a href="#" class="c9,c6nul" id=<?=$_REQUEST['id']?> onClick="opendwin('amend_question.php?id=<?=$_REQUEST['id']?>');">��������</a>(����������֮ǰ����)
</DIV>
<?php }?>
<DIV class=cr></DIV></DIV>
<DIV class=qusi><IMG alt=����logo src="question.files/ques.gif"></DIV>
<DIV class=qus_c>
<DIV class=usr_info>
<DIV class=wpb5><A class=c7f 
href="user_infor.php?user_id=<?=$row_poster->id?>" target=_blank><IMG width=70%
class=img1 src=<?=$sample_pic?> align=absMiddle><BR><?=$row_poster->nick_name?></A><BR>[<?=$mem_level[$row_poster->user_level]?>]</DIV></DIV>
<DIV class=usr_qus><IMG alt=���� src="index.files/zt_<?=$row_q->finished=="0"?"jjz":"yjj"?>.gif" align=absMiddle> 
<STRONG><?=$row_q->question?></STRONG> <SPAN id=zsqprize><IMG src="question.files/money.gif" 
align=absMiddle><STRONG class=o><?=$row_q->score?>��</STRONG></SPAN>
 
<DIV class=twsj style="TEXT-ALIGN: left">�ش�<?=$num_of_answer?> &nbsp; �����<?=$row_q->read_times?> &nbsp; ����ʱ�䣺<SPAN 
class=ar>20<?=$row_q->post_time?></SPAN></DIV>
<DIV class=pb5><?=$row_q->question_content?></DIV>
</DIV>
<DIV class=cb></DIV></DIV></DIV>
<?php
  $i=1;  $flag_finished=0;
  while($row_answer=mysql_fetch_object($result_answer)) { 
   $poster=$row_answer->poster;
   $query="select * from  ".$table_suffix."member where user_name='{$poster}'";
   $result_poster=mysql_query($query);
   $row_poster=mysql_fetch_object($result_poster);  
   $img_default="user.files/120_1570632011.gif";
   $sample_pic=$row_poster->pic_checked=='1'?(empty($row_poster->sample_pic)?$img_default:$row_poster->sample_pic):$img_default;
?>
<DIV class=cl_ans2>
<DIV class=ans_t3>
<DIV class=fl>
<?php 
 if($i==1) {
 if($row_answer->accept) { 
 $flag_finished=1;
 ?>
<IMG alt=��Ѵ� src="question.files/best.gif"  align=absMiddle> <STRONG class=f14>��Ѵ�</STRONG> <SPAN 
class="f12 c9">�˴����������Լ�ѡ�񣬲�������վ�Ĺ۵�</SPAN>
<?php } else {?>
<STRONG class=f14>����<?=$num_of_answer?>����</STRONG> 
<?php } 
  }
if(($i==2)&&($flag_finished==1)) { ?>
 <STRONG class=f14>������</STRONG> 
<?php }
  $i++;
?>
</DIV>
<?php 
 if($_SESSION['user_name']==$row_q->poster) {
 if(!$row_answer->accept) {?>
<DIV class="plsz">
<a href="#" class="c9,c6nul" id=<?=$row_answer->id?> onClick="opendwin('set_best.php?id=<?=$row_answer->id?>');">ѡΪ��Ѵ�</a>
</DIV>
<?php } 
  }

if($_SESSION['user_name']==$row_answer->poster) {?>
<DIV class="plsz">
<a href="amend_answer.php?id=<?=$row_answer->id?>" class="c9,c6nul" id=<?=$row_answer->id?>>��������</a>
</DIV>
<?php } ?>

<DIV class=cb></DIV></DIV>
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
<DIV class=twsj>�ش�<SPAN class=ar>20<?=$row_answer->post_time?></SPAN></DIV>
<?php if($row_answer->accept) { ?>
<DIV class=f12 style="BORDER-TOP: #feeba0 1px solid; MARGIN-BOTTOM: 10px; PADDING-TOP: 10px">
<DIV class=pb5><B class=o>�����߶Դ𰸵����ۣ�<?php for($j=0;$j<=$row_q->star_num;$j++) {?><IMG src="question.files/ssr50a.gif"><?php } ?>
</B></DIV>
<DIV><?=$row_q->answer_comment?></DIV></DIV>
<?php } ?>

</DIV>
</DIV></DIV>
<?php } 
if(!$row_q->finished) {
 showmsg("����д���Ļش�����","answer_content"); 
 showmsg("������û���������","login_false");
 showmsg("�����Ѿ�������߳���","id_false");
 showmsg("�ɹ��ύ���Ĵ�","answer_ok");
 showmsg("�ύʧ�ܣ�������","answer_false");
 showmsg("�Բ��𣬱�ϵͳ��ֹ�����Դ�","answer_self");
?>
<IFRAME style="DISPLAY: none" name=iframe_data src="about:blank"></IFRAME>
<table width="100%"  border="0" cellspacing="10">
<FORM name=form_a method=post action="answer_submit.php"
encType=multipart/form-data target="iframe_data">
  <tr>
    <td colspan="2">�����ش�&gt;&gt;</td>
    </tr>
  <tr>
    <td width="90" valign="top">�ش�����</td>
    <td><textarea name="answer" cols=45 rows=9 class="w100 f14"></textarea></td>
    </tr>
  <tr>
    <td rowspan="2" valign="top">����ͼƬ</td>
    <td><FONT  color=#668342>�ϴ����ͼƬ</FONT><IMG src="post.files/z2_tw_tjfj.gif" align=absMiddle border=0 onClick="showdiv('howgetFile');"></td>
  </tr>
  <tr>
    <td><DIV id=howgetFile style="display:none;">
                    <INPUT name=img_upload 
                  type=file id="img_upload" 
                  style="WIDTH: 350px; height:20px" size=50> 
                    </DIV></td>
    </tr>
  <?php  if(!isset($_SESSION['user_name'])) { ?>
  <tr>
    <td>�û���¼</td>
    <td>�û���
      <input name="user_name" type="text" size="15" style="HEIGHT:20px"> 
      ���� 
      <input name="user_pass" type="password" size="15" style="HEIGHT:20px">
      </td>
  </tr>
  <?php } ?>
  <tr>
    <td>�ύ��</td>
    <td><input type="hidden" name="question_id" value="<?=$_REQUEST['id']?>">
	    <input name="pic_to_up" type="hidden" id="pic_to_up" value="0">
		<input type="submit" name="Submit" value="��  ��" onClick="return check_form();"></td>
  </tr>
  </form>
</table>
<?php } ?>
<DIV id=ads1 
style="BORDER-RIGHT: #e0e0e0 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #e0e0e0 1px solid; MARGIN-TOP: 1px; DISPLAY: none; PADDING-LEFT: 7px; MARGIN-BOTTOM: 5px; PADDING-BOTTOM: 8px; BORDER-LEFT: #e0e0e0 1px solid; PADDING-TOP: 12px; BORDER-BOTTOM: #e0e0e0 1px solid"></DIV>
</DIV>
<DIV id=cont_right style="WIDTH: 237px">
<DIV id=zhishi_link></DIV>
<DIV class=title_area>
<H3><A class=c0 
href="http://iask.sina.com.cn/browse/get_class.php?fatherid=299&amp;status=C" 
target=_blank>����Ա�Ƽ�</A></H3>
<DIV class=more><A class=c9 title=���� 
href="ask_rank.php?list_for=top" 
target=_blank>����<SPAN class=f10>&gt;&gt;</SPAN></A></DIV>
<DIV class=cb></DIV></DIV>
<UL class=n_list>
<?php 
  $query="select * from  ".$table_suffix."ask where hide='0' order by top desc, top_time desc limit 0, 5";
  $result_top=mysql_query($query);
  while($row_top=mysql_fetch_object($result_top)) { 
?>
  <LI><A href="question.php?id=<?=$row_top->id?>" target=_blank><?=$row_top->question?></A></LI>
<?php } ?> 
</UL>
<DIV id=sina_ads2 
style="PADDING-RIGHT: 0px; DISPLAY: none; PADDING-LEFT: 5px; PADDING-BOTTOM: 25px; PADDING-TOP: 0px" 
sectionid="IASK-ZSR-Z" name="sina_ads2" adtype="text" slotnum="10"></DIV>
<DIV class=title_area>


<DIV class=cb></DIV></DIV>


<DIV id=ads 
style="PADDING-RIGHT: 10px; DISPLAY: none; PADDING-LEFT: 10px; MARGIN-BOTTOM: 18px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px; WORD-WRAP: break-word"></DIV></DIV>
<DIV class=cb></DIV></DIV>
<DIV id=btm align=center>
<DIV class=btm1>������� - ���ڱ�վ - �����ղ� - ��������</DIV>
<DIV class=btm2>&copy; 2008 <?=$cfg_site_name?> ��������</DIV>
</DIV>
</BODY></HTML>
<?php 
   mysql_query("update ".$table_suffix."ask set read_times=read_times+1 where id={$_REQUEST['id']}");
   } 
  }
 }
?>
<script language="JavaScript">

function opendwin(url)
{ window.open(url,"","height=550,width=700,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}

function check_form() {
 if(document.form_a.answer.value=="") {
   showobj(answer_content);
   return false;
  }
 if(document.form_a.user_name) {
   if((document.form_a.user_name.value=="")||(document.form_a.user_pass.value=="")) {
   showobj(login_false);
   return false;
   }
  }
 else return true;
}

function showdiv(divid) {
var obj = document.getElementById(divid);
if(obj.style.display=="none")  { obj.style.display="block"; document.all.pic_to_up.value="1";}
else { obj.style.display="none"; document.all.pic_to_up.value="0"; }
}
</script>