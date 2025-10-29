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
   if(!$result) $show_msg="<font color=red>写入文件失败,请重来</font>,";
   else $show_msg="<font color=red>恭喜,成功写入文件</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/auto_set_bak.php",RROOT."/config/auto_set.php");
    if(!$result) $show_msg="<font color=red>导入备份文件失败,可能文件不存在</font>,";
    else $show_msg="<font color=red>恭喜,成功恢复配置文件</font>,";
  }
  require_once(RROOT."/config/auto_set.php");
}

elseif(file_exists(RROOT."/config/auto_set.php")) {
 require_once(RROOT."/config/auto_set.php");
 $show_msg="从基本配置文件<font color=red> auto_set.php </font>读取,";
 }

elseif(file_exists(RROOT."/config_bak/auto_set_bak.php")) { 
 $show_msg="<font color=red>原配制文件不存在,现从备份文件读取</font>,";
 require_once(RROOT."/config_bak/auto_set_bak.php");
}

else $show_msg="<font color=red>系统基本配置没有完成</fong>,";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>无标题文档</title>
<script type="text/javascript" src="<?php echo "js/admin.js"; ?>" language="javascript"></script>
</head>
<body>
<form name="form1" method="post" action="">  
<table width="100%"  border="0" cellspacing="0" cellpadding="10">
    <tr>
      <td><?=$show_msg?>请填写表单进行设置&gt;&gt;        <div align="left"></div>
      <div align="center">        </div></td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="200"><div align="right">是否从备份文件恢复:</div></td>
      <td width="20">&nbsp;</td>
      <td width="370"><div align="left">
        <select name="restore" id="select2" onChange="Show_Hide_Obj()">
            <option value="1">从备份配置文件恢复</option>
            <option value="0" selected>保留目前的配置文件</option>
        </select>
      </div></td>
      <td>*恢复为上次的备份配置，慎重操作</td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5" id="form_input">
    <tr>
      <td width="200"><div align="right">默认缩略图大小:</div></td>
      <td width="20">&nbsp;</td>
      <td width="370"><div align="left">宽度:
          <input name="cfg_smallimg_width" type="text" id="cfg_smallimg_width" size="10" value="<?=$cfg_smallimg_width?>">
高度:
<input name="cfg_smallimg_height" type="text" id="cfg_smallimg_height" size="10" value="<?=$cfg_smallimg_height?>">
      </div></td>
      <td><p>*像素值</p>      </td>
    </tr>
    <tr>
      <td><div align="right">默认调整大小:</div></td>
      <td>&nbsp;</td>
      <td>宽度:
        <input name="cfg_img_width" type="text" id="cfg_img_width" size="10" value="<?=$cfg_img_width?>">
高度:
<input name="cfg_img_height" type="text" id="cfg_img_height" size="10" value="<?=$cfg_img_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">栏目缩略图大小:</div></td>
      <td>&nbsp;</td>
      <td>宽度:
        <input name="cfg_colsimg_width" type="text" id="cfg_colsimg_width" size="10" value="<?=$cfg_colsimg_width?>">
高度:
<input name="cfg_colsimg_height" type="text" id="cfg_colsimg_height" size="10" value="<?=$cfg_colsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">文章缩略图大小:</div></td>
      <td>&nbsp;</td>
      <td>宽度:
        <input name="cfg_artsimg_width" type="text" id="cfg_artsimg_width" size="10" value="<?=$cfg_artsimg_width?>">
高度:
<input name="cfg_artsimg_height" type="text" id="cfg_artsimg_height" size="10" value="<?=$cfg_artsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">图集缩略图大小:</div></td>
      <td>&nbsp;</td>
      <td>宽度:
        <input name="cfg_albsimg_width" type="text" id="cfg_albsimg_width" size="10" value="<?=$cfg_albsimg_width?>">
高度:
<input name="cfg_albsimg_height" type="text" id="cfg_albsimg_height" size="10" value="<?=$cfg_albsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">会员缩略图大小:</div></td>
      <td>&nbsp;</td>
      <td>宽度:
        <input name="cfg_memsimg_width" type="text" id="cfg_memsimg_width" size="10" value="<?=$cfg_memsimg_width?>">
高度:
<input name="cfg_memsimg_height" type="text" id="cfg_memsimg_height" size="10" value="<?=$cfg_memsimg_height?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">后台可以上传的文件类型:</div></td>
      <td>&nbsp;</td>
      <td>
      <textarea name="cfg_mb_filetype" style="width:350px" rows="4" id="cfg_mb_filetype"><?=$cfg_mb_filetype?></textarea></td>
      <td>*用|间隔，下二同</td>
    </tr>
    <tr>
      <td><div align="right">后台可以上传的软件类型:</div></td>
      <td>&nbsp;</td>
      <td><textarea name="cfg_mb_softtype" style="width:350px" rows="4" id="cfg_mb_softtype"><?=$cfg_mb_softtype?>
      </textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">
        <p>后台可以上传的媒体类型:</p>
        </div></td>
      <td>&nbsp;</td>
      <td><textarea name="cfg_mb_mediatype" style="width:350px" rows="4" id="cfg_mb_mediatype"><?=$cfg_mb_mediatype?>
      </textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">栏目缩略图目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_cosmimg_root" type="text" id="cfg_cosmimg_root" value="<?=$cfg_cosmimg_root?>" style="width:350px"></td>
      <td>*相对$cfg_upload_root来说,以下同</td>
    </tr>
    <tr>
      <td><div align="right">文章缩略图目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_obsmimg_root" type="text" id="cfg_obsmimg_root" value="<?=$cfg_obsmimg_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">flash主目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_flash_root" type="text" id="cfg_flash_root" value="<?=$cfg_flash_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">媒体文件目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_media_root" type="text" id="cfg_media_root" value="<?=$cfg_media_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">相册/图集目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_album_root" type="text" id="cfg_album_root" value="<?=$cfg_album_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">一般图片目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_img_root" type="text" id="cfg_img_root" value="<?=$cfg_img_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">上传文本文件目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_doc_root" type="text" id="cfg_doc_root" value="<?=$cfg_doc_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">上传软件目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_soft_root" type="text" id="cfg_soft_root" value="<?=$cfg_soft_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">用户文件目录:</div></td>
      <td>&nbsp;</td>
      <td><input name="cfg_user_root" type="text" id="cfg_user_root" value="<?=$cfg_user_root?>" style="width:350px"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">覆盖配置备份文件:</div></td>
      <td>&nbsp;</td>
      <td><select name="overwrite" id="overwrite">
        <option value="1">覆盖备份文件</option>
        <option value="0" selected>不覆盖备文件</option>
      </select></td>
      <td>*请慎重操作</td>
    </tr>
  </table>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="200">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input name="submit" type="submit" id="submit2" value="提 交"  onClick="return really();"></td>
          <td><input type="reset" name="Submit2" value="取 消"></td>
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
      result="您确认要覆盖备份文件吗？";   
      if   (confirm(result))   return true;
      else return false;
	  }
	  else if(document.all.restore.value=="1"){
      result="您确认要从备份文件恢复吗？";   
      if   (confirm(result))   return true;
      else return false;
	  }
	  
 }
 function Show_Hide_Obj() {
  if(document.all.restore.value=="1") HideObj('form_input');
  else ShowObj('form_input');
 }
</script>
