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
<?php  require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
        $query="select * from ".$table_suffix."infor where left_navi='1' and  hide_type='0' order by top desc,top_time desc limit 0,9";  
        $result=mysql_query($query);
?>
<TABLE height=300 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center bgColor=#ffffff border=0>
  <TR>
    <TD vAlign=top align=middle width=181 background=image/leftbg.gif>
      <TABLE width=181 height=90 border=0 align=center cellPadding=0 cellSpacing=0 
      bgColor=#ffffff>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE height=27 cellSpacing=0 cellPadding=0 align=center 
              border=0><TBODY>
              <?php while($row=mysql_fetch_object($result)) { ?>
		      <TR>
                <TD class=smenuv noWrap align=middle width=179 
                background=image/smenuv2.jpg height=30>
                  <DIV style="PADDING-LEFT: 20px"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self><?=$row->class_name?></A></DIV></TD></TR>
              <?php } ?>
      </TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=5 cellSpacing=0 cellPadding=0 width=181 bgColor=#ffffff 
      border=0>
        <TBODY>
        <TR>
          <TD width=181 bgColor=#ffffff></TD></TR></TBODY></TABLE>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD width=20>&nbsp;</TD>
          <?php if(isset($_SESSION['user_name'])) {?>
		  <TD>统计资料 </TD>
		  <TD><a href="member.php">会员中心</a></TD>
         <?php } else {?>
		  <TD>用户登录 </TD>
		 <?php } ?>
		</TR></TBODY></TABLE>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=90 cellSpacing=8 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <?php  require_once("inc/loginform.php") ?>
          </TD></TR></TBODY></TABLE>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=8 cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff 
      border=0>
        <TBODY>
        <TR>
      <TD align=middle></TD></TR></TBODY></TABLE>
	  <TABLE height=80 cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff 
      border=0>
        <TBODY>
        <TR>
      <TD align=middle><?php require_once("inc/calendar.php");?></TD></TR></TBODY></TABLE>
      <TABLE height=8 cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff 
      border=0>
        <TBODY>
        <TR>
      <TD align=middle></TD></TR></TBODY></TABLE>
	  <?php require_once("inc/kanwu.php"); ?>
<TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD width=20>&nbsp;</TD>
          <TD><SPAN class=fontg>
            <P>本站推荐</P>
          </SPAN></TD>
          <TD valign="middle"><div align="right"><span class="fontg"><A 
                  href="class_list.php?list_for=<?=urlencode("热门推荐")?>"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></A></span></div></TD>
        </TR></TBODY></TABLE>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=90 cellSpacing=5 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <?php
			  $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['热门推荐']." limit 0,6";
			  $result=mysql_query($query);
			 ?>
			<TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
              <TBODY>
              <?php while($row=mysql_fetch_object($result)) { ?>
			  <TR>
                <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                <TD height=21><A class=tList 
                  href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" 
                  target=_self><font color="<?=$row->title_color?>"><?=msubstr($row->article_title,0,24)?></font></A></TD></TR>
              <TR>
			  <?php } ?>
                <TD background=image/line.gif colSpan=2 height=3></TD></TR>
              <TR>
                <TD background=image/line.gif colSpan=2 
              height=3></TD></TR></TBODY></TABLE>
            </TD></TR></TBODY></TABLE>
			<?php require_once("inc/link.php");?>
    </TD>
    <TD vAlign=top width=6>&nbsp;</TD>
    <TD vAlign=top>
      <TABLE height=34 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/sbg.gif border=0>
        <TR>
          <TD>
            <?php require_once("inc/search_form.php"); ?></TD></TR></TABLE>
      <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=160 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD width="220" height=130 
          vAlign=top 
          style="BORDER-RIGHT: #ffffff 1px solid; BORDER-TOP: #ffffff 1px solid; BORDER-LEFT: #ffffff 1px solid; BORDER-BOTTOM: #ffffff 1px solid"><?php require_once("inc/flash/flash2.php");?></TD>
          <TD vAlign=top width=5></TD>
          <TD  style="BORDER-RIGHT: #d2d2d2 1px solid; BORDER-TOP: #d2d2d2 1px solid; BORDER-LEFT: #d2d2d2 1px solid; BORDER-BOTTOM: #d2d2d2 1px solid" vAlign=top>
		  <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
            background=image/tbg.jpg border=0>
              <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P>最新动态</P></TD>
              <TD class=fontg align=middle width=50><A 
                  href="class_list.php?list_for=<?=urlencode("最新文章")?>"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></A></TD></TR></TBODY></TABLE>
            <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
            <TABLE height=130 cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
              <TBODY>
              <TR>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                  <?php 
				   $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['最新文章']." limit 0, 6";
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
                        target=_self><font color="<?=$row->title_color?>" style="font-weight:<?=$row->title_bold=="1"?"bold":"normal"?>"><?=msubstr($row->article_title,0,40)?></font></A><FONT 
                        class=fonts>[<?=substr($row->post_time,3,5)?>]</FONT></TD>
                    </TR>
					<?php } ?>
                    <TR>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR>
                    <TR>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR>
                    <TR>
                      <TD background=image/line.gif colSpan=2 
                      height=3></TD></TR></TBODY></TABLE>
                  </TD>
              </TR></TBODY></TABLE>          </TD></TR></TBODY></TABLE>
      <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=160 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top height=150>
            <!----滚动信息----->
             <?php  require_once("inc/scrollnews.php"); ?>
			<!----滚动信息----->
			<?php  
			 $width=105;
			 $height=105*$cfg_colsimg_height/$cfg_colsimg_width;
			 $list_block=0;
			 $query="select * from ".$table_suffix."infor where infor_class='article' and index_block='1' and hide_type='0' order by top desc,top_time desc limit 1, 3";
			 $result=mysql_query($query);
			 while($row=mysql_fetch_object($result)) { 
			 $query="select * from ".$table_suffix."article where class_id='{$row->id}' and hide_type='0' order by top desc, top_time desc limit 0, 5";
			 $result_list=mysql_query($query);
			 $list_block++; 
			?>
			<table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#DBDBDB">
              <tr>
                <td bgcolor="#FFFFFF"><TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
                  <TBODY>
                    <TR>
                      <TD 
                style="PADDING-RIGHT: 1px; PADDING-LEFT: 1px; PADDING-BOTTOM: 1px; PADDING-TOP: 1px" 
                vAlign=top width=110>
                        <TABLE cellSpacing=0 cellPadding=0 width=100 border=0>
                          <TBODY>
                            <TR>
                              <TD><a href="<?=$row->picture_link==""?"article.php?class_id={$row->id}":$row->picture_link?>" target="_self"><IMG src="<?=$row->picture?>" alt="<?=$row->picture_title?>"  width=<?=$width?> height=<?=$height?> border="0"></a></TD>
                            </TR>
                            <TR>
                              <TD align=middle height=20><SPAN class=fontg><A 
                        href="article.php?class_id=<?=$row->id?>">
                                <P>
                                  <?=$row->class_name?>
                                </P>
                              </A></SPAN></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                      <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                          <TBODY>
                            <?php 
					 while($row_list=mysql_fetch_object($result_list)) {
					?>
                            <TR>
                              <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                              <TD height=21><A class=tList href="show_article.php?id=<?=$row_list->id?>" target=_self><font color="<?=$row_list->title_color?>">
                                <?=$row_list->article_title?>
                              </font></A>&nbsp;</TD>
                            </TR>
                            <?php } ?>
                            <TR>
                              <TD background=image/line.gif colSpan=2 
                      height=3></TD>
                            </TR>
                            <TR>
                              <TD background=image/line.gif colSpan=2 
                      height=3></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                    </TR>
                  </TBODY>
                </TABLE></td>
              </tr>
            </table>
			<TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" 
              border=0>
              <TBODY>
                <TR>
                  <TD></TD>
                </TR>
              </TBODY>
			  </TABLE>
			<?php } ?>
