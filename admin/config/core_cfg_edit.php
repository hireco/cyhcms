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
   if(!$result) $show_msg="<font color=red>写入文件失败,请重来</font>,";
   else $show_msg="<font color=red>恭喜,成功写入文件</font>,";
  } 
 else { 
	$result=copy(RROOT."/dbscripts/config_bak.php",RROOT."/dbscripts/config.php");
    if(!$result) $show_msg="<font color=red>导入备份文件失败,可能文件不存在</font>,";
    else $show_msg="<font color=red>恭喜,成功恢复配置文件</font>,";
  }
  require_once(RROOT."/dbscripts/config.php");
  session_register("db_password_old");
  $_SESSION['db_password_old']=$db_password;
}

elseif(file_exists(RROOT."/dbscripts/config.php")) {
 require_once(RROOT."/dbscripts/config.php");
 $show_msg="从基本配置文件<font color=red> core_cfg.php </font>读取,";
 session_register("db_password_old");
 $_SESSION['db_password_old']=$db_password;
 }

elseif(file_exists(RROOT."/dbscripts/config_bak.php")) { 
 $show_msg="<font color=red>原配制文件不存在,现从备份文件读取</font>,";
 require_once(RROOT."/dbscripts/config_bak.php");
 session_register("db_password_old");
 $_SESSION['db_password_old']=$db_password;
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
        <td><div align="right">旧数据库密码:</div></td>
      <td width="20" rowspan="6">&nbsp;</td>
        <td><input name="db_password_old" type="password" id="db_password_old" style="width:350px"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="200"><div align="right">数据库名:</div></td>
      <td width="370"><div align="left">
        <input name="db_name" type="text" id="cfg_mainste" style="width:350px" value="<?=$db_name?>">
      </div></td>
      <td><p>&nbsp;</p>      </td>
    </tr>
    <tr>
      <td><div align="right">数据表前缀:</div></td>
      <td><input name="table_suffix" type="text" id="table_suffix" style="width:350px" value="<?=$table_suffix?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">数据库用户名:</div></td>
      <td><div align="left">
        <input name="db_user" type="text" id="db_user" style="width:350px" value="<?=$db_user?>">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">新数据库密码:</div></td>
      <td><div align="left">
        <input name="db_password" type="password" id="db_password" style="width:350px" value="">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">数据库服务器地址:</div></td>
      <td><div align="left">
        <input name="db_url" type="text" id="db_url" style="width:350px" value="<?=$db_url?>">
      </div></td>
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