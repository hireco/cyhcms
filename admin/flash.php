<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="javascript" src="js/flash.js" type="text/javascript"></script>
<script language="javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
	window.open(URLStr, 'popUpWin', 'scrollbars=yes,resizable=yes,statebar=yes,width='+width+',height='+(screen.height-100)+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
	<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td>        <div align="left">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td>
                  <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if(basename($_SERVER['PHP_SELF'])=="flash.php") echo "bgcolor=\"#FFFFFF\""?>>
                    <tr>
                      
                      <td width="80" valign="bottom"><div class="bigtext_b">
                          <div align="center" class="bigtext_b"><a href="flash.php">动画生成</a></div>
                      </div></td>
                     
                    </tr>
                </table></td>
                <td valign="top">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td><table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td>
                  <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if(basename($_SERVER['PHP_SELF'])=="flash_edit.php") echo "bgcolor=\"#FFFFFF\""?>>
                    <tr>
                      
                      <td width="80" valign="bottom"><div class="bigtext_b">
                          <div align="center" class="bigtext_b"><a href="flash_edit.php">已有动画</a></div>
                      </div></td>
                      
                    </tr>
                </table></td>
                <td valign="top">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    </div></td></tr>
</table>
	<table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="action/flash_add_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
                <table width="100%"  border="0" cellspacing="4" cellpadding="0" id="needset">
                  <tr>
                    <td> </td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="90">动画风格：</td>
                          <td>
                            <select name="flash_style" id="flash_style" onchange="set_wh();">
                              <option value="index" selected="selected">简易样式</option>
                              <option value="twpd">绚丽模式</option>
                              <option value="kuan">自由样式</option>
                            </select>
                            图片宽度：
                              <input name="width" id="width"value="220" size="5">
                            高度：<input name="height" id="height"value="181" size="5">
            像素            
            <input name="num_of_img" type="hidden" id="num_of_img" value="12" /></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="90">&nbsp;图片数量：</td>
                          <td><input name="picnum" type="text" id="picnum" style="width:30px" value="3"/>
                              <input name="add_picnum" type="button" id="add_picnum" onclick="MakeUpload(0);" value="增加图片数量"/>
            （ 注：最大10幅） </td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><span id="uploadfield"></span>
                        <script language="JavaScript" type="text/javascript">
	                            MakeUpload(6);
	                           </script></td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="90">&nbsp;动画文件：</td>
                        <td><input name="filename" type="text" id="filename" /> 
                          *请带上后缀.php　写入的目录是 根目录下的　inc/flash/　 </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div align="center">
                          <input name="submit_flash" type="submit" id="submit_flash" value="提  交" onclick="check_form()" />
                        </div></td>
                        <td>&nbsp;</td>
                        <td><input type="reset" name="Submit2" value="取  消" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                </form></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
    </td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
function check_form() {
 if(document.all.filename.value=="") { 
 alert("没有填写文件名！");
 document.all.filename.focus();
 return false;
  }
  return true;
}
function set_wh() {
  if(document.all.flash_style.value=="index")  {document.all.width.value="220"; document.all.height.value="181";}
  else if(document.all.flash_style.value=="twpd")  {document.all.width.value="305"; document.all.height.value="200";}
  else {document.all.width.value="480"; document.all.height.value="270";}
}
</script>

