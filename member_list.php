<?php session_start(); ?>
<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php"); 
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
<?php  require_once("header.php"); ?>
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
                        <TD>最新会员</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top>
				<?php 
			    $query="select * from ".$table_suffix."member  order by register_time desc, recommend desc limit 0, 10";
		        $result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
			  ?>
			  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                <TBODY>
                  <TR>
                    <TD class=piclist align=middle>
                      <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                        <TBODY>
                          <TR>
                            <TD vAlign=top width=70 style="line-height:110%;"><a href="user_infor.php?host_id=<?=$row_list->id?>&idkey=<?=md5($row_list->user_name)?>" style="text-decoration:underline"><?=$row_list->nick_name?></a></TD>
                            <TD vAlign=top style="line-height:100%;"><div align="right">
                              <?=substr($row_list->register_time,3,11)?>
                            </div></TD>
                          </TR>
                        </TBODY>
                      </TABLE>
                      <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                        <TBODY>
                          <TR>
                            <TD colSpan=2 height=4></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
              </TABLE>
			  <?php } ?></TD>
                </TR>
              </TBODY>
            </TABLE>
            <table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D2D2D1">
              <tr>
                <td></td>
              </tr>
            </table>            <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
              <TBODY>
                <TR>
                  <TD>
                    <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                      <TBODY>
                        <TR>
                          <TD width=8></TD>
                          <TD>最新日志</TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                </TR>
              </TBODY>
            </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top><?php 
			    $query="select * from ".$table_suffix."member_blog  where blog_class='rizhi' order by post_time desc limit 0, 10";
		        $result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
			  ?>
                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD class=piclist align=middle>
                            <TABLE cellSpacing=0 cellPadding=1 width="100%" border=0>
                              <TBODY>
                                <TR><TD vAlign=top style="line-height:130%;">
                                    <a href="user_infor.php?view=rizhi&infor_id=<?=$row_list->id?>&idkey=<?=md5($row_list->user_name)?>" style="text-decoration:underline"><?=$row_list->infor_title?></a>
                                  </TD></TR>
                                  <TR><TD vAlign=top style="line-height:100%;"><div align="right" style="color:gray">
                                      <?=substr($row_list->post_time,3,11)?>
                                  </div></TD>
                                </TR>
                              </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD colSpan=2 height=4></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  <?php } ?> </TD>
                </TR>
              </TBODY>
            </TABLE>
            <table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D2D2D1">
              <tr>
                <td></td>
              </tr>
            </table>            
			<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
              <TBODY>
                <TR>
                  <TD>
                    <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                      <TBODY>
                        <TR>
                          <TD width=8></TD>
                          <TD>会员相册</TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                </TR>
              </TBODY>
            </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top><?php 
			    $width=50; 
			    $height=50*$cfg_memsimg_height/$cfg_memsimg_width; 
			    $query="select * from ".$table_suffix."picture  where object_class='member' and hide='0' group by object_id desc limit 0, 20";
				$result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
				$pic_url=get_small_img($row_list->pic_url,$row_list->small_pic);
				$user_name=mysql_result(mysql_query("select user_name from ".$table_suffix."member_blog where id={$row_list->object_id}"),0,"user_name"); 
			  ?>
                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD class=piclist align=middle>
                            <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD vAlign=top width="50%"><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$row_list->object_id?>&idkey=<?=md5($user_name)?>" style="text-decoration:underline"><img name="" src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="" border="1" style="border:1px solid #000;"></a></div></TD>
                                  <?php if($row_list=mysql_fetch_object($result_list)) { 
								  $pic_url=get_small_img($row_list->pic_url,$row_list->small_pic);  
								  $user_name=mysql_result(mysql_query("select user_name from ".$table_suffix."member_blog where id={$row_list->object_id}"),0,"user_name"); 
								  ?>
								  <TD vAlign=top><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$row_list->object_id?>&idkey=<?=md5($user_name)?>" style="text-decoration:underline"><img name="" src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="" border="1" style="border:1px solid #000;"></a></div></TD></TR>
                                  <?php } else echo "<TD></TD>"; ?>
							  </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD colSpan=2 height=4></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  <?php } ?> </TD>
                </TR>
              </TBODY>
            </TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; 会员列表</TD>
              </TR>
            </TBODY>
          </TABLE>
		  <?php 
		      $width=60; 
			  $height=60*$cfg_memsimg_height/$cfg_memsimg_width; 
		      $query="select * from ".$table_suffix."member order by last_time desc"; 
		      $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
		      $per_page_num=10;
			  $rows=@mysql_query($query);
		      $num=@mysql_num_rows($rows);
		      $page=intval(($num-1)/$per_page_num)+1;
		      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
		      $page_front=($page_id<=1)?1:($page_id-1); 
		      $page_behind=($page_id>=$page)?$page:($page_id+1); 
		      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
			  for($i=1;$i<=$per_page_num;$i++) { 
			   if($row=@mysql_fetch_object($rows)){ 
			      $idkey=md5($row->user_name);
				  $ico_gif="image/".$row->sex.".gif";
				  $image_jpg="image/".$row->sex.".jpg"; 
				  $query="select content from ".$table_suffix."member_infor where user_name='{$row->user_name}'";
				  $content=mysql_result(mysql_query($query),0,"content");
		  ?>
            <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#B5E4F7">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="<?=$width+16?>" rowspan="4">
                      <table  border="0" cellpadding="2" cellspacing="1" bgcolor="#E3E3E3">
                        <tr>
                          <td bgcolor="#FFFFFF"><a href="user_infor.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt"><img src="<?=empty($row->sample_pic)?$image_jpg:$row->sample_pic?>"  width="<?=$width?>" height="<?=$height?>" border="0"></a></td>
                        </tr>
                      </table>                    </td>
                    <td><img src="<?=$ico_gif?>" align="absmiddle" > <a href="user_infor.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt"><?=$row->nick_name?></a></td>
                    <td><div align="right"><span class="fonts">来自：<?=$row->district=="省份-地级市-县、地区"?"":ereg_replace("-地级市","",ereg_replace("-县、地区","",$row->district))?></span></div></td>
                  </tr>
                  <tr>
                    <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="left"><a href="user_infor.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt"><?=msubstr(strip_tags($content),0,150)?>…</a></div></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="right"><a href="user_infor.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt">详细信息</a> <a href="blog_inc/add_friend.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt">加为好友</a> <a href="user_infor.php?view=liuyan&host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt">给我留言</a>  <a href="user_infor.php?view=zhitiao&host_id=<?=$row->id?>&idkey=<?=$idkey?>" class="intro_txt">发纸条</a></div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
            <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
			<?php 
			    } 
		     }
			?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?php require_once("inc/page_divide.php");?></td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php"); ?>
</body>
</html>