<?php session_start();
require_once("setting.php");
if(basename($_SERVER['PHP_SELF'])=="base_cfg_edit.php") { 
   echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; 
 }//this file can not be visited unless it is included by "sys_config.php" under the parent directory!
if(isset($_POST['submit'])) { 

$cfg_mainsite=trim($_POST['cfg_mainsite']);
$cfg_logo=trim($_POST['cfg_logo']);
$cfg_base_url=trim($_POST['cfg_base_url']);
$cfg_index_style=trim($_POST['cfg_index_style']);
$cfg_body_width=trim($_POST['cfg_body_width']);
$cfg_root=trim($_POST['cfg_root']);
$cfg_admin_root=trim($_POST['cfg_admin_root']);
$cfg_upload_root=trim($_POST['cfg_upload_root']);
$cfg_site_name=trim($_POST['cfg_site_name']);
$cfg_index_title=trim($_POST['cfg_index_title']);
$cfg_meta_keywords=trim($_POST['cfg_meta_keywords']);
$cfg_meta_description=trim($_POST['cfg_meta_description']);
$cfg_copyright=trim($_POST['cfg_copyright']);
$cfg_webmaster=trim($_POST['cfg_webmaster']);
$cfg_beian=trim($_POST['cfg_beian']);
$cfg_code_chk=$_POST['cfg_code_chk'];
$cfg_cookie_pass=trim($_POST['cfg_cookie_pass']);

$result="<?php error_reporting(0); ?>\n<?php session_start(); ?>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<?php 
\$cfg_mainsite=\"$cfg_mainsite\";
\$cfg_logo=\"$cfg_logo\";
\$cfg_base_url=\"$cfg_base_url\";
\$cfg_index_style=\"$cfg_index_style\";
\$cfg_body_width=\"$cfg_body_width\";
\$cfg_root=\"$cfg_root\";
\$cfg_admin_root=\"$cfg_admin_root\";
\$cfg_upload_root=\"$cfg_upload_root\";
\$cfg_site_name=\"$cfg_site_name\";
\$cfg_index_title=\"$cfg_index_title\";
\$cfg_meta_keywords=\"$cfg_meta_keywords\";
\$cfg_meta_description=\"$cfg_meta_description\";
\$cfg_copyright=\"$cfg_copyright\";
\$cfg_webmaster=\"$cfg_webmaster\";
\$cfg_beian=\"$cfg_beian\";
\$cfg_code_chk=\"$cfg_code_chk\";
\$cfg_cookie_pass=\"$cfg_cookie_pass\";
?>";
if($_POST['restore']=="0") {
  $fp=fopen(RROOT."/config/base_cfg.php","w");
  $result=fwrite($fp,$result);
  fclose($fp);
  if($_POST['overwrite']=="1")
   $result=copy(RROOT."/config/base_cfg.php", RROOT."/config_bak/base_cfg_bak.php");
   if(!$result) $show_msg="<font color=red>д���ļ�ʧ��,������</font>,";
   else $show_msg="<font color=red>��ϲ,�ɹ�д���ļ�</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/base_cfg_bak.php",RROOT."/config/base_cfg.php");
    if(!$result) $show_msg="<font color=red>���뱸���ļ�ʧ��,�����ļ�������</font>,";
    else $show_msg="<font color=red>��ϲ,�ɹ��ָ������ļ�</font>,";
  }
  require_once(RROOT."/config/base_cfg.php");
}

elseif(file_exists(RROOT."/config/base_cfg.php")) {
 require_once(RROOT."/config/base_cfg.php");
 $show_msg="�ӻ��������ļ�<font color=red> base_cfg.php </font>��ȡ,";
 }

