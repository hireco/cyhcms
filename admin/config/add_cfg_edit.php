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
   if(!$result) $show_msg="<font color=red>写入文件失败,请重来</font>,";
   else $show_msg="<font color=red>恭喜,成功写入文件</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/add_set_bak.php",RROOT."/config/add_set.php");
    if(!$result) $show_msg="<font color=red>导入备份文件失败,可能文件不存在</font>,";
    else $show_msg="<font color=red>恭喜,成功恢复配置文件</font>,";
  }
  require_once(RROOT."/config/add_set.php");
}

elseif(file_exists(RROOT."/config/add_set.php")) {
 require_once(RROOT."/config/add_set.php");
 $show_msg="从基本配置文件<font color=red> add_set.php </font>读取,";
 }

elseif(file_exists(RROOT."/config_bak/add_set_bak.php")) { 
 $show_msg="<font color=red>原配制文件不存在,现从备份文件读取</font>,";
 require_once(RROOT."/config_bak/add_set_bak.php");
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
      <td>变量名:<?="\$".$sForm?></td>
    </tr>
	<?php }
	  }
	 ?>
    <tr>
      <td width="200"><div align="right">覆盖配置备份文件:</div></td>
      <td>&nbsp;</td>
      <td width="370"><select name="overwrite" id="overwrite">
        <option value="1">覆盖备份文件</option>
        <option value="0" selected>不覆盖备文件</option>
      </select></td>
      <td>*请慎重操作</td>
    </tr>
    <tr>
      <td><div align="right">新的变量描述:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_desc" type="text" id="new_desc" style="width:350px"></td>
      <td>填写表单,建立新的全局变量</td>
    </tr>
    <tr>
      <td><div align="right">新的变量名:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_cfg" type="text" id="new_cfg" value="cfg" style="width:350px"></td>
      <td>变量名必须以cfg_开头</td>
    </tr>
    <tr>
      <td><div align="right">新的变量的值:</div></td>
      <td>&nbsp;</td>
      <td><input name="new_cfg_value" type="text" id="new_cfg_value" style="width:350px"></td>
      <td>这些变量储存在$cfg_mainsite.&quot;config/add_set.php&quot;文件中!</td>
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
