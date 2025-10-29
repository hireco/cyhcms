<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
$class_name=@mysql_result(mysql_query("select class_name from ".$table_suffix."infor where id='{$_REQUEST['class_id']}'"),0,"class_name");
if(!$class_name) { echo "<script>alert(\"请选择操作栏目!\"); history.go(-1);</script>"; exit; } 
if(empty($_REQUEST['article_id'])) { echo "<script>alert(\"请选择操作文档!\"); history.go(-1);</script>"; exit; } 
$query="select * from ".$table_suffix."soft  where id={$_REQUEST['article_id']}";
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
              <td><form name="form1" method="post" action="action/soft_edit_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
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
  </table>   <table width="100%"  border="0" cellspacing="2" cellpadding="0" id="needset">
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
                                  <td width="90">软件标题：                                    </td>
                                  <td width="400"><input name="article_title" type="text" id="article_title" <?php echo $row->title_color==""?"":"style=\"color:".$row->title_color.";\""; ?> style="width:300px" value="<?=$row->article_title?>">
                                    加粗
                                      <input name="title_bold" type="checkbox" id="title_bold2" value="1" <?php if($row->title_bold=="1") echo "checked"; ?>/></td>
                                  <td width="90">标题颜色：</td>
                                  <td nowrap="nowrap"><input name="title_color" type="text" id="title_color2" style="width:100px" value="<?=$row->title_color?>"/> 
                                    <input name="modcolor" type="button" id="modcolor" value="选取" onClick="ShowColor()"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" >上传地址：</td>
                                <td width="400"><input name="rurl" type="text" id="rurl" style="width:300px" value="<?=$row->saved_url?>" />
                                  <input type="button" name="selmedia" class="binput" style="width:60px" value="浏览..." onclick="SelectAddon('form1.rurl')" /></td>
                                <td width="90">运行环境：</td>
                                <td>                                  <select name="os" id="select12" style="width:100px">
                                    <?php    
									    $conArray = &$os ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->os) echo " selected";
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
                  <td width="90" >软件来源：</td>
                  <td width="400"><input name="source_input" type="text" id="source" style="width:300px" value="<?=$row->soft_from?>" /></td>
                  <td width="90">软件级别： </td>
                  <td><select name="soft_level" id="select10">
                    <?php    
									    $conArray = &$soft_level ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->soft_level) echo " selected";
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
                                <td width="90" >软件授权：</td>
                                <td width="400">                                  <select name="soft_right" id="select11" style="width:100px">
                                    <?php    
									    $conArray = &$soft_right ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->soft_right) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                  </select></td>
                                <td width="90">软件类型：</td>
                                <td><select name="soft_type">
                                  <?php    
									    $conArray = &$soft_type ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->soft_type) echo " selected";
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
                                <td width="90" >演示地址：</td>
                                <td width="400"><input name="official_url" type="text" id="official_url" style="width:300px" value="<?=$row->demo_url?>" /></td>
                                <td width="90">文件类型： </td>
                                <td><select name="file_type" id="select13">
                                  <?php    
									    $conArray = &$file_format ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->file_type) echo " selected";
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
                                <td width="90" >官方网址：</td>
                                <td width="400"><input name="official_url" type="text" id="official_url" style="width:300px" value="<?=$row->official_url?>" /></td>
                                <td width="90">软件语言：</td>
                                <td><select name="file_lang">
                                  <?php    
									    $conArray = &$file_lang ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$row->file_lang) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                </select></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td>                              <table width="800"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90" valign="top">更多地址：</td>
                                  <td><table width="100%" border="0" cellpadding="2" cellspacing="0" id="mytable">
                                    <tbody>
                                      <tr>
                                        <td colspan="4" align="center" bordercolor="#rgb(32,44,96)" class="inquiry"><div align="left"></div>                                          <div align="left">
                                              <input name="button" type="button" onclick="insRow()" value="Add more..." />
                                                                                  </div></td>
                                        </tr>
										<?php 
							           $url=explode(",",$row->file_links);
									   if(($row->file_links<>"")&&(count($url)<>0)) {
							           for($j=0;$j<count($url);$j++) { 
									    $url_str=explode("*",$url[$j]);
									   ?>
                                      <tr>
                                        <td width="90">地 址 <?=$j+1?>：</td>
                                        <td width="300"><input name="url<?=$j+1?>"  value="<?=$url_str[1]?>" type="text" id="url<?=$j+1?>" style="width:300px" /></td>
                                        <td width="90">服 务 器：</td>
                                        <td><input name="server<?=$j+1?>" value="<?=$url_str[0]?>" type="text" id="server<?=$j+1?>" style="width:150px" />
                                        </td>
                                      </tr>
                                      <?php } 
									  if(count($url)<3) for($i=1;$i<=3-count($url);$i++) { ?>
									   <tr>
                                        <td width="90">地 址 <?=$j+$i?>：</td>
                                        <td width="300"><input name="url<?=$j+$i?>" type="text" id="url<?=$j+$i?>" style="width:300px" /></td>
                                        <td width="90">服 务 器：</td>
                                        <td><input name="server<?=$j+$i?>" type="text" id="server<?=$j+$i?>" style="width:150px" />
                                        </td>
                                      </tr>
									  <?php } 
									    } else {						  
									  ?>
									  <tr>
                                        <td width="90">地 址 1：</td>
                                        <td width="300"><input name="url1" type="text" id="url1" style="width:300px" /></td>
                                        <td width="90">服 务 器：</td>
                                        <td><input name="server1" type="text" id="server1" style="width:150px" />
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>地 址 2：</td>
                                        <td><input name="url2" type="text" id="url2" style="width:300px" /></td>
                                        <td>服 务 器：</td>
                                        <td><input name="server2" type="text" id="server2" style="width:150px" />
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>地 址 3：</td>
                                        <td><input name="url3" type="text" id="url3" style="width:300px" /></td>
                                        <td>服 务 器：</td>
                                        <td><input name="server3" type="text" id="server3" style="width:150px" />
                                        </td>
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
                          <tr>
                            <td><table width="800"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" valign="top">软件介绍：</td>
                                <td><?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("body");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '650' ;
					$fck->Height		= "200" ;
					$fck->ToolbarSet	= "Small" ;
					$fck->Value = $row->content;
					$fck->Create(); ?></td>
                              </tr>
                            </table></td>
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
                            <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="90" height="81" valign="top">缩 略 图：<br/>
                                    <br />
                                </td>
                                <td width="400" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td height="30">图片来源：
                                          <input type='checkbox'  name='pic_remote' id='pic_remote' onclick="CkRemote_Local('pic_remote','upload_pic','local_pic','pic_local')" />
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
                                      <td height="30"><?php echo $cfg_artsimg_width." X ".$cfg_artsimg_height; ?> </td>
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
                                    <td width="90">是否置新：</td>
                                    <td><select name="new_or_not" id="select2">
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
                                    </td>
                                    <td width="90">是否评论：</td>
                                    <td><select name="comment_or_not" id="select2">
                                        <option value="1" <?php if($row->comment_or_not=="1") echo "selected"; ?>>是</option>
                                        <option value="0" <?php if($row->comment_or_not=="0") echo "selected"; ?>>否</option>
                                      </select>
                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="90">发布时间：</td>
                                    <td width="320">
                                      <input name="post_time" type="text" id="post_time2" style="width:100px"  value="<?=$row->post_time?>"/>
                                    </td>
                                    <td width="90">是否锁定：</td>
                                    <td><select name="locked" id="select3">
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
                                    <td width="320"><select name="top" id="select4">
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
                                    访问权限  
                                    <select name="hide_type" id="select" style="width:160px">
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
                                    </td>
                                    <td width="90">是否推荐：</td>
                                    <td><select name="recommend" id="select5">
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
                                    <td><textarea name="keywords" rows="3" id="textarea" style="width:550px"><?=$row->keywords?>
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
                                    <td><textarea name="similar_id" rows="3" id="textarea2" style="width:550px"><?=$row->similar_id?>
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
                            <td width="90"><input name="article_id" type="hidden" id="article_id" value="<?=$_REQUEST['article_id']?>" />
                              <input name="class_name" type="hidden" id="class_name2" value="<?=$class_name?>" /></td>
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
if(document.form1.article_title.value=="") {
  alert("文章标题不可为空!");
  var obj = $Obj('needset');
  if(obj.style.display =="block")
  document.form1.title.focus();
  return false;
 }
if(!document.form1.pic_remote.checked&&!document.form1.pic_local.checked&&(document.form1.picture_select.value=="")&&(document.form1.picture_input.value=="")){
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
   window.open("../file_do/select_soft.php?file_class=soft&f="+fname, "popUpSoftWin", "scrollbars=yes,resizable=yes,statebar=no,width=500,height=350,left="+posLeft+", top="+posTop);
}

						var i=4;
						function 
						insRow()
						{var x=document.getElementById('myTable').insertRow(i+1);
						var h1=x.insertCell(0);
						var h2=x.insertCell(1);
						var h3=x.insertCell(2);
						var h4=x.insertCell(3);
						h1.innerHTML="地 址 "+i+"：";
						h2.innerHTML="<input name=url"+i+" type=text style='width:300px'>";
						h3.innerHTML="服 务 器：";
						h4.innerHTML="<input name=server"+i+" type=text style='width:150px'>";
						i=i+1;}
</script>
