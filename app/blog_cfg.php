<?php 
require_once("setting.php");
require_once("dbscripts/db_connect.php"); 
require_once("config/base_cfg.php");
require_once(dirname(__FILE__)."/".$cfg_admin_root."function/inc_function.php");
require_once(dirname(__FILE__)."/".$cfg_admin_root."function/getip.php");
require_once(dirname(__FILE__)."/file_do/pic_upload.php");
require_once($cfg_admin_root."scripts/constant.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
</head>
<body>
<?php  require_once("center_header.php"); 
if(isset($_SESSION['user_name'])) { ?>
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
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 博客设置</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top height=300>
			<?php 
			  $query="select * from ".$table_suffix."blog_cfg  where user_name='{$_SESSION['user_name']}'";
			  $result_query=mysql_query($query);
			  
			  if(isset($_POST['submit_cfg'])) { 
					if ( isset( $_POST ) )  $postArray = &$_POST ;
						  foreach ( $postArray as $sForm => $value )
							{
								if ( get_magic_quotes_gpc() )
									$$sForm = stripslashes( trim($value) )  ;
								else
									$$sForm = trim($value)  ;
							} 
					//获取所有的提交POST变量
					$upload_child_dir=$cfg_user_root;
                    $dir_relate=RROOT."/";
					//上传目录设置
					if(is_uploaded_file($_FILES['body_bg_img_input']['tmp_name'])) 	{ $body_bg=image_upload($dir_relate,$upload_child_dir,"body_bg_img_input","",""); $body_bg_type="i"; }
	                elseif($body_bg_img<>"") 	{ $body_bg=get_content_url($body_bg_img,RROOT); $body_bg_type="i";}
					elseif($body_bg_color<>"")  { $body_bg=$body_bg_color; $body_bg_type="c"; }
				    //背景设置
					if(is_uploaded_file($_FILES['head_bg_img_input']['tmp_name'])) 	{ $head_bg=image_upload($dir_relate,$upload_child_dir,"head_bg_img_input","",""); $head_bg_type="i"; }
	                elseif($head_bg_img<>"") 	{ $head_bg=get_content_url($head_bg_img,RROOT); $head_bg_type="i";}
					elseif($head_bg_color<>"")  { $head_bg=$head_bg_color; $head_bg_type="c"; }
				    //头部背景
					if(is_uploaded_file($_FILES['core_bg_img_input']['tmp_name'])) 	{ $core_bg=image_upload($dir_relate,$upload_child_dir,"core_bg_img_input","",""); $core_bg_type="i"; }
	                elseif($core_bg_img<>"") 	{ $core_bg=get_content_url($core_bg_img,RROOT); $core_bg_type="i";}
					elseif($core_bg_color<>"")  { $core_bg=$core_bg_color; $core_bg_type="c"; }
				    //正文背景
					if(is_uploaded_file($_FILES['banner_img_input']['tmp_name'])) 	$banner=image_upload($dir_relate,$upload_child_dir,"banner_img_input","",""); 
	                elseif($banner_img<>"") 	 $banner=get_content_url($banner_img,RROOT); 
				    //banner设置
					$blog_title=msubstr(trim(strip_tags($blog_title)),0,30);
					if(@mysql_num_rows($result_query))  $result=mysql_query("delete from ".$table_suffix."blog_cfg where user_name='{$_SESSION['user_name']}'");  
					if($result) $result=mysql_query("insert into ".$table_suffix."blog_cfg (user_name,body_width,head_bg_type,head_bg,head_height,banner,body_bg_type,body_bg,blog_title,blog_title_color,core_bg,core_bg_type) 
					      values ('{$_SESSION['user_name']}','$body_width','$head_bg_type','$head_bg','$head_height','$banner','$body_bg_type','$body_bg','$blog_title','$blog_title_color','$core_bg','$core_bg_type') ");	
				    if($result) ShowMsg("恭喜,您已经成功的设置您的博客",-1); 
					else ShowMsg("抱歉,没有完成设置,请重来",-1);
				 }
			  else 
			  {  
				  $row=mysql_fetch_object($result_query);
			  ?>				  <table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#DDDDDD">
                        <tr>
                          <td>您有以下几个项目可以自由设置,也可以不管,则自动采用默认值</td>
                        </tr>
                      </table>                        
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><form action="" method="post" enctype="multipart/form-data" name="form1">
                              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td width="100">确定博客名称</td>
                                  <td><input name="blog_title" type="text" class="INPUT" id="blog_title" style="width:120px;" value="<?=$row->blog_title?>"> 
                                    * 不得超过15个汉字或30个英文字母</td>
                                </tr>
                                <tr>
                                  <td>博客标题颜色</td>
                                  <td><input name="blog_title_color" type="text" class="INPUT" id="blog_title_color" style="width:120px;" value="<?=$row->blog_title_color?>">
                                    * 避免与背景色一样,或者太相近</td>
                                </tr>
                                <tr>
                                  <td><div align="left">博客页面宽度</div></td>
                                  <td><input name="body_width" type="text" class="INPUT" id="body_width"  style="width:100px;" value="<?=$row->body_width?>"> 
                                    *百分比或者数字,推荐800</td>
                                </tr>
                                <tr>
                                  <td>设置头部高度</td>
                                  <td><input name="head_height" type="text" class="INPUT" id="head_height"  style="width:100px;" value="<?=$row->head_height?>"> 
                                  *只能填写数字,推荐200</td>
                               </tr>
                                <tr bgcolor="#CCCCCC">
                                  <td height="1" colspan="2" valign="top"></td>
                                </tr>
								<tr>
                                  <td rowspan="3" valign="top"><div align="left">博客背景设置</div></td>
                                  <td><input <?php if($row->body_bg_type=="c") echo $row->body_bg==""?"":"style=\"color:".$row->body_bg.";\""; ?>  name="body_bg_color" type="text" class="INPUT" id="body_bg_color" style="width:100px" value="<?php if($row->body_bg_type=="c")  echo $row->body_bg;?>" />
                                    <input name="modcolor" type="button" class="INPUT" id="modcolor" onClick="ShowColor('body_bg_color')" value="选取">
                                  *填色,可以查找颜色代码自行填写</td>
                                </tr>
                                <tr>
                                  <td><input name="body_bg_img" type="text" class="INPUT" id="body_bg_img" style="width:300px; " value="<?php if($row->body_bg_type=="i")  echo $row->body_bg;?>">
                                  *图象<?php if($row->body_bg_type=="i") { ?><div align="center"><br><img src="<?=$row->body_bg?>"  width="200"  align="left"><br></div>
                                  <?php } ?></td>
                                </tr>
                                <tr>
                                  <td><input name="body_bg_img_input" type="file" class="INPUT" id="body_bg_img_input" style="width:300px; ">
                                  *上传</td>
                                </tr>
                                <tr bgcolor="#CCCCCC">
                                  <td height="1" colspan="2" valign="top"></td>
                                </tr>
                                <tr>
                                  <td rowspan="2" valign="top"><div align="left">顶部banner</div></td>
                                  <td><input name="banner_img" type="text" class="INPUT" id="banner_img" style="width:300px; " value="<?=$row->banner?>">
                                  *图象<?php if($row->banner) { ?><div align="center"><br><img src="<?=$row->banner?>"  width="200"  align="left"><br></div>
                                  <?php } ?></td>
                                </tr>
                                <tr>
                                  <td><input name="banner_img_input" type="file" class="INPUT" id="banner_img_input" style="width:300px; ">
                                  *上传</td>
                                </tr>
                                <tr bgcolor="#CCCCCC">
                                  <td height="1" colspan="2" valign="top"></td>
                                </tr>
								<tr>
                                  <td rowspan="3" valign="top"><div align="left">头部背景设置</div></td>
                                  <td><input <?php if($row->head_bg_type=="c") echo $row->head_bg==""?"":"style=\"color:".$row->head_bg.";\""; ?> name="head_bg_color" type="text" class="INPUT" id="head_bg_color" style="width:100px" value="<?php if($row->head_bg_type=="c")  echo $row->head_bg;?>"/>
                                    <input name="modcolor2" type="button" class="INPUT" id="modcolor2" onClick="ShowColor('head_bg_color')" value="选取">
                                  *填色,可以查找颜色代码自行填写</td>
                                </tr>
                                <tr>
                                  <td><input name="head_bg_img" type="text" class="INPUT" id="head_bg_img" style="width:300px; " value="<?php if($row->head_bg_type=="i")  echo $row->head_bg;?>">
                                  *图象<?php if($row->head_bg_type=="i") { ?><div align="center"><br><img src="<?=$row->head_bg?>"  width="200"  align="left"><br></div>
                                  <?php } ?></td>
                                </tr>
                                <tr>
                                  <td><input name="head_bg_img_input" type="file" class="INPUT" id="head_bg_img_input" style="width:300px; ">
                                  *上传</td>
                                </tr>
                                <tr bgcolor="#CCCCCC">
                                  <td height="1" colspan="2" valign="top"></td>
                                </tr>
								<tr>
                                  <td rowspan="3" valign="top"><div align="left">正文背景设置</div></td>
                                  <td><input <?php if($row->core_bg_type=="c") echo $row->core_bg==""?"":"style=\"color:".$row->core_bg.";\""; ?> name="core_bg_color" type="text" class="INPUT" id="core_bg_color" style="width:100px" value="<?php if($row->core_bg_type=="c")  echo $row->core_bg;?>"/>
                                    <input name="modcolor2" type="button" class="INPUT" id="modcolor2" onClick="ShowColor('core_bg_color')" value="选取">
                                  *填色,可以查找颜色代码自行填写</td>
                                </tr>
                                <tr>
                                  <td><input name="core_bg_img" type="text" class="INPUT" id="core_bg_img" style="width:300px; " value="<?php if($row->core_bg_type=="i")  echo $row->core_bg;?>">
                                  *图象<?php if($row->core_bg_type=="i") { ?><div align="center"><br><img src="<?=$row->core_bg?>"  width="200"  align="left"><br></div>
                                  <?php } ?></td>
                                </tr>
                                <tr>
                                  <td><input name="core_bg_img_input" type="file" class="INPUT" id="core_bg_img_input" style="width:300px; ">
                                  *上传</td>
                                </tr>
                                <tr bgcolor="#CCCCCC">
                                  <td height="1" colspan="2" valign="top"></td>
                                </tr>
								<tr>
                                  <td><div align="left"></div></td>
                                  <td><input name="submit_cfg" type="submit" class="INPUT" id="submit2" value="提 交" />
                                  <input name="cancel" type="button" class="INPUT" id="cancel" value="不理返回" onclick="history.go(-1);"/></td>
                                </tr>
                              </table>
                            </form></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
				  <?php } ?>
 </TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
</table>
      <?php   require_once("footer.php"); ?>
<?php 
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>
<script>
function ShowColor(obj_id){
	var obj= document.getElementById(obj_id);
	var fcolor=showModalDialog("inc/color.htm?ok",false,"dialogWidth:600px;dialogHeight:700px;status:0;dialogTop:"+(window.event.clientY+120)+";dialogLeft:"+(window.event.clientX));
	if(fcolor!=null && fcolor!="undefined") obj.value = fcolor;
}
</script>
