<?php session_start();
require_once("setting.php");
if(basename($_SERVER['PHP_SELF'])=="other_cfg_edit.php") { 
   echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; 
 }//this file can not be visited unless it is included by "sys_config.php" under the parent directory!
if(isset($_POST['submit'])) { 

$cfg_smallimg_height=trim($_POST['cfg_smallimg_height']);
$cfg_smallimg_width=trim($_POST['cfg_smallimg_width']);

$cfg_colsimg_width=trim($_POST['cfg_colsimg_width']); 
$cfg_colsimg_height=trim($_POST['cfg_colsimg_height']);   

$cfg_artsimg_width=trim($_POST['cfg_artsimg_width']);  
$cfg_artsimg_height=trim($_POST['cfg_artsimg_height']);  

$cfg_albsimg_width=trim($_POST['cfg_albsimg_width']);  
$cfg_albsimg_height=trim($_POST['cfg_albsimg_height']); 

$cfg_memsimg_width=trim($_POST['cfg_memsimg_width']);  
$cfg_memsimg_height=trim($_POST['cfg_memsimg_height']); 

$cfg_img_width=trim($_POST['cfg_img_width']);      
$cfg_img_height=trim($_POST['cfg_img_height']);    

$cfg_mb_filetype =trim($_POST['cfg_mb_filetype']);
$cfg_mb_mediatype =trim($_POST['cfg_mb_mediatype']);
$cfg_mb_softtype=trim($_POST['cfg_mb_softtype']);
$cfg_cosmimg_root=trim($_POST['cfg_cosmimg_root']);
$cfg_obsmimg_root=trim($_POST['cfg_obsmimg_root']);
$cfg_flash_root=trim($_POST['cfg_flash_root']);
$cfg_media_root=trim($_POST['cfg_media_root']);
$cfg_doc_root=trim($_POST['cfg_doc_root']);
$cfg_img_root=trim($_POST['cfg_img_root']);
$cfg_album_root=trim($_POST['cfg_album_root']);
$cfg_soft_root=trim($_POST['cfg_soft_root']);
$cfg_user_root=trim($_POST['cfg_user_root']);


$result="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<?php 
\$cfg_smallimg_height=\"$cfg_smallimg_height\";
\$cfg_smallimg_width=\"$cfg_smallimg_width\";

\$cfg_colsimg_width=\"$cfg_colsimg_width\"; 
\$cfg_colsimg_height=\"$cfg_colsimg_height\";   

\$cfg_artsimg_width=\"$cfg_artsimg_width\";  
\$cfg_artsimg_height=\"$cfg_artsimg_height\";  

\$cfg_albsimg_width=\"$cfg_albsimg_width\";  
\$cfg_albsimg_height=\"$cfg_albsimg_height\"; 

\$cfg_memsimg_width=\"$cfg_memsimg_width\";  
\$cfg_memsimg_height=\"$cfg_memsimg_height\"; 

\$cfg_img_width=\"$cfg_img_width\";      
\$cfg_img_height=\"$cfg_img_height\";    

\$cfg_mb_filetype =\"$cfg_mb_filetype\";
\$cfg_cosmimg_root=\"$cfg_cosmimg_root\";
\$cfg_obsmimg_root=\"$cfg_obsmimg_root\";
\$cfg_flash_root=\"$cfg_flash_root\";
\$cfg_media_root=\"$cfg_media_root\";
\$cfg_doc_root=\"$cfg_doc_root\";
\$cfg_img_root=\"$cfg_img_root\";
\$cfg_album_root=\"$cfg_album_root\";
\$cfg_soft_root=\"$cfg_soft_root\";
\$cfg_user_root=\"$cfg_user_root\";
\$cfg_mb_softtype=\"$cfg_mb_softtype\";
\$cfg_mb_mediatype=\"$cfg_mb_mediatype\";
?>";
if($_POST['restore']=="0") {
  $fp=fopen(RROOT."/config/auto_set.php","w");
  $result=fwrite($fp,$result);
  fclose($fp);
  if($_POST['overwrite']=="1")
   $result=copy(RROOT."/config/auto_set.php", RROOT."/config_bak/auto_set_bak.php");
   if(!$result) $show_msg="<font color=red>д���ļ�ʧ��,������</font>,";
   else $show_msg="<font color=red>��ϲ,�ɹ�д���ļ�</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/auto_set_bak.php",RROOT."/config/auto_set.php");
    if(!$result) $show_msg="<font color=red>���뱸���ļ�ʧ��,�����ļ�������</font>,";
    else $show_msg="<font color=red>��ϲ,�ɹ��ָ������ļ�</font>,";
  }
  require_once(RROOT."/config/auto_set.php");
}

elseif(file_exists(RROOT."/config/auto_set.php")) {
 require_once(RROOT."/config/auto_set.php");
 $show_msg="�ӻ��������ļ�<font color=red> auto_set.php </font>��ȡ,";
 }

