<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
$class_row=@mysql_fetch_object(mysql_query("select * from ".$table_suffix."infor where id='{$_REQUEST['class_id']}'"));
$class_name=$class_row->class_name;
if(!$class_name) { echo "<script>alert(\"��ѡ�������Ŀ!\"); history.go(-1);</script>"; exit; }
elseif($class_row->class_attribute > '3') { echo "<script>alert(\"����Ŀ���ܷ����ĵ�!\"); history.go(-1);</script>"; exit; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
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
	<?php 
	
	?>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="action/ftp_add_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;���ݷ���&gt;&gt;<?=$class_name?> <?php if($class_row->class_attribute == '1') echo "<font color=red>[ע��:����ĿΪ��ƪ��Ŀ]</font>"; ?></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="head1"  style="border-bottom:1px solid #99CC33">
    <tr> 
      <td bgcolor="#E2F5BC">
      	<table border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="84" height="24" align="center" bgcolor="#FFFFFF">&nbsp;��������&nbsp;</td>
            <td width="84" align="center" bgcolor="#006600"><a href="#" onClick="ShowItem2()" style="color:#FFFFFF "><u>��������</u></a></td>
          </tr>
        </table>
        </td>
      </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="head2" style="border-bottom:1px solid #99CC33;display:none">
    <tr> 
      <td colspan="2" bgcolor="#E2F5BC">
      	<table height="24" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="84" align="center" bgcolor="#006600"><a href="#" style="color:#FFFFFF " onClick="ShowItem1()"><u>��������</u></a>&nbsp;</td>
            <td width="84" align="center" bgcolor="#FFFFFF">��������&nbsp;</td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
						<table width="100%"  border="0" cellspacing="2" cellpadding="0" id="needset">
                          <tr>
                            <td>
	                          </td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="90">���ϱ��⣺                                    </td>
                                  <td width="400"><input name="title" type="text" id="title" style="width:300px">
                                    �Ӵ�
                                    <input name="title_bold" type="checkbox" id="title_bold" value="1" /></td>
                                  <td width="90">������ɫ��</td>
                                  <td nowrap="nowrap"><input name="title_color" type="text" id="title_color" style="width:100px" /> 
                                    <input name="modcolor" type="button" id="modcolor" value="ѡȡ" onClick="ShowColor()"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" >���ϵ�ַ��</td>
                                <td><input name="rurl" type="text" id="rurl" style="width:400px" value="http://" />
                                  <input type="button" name="selmedia" class="binput" style="width:60px" value="���..." onclick="SelectAddon('form1.rurl')" /></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="90" >������Դ��</td>
                  <td><input name="source_input" type="text" id="source" style="width:160px" />
                    �ļ����ͣ�
                    <select name="ftp_format" id="select5">
                      <?php    
									    $conArray = &$file_format ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="doc") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                    </select>                    </td>
                  </tr>
              </table>
                              </td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" height="81" valign="top">�� �� ͼ��<br/>                                  <br />                                </td>
                                <td width="400" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td height="30">ͼƬ��Դ��<input type='checkbox'  name='pic_remote' id='pic_remote' onclick="CkRemote_Local('pic_remote','upload_pic','local_pic','pic_local')" />
       Զ��
        <input type='checkbox'  name='pic_local' id='pic_local' onclick="CkRemote_Local('pic_local','local_pic','upload_pic','pic_remote')" />
