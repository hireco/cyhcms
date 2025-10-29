<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  $query="select * from ".$table_suffix."chapter group by part_name order by top_time desc";
  $result=mysql_query($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> - 问答知识系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<TABLE class=topline cellSpacing=0 cellPadding=0 width="100%" border=0>
  
  <TBODY>
  <TR>
    <TD noWrap align=middle width=170 height=65><A 
      href="./"><IMG height=45 alt=爱问知识人 
      src="ask_class.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD noWrap width=25></TD>
    <TD vAlign=top>
       <?php require_once("include/top_right_nav.php");?><BR clear=all>
       <?php  require_once("include/main_form.php");?>
	  </TD></TR></TBODY></TABLE>
<TABLE class="f13 cc" cellSpacing=0 cellPadding=0 width="100%" 
background=ask_class.files/bg_nav_30.gif border=0>
  <TBODY>
  <TR vAlign=bottom align=middle>
    <TD width=20 height=23></TD>
    <TD width=3>|</TD>
    <TD noWrap width="5%"><A class=nav 
    href="index.php">首页</A></TD>
    <TD width=3><IMG src="ask_class.files/nav_left.gif" border=0></TD>
    <TD noWrap width="7%" background=ask_class.files/bg_nav_sy.gif 
    bgColor=#ffc52e><B class="cf fs13">问题分类</B></TD>
    <TD width=3><IMG src="ask_class.files/nav_right.gif" border=0></TD>
    <TD noWrap width="9%"><A class=nav 
      href="ask_rank.php">问题排行榜</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_star.php">用户榜</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_expert.php">专家团</A></TD>
    <TD width=3>|</TD>
    <TD align=right><A 
      href="user.php" 
      target=_blank><IMG height=19 src="ask_class.files/grzx.gif" width=78 
      border=0></A></TD>
    <TD width=15></TD></TR>
  <TR>
    <TD colSpan=4 height=7></TD>
    <TD align=middle><IMG src="ask_class.files/yellow_xjt.gif" border=0></TD>
    <TD></TD></TR></TBODY></TABLE>
<DIV class="f13 c6 lh30" style="PADDING-LEFT: 20px"><A 
href="./index.php">知识人</A> &gt; 问题分类</DIV>
<TABLE cellSpacing=0 cellPadding=0 width="97%" align=center border=0>
  <TBODY>
  <TR vAlign=top>
    <TD height=512>
      <TABLE class=wt_wtbg cellSpacing=0 cellPadding=15 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=wt_wttd vAlign=top height=499><TABLE class="f14 lh15" cellSpacing=0 cellPadding=10 width="100%" 
            align=right border=0>
            <TBODY>
              <?php while($row=mysql_fetch_object($result)) {
			     $query="select * from ".$table_suffix."chapter where  part_name='{$row->part_name}'";
			     $result_chapter=mysql_query($query);
				 ?>
              <TR>
                <TD width="50%"><TABLE cellSpacing=0 cellPadding=0 border=0>
                    <TBODY>
                      <TR>
                        <TD width=18 height=21><IMG height=5 
                        src="ask_class.files/fenlei_d.gif" width=5></TD>
                        <TD width=310><A 
                        href="ask_chapter.php?part=<?=urlencode($row->part_name)?>"><STRONG>
                          <?=$row->part_name?>
                        </STRONG></A></TD>
                      </TR>
                      <TR>
                        <TD>&nbsp;</TD>
                        <TD class=lh18><?php while($row_chapter=mysql_fetch_object($result_chapter)) { ?>
                        <A href="ask_section.php?part=<?=urlencode($row->part_name)?>&chapter=<?=urlencode($row_chapter->chapter_name)?>">
						<?=$row_chapter->chapter_name?></A>  
                            <?php } ?>
							 <a href="ask_chapter.php?part=<?=urlencode($row->part_name)?>" class="f10"> &raquo;</a>
                        </TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
                <TD width="50%"><?php if($row=mysql_fetch_object($result)) { 
				     $query="select * from ".$table_suffix."chapter where  part_name='{$row->part_name}'";
			         $result_chapter=mysql_query($query);
				   ?>
                    <TABLE cellSpacing=0 cellPadding=0 border=0>
                      <TBODY>
                        <TR>
                          <TD width=18 height=21><IMG height=5 
                        src="ask_class.files/fenlei_d.gif" width=5></TD>
                          <TD width=310><A 
                        href="ask_chapter.php?part=<?=urlencode($row->part_name)?>"><STRONG>
                            <?=$row->part_name?>
                          </STRONG></A></TD>
                        </TR>
                        <TR>
                          <TD>&nbsp;</TD>
                          <TD class=lh18><?php while($row_chapter=mysql_fetch_object($result_chapter)) { ?>
                              <A href="ask_section.php?part=<?=urlencode($row->part_name)?>&chapter=<?=urlencode($row_chapter->chapter_name)?>">
						      <?=$row_chapter->chapter_name?></A>   
                              <?php } ?>
							    <a href="ask_chapter.php?part=<?=urlencode($row->part_name)?>" class="f10"> &raquo;</a>
							  </TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  <?php } ?>
                </TD>
              </TR>
              <?php } ?>
            </TBODY>
          </TABLE></TD>
        </TR></TBODY></TABLE><BR></TD>
    <TD width="2%">&nbsp;</TD>
    <TD width=175><TABLE class=mb7 cellSpacing=0 cellPadding=0 width="100%" border=0>
      <TBODY>
        <TR>
          <TD align=middle><A 
            href="post.php" 
            target=_blank><IMG id=newImag alt=我要提问 
            src="ask_class.files/img2_tw.gif" width=138 border=0></A> </TD>
        </TR>
      </TBODY>
    </TABLE>
      <!-- Ask Button End -->
      </TD>
  </TR>
        <TR>
          <TD colSpan=9 height=5></TD></TR></TBODY></TABLE><!-- Ask Button Begin -->
          </TD>
          </TR>
          </TBODY>
          <!-- 尾部 begin -->
          <BR>
<?php require_once("htm/foot.htm");?>
</BODY></HTML>
