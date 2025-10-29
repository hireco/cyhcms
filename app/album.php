<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
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
<?php  require_once("header.php"); ?>
<?php 
  
  $infor_class="album";
  $class_id=$_REQUEST['class_id'];
  $query="select * from ".$table_suffix."infor where id=$class_id";
  $result=mysql_query($query);
  $class_name=mysql_result($result,0,"class_name");
?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD vAlign=top width=181 background=image/leftbg.gif height=186><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
      <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
                <TR>
                  <TD width=8></TD>
                  <TD>分类导航</TD>
                </TR>
              </TBODY>
          </TABLE></TD>
        </TR>
      </TBODY>
    </TABLE>
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
                  href="album.php?class_id=<?=$row->id?>" 
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
            <TD></TD>
          </TR>
        </TBODY>
      </TABLE>      <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
                    <TD>点击排行</TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=90 cellSpacing=1 cellPadding=5 width="100%" 
              border=0><TBODY>
              <TR>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                  <?php 
				   $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['点击排行']." limit 0,15";
			       $result=mysql_query($query);
				  ?>
				  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <?php  while($row=mysql_fetch_object($result)) { 
					  $query="select chinese_name from ".$table_suffix."infor_class  where class_name='{$row->infor_class}'";
					  $chinese_name=mysql_result(mysql_query($query),0,"chinese_name");
					?>
					<TR>
                      <TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; BACKGROUND: url(image/dig-compact.gif) no-repeat left center; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; BORDER-BOTTOM: #ccc 1px dotted; POSITION: relative; HEIGHT: 40px;">
					  <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td width="36"><div align="center" style="FONT-SIZE: 14px; LEFT: -1px; WIDTH: 36px; FONT-FAMILY: arial; cursor:pointer"><?=$row->read_times?></div></td>
                          <td style="line-height:120%;"><A style="text-decoration:underline;" href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>"  target=_self><?php echo substr($chinese_name,0,4)."："; echo $row->article_title;?></A>&nbsp;</td>
                        </tr>
                      </table>
					 </TD>
                      </TR><?php } ?>
                    <TR>					
                      <TD background=image/line.gif 
                      height=3></TD></TR>
                    <TR>
                      <TD background=image/line.gif 
                      height=3></TD></TR></TBODY></TABLE>
                </TD>
              </TR></TBODY></TABLE>      </TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?></TD></TR></TBODY></TABLE>
      <TABLE height=34 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/sbg.gif border=0>
        <TR>
          <TD>
            <?php require_once("inc/search_form.php"); ?></TD></TR></TABLE>
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
		    <?php 
			  $query="select * from ".$table_suffix."album where class_id=$class_id order by top desc, top_time desc";
              $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
		      $per_page_num=16;
			  $rows=@mysql_query($query);
		      $num=@mysql_num_rows($rows);
		      $page=intval(($num-1)/$per_page_num)+1;
		      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
		      $page_front=($page_id<=1)?1:($page_id-1); 
		      $page_behind=($page_id>=$page)?$page:($page_id+1); 
		      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
			  if($num) 
			   {			 
			 ?>
		    <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
              <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P><?=$class_name?></P></TD>
                <TD class=fontg align=middle  width=50><?php if(!isset($_REQUEST['more'])) { ?><A  href="album.php?more&class_id=<?=$class_id?>"><IMG height=15  src="image/more.gif" width=53  border=0></A><?php } ?></TD>
              </TR></TBODY></TABLE>
            <TABLE width="100%" height=120 
              border=0 cellPadding=0 cellSpacing=1 bgcolor="#DDDDDD">
              <TBODY>
              <TR>
                <TD vAlign=top bgcolor="#FFFFFF">
                  <TABLE cellSpacing=0 cellPadding=5 width="100%" border=0>
                    <TBODY>
                    <?php 
					  for($i=1;$i<=$per_page_num;$i++)
				      { if($row=@mysql_fetch_object($rows)){  
					  $pic_id=$row->pic_id; 
                      $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                      $pic_row=mysql_fetch_object($pic_result);
					  if($i%4==1) echo "<TR>";
					 ?>
					  <TD class=cpquery align=middle>
                          <?php 
						    $width=120;
					        $height=120*$cfg_artsimg_height/$cfg_artsimg_width;
						  ?>
						  <TABLE class=table cellSpacing=0 cellPadding=5 width=100 
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
							  if($pic_url<>"") {?><A 
                              href="show_album.php?id=<?=$row->id?>" 
                              target=_self><IMG height=<?=$height?> alt="<?=$row->article_title?>"
                              src="<?=$pic_url?>" width=<?=$width?> 
                              border=0></A><?php }  else { ?>
							  <table width=<?=$width?> height=<?=$height?> border=0 cellpadding=0 cellspacing=0><tr>
                                <td><div align=center><A 
                              href="show_album.php?id=<?=$row->id?>" 
                              target=_self>此文暂<br>无题图</A></div></td></tr>
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
                              target=_self><?=msubstr($row->article_title,0,18)?></A></SPAN></TD>
                              </TR>
                            </TBODY>
                        </TABLE>
                          </TD>
					  <?php 
					    if($i%4==0) echo "</TR>";
					     } 
					    }
					  ?>
                    
                  </TABLE>
                  
                  <?php if(isset($_REQUEST['more'])) { ?>
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <?php  require_once("inc/page_divide.php");?></td>
                      </tr>
                  </table>
				  <?php } ?>				  </TD>
              </TR></TABLE>
			 <?php 
			   } 
			 if(!isset($_REQUEST['more'])) {
			 $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
             $result=mysql_query($query);
		     $num_of_sub_class=@mysql_num_rows($result);
			 if($num_of_sub_class) { 
			 while($row=mysql_fetch_object($result)) { 
			 $album_class_id=$row->id;
			?>
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
                  <P><?=$row->class_name?></P></TD>
                <TD class=fontg align=middle 
            width=50><A  href="album.php?more&class_id=<?=$album_class_id?>"><IMG height=15  src="image/more.gif" width=53  border=0></A></TD>
              </TR></TBODY></TABLE>
            <TABLE width="100%" height=120 
              border=0 cellPadding=3 cellSpacing=1 bgcolor="#DDDDDD">
              <TBODY>
              <TR>
                <TD vAlign=top bgcolor="#FFFFFF">
                  <?php 
				     $query="select * from ".$table_suffix."album where class_id=$album_class_id and hide_type='0'  order by top desc, top_time desc limit 0, 8";
                     $result_sub=mysql_query($query);
				     if(!@mysql_num_rows($result_sub)) {
			      ?>
                  <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                   <td><div align="left">本栏目尚未发布文章</div></td>
                    </tr>
                  </table>			
			     <?php } ?>
				  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <?php while($row_sub=mysql_fetch_object($result_sub)) { ?>
					<TR>
                      <TD align=middle width=28><IMG height=14 
                        src="image/items.gif" width=16></TD>
                      <TD height=19><A class=tList 
                        href="show_album.php?id=<?=$row_sub->id?>" 
                        target=_self><?=$row_sub->article_title?></A>&nbsp;<FONT 
                        class=fonts>[<?=$row_sub->post_time?>]</FONT></TD></TR>
                    <TR>
					<?php } ?>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR></TBODY></TABLE>                    </TD>
              </TR></TBODY></TABLE>
			 <?php } 
			     }
				 if((!$num)&&(!$num_of_sub_class)) echo "本栏目没有发布对象";
			 }
			   ?>
          </TD>
        </TR></TABLE></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
