<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once("config/auto_set.php");?>
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
                  target=_self><?=$row->class_name?></A>&nbsp; </TD></TR>
			  <?php } ?>
              </TBODY></TABLE></TD></TR></TBODY></TABLE>
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
				    $width=120;
					$height=120*$cfg_artsimg_height/$cfg_artsimg_width;
				    $query="select * from ".$table_suffix."article where class_id in ('$id_list') and pic_id<>0 order by recommend desc, top desc, top_time desc limit 0, 4";
				    $result=mysql_query($query);
					while($row=mysql_fetch_object($result)) { 
					$pic_id=$row->pic_id; 
                    $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                    $pic_row=mysql_fetch_object($pic_result); 
					$pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
				  ?>
				  <TABLE cellSpacing=0 cellPadding=0 bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top width=138>
                        <TABLE class=table cellSpacing=0 cellPadding=3 width=138 
                        border=0>
                          <TBODY>
                          <TR>
                            <TD bgColor=#f0f0f0 height=99>
                              <TABLE cellSpacing=1 cellPadding=1 width=122 
                              align=center bgColor=#e5e5e5 border=0>
                                <TBODY>
                                <TR>
                                <TD align=middle width=122 bgColor=#ffffff 
                                height=85><A 
                                href="show_article.php?id=<?=$row->id?>" 
                                target=_self><IMG  src="<?=$pic_url?>" height=<?=$height?> alt="<?=$row->article_title?>"  width=<?=$width?> 
                                border=0></A></TD>
                                </TR></TBODY></TABLE></TD></TR>
                          <TR>
                            <TD align=middle bgColor=#f0f0f0 height=22><SPAN 
                              class=pictitle><A class=pictitle 
                              href="show_article.php?id=<?=$row->id?>" 
                              target=_self><?=msubstr($row->article_title,0,20)?></A></SPAN></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
							<?php } ?>
					  </TD></TR>
              </TBODY></TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR align=right>
              <TD><A class=more 
                  href="xyfm/class/?1.html"></A></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
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
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
		    <?php 
			  $query="select * from ".$table_suffix."article where class_id=$class_id  and hide_type='0' order by top desc, top_time desc limit 0, 8";
              $result=mysql_query($query);
			  $num_of_article=@mysql_num_rows($result);
			  if($num_of_article) 
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
                <TD class=fontg align=middle 
            width=50>&nbsp;</TD></TR></TBODY></TABLE>
            <TABLE height=120 cellSpacing=1 cellPadding=0 width="100%" 
              border=0><TBODY>
              <TR>
                <TD vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <?php while($row=mysql_fetch_object($result)) { ?>
					<TR>
                      <TD align=middle width=28><IMG height=14 
                        src="image/items.gif" width=16></TD>
                      <TD height=19><A class=tList 
                        href="show_article.php?id=<?=$row->id?>" 
                        target=_self><?=$row->article_title?></A>&nbsp;<FONT 
                        class=fonts>[<?=$row->post_time?>]</FONT></TD></TR>
                    <TR>
					<?php } ?>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <TR align=right>
                      <TD><A class=more 
                        href="news/class/?1.html"></A></TD></TR></TBODY></TABLE></TD>
              </TR></TBODY></TABLE>
			 <?php 
			   } 
			 
			 $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
             $result=mysql_query($query);
		     $num_of_sub_class=@mysql_num_rows($result);
			 if($num_of_sub_class) { 
			 while($row=mysql_fetch_object($result)) { 
			 $article_class_id=$row->id;
			?>
            <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
              <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P><?=$row->class_name?></P></TD>
                <TD class=fontg align=middle 
            width=50>&nbsp;</TD></TR></TBODY></TABLE>
            <TABLE height=120 cellSpacing=1 cellPadding=0 width="100%" 
              border=0><TBODY>
              <TR>
                <TD vAlign=top>
                  <?php 
				     $query="select * from ".$table_suffix."article where class_id=$article_class_id order by top desc, top_time desc limit 0, 8";
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
                        href="show_article.php?id=<?=$row_sub->id?>" 
                        target=_self><?=$row_sub->article_title?></A>&nbsp;<FONT 
                        class=fonts>[<?=$row_sub->post_time?>]</FONT></TD></TR>
                    <TR>
					<?php } ?>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
                    <TR align=right>
                      <TD><A class=more 
                        href="news/class/?1.html"></A></TD></TR></TBODY></TABLE></TD>
              </TR></TBODY></TABLE>
			 <?php } 
			     }
				 if((!$num_of_article)&&(!$num_of_sub_class)) echo "本栏目没有发布对象";
			   ?>
			 
          </TD>
        </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
