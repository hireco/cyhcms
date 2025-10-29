<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>文档管理</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td><img src="../image/body_title_left.gif" width="3" height="27"></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">链接添加</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
		  <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0" bgcolor="#E3DFB0">
            <tr>
              <td width="10">&nbsp;</td>
              <td>欢迎加入友情连接&gt;&gt;</td>
            </tr>
</table>
		  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td>
						  <?php if(isset($_POST['sub_link'])) { 
						  $link_name=$_POST['name']; 
		                  $url=$_POST['url'];
		                  $person=$_POST['person'];
		                  $email=$_POST['email'];
		                  $link_type=$_POST['type'];
		                  $site_msg=$_POST['site_msg'];
		                  $logo=$_POST['logo'];
						  $put_date=date("y-m-d H:i:s");
						 
						  $query="insert into ".$table_suffix."link (link_name, url, email,logo,introduction, post_time,link_type,person)  values
		                  ('$link_name', '$url','$email','$logo','$site_msg','$put_date','$link_type','$person')";
						  $result=@mysql_query($query);
		                  if(!$result) {echo "sorry, can not write to the database now"; return false;}
						  $out_result="添加成功，返回继续加入！";
						  ShowMsg($out_result,-1); exit;
						  } 
						  else  {?>								  
								  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                      <td><FORM name="form1" onsubmit="return Check()" action="" method=post>
                                    <TABLE width="100%" 
  border=0 align=center cellPadding=2 cellSpacing=1 class=border>
                                      <TBODY>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 nowrap>链接类型：</TD>
                                          <TD height=25 colspan="2"><INPUT type=radio CHECKED value="l" name="type">
          Logo链接&nbsp;&nbsp;&nbsp;&nbsp;
          <INPUT type=radio value="w" name="type">
          文字链接</TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 vAlign=center nowrap>网站名称：</TD>
                                          <TD height=25 colspan="2"><INPUT maxLength=20 size=30   name=name>
                                              <FONT color=#ff0000>*</FONT></TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 nowrap>网站地址：</TD>
                                          <TD height=25 colspan="2"><INPUT  maxLength=100 
      size=30 value=http:// name=url>
                                              <FONT color=#ff0000>*</FONT></TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 nowrap>网站Logo：</TD>
                                          <TD height=25 colspan="2"><INPUT  maxLength=100 size=30 value=http:// name=logo>
                                          </TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 nowrap>站长姓名：</TD>
                                          <TD height=25 colspan="2"><INPUT  maxLength=20 size=30 name=person>
                                              <FONT color=#ff0000>*</FONT></TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 height=25 nowrap>电子邮件：</TD>
                                          <TD height=25 colspan="2"><INPUT  maxLength=30 size=30 
      value=@ name=email>
                                              <FONT color=#ff0000>*</FONT></TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD width=100 nowrap>网站简介：</TD>
                                          <TD colspan="2" vAlign=center><TEXTAREA id=site_msg  name=site_msg rows=5 cols=40></TEXTAREA></TD>
                                        </TR>
                                        <TR class=tdbg>
                                          <TD height=40 align=middle>
                                              <div align="center">                                              </div></TD>
                                          <TD width="110" height=40 align=center nowrap>&nbsp;
                                          <INPUT type=submit value=" 确 定 " name=sub_link></TD>
                                          <TD width="353" align=left nowrap><INPUT type=reset value=" 重 填 " name=reset></TD>
                                        </TR>
                                      </TBODY>
                                    </TABLE>
                                  </FORM></td>
                                    </tr>
                                  </table>
                                  <SCRIPT language=javascript>
function Check() {
if (document.form1.name.value=="")
	{
	  alert("请输入网站名称！")
	  document.form1.name.focus()
	  return false
	 }
if (document.form1.url.value=="")
	{
	  alert("请输入网站地址！")
	  document.form1.url.focus()
	  return false
	 }
if (document.form1.url.value=="http://")
	{
	  alert("请输入网站地址！")
	  document.form1.url.focus()
	  return false
	 }
if (document.form1.person.value=="")
	{
	  alert("请输入站长姓名！")
	  document.form1.person.focus()
	  return false
	 }
if (document.form1.email.value=="")
	{
	  alert("请输入电子邮件地址！")
	  document.form1.email.focus()
	  return false
	 }
if (document.form1.email.value=="@")
	{
	  alert("请输入电子邮件地址！")
	  document.form1.email.focus()
	  return false
	 }
if (document.form1.site_msg.value=="")
	{
	  alert("请输入网站简介！")
	  document.form1.site_msg.focus()
	  return false
	 }
}

                                    </SCRIPT></td>
                                </tr>
</table>
							  <?php } ?>
</body>
</html>