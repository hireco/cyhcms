<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/single_obj_class.php");?>
<?php require_once("inc/get_sub_class.php");?>
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
  $class_id=$_REQUEST['class_id'];
  $infor_class="article";
  $query="select * from ".$table_suffix."infor where id=$class_id";
  $result=mysql_query($query);
  $class_name=mysql_result($result,0,"class_name");
?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
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
                <TD>���ർ��</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
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
                <td><div align="center">����Ŀû�з���</div></td>
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
                  target=_self><?=$row->class_name?></A>&nbsp; </TD></TR>
			  <?php } ?>
              </TBODY></TABLE></TD></TR></TBODY></TABLE>
	  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
        <TD></TD></TR></TBODY></TABLE>
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
                    <TD>�����Ƽ�</TD>
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
			  $query="select * from ".$table_suffix."article  order by recommend desc,top desc, top_time desc limit 0,6";
			  $result=mysql_query($query);
			 ?>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <?php while($row=mysql_fetch_object($result)) { ?>
                  <TR>
                    <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                    <TD height=21><A class=tList 
                  href="show_article.php?id=<?=$row->id?>" 
                  target=_self><font color="<?=$row->title_color?>">
                      <?=msubstr($row->article_title,0,24)?>
                    </font></A></TD>
                  </TR><?php } ?>
                </TBODY>
              </TABLE>
              </TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=120 cellSpacing=0 cellPadding=0 width=179 align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=piclist align=middle>
                  <?php 
				    $width=80;
					$height=80*$cfg_artsimg_height/$cfg_artsimg_width;
				    $query="select * from ".$table_suffix."article where class_id in ('$id_list') and pic_id<>0 order by recommend desc, top desc, top_time desc limit 0, 4";
				    $result=mysql_query($query);
					while($row=mysql_fetch_object($result)) { 
					$pic_id=$row->pic_id; 
                    $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                    $pic_row=mysql_fetch_object($pic_result); 
					$pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
				  ?>
				  <TABLE width="100%" border=0 cellPadding=0 cellSpacing=0 bgColor=#ffffff>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>
                        <TABLE width=100% 
                        border=0 align="center" cellPadding=3 cellSpacing=0>
                          <TBODY>
						  <TR>
                            <TD background=image/line.gif colSpan=3 height=3></TD>
                          </TR>
                          <TR>
                            <TD>
                              <TABLE cellSpacing=1 cellPadding=1 
                              align=center bgColor=#e5e5e5 border=0>
                                <TBODY>
                                <TR>
                                <TD align=middle bgColor=#ffffff><A 
                                href="show_article.php?id=<?=$row->id?>" 
                                target=_self><IMG  src="<?=$pic_url?>" height=<?=$height?> alt="<?=$row->article_title?>"  width=<?=$width?> 
                                border="1" style="border:1px solid #000;"></A></TD>
                                </TR></TBODY></TABLE></TD>
                          </TR>
                          <TR>
                            <TD align=middle height=22><SPAN 
                              class=pictitle><A class=pictitle 
                              href="show_article.php?id=<?=$row->id?>" 
                              target=_self><?=msubstr($row->article_title,0,20)?></A></SPAN></TD>
                          </TR></TBODY></TABLE></TD>
                    </TR></TBODY></TABLE>
							<?php } ?>
					  </TD></TR>
              </TBODY></TABLE>
             </TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD vAlign=top>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>�����ڵ�λ��:
            <?php  echo "<a href=\"./\">�� ҳ</a> "; require_once("inc/get_position.php"); ?> 
      </TD>
        </TR></TBODY></TABLE>
      <TABLE height=34 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/sbg.gif border=0>
        <TR>
          <TD>
            <?php require_once("inc/search_form.php"); ?></TD></TR></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
		    <?php 
			  if(isset($_REQUEST['more'])) $query="select * from ".$table_suffix."article where class_id=$class_id  and hide_type='0' order by post_time desc, top desc, top_time desc";
              else $query="select * from ".$table_suffix."article where class_id=$class_id  and hide_type='0' order by post_time desc,top desc, top_time desc limit 0, 20";
			  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
		      $per_page_num=20;
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
                <TD 
            width=50 align=middle valign="middle" class=fontg>
			<?php if(!isset($_REQUEST['more'])) { ?><A  href="article.php?more&class_id=<?=$_REQUEST['class_id']?>"><IMG height=15  src="image/more.gif" width=53  border=0></A>
			<?php } ?>
			</TD>
              </TR></TBODY></TABLE>
            <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#DDDDDD">
              <tr>
                <td bgcolor="#FFFFFF"><TABLE cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
                  <TBODY>
                    <TR>
                      <TD vAlign=top>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                          <TBODY>
                            <?php for($i=1;$i<=$per_page_num;$i++)
				      { if($row=@mysql_fetch_object($rows)){ ?>
                            <TR>
                              <TD align=middle width=28><IMG height=14 
                        src="image/items.gif" width=16></TD>
                              <TD height=19><A class=tList 
                        href="show_article.php?id=<?=$row->id?>" 
                        target=_self>
                                <?=$row->article_title?>
                                </A>&nbsp;<FONT 
                        class=fonts>[<?=$row->post_time?>]</FONT></TD>
                            </TR>
							<TR><TD background=image/line.gif colSpan=2 
                            height=3></TD>
                            </TR>
                            <?php } 
					  }
					?>
                          </TBODY>
                      </TABLE></TD>
                    </TR>
                    <TR>
                      <TD vAlign=top><?php if(isset($_REQUEST['more'])) require_once("inc/page_divide.php");  ?></TD>
                    </TR>
                  </TBODY>
                </TABLE></td>
              </tr>
            </table>
            <?php } 
			 else  if(isset($_REQUEST['more'])) get_sub_class($class_id);
		   if(!isset($_REQUEST['more'])) {
			 $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
             $result=mysql_query($query);
		     $num_of_sub_class=@mysql_num_rows($result);
			 if($num_of_sub_class) { 
			 while($row=mysql_fetch_object($result)) { 
			 $article_class_id=$row->id;
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
                <TD class=fontg align=middle width=50>
				<A  href="article.php?more&class_id=<?=$article_class_id?>"><IMG height=15  src="image/more.gif" width=53  border=0></A></TD>
              </TR></TBODY></TABLE>
            <TABLE width="100%" height=120 
              border=0 cellPadding=3 cellSpacing=1 bgcolor="#DDDDDD">
              <TBODY>
              <TR>
                <TD vAlign=top bgcolor="#FFFFFF">
                  <?php 
				     $query="select * from ".$table_suffix."article where class_id=$article_class_id order by post_time desc, top desc, top_time desc limit 0, 8";
                     $result_sub=mysql_query($query);
				     if(!@mysql_num_rows($result_sub)) { 
					   if(!get_sub_class($article_class_id)) {   
			         ?> <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td><div align="left">����Ŀ��δ��������</div></td>
                              </tr>
                            </table>
                            <?php }
					  } ?>
				  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <?php while($row_sub=mysql_fetch_object($result_sub)) { ?>
					<TR>
                      <TD align=middle width=28><IMG height=14 
                        src="image/items.gif" width=16></TD>
                      <TD height=19><A class=tList 
                        href="show_article.php?id=<?=$row_sub->id?>" 
                        target=_self><?=$row_sub->article_title?></A>&nbsp;<FONT 
                        class=fonts>[<?=$row_sub->post_time?>]</FONT></TD></TR>
						<TR>
                          <TD background=image/line.gif colSpan=2 height=3></TD>
                        </TR>
					<?php } ?>
                    </TBODY></TABLE>                  </TD>
              </TR></TBODY></TABLE>
			 <?php } 
			     }
				 if((!$num)&&(!$num_of_sub_class)) echo "����Ŀû�з�������";
			  }
			   ?>			 
          </TD>
        </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>