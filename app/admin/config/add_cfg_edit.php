<?php session_start();
require_once("setting.php");
if(basename($_SERVER['PHP_SELF'])=="add_cfg_edit.php") { 
   echo "<script>alert(\"Permission Denied!\"); history.go(-1);</script>"; exit; 
 }//this file can not be visited unless it is included by "sys_config.php" under the parent directory!
if(isset($_POST['submit'])) { 
  $result="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"> \n<?php \n";
  if ( isset( $_POST ) )  $postArray = &$_POST ;
    foreach ( $postArray as $sForm => $value )
   {
	if ( get_magic_quotes_gpc() )
		$$sForm = stripslashes( trim($value) )  ;
	else
		$$sForm = trim($value)  ;
    if(ereg("^cfg_",$sForm))   
	$result=$result."\$_POST['".$sForm."']=\"".$$sForm."\"; \n\$".$sForm."=\"".$$sForm."\"; \n";  
    else if(ereg("^show_cfg_desc_",$sForm))  
     $result=$result."\$show_cfg_desc['".ereg_replace("show_cfg_desc_","",$sForm)."']=\"".$$sForm."\"; \n";
    
	}
  if(($_POST['new_desc']<>"")&&($_POST['new_cfg']<>"")&&($_POST['new_cfg_value']<>""))
  $result=$result."\$show_cfg_desc['".$_POST['new_cfg']."']=\"".$_POST['new_desc']."\"; "."\n\$_POST['".$_POST['new_cfg']."']=\"".$_POST['new_cfg_value']."\"; "."
  \n\$".$_POST['new_cfg']."=\"".$_POST['new_cfg_value']."\"; ";
  
  $result=$result." \n ?>";
   
 if($_POST['restore']=="0") {
  $fp=fopen(RROOT."/config/add_set.php","w");
  $result=fwrite($fp,$result);
  fclose($fp);
  if($_POST['overwrite']=="1")
   $result=copy(RROOT."/config/add_set.php", RROOT."/config_bak/add_set_bak.php");
   if(!$result) $show_msg="<font color=red>д���ļ�ʧ��,������</font>,";
   else $show_msg="<font color=red>��ϲ,�ɹ�д���ļ�</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/add_set_bak.php",RROOT."/config/add_set.php");
    if(!$result) $show_msg="<font color=red>���뱸���ļ�ʧ��,�����ļ�������</font>,";
    else $show_msg="<font color=red>��ϲ,�ɹ��ָ������ļ�</font>,";
  }
  require_once(RROOT."/config/add_set.php");
}

elseif(file_exists(RROOT."/config/add_set.php")) {
 require_once(RROOT."/config/add_set.php");
 $show_msg="�ӻ��������ļ�<font color=red> add_set.php </font>��ȡ,";
 }

elseif(file_exists(RROOT."/config_bak/add_set_bak.php")) { 
 $show_msg="<font color=red>ԭ�����ļ�������,�ִӱ����ļ���ȡ</font>,";
 require_once(RROOT."/config_bak/add_set_bak.php");
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
    <?php 
	if ( isset( $_POST ) )   $postArray = &$_POST ;
      foreach ( $postArray as $sForm => $value )
       { if ( get_magic_quotes_gpc() )  $$sForm = stripslashes( trim($value) )  ;
         else  $$sForm = trim($value);
	  if(ereg("^cfg_",$sForm))  {
?>
   
	<tr>
      <td width="200"><div align="right"><?=$show_cfg_desc[$sForm]?>:
        <input type="hidden" name="show_cfg_desc_<?=$sForm?>" value="<?=$show_cfg_desc[$sForm]?>">
      </div></td>
      <td width="20">&nbsp;</td>
      <td width="370"><div align="left">
        <input name="<?=$sForm?>" type="text" id="<?=$sForm?>" style="width:350px" value="<?=$$sForm?>">
</div></td>
      <td>������:<?="\$".$sForm?></td>
    </tr>
	<?php }
	  }
	 ?>
    <tr>
      <td width="200"><div align="right">�������ñ����ļ�:</div></td>
      <td>&nbsp;</td>
      <td width="370"><select name="overwrite" id="overwrite">
        <option value="1">���Ǳ����ļ�</option>
        <option value="0" selected>�����Ǳ��ļ�</option>
      </select></td>
      <td>*�����ز���</td>
    </tr>
    <tr>
      <td><div align="right">�µı�������:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_desc" type="text" id="new_desc" style="width:350px"></td>
      <td>��д��,�����µ�ȫ�ֱ���</td>
    </tr>
    <tr>
      <td><div align="right">�µı�����:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_cfg" type="text" id="new_cfg" value="cfg" style="width:350px"></td>
      <td>������������cfg_��ͷ</td>
    </tr>
    <tr>
      <td><div align="right">�µı�����ֵ:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_cfg_value" type="text" id="new_cfg_value" style="width:350px"></td>
      <td>��Щ����������$cfg_mainsite.&quot;config/add_set.php&quot;�ļ���!</td>
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
