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
<?php  require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<TABLE height=300 cellSpacing=1 cellPadding=0 width=<?=$cfg_body_width?> align=center bgColor=#ffffff border=0>
  <TR>
    <TD vAlign=top align=middle width=181 background=image/leftbg.gif>
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
            <P>热点文章</P>
          </SPAN></TD>
          <TD valign="middle"><div align="right"><span class="fontg"><A 
                  href="class_list.php?list_for=<?=urlencode("点击排行")?>"><IMG height=15 
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
			  $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['点击排行']." limit 0,6";
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
			  <?php } ?> <TR>
                <TD background=image/line.gif colSpan=2 height=3></TD></TR>
              </TBODY></TABLE>
            </TD></TR></TBODY></TABLE>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
      <TD></TD></TR></TBODY></TABLE>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td></td>
        </tr>
      </table>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
    <TD></TD></TR></TBODY></TABLE>
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

	<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td></td>
        </tr>
      </table>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
    <TD></TD></TR></TBODY></TABLE>
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
	<TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
      <TD></TD></TR></TBODY></TABLE>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td></td>
        </tr>
      </table>
	  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
          <TR>
            <TD></TD>
          </TR>
        </TBODY>
      </TABLE>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
            background=image/tbg.jpg border=0>
              <TBODY>
                <TR>
                  <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
                  <TD class=fontg>
                    <P>文章导航</P></TD>
                  <TD class=fontg align=middle width=50>&nbsp;</TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
	  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#d2d2d2 border=0>
        <TBODY>
          <TR>
            <TD></TD>
          </TR>
        </TBODY>
      </TABLE>
	  <TABLE cellSpacing=1 cellPadding=5 width="100%" 
              border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <TABLE width="100%" height=27 
              border=0 align=center cellPadding=0 cellSpacing=0>
                      <TBODY>
                        <?php 
			  $query="select * from ".$table_suffix."infor where hide_type='0' and class_level='0' order by top desc,top_time desc";  
              $result=mysql_query($query);
		      while($row=mysql_fetch_object($result)) { ?>
                        <TR>
                          <TD class=smenuv noWrap align=middle  height=30>
                            <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                              <?=$row->class_name?>
                          </A></div></TD>
                          <?php if($row=mysql_fetch_object($result))  { ?>
                          <TD class=smenuv noWrap align=middle  height=30>
                            <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                              <?=$row->class_name?>
                          </A></div></TD>
                          <?php } ?>
                        </TR>
                        <?php } ?>
                      </TBODY>
                    </TABLE>
            </TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=6>&nbsp;</TD>
    <TD vAlign=top>
      <TABLE height=160 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
          <TR>
            <TD width="300" height=130  vAlign=top  style="BORDER-RIGHT: #ffffff 1px solid; BORDER-TOP: #ffffff 1px solid; BORDER-LEFT: #ffffff 1px solid; BORDER-BOTTOM: #ffffff 1px solid"><?php require_once("inc/flash/flash3.php");?></TD>
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
              border=0></A></TD>
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
              <TABLE height=130 cellSpacing=1 cellPadding=0 width="100%" 
              border=0>
                <TBODY>
                  <TR>
                    <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                      <?php 
				   $query="select * from ".$table_suffix."infor_index  where hide_type='0' order by ".$show_turn['最新文章']." limit 0, 6";
			       $result=mysql_query($query);
				  ?>
                      <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                        <TBODY>
                          <?php  while($row=mysql_fetch_object($result)) { 
						     $class_name=mysql_result(mysql_query("select class_name from  ".$table_suffix."infor where id={$row->class_id}"),0,"class_name");
						  ?>
                          <TR>
                            <TD width="28" align=middle><IMG height=14 
                        src="image/items.gif" width=16></TD>
                            <TD height=19>[<a href="<?=$row->infor_class?>.php?class_id=<?=$row->class_id?>"><?=$class_name?></a>]<A class=tList 
                        href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" 
                        target=_self><font color="<?=$row->title_color?>" style="font-weight:<?=$row->title_bold=="1"?"bold":"normal"?>">
                              <?=msubstr($row->article_title,0,28)?>
                              </font></A></TD>
                            <TD><div align="right"><FONT 
                        class=fonts>[<?=substr($row->post_time,3,5)?>]</FONT></div></TD>
                          </TR>
                          <?php } ?>
                          <TR>
                            <TD background=image/line.gif colSpan=3 
                      height=3></TD>
                          </TR>                       
                        </TBODY>
                    </TABLE>					
					</TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
          <TR>
            <TD></TD>
          </TR>
        </TBODY>
      </TABLE>      
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><?php require_once("inc/scrollnews_s.php"); ?></td>
        </tr>
      </table>      
      <TABLE class=table cellSpacing=0 cellPadding=0 width="100%" 
