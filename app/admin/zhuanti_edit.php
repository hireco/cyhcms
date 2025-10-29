<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
$class_name=@mysql_result(mysql_query("select class_name from ".$table_suffix."infor where id='{$_REQUEST['class_id']}'"),0,"class_name");
if(!$class_name) { echo "<script>alert(\"请选择操作栏目!\"); history.go(-1);</script>"; exit; } 
if(empty($_REQUEST['article_id'])) { echo "<script>alert(\"请选择操作文档!\"); history.go(-1);</script>"; exit; } 
$query="select * from ".$table_suffix."zhuanti  where id={$_REQUEST['article_id']}";
$result=mysql_query($query);
if(!mysql_num_rows($result)) { echo "<script>alert(\"没有找到对应的文档!\"); history.go(-1);</script>"; exit; } 
$row=mysql_fetch_object($result);
$pic_id=$row->pic_id; 
$pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
$pic_row=mysql_fetch_object($pic_result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="javascript" src="js/zhuanti.js" type="text/javascript"></script>
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
              <td><form name="form1" method="post" action="action/zhuanti_edit_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;内容修改&gt;&gt;<?=$class_name?> </td>
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
            <td width="84" height="24" align="center" bgcolor="#FFFFFF">&nbsp;常规内容&nbsp;</td>
            <td width="84" align="center" bgcolor="#006600"><a href="#" onClick="ShowItem2()" style="color:#FFFFFF "><u>其它参数</u></a></td>
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
            <td width="84" align="center" bgcolor="#006600"><a href="#" style="color:#FFFFFF " onClick="ShowItem1()"><u>常规内容</u></a>&nbsp;</td>
            <td width="84" align="center" bgcolor="#FFFFFF">其它参数&nbsp;</td>
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
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90">重选栏目：</td>
                                <td width="400"><select name="class_id" id="class_id">
                                    <?php 
								 $query="select * from ".$table_suffix."infor where infor_class='{$_REQUEST['infor_class']}'";
								 $result=mysql_query($query);
								 while($rows=mysql_fetch_object($result)) {
								?>
                                    <option value="<?=$rows->id?>" <?php if($rows->id==$_REQUEST['class_id']) echo "selected"; ?>>
                                    <?=$rows->class_name?>
                                    </option>
                                    <?php } ?>
                                </select></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="90">软件标题： </td>
                                <td width="400"><input name="article_title" type="text" id="article_title" <?php echo $row->title_color==""?"":"style=\"color:".$row->title_color.";\""; ?> style="width:300px" value="<?=$row->article_title?>" />
      加粗
        <input name="title_bold" type="checkbox" id="title_bold2" value="1" <?php if($row->title_bold=="1") echo "checked"; ?>/></td>
                                <td width="90">标题颜色：</td>
                                <td nowrap="nowrap"><input name="title_color" type="text" id="title_color2" style="width:100px" value="<?=$row->title_color?>"/>
                                    <input name="modcolor" type="button" id="modcolor2" value="选取" onclick="ShowColor()" /></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" height="81" valign="top">缩 略 图：<br/>                                  <br />                                </td>
                                <td width="400" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td height="30">图片来源：<input type='checkbox'  name='pic_remote' id='pic_remote' onclick="CkRemote_Local('pic_remote','upload_pic','local_pic','pic_local')" />
       远程
        <input type='checkbox'  name='pic_local' id='pic_local' onclick="CkRemote_Local('pic_local','local_pic','upload_pic','pic_remote')" />
本地 </td>
                                  </tr>
								  <tr>
                                    <td height="30" id="upload_pic"   style="display:block;">本地上传请点击“浏览”按钮
                                      <input name="picture_input" type="file" id="picture_input" style="width:200px" onchange="SeePic(document.picview,document.form1.picture_input);" /></td>
                                  </tr>
                                  <tr>
                                    <td height="30" id="local_pic" style="display:block; ">
                                      <input name="picture_select" type="text" id="picture_select" style="width:250px" value="<?=$pic_row->pic_url?>" />
                                      <input type="button" name="Select_from_web" value="在网站内选择" style="width:120px" onclick="SelectImage('form1.picture_select','object_small');" /></td>
                                  </tr>
                                </table></td>
                                <td width="90" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td height="30">图片预览：</td>
                                  </tr>
                                  <tr>
                                    <td height="30" id="upload_pic"  name="upload_pic" style="display:block">缩略尺寸：</td>
                                  </tr>
                                  <tr>
                                    <td height="30"><?php echo $cfg_artsimg_width." X ".$cfg_artsimg_height; ?>                                      </td>
                                  </tr>
                                </table></td>
                                <td align="left"><div align="center">
                                  <table width="160" height="100" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                                    <tr>
                                      <td align="center" valign="middle" bgcolor="#FFFFFF"><?php									 
									  if($pic_row->pic_url) echo "<a href=\"cut_pic.php?pic_url=$pic_row->pic_url&iwidth=$cfg_artsimg_width&iheight=$cfg_artsimg_height\" target=\"_blank\"><img alt=\"点击截取缩略图\" onload=\"reload_pic('picview');\" src=\"{$pic_row->pic_url}\" id=\"picview\" name=\"picview\"  border=0/></a>"; 
									  else echo "<img src=\"image/picview.jpg\" height=\"100\" id=\"picview\" name=\"picview\" />"; 
									  ?></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("body");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '800' ;
					$fck->Height		= "200" ;
					$fck->ToolbarSet	= "Small" ;
					$fck->Value = $row->content ;
					$fck->Create(); ?></td>
                          </tr>
                          <tr>
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90"><div align="left"> &nbsp;选择模版：</div></td>
                                <td><select name="template" id="template">
                                    <?php 
						  if($row->template)  echo "<option value=\"".$row->template."\" selected>".$row->template."</option>";
						  $result=mysql_query("select template_list from ".$table_suffix."infor  where id='{$_REQUEST['class_id']}'");
						  $template_list=mysql_result($result,0,"template_list");
						  if($template_list){
						   $template_list=explode(",",$template_list);
						   for($i=0;$i<count($template_list); $i++)  
						   if($template_list[$i]!=$row->template)
						   echo "<option value=\"".$template_list[$i]."\">".$template_list[$i]."</option>";
                         }
						  if((!$row->template)&&(!$template_list))  echo "<option value=\"default.php\">默认模版</option>";
						?>
                                </select></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90">附加选项：</td>
                                <td>
                                  <input name="remote_down" type="checkbox"  id="remote_down" value="1" checked="checked" />
      下载远程图片和资源
      <input name="remote_link_del" type="checkbox"  id="remote_link_del" value="1" />
      删除非站内链接
      <input name="first_pic" type="checkbox"  id="first_pic" value="1" />
      提取第一个图片为缩略图
      <input name="auto_keywords" type="checkbox" id="auto_keywords" value="1" <?php if($row->keywords=="") echo "checked"; ?> />
      自动获取关键词 </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="top">专题节点：
                                  <table width="100%" border="0" cellpadding="2" cellspacing="0" id="mytable">
                                    <tbody>
                                      <tr>
                                        <td colspan="4" align="center" bordercolor="#rgb(32,44,96)" class="inquiry"><div align="left"></div>
                                            <div align="left">
                                              <input name="button" type="button" onclick="insRow()" value="更多节点..." />
                                          </div></td>
                                      </tr>
                                      <tr>
                                        <td>ID</td>
                                        <td>节点标题</td>
                                        <td>列数</td>
                                        <td>节点文档</td>
                                      </tr>
                                      <?php  
									  $archive_list=explode(";",$row->archive_list);
						              for($j=0;$j<count($archive_list);$j++) { 
									  $list_object=explode("-",$archive_list[$j]);
									  ?>
									  <tr>
                                        <td><?=$j+1?>：</td>
                                        <td><input name="title<?=$j+1?>" type="text"  style="width:300px"  value="<?=$list_object[0]?>"/></td>
                                        <td><input name="row<?=$j+1?>" type="text"  style="width:20px" value="<?=$list_object[1]?>" />
                                        </td>
                                        <td><textarea name="id_list<?=$j+1?>" rows="3"  style="width:300px" ><?=$list_object[2]?></textarea>
                                        <input name="select<?=$j+1?>" type="button"  value="选择" onClick="OpenMywin_wider('select_for_zhuanti.php?form_id=id_list<?=$j+1?>')"></td>
                                      </tr>
									  <?php } ?>
                                      <tr>
                                        <td colspan="4" align="right"><div align="left"> </div></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                          <table width="100%" border="0" cellspacing="2" cellpadding="0" id="adset" style="display:none">
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">定义属性：</td>
                                  <td width="320"><select name='show_attribute' style='width:150px'>
                                    <?php    
									    $conArray = &$show_attribute ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->show_attribute) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                  </select></td>
                                  <td width="90">访问权限：</td>
                                  <td><select name="hide_type" id="select11" style="width:160px">
                                    <?php    
									    $conArray = &$hide_type ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->hide_type) echo " selected";
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
                                  <td width="90">转向地址：</td>
                                  <td width="320"><input name="jump_url" type="text" id="jump_url" style="width:300px" value="<?=$row->jump_url?>" />      </td>
                                  <td width="90">是否置新：</td>
                                  <td><select name="new_or_not" id="select6">
                                    <option value="1" <?php if($row->new_or_not=="1") echo "selected"; ?>>是</option>
                                    <option value="0" <?php if($row->new_or_not=="0") echo "selected"; ?>>否</option>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">访问次数：</td>
                                  <td width="320"><input name="read_times" type="text" id="read_times2" style="width:100px" value="<?=$row->read_times?>"/>                                    
                                    通过审核： 
                                    <select name="checked" id="checked">
                                      <option value="1" <?php if($row->checked=="1") echo "selected"; ?>>是</option>
                                      <option value="0" <?php if($row->checked=="0") echo "selected"; ?>>否</option>
                                    </select></td>
                                  <td width="90">是否评论：</td>
                                  <td><select name="comment_or_not" id="select7">
                                    <option value="1" <?php if($row->comment_or_not=="1") echo "selected"; ?>>是</option>
                                    <option value="0" <?php if($row->comment_or_not=="0") echo "selected"; ?>>否</option>
                                  </select> </td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">发布时间：</td>
                                  <td width="320">                                    <input name="post_time" type="text" id="post_time2" style="width:100px"  value="<?=$row->post_time?>"/>        </td>
                                  <td width="90">是否锁定：</td>
                                  <td><select name="locked" id="select8">
                                    <option value="1" <?php if($row->locked=="1") echo "selected"; ?>>是</option>
                                    <option value="0" <?php if($row->locked=="0") echo "selected"; ?>>否</option>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">置顶期限：</td>
                                  <td width="320"><select name="top" id="select10">
                                    <?php    
									    $conArray = &$top_se ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->top) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                  </select>
                                                                                                                                                                          </select></td>
                                  <td width="90">是否推荐：</td>
                                  <td><select name="recommend" id="select9">
                                    <option value="1" <?php if($row->recommend=="1") echo "selected"; ?>>是</option>
                                    <option value="0" <?php if($row->recommend=="0") echo "selected"; ?>>否</option>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">关 键 词：</td>
                                  <td><textarea name="keywords" rows="3" id="textarea" style="width:650px"><?=$row->keywords?></textarea></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">文章摘要：</td>
                                  <td><textarea name="abstract" rows="3" id="abstract" style="width:550px"><?=$row->abstract?></textarea></td>
                                </tr>
                              </table></td>
                            </tr>
							<tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">参考网址：</td>
                                  <td><input name="refer_url" type="text" id="refer_url" style="width:650px" value="<?=$row->refer_url?>" />
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
                            <td width="90"><input name="article_id" type="hidden" id="article_id" value="<?=$_REQUEST['article_id']?>" />
                              <input name="class_name" type="hidden" id="class_name" value="<?=$class_name?>" />
                              </td>
                            <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><div align="center">
                                  <input name="submit" type="submit" id="submit" value="提 交" <?php if($class_row->class_attribute == '1') echo "onclick=\"return really();\"";?>>
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
if(document.form1.title.value=="") {
  alert("文章标题不可为空!");
  var obj = $Obj('needset');
  if(obj.style.display =="block")
  document.form1.title.focus();
  return false;
 }
if((document.form1.picture_select.value=="")&&(document.form1.picture_input.value=="")){
     result="该文章没有设置缩略图,确认吗？";   
      if   (confirm(result))   return true;
      else return false;
 }
}

function really() {
      result="提交将删除原有文章,继续吗？";   
       if   (confirm(result))    return true; 
       else { return false; }
 }
 
 var i=<?=$j+1?>;
						function 
						insRow()
						{var x=document.getElementById('myTable').insertRow(i+1);
						var h1=x.insertCell(0);
						var h2=x.insertCell(1);
						var h3=x.insertCell(2);
						var h4=x.insertCell(3);
						h1.innerHTML=i+"：";
						h2.innerHTML="<input name=title"+i+" type=text style='width:300px'>";
						h3.innerHTML="<input name=row"+i+" type=text  style='width:20px' />";
						h4.innerHTML="<textarea name=id_list"+i+" id=id_list"+i+" rows=3  style='width:300px'></textarea><input name=select"+i+" id=select"+i+" type=button  value='选择' onClick=OpenMywin_wider('select_for_zhuanti.php?form_id=id_list"+i+"')>";
						i=i+1;}
</script>
