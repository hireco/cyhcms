<META http-equiv=Content-Type content="text/html; charset=gb2312">
<?php 
 if(isset($_SESSION['user_name'])) {
?>
<DIV style="height:5px;"><IMG height=5 src="index.files/z2_dl_t.gif" width=237></DIV>
<DIV 
style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; BACKGROUND: url(style/images/13291713.gif) repeat-y; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
<DIV class=mb8>
<DIV class="fl hydl"><B>��ӭ��¼</B></DIV>
<DIV class=fr><A class=c9u 
href="../logout.php">�ǳ�</A></DIV>
<DIV class=fr><A class=a05 href="../inner_infor_admin.php" target="_blank"><IMG height=10 src="index.files/img2_xx_n.gif" 
width=14 border=0></A>&nbsp;</DIV>
<DIV class=cb></DIV></DIV>
<DIV class=lh23>
<DIV class="f14 b">�û�����<?=$_SESSION['user_name']?></DIV>
<DIV>�û�����<?php echo $mem_level[$_SESSION['user_level']]; ?></DIV>
<DIV>�û����֣�<?=$_SESSION['user_score']?> (�������ʴ����)</DIV>
<DIV><A title=�������� 
href="user.php?action=list_question" 
target=_blank>��������</A> <A title=���Ļش� 
href="user.php?action=list_answer" 
target=_blank>���Ļش�</A> <A title=�û����� 
href="user.php" 
target=_blank>�û�����</A></DIV>
</DIV>
<DIV><BR></DIV></DIV>
<?php } else { 
require_once(dirname(__FILE__)."/showmsg.php");?>
<?php showmsg("�������û���","id_chk");?>
<?php showmsg("����������","pass_chk");?>
<FORM name=login  action="../login.php?to_go=<?=urlencode("ask/index.php")?>" method=post > 
<DIV class="c9 mb15">
<DIV style="height:5px;"><IMG height=5 src="index.files/z2_dl_t.gif" width=237></DIV>
<DIV class=dl_bg>
<DIV class="hydl mb15"><B>��ӭ��¼�ʴ�ϵͳ</B></DIV>
<DIV>
<DIV class=fr style="PADDING-TOP: 1px"><INPUT class=btn_dl title="��¼" type=submit value="��¼" onClick="return chk_if_blank();"></DIV>
<DIV class=fl style="PADDING-TOP: 6px">�û�����</DIV>
<DIV class=fl><INPUT class="dlk c9" 
maxLength=64 size=14 value=�����û��� onclick="if(this.value=='�����û���') this.value='';"
name=user_name></DIV><BR>
<DIV class=fl style="PADDING-TOP: 8px">��&nbsp;&nbsp;�룺</DIV>
<DIV class=fl style="PADDING-TOP: 2px"><INPUT class=dlk type=password 
maxLength=16 size=14 name=user_pass></DIV>
<DIV class=cb></DIV></DIV>
<DIV 
style="PADDING-RIGHT: 0px; PADDING-LEFT: 44px; PADDING-BOTTOM: 7px; PADDING-TOP: 0px"><INPUT 
type=checkbox CHECKED value=1 name=savelogin>������¼״̬</DIV>
<DIV align=right><A title=ע�� 
href="../register.php" target=_blank>ע��</A> <A 
title=�ǳ� href="../lostpass.php" 
target=_blank>�ǳ�</A></DIV>
</DIV>
<DIV class=dl_b>��<?=$cfg_site_name?>�û�ֱ�ӵ�¼</DIV></DIV></FORM>
<script>
function chk_if_blank() {
 if((document.login.user_name.value=="")||(document.login.user_name.value=="�����û���")){
 showobj(id_chk);
 return false;
 }
 if(document.login.user_pass.value==""){
 showobj(pass_chk);
 return false;
 }
 else return true;
}
</script>
<?php } ?>