<?php session_start();
require_once("setting.php");
if(basename($_SERVER['PHP_SELF'])=="core_cfg_edit.php") { 
   echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; 
 }//this file can not be visited unless it is included by "sys_config.php" under the parent directory!
if(isset($_POST['submit'])) { 
   $db_name=trim($_POST['db_name']);
   $table_suffix=trim($_POST['table_suffix']);
   $db_user=trim($_POST['db_user']);
   $db_password_old=trim($_POST['db_password_old']);
   $db_password=trim($_POST['db_password']);
   $db_url=trim($_POST['db_url']);
   if($db_password_old<>$_SESSION['db_password_old'])  {echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; }
   
$result="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<?php 
\$db_name=\"$db_name\";
\$table_suffix=\"$table_suffix\";
\$db_user=\"$db_user\";
\$db_password=\"$db_password\";
\$db_url=\"$db_url\";
?>";
if($_POST['restore']=="0") {
  $fp=fopen(RROOT."/dbscripts/config.php","w");
  $result=fwrite($fp,$result);
  fclose($fp);
  if($_POST['overwrite']=="1")
   $result=copy(RROOT."/dbscripts/config.php", RROOT."/dbscripts/config_bak.php");
   if(!$result) $show_msg="<font color=red>д���ļ�ʧ��,������</font>,";
   else $show_msg="<font color=red>��ϲ,�ɹ�д���ļ�</font>,";
  } 
 else { 
	$result=copy(RROOT."/dbscripts/config_bak.php",RROOT."/dbscripts/config.php");
    if(!$result) $show_msg="<font color=red>���뱸���ļ�ʧ��,�����ļ�������</font>,";
    else $show_msg="<font color=red>��ϲ,�ɹ��ָ������ļ�</font>,";
  }
  require_once(RROOT."/dbscripts/config.php");
  session_register("db_password_old");
  $_SESSION['db_password_old']=$db_password;
}

elseif(file_exists(RROOT."/dbscripts/config.php")) {
 require_once(RROOT."/dbscripts/config.php");
 $show_msg="�ӻ��������ļ�<font color=red> core_cfg.php </font>��ȡ,";
 session_register("db_password_old");
 $_SESSION['db_password_old']=$db_password;
 }

elseif(file_exists(RROOT."/dbscripts/config_bak.php")) { 
 $show_msg="<font color=red>ԭ�����ļ�������,�ִӱ����ļ���ȡ</font>,";
 require_once(RROOT."/dbscripts/config_bak.php");
 session_register("db_password_old");
 $_SESSION['db_password_old']=$db_password;
}

else $show_msg="<font color=red>ϵͳ��������û�����</fong>,";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ޱ����ĵ�</title>
<script type="text/javascript" src="<?php echo "js/admin.js"; ?>" language="javascript"></script>
</head>
<body>
<form name="form1" method="post" action="">  
<table width="100%"  border="0" cellspacing="0" cellpadding="10">
    <tr>
      <td><?=$show_msg?>����д����������&gt;&gt;        <div align="left"></div>
      <div align="center">        </div></td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="200"><div align="right">�Ƿ�ӱ����ļ��ָ�:</div></td>
      <td width="20">&nbsp;</td>
      <td width="370"><div align="left">
        <select name="restore" id="select2" onChange="Show_Hide_Obj()">
            <option value="1">�ӱ��������ļ��ָ�</option>
            <option value="0" selected>����Ŀǰ�������ļ�</option>
        </select>
      </div></td>
      <td>*�ָ�Ϊ�ϴεı������ã����ز���</td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5" id="form_input">
    <tr>
        <td><div align="right">�����ݿ�����:</div></td>
      <td width="20" rowspan="6">&nbsp;</td>
        <td><input name="db_password_old" type="password" id="db_password_old" style="width:350px"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="200"><div align="right">���ݿ���:</div></td>
      <td width="370"><div align="left">
        <input name="db_name" type="text" id="cfg_mainste" style="width:350px" value="<?=$db_name?>">
      </div></td>
      <td><p>&nbsp;</p>      </td>
    </tr>
    <tr>
      <td><div align="right">���ݱ�ǰ׺:</div></td>
      <td><input name="table_suffix" type="text" id="table_suffix" style="width:350px" value="<?=$table_suffix?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">���ݿ��û���:</div></td>
      <td><div align="left">
        <input name="db_user" type="text" id="db_user" style="width:350px" value="<?=$db_user?>">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">�����ݿ�����:</div></td>
      <td><div align="left">
        <input name="db_password" type="password" id="db_password" style="width:350px" value="">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">���ݿ��������ַ:</div></td>
      <td><div align="left">
        <input name="db_url" type="text" id="db_url" style="width:350px" value="<?=$db_url?>">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">�������ñ����ļ�:</div></td>
      <td>&nbsp;</td>
      <td><select name="overwrite" id="overwrite">
        <option value="1">���Ǳ����ļ�</option>
        <option value="0" selected>�����Ǳ��ļ�</option>
      </select></td>
      <td>*�����ز���</td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="200">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input name="submit" type="submit" id="submit2" value="�� ��"  onClick="return really();"></td>
          <td><input type="reset" name="Submit2" value="ȡ ��"></td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>
function really() {
      if(document.all.overwrite.value=="1"){
      result="��ȷ��Ҫ���Ǳ����ļ���";   
      if   (confirm(result))   return true;
      else return false;
	  }
	  else if(document.all.restore.value=="1"){
      result="��ȷ��Ҫ�ӱ����ļ��ָ���";   
      if   (confirm(result))   return true;
      else return false;
	  }
	  
 }
 function Show_Hide_Obj() {
  if(document.all.restore.value=="1") HideObj('form_input');
  else ShowObj('form_input');
 }
</script>