elseif(file_exists(RROOT."/config_bak/auto_set_bak.php")) { 
 $show_msg="<font color=red>ԭ�����ļ�������,�ִӱ����ļ���ȡ</font>,";
 require_once(RROOT."/config_bak/auto_set_bak.php");
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
      <td width="200"><div align="right">Ĭ������ͼ��С:</div></td>
      <td width="20">&nbsp;</td>
      <td width="370"><div align="left">���:
          <input name="cfg_smallimg_width" type="text" id="cfg_smallimg_width" size="10" value="<?=$cfg_smallimg_width?>">
�߶�:
<input name="cfg_smallimg_height" type="text" id="cfg_smallimg_height" size="10" value="<?=$cfg_smallimg_height?>">
      </div></td>
      <td><p>*����ֵ</p>      </td>
    </tr>
    <tr>
      <td><div align="right">Ĭ�ϵ�����С:</div></td>
      <td>&nbsp;</td>
      <td>���:
        <input name="cfg_img_width" type="text" id="cfg_img_width" size="10" value="<?=$cfg_img_width?>">
�߶�:
<input name="cfg_img_height" type="text" id="cfg_img_height" size="10" value="<?=$cfg_img_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">��Ŀ����ͼ��С:</div></td>
      <td>&nbsp;</td>
      <td>���:
        <input name="cfg_colsimg_width" type="text" id="cfg_colsimg_width" size="10" value="<?=$cfg_colsimg_width?>">
�߶�:
<input name="cfg_colsimg_height" type="text" id="cfg_colsimg_height" size="10" value="<?=$cfg_colsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">��������ͼ��С:</div></td>
      <td>&nbsp;</td>
      <td>���:
        <input name="cfg_artsimg_width" type="text" id="cfg_artsimg_width" size="10" value="<?=$cfg_artsimg_width?>">
�߶�:
<input name="cfg_artsimg_height" type="text" id="cfg_artsimg_height" size="10" value="<?=$cfg_artsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">ͼ������ͼ��С:</div></td>
      <td>&nbsp;</td>
      <td>���:
        <input name="cfg_albsimg_width" type="text" id="cfg_albsimg_width" size="10" value="<?=$cfg_albsimg_width?>">
�߶�:
<input name="cfg_albsimg_height" type="text" id="cfg_albsimg_height" size="10" value="<?=$cfg_albsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">��Ա����ͼ��С:</div></td>
      <td>&nbsp;</td>
      <td>���:
        <input name="cfg_memsimg_width" type="text" id="cfg_memsimg_width" size="10" value="<?=$cfg_memsimg_width?>">
�߶�:
<input name="cfg_memsimg_height" type="text" id="cfg_memsimg_height" size="10" value="<?=$cfg_memsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">��̨�����ϴ����ļ�����:</div></td>
      <td>&nbsp;</td>
      <td>
      <textarea name="cfg_mb_filetype" style="width:350px" rows="4" id="cfg_mb_filetype"><?=$cfg_mb_filetype?></textarea></td>
      <td>*��|������¶�ͬ</td>
    </tr>
    <tr>
      <td><div align="right">��̨�����ϴ����������:</div></td>
      <td>&nbsp;</td>
      <td><textarea name="cfg_mb_softtype" style="width:350px" rows="4" id="cfg_mb_softtype"><?=$cfg_mb_softtype?>
      </textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">
        <p>��̨�����ϴ���ý������:</p>
        </div></td>
      <td>&nbsp;</td>
      <td><textarea name="cfg_mb_mediatype" style="width:350px" rows="4" id="cfg_mb_mediatype"><?=$cfg_mb_mediatype?>
      </textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">��Ŀ����ͼĿ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_cosmimg_root" type="text" id="cfg_cosmimg_root" value="<?=$cfg_cosmimg_root?>" style="width:350px"></td>
      <td>*���$cfg_upload_root��˵,����ͬ</td>
    </tr>
    <tr>
      <td><div align="right">��������ͼĿ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_obsmimg_root" type="text" id="cfg_obsmimg_root" value="<?=$cfg_obsmimg_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">flash��Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_flash_root" type="text" id="cfg_flash_root" value="<?=$cfg_flash_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">ý���ļ�Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_media_root" type="text" id="cfg_media_root" value="<?=$cfg_media_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">���/ͼ��Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_album_root" type="text" id="cfg_album_root" value="<?=$cfg_album_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">һ��ͼƬĿ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_img_root" type="text" id="cfg_img_root" value="<?=$cfg_img_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">�ϴ��ı��ļ�Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_doc_root" type="text" id="cfg_doc_root" value="<?=$cfg_doc_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">�ϴ����Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_soft_root" type="text" id="cfg_soft_root" value="<?=$cfg_soft_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">�û��ļ�Ŀ¼:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_user_root" type="text" id="cfg_user_root" value="<?=$cfg_user_root?>" style="width:350px"></td>
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
