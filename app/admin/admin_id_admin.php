<?php 
   require_once("setting.php");
   require_once("inc.php"); 
   require_once("function/inc_function.php");    
?><html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
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
		  <?php if($_SESSION['root']=="super_administrator") { 
		    if(isset($_REQUEST['sub_add'])) { 
			$level=$_REQUEST['type'];
		    $real_name=trim($_REQUEST['real_name']);
			$admin_id=trim($_REQUEST['id']); 
			$password=md5(trim($_REQUEST['password']));
			$writer_name=trim($_REQUEST['writer_name']); 
			$telephone=trim($_REQUEST['telephone']);
			$register_time=date("y-m-d H:i:s");
			$life=$_REQUEST['life'];
			
			$result=mysql_query("select * from ".$table_suffix."member where user_name='$admin_id'");
            if(mysql_num_rows($result))  ShowMsg("�Բ���,���û����Ѿ�����ͨ��Աʹ��,������.",-1);
			else {
			$result=mysql_query("select * from ".$table_suffix."admin where admin_id='$admin_id'");
            if(mysql_num_rows($result))  ShowMsg("�Բ���,���û����Ѿ�����������Աʹ��,������.",-1);
			else {
			$result=@mysql_query("insert into ".$table_suffix."admin (writer_name,telephone, admin_level,real_name,admin_id, admin_password, register_time,life) values 
			('$writer_name','$telephone', '$level','$real_name','$admin_id','$password','$register_time','$life')");
			if($result)  { 
			$out_string="OK����ӳɹ����û�����".$id." ���룺".trim($_REQUEST['password']);
			MsgClose($out_string);
			}
			else {
			 $out_string="SORRY�����ʧ�ܣ������˺��������ʺ��ظ��ˣ��������ݿ���ʱ����д��"; 
			 ShowMsg($out_string, -1);
			   }
			 }
		   }
		  }
		  elseif(isset($_REQUEST['add'])) { ?>
          <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><form name="form1" method="post" action="<?=$PHP_SELF?>">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="10" rowspan="5">&nbsp;</td>
                            <td colspan="2" bgcolor="#FFCCCC">��ѡ�����Ա�ʺ�����:
                              <input type="radio" name="type" value="9">
                              ����
                              <input name="type" type="radio" value="1" checked>
                              ��ͨ</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><p>����
                              <input name="real_name" type="text" id="real_name">
                            </p>                              </td>
                            <td>�˺���Ч��
                              <select name="life" id="life">
                                <option value="1"selected>��Ч</option>
                                <option value="0">��Ч</option>
                              </select></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>����
                              <input name="writer_name" type="text" id="writer_name"></td>
                            <td>�绰
                              <input name="telephone" type="text" id="real_name3"></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>�˺�
                              <input type="text" name="id" value=""></td>
                            <td>����
                              <input name="password" type="text" id="password2" value=""></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><input name="sub_add" type="submit" id="sub_add" value="�� ��" onClick="return chk_if_blank();"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
              </table></td>
            </tr>
          </table>
		    <?php }
				   elseif(isset($_REQUEST['submit'])) { 
				   $id=trim($_REQUEST['id']); 
				   $password=md5(trim($_REQUEST['password']));
				   $life=$_REQUEST['life'];
				   $result=@mysql_query("update ".$table_suffix."admin set admin_password='$password', life='$life' where admin_id='$id'");
				   if($result) { 
			       if($life=="1")  $out_string = " OK�����³ɹ����û�����".$id." ���룺".trim($_REQUEST['password']);
			       else $out_string = "�����ɹ�, ���û��ѱ���ֹ��";
				   if($_SESSION['admin_valid']==$id) $_SESSION['pass_valid']=$password;
				   MsgClose($out_string);
				   }
				   else  { 
				    $out_string="SORRY������ʧ��!";   
			        ShowMsg($out_string, -1);
				    }
				   } 
				   elseif(isset($_REQUEST['edit_id'])){ 
				   $id=$_REQUEST['edit_id'];
				   $query="select * from ".$table_suffix."admin where admin_id='$id'";
				   $result=@mysql_query($query);
				   ?>
                    <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
                      <tr>
                        <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><form name="form1" method="post" action="<?=$PHP_SELF?>">
                              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td width="10" rowspan="3">&nbsp;</td>
                                  <td>�˺�:
                                  <?php echo $id=@mysql_result($result,0,"admin_id")?>
                                  <input type="hidden" name="id" value="<?php echo $id ?>"></td>
                                  <td>�˺���Ч��
                                    <select name="life">
                                      <option value="1" <?php if(@mysql_result($result,0,"life")=="1") echo "selected"; ?>>��Ч</option>
                                      <option value="0" <?php if(@mysql_result($result,0,"life")=="0") echo "selected"; ?>>��Ч</option>
                                    </select>
</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>����
                                  <input name="password" type="password" id="password1" value=""></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><input name="submit" type="submit" id="submit" value="�� ��" onClick="return chk_if_blank();"></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table>
                            </form></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                <?php } 
		    }
		   else { ?>
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <table border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFFFFF">�����ǳ�������Ա��û��Ȩ�޷��ʴ�ҳ��</td>
                  </tr>
                </table>
                <table border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><a href="javascript:history.go(-1)">�������</a></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table>
		  <script> alert("�Բ�������Ȩ���ʴ�ҳ��");</script>
		  <?php } ?>
		 <div id="bodyframe" style="VISIBILITY: hidden">
        <IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
		 </div>
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
function chk_if_blank(){
 var obj=document.all;
 if(obj.id.value==""||obj.password.value==""||obj.real_name.value==""||obj.writer_name.value==""||obj.telephone.value=="") 
  { if(obj.life.value=="0") return true; 
    else { 
	alert("����������д����"); return false; 
	  }
	}
}
</script>