<TABLE class=table cellSpacing=0 cellPadding=0 width="100%" 
border=0>
              <TBODY>
              <TR>
                <TD>
                  <?php 
				   $query="select * from ".$table_suffix."infor where infor_class='ftp' and index_block='1' and hide_type='0' order by top desc,top_time desc limit 0, 1";
			       $result=mysql_query($query);
			       while($row=mysql_fetch_object($result)) { 
			       $query="select * from ".$table_suffix."ftp where class_id='{$row->id}' and hide_type='0' order by top desc, top_time desc limit 0, 5";
			       $result_list=mysql_query($query);
			       $list_block++;				  
				  ?>
				  <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
                  background=image/tbg.jpg border=0>
                    <TBODY>
                    <TR>
                      <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                      <TD class=fontg>资料共享-<a href="ftp.php?class_id=<?=$row->id?>"><?=$row->class_name?>
                      </a></TD>
                      <TD class=fontg align=middle width=50><A 
                        href="ftp.php?class_id=<?=$row->id?>"><IMG 
                        height=15 src="image/more.gif" width=53 
                        border=0></A></TD></TR></TBODY></TABLE>
                  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
                  bgColor=#d2d2d2 border=0>
                    <TBODY>
                    <TR>
                      <TD></TD></TR></TBODY></TABLE>
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
                                <TD align=middle bgColor=#ffffff><a href="<?=$row->picture_link==""?"ftp.php?class_id={$row->id}":$row->picture_link?>" target="_self"><IMG src="<?=$row->picture?>" alt="<?=$row->picture_title?>" width=<?=$width?> height=<?=$height?>  border="0"></a></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                          <TBODY>
                          <TR align=right>
                            <TD><A class=more 
                              href="student/class/?22.html"></A></TD></TR></TBODY></TABLE></TD>
                      <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" 
vAlign=top>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0><TBODY>
                           <?php  while($row_list=mysql_fetch_object($result_list)) { ?>
					      <TR>
                          <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                          <TD height=21><A class=tList href="show_ftp.php?id=<?=$row_list->id?>" target=_self><font color="<?=$row_list->title_color?>"><?=msubstr($row_list->article_title,0,60)?></font></A>&nbsp;</TD></TR>
					      <?php } ?>
                            <TR><TD background=image/line.gif colSpan=2 
                            height=3></TD></TR>
                          <TR>
                            <TD background=image/line.gif colSpan=2 
                            height=3></TD></TR></TBODY></TABLE>
                        </TD>
                    </TR></TBODY></TABLE>
		<?php } ?>  
		  </TD></TR></TBODY></TABLE>            
            <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE class=table cellSpacing=0 cellPadding=0 width="100%" 
border=0>
              <TBODY>
                <TR>
                  <TD>
                   <?php 
				   $height=80;
			       $width=80*$cfg_artsimg_width/$cfg_artsimg_height;
				   $query="select * from ".$table_suffix."zhuanti order by recommend desc, top desc, top_time desc limit 0, 1";
			       $result=mysql_query($query);
			       if($row=mysql_fetch_object($result)) { 
			       $list_block++;				
				   $pic_id=$row->pic_id; 
                   $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                   $pic_row=mysql_fetch_object($pic_result);  
				  ?>
                    <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
                  background=image/tbg.jpg border=0>
                      <TBODY>
                        <TR>
                          <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                          <TD class=fontg>今日专题：<a href="show_zhuanti.php?id=<?=$row->id?>"><?=$row->article_title?></a></TD>
                          <TD class=fontg align=middle width=50><a href="zhuanti.php?class_id=<?=$row->class_id?>"><IMG 
                        height=15 src="image/more.gif" width=53 
                        border=0></a></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
                  bgColor=#d2d2d2 border=0>
                      <TBODY>
                        <TR>
                          <TD></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
                  border=0>
                      <TBODY>
                        <TR>
                          <TD style="PADDING-LEFT: 6px; PADDING-TOP: 10px" align=left vAlign=top><?=msubstr($row->content,0,100)?></TD>
                          <TD width="110" vAlign=top><table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td></td>
                            </tr>
                          </table>                            
                            <TABLE 
border=0 align="center" cellPadding=3 cellSpacing=1 bgcolor="#C0C0C0">
                            <TBODY>
                              <TR>
                                <TD align=middle bgcolor="#FFFFFF" class=piclist>
                                  <TABLE cellSpacing=1 cellPadding=1 width=20 
                              align=center bgColor=#e5e5e5 border=0>
                                    <TBODY>
                                      <TR>
                                        <TD align=middle bgColor=#ffffff><a href="<?=$row->picture_link==""?"show_zhuanti.php?id=$row->id":$row->picture_link?>" target="_self"><IMG src="<?=$pic_row->pic_url?>" width=<?=$width?> height=<?=$height?>  border="0"></a></TD>
                                      </TR>
                                    </TBODY>
                                </TABLE></TD>
                              </TR>
                            </TBODY>
                          </TABLE>
                          <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td></td>
                            </tr>
                          </table></TD>
                        </TR>
                        <TR>
                      <TD colspan="2" align=middle vAlign=top style="PADDING-LEFT: 1px; PADDING-TOP: 1px">
					  <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0><TBODY>
                           <?php  
						   $archive_list=explode(";",$row->archive_list);
						   for($j=0;$j<count($archive_list);$j++) {
						   $list_object=explode("-",$archive_list[$j]);						   
				           ?>
					      <TR>
                          <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                          <TD height=21><?=$list_object[0]?>：<A class=tList href="zhuanti_node.php?id=<?=$row->id?>" target=_self>
						  <?php 
						   $list_of_article=explode(",", $list_object[2]);
						   for($k=0;$k<=3;$k++) {
						   $first_infor=explode(":",$list_of_article[$k]);
						   $infor_class=$first_infor[0];
						   $infor_id=$first_infor[1];
						   $query="select * from ".$table_suffix."infor_index  where infor_id=$infor_id and infor_class='$infor_class'";
						   $result=mysql_query($query);
						   $row=mysql_fetch_object($result);
						   echo $row->article_title; echo " "; } ?>...</A>&nbsp;</TD>
					      </TR>
					      <?php } ?>
                            <TR><TD background=image/line.gif colSpan=2 
                            height=3></TD></TR>
                          <TR>
                            <TD background=image/line.gif colSpan=2 
                            height=3></TD></TR></TBODY></TABLE>
                        </TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <?php } ?>
                  </TD>
                </TR>
              </TBODY>
            </TABLE></TD>
          <TD vAlign=top width=5></TD>
          <TD style="BORDER-RIGHT: #d2d2d2 1px solid; BORDER-TOP: #d2d2d2 1px solid; BORDER-LEFT: #d2d2d2 1px solid; BORDER-BOTTOM: #d2d2d2 1px solid" 
          vAlign=top width=220>
		  <?php 
	      $width=60;
		  $height=60*$cfg_artsimg_height/$cfg_artsimg_width;
		  $query="select * from ".$table_suffix."infor where infor_class='article' and index_block='1' and hide_type='0' order by top desc,top_time desc limit 0, 1";
		  $result=mysql_query($query);  
		  if($row=mysql_fetch_object($result)) { 
		  $query="select * from ".$table_suffix."article where class_id='{$row->id}' and hide_type='0' and pic_id!=0 order by top desc, top_time desc limit 0, 2";
		  $result_list=mysql_query($query);
	     ?>
            	  <table width="100%"  border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
            background=image/tbg.jpg border=0>
            <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P><?=$row->class_name?></P></TD>
                <TD class=fontg align=middle width=50><A 
                  href="article.php?class_id=<?=$row->id?>"><IMG 
                  height=15 src="image/more.gif" width=53 
                border=0></A></TD>
              </TR>
            </TBODY>
          </TABLE></td>
        </tr>
      </table>      
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
	  <TABLE height=90 cellSpacing=1 cellPadding=5 width="100%" 
              border=0>
        <TBODY>
          <TR>
            <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
              <?php while($row_list=mysql_fetch_object($result_list)) { 
			    $pic_id=$row_list->pic_id;
				$query="select * from ".$table_suffix."picture where id=$pic_id";
			    $result=mysql_query($query);
				$row=mysql_fetch_object($result);
				$pic_url=get_small_img($row->pic_url,$row->small_pic);
			  ?>
			  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                <TBODY>
                  <TR>
                    <TD class=piclist align=middle>
                      <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                        <TBODY>
                          <TR>
                            <TD vAlign=top width=70>
                              <TABLE cellSpacing=1 cellPadding=2 bgColor=#d2d2d2 border=0>
                                <TBODY>
                                  <TR>
                                    <TD vAlign=top align=middle bgColor=#ffffff><IMG height=<?=$height?>  src="<?=$pic_url?>" width=<?=$width?>  border=0></TD>
                                  </TR>
                                </TBODY>
                            </TABLE></TD>
                            <TD vAlign=top>
                              <TABLE cellSpacing=1 cellPadding=0 width="100%" 
                              border=0>
                                <TBODY>
                                  <TR>
                                    <TD height=20><FONT color=#336699><A 
                                href="show_article.php?id=<?=$row_list->id?>"><FONT 
                                color=#336699><?=msubstr($row_list->article_title,0,14)?></FONT></A></FONT></TD>
                                  </TR>
                                </TBODY>
                              </TABLE>
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                <TBODY>
                                  <TR>
                                    <TD background=image/line.gif colSpan=2 
                                height=4></TD>
                                  </TR>
                                </TBODY>
                              </TABLE>
                              <TABLE height=30 cellSpacing=1 cellPadding=1 
                              width="100%" border=0>
                                <TBODY>
                                  <TR>
                                    <TD 
                              colSpan=2><?=msubstr(trim($row_list->abstract),0,30)?></TD>
                                  </TR>
                                </TBODY>
                            </TABLE></TD>
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
			  <?php } ?>
            </TD>
          </TR>
        </TBODY>
    </TABLE>
	<TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
    <TD></TD></TR></TBODY></TABLE>
	<?php } ?>
	 <table width="100%"  border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
            background=image/tbg.jpg border=0>
            <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P>最新会员</P></TD>
                <TD class=fontg align=middle width=50><A 
                  href="member_list.php"><IMG 
                  height=15 src="image/more.gif" width=53 
                border=0></A></TD>
              </TR>
            </TBODY>
          </TABLE></td>
        </tr>
      </table>      
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
	  <TABLE cellSpacing=1 cellPadding=5 width="100%" 
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
                            <TD vAlign=top width=70 style="line-height:100%;"><a href="user_infor.php?host_id=<?=$row_list->id?>&idkey=<?=md5($row_list->user_name)?>" style="text-decoration:underline"><?=$row_list->nick_name?></a></TD>
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
			  <?php } ?>
            </TD>
          </TR>
        </TBODY>
    </TABLE>
	<TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
            <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
            background=image/tbg.jpg border=0>
              <TBODY>
              <TR>
                <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                <TD class=fontg>
                  <P>热点排行</P></TD>
                <TD class=fontg align=middle width=50><A 
                  href="class_list.php?list_for=<?=urlencode("点击排行")?>"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></A></TD></TR></TBODY></TABLE>
            <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
            <TABLE height=90 cellSpacing=1 cellPadding=5 width="100%" 
              border=0><TBODY>
              <TR>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                  <?php 
				   $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['点击排行']." limit 0,10";
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
                          <td style="PADDING-TOP: 0px;">[<?=substr($chinese_name,0,4)?>]<A style="LINE-HEIGHT: 100%;" href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>"  target=_self><font color="<?=$row->title_color?>" style="font-weight:<?=$row->title_bold=="1"?"bold":"normal"?>"><?=$row->article_title?></font></A>&nbsp;</td>
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
            </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
		  <?php require_once("inc/float_picture.php");?>
    </TD>
  </TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
