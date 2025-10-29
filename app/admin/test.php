<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
require_once(dirname(__FILE__)."/function/section_list.php");
require_once(dirname(__FILE__)."/scripts/test_constant.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="JavaScript">
function opendwin(url)
{ window.open(url,"","height=300,width=900,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
	<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form_q" method="post" action="action/test_add_action.php"  onsubmit="return check_form();">
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;在线测试&gt;&gt;试题编辑&gt;&gt;</td>
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
                                  <td width="80">所属部分 </td>
                                  <td><select name="part" id="select7" style="width:200px; ">
                                      <?php 
								 $query="select distinct part_name from ".$table_suffix."chapter  order by id asc";
								 $result=mysql_query($query);
								 while($row=mysql_fetch_object($result)) {
								?>
                                      <option value="<?=$row->part_name?>" <?php if($_COOKIE['part']==$row->part_name) echo "selected";?>>
                                      <?=$row->part_name?>
                                      </option>
                                      <?php } ?>
                                  </select></td>
                                  <td width="120"><div align="center">选择章节</div></td>
                                  <td><table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><select name="chapter" id="select46" style="width:200px; ">
                                      </select></td>
                                      <td width="10">&nbsp;</td>
                                      <td><select name="section" id="select47" style="width:200px; ">
                                        </select>
                                      </td>
                                    </tr>
                                  </table></td>
                                  </tr>
                                <tr>
                                  <td rowspan="2" valign="top">所属考点</td>
                                  <td rowspan="2"><select name="point" size="3" multiple="multiple" id="select48" style="width:200px; ">
                                  </select></td>
                                  <td><div align="center">难度系数</div></td>
                                  <td><select name="degree" id="select49" style="width:80px; ">
                                    <?php    
									    $conArray = &$nandu ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$$con_name}'"; 
										if($_COOKIE['degree']==$$con_name) echo "selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                  </select></td>
                                  </tr>
                                <tr>
                                  <td><div align="center">试题答案</div></td>
                                  <td>                                    <table width="100%%"  border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td><select name="answer" id="select2" style="width:80px; ">
                                    <option value="A" <?php if($_COOKIE['answer']=="A") echo "selected";?>>A</option>
                                    <option value="B" <?php if($_COOKIE['answer']=="B") echo "selected";?>>B</option>
                                    <option value="C" <?php if($_COOKIE['answer']=="C") echo "selected";?>>C</option>
                                    <option value="D" <?php if($_COOKIE['answer']=="D") echo "selected";?>>D</option>
                                  </select></td>
                                        <td><div align="right">
										<a href="#" onclick="opendwin('set_test_default.php')" 
										style="text-decoration:underline;color:#000066;">设置首选参数</a></div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                            </table>                              </td>
                            </tr>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="5">
                              <tr>
                                <td width="80" valign="top">试题内容</td>
                                <td width="760" valign="top">
								<?php  
								    if(isset($_COOKIE['chapter']))  $chapter_default=$_COOKIE['chapter'];
									if(isset($_COOKIE['section']))  $section_default=$_COOKIE['section'];
									if(isset($_COOKIE['point']))    $point_default=$_COOKIE['point'];
								   get_section($chapter_default,$section_default,$point_default);
								  if(isset($_COOKIE['point'])) {
									echo "<SCRIPT LANGUAGE=\"JavaScript\">"; 
									echo "sValue =\"".$point_default."\";" ;
									echo "sobj=document.form_q.point;";
									echo "for(var i=0;i<sobj.options.length;i++){
									      sobj.options[i].selected=1;
										  }
									</SCRIPT>";
									}
								  
								   ?>
                                  <input type="hidden" name="allpoint" />                                  <?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("body");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '98%' ;
					$fck->Height		= "400" ;
					$fck->ToolbarSet	= "Basic" ;
					$fck->Value = "" ;
					$fck->Create(); ?>                                  </td>
                              </tr>
                            </table></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="90"></td>
                            <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><div align="center">
                                  <input name="submit" type="submit" id="submit" value="提 交" <?php if($_COOKIE['answer_chk']=="1")  echo "onclick='return really();'"; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input name="reset" type="reset" id="reset" value="重 置">
                                </div></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
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

