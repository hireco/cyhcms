<?php session_start();
require_once("setting.php");
if(basename($_SERVER['PHP_SELF'])=="mail_cfg_edit.php") { 
   echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; 
 }//this file can not be visited unless it is included by "sys_config.php" under the parent directory!
if(isset($_POST['submit'])) { 

$cfg_mail_server=trim($_POST['cfg_mail_server']);
$cfg_mail_account=trim($_POST['cfg_mail_account']);
$cfg_mail_password=trim($_POST['cfg_mail_password']);
$cfg_mail_reply=trim($_POST['cfg_mail_reply']);


$result="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<?php 
\$cfg_mail_server=\"$cfg_mail_server\";
\$cfg_mail_account=\"$cfg_mail_account\";
\$cfg_mail_password=\"$cfg_mail_password\";
\$cfg_mail_reply=\"$cfg_mail_reply\";
?>";
if($_POST['restore']=="0") {
  $fp=fopen(RROOT."/config/mail_cfg.php","w");
  $result=fwrite($fp,$result);
  fclose($fp);
  if($_POST['overwrite']=="1")
   $result=copy(RROOT."/config/mail_cfg.php", RROOT."/config_bak/mail_cfg_bak.php");
   if(!$result) $show_msg="<font color=red>д���ļ�ʧ��,������</font>,";
   else $show_msg="<font color=red>��ϲ,�ɹ�д���ļ�</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/mail_cfg_bak.php",RROOT."/config/mail_cfg.php");
    if(!$result) $show_msg="<font color=red>���뱸���ļ�ʧ��,�����ļ�������</font>,";
    else $show_msg="<font color=red>��ϲ,�ɹ��ָ������ļ�</font>,";
  }
  require_once(RROOT."/config/mail_cfg.php");
}

elseif(file_exists(RROOT."/config/mail_cfg.php")) {
 require_once(RROOT."/config/mail_cfg.php");
 $show_msg="�ӻ��������ļ�<font color=red> mail_cfg.php </font>��ȡ,";
 }

elseif(file_exists(RROOT."/config_bak/mail_cfg_bak.php")) { 
 $show_msg="<font color=red>ԭ�����ļ�������,�ִӱ����ļ���ȡ</font>,";
 require_once(RROOT."/config_bak/mail_cfg_bak.php");
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
      <td width="200"><div align="right">�ʼ���������ַ:</div></td>
      <td width="20" rowspan="17">&nbsp;</td>
      <td width="370"><div align="left">
        <input name="cfg_mail_server" type="text" id="cfg_mail_server" style="width:350px" value="<?=$cfg_mail_server?>">
      </div></td>
      <td><p>*Ӧ��֧��smtp�ȹ���</p>      </td>
    </tr>
    <tr>
      <td><div align="right">�ʼ��������ʺ�:</div></td>
      <td><input name="cfg_mail_account" type="text" id="cfg_mail_account" style="width:350px" value="<?=$cfg_mail_account?>"></td>
      <td>*������¼�ʼ����������ʺ�</td>
    </tr>
    <tr>
      <td><div align="right">�ʼ�����������:</div></td>
      <td><div align="left">
        <input name="cfg_mail_password" type="password" id="cfg_mail_password" style="width:350px" value="">
      </div></td>
      <td>*������¼�ʼ�������������</td>
    </tr>
    <tr>
      <td><div align="right">�ظ��ʼ���ַ:</div></td>
      <td><input name="cfg_mail_reply" type="text" id="cfg_mail_reply" style="width:350px" value="<?=$cfg_mail_reply?>"></td>
      <td>*Ĭ���ʼ��ظ���ַ</td>
    </tr>
    <tr>
      <td><div align="right">�������ñ����ļ�:</div></td>
      <td><select name="overwrite" id="select">
        <option value="1">���Ǳ����ļ�</option>
        <option value="0" selected>�����Ǳ��ļ�</option>
      </select></td>
      <td colspan="2">*�����ز���</td>
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