����</td>
                                  </tr>
								  <tr>
                                    <td height="30" id="upload_pic"   style="display:block;">�����ϴ��������������ť
                                      <input name="picture_input" type="file" id="picture_input" style="width:200px" onchange="SeePic(document.picview,document.form1.picture_input);" /></td>
                                  </tr>
                                  <tr>
                                    <td height="30" id="local_pic" style="display:block; ">
                                      <input name="picture_select" type="text" id="picture_select" style="width:250px" />
                                      <input type="button" name="Select_from_web" value="����վ��ѡ��" style="width:120px" onclick="SelectImage('form1.picture_select','object_small');" /></td>
                                  </tr>
                                </table></td>
                                <td width="90" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td height="30">ͼƬԤ����</td>
                                  </tr>
                                  <tr>
                                    <td height="30" id="upload_pic"  name="upload_pic" style="display:block">���Գߴ磺</td>
                                  </tr>
                                  <tr>
                                    <td height="30"><?php echo $cfg_artsimg_width." X ".$cfg_artsimg_height; ?>                                      </td>
                                  </tr>
                                </table></td>
                                <td align="left"><div align="center">
                                  <table width="160" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                                    <tr>
                                      <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><img onload="reload_pic('picview');" src="image/picview.jpg"  id="picview" name="picview" /></div></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" >ת���ַ��</td>
                                <td width="400"><input name="jump_url" type="text" id="jump_url2" style="width:300px" value="" />
                                </td>
                                <td width="90">����Ȩ�ޣ�</td>
                                <td><select name="hide_type" id="select" style="width:160px">
                                  <?php    
									    $conArray = &$hide_type ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="0") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                </select></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90">����ѡ�</td>
                                <td>
                                  <input name="remote_down" type="checkbox"  id="remote_down" value="1" checked="checked" />
      ����Զ��ͼƬ����Դ
      <input name="remote_link_del" type="checkbox"  id="remote_link_del" value="1" />
      ɾ����վ������
      <input name="first_pic" type="checkbox"  id="first_pic" value="1" />
      ��ȡ��һ��ͼƬΪ����ͼ
      <input name="auto_keywords" type="checkbox" id="auto_keywords4" value="1" checked="checked" />
      �Զ���ȡ�ؼ���
                    </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90" valign="top">���Ͻ��ܣ�</td>
                                  <td><?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("body");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '650' ;
					$fck->Height		= "200" ;
					$fck->ToolbarSet	= "Small" ;
					$fck->Value = "" ;
					$fck->Create(); ?></td>
                                  </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90"><div align="left"> &nbsp;ѡ��ģ�棺</div></td>
                                <td><select name="template" id="template">
                                    <?php 
						  $result=mysql_query("select template_list from ".$table_suffix."infor  where id='{$_REQUEST['class_id']}'");
						  $template_list=mysql_result($result,0,"template_list");
						   if(!$template_list)  echo "<option value=\"default.php\" selected>Ĭ��ģ��</option>";
						  else {
						  $template_list=explode(",",$template_list);						 
						  for($i=0;$i<count($template_list); $i++){  
						  echo "<option value=\"".$template_list[$i]."\"";
						  if($template_list[$i]=="default.php") echo "selected";
						  echo ">".$template_list[$i]."</option>";
						   }
						  } 
                        ?>
                                </select></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                          <table width="100%" border="0" cellspacing="2" cellpadding="0" id="adset" style="display:none">
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">�������ԣ�</td>
                                  <td width="320"><select name='show_attribute' style='width:150px'>
                                    <?php    
									    $conArray = &$show_attribute ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="0") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                  </select></td>
                                  <td width="90">�Ƿ����£�</td>
                                  <td><select name="new_or_not" id="select2">
                                    <option value="1" selected="selected">��</option>
                                    <option value="0">��</option>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">���ʴ�����</td>
                                  <td width="320"><input name="visit_times" type="text" id="visit_times" style="width:100px" value="0" />                                    </td>
                                  <td width="90">�Ƿ����ۣ�</td>
                                  <td><select name="comment_or_not" id="comment_or_not">
                                    <option value="1" selected="selected">��</option>
                                    <option value="0">��</option>
                                  </select> </td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">����ʱ�䣺</td>
                                  <td width="320">                                    <input name="post_time" type="text" id="post_time" style="width:100px"  value="<?=date("y-m-d H:i:s")?>"/>        </td>
                                  <td width="90">�Ƿ�������</td>
                                  <td><select name="locked" id="locked">
                                      <option value="1">��</option>
                                      <option value="0" selected="selected">��</option>
                                                                      </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">�ö����ޣ�</td>
                                  <td width="320"><select name="top" id="top">
                                     <?php    
									    $conArray = &$top_se;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="0") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
									</select>
								  <td width="90">�Ƿ��Ƽ���</td>
                                  <td><select name="recommend" id="recommend">
                                    <option value="1" >��</option>
                                    <option value="0" selected="selected">��</option>
                                                                    </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">�� �� �ʣ�</td>
                                  <td><textarea name="keywords" rows="3" id="keywords" style="width:550px"></textarea></td>
                                </tr>
                              </table></td>
                            </tr>
							<tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">����ժҪ��</td>
                                  <td><textarea name="abstract" rows="3" id="abstract" style="width:550px"></textarea></td>
                                </tr>
                              </table></td>
                            </tr>                           
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">������£�</td>
                                  <td><textarea name="similar_id" rows="3" id="similar_id" style="width:550px"></textarea> <input name="select_article" type="button" id="select_article" value="ѡ��" 
								  onClick="OpenMywin_wider('select_list.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($class_name)?>')"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">�ο���ַ��</td>
                                  <td><input name="refer_url" type="text" id="refer_url" style="width:550px" value="" />
                                  </td>
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
                            <td width="90"><input name="class_id" type="hidden" id="class_id" value="<?=$_REQUEST['class_id']?>" />
                              <input name="class_name" type="hidden" id="class_name" value="<?=$class_name?>" /></td>
                            <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><div align="center">
                                  <input name="submit" type="submit" id="submit" value="�� ��" <?php if($class_row->class_attribute == '1') echo "onclick=\"return really();\"";?>>
                                </div></td>
                                <td><div align="center">
                                  <input name="reset" type="reset" id="reset" value="�� ��">
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
if(document.form1.title.value=="") {
  alert("���±��ⲻ��Ϊ��!");
  var obj = $Obj('needset');
  if(obj.style.display =="block")
  document.form1.title.focus();
  return false;
 }
if(!document.form1.pic_remote.checked&&!document.form1.pic_local.checked&&(document.form1.picture_select.value=="")&&(document.form1.picture_input.value=="")){
     result="������û����������ͼ,ȷ����";   
      if   (confirm(result))   return true;
      else return false;
 }
}
function really() {
       result="����ĿΪ��ƪ������Ŀ,������";   
       if   (confirm(result))    return true; 
       else { return false; }
 }
 
function SelectAddon(fname)
{
   if(document.all){
     var posLeft = window.event.clientY-100;
     var posTop = window.event.clientX-400;
   }
   else{
     var posLeft = 100;
     var posTop = 100;
   }
   window.open("../file_do/select_soft.php?f="+fname, "popUpSoftWin", "scrollbars=yes,resizable=yes,statebar=no,width=500,height=350,left="+posLeft+", top="+posTop);
}
</script>
