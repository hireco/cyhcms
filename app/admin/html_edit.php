<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
if(is_file("scripts/html_set.php")) require_once("scripts/html_set.php");
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
                  <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      
                      <td width="80" valign="bottom"><div class="bigtext_b">
                          <div align="center" class="bigtext_b">添加文件</div>
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
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b"><a href="file_manage_main.php?activepath=/html">浏览文件</a></div>
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
	<table width="100%"  border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCC3B">
            <tr>
              <td width="120" bgcolor="#FFFFFF"><div align="center">已有静态文件</div></td>
              <td width="60">&nbsp;</td>
              <td><table  border="0" align="left" cellpadding="3" cellspacing="0" bgcolor="#FFCC3B">
                  <tr><td height="5"></td>
                  </tr>
				  <tr><?php $conArray = &$file ;
		               foreach ( $conArray as $con_name => $value ) {
	                   $$con_name = $value  ;
		               echo "<td align=\"center\" style=\"cursor: pointer; BORDER-RIGHT: #FFCC3B 1px solid; BORDER-TOP: #FFCC3B 1px solid;   BORDER-LEFT: #FFCC3B 1px solid;\"";
					   if($_REQUEST['html']==$con_name) echo "bgcolor=\"#FFFFFF\"";
					   echo "width=\"100\"><a href=\"../html/{$$con_name}\" target=_blank>".$con_name."</a> <a href=\"?html=".urlencode($con_name)."\">[编辑]</a></td>";
			            }
	                  ?>
				  </tr>
                </table></td>
            </tr>
            </table></td>
      </tr>
      <tr>
        <td><form name="form1" id="form1" method="post" action="action/html_edit_action.php">
          <table width="100%"  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="100"><div align="right">项目名称</div></td>
              <td width="10"></td>
              <td><input name="title" type="text" id="title" size="30"  value="<?=$_REQUEST['html']?>"/></td>
            </tr>
            <tr>
              <td><div align="right">文件名</div></td>
              <td></td>
              <td><input name="filename" type="text" id="filename" size="30" value="<?=$file[$_REQUEST['html']]?>"/></td>
            </tr>
            <tr>
              <td valign="top"><div align="right">内容</div></td>
              <td></td>
              <td><?php
			         $filename="../html/".$file[$_REQUEST['html']];
					 if(is_file($filename)) { 
                     $fp=fopen($filename,"r");
                     $string_read=fread($fp,filesize($filename));
                     fclose($fp);
                     } 
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("body");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '98%' ;
					$fck->Height		= "400" ;
					$fck->ToolbarSet	= "Basic" ;
					$fck->Value = $string_read ;
					$fck->Create(); ?></td>
            </tr>
            <tr>
              <td><div align="right">提交</div></td>
              <td></td>
              <td><input name="html_sub" type="submit" class="inputbut" id="html_sub" value="提  交" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
