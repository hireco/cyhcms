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
   if(!$result) $show_msg="<font color=red>写入文件失败,请重来</font>,";
   else $show_msg="<font color=red>恭喜,成功写入文件</font>,";
  } 
 else { 
	$result=copy(RROOT."/config_bak/base_cfg_bak.php",RROOT."/config/base_cfg.php");
    if(!$result) $show_msg="<font color=red>导入备份文件失败,可能文件不存在</font>,";
    else $show_msg="<font color=red>恭喜,成功恢复配置文件</font>,";
  }
  require_once(RROOT."/config/base_cfg.php");
}

elseif(file_exists(RROOT."/config/base_cfg.php")) {
 require_once(RROOT."/config/base_cfg.php");
 $show_msg="从基本配置文件<font color=red> base_cfg.php </font>读取,";
 }

elseif(file_exists(RROOT."/config_bak/base_cfg_bak.php")) { 
 $show_msg="<font color=red>原配制文件不存在,现从备份文件读取</font>,";
 require_once(RROOT."/config_bak/base_cfg_bak.php");
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
      <td width="200"><div align="right">本系统访问地址:</div></td>
      <td width="20" rowspan="17">&nbsp;</td>
      <td width="370"><div align="left">
        <input name="cfg_mainsite" type="text" id="cfg_mainste" style="width:350px" value="<?=$cfg_mainsite?>">
      </div></td>
      <td><p>*本系统安装地址,如果是在网站根目录,则为http://localhost/</p>      </td>
    </tr>
    <tr>
      <td><div align="right">站点标志图:</div></td>
      <td><input name="cfg_logo" type="text" id="cfg_logo" style="width:350px" value="<?=$cfg_logo?>"></td>
      <td>*上传图片后，指定地址</td>
    </tr>
    <tr>
      <td><div align="right">站点根域名:</div></td>
      <td><div align="left">
        <input name="cfg_base_url" type="text" id="cfg_base_url" style="width:350px" value="<?=$cfg_base_url?>">
      </div></td>
      <td>*网站的域名</td>
    </tr>
    <tr>
      <td><div align="right">首页风格选择:</div></td>
      <td><select name="cfg_index_style" id="cfg_index_style" style="width:350px">
        <option value="index_style1.php" <?php if($cfg_index_style=="index_style1.php") echo "selected";?>>三栏风格</option>
        <option value="index_style2.php" <?php if($cfg_index_style=="index_style2.php") echo "selected";?>>二栏风格</option>
      </select></td>
      <td>*首页的风格,默认为三栏风格</td>
    </tr>
    <tr>
      <td><div align="right">整站页面宽度:</div></td>
      <td><input name="cfg_body_width" type="text" id="cfg_body_width" style="width:350px" value="<?=$cfg_body_width?>"></td>
      <td>*页面的宽度设置(只能填整数,例如776)</td>
    </tr>
    <tr>
      <td><div align="right">系统安装目录:</div></td>
      <td><div align="left">
        <input name="cfg_root" type="text" id="cfg_root" style="width:350px" value="<?=$cfg_root?>">
      </div></td>
      <td>*移动系统位置后可以更改</td>
    </tr>
    <tr>
      <td><div align="right">管理目录:</div></td>
      <td><div align="left">
        <input name="cfg_admin_root" type="text" id="cfg_admin_root" style="width:350px" value="<?=$cfg_admin_root?>">
      </div></td>
      <td>*更换管理目录名后做相应更改</td>
    </tr>
    <tr>
      <td><div align="right">上传文件目录:</div></td>
      <td><div align="left">
        <input name="cfg_upload_root" type="text" id="cfg_upload_root" style="width:350px" value="<?=$cfg_upload_root?>">
      </div></td>
      <td>*保持位置,可以更改目录名</td>
    </tr>
    <tr>
      <td><div align="right">站点名称:</div></td>
      <td><div align="left">
        <input name="cfg_site_name" type="text" id="cfg_site_name" style="width:350px" value="<?=$cfg_site_name?>">
      </div></td>
      <td>*站点中文／英文名称</td>
    </tr>
    <tr>
      <td><div align="right">首页标题:</div></td>
      <td><input name="cfg_index_title" type="text" id="cfg_index_title" style="width:350px" value="<?=$cfg_index_title?>"></td>
      <td>*系统首页的标题</td>
    </tr>
    <tr>
      <td><div align="right">首页META关键词:</div></td>
      <td><input name="cfg_meta_keywords" type="text" id="cfg_meta_keywords" style="width:350px" value="<?=$cfg_meta_keywords?>"></td>
      <td>*逗号或者空格间隔</td>
    </tr>
    <tr>
      <td><div align="right">首页META描述:</div></td>
      <td><input name="cfg_meta_description" type="text" id="cfg_meta_description" style="width:350px" value="<?=$cfg_meta_description ?>"></td>
      <td>*避免＂最大/第一＂等字眼</td>
    </tr>
    <tr>
      <td><div align="right">版权信息:</div></td>
      <td><input name="cfg_copyright" type="text" id="cfg_copyright" style="width:350px" value="<?=$cfg_copyright ?>"></td>
      <td>*注意参照一般版权申明的方式</td>
    </tr>
    <tr>
      <td><div align="right">管理员以及邮件:</div></td>
      <td><input name="cfg_webmaster" type="text" id="cfg_webmaster" style="width:350px" value="<?=$cfg_webmaster ?>"></td>
      <td>*管理员：昵称－（邮件地址）</td>
    </tr>
    <tr>
      <td><div align="right">站点备案号:</div></td>
      <td><input name="cfg_beian" type="text" id="cfg_beian" style="width:350px" value="<?=$cfg_beian ?>"></td>
      <td>*备案后方可填写</td>
    </tr>
    <tr>
      <td><div align="right">启用验证码:</div></td>
      <td>        <select name="cfg_code_chk" id="cfg_code_chk">
        <option value="1" <? if($cfg_code_chk=="1")  echo "selected"; ?>>启用</option>
        <option value="0" <? if($cfg_code_chk=="0")  echo "selected"; ?>>不启用</option>
      </select></td>
      <td>*指后台登陆验证，默认为不验证</td>
    </tr>
    <tr>
      <td><div align="right">COOKIE加密字符串:</div></td>
      <td><input name="cfg_cookie_pass" type="text" id="cfg_cookie_pass" style="width:350px" value="<?=$cfg_cookie_pass ?>"></td>
      <td>*随机的字符串</td>
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