border=0>
        <TBODY>
          <TR>
            <TD>
           <?php 
		   $list_block=0;
		   $height=80;
		   $width=80*$cfg_artsimg_width/$cfg_artsimg_height;
		   $query="select * from ".$table_suffix."infor_index where hide_type='0' order by IFNULL(show_attribute=2,0 ) desc, recommend desc, recommend_time desc, top desc, top_time desc limit 0, 6";
		   $result_index=mysql_query($query);
		   $num_of_recommend=mysql_num_rows($result_index);
		   if($num_of_recommend) { 
		   $list_block++;
		   $row=mysql_fetch_object($result_index);
		   $infor_id=$row->infor_id;
		   $infor_class=$row->infor_class;
		   $row_arc=mysql_fetch_object(mysql_query("select * from ".$table_suffix.$infor_class." where id=$infor_id"));
		   $pic_id=$row_arc->pic_id; 
		   $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
		   $pic_row=mysql_fetch_object($pic_result); 
		   ?>
           <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" 
                  background=image/tbg.jpg border=0>
                <TBODY>
                  <TR>
                    <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                    <TD class=fontg>首页推荐</TD>
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
                    <?php  if($pic_row->pic_url) {
					   $pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
					?>
					<TD width="110" align="center" valign="middle"><div align="center">
                      <TABLE border=0 align="center" cellPadding=10 cellSpacing=0>
                        <TBODY>
                          <TR>
                            <TD align=center valign="middle" bgcolor="#FFFFFF" class=piclist><div align="center"><a href="<?=$pic_row->pic_link==""?"show_".$row->infor_class.".php?id=$row->infor_id":$pic_row->pic_link?>" target="_self"><IMG src="<?=$pic_url?>" width=<?=$width?> height=<?=$height?> border="1" style="border:1px solid #000;"></a> </div></TD>
                          </TR>
                        </TBODY>
                      </TABLE>
                    </div></TD>
					<?php } ?>
                    <TD align=left vAlign=top><table width="100%"  border="0" align="left" cellpadding="5" cellspacing="0">
                        <tr>
                          <td><div align="left"><strong>
                              <?=$row->article_title?>
                            </strong>&nbsp;&nbsp;<a  style="text-decoration:underline; color:#999999" href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>"><?=msubstr(strip_tags($row_arc->content),0,250)?></a>... </div></td>
                        </tr>
                      </table></TD>
                  </TR>
                  <TR>
                    <TD colspan="2" align=middle vAlign=top style="PADDING-LEFT: 1px; PADDING-TOP: 1px">
                      <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                          border=0>
                        <TBODY>
                          <?php  
						    while($row=mysql_fetch_object($result_index)) {   
							$infor_id=$row->infor_id;
		                    $infor_class=$row->infor_class;
		                    $row_arc=mysql_fetch_object(mysql_query("select * from ".$table_suffix.$infor_class." where id=$infor_id"));	
							$out_string=msubstr($row->article_title.":".strip_tags($row_arc->content),0,92);  
						  ?>
                          <TR>
                            <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                            <TD height=21><a href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>"><?=$out_string?>...</A>&nbsp;</TD>
                            <TD class="fonts">[<?=substr($row->post_time,3,5)?>]</TD>
                          </TR>
                          <?php } ?>
                          <TR>
                            <TD background=image/line.gif colSpan=3 
                            height=3></TD>
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
      <TABLE height=160 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top height=150>            
			<?php  
			 $width=105;
			 $height=105*$cfg_colsimg_height/$cfg_colsimg_width;
			 $query="select * from ".$table_suffix."infor where infor_class='article' and index_block='1' and hide_type='0' order by top desc,top_time desc limit 1, 3";
			 $result=mysql_query($query);
			 while($row=mysql_fetch_object($result)) { 
			 $query="select * from ".$table_suffix."article where class_id='{$row->id}' and hide_type='0' order by top desc, top_time desc limit 0, 10";
			 $result_list=mysql_query($query);
			 $list_block++; 
			?>
			<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>
			<table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#DBDBDB">
              <tr>
                <td bgcolor="#FFFFFF">
			<TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
              border=0><TBODY>
              <TR>
                <TD 
                style="PADDING-RIGHT: 1px; PADDING-LEFT: 1px; PADDING-BOTTOM: 1px; PADDING-TOP: 1px" 
                vAlign=top width=110>
                  <TABLE cellSpacing=0 cellPadding=0 width=100 border=0>
                    <TBODY>
                    <TR>
                      <TD><div align="center"><a href="<?=$row->picture_link==""?"article.php?class_id={$row->id}":$row->picture_link?>" target="_self"><IMG src="<?=$row->picture?>" alt="<?=$row->picture_title?>"  width=<?=$width?> height=<?=$height?> border="0"></a></div></TD>
                    </TR>
                    <TR>
                      <TD align=middle height=20><SPAN class=fontg><A 
                        href="article.php?class_id=<?=$row->id?>">
                        <P><?=$row->class_name?></P></A></SPAN></TD></TR></TBODY></TABLE></TD>
                  <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                    <TBODY>
					<?php 
					 while($row_list=mysql_fetch_object($result_list)) {
					?>
					<TR>
                      <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                      <TD height=21 width="45%"><A class=tList href="show_article.php?id=<?=$row_list->id?>" target=_self><font color="<?=$row_list->title_color?>"><?=msubstr($row_list->article_title,0,38)?>...</font></A>&nbsp;</TD>
					  <?php if($row_list=mysql_fetch_object($result_list)) { ?>
					  <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                      <TD height=21 width="45%"><A class=tList href="show_article.php?id=<?=$row_list->id?>" target=_self><font color="<?=$row_list->title_color?>"><?=msubstr($row_list->article_title,0,38)?>...</font></A>&nbsp;</TD>
					 <?php } ?>
					</TR>
                    <?php } ?>
					<TR>
                      <TD background=image/line.gif colSpan=2   height=3></TD><TD background=image/line.gif colSpan=2   height=3></TD>
					</TR>
				    </TBODY></TABLE></TD></TR></TBODY></TABLE>
				 </td>
              </tr>
            </table>
			<?php } ?>
            <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" 
              border=0>
              <TBODY>
              <TR>
              <TD></TD></TR></TBODY></TABLE>
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
                                <TD align=middle bgColor=#ffffff><a href="<?=$row->picture_link==""?"ftp.php?class_id={$row->id}":$row->picture_link?>" target="_self"><IMG src="<?=$row->picture?>" alt="<?=$row->picture_title?>" width=<?=$width?> height=<?=$height?>  border="0"></a></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>                        </TD>
                      <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" 
vAlign=top>
                        <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0><TBODY>
                           <?php  while($row_list=mysql_fetch_object($result_list)) { ?>
					      <TR>
                          <TD align=middle width=22><IMG src="image/item_list/list_dot<?=$list_block?>.gif" ></TD>
                          <TD height=21><A class=tList href="show_ftp.php?id=<?=$row_list->id?>" target=_self><font color="<?=$row_list->title_color?>"><?=msubstr($row_list->article_title,0,60)?></font></A>&nbsp;</TD>
                          <TD class="fonts">[点击:<?=$row_list->read_times?>]</TD>
                          <TD class="fonts"><div align="right">[<?=substr($row_list->post_time,3,8)?>]</div></TD>
					      </TR>
					      <?php } ?>
                            <TR><TD background=image/line.gif colSpan=4 
                            height=3></TD></TR>
                         </TBODY></TABLE>                        </TD></TR></TBODY></TABLE>
		<?php } ?>  
		  </TD></TR></TBODY></TABLE>            
            <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table>            </TD>
        </TR></TBODY></TABLE>
      <?php require_once("inc/float_picture.php");?>    </TD>
</TR></TBODY></TABLE>
<?php   require_once(dirname(__FILE__)."/inc/link_bottom.php");?>
<?php   require_once("footer.php"); ?>
</body>
</html>