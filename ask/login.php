<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");  
  require_once("include/showmsg.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> - �ʴ�֪ʶϵͳ</TITLE>
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
      href="./"><IMG height=45 alt=����֪ʶ�� 
      src="login.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD width=20></TD>
    <TD vAlign=top>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=f12 vAlign=bottom align=right height=20><A class=c6nul 
            href="./">֪ʶ��ҳ</A> <SPAN class="c9 ar">|</SPAN> <A 
            class=c6nul href="../" target=_blank>��վ��ҳ</A>&nbsp;&nbsp;</TD>
        </TR>
        <TR>
          <TD class=f13 background=login.files/bg_nav_30.gif 
            height=30>&nbsp;&nbsp;<B class=f14>��Ա��¼</B> 
        --��¼��������ܸ������!</TD></TR></TBODY></TABLE></TD></TR>
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
      height=43>��ʾ����Ŀǰ���еĲ�������Ҫ����¼������ܼ�������</TD></TR>
  <TR>
    <TD height=13></TD></TR>
  <TR>
    <TD height=4><IMG height=4 src="login.files/tw_cn_t.gif" width=598 
      border=0></TD></TR>
  <TR>
    <TD 
      style="BORDER-RIGHT: #cddfbc 1px solid; BORDER-LEFT: #cddfbc 1px solid">
	  <?php showmsg("ע�⣺<br>�����������û����Ե�¼","id_chk");?>
	  <?php showmsg("ע�⣺<br>�������������룬���������һ�","pass_chk");?>
	  <TABLE 
      cellSpacing=0 cellPadding=0 width="100%">
        <TBODY>
        <TR>
          <TD>&nbsp;</TD>
          <TD class=f16 style="BORDER-BOTTOM: #cddfbc 1px dashed"><IMG 
            height=51 hspace=20 src="login.files/tw_gx.gif" width=37 
            align=absMiddle vspace=10 border=0><FONT 
            color=#ff9900><B>��ӭ��¼</B></FONT></TD>
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
                      <TD align=right width=80 height=30>��Ա����</TD>
                      <TD colSpan=2><INPUT class=c6   style="WIDTH: 160px; HEIGHT: 20px"   onclick="if(this.value=='�������Ļ�Ա�˺�')this.value='';" 
                        value=�������Ļ�Ա�˺� name=user_name></TD></TR>
                    <TR>
                      <TD align=right height=30>���룺</TD>
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
                      <TD><INPUT class=btn_wytw type=submit value=" �� ¼ " onClick="return chk_if_blank();"></TD>
                      <TD class=lh15 width=90><A class=f12 
                        href="../register.php" 
                        target=_blank>����ע��</A><BR>
                          <a href="../lostpass.php">��������</a></TD>
                    </TR></TBODY></TABLE></TD>
                <TD width=245>
                  <TABLE class=f12 style="MARGIN: 5px" cellSpacing=0 
                  cellPadding=0 width=245 border=0>
                    <TBODY>
                    <TR>
                      <TD class=pl40 vAlign=bottom 
                      background=login.files/gdfw_t.gif height=38><FONT 
                        class="f14 lh15" color=#009900>һ�ε�¼���ܸ��మ�ʷ���! 
                    </FONT></TD></TR>
                    <TR>
                      <TD class=pl40 style="PADDING-TOP: 10px" 
                      background=login.files/gdfw_bg.gif><IMG height=6 
                        src="login.files/gdfw_cc.gif" width=6 align=absMiddle 
                        vspace=8 border=0> <A class=gdfw 
                        href="./" 
                        target=_blank>�ʴ�֪ʶ</A><BR>
                        <IMG height=6 
                        src="login.files/gdfw_cc.gif" width=6 align=absMiddle 
                        vspace=8 border=0> <A class=gdfw 
                        href="../" 
                        target=_blank>�����ڴ�...</A><BR>                        
                        <BR></TD></TR>
                    <TR>
                      <TD><IMG height=12 src="login.files/gdfw_b.gif" 
                        width=245 
              border=0></TD></TR></TBODY></TABLE></TD></TR></FORM></TABLE></TD>
          <TD width=29>&nbsp;</TD></TR>
        <TR>
          <TD class="f12 c6" 
          style="BORDER-TOP: #cddfbc 1px dashed; PADDING-LEFT: 30px; BACKGROUND-COLOR: #e9f5dd" 
          colSpan=3 height=50>��<?=$cfg_site_name?>�û���ֱ�ӵ�¼</TD>
        </TR></TABLE></TD></TR>
  <TR>
    <TD height=4><IMG height=4 src="login.files/tw_cn_b.gif" width=598 
      border=0></TD></TR></TBODY></TABLE><BR><BR><!-- β�� begin --><BR>
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