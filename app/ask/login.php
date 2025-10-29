<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");  
  require_once("include/showmsg.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> - 问答知识系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet><LINK 
href="style/grzx_v2.css" type=text/css rel=stylesheet>
<script language="javascript" src="../inc/form_check.js"></script>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY><IFRAME style="DISPLAY: none" name=iframe_data src="about:blank"></IFRAME>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD vAlign=bottom align=right width=155><A 
      href="./"><IMG height=45 alt=爱问知识人 
      src="login.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD width=20></TD>
    <TD vAlign=top>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=f12 vAlign=bottom align=right height=20><A class=c6nul 
            href="./">知识首页</A> <SPAN class="c9 ar">|</SPAN> <A 
            class=c6nul href="../" target=_blank>本站首页</A>&nbsp;&nbsp;</TD>
        </TR>
        <TR>
          <TD class=f13 background=login.files/bg_nav_30.gif 
            height=30>&nbsp;&nbsp;<B class=f14>会员登录</B> 
        --登录后可以享受更多服务!</TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD height=7></TD></TR></TBODY></TABLE>
<TABLE width="100%" border=0>
  <TBODY>
  <TR>
    <TD height=25></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=598 align=center border=0>
  <TBODY>
  <TR>
    <TD class=bz_tt background=login.files/bz_top_bg.gif 
      height=43>提示：您目前进行的操作，需要“登录”后才能继续……</TD></TR>
  <TR>
    <TD height=13></TD></TR>
  <TR>
    <TD height=4><IMG height=4 src="login.files/tw_cn_t.gif" width=598 
      border=0></TD></TR>
  <TR>
    <TD 
      style="BORDER-RIGHT: #cddfbc 1px solid; BORDER-LEFT: #cddfbc 1px solid">
	  <?php showmsg("注意：<br>请输入您的用户名以登录","id_chk");?>
	  <?php showmsg("注意：<br>请输入您的密码，若忘记请找回","pass_chk");?>
	  <TABLE 
      cellSpacing=0 cellPadding=0 width="100%">
        <TBODY>
        <TR>
          <TD>&nbsp;</TD>
          <TD class=f16 style="BORDER-BOTTOM: #cddfbc 1px dashed"><IMG 
            height=51 hspace=20 src="login.files/tw_gx.gif" width=37 
            align=absMiddle vspace=10 border=0><FONT 
            color=#ff9900><B>欢迎登录</B></FONT></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD width=29>&nbsp;</TD>
          <TD width=540>
            <TABLE cellPadding=0 width="100%" border=0>
		    <FORM name=loginform  method=post action="../login.php?to_go=<?php 
	if(!isset($_REQUEST['to_go']))   echo "ask/user.php";
	else echo urlencode($_REQUEST['to_go']); ?>" onSubmit="return checkAllTextValid(this);">
              <TBODY>
              <TR vAlign=top>
                <TD>
                  <TABLE class=f13 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD align=right width=80 height=30>会员名：</TD>
                      <TD colSpan=2><INPUT class=c6   style="WIDTH: 160px; HEIGHT: 20px"   onclick="if(this.value=='输入您的会员账号')this.value='';" 
                        value=输入您的会员账号 name=user_name></TD></TR>
                    <TR>
                      <TD align=right height=30>密码：</TD>
                      <TD colSpan=2><INPUT class=c6 
                        style="WIDTH: 160px; HEIGHT: 20px" type=password 
                        name=user_pass></TD></TR>
                    <TR>
                      <TD style="BORDER-BOTTOM: #cddfbc 1px dashed" 
                      colSpan=3>&nbsp;</TD></TR>
                    <TR>
                      <TD height=10></TD></TR>
                    <TR vAlign=top>
                      <TD></TD>
                      <TD><INPUT class=btn_wytw type=submit value=" 登 录 " onClick="return chk_if_blank();"></TD>
                      <TD class=lh15 width=90><A class=f12 
                        href="../register.php" 
                        target=_blank>快速注册</A><BR>
                          <a href="../lostpass.php">忘记密码</a></TD>
                    </TR></TBODY></TABLE></TD>
                <TD width=245>
                  <TABLE class=f12 style="MARGIN: 5px" cellSpacing=0 
                  cellPadding=0 width=245 border=0>
                    <TBODY>
                    <TR>
                      <TD class=pl40 vAlign=bottom 
                      background=login.files/gdfw_t.gif height=38><FONT 
                        class="f14 lh15" color=#009900>一次登录享受更多爱问服务! 
                    </FONT></TD></TR>
                    <TR>
                      <TD class=pl40 style="PADDING-TOP: 10px" 
                      background=login.files/gdfw_bg.gif><IMG height=6 
                        src="login.files/gdfw_cc.gif" width=6 align=absMiddle 
                        vspace=8 border=0> <A class=gdfw 
                        href="./" 
                        target=_blank>问答知识</A><BR>
                        <IMG height=6 
                        src="login.files/gdfw_cc.gif" width=6 align=absMiddle 
                        vspace=8 border=0> <A class=gdfw 
                        href="../" 
                        target=_blank>更多期待...</A><BR>                        
                        <BR></TD></TR>
                    <TR>
                      <TD><IMG height=12 src="login.files/gdfw_b.gif" 
                        width=245 
              border=0></TD></TR></TBODY></TABLE></TD></TR></FORM></TABLE></TD>
          <TD width=29>&nbsp;</TD></TR>
        <TR>
          <TD class="f12 c6" 
          style="BORDER-TOP: #cddfbc 1px dashed; PADDING-LEFT: 30px; BACKGROUND-COLOR: #e9f5dd" 
          colSpan=3 height=50>·<?=$cfg_site_name?>用户请直接登录</TD>
        </TR></TABLE></TD></TR>
  <TR>
    <TD height=4><IMG height=4 src="login.files/tw_cn_b.gif" width=598 
      border=0></TD></TR></TBODY></TABLE><BR><BR><!-- 尾部 begin --><BR>
<?php  require_once("htm/foot.htm");?>
</BODY></HTML>
<script>
function chk_if_blank() {
 if(document.loginform.user_name.value==""){
 showobj(id_chk);
 return false;
 }
 if(document.loginform.user_pass.value==""){
 showobj(pass_chk);
 return false;
 }
 else return true;
}
</script>