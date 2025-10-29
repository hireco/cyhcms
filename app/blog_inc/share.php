<?php session_start(); ?>
<?php require_once("../dbscripts/db_connect.php"); ?>
<?php require_once("../config/base_cfg.php");?>
<?php require_once("../config/auto_set.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title;if($blog_title) echo "博客:".$blog_title;?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="../css/blog.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function check(){
document.all.content.focus();
}
//-->
</SCRIPT>

</head>
<body onLoad="check()">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><form name="form1" method="post">
              <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
                <tr>
                  <td>将下面的地址拷贝发送给您的朋友以分享</td>
                </tr>
                <tr>
                  <td><textarea name="content" rows="4"  id="content"  class="TEXTAREA" style="width:90%;" onFocus="this.select();"><?=$_REQUEST['url']?></textarea></td>
                </tr>
                <tr>
                  <td><input name="Submit" type="button" class="INPUT" value="复  制" onclick="return copyok('content');">
                      <input name="Submit2" type="button" onclick="window.close();"  class="INPUT" value="取  消">
                  </td>
                </tr>
              </table>
            </form></td>
          </tr>
        </table></td>
      </tr>
    </table>
</body>
</html>
<script language="JavaScript">
<!--
//复制表单内容到剪贴板
function copyok(obj_id){
var obj=document.getElementById(obj_id);
var a=obj.value;
window.clipboardData.setData('Text',a); //复制到剪贴板
alert("提示：内容已经复制到剪贴板！"); 
window.close();
}
-->
</script>