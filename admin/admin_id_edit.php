<?php 
   require_once("setting.php");
   require_once("inc.php");    
?>
<html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<!-- InstanceBeginEditable name="doctitle" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
--> 
</style></head>
 
<body>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="ͷ��" --><?php require_once(RROOT."/admin/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/bg_login.gif">
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="����" -->
         <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/foot_navi.jpg">
           <tr>
             <td width="10" height="30">&nbsp;</td>
             <td valign="bottom"><table height="20" border="0" align="left" cellpadding="0" cellspacing="0" background="image/b2.gif">
                 <tr align="center" valign="bottom">
                   <td width="69" height="20" background="image/b1.gif"><div align="center"><a href="admin_id_edit.php">�޸�����</a></div></td>
                   <td width="69" height="20" background="image/b2.gif"><div align="center"><a href="admin_id_list.php">�û�����</a></div></td>
                   <?php if($_SESSION['root']=="super_administrator") { ?><td width="69" background="image/b2.gif"><a href="chk_admin_login.php">��¼���</a></td>
                   <?php } ?>
                 </tr>
             </table></td>
           </tr>
         </table>
         <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/search_bar_bg.gif">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
          <?php
		  if(isset($_REQUEST['pass_amend'])) { 
		    if(md5($_REQUEST['password_old'])!=$_SESSION['pass_valid'])
			{ echo "<script>alert(\"����������벻��ȷ��\"); history.go(-1);</script>"; exit;}
		    
			$password=md5($_REQUEST['password_new1']); 
			$user=$_SESSION['admin_valid'];
			$result=@mysql_query("update ".$table_suffix."admin set admin_password='$password' where admin_id='$user'");
		   if($result) { 
		    $_SESSION['pass_valid']=$password;
		   ?>
                    <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
                      <tr>
                        <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td>OK�����³ɹ����� <a href="admin.php">���ع�����ҳ</a>��</td>
                              <td>&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
		   
		   <?php } else { ?>
		   <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
             <tr>
               <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="2">
                   <tr>
                     <td width="10">&nbsp;</td>
                     <td>SORRY������ʧ�ܣ��� <a href="javascript:history.go(-1)">�������� </a>��</td>
                     <td>&nbsp;</td>
                   </tr>
               </table></td>
             </tr>
           </table>
		  
		   <?php } 
		    } 
		   else{ 		   
		   ?>
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF">
			  <form name="form2" method="post" action="<?=$PHP_SELF?>">
			    <table width="100%"  border="0" cellpadding="2" cellspacing="0" bgcolor="#FFF3EF">
                  <tr>
                    <td width="5" bgcolor="#EFEBEF">&nbsp;</td>
                    <td bgcolor="#EFEBEF">�����˺���<strong><font color=red>
                      <?=$_SESSION['admin_valid']?>
                    </font></strong> ����д����ı����޸��������룺 </td>
					</tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>����ԭ����
                        <input name="password_old" type="password" id="password_old"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>����������
                        <input name="password_new1" type="password" id="password_new1"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>�ظ�������
                        <input name="password_new2" type="password" id="password_new2"></td>
                  </tr>
                  <tr>
                    <td bgcolor="#D6BEAD">&nbsp;</td>
                    <td bgcolor="#D4BFAA"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="70"><div align="center">
                          <input name="pass_amend" type="submit" id="pass_amend" value="�� ��" onClick="return chk_if_right();">
                        </div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                </form></td>
            </tr>
          </table>
		  <?php 
		  }?>
		  <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!-- InstanceBeginEditable name="�Ų�" --><?php require_once("scripts/footer.php");?><!-- InstanceEndEditable --></td>
        </tr>
    </table></td>
  </tr>
</table> 
</body>
<!-- InstanceEnd --></html>
<script>
function chk_if_right(){
 var obj=document.all;
 if(obj.password_old.value==""||obj.password_new1.value==""||obj.password_new2.value=="") 
  { alert("����������д����"); return false; }
 if(obj.password_new1.value!=obj.password_new2.value)
  { alert("��������д����ȷ��"); return false; }
 if(obj.password_new1.value.length<6)
  { alert("��������λ��̫�٣�����������");  return false; } 
 }
</script>


