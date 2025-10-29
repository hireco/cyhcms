<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/single_obj_class.php");?>
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
<?php  
require_once("header.php"); 
$class_id=$_REQUEST['class_id'];
$infor_class="zhuanti";
?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD vAlign=top width=181 background=image/leftbg.gif 
      height=186><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>分类导航</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=179 align=center 
      border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <?php 
			    $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
                $result=mysql_query($query); 
				if(!@mysql_num_rows($result)) {
			?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td><div align="center">本栏目没有分类</div></td>
                </tr>
              </table>
              <?php } ?>
              <TABLE cellSpacing=0 cellPadding=3 width="100%" border=0>
                <TBODY>
                  <?php 
			    $id_list=$class_id;
				while($row=mysql_fetch_object($result)) {
			    $id_list.=",".$row->id;
			  ?>
                  <TR class=list>
                    <TD style="PADDING-LEFT: 10px; BORDER-BOTTOM: #d2d2d2 1px solid" 
                width="100%" height=27><IMG height=14 
                  src="image/items.gif" width=16> <A class=class 
                  href="article.php?class_id=<?=$row->id?>" 
                  target=_self>
                      <?=$row->class_name?>
                    </A>&nbsp; </TD>
                  </TR>
                  <?php } ?>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
	  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
        <TD></TD></TR></TBODY></TABLE>
      <TABLE width="100%" height=8 
      border=0 cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
        <TBODY>
        <TR>
      <TD align=middle></TD></TR></TBODY></TABLE>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
          <TR>
            <TD>
              <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                <TBODY>
                  <TR>
                    <TD width=8></TD>
                    <TD>专题推荐</TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=90 cellSpacing=5 cellPadding=0 width="100%" border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <?php
			  $query="select * from ".$table_suffix."zhuanti  order by recommend desc,top desc, top_time desc limit 0,6";
			  $result=mysql_query($query);
			 ?>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <?php while($row=mysql_fetch_object($result)) { ?>
                  <TR>
                    <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                    <TD height=21><A class=tList 
                  href="show_zhuanti.php?id=<?=$row->id?>" 
                  target=_self><font color="<?=$row->title_color?>">
                      <?=msubstr($row->article_title,0,24)?>
                    </font></A></TD>
                  </TR><?php } ?>
                </TBODY>
              </TABLE>
              </TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:
            <?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?> 
        </TD>
        </TR></TBODY></TABLE>
       <TABLE height=34 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/sbg.gif border=0>
        <TR>
          <TD>
            <?php require_once("inc/search_form.php"); ?></TD></TR></TABLE>
      <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD">
        <tr>
          <td bgcolor="#FFFFFF">
		  <?php 
		     $width=105;
			 $height=105*$cfg_artsimg_height/$cfg_artsimg_width;
		     if(isset($_REQUEST['more'])) { 
			  $query="select * from ".$table_suffix."zhuanti where hide_type='0' and class_id=$class_id order by new_or_not desc,top desc, top_time desc";
			  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
		      $per_page_num=20;
			  $rows=@mysql_query($query);
		      $num=@mysql_num_rows($rows);
		      $page=intval(($num-1)/$per_page_num)+1;
		      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
		      $page_front=($page_id<=1)?1:($page_id-1); 
		      $page_behind=($page_id>=$page)?$page:($page_id+1); 
		      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
			  for($i=1;$i<=$per_page_num;$i++)
				{ if($row=@mysql_fetch_object($rows)){
				   $pic_id=$row->pic_id; 
                   $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                   $pic_row=mysql_fetch_object($pic_result);
			       $pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
                   $query="select id from ".$table_suffix."comment where infor_class='zhuanti' and infor_id={$row->id} and hide='0'";
			       $result_comment=mysql_query($query);
			       $num_of_comment=mysql_num_rows($result_comment);
			  ?>
			  		  <TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
                  border=0>
            <TBODY>
              <TR>
                <TD style="PADDING-LEFT: 1px; PADDING-TOP: 6px" vAlign=top 
                      align=middle width=110>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%"  border=0>
                    <TBODY>
                      <TR>
                        <TD class=piclist align=middle>
                          <TABLE cellSpacing=1 cellPadding=1 width=20 
                              align=center bgColor=#e5e5e5 border=0>
                            <TBODY>
                              <TR>
                                <TD align=middle bgColor=#ffffff><a href="<?=$row->picture_link==""?"show_zhuanti.php?id=$row->id":$row->picture_link?>" target="_self"><IMG src="<?=$pic_url==""?"upload/smallimg/ob_smimg/080811/no_picture.jpg":$pic_url?>" alt="<?=$row->picture_title?>" width=<?=$width?> height=<?=$height?>  border="1" style="border:1px solid #000;"></a></TD>
                              </TR>
                            </TBODY>
                        </TABLE></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                  </TD>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                    <TBODY>                     
                      <TR>
                        <TD height="21"><A class=tList href="show_zhuanti.php?id=<?=$row->id?>" target=_self><span style="font-size:12px; font-weight:bold">
                          <font color="<?=$row->title_color?>"><?=$row->article_title?></font></span></A>&nbsp;<A class=tList href="show_zhuanti.php?id=<?=$row->id?>" target=_self>[详细]</a></TD>
                        </TR>
                      <TR>
                        <TD background=image/line.gif 
                            height=3> 日期：<font color="#339966">20<?=$row->post_time?></font>&nbsp;&nbsp;点击：<font color="#CC3300"><?=$row->read_times?></font>&nbsp;&nbsp;<a href="comment_list.php?infor_class=zhuanti&id=<?=$row->id?>">评论</a>：<?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class=zhuanti&id=$row->id\">$num_of_comment</a>"; ?></TD>
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
                        <TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=msubstr(strip_tags($row->content),0,200)?>...</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
               </TR>
             </TBODY>
            </TABLE>
			  <?php
			      }
			    }
				 require_once("inc/page_divide.php");
			  }
			 else { 
			 $query="select * from ".$table_suffix."zhuanti where hide_type='0' and class_id=$class_id order by new_or_not desc,top desc, top_time desc limit 0, 3";
		     $result=mysql_query($query); 
			 while($row=mysql_fetch_object($result)) { 
			 $pic_id=$row->pic_id; 
             $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
             $pic_row=mysql_fetch_object($pic_result);
			 $pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
             $query="select id from ".$table_suffix."comment where infor_class='zhuanti' and infor_id={$row->id} and hide='0'";
			 $result_comment=mysql_query($query);
			 $num_of_comment=mysql_num_rows($result_comment);
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
                          <TABLE cellSpacing=1 cellPadding=1 width=20 
                              align=center bgColor=#e5e5e5 border=0>
                            <TBODY>
                              <TR>
                                <TD align=middle bgColor=#ffffff><a href="<?=$row->picture_link==""?"show_zhuanti.php?id=$row->id":$row->picture_link?>" target="_self"><IMG src="<?=$pic_url==""?"upload/smallimg/ob_smimg/080811/no_picture.jpg":$pic_url?>" alt="<?=$row->picture_title?>" width=<?=$width?> height=<?=$height?>  border="1" style="border:1px solid #000;"></a></TD>
                              </TR>
                            </TBODY>
                        </TABLE></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                  </TD>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" 
vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                    <TBODY>                     
                      <TR>
                        <TD height="21"><A class=tList href="show_zhuanti.php?id=<?=$row->id?>" target=_self><span style="font-size:12px; font-weight:bold">
                          <font color="<?=$row->title_color?>"><?=$row->article_title?></font></span></A>&nbsp;<A class=tList href="show_zhuanti.php?id=<?=$row->id?>" target=_self>[详细]</a></TD>
                        </TR>
                      <TR>
                        <TD background=image/line.gif 
                            height=3> 日期：<font color="#339966">20<?=$row->post_time?></font>&nbsp;&nbsp;点击：<font color="#CC3300"><?=$row->read_times?></font>&nbsp;&nbsp;<a href="comment_list.php?infor_class=zhuanti&id=<?=$row->id?>">评论</a>：<?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class=zhuanti&id=$row->id\">$num_of_comment</a>"; ?></TD>
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
                        <TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=msubstr(strip_tags($row->content),0,200)?>...</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
            </TBODY>
          </TABLE>
		  <?php } 
		    }
		  ?>		  </td>
        </tr>
      </table>
	  <?php 
	  if(!isset($_REQUEST['more'])) {
	  $query="select * from ".$table_suffix."zhuanti where hide_type='0' and class_id=$class_id  order by top desc, top_time desc limit 0, 10";
	  $result=mysql_query($query);
	  ?>
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
		    <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
		    <table width="100%"  border="0" cellpadding="2" cellspacing="0" bgcolor="#EAEAEA">
              <tr>
                <td>专题列表</td>
                <td width="100"><div align="center"><a href="zhuanti.php?class_id=<?=$_REQUEST['class_id']?>&more">更多专题</a></div></td>
              </tr>
            </table>
			<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
            <?php while($row=mysql_fetch_object($result)) { ?>
			<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD vAlign=top width=50%>
                  <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
                  width="100%" background=image/tbg.jpg border=0>
                    <TBODY>
                    <TR>
                      <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                      <TD class=fontg><a href="show_zhuanti.php?id=<?=$row->id?>"><?=$row->article_title?></a></TD>
                      <TD class=fontg align=middle 
                    width=50>&nbsp;</TD></TR></TBODY></TABLE>
                  <TABLE 
                  width="100%" height="100" border=0 cellPadding=0 cellSpacing=1 class=table>
                    <TBODY>
                    <TR>
                      <TD vAlign=top><?php if($row->archive_list=="")  echo "该专题没有内容"; else { ?>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                          <TBODY>
                            <?php 
							  $archive_list=explode(";",$row->archive_list);
						      for($j=0;$j<count($archive_list);$j++) {
						      $list_object=explode("-",$archive_list[$j]);	
							?>
							<TR>
                              <TD align=middle width=22><IMG height=9 
                              src="image/titledot.gif" width=9></TD>
                              <TD height=21><A class=tList 
                              href="zhuanti_node.php?id=<?=$row->id?>&node=<?=urlencode($list_object[0])?>" 
                              target=_self><?=$list_object[0]?></A>&nbsp;</TD>
                            </TR>
							<?php } ?>
                          </TBODY>
                        </TABLE>
                        <?php } ?>
                      </TD>
                    </TR></TBODY></TABLE></TD>
                <?php if($row=mysql_fetch_object($result))  {?>
				<TD width=5>&nbsp;</TD>
                <TD vAlign=top>
                  <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
                  width="100%" background=image/tbg.jpg border=0>
                    <TBODY>
                    <TR>
                      <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                      <TD class=fontg><a href="show_zhuanti.php?id=<?=$row->id?>"><?=$row->article_title?></a></TD>
                      <TD class=fontg align=middle 
                    width=50>&nbsp;</TD></TR></TBODY></TABLE>
                  <TABLE 
                  width="100%" height="100" border=0 cellPadding=0 cellSpacing=1 class=table>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>
                        <?php if($row->archive_list=="")  echo "该专题没有内容"; else { ?>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                          <TBODY>
                            <?php 
							  $archive_list=explode(";",$row->archive_list);
						      for($j=0;$j<count($archive_list);$j++) {
						      $list_object=explode("-",$archive_list[$j]);	
							?>
                            <TR>
                              <TD align=middle width=22><IMG height=9 
                              src="image/titledot.gif" width=9></TD>
                              <TD height=21><A class=tList 
                              href="zhuanti_node.php?id=<?=$row->id?>&node=<?=urlencode($list_object[0])?>" 
                              target=_self>
                                <?=$list_object[0]?>
                              </A>&nbsp;</TD>
                            </TR>
                            <?php } ?>
                          </TBODY>
                        </TABLE>
                        <?php } ?>
                      </TD>
                    </TR></TBODY></TABLE>
			  </TD>
			  <?php } ?>
              </TR></TBODY></TABLE>
            <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
            <?php } ?></TD>
        </TR></TBODY></TABLE>
	   <?php } ?>
      </TD></TR></TBODY></TABLE>
<?php   require_once("footer.php"); ?>
</body>
</html>