elseif(file_exists(RROOT."/config_bak/base_cfg_bak.php")) { 
 $show_msg="<font color=red>ԭ�����ļ�������,�ִӱ����ļ���ȡ</font>,";
 require_once(RROOT."/config_bak/base_cfg_bak.php");
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
      <td width="200"><div align="right">��ϵͳ���ʵ�ַ:</div></td>
      <td width="20" rowspan="17">&nbsp;</td>
      <td width="370"><div align="left">
        <input name="cfg_mainsite" type="text" id="cfg_mainste" style="width:350px" value="<?=$cfg_mainsite?>">
      </div></td>
      <td><p>*��ϵͳ��װ��ַ,���������վ��Ŀ¼,��Ϊhttp://localhost/</p>      </td>
    </tr>
    <tr>
      <td><div align="right">վ���־ͼ:</div></td>
      <td><input name="cfg_logo" type="text" id="cfg_logo" style="width:350px" value="<?=$cfg_logo?>"></td>
      <td>*�ϴ�ͼƬ��ָ����ַ</td>
    </tr>
    <tr>
      <td><div align="right">վ�������:</div></td>
      <td><div align="left">
        <input name="cfg_base_url" type="text" id="cfg_base_url" style="width:350px" value="<?=$cfg_base_url?>">
      </div></td>
      <td>*��վ������</td>
    </tr>
    <tr>
      <td><div align="right">��ҳ���ѡ��:</div></td>
      <td><select name="cfg_index_style" id="cfg_index_style" style="width:350px">
        <option value="index_style1.php" <?php if($cfg_index_style=="index_style1.php") echo "selected";?>>�������</option>
        <option value="index_style2.php" <?php if($cfg_index_style=="index_style2.php") echo "selected";?>>�������</option>
      </select></td>
      <td>*��ҳ�ķ��,Ĭ��Ϊ�������</td>
    </tr>
    <tr>
      <td><div align="right">��վҳ����:</div></td>
      <td><input name="cfg_body_width" type="text" id="cfg_body_width" style="width:350px" value="<?=$cfg_body_width?>"></td>
      <td>*ҳ��Ŀ������(ֻ��������,����776)</td>
    </tr>
    <tr>
      <td><div align="right">ϵͳ��װĿ¼:</div></td>
      <td><div align="left">
        <input name="cfg_root" type="text" id="cfg_root" style="width:350px" value="<?=$cfg_root?>">
      </div></td>
      <td>*�ƶ�ϵͳλ�ú���Ը���</td>
    </tr>
    <tr>
      <td><div align="right">����Ŀ¼:</div></td>
      <td><div align="left">
        <input name="cfg_admin_root" type="text" id="cfg_admin_root" style="width:350px" value="<?=$cfg_admin_root?>">
      </div></td>
      <td>*��������Ŀ¼��������Ӧ����</td>
    </tr>
    <tr>
      <td><div align="right">�ϴ��ļ�Ŀ¼:</div></td>
      <td><div align="left">
        <input name="cfg_upload_root" type="text" id="cfg_upload_root" style="width:350px" value="<?=$cfg_upload_root?>">
      </div></td>
      <td>*����λ��,���Ը���Ŀ¼��</td>
    </tr>
    <tr>
      <td><div align="right">վ������:</div></td>
      <td><div align="left">
        <input name="cfg_site_name" type="text" id="cfg_site_name" style="width:350px" value="<?=$cfg_site_name?>">
      </div></td>
      <td>*վ�����ģ�Ӣ������</td>
    </tr>
    <tr>
      <td><div align="right">��ҳ����:</div></td>
      <td><input name="cfg_index_title" type="text" id="cfg_index_title" style="width:350px" value="<?=$cfg_index_title?>"></td>
      <td>*ϵͳ��ҳ�ı���</td>
    </tr>
    <tr>
      <td><div align="right">��ҳMETA�ؼ���:</div></td>
      <td><input name="cfg_meta_keywords" type="text" id="cfg_meta_keywords" style="width:350px" value="<?=$cfg_meta_keywords?>"></td>
      <td>*���Ż��߿ո���</td>
    </tr>
    <tr>
      <td><div align="right">��ҳMETA����:</div></td>
      <td><input name="cfg_meta_description" type="text" id="cfg_meta_description" style="width:350px" value="<?=$cfg_meta_description ?>"></td>
      <td>*���⣢���/��һ��������</td>
    </tr>
    <tr>
      <td><div align="right">��Ȩ��Ϣ:</div></td>
      <td><input name="cfg_copyright" type="text" id="cfg_copyright" style="width:350px" value="<?=$cfg_copyright ?>"></td>
      <td>*ע�����һ���Ȩ�����ķ�ʽ</td>
    </tr>
    <tr>
      <td><div align="right">����Ա�Լ��ʼ�:</div></td>
      <td><input name="cfg_webmaster" type="text" id="cfg_webmaster" style="width:350px" value="<?=$cfg_webmaster ?>"></td>
      <td>*����Ա���ǳƣ����ʼ���ַ��</td>
    </tr>
    <tr>
      <td><div align="right">վ�㱸����:</div></td>
      <td><input name="cfg_beian" type="text" id="cfg_beian" style="width:350px" value="<?=$cfg_beian ?>"></td>
      <td>*�����󷽿���д</td>
    </tr>
    <tr>
      <td><div align="right">������֤��:</div></td>
      <td>        <select name="cfg_code_chk" id="cfg_code_chk">
        <option value="1" <? if($cfg_code_chk=="1")  echo "selected"; ?>>����</option>
        <option value="0" <? if($cfg_code_chk=="0")  echo "selected"; ?>>������</option>
      </select></td>
      <td>*ָ��̨��½��֤��Ĭ��Ϊ����֤</td>
    </tr>
    <tr>
      <td><div align="right">COOKIE�����ַ���:</div></td>
      <td><input name="cfg_cookie_pass" type="text" id="cfg_cookie_pass" style="width:350px" value="<?=$cfg_cookie_pass ?>"></td>
      <td>*������ַ���</td>
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