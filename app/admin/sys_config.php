<?php session_start();
require_once("setting.php");
require_once("inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ޱ����ĵ�</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="12"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
              <?php if($_REQUEST['action_do']=="base") { ?>
			  <tr>
                <td><img src="image/body_title_left.gif" width="3" height="27"></td>
                <td valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">��������</div></td>
                <td><img src="image/body_title_right.gif" width="3" height="27"></td>
              </tr>			  
			  <?php }else { ?>
              <tr>
                <td>&nbsp;</td>
                <td valign="bottom"><span class="bigtext_b"><a href="?action_do=base">��������</a></span></td>
                <td>&nbsp;</td>
              </tr>
			  <?php } ?>
          </table>            </td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
             <?php if($_REQUEST['action_do']=="core") { ?>
			  <tr>
                <td><img src="image/body_title_left.gif" width="3" height="27"></td>
                <td valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">��������</div></td>
                <td><img src="image/body_title_right.gif" width="3" height="27"></td>
              </tr>			  
			  <?php }else { ?>
              <tr>
                <td>&nbsp;</td>
                <td valign="bottom"><span class="bigtext_b"><a href="?action_do=core">��������</a></span></td>
                <td>&nbsp;</td>
              </tr>
			  <?php } ?>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <?php if($_REQUEST['action_do']=="mail") { ?>
            <tr>
              <td><img src="image/body_title_left.gif" width="3" height="27"></td>
              <td valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">�ʼ�����</div></td>
              <td><img src="image/body_title_right.gif" width="3" height="27"></td>
            </tr>
            <?php }else { ?>
            <tr>
              <td>&nbsp;</td>
              <td valign="bottom"><span class="bigtext_b"><a href="?action_do=mail">�ʼ�����</a></span></td>
              <td>&nbsp;</td>
            </tr>
            <?php } ?>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
             <?php if($_REQUEST['action_do']=="other") { ?>
			  <tr>
                <td><img src="image/body_title_left.gif" width="3" height="27"></td>
                <td valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">��������</div></td>
                <td><img src="image/body_title_right.gif" width="3" height="27"></td>
              </tr>			  
			  <?php }else { ?>
              <tr>
                <td>&nbsp;</td>
                <td valign="bottom"><span class="bigtext_b"><a href="?action_do=other">��������</a></span></td>
                <td>&nbsp;</td>
              </tr>
			  <?php } ?>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
             <?php if($_REQUEST['action_do']=="addition") { ?>
			  <tr>
                <td><img src="image/body_title_left.gif" width="3" height="27"></td>
                <td valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">��������</div></td>
                <td><img src="image/body_title_right.gif" width="3" height="27"></td>
              </tr>			  
			  <?php }else { ?>
              <tr>
                <td>&nbsp;</td>
                <td valign="bottom"><span class="bigtext_b"><a href="?action_do=addition">��������</a></span></td>
                <td>&nbsp;</td>
              </tr>
			  <?php } ?>
          </table></td>
          <td valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<?php 
if($_SESSION['root']=="super_administrator") { 
  if($_REQUEST['action_do']=="base")  require_once("config/base_cfg_edit.php"); 
  elseif($_REQUEST['action_do']=="core")  require_once("config/core_cfg_edit.php"); 
  elseif($_REQUEST['action_do']=="other")  require_once("config/other_cfg_edit.php");  
  elseif($_REQUEST['action_do']=="mail")  require_once("config/mail_cfg_edit.php"); 
  elseif($_REQUEST['action_do']=="addition")  require_once("config/add_cfg_edit.php"); 
}
else ShowMsg("�Բ���,����Ȩ�޽��д˲���!",-1);
?>
<?php require_once("scripts/footer.php");?>
</body>
</html>