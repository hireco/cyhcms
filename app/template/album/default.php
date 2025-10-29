<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title; if($article_title) echo " - ".$article_title;?></title>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$abstract?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script>
    var maxWidth=540; 
	var maxHeight=450;
    function reload_pic(main_pic) {
    var imageArr=document.getElementById(main_pic);
    var imageRate = imageArr.offsetWidth / imageArr.offsetHeight;    
    
    if(imageArr.offsetWidth > maxWidth)
    {
        imageArr.style.width=maxWidth + "px";
        imageArr.style.Height=maxWidth / imageRate + "px";
    }
    
    if(imageArr.offsetHeight > maxHeight)
    {
        imageArr.style.width = maxHeight * imageRate + "px";
        imageArr.style.Height = maxHeight + "px";
    }
 }
  function change_pic(pic_url,title,msg,pic_link) {
  var image_title=document.getElementById('pic_title');
  var image_msg=document.getElementById('pic_msg');
  var image_link=document.getElementById('p_link');
  document.mi.src=pic_url;
  document.mi.alt=title; 
  image_title.innerHTML="<font color=black>图片标题:</font> "+title;
  image_msg.innerHTML="<font color=black>图片介绍:</font> "+msg;
  image_link.href=pic_link;
 }
 </script>
</head>
<body>
<?php  require_once("header.php"); ?>
<TABLE height=26 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
      border=0>
        <TBODY>
        <TR>
          <TD valign="top" class=nav>您现在的位置:
            <?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?> 
      </TD>
        </TR></TBODY></TABLE>
<?php if(!mysql_num_rows($result_picture)) { ?>
	  <table width="<?=$cfg_body_width?>" height="200"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center"><?php ShowMsg("Sorry! 没有找到相册内容...",-1); ?></div></td>
        </tr>
</table>
<?php }  else { ?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD vAlign=top height=200>      	    
	   <?php   
	    $query="select id from ".$table_suffix."comment where infor_class='album' and hide='0' and infor_id=$id";
	    $result_comment=mysql_query($query);
	    $num_of_comment=mysql_num_rows($result_comment);
	    
		$row_picture=mysql_fetch_object($result_picture);
		$picture_first=$row_picture->pic_url;
		$link_first=$row_picture->pic_link;
		$msg_first=$row_picture->pic_msg;
		$title_first=$row_picture->pic_title;
	  ?><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#DDDDDD">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF"><TABLE width="100%" border=0 align="center" cellPadding=0 cellSpacing=0>
            <TR>
              <TD align="center" valign="top" class=sml><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td><div align="center"><span class="newstitle"><font color="#FF0000">
                      <?=$row->article_title?>
                  </font></span></div></td>
                </tr>
                <tr>
                  <td><div align="center"> 发布： <font color="#FF6600">20<?=substr($row->post_time,0,8)?>
                      </font> 来源： <font color="#FF6600">
                      <?=$cfg_site_name?>
                      </font> 点击： <font color="#FF6600">
                      <?=$row->read_times?>
                  </font> 评论： 
                  <?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class=$infor_class&id=$row->id\">$num_of_comment</a>"; ?> 
                  <a href="#say" style="text-decoration:underline">我要评论</a> </div></td>
                </tr>
                <tr>
                  <td height="1" bgcolor="#E1E1E1"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td valign="top"><font color=blue>[相册简介]</font> <?=$row->content?></td>
                  </tr>
              </table></TD>
              <TD width="10" rowspan="2" align="center" valign="top" class=sml></TD>
              <TD width="220" rowspan="2" align="center" valign="top" class=sml><div align="left">
                  <?php 
				    $result_before=mysql_query("select id, article_title from ".$table_suffix."album where id < $id order by id desc limit 0, 1");
				    $result_after=mysql_query("select id, article_title from ".$table_suffix."album where id > $id order by id asc limit 0, 1");
				     $title_before=mysql_result($result_before,0,"article_title");
					 $title_after=mysql_result($result_after,0,"article_title");
					 $id_before=mysql_result($result_before,0,"id");
					 $id_after=mysql_result($result_after,0,"id");
				  ?>
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>上一篇：<?php if($title_before=="") echo "前面没有了"; else { ?><a style="text-decoration:underline; color:#003366" href="?id=<?=$id_before?>"><?=$title_before?></a><?php } ?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                    <tr>
                      <td>下一篇：<?php if($title_after=="") echo "后面没有了"; else { ?><a style="text-decoration:underline; color:#003366" href="?id=<?=$id_after?>"><?=$title_after?></a><?php }?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                  </table>
                 <?php 
				    $width=90;
					$height=90*$cfg_artsimg_height/$cfg_artsimg_width;
					echo "<TABLE width=\"100%\" border=0 align=\"center\" cellPadding=4 cellSpacing=1 bgColor=#999999>";
					$i_picture=1;
					$query="select * from ".$table_suffix."album where hide_type='0' order by top desc, top_time desc limit 0, 8";
					$result_album=mysql_query($query); 
					while($row_album=mysql_fetch_object($result_album)){
					$pic_id=$row_album->pic_id; 
                    $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                    $pic_row=mysql_fetch_object($pic_result);
					if($i_picture%2==1) echo "<TR>";
				    echo "<TD bgColor=black>";
	                echo "<DIV align=center>";
				    echo "<A href=\"?id=$row_album->id\">";
					$pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
					if(!empty($pic_url)) echo "<IMG height='$height' src=\"$pic_url\" alt=\"$row_album->article_title\" width='$width' border=0\">";
					else echo "<table width='$width' height='$height' border=0 cellpadding=0 cellspacing=0><tr>
                                <td><div align=center><A href=\"show_album.php?id=$row->id\"   target=_self>此文暂<br>无题图</A></div></td></tr>
                                </table>";
					echo "</A></DIV>";
                    echo "</TD>";
				   if($i_picture%2==0) echo "</TR>";
				   $i_picture++;
				   } 
				   echo "</TABLE>";
				   ?>                   
              </div></TD>
            </TR>
            <TR>
              <TD align="center" valign="top">
			    <?php if($row->show_style=="1") { ?><!---------幻灯显示------------>
			     <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table  border="0" align="left" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
                    <tr>
                      <td><TABLE border=0 align="left" cellPadding=4 cellSpacing=2 
bgColor=#FFFFFF>
                        <TR>
                     <?php 
				    $i_picture=1;
					$query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$id}";
					$result_picture=mysql_query($query); 
					while($row_picture=mysql_fetch_object($result_picture)){ 
					
					$imgid=$row_picture->id;
	                $query_msg="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
	                $result_msg=mysql_query($query_msg);
				    $row_msg=mysql_fetch_object($result_msg);
					
					if(($i_picture%18==0)&&($i_picture<>1)) echo "<TR>"; 
					if($i_picture%18==0) echo "</TR>";
					?>
                          <TD width="20px" bgColor="#0099CC"><div style="width:20px; font-size:14px; color:#333366; cursor:pointer; font-weight:bold" align="center" onmouseover="change_pic('<?=$row_picture->pic_url?>','<?=$row_picture->pic_title==""?"未知":trim($row_picture->pic_title)?>','<?=$row_msg->pic_msg==""?"暂无":trim($row_msg->pic_msg)?>','show_picture.php?id=<?=$_REQUEST['id']?>&page_id=<?=$i_picture?>');">
                              <?=$i_picture?>
                          </div></TD>
                          <?php $i_picture++; 
					} ?>
                        </TR>
                      </TABLE></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
                 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td>&nbsp;</td>
                   </tr>
                 </table>
                 <TABLE width="560" height="600" border=0 align="center" cellPadding=5 cellSpacing=1 bgColor=#CCCCCC>
                <TBODY>
                  <TR>
                    <TD valign="middle" bgcolor="#FFFFFF">
                      <DIV align=center>
                        <table  border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center" valign="middle"><table  border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FFFFFF"><a id="p_link" href="show_picture.php?id=<?=$_REQUEST['id']?>" target="_blank"><IMG onload="reload_pic('main_pic');" id="main_pic" src="<?=$picture_first?>" name=mi border="0"></a></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                        <table width="500" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td valign="top"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr>
                                  <td align="center" valign="top" class="picname" id="pic_title"><font color=black>图片标题:</font><?=$title_first==""?"未知":$title_first?></td>
                                </tr>
                              </table>
                                <table width="100%"  border="0" cellpadding="10" cellspacing="0">
                                  <tr>
                                    <td id="pic_msg" class="picmsg" valign="top"><font color=black>图片简介:</font><?=$msg_first==""?"暂无":$msg_first?></td>
                                  </tr>
                              </table></td>
                          </tr>
                        </table>
                    </DIV></TD>
                  </TR>
                </TBODY>
              </TABLE>
			  <?php } else { ?><!-----------排列显示------------>
			  <table width="560" height="300"  border=0 align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" valign="top"><TABLE border=0 align="center" cellPadding=4 cellSpacing=0>
                    <TR>
                      <?php 
				    $width=90;
					$height=90*$cfg_albsimg_height/$cfg_albsimg_width;
					$i_picture=0;
					$query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$id}";
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
</TD>
              </TR>
          </TABLE></td>
        </tr>
      </table>
	  <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table> 
	  </TD>
  </TR></TBODY></TABLE>  
  <table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>
	   <?php require_once("inc/similar_art.php"); ?>
	  <?php require_once("inc/add_times.php");//分别在文章表和索引表中更新点击数信息 ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
      <?php require_once("inc/comment_front.php"); ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
       <?php require_once("inc/add_comment.php");?>
	   <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table>
	   <BR>
      </td></tr></table>
<?php  }  require_once("footer.php"); ?>
</body>
</html>