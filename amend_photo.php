<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
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
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 个人照片</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top>
				  <?php
				   if(isset($_POST['album_select'])) { 
				      if($_POST['album_select']<>"")  
				      $result=mysql_query("update ".$table_suffix."member set album_id ={$_POST['album_select']},pic_checked='1' where user_name='{$_SESSION['user_name']}'");
					  if($result) ShowMsg("恭喜!成功的选择新的个人相册",-1);
					  else ShowMsg("操作失败,请稍后重来",-1);
				     }
				   elseif(isset($_POST['submit_picture'])) { 
				      if($_POST['set_image']=="0")  $result=mysql_query("update ".$table_suffix."member set sample_pic ='' where user_name='{$_SESSION['user_name']}'");
					  else if($_POST['sample_pic']<>"")  $result=mysql_query("update ".$table_suffix."member set sample_pic ='{$_POST['sample_pic']}' where user_name='{$_SESSION['user_name']}'");
					  if($result) ShowMsg("恭喜!成功的设置个人形象照",-1);
					  else ShowMsg("操作失败,请稍后重来",-1);
				     }
				   else {
					   $result=mysql_query("select album_id, sample_pic from ".$table_suffix."member where user_name='{$_SESSION['user_name']}'");
					   $album_id=mysql_result($result,0,"album_id");
					   $sample_pic=mysql_result($result,0,"sample_pic");
					   $result=mysql_query("select * from ".$table_suffix."picture where object_class='member' and object_id=$album_id");
					   $pic_num=@mysql_num_rows($result);
					   if(!$pic_num) $_REQUEST['action']="select";
					   elseif(!isset($_REQUEST['action'])) $_REQUEST['action']="view";
					   ?>
					  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3">
						<tr>
						  <td valign="top" bgcolor="#FFFFFF">
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr bgcolor="#D0D2E3">
                            <td colspan="2" valign="bottom" bgcolor="#D0D2E3"> <div align="left">
						      <table  border="0" cellspacing="0" cellpadding="5">
						      <tr bgcolor="#D0D2E3">
							   <td height="5" colspan="4"></td>
							   </tr>
						        <tr>
							     <td width="20" bgcolor="#D0D2E3">&nbsp;</td>
							     <td bgcolor="#FFFFFF">设置照片</td>
						        </tr>
							  </table>
								 </div></td>
							 <td bgcolor="#D0D2E3"><form name="form1" method="post" action="" style="margin:0px;">
							   <table  border="0" align="right" cellpadding="0" cellspacing="0">
                                 <tr>
                                   <td valign="bottom" bgcolor="#D0D2E3"><table  border="0" align="center" cellpadding="5" cellspacing="0">
                                       <tr>
                                         <td height="5" colspan="3"></td>
                                       </tr>
                                       <tr>
									    <?php 
										$result=mysql_query("select * from ".$table_suffix."member_blog where blog_class='album'  and user_name='{$_SESSION['user_name']}' order by id desc"); 
										if(mysql_num_rows($result)) {
										?>
                                         <td>
                                           <div align="center">
                                             <?php if(!$pic_num)  echo "您尚未设置个人照片,请从您发布的相册中选取"; else echo "选择相册,重新设置个人照片"; ?>
                                         </div></td>
                                         <td>
                                         <div align="center">
										<select name="album_select" class="INPUT" id="select6">
                                               <?php 
										while($row=mysql_fetch_object($result)){ 
										echo "<option value=\"{$row->id}\""; 
										if($row->id==$album_id) echo " selected";
										echo ">{$row->infor_title}</option>";
										}
										?>
                                             </select>
                                        </div></td>
                                         <td><input name="submit_album" type="submit" class="INPUT" id="submit_album6" value="确  定"></td>
                                      <?php }  else echo "<td align=\"center\">尚未发布相册,请先在博客中发布相册</td>"; ?>	
									 </tr>
                                   </table></td>
                                 </tr>
                               </table></form></td>
                            </tr>
							     <tr valign="top" bgcolor="#D0D2E3">
									<td height="450" colspan="3" bgcolor="#FFFFFF">
									 <?php if($pic_num) { ?>
									 <form name="form2" method="post" action="" style="margin:0px;">
									 <table width="100%"  border="0" cellpadding="5" cellspacing="0">
									  <tr>
										<td colspan="2" align="center" valign="top"><table border=0 align="center" cellpadding=4 cellspacing=0>
											<tr>
											  <?php 
													$width=90;
													$height=90*$cfg_memsimg_height/$cfg_memsimg_width;
													$i_picture=0;
													$result_picture=mysql_query("select * from ".$table_suffix."picture where object_class='member' and object_id=$album_id");
													while($row_picture=mysql_fetch_object($result_picture)){ 
													$pic_url=get_small_img($row_picture->pic_url,$row_picture->small_pic);
													
													if(($i_picture%5==0)&&($i_picture<>1)) echo "<TR>"; 
													if($i_picture%5==0) echo "</TR>";
													?>
											     <td height=<?=$height+20?>>
												 <div align="center"><a href="<?=$row_picture->pic_link==""?$row_picture->pic_url:$row_picture->pic_link?>" target="_blank"><img src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$row_picture->pic_title==""?"点击看大图":$row_picture->pic_title?>" border="1" style="border:1px solid #000;"></a> </div>
												 <div align="center"><input name="sample_pic" type="radio" value="<?=$pic_url?>"  <?php if($pic_url==$sample_pic)  echo "checked";  if($pic_url==$row_picture->pic_url) echo "onClick=\"alert('此图没有设置缩略'); this.checked=0;\""; ?> >
												 选择 <a href="action/cut_pic.php?pic_url=<?=urlencode($row_picture->pic_url)?>&iwidth=<?=$cfg_memsimg_width?>&iheight=<?=$cfg_memsimg_height?>&idkey=<?=md5(basename($row_picture->pic_url).$cfg_memsimg_width.$cfg_memsimg_height)?>" target="_blank">做缩略</a></div>
												 </td>
											  <?php $i_picture++; 
														} ?>
											</tr>
										</table>									    </td>
									  </tr>
									  <tr>
									    <td colspan="2" align="center" valign="top"><div align="center">提示:您<?=$sample_pic==""?"尚未":"已经"?>设置形象照,单选框被选中者则被选择为形象照  
									        
							              </div></td>
						               </tr>
									  <tr>
									    <td width="50%" align="center" valign="top"><div align="right">
									      <select name="set_image" id="set_image">
									        <option value="1" selected>选择形象照</option>
									        <option value="0">撤消形象照</option>
								          </select>
									    </div></td>
								        <td align="center" valign="top"><div align="left">
								          <input name="submit_picture" type="submit" class="INPUT" id="submit_picture" value="确  定" onClick="return check_form();">
								        </div></td>
									  </tr>									  
									</table>
								     </form>
								 <?php } ?>
								</td>
							  </tr>
							</table></td>
						</tr>
				    </table>
				  <?php } ?>				  </TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php"); 
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>
<script>
function check_form() {
if(document.form2.set_image.value=="1"){ 
 if(!document.form2.sample_pic.length)   { 
   if(document.form2.sample_pic.checked) 
   return true;
   else { alert("您没有选择形象照"); return false;}
   }
 var flag=0;
 for(i=0;i<document.form2.sample_pic.length;i++) {
 if(document.form2.sample_pic[i].checked) { 
  flag=1;
  break;
    }
  }
  if(flag==1) return true; else { alert("您没有选择形象照"); return false;}
 }
 else return true;
}
</script>
