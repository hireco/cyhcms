<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
require_once(dirname(__FILE__)."/function/section_list.php");
require_once(dirname(__FILE__)."/scripts/test_constant.php");

$query="select * from ".$table_suffix."test where id={$_REQUEST['id']}";
$result=mysql_query($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="JavaScript">
function opendwin(url)
{ window.open(url,"","height=300,width=900,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
	<?php require_once("scripts/header.php");
if($row=mysql_fetch_object($result)) { 
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;在线测试&gt;&gt;试题查看&gt;&gt;</td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td valign="top"><table width="100%"  border="0" cellspacing="5" cellpadding="0" id="needset">
                          <tr>
                            <td> </td>
                            </tr>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="5">
                                <tr>
                                  <td width="80"><strong>所属部分</strong> </td>
                                  <td colspan="2"><?=$row->part?> <?=$row->chapter?> <?=$row->section?>                                    <div align="center"></div>                                    </td>
                                  </tr>
                                <tr>
                                  <td valign="top"><strong>所属考点</strong></td>
                                  <td colspan="2" valign="top"><?=$row->point?>                                    <div align="center"></div></td>
                                  </tr>
                                <tr>
                                  <td valign="top"><strong>难度系数</strong></td>
                                  <td width="40" valign="top"><?=$row->degree?></td>
                                  <td><div align="center"></div>                                    <table width="100%%"  border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td width="120"><strong>试题答案</strong>                                            <?=$row->answer?> </td>
                                          </tr>
                                    </table></td>
                                  </tr>
                            </table>                              </td>
                            </tr>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="5">
                              <tr>
                                <td width="80" valign="top"><strong>试题内容</strong></td>
                                <td width="760" valign="top">
								<?=$row->problem_content?>
								</td>
                              </tr>
                            </table></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td><a href="test_edit.php?id=<?=$row->id?>" style="text-decoration:underline; color:#000099; ">编辑本题</a></td>
                        <td><input name="Submit" type="submit" class="inputbut" value="关  闭" onclick="window.close();"/></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
    </td>
  </tr>
</table>
<?php } 
 require_once("scripts/footer.php"); ?>
</body>
</html>
<script>
function check_form() {
var point_list = document.form_q.point;
	var allpoint = "";
	for(var i=0;i<point_list.options.length;i++){
		if((point_list.options[i].selected)&&(point_list.options[i].text!="不限知识点")){
		if(allpoint == "")
			allpoint = point_list.options[i].text;
		else
			allpoint = allpoint +","+ point_list.options[i].text;
		}
	  }
	document.form_q.allpoint.value = allpoint;
}

function really() {
      result="请检查题目答案，确认后点击确定，否则点击取消！";   
       if   (confirm(result))    return true; 
       else { return false; }
 }

</script>

