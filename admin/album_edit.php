<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
$class_name=@mysql_result(mysql_query("select class_name from ".$table_suffix."infor where id='{$_REQUEST['class_id']}'"),0,"class_name");
if(!$class_name) { echo "<script>alert(\"请选择操作栏目!\"); history.go(-1);</script>"; exit; } 
if(empty($_REQUEST['article_id'])) { echo "<script>alert(\"请选择操作文档!\"); history.go(-1);</script>"; exit; } 
$query="select * from ".$table_suffix."album  where id={$_REQUEST['article_id']}";
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
<script language="javascript" src="js/album.js" type="text/javascript"></script>
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
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="action/album_edit_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
                <table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td bgcolor="#F4D8AC">&nbsp;内容管理&gt;&gt;<a href="content_list.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($class_name)?>"><?=$class_name?></a>&gt;&gt;修改&gt;&gt;<?=$_REQUEST['article_title']?></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="head1"  style="border-bottom:1px solid #99CC33">
    <tr> 
      <td colspan="2" bgcolor="#E2F5BC">
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
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90"> 重选栏目： </td>
                                <td><select name="class_id">
								<?php 
								 $query="select * from ".$table_suffix."infor where infor_class='{$_REQUEST['infor_class']}'";
								 $result=mysql_query($query);
								 while($rows=mysql_fetch_object($result)) {
								?>
								<option value="<?=$rows->id?>" <?php if($rows->id==$_REQUEST['class_id']) echo "selected"; ?>><?=$rows->class_name?></option>
								<?php } ?>
								</select>
								</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="90">文章标题：                                    </td>
                                  <td width="400"><input    <?php echo $row->title_color==""?"":"style=\"color:".$row->title_color.";\""; ?>  name="title" type="text" id="title" style="width:300px" value="<?=$row->article_title?>">
                                    加粗
                                    <input name="title_bold" type="checkbox" id="title_bold" value="1" <?php if($row->title_bold=="1") echo "checked"; ?>  /></td>
                                  <td width="90">标题颜色：</td>
                                  <td nowrap="nowrap"><input name="title_color" type="text" id="title_color" style="width:100px" value="<?=$row->title_color?>" /> 
                                    <input name="modcolor" type="button" id="modcolor" value="选取" onClick="ShowColor()"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="90" >文章来源：</td>
                  <td width="400"><input name="source_input" type="text" id="source" style="width:160px" value="<?=$row->article_from?>" />
                      <input name="selsource" type="button" id="selsource" value="选择" onClick="OpenMywin('source_writer.php?action_do=selsource')"></td>
                  <td width="90" >文章编辑：</td>
                  <td ><input name="writer_input" type="text" id="writer" style="width:160px" value="<?=$row->pen_name?>" />
                      <input name="selwriter" type="button" id="selwriter" value="选择" onClick="OpenMywin('source_writer.php?action_do=selwriter')">
                  </td>
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
本地</td>
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
      <input name="auto_keywords" type="checkbox"  id="auto_keywords" value="1" <?php if($row->keywords=="") echo "checked"; ?> />
      自动获取关键词 </td>
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
					$fck->Value =$row->content;
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
                                <td width="90">&nbsp;表现方式：</td>
                                <td>
                                  <input name="show_style" id='pagestyle1' type="radio" onclick="HideObj('showstyle1')"  value="1" <?php if($row->show_style=="1") echo "checked"; ?>/>
      幻灯显示
      <input name="show_style" type="radio"   id='pagestyle2' onclick="ShowObj('showstyle1')" value="2" <?php if($row->show_style=="2") echo "checked"; ?>/>
      多行多列 
      <select name="water" id="water">
        <option value="0" selected="selected">不加</option>
        <option value="1">加</option>
      </select>
      加水印</td>
                              </tr>
                            </table>
                              <table width="800" border="0" cellpadding="0" cellspacing="0" id="showstyle1">
                                <tr>
                                  <td width="90">&nbsp;格式参数：<?php $geshi=$row->rows_num; $geshi=explode("x",$geshi);?></td>
                                  <td><input name="hang" type="text" id="hang" style="width:30px" value="<?=$geshi[0]==""?4:$geshi[0]?>" />
      行
        <input name="lie" type="text" id="lie" style="width:30px" value="<?=$geshi[1]==""?4:$geshi[1]?>" />
      列 小图片宽度限制
      <input name="small_width" type="text" id="small_width" style="width:30px" value="<?=$row->small_width==""?150:$row->small_width?>" />
      像素</td>
                                </tr>
                              </table>
                              <table width="800" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="90">&nbsp;大图宽度：</td>
                                  <td>
                                    <input type="text" name="big_width" style="width:30px" value="<?=$row->big_width==""?800:$row->big_width?>"/>
      像素(防止图片太宽在模板页中溢出) </td>
                                </tr>
                              </table>
                              <table width="800" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="90">&nbsp;图片数量：</td>
                                  <td><input name="picnum" type="text" id="picnum" style="width:30px" value="10"/>
                                      <input name="add_picnum" type="button" id="add_picnum" onclick="MakeUpload(0);" value="增加图片数量"/>
      （ 注：最大120幅，手工指定的图片链接允许填写远程网址） </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td>
       <?php 
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
	   $fhtml .= "<table width='800'><tr><td><input type='checkbox' name='isokcheck$j' id='isokcheck$j' value='1'   onClick='CheckSelTable($j)' checked='checked'>显示图片[$j]的选框</td></tr></table>";
	   $fhtml .= "<table width=\"800\" border=\"0\" id=\"seltb$j\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#E8F5D6\" style=\"margin-bottom:6px;margin-left:10px\"><tobdy>";
	   $fhtml .= "<tr bgcolor=\"#F4F9DD\">\r\n";
	   $fhtml .= "<td height=\"25\" colspan=\"2\">　<strong>图片{$j}：</strong></td>";
	   $fhtml .= "</tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td width=\"430\" height=\"25\"> 　本地上传： ";
	   $fhtml .= "<input type=\"file\" name='imgfile$j' style=\"width:330px\" onChange=\"SeePic(document.picview$j,document.form1.imgfile$j);\"></td>";
	   $fhtml .= "<td width=\"370\" rowspan=\"5\" align=\"center\"><a href=\"cut_pic.php?pic_url=$imgurl&iwidth=$cfg_albsimg_width&iheight=$cfg_albsimg_height\" target=\"_blank\"><img alt=\"点击截取缩略图\" src=\"{$imgurl}\" width=\"$cfg_albsimg_width\" id=\"picview$j\" border=\"0\" name=\"picview$j\"></a></td>";
	   $fhtml .= "</tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> 　指定网址： ";
	   $fhtml .= "<input type=\"text\" name='imgurl$j' style=\"width:260px\" value=\"{$imgurl}\" > ";
	   $fhtml .= "<input type=\"button\" name='selpic$j' value=\"选取\" style=\"width:65px\" onClick=\"SelectImageN('form1.imgurl$j','big','picview$j')\" class=\"inputbut\">";
	   $fhtml .= "</td></tr>"; 
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> 　图片标题： ";
	   $fhtml .= "<input type=\"text\" name='imgtitle$j' style=\"width:260px\" value=\"{$imgtitle}\"> ";
	   $fhtml .= "</td></tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> 　图片链接： ";
	   $fhtml .= "<input type=\"text\" name='imglink$j' style=\"width:260px\"  value=\"{$imglink}\"> ";
	   $fhtml .= "</td></tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"56\">　图片简介： ";
	   $fhtml .= "<textarea name='imgmsg$j' style=\"height:46px;width:330px\">".$imgmsg."</textarea> </td>";
	   $fhtml .= "</tr></tobdy></table>\r\n";
       	 	 	 	 echo $fhtml; 
       	 	 	 	 $j++;
		 }
	   ?>
							  <span id="uploadfield"></span>
		<script language="JavaScript">
		startNum = <?php echo $j?>;
		</script></td>
                          </tr>
                        </table>
                          <table width="100%" border="0" cellspacing="2" cellpadding="0" id="adset" style="display:none">
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">短 标 题：</td>
                                  <td width="320"><input name="short_title" type="text" id="short_title" style="width:300px" value="<?=$row->short_title?>" />                  </td>
                                  <td width="90">定义属性：                                    </td>
                                  <td><select name='show_attribute' style='width:150px'>
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
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">副 标 题：</td>
                                  <td width="320"><input name="vice_title" type="text" id="vice_title" style="width:300px" value="<?=$row->vice_title?>" />                                  </td>
                                  <td width="90">访问权限： </td>
                                  <td><select name="hide_type" id="select5" style="width:150px">
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
                                  <td><select name="new_or_not" id="new_or_not">
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
                                  <td width="320"><input name="visit_times" type="text" id="visit_times" style="width:100px" value="<?=$row->read_times?>" />
                                    通过审核： <select name="checked" id="checked">
                                      <option value="1" <?php if($row->checked=="1") echo "selected"; ?>>是</option>
                                      <option value="0" <?php if($row->checked=="0") echo "selected"; ?>>否</option>
                                    </select></td>
                                  <td width="90">是否评论：</td>
                                  <td><select name="comment_or_not" id="comment_or_not">
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
                                  <td width="320">
								  <input name="post_time" type="text" id="post_time" style="width:100px" value="<?=$row->post_time?>" />
        保留样式：
          <select name="keep_style" id="keep_style">
          <option value="1" <?php if($row->keep_style=="1") echo "selected"; ?>>是</option>
          <option value="0" <?php if($row->keep_style=="0") echo "selected"; ?>>否</option>
        </select></td>
                                  <td width="90">是否锁定：</td>
                                  <td><select name="locked" id="locked">
                                      <option value="1" <?php if($row->locked=="1") echo "selected"; ?>>是</option>
                                      <option value="0" <?php if($row->locked=="0") echo "selected"; ?>>否</option>
                                                                      </select></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">修改时间：</td>
                                  <td width="320">                                    <input name="last_time" type="text" id="last_time" style="width:100px" value="<?=date("y-m-d H:i:s")?>" />
                                    置顶期限：                                    <select name="top" id="top">
                                    <?php    
									    $conArray = &$top_se ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->top) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                    </select>                                                                                                                                   </select></td>
                                  <td width="90">是否推荐：</td>
                                  <td><select name="recommend" id="recommend">
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
                                  <td><textarea name="keywords" rows="3" id="keywords" style="width:550px"><?=$row->keywords?>
                                  </textarea></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">文章摘要：</td>
                                  <td><textarea name="abstract" rows="3" id="abstract" style="width:550px"><?=$row->abstract?>
                                  </textarea></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">相关文章：</td>
                                  <td><textarea name="similar_id" rows="3" id="similar_id" style="width:550px"><?=$row->similar_id?>
                                  </textarea> <input name="select_article" type="button" id="select_article" value="选择" 
								  onClick="OpenMywin_wider('select_list.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($class_name)?>')"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90">参考网址：</td>
                                  <td><input name="refer_url" type="text" id="refer_url2" style="width:550px" value="<?=$row->refer_url?>" />
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
                            <td width="90">
                              <input name="article_id" type="hidden" id="article_id" value="<?=$_REQUEST['article_id']?>" />
                              <input name="class_name" type="hidden" id="class_name" value="<?=$class_name?>" />
                              <input name="num_of_img" type="hidden" id="num_of_img" value="<?=$j-1?>" /></td>
                            <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><div align="center">
                                  <input name="submit" type="submit" id="submit" value="提 交" onclick="get_class_name();">
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
if(!document.form1.first_pic.checked&&!document.form1.pic_remote.checked&&!document.form1.pic_local.checked&&(document.form1.picture_select.value=="")&&(document.form1.picture_input.value=="")){
     result="该文章没有设置缩略图,确认吗？";   
      if   (confirm(result))   return true;
      else return false;
 }
}
function get_class_name(){
document.form1.class_name.value=document.all.class_id.children[document.all.class_id.selectedIndex].text;  
return true;
}
</script>
