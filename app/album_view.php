<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php"); ?>
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
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 投稿 &gt; <a href="tougao_admin.php?infor_class=album">图集</a> > <a href="tougao_admin.php?class_id=<?=$_REQUEST['class_id']?>&infor_class=album&class_name=<?=urlencode($_REQUEST['class_name'])?>">
                  <?=$_REQUEST['class_name']?>
                </a></TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top height=300><table width="100%" height="450"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3">
                    <tr>
                      <td valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D0D2E3">
                          <tr>
                            <td bgcolor="#D0D2E3">
                              <div align="left">
                                <table  border="0" cellspacing="0" cellpadding="5">
                                  <tr bgcolor="#D0D2E3">
                                    <td height="5" colspan="3"></td>
                                  </tr>
                                  <tr>
                                    <td width="20" bgcolor="#D0D2E3">&nbsp;</td>
                                    <?php if(isset($_REQUEST['id'])){ ?>
                                    <td bgcolor="#FFFFFF"><div align="center"><a href="?id=<?=$_REQUEST['id']?>&class_id=<?=$_REQUEST['class_id']?>">查看内容</a></div></td>
                                    <td><div align="center"><a href="album_add.php?action=amend&class_id=<?=$_REQUEST['class_id']?>&article_id=<?=$_REQUEST['id']?>">编辑文章</a> </div></td>
                                    <?php } else { ?>
                                    <td><div align="center"><a href="tougao_admin.php?infor_class=album">全部文章</a></div></td>
                                    <?php } ?>
                                    <td><div align="center"><a href="album_add.php?class_id=<?=$_REQUEST['class_id']?>">发布文章</a> </div></td>
                                  </tr>
                                </table>
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                                <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                  <tr>
                                    <td height="200" valign="top">
                                      <?php  
									  $result=mysql_query("select * from ".$table_suffix."album where poster='{$_SESSION['user_name']}' and id={$_REQUEST['id']}");
	                                  if(!$result)   ShowMsg("Sorry,访问出错或者数据库读错误",-1); 
 		                              elseif(!@mysql_num_rows($result))    ShowMsg("没有找到对象",-1); 
									  elseif($row=mysql_fetch_object($result)) { ?>
                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                                              <tr>
                                                <td><div align="center" class="newstitle">
                                                    <?=$row->article_title?>
                                                </div></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td><div align="center">发布日期: <?=substr($row->post_time,3,11)?>  最新修改:  <?=substr($row->last_time,3,11)?> 原作者:  <?=$row->pen_name?>
</div></td>
                                        </tr>
                                        <tr>
                                          <td><div align="center"></div></td>
                                        </tr>
                                        <tr>
                                          <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                                              <tr>
                                                <td>［图集介绍］<?=$row->content;?></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                      </table>
										<table width="560" height="300"  border=0 align="center" cellpadding="0" cellspacing="0">
											<tr>
											  <td align="center" valign="top"><TABLE border=0 align="center" cellPadding=4 cellSpacing=0>
												<TR>
												<?php 
												$width=90;
												$height=90*$cfg_albsimg_height/$cfg_albsimg_width;
												$i_picture=0;
												$query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$_REQUEST['id']}";
												$result_picture=mysql_query($query); 
												while($row_picture=mysql_fetch_object($result_picture)){ 
												$pic_url=get_small_img($row_picture->pic_url,$row_picture->small_pic);
												$imgid=$row_picture->id;
												$query_msg="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
												$result_msg=mysql_query($query_msg);
												$row_msg=mysql_fetch_object($result_msg);
												
												if(($i_picture%5==0)&&($i_picture<>1)) echo "<TR>"; 
												if($i_picture%5==0) echo "</TR>";
												?>
												  <TD>
													<div align="center"><a href="show_picture.php?id=<?=$_REQUEST['id']?>&page_id=<?=$i_picture+1?>" target="_blank"><img src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$row_picture->pic_title==""?"点击看大图":$row_picture->pic_title?>" border="1" style="border:1px solid #000;"></a> </div></TD>
												  <?php $i_picture++; 
												} ?>
												</TR>
											  </TABLE></td>
											</tr>
									  </table>
										 <?php } ?>
                                    </td>
                                  </tr>
                                </table>
                            </div></td>
                          </tr>
                      </table></td>
                    </tr>
                  </table></TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php");  } else ShowMsg("访问的权限不够或者访问出错","member.php"); ?>
</body>
</html>