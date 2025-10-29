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
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="300"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="300" valign="center">
<table  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>  
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;在线测试&gt;&gt;试题编辑&gt;&gt;设置首选参数</td>
                  </tr>
                  <tr>
                    <td>
			   <?php 
			    if(isset($_POST['cookie_sub'])) {
				  $result=setcookie("part",$_POST['part'],time()+3600*24*60);
				  if($result) $result=setcookie("chapter",$_POST['chapter'],time()+3600*24*60);
				  if($result) $result=setcookie("section",$_POST['section'],time()+3600*24*60);
				  if($result) $result=setcookie("point",$_POST['allpoint'],time()+3600*24*60);
				  if($result) $result=setcookie("degree",$_POST['degree'],time()+3600*24*60);
				  if($result) $result=setcookie("answer",$_POST['answer'],time()+3600*24*60);
				  if($result) $result=setcookie("goto",$_POST['goto'],time()+3600*24*60);
				  if($result) $result=setcookie("answer_chk",$_POST['answer_chk'],time()+3600*24*60);
				  ?>
		          <table width="600" height="200"  border="0" align="center" cellpadding="10" cellspacing="0">
                    <tr>
                      <td><table width="100%%"  border="0" cellspacing="0" cellpadding="10">
                        <tr>
                          <td><div align="center" style="font-size:36px; color:#0033CC">
						  <?php if($result) echo "恭喜您！成功设置首选参数！"; else echo "Sorry,设置首选参数失败，请重来！"; ?>
						  </div></td>
                        </tr>
                        <tr>
                          <td><table width="100%%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><div align="center">
                                <input type="button" name="close" value="关  闭" onclick="closefun();" />
                              </div></td>
                              <td>&nbsp;</td>
                              <td><div align="center">
                                <input type="button" name="return" value="返回重来" onclick="history.go(-1)"/>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
			     <?php 
				   } else {
 			     ?>
                   <form name="form_q" method="post"  onsubmit="return check_form();">
					 <table width="100%"  border="0" cellspacing="0" cellpadding="5">
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
                                      <td><select name="chapter" id="chapters" style="width:200px; ">
                                      </select></td>
                                      <td width="10">&nbsp;</td>
                                      <td><select name="section" id="sections" style="width:200px; ">
                                        </select>
                                      </td>
                                    </tr>
                                  </table></td>
                                  </tr>
                                <tr>
                                  <td rowspan="2" valign="top">所属考点</td>
                                  <td rowspan="2"><select name="point" size="3" multiple="multiple" id="points" style="width:200px; ">
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
                                  <td><select name="answer" id="select2" style="width:80px; ">
                                    <option value="A" <?php if($_COOKIE['answer']=="A") echo "selected";?>>A</option>
                                    <option value="B" <?php if($_COOKIE['answer']=="B") echo "selected";?>>B</option>
                                    <option value="C" <?php if($_COOKIE['answer']=="C") echo "selected";?>>C</option>
                                    <option value="D" <?php if($_COOKIE['answer']=="D") echo "selected";?>>D</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td valign="top">动作选项</td>
                                  <td colspan="3"><table width="100%%"  border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><input name="goto" type="radio" value="l" <?php if($_COOKIE['goto']=="l") echo "checked"; ?> />
                                          发布后转入试题列表 </td>
                                        <td><input type="radio" name="goto" value="a"  <?php if($_COOKIE['goto']=="a") echo "checked"; ?>/>
                                          发布转入继续发布页面</td>
                                        <td><input type="radio" name="goto" value="r"  <?php if($_COOKIE['goto']=="r") echo "checked"; ?>/>
                                          发布后自动显示发布结果</td>
                                      </tr>
                                      <tr>
                                        <td><input type="radio" name="answer_chk" value="1" <?php if($_COOKIE['answer_chk']=="1") echo "checked"; ?>/>
                                          发布前提示检查答案</td>
                                        <td><input type="radio" name="answer_chk" value="0" <?php if($_COOKIE['answer_chk']=="0") echo "checked"; ?>/>
发布前不提示检查答案</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                            </table>                              </td>
                            </tr>
                        </table>
                          <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="90"><?php  
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
                                        <input type="hidden" name="allpoint" value="<?=$_COOKIE['point']?>"/></td>
                                    <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td><div align="center">
                                              <input name="cookie_sub" type="submit" id="cookie_sub" value="提 交" />
                                          </div></td>
                                          <td><div align="center">
                                              <input name="reset" type="reset" id="reset2" value="重 置" />
                                          </div></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table></td>
                        </tr>
                    </table></form><?php } ?>
					</td>
                  </tr>
                </table>
			  </td>
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

function closefun() {
  opener.location.reload();
  window.close();
  
}
</script>
