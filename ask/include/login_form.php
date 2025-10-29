<META http-equiv=Content-Type content="text/html; charset=gb2312">
<?php 
 if(isset($_SESSION['user_name'])) {
?>
<DIV style="height:5px;"><IMG height=5 src="index.files/z2_dl_t.gif" width=237></DIV>
<DIV 
style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; BACKGROUND: url(style/images/13291713.gif) repeat-y; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
<DIV class=mb8>
<DIV class="fl hydl"><B>欢迎登录</B></DIV>
<DIV class=fr><A class=c9u 
href="../logout.php">登出</A></DIV>
<DIV class=fr><A class=a05 href="../inner_infor_admin.php" target="_blank"><IMG height=10 src="index.files/img2_xx_n.gif" 
width=14 border=0></A>&nbsp;</DIV>
<DIV class=cb></DIV></DIV>
<DIV class=lh23>
<DIV class="f14 b">用户名：<?=$_SESSION['user_name']?></DIV>
<DIV>用户级别：<?php echo $mem_level[$_SESSION['user_level']]; ?></DIV>
<DIV>用户积分：<?=$_SESSION['user_score']?> (不包含问答积分)</DIV>
<DIV><A title=您的提问 
href="user.php?action=list_question" 
target=_blank>您的提问</A> <A title=您的回答 
href="user.php?action=list_answer" 
target=_blank>您的回答</A> <A title=用户中心 
href="user.php" 
target=_blank>用户中心</A></DIV>
</DIV>
<DIV><BR></DIV></DIV>
<?php } else { 
require_once(dirname(__FILE__)."/showmsg.php");?>
<?php showmsg("请输入用户名","id_chk");?>
<?php showmsg("请输入密码","pass_chk");?>
<FORM name=login  action="../login.php?to_go=<?=urlencode("ask/index.php")?>" method=post > 
<DIV class="c9 mb15">
<DIV style="height:5px;"><IMG height=5 src="index.files/z2_dl_t.gif" width=237></DIV>
<DIV class=dl_bg>
<DIV class="hydl mb15"><B>欢迎登录问答系统</B></DIV>
<DIV>
<DIV class=fr style="PADDING-TOP: 1px"><INPUT class=btn_dl title="登录" type=submit value="登录" onClick="return chk_if_blank();"></DIV>
<DIV class=fl style="PADDING-TOP: 6px">用户名：</DIV>
<DIV class=fl><INPUT class="dlk c9" 
maxLength=64 size=14 value=输入用户名 onclick="if(this.value=='输入用户名') this.value='';"
name=user_name></DIV><BR>
<DIV class=fl style="PADDING-TOP: 8px">密&nbsp;&nbsp;码：</DIV>
<DIV class=fl style="PADDING-TOP: 2px"><INPUT class=dlk type=password 
maxLength=16 size=14 name=user_pass></DIV>
<DIV class=cb></DIV></DIV>
<DIV 
style="PADDING-RIGHT: 0px; PADDING-LEFT: 44px; PADDING-BOTTOM: 7px; PADDING-TOP: 0px"><INPUT 
type=checkbox CHECKED value=1 name=savelogin>保留登录状态</DIV>
<DIV align=right><A title=注册 
href="../register.php" target=_blank>注册</A> <A 
title=登出 href="../lostpass.php" 
target=_blank>登出</A></DIV>
</DIV>
<DIV class=dl_b>¤<?=$cfg_site_name?>用户直接登录</DIV></DIV></FORM>
<script>
function chk_if_blank() {
 if((document.login.user_name.value=="")||(document.login.user_name.value=="输入用户名")){
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