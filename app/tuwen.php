<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php  require_once("header.php"); ?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD vAlign=top><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
      <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./">首页</a> > <a href="tuwen.php">图文频道</a> </TD>
        </TR>
      </TBODY>
    </TABLE></TD>
  </TR>
  <TR>
    <TD height=200 vAlign=top>
	 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="420" valign="top"><table  border="0" align="left" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
           <tr>
             <td bgcolor="#FFFFFF"><?php require_once("inc/flash/flash1.php");?></td>
           </tr>
         </table></td>
         <td width="5">&nbsp;</td>
         <td valign="top"><TABLE class=table height=25 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
           <TBODY>
             <TR>
               <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
               <TD class=fontg>
                 <P>最新TOP图片</P></TD>
               <TD align=right valign="middle" class=fontg><a href="tuwen_list.php"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></a></TD>
             </TR>
           </TBODY>
         </TABLE>           <table width="100%"  border="0" align="left" cellpadding="5" cellspacing="0">
           <tr>
             <td valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
               <tr>
                 <td valign="top"><?php 
				   $query="select * from ".$table_suffix."infor_index  where infor_class='album' order by ".$show_turn['最新文章']." limit 0, 8";
			       $result=mysql_query($query);
				  ?>
                   <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                     <TBODY>
                       <?php  while($row=mysql_fetch_object($result)) { ?>
                       <TR>
                         <TD width="28" align=middle><IMG height=14 
                        src="image/items.gif" width=16></TD>
                         <TD height=19><A class=tList 
                        href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" 
                        target=_self><font color="<?=$row->title_color?>" style="font-weight:<?=$row->title_bold=="1"?"bold":"normal"?>">
                           <?=$row->article_title?>
                           </font></A><FONT 
                        class=fonts>[
                           <?=substr($row->post_time,3,11)?>
                           ]</FONT></TD>
                       </TR>
                       <?php } ?>                       
                     </TBODY>
                   </TABLE>                   </td>
               </tr>
             </table></td>
           </tr>
         </table></td>
       </tr>
     </table>
	 <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td></td>
       </tr>
     </table>
	 <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
       <TBODY>
         <TR>
           <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
           <TD class=fontg>
             <P>精美图片推荐</P></TD>
           <TD align=right valign="middle" class=fontg><a href="tuwen_list.php"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></a></TD>
         </TR>
       </TBODY>
     </TABLE>
	 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#DDE9F2">
       <tr>
         <td bgcolor="#FFFFFF"><TABLE width="100%" border=0 cellPadding=5 cellSpacing=0>
       <TBODY>
         <?php       $query="select * from ".$table_suffix."album  order by top desc, top_time desc";
		              $per_page_num=15;
			          $rows=@mysql_query($query);
					  for($i=1;$i<=$per_page_num;$i++)
				      { if($row=@mysql_fetch_object($rows)){  
					  $pic_id=$row->pic_id; 
                      $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                      $pic_row=mysql_fetch_object($pic_result);
					  if($i%5==1) echo "<TR>";
					 ?>
       <TD align=middle class=cpquery>
           <?php 
						    $width=120;
					        $height=120*$cfg_artsimg_height/$cfg_artsimg_width;
						  ?>
           <TABLE class=table cellSpacing=0 cellPadding=2 width=100 
                  border=0>
             <TBODY>
               <TR>
                 <TD bgColor=#f0f0f0 height=99>
                   <TABLE cellSpacing=1 cellPadding=1 width=100 
                        align=center bgColor=#e5e5e5 border=0>
                     <TBODY>
                       <TR>
                         <TD align=middle width=<?=$width+2?> height=<?=$height?> bgColor=#ffffff ><?php 
							  $pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
							  if($pic_url<>"") {?>
                             <A 
                              href="show_album.php?id=<?=$row->id?>" 
                              target=_self><IMG height=<?=$height?> alt="<?=$row->article_title?>"
                              src="<?=$pic_url?>" width=<?=$width?> 
                               border="1" style="border:1px solid #000;"></A>
                             <?php }  else { ?>
                             <table width=<?=$width?> height=<?=$height?> border=0 cellpadding=0 cellspacing=0>
                               <tr>
                                 <td><div align=center><A 
                              href="show_album.php?id=<?=$row->id?>" 
                              target=_self>此文暂<br>
                                     无题图</A></div></td>
                               </tr>
                             </table>
                             <?php } ?></TD>
                       </TR>
                     </TBODY>
                 </TABLE></TD>
               </TR>
               <TR>
                 <TD align=middle bgColor=#f0f0f0 height=25><SPAN 
                        class=pictitle><A 
                              href="show_album.php?id=<?=$row->id?>" 
                              target=_self>
                   <?=$row->article_title?>
                 </A></SPAN></TD>
               </TR>
             </TBODY>
         </TABLE></TD>
           <?php 
					    if($i%5==0) echo "</TR>";
					     } 
					    }
					  ?>
     </TABLE></td>
       </tr>
     </table>
	 <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td></td>
       </tr>
     </table>
	 <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
       <TBODY>
         <TR>
           <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
           <TD class=fontg>
             <P>精彩图文推荐</P></TD>
           <TD align=right valign="middle" class=fontg><a href="tuwen_list.php"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></a></TD>
         </TR>
       </TBODY>
     </TABLE>
	  <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#DDDDDD">
        <tr>
          <td bgcolor="#FFFFFF"><?php 
	   $query="select * from ".$table_suffix."picture where hide='0' and object_class!='album_list'  and object_class!='member' order by  id desc limit 0, 6";
	   $rows=@mysql_query($query);
	   while($row=@mysql_fetch_object($rows)){ 
	   $pic_url=get_small_img($row->pic_url,$row->small_pic);
	   $result_art=mysql_query("select * from ".$table_suffix.$row->object_class." where hide_type='0' and id={$row->object_id}");
	   $row_art=mysql_fetch_object($result_art);
	   $result_com=mysql_query("select * from ".$table_suffix."comment where infor_id={$row->object_id} and infor_class='{$row->object_class}'");
	   $num_of_comment=mysql_num_rows($result_com);
	  ?>
	  <TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
                  border=0>
            <TBODY>
              <TR>
                <TD style="PADDING-LEFT: 1px; PADDING-TOP: 6px" vAlign=top 
                      align=middle width=110>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                    <TBODY>
                      <TR>
                        <TD class=piclist align=middle>
                          <TABLE cellSpacing=1 cellPadding=3 
                              align=center bgColor=#e5e5e5 border=0>
                            <TBODY>
                              <TR>
                                <TD align=middle bgColor=#ffffff><a href="<?=$row->pic_link==""?"show_".$row->object_class.".php?id=$row->object_id":$row->pic_link?>" target="_self"><IMG src="<?=$pic_url==""?"upload/smallimg/ob_smimg/080811/no_picture.jpg":$pic_url?>" width="<?=80?>" height="<?=80*$cfg_artsimg_height/$cfg_artsimg_width?>" alt="<?=$row->pic_title==""?$row_art->article_title:$row->pic_title?>"   border="1" style="border:1px solid #000;"></a></TD>
                              </TR>
                            </TBODY>
                        </TABLE></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                    <TBODY>
                      <TR align=right>
                        <TD><A class=more 
                              href="student/class/?22.html"></A></TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" 
vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                    <TBODY>                     
                      <TR>
                        <TD height="21"><a class=tList href="<?="show_".$row->object_class.".php?id=$row->object_id"?>" target="_self"><span style="font-size:12px; font-weight:bold">
                          <font color="<?=$row_art->title_color?>"><?=$row_art->article_title?></font></span></A>&nbsp;<a class=tList href="<?="show_".$row->object_class.".php?id=$row->object_id"?>" target="_self">[详细]</a> 日期：<font color="#339966">20<?=$row_art->post_time?>
                          </font>&nbsp;&nbsp;点击：<font color="#CC3300">
                          <?=$row_art->read_times?>
                          </font>&nbsp;&nbsp;<a href="comment_list.php?infor_class=<?=$row->object_class?>&id=<?=$row->object_id?>">评论</a>：
                          <?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class={$row->object_class}&id={$row->object_id}\">$num_of_comment</a>"; ?></TD>
                      </TR>
                      <TR>
                        <TD background=image/line.gif 
                            height=5></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                      <TR>
                        <TD>&nbsp;&nbsp;&nbsp;&nbsp;<?=msubstr(strip_tags($row_art->content),0,220)?>...</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
            </TBODY>
        </TABLE>
	  <table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td background="image/dash_line.jpg"></td>
        </tr>
      </table>	  <?php 
		     }
		  ?></td>
        </tr>
      </table></TD>
  </TR>
  <TR>
    <TD vAlign=top>&nbsp;</TD>
  </TR>
  </TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
