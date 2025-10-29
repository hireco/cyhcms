<?php session_start();
require_once("setting.php");
require_once("dbscripts/db_connect.php");
require_once("config/base_cfg.php"); 
require_once("config/auto_set.php"); 
require_once("inc/show_msg.php");
require_once("member_editor/fckeditor.php");
require_once($cfg_admin_root."scripts/constant.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/album.js" type="text/javascript"></script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require_once("center_header.php"); 
  if(isset($_SESSION['user_name'])) { 
  $class_row=@mysql_fetch_object(mysql_query("select * from ".$table_suffix."infor where infor_class='album' and id='{$_REQUEST['class_id']}' and post_type<='{$_SESSION['user_level']}'"));
  $class_name_this=$class_row->class_name;
  if(!$class_name_this) { echo "<script>alert(\"请选择操作栏目!\"); history.go(-1);</script>"; exit; }
  if($_REQUEST['action']=="amend") {
   if(empty($_REQUEST['article_id'])) { echo "<script>alert(\"请选择操作文档!\"); history.go(-1);</script>"; exit; } 
   $query="select * from ".$table_suffix."album  where id={$_REQUEST['article_id']} and poster='{$_SESSION['user_name']}' and locked='0'";
   $result=mysql_query($query);
    if(!mysql_num_rows($result)) { echo "<script>alert(\"没有找到对应的文档!\"); history.go(-1);</script>"; exit; } 
    $row=mysql_fetch_object($result);
    if($row->checked=="1") echo "<script>alert(\"该图集已经通过审核并显示，若更改，将再次审核!\")</script>";
    $pic_id=$row->pic_id; 
    $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
    $pic_row=mysql_fetch_object($pic_result);
 }
?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width=181 height=186 valign="top" background=image/leftbg.gif><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>用户功能菜单</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <? require_once("inc/tree_menu.php");?>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF"><table cellspacing="0" cellpadding="0" width="100%" border="0">
            <tbody>
              <tr align="middle">
                <td valign="top" height="300"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#A3BCFE">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><form action="action/album_add_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check_form();">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td bgcolor="#A3BCFE"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>&nbsp;<a href="./">首 页</a> &gt; <a href="member.php">会员中心</a> &gt; 文章<?=$_REQUEST['action']=="amend"?"编辑":"发布"?> &gt; <?=$class_name_this?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" id="needset">
                    <tr>
                      <td> </td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                              <tr>
                                <td valign="middle"><div align="center">文章标题：</div></td>
                                <td valign="middle"><input name="title" type="text" class="INPUT" id="title5" style="width:250px" value="<?=$row->article_title?>"/></td>
                                <td width="80" align="left"><div align="center">查看权限：</div></td>
                                <td align="left">
                                        <div align="left">
                                          <select name="hide_type" id="select2" style="width:160px" class="INPUT">
                                            <?php    
									    $conArray = &$hide_type ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->hide_type) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                          </select>
</div></td>
                              </tr>
                              <tr>
                              <td valign="middle"><div align="center">文章来源：</div></td>
                              <td valign="middle"><input name="source_input" type="text" class="INPUT" id="source_input2" style="width:250px" value="<?=$row->article_from?>" /></td>
                              <td align="left"><div align="center">文章作者：</div></td>
                              <td align="left"><input name="writer_input" type="text" class="INPUT" id="writer_input3" style="width:160px"  value="<?=$row->pen_name==""?$_SESSION['nick_name']:$row->pen_name?>"/></td>
                              </tr>
                            <tr>
                            <td width="90" valign="middle"><div align="center">缩 略 图：</div></td>
                            <td width="199" valign="middle"><input name="picture_input" type="file" class="INPUT" id="picture_input6" style="width:250px" onchange="SeePic(document.picview,document.form1.picture_input);" /></td>
                            <td align="left"><div align="center">图片预览： </div></td>
                            <td rowspan="3" align="left"><table width="160" height="100" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td align="center" valign="middle" bgcolor="#FFFFFF"><?php if($pic_row->pic_url) echo "<a href=\"action/cut_pic.php?pic_url=".urlencode($pic_row->pic_url)."&iwidth=$cfg_artsimg_width&iheight=$cfg_artsimg_height&idkey=".md5(basename($pic_row->pic_url).$cfg_artsimg_width.$cfg_artsimg_height)."\" target=\"_blank\"><img alt=\"点击截取缩略图\" onload=\"reload_pic('picview');\" src=\"{$pic_row->pic_url}\" id=\"picview\" name=\"picview\"  border=0/></a>"; 
									  else echo "<img src=\"image/picview.jpg\" height=\"100\" id=\"picview\" name=\"picview\" />"; ?></td>
                                </tr>
                                                        </table></td>
                            </tr>
                          <tr>
                            <td width="90" valign="top"><div align="center">关 键 词：</div></td>
                                  <td colspan="2"><input type="text" name="keywords" class="INPUT" id="keywords" value="<?=$row->keywords?>" style="width:330px"></td>
                            </tr>
                          <tr>
                           <td width="90" valign="top"><div align="center">文章摘要：</div></td>
                                  <td colspan="2"><textarea name="abstract" rows="3" class="TEXTAREA" id="abstract" style="width:330px"><?=$row->abstract?></textarea></td>
                                  </tr>
                          <tr>
                            <td valign="top"><div align="center">附加选项：</div></td>
                            <td><input name="title_bold" type="checkbox" id="title_bold" value="1" <?php if($row->title_bold=="1") echo "checked"; ?>/>
标题加粗 
  <input name="auto_keywords" type="checkbox"  id="auto_keywords2" value="1" <?php if($row->keywords=="") echo "checked"; ?>/>
自动获取关键词</td>
                            <td align="left">&nbsp;</td>
                            <td align="left"><div align="center">缩略尺寸：<?php echo $cfg_artsimg_width." X ".$cfg_artsimg_height; ?></div></td>
                          </tr>
                          <tr>
                            <td valign="top"> <div align="center">图集说明：</div></td>
                            <td colspan="3"><textarea name="body" rows="7"  class="TEXTAREA" id="body" style="width:490px" ><?=$row->content?></textarea></td>
                            </tr>
                          <tr>
                            <td valign="top"> <div align="center">图片数量：</div></td>
                            <td colspan="3"><input name="picnum" type="text" class="INPUT" id="picnum" style="width:30px" value="10"/>
                              <input name="add_picnum" type="button" class="INPUT" id="add_picnum" onclick="MakeUpload(0);" value="增加图片数量"/>
（ 注：最大120幅，手工指定的图片链接允许填写远程网址） 
<input name="num_of_img" type="hidden" id="num_of_img" value="12" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>
					  <?php if($_REQUEST['action']=="amend") {
					   $query="select * from ".$table_suffix."picture  where object_class='album_list' and object_id={$row->id}";
					   $result_mate=mysql_query($query);
					   $j=1;
					   while($row_mate=mysql_fetch_object($result_mate)) {
					   $imgurl=$row_mate->pic_url;
					   $imgid=$row_mate->id;
					   $query="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
					   $imgmsg=mysql_result(mysql_query($query),0,"pic_msg");
					   $imgtitle=$row_mate->pic_title;
					   $imglink=$row_mate->pic_link;
					   
					   $fhtml = "";
					   $fhtml .= "<table width='100%'><tr><td><input type='checkbox' name='isokcheck$j' id='isokcheck$j' value='1'   onClick='CheckSelTable($j)' checked='checked'>显示图片[$j]的选框</td></tr></table>";
					   $fhtml .= "<table width=\"100%\" border=\"0\" id=\"seltb$j\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#E8F5D6\" style=\"margin-bottom:6px;margin-left:10px\"><tobdy>";
					   $fhtml .= "<tr bgcolor=\"#F4F9DD\">\r\n";
					   $fhtml .= "<td height=\"25\" colspan=\"3\">　<strong>图片{$j}：</strong></td>";
					   $fhtml .= "</tr>";
					   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
					   $fhtml .= "<td width=\"90\" height=\"25\"> 　本地上传： </td><td width=\"260\">";
					   $fhtml .= "<input class=\"INPUT\" type=\"file\" name='imgfile$j' style=\"width:260px\" onChange=\"SeePic(document.picview$j,document.form1.imgfile$j);\"></td>";
					   $fhtml .= "<td rowspan=\"5\" align=\"center\"><a href=\"action/cut_pic.php?pic_url=".urlencode($imgurl)."&iwidth=$cfg_albsimg_width&iheight=$cfg_albsimg_height&idkey=".md5(basename($imgurl).$cfg_albsimg_width.$cfg_albsimg_height)."\" target=\"_blank\"><img alt=\"点击截取缩略图\" src=\"{$imgurl}\" width=\"$cfg_albsimg_width\" id=\"picview$j\" border=\"0\" name=\"picview$j\"></a></td>";
					   $fhtml .= "</tr>";
					   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
					   $fhtml .= "<td height=\"25\"> 　指定网址： </td><td width=\"260\">";
					   $fhtml .= "<input class=\"INPUT\" type=\"text\" name='imgurl$j' style=\"width:260px\" value=\"{$imgurl}\" > ";
					   $fhtml .= "</td></tr>"; 
					   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
					   $fhtml .= "<td height=\"25\"> 　图片标题： </td><td width=\"260\">";
					   $fhtml .= "<input class=\"INPUT\" type=\"text\" name='imgtitle$j' style=\"width:260px\" value=\"{$imgtitle}\"> ";
					   $fhtml .= "</td></tr>";
					   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
					   $fhtml .= "<td height=\"25\"> 　图片链接： </td><td width=\"260\">";
					   $fhtml .= "<input class=\"INPUT\" type=\"text\" name='imglink$j' style=\"width:260px\"  value=\"{$imglink}\"> ";
					   $fhtml .= "</td></tr>";
					   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
					   $fhtml .= "<td height=\"56\">　图片简介： </td><td width=\"260\">";
					   $fhtml .= "<textarea  class=\"TEXTAREA\" name='imgmsg$j' style=\"height:46px;width:260px\">".$imgmsg."</textarea> </td>";
					   $fhtml .= "</tr></tobdy></table>\r\n";
									 echo $fhtml; 
									 $j++;
						 }
					  echo "<span id=\"uploadfield\"></span>\r\n<script language=\"JavaScript\">\r\n
					        startNum = $j;\r\n</script>";
					  } 
					  else echo "<span id=\"uploadfield\"></span>\r\n  <script language=\"JavaScript\">\r\n
	                        MakeUpload(13);\r\n</script>";
					  ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
                            <tr>
                              <td width="90"><input name="class_id" type="hidden" id="class_id" value="<?=$_REQUEST['class_id']?>" />
                                  <input name="article_id" type="hidden" id="article_id" value="<?=$_REQUEST['article_id']?>" />
                                  <input name="class_name" type="hidden" id="class_name" value="<?=$class_name?>" />
                                  <input name="action" type="hidden" id="action" value="<?=$_REQUEST['action']?>"/>
                              <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div align="center">
                                        <input name="submit" type="submit" class="INPUT" id="submit2" value="提 交" />
                                    </div></td>
                                    <td><div align="center">
                                        <input name="reset" type="reset" class="INPUT" id="reset2" value="重 置" />
                                    </div></td>
                                  </tr>
                                </table>
                              </td>
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
            </tbody>
          </table></td>
        </tr>
</table>




<?php require_once("footer.php");  } else ShowMsg("访问的权限不够或者访问出错","member.php"); ?>
</body></html>
<script>
function check_form() {
if(document.form1.title.value=="") {
  alert("文章标题不可为空!");
  var obj = $Obj('needset');
  if(obj.style.display =="block")
  document.form1.title.focus();
  return false;
 }
if(!document.form1.first_pic.checked&&!document.form1.pic_remote.checked&&!document.form1.pic_local.checked&&(document.form1.picture_select.value=="")&&(document.form1.picture_input.value=="")){
     result="该文章没有设置缩略图,确认吗？";   
      if   (confirm(result))   return true;
      else return false;
 }
}
function SeePic(img,f){
   if ( f.value != "" ) { img.src = f.value; }
}
</script>
