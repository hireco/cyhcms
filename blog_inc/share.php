<?php session_start(); ?>
<?php require_once("../dbscripts/db_connect.php"); ?>
<?php require_once("../config/base_cfg.php");?>
<?php require_once("../config/auto_set.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title;if($blog_title) echo "����:".$blog_title;?></title>
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
                  <td>������ĵ�ַ�������͸����������Է���</td>
                </tr>
                <tr>
                  <td><textarea name="content" rows="4"  id="content"  class="TEXTAREA" style="width:90%;" onFocus="this.select();"><?=$_REQUEST['url']?></textarea></td>
                </tr>
                <tr>
                  <td><input name="Submit" type="button" class="INPUT" value="��  ��" onclick="return copyok('content');">
                      <input name="Submit2" type="button" onclick="window.close();"  class="INPUT" value="ȡ  ��">
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
//���Ʊ����ݵ�������
function copyok(obj_id){
var obj=document.getElementById(obj_id);
var a=obj.value;
window.clipboardData.setData('Text',a); //���Ƶ�������
alert("��ʾ�������Ѿ����Ƶ������壡"); 
window.close();
}
-->
</script>