<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
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
          <TD class=nav>您现在的位置:<a href="./">首页</a> > <a href="tuwen.php">图文频道</a> > 更多图文 </TD>
        </TR>
      </TBODY>
    </TABLE></TD>
  </TR>
  <TR>
    <TD height=200 vAlign=top>
	 <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#DDDDDD">
            <tr>
              <td bgcolor="#FFFFFF"><?php 
	   $query="select * from ".$table_suffix."picture where hide='0' and object_class!='album_list'  and object_class!='member' order by id desc";
	   $rows=@mysql_query($query);
	   
	   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	   
	   $per_page_num=10;
	   
	   $num=@mysql_num_rows($rows);
	   $page=intval(($num-1)/$per_page_num)+1;
	 
	   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	   $page_front=($page_id<=1)?1:($page_id-1); 
	   $page_behind=($page_id>=$page)?$page:($page_id+1); 
	   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
	   
	   for($i=1;$i<=$per_page_num;$i++)
		 { if($row=@mysql_fetch_object($rows)){ 
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
                              <TD height="21"><a class=tList href="<?="show_".$row->object_class.".php?id=$row->object_id"?>" target="_self" style="text-decoration:underline "><span style="font-size:12px; font-weight:bold"> <font color="<?=$row_art->title_color?>"><strong>
                                <?=$row_art->article_title?>
                                </strong></font></span></A>&nbsp;<a class=tList href="<?="show_".$row->object_class.".php?id=$row->object_id"?>" target="_self">[详细]</a> 日期：<font color="#339966">20
                                <?=$row_art->post_time?>
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
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                          <TBODY>
                            <TR>
                              <TD>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?=msubstr(strip_tags($row_art->content),0,220)?>
                                  ...</TD>
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
                </table>
                <?php } 
		     }
		  ?></td>
            </tr>
          </table>
	  </TD>
  </TR>
  <TR>
    <TD vAlign=top><TABLE height=43 cellSpacing=0 cellPadding=4 width="100%" align=center border=0>
      <TBODY>
        <TR>
          <TD class=pagesinfo width=300>&nbsp;</TD>
          <TD class=pages align=right><?php  require_once("inc/page_divide.php");?></TD>
        </TR>
      </TBODY>
    </TABLE></TD>
  </TR>
  </TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
