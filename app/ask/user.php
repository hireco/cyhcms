<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once("include/center_pos.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  require_once(dirname(__FILE__)."/../inc/find_cookie.php");
  if(!isset($_SESSION['user_name'])) require_once("login.php");
  else { 
  require_once("../".$cfg_admin_root."scripts/constant.php");
  require_once("include/showmsg.php");
  $query="select * from ".$table_suffix."member where user_name='{$_SESSION['user_name']}'";
  $result=mysql_query($query);
  if(!$result) ShowMsg("��ѯ����,���Ժ�����.",-1);
  else { 
  $who="��";
  $row=mysql_fetch_object($result); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$_SESSION['user_name']?>  ��������</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/z2.css" type=text/css rel=stylesheet><LINK 
href="style/grzx_v2.css" type=text/css rel=stylesheet><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet>
<STYLE type=text/css>.login_box {
	Z-INDEX: 200; BACKGROUND: url(user.files/login_boxBg.gif) no-repeat; LEFT: -192px; WIDTH: 372px; POSITION: absolute; TOP: 0px; HEIGHT: 165px; TEXT-ALIGN: left
}
.login_box H3 {
	PADDING-RIGHT: 0px; PADDING-LEFT: 20px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; WIDTH: 200px; COLOR: #333; PADDING-TOP: 15px; TEXT-ALIGN: left
}
.lb_close {
	PADDING-RIGHT: 10px; PADDING-LEFT: 0px; FLOAT: right; PADDING-BOTTOM: 0px; PADDING-TOP: 15px; TEXT-ALIGN: right
}
.login_box .tips {
	PADDING-RIGHT: 20px; PADDING-LEFT: 90px; FONT-WEIGHT: bold; PADDING-BOTTOM: 0px; COLOR: #f93; PADDING-TOP: 4px; TEXT-ALIGN: left
}
.login_box P {
	PADDING-RIGHT: 20px; PADDING-LEFT: 43px; PADDING-BOTTOM: 0px; PADDING-TOP: 4px
}
.login_box .login_button {
	BORDER-RIGHT: medium none; BORDER-TOP: medium none; MARGIN-TOP: 2px; BACKGROUND: url(user.files/login_button.gif) no-repeat; BORDER-LEFT: medium none; WIDTH: 56px; BORDER-BOTTOM: medium none; HEIGHT: 22px
}
</STYLE>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<DIV id=head>
<DIV class="fl hd1"><A href="./"><IMG height=45 alt=����֪ʶ�� 
src="user.files/z2_logo.gif" width=145 border=0></A></DIV>
<DIV class=fr 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; Z-INDEX: 11; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; POSITION: relative"><FONT 
color=#000000>���ã�</FONT><A 
href="../member.php"><?=$_SESSION['user_name']?></A><SPAN 
class=c9 style="MARGIN: 10px">|</SPAN><A 
href="../logout.php">�˳�</A><SPAN 
class=c9 style="MARGIN: 10px">|</SPAN> <A title=֪ʶ����ҳ 
href="./" target=_blank>֪ʶ����ҳ</A> </DIV>
<DIV class=cb></DIV></DIV>
<DIV id=nav>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 52px"><A title=��ҳ 
href="./">��ҳ</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 78px"><A title=������� 
href="ask_class.php">�������</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 91px"><A title=�������а� 
href="ask_rank.php">�������а�</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 65px"><A title=�û��� 
href="ask_star.php">�û���</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 65px"><A title=ר���� 
href="ask_expert.php">ר����</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fr style="PADDING-TOP: 4px"><A title=�������� 
href="user.php"><IMG height=19 
src="user.files/grzx.gif" width=78 border=0></A></DIV>
<DIV class=cb></DIV></DIV>
<DIV id=accessPath><A title=֪ʶ�� href="./">֪ʶ��</A> 
&gt; <A title=�������� 
href="user.php">��������</A> &gt; <?=isset($_REQUEST['action'])?$center_pos[$_REQUEST['action']]:"������ҳ"?></DIV>
<TABLE id=content cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD id=cont_nav vAlign=top>
      <DIV class=myHome>
      <H3 class=c007f><IMG alt=������ҳ src="user.files/home.gif"><A 
      href="../user_infor.php?host_id=<?=$_SESSION['user_id']?>&idkey=<?=md5($_SESSION['user_name'])?>" target="_blank"> 
      ������ҳ</A></H3></DIV>
      <DIV class=navTopbg></DIV>
      <DIV class=navBg>
      <UL>
        
        <LI id=li_ques><A 
        href="?action=list_question"><?=$who?>������</A> 
        <LI id=li_ans><A 
        href="?action=list_answer"><?=$who?>�Ļش�</A>  
		<LI id=li_msg><A 
        href="?action=msg_list"><?=$who?>������</A>
        <LI style="BORDER-BOTTOM: medium none"><A 
        href="../logout.php">��ȫ�˳�</A>        </LI>
      </UL></DIV>
      <DIV class=navButbg></DIV></TD>
    <TD id=cont_main vAlign=top>
	<?php showmsg("��������������","msg_chk");?>
	<?php showmsg("�ɹ��ļ�������","msg_true");?>
	<?php showmsg("����ʧ�ܣ���������","msg_false");?>
	<?php showcfm("��ȷ��Ҫִ�д˲�����","act_cfm");?>
      <DIV class=cont>
      <?php 
	    if(!isset($_REQUEST['action']))  require_once("include/user_index.php");
		elseif($_REQUEST['action']=="msg_list") require_once("include/member_msg_list.php");
		elseif($_REQUEST['action']=="list_question") require_once("include/list_question.php");
		elseif($_REQUEST['action']=="list_answer") require_once("include/list_answer.php");
	  ?>
      <?php require_once("include/msg_form.php");?>
	  </TD>
    <?php if(!isset($_REQUEST['action'])) { ?>
	<TD id=cont_friend vAlign=top>
      <?php 
	   $query="select content from ".$table_suffix."member_msg where user_name='{$_SESSION['user_name']}' order by id desc limit 0, 1";
	   $result_msg=mysql_query($query);
	   $member_msg=mysql_result($result_msg,0,"content");
	  ?>
	  <DIV id=blackboard>
      <DIV class=p10>
      <H4>�ҵ�����</H4>
	  <DIV class=more_msg><SPAN class=mesColor><A href="?action=msg_list" target="_self">����</A></SPAN></DIV>
      <DIV class=cb></DIV>
      <DIV class=nullbbcont>
      <P>
	  <?=$member_msg?>
	  </P></DIV></DIV></DIV>
      <H3>˭�������ҵĲ���</H3>
	  <br>
      <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                          <?php  
					   $width=32; 
					   $query="select * from ".$table_suffix."visitor_list  where visited_id={$_SESSION['user_id']}  group by visitor_id order by visit_time desc limit 0, 10";
					   $result=mysql_query($query);
					   $num=mysql_num_rows($result);
					   while($row=mysql_fetch_object($result)) { 
					   $query="select * from ".$table_suffix."member where id={$row->visitor_id}";
					   $result_visitor=mysql_query($query);
					   $row_visitor=mysql_fetch_object($result_visitor);
					   $img_default="../image/memsimg.gif";
				       $sample_pic=$row_visitor->pic_checked=='1'?(empty($row_visitor->sample_pic)?$img_default:$row_visitor->sample_pic):$img_default;
					  ?>
                          <tr>
                            <td width="34" rowspan="2"><table  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="../user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=md5($row_visitor->user_name)?>" target="_blank" style="text-decoration:underline"><img src="<?=$sample_pic?>" alt="<?=$row_visitor->nick_name?>" width="32"  border="0" align="middle"></a></td>
                                </tr>
                            </table></td>
                            <td width="10" style="line-height:120%;">&nbsp;</td>
                            <td style="line-height:120%;"><a  style="text-decoration:underline; color:#006666" href="../user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=md5($row_visitor->user_name)?>"><?=$row_visitor->nick_name?></a></td>
                          </tr>
                          <tr>
                            <td class="fonts" style="line-height:120%;">&nbsp;</td>
                            <td class="fonts" style="line-height:120%;"><?=substr($row->visit_time,3,11)?></td>
                          </tr>
                          <tr height="10">
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <?php } 
					   if(!$num) echo "<tr><td>û�зÿ�</td></tr>";?>
        </table>
      <DIV class=c></DIV>
      <H3>�ҵĲ��ͺ���</H3>
	  <br>
      <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <?php  
					  $width=32; 
					  if($friend_list) { 
					  $friend_list=explode(",",$friend_list); 
					  for($i=0; $i<count($friend_list); $i++) {
					   $query="select * from ".$table_suffix."member  where id={$friend_list[$i]}";
					   $result=mysql_query($query);
					   $row=mysql_fetch_object($result); 
					   $img_default="../image/memsimg.gif";
				       $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
					  ?>
                          <tr>
                            <td width="34"><table  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE">
								  <a href="../user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=md5($row->user_name)?>" target="_blank" 
								  style="text-decoration:underline"><img src="<?=$sample_pic?>" alt="<?=$row->nick_name?>" width="32"  border="0" 
								  align="middle"></a></td>
                                </tr>
                            </table></td>
							<td width="10"></td>
                            <td><a  style="text-decoration:underline; color:#006666" 
							href="../user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=md5($row->user_name)?>">
                            <?=$row->nick_name?>
                            </a></td>
                          </tr>
						  <tr height="10">
						  <td></td>
						  <td></td>
						  <td></td>
						  </tr>
                          <?php } 
					   }
					 else  echo "<tr><td>û�к���</td></tr>";?>
        </table></TD>
		<?php } ?>
		</TR></TBODY></TABLE>
<DIV id=btm align=center>
  <DIV class=btm1>������� - ���ڱ�վ - �����ղ� - ��������</DIV>
  <DIV class=btm2>&copy; 2008
    <?=$cfg_site_name?>
    ��������</DIV>
</DIV>
</BODY></HTML>
<script>
function chk_if_blank() {
 if(document.member_msg.content.value==""){
 showobj(msg_chk);
 return false;
 }
 else return true;
}

function gbcount(message,total,used,remain)
{
var max;
max = total.value;
if (message.value.length > max) {
message.value = message.value.substring(0,max);
used.value = max;
remain.value = 0;
}
else {
used.value = message.value.length;
remain.value = max - used.value;
}
}
</script>
<?php }
}
?>
