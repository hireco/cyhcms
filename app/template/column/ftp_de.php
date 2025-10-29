<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
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
  $infor_class="ftp";
  $class_id=$_REQUEST['class_id'];
  $query="select * from ".$table_suffix."infor where id=$class_id";
  $result=mysql_query($query);
  $class_name=mysql_result($result,0,"class_name");
?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD vAlign=top width=181 background=image/leftbg.gif height=186>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
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
                <td style="PADDING-LEFT: 10px; BORDER-BOTTOM: #d2d2d2 1px solid" ><div align="center">本栏目没有分类</div></td>
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
                  href="ftp.php?class_id=<?=$row->id?>" 
                  target=_self><?=$row->class_name?></A>&nbsp; </TD></TR>
			  <?php } ?>
              </TBODY></TABLE></TD></TR></TBODY></TABLE>
	  <TABLE width="100%" height=8 
      border=0 cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
        <TBODY>
          <TR>
            <TD align=middle></TD>
          </TR>
        </TBODY>
	    </TABLE>
	  <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
          <TR>
            <TD>
              <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                <TBODY>
                  <TR>
                    <TD width=8></TD>
                    <TD>热门资料</TD>
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
			  $query="select * from ".$table_suffix."ftp  order by read_times desc,top desc, top_time desc limit 0,6";
			  $result=mysql_query($query);
			 ?>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <?php while($row=mysql_fetch_object($result)) { ?>
                  <TR>
                    <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                    <TD height=21><A class=tList 
                  href="show_ftp.php?id=<?=$row->id?>" 
                  target=_self><font color="<?=$row->title_color?>">
                      <?=msubstr($row->article_title,0,24)?>
                    </font></A></TD>
                  </TR>
                  <TR>
                    <?php } ?>
                    <TD background=image/line.gif colSpan=2 height=3></TD>
                  </TR>
                  <TR>
                    <TD background=image/line.gif colSpan=2 
              height=3></TD>
                  </TR>
                </TBODY>
              </TABLE>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <TR align=right>
                    <TD><A class=more 
                  href="djyd/class/?45.html"></A></TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=5 background=image/hline.gif></TD>
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
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
            <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR vAlign=top>
                  <TD>
              <?php 
			  $query="select * from ".$table_suffix."ftp where class_id=$class_id order by top desc, top_time desc limit 0, 8";
              $result=mysql_query($query);
			  $num_of_ftp=@mysql_num_rows($result);
			  if($num_of_ftp) 
			   {			 
			 ?>
                    <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
                      <TBODY>
                        <TR>
                          <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                          <TD class=fontg>
                            <P>
                              <?=$class_name?>
                          </P></TD>
                          <TD class=fontg align=middle 
            width=50>&nbsp;</TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <TABLE height=120 cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
                      <TBODY>
                        <TR>
                          <TD vAlign=top>
                            <TABLE cellSpacing=0 cellPadding=3 width="100%">
                              <TBODY>
                               <TR class=downquerytitle height=25>
                               <TD>文件名称</TD>
                               <TD>文件大小</TD>
                               <TD>更新时间</TD>
                               <TD>点击次数</TD>
                               </TR>
                                <?php while($row=mysql_fetch_object($result)) { ?>
                                <TR>
                                  <TD align=middle><div align="left"><IMG 
                        src="image/items.gif" width=16 height=14 align="absmiddle"><A class=tList 
                        href="show_ftp.php?id=<?=$row->id?>"><?=$row->article_title?></A></div></TD>
                                  <TD height=19><?php 
								  $filesize=filesize(ereg_replace($cfg_mainsite,"",$row->filename))/1024.0;
								  if(empty($filesize)) echo "不详";
								  else { 
								  $filesize=explode(".",$filesize);
								  if($filesize[1]=="") $filesize[1]="0";
								  $filesize=$filesize[0].".".substr($filesize[1],0,1);
								  echo $filesize."k";
								  }
								  ?></TD>
                                <TD><FONT 
                        class=fonts>
                                  <?=substr($row->post_time,3,8)?>
                                </FONT></TD>
								<TD><?=$row->read_times?></TD>
								</TR>
                                <TR>
                                  <?php } ?>
                                  <TD background=image/line.gif colSpan=2 
                      height=3></TD>
                                </TR>
                              </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                              <TBODY>
                                <TR align=right>
                                  <TD><A class=more 
                        href="news/class/?1.html"></A></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <?php 
			   } 
			 
			 $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
             $result=mysql_query($query);
		     $num_of_sub_class=@mysql_num_rows($result);
			 if($num_of_sub_class) { 
			 while($row=mysql_fetch_object($result)) { 
			 $ftp_class_id=$row->id;
			?>
                    <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
                      <TBODY>
                        <TR>
                          <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                          <TD class=fontg>
                            <P>
                              <?=$row->class_name?>
                          </P></TD>
                          <TD class=fontg align=middle 
            width=50>&nbsp;</TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <TABLE height=120 cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
                      <TBODY>
                        <TR>
                          <TD vAlign=top>
                     <?php 
				     $query="select * from ".$table_suffix."ftp where class_id=$ftp_class_id order by top desc, top_time desc limit 0, 8";
                     $result_sub=mysql_query($query);
				     if(!@mysql_num_rows($result_sub)) {
			         ?>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td><div align="left">本栏目尚未发布文章</div></td>
                              </tr>
                            </table>
                            <?php } else { ?>
                            <TABLE cellSpacing=0 cellPadding=3 width="100%">
                              <TBODY>
                               <TR class=downquerytitle height=25>
                               <TD>文件名称</TD>
                               <TD>文件大小</TD>
                               <TD>更新时间</TD>
                               <TD>下载次数</TD></TR>
                                <?php while($row_sub=mysql_fetch_object($result_sub)) { ?>
                                <TR>
                                  <TD align=middle><div align="left"><IMG 
                        src="image/items.gif" width=16 height=14 align="absmiddle"><A class=tList 
                        href="show_ftp.php?id=<?=$row->id?>" 
                        target=_self>
                                      <?=$row_sub->article_title?>
                                  </A></div></TD>
                                  <TD height=19><A class=tList 
                        href="show_ftp.php?id=<?=$row->id?>" 
                        target=_self>
                                    </A><FONT 
                        class=fonts>&nbsp;                                    </FONT></TD>
								<TD><FONT 
                        class=fonts>
								  <?=$row_sub->post_time?>
								</FONT></TD>
								<TD></TD>
                                </TR>
                                <TR>
                                  <?php } ?>
                                  <TD background=image/line.gif colSpan=2 
                      height=3></TD>
                                </TR>
                              </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                              <TBODY>
                                <TR align=right>
                                  <TD><A class=more 
                        href="news/class/?1.html"></A></TD>
                                </TR>
                              </TBODY>
                          </TABLE>
						  <?php } ?>
						  </TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <?php } 
			     }
				 if((!$num_of_ftp)&&(!$num_of_sub_class)) echo "本栏目没有发布对象";
			   ?>
                  </TD>
                </TR>
              </TBODY>
            </TABLE></TD></TR></TBODY></TABLE>
      </TD>
  </TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
