<?php session_start(); session_destroy(); ?>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="100">&nbsp;</td>
    <td height="100">&nbsp;</td>
    <td height="100">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="middle">      <table width="423" height="304" border="0" background="image/logbak.gif">
        <tr>
          <td width="30">&nbsp;</td>
          <td>&nbsp;</td>
          <td width="30">&nbsp;</td>
        </tr>
        <tr>
          <td width="30">&nbsp;</td>
          <td><table  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><form name="form" method="post" action="login.php" target="_parent">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table  border="0" cellpadding="10" cellspacing="0">
                          <tr>
                            <td nowrap><div align="center"><img src="image/name.gif" width="11" height="16" align="absmiddle"> ����Ա�˺�</div></td>
                            <td colspan="2" nowrap><div align="center">
                                <input name="admin" type="text" id="admin" size="20" style="width:150px;height:22px"> 
                            </div></td>
                          </tr>
                          <tr>
                            <td nowrap><div align="center"><img src="image/mima.gif" width="11" height="12"> ����</div></td>
                            <td colspan="2" nowrap><div align="center">
                                <input name="password" type="password" id="password" size="20" style="width:150px;height:22px"> 
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2" nowrap><div align="center"></div>
                                <div align="center">
                                  <input name="admin_submit" type="submit" id="admin_submit" value="ȷ  ��" onClick=" return checkform();">
                                </div>
                                <div align="center"> </div></td>
                            <td nowrap><div align="center">
                                <input type="reset" name="Submit2" value="��  ��">
                            </div></td>
                          </tr>
                      </table></td>
                    </tr>
                  </table>
              </form></td>
            </tr>
          </table></td>
          <td width="30">&nbsp;</td>
        </tr>
        <tr>
          <td width="30">&nbsp;</td>
          <td>&nbsp;</td>
          <td width="30">&nbsp;</td>
        </tr>
      </table>    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
function  checkform()
{
if (document.all.admin.value=="" )
     {
         alert("�û���������Ϊ�գ�");
	    document.all.admin.focus();
	    return false;
     }
if (document.all.password.value=="" )
     {
         alert("���벻����Ϊ�գ�");
	    document.all.password.focus();
	    return false;
     } 
	 
}
</script>