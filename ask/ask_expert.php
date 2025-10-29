<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> - 问答知识系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet>
<STYLE type=text/css>.z2tw {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; BACKGROUND: url(http://i2.sinaimg.cn/pfp/iask/zsr/z2_tw.gif) no-repeat; BORDER-LEFT: 0px; WIDTH: 64px; CURSOR: pointer; BORDER-BOTTOM: 0px; HEIGHT: 20px
}
.jia1 {
	LEFT: 1px; POSITION: relative; TOP: 1px
}
</STYLE>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<TABLE class=topline cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD noWrap align=middle width=170 height=65><A 
      href="./"><IMG height=45 alt=爱问知识人 
      src="ask_expert.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD noWrap width=25></TD>
    <TD vAlign=top>
       <?php require_once("include/top_right_nav.php");?><BR clear=all>
       <?php  require_once("include/main_form.php");?></TD></TR></TBODY></TABLE>
<TABLE class="f13 cc" cellSpacing=0 cellPadding=0 width="100%" 
background=ask_expert.files/bg_nav_30.gif border=0>
  <TBODY>
  <TR vAlign=bottom align=middle>
    <TD width="2%" height=23></TD>
    <TD width=1>|</TD>
    <TD noWrap width="5%"><A class=nav 
    href="index.php">首页</A></TD>
    <TD width=1>|</TD>
    <TD noWrap width="7%"><A class=nav 
      href="ask_class.php">问题分类</A></TD>
    <TD width=1>|</TD>
    <TD noWrap width="9%"><A class=nav 
      href="ask_rank.php">问题排行榜</A></TD>
    <TD width=1>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_star.php">用户榜</A></TD>
    <TD width=3><IMG src="ask_expert.files/nav_left.gif" border=0></TD>
    <TD noWrap width="6%" background=ask_expert.files/bg_nav_sy.gif 
    bgColor=#ffc52e><B class="cf fs13">专家团</B></TD>
    <TD width=3><IMG src="ask_expert.files/nav_right.gif" border=0></TD>
    <TD>&nbsp;</TD>
    <TD width=100><A href="user.php" 
      target=_blank><IMG height=19 src="ask_expert.files/grzx.gif" width=78 
      border=0></A></TD>
  </TR>
  <TR>
    <TD colSpan=10 height=7></TD>
    <TD align=middle><IMG src="ask_expert.files/yellow_xjt.gif" border=0></TD>
    <TD></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="97%" align=center border=0>
  <TBODY>
  <TR vAlign=top>
    <TD><BR>
      <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
      background=ask_expert.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_l.gif" width=3 
            border=0></TD>
          <TD noWrap width="15%" background=ask_expert.files/lb_l_bg.gif>
            <DIV><B><FONT color=#336600>优秀专家推荐</FONT></B></DIV></TD>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>
            <DIV align=right>&nbsp;&nbsp;<A class=f13 
            href="http://iask.sina.com.cn/info/all_expert_newmore.html" 
            target=_blank></A></DIV></TD>
          <TD>
            <DIV align=right></DIV></TD></TR></TBODY></TABLE>
      <TABLE class=wt_wtbg cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TR>
          <TD class=wt_wttd style="PADDING-BOTTOM: 10px; PADDING-TOP: 10px" 
          height=176>
            <TABLE cellSpacing=0 cellPadding=5 width="90%" align=center border=0>
			  <TR><TD align=middle>
			  <?php 
			    $query="select * from ".$table_suffix."ask_score where major!='' and top='1' order by top_time desc limit 0, 8";
	            $result_score=mysql_query($query);
	            $i=0;
				while($row_score=mysql_fetch_object($result_score)) { 
				
				$query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			    $result=mysql_query($query);
			    $row=mysql_fetch_object($result);
			    $img_default="user.files/120_1570632011.gif";
			    $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
			    
				if($i%4==0) echo "<TR><TD align=middle>"; else echo "<TD align=middle>";
			  ?>              
                  <TABLE class=f12 cellSpacing=0 cellPadding=0 width="70%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE 
                        width=100 border=0 align="center" cellPadding=0 cellSpacing=0 
                        borderColor=#ffcc66 bgColor=#ffffff 
                        style="BORDER-RIGHT: #81b9e1 1px solid; BORDER-TOP: #81b9e1 1px solid; MARGIN: 4px; BORDER-LEFT: #81b9e1 1px solid; BORDER-BOTTOM: #81b9e1 1px solid">
                          <TBODY>
                          <TR>
                            <TD 
                            style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px" 
                            vAlign=bottom align=middle height=30><A 
                              href="user_infor.php?user_id=<?=$row->id?>" 
                              target=_blank><IMG height=120 
                              src="<?=$sample_pic?>" width=90 
                              align=middle 
                    border=0></A></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD height=5></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif><IMG 
                        height=1 src="ask_expert.files/1172130607_12282519.gif" 
                        border=0></TD></TR>
                    <TR>
                      <TD align=middle bgColor=#f7f7f7 height=20><A 
                        class="f14 pl5" 
                        href="user_infor.php?user_id=<?=$row->id?>" 
                        target=_blank><?=$row->nick_name?> </A></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif 
                      bgColor=#f7f7f7><IMG height=1 
                        src="ask_expert.files/line_g22.gif" border=0></TD></TR>
                    <TR>
                      <TD align=middle bgColor=#f7f7f7 height=20>
					  <?php 
					    $query="select part_name from ".$table_suffix."chapter where chapter_name='{$row_score->major}'";
						$part_name=mysql_result(mysql_query($query),0,"part_name");
					  ?>
					  <FONT 
                        class="f14 pl5">[<A class=c6ul 
                        href="ask_section.php?part=<?=urlencode($part_name)?>&chapter=<?=urlencode($row_score->major)?>" 
                        target=_blank><?=$row_score->major?></A>] </FONT></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif><IMG 
                        height=1 src="ask_expert.files/1172130607_12282519.gif" 
                        border=0></TD></TR></TBODY></TABLE> 
              <?php $i++;
			  } ?>
			  </TD></TR>
			  </TABLE></TD></TR></TABLE><BR>
      <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
      background=ask_expert.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_l.gif" width=3 
            border=0></TD>
          <TD noWrap width="15%" background=ask_expert.files/lb_l_bg.gif>
            <DIV><B><FONT color=#336600>荣誉知识人</FONT></B></DIV></TD>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>
            <DIV align=right>&nbsp;&nbsp;<A class=f13 
            href="http://iask.sina.com.cn/info/all_expert_newmore.html" 
            target=_blank></A></DIV></TD>
          <TD>
            <DIV align=right></DIV></TD></TR></TBODY></TABLE>
      <TABLE class=wt_wtbg cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=wt_wttd style="PADDING-BOTTOM: 10px; PADDING-TOP: 10px" 
          height=176>
            <TABLE cellSpacing=0 cellPadding=5 width="90%" align=center border=0>
              <TR><TD align=middle>
			  <?php 
			    $query="select * from ".$table_suffix."ask_score where honor='1' order by honor_time desc limit 0, 8";
	            $result_score=mysql_query($query);
	            $i=0;
				while($row_score=mysql_fetch_object($result_score)) { 
				
				$query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			    $result=mysql_query($query);
			    $row=mysql_fetch_object($result);
			    $img_default="user.files/120_1570632011.gif";
			    $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
			    
				if($i%4==0) echo "<TR><TD align=middle>"; else echo "<TD align=middle>";
			  ?>              
                  <TABLE class=f12 cellSpacing=0 cellPadding=0 width="70%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE 
                        width=100 border=0 align="center" cellPadding=0 cellSpacing=0 
                        borderColor=#ffcc66 bgColor=#ffffff 
                        style="BORDER-RIGHT: #81b9e1 1px solid; BORDER-TOP: #81b9e1 1px solid; MARGIN: 4px; BORDER-LEFT: #81b9e1 1px solid; BORDER-BOTTOM: #81b9e1 1px solid">
                          <TBODY>
                          <TR>
                            <TD 
                            style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px" 
                            vAlign=bottom align=middle height=30><A 
                              href="user_infor.php?user_id=<?=$row->id?>" 
                              target=_blank><IMG height=120 
                              src="<?=$sample_pic?>" width=90 
                              align=middle 
                    border=0></A></TD></TR></TBODY></TABLE></TD></TR>
                    <TR>
                      <TD height=5></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif><IMG 
                        height=1 src="ask_expert.files/1172130607_12282519.gif" 
                        border=0></TD></TR>
                    <TR>
                      <TD align=middle bgColor=#f7f7f7 height=20><A 
                        class="f14 pl5" 
                        href="user_infor.php?user_id=<?=$row->id?>" 
                        target=_blank><?=$row->nick_name?> </A></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif 
                      bgColor=#f7f7f7><IMG height=1 
                        src="ask_expert.files/line_g22.gif" border=0></TD></TR>
                    <TR>
                      <TD align=middle bgColor=#f7f7f7 height=20>
					  <?php 
					    $query="select part_name from ".$table_suffix."chapter where chapter_name='{$row_score->major}'";
						$part_name=mysql_result(mysql_query($query),0,"part_name");
					  ?>
					  <FONT 
                        class="f14 pl5">[<A class=c6ul 
                        href="ask_section.php?part=<?=urlencode($part_name)?>&chapter=<?=urlencode($row_score->major)?>" 
                        target=_blank><?=$row_score->major?></A>] </FONT></TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif><IMG 
                        height=1 src="ask_expert.files/1172130607_12282519.gif" 
                        border=0></TD></TR></TBODY></TABLE> 
              <?php $i++;
			  } ?>
			  </TD></TR></TABLE></TD></TR></TBODY></TABLE><BR>
      <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
      background=ask_expert.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_l.gif" width=3 
            border=0></TD>
          <TD noWrap width="15%" background=ask_expert.files/lb_l_bg.gif>
            <DIV><B><FONT color=#336600>推荐网友专家</FONT></B></DIV></TD>
          <TD width=3><IMG height=30 src="ask_expert.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
      <TABLE class=wt_wtbg cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=wt_wttd style="PADDING-BOTTOM: 10px; PADDING-TOP: 10px" 
          height=176>
            <?php 
			    $query="select * from ".$table_suffix."ask_score where major!='' and top='1' order by top_time desc limit 0, 24";
	            $result_score=mysql_query($query); 	
				$num_of_honor=mysql_num_rows($result_score);		    
			  ?> 
			 <TABLE cellSpacing=0 cellPadding=6 width="85%" align=center 
border=0>
              <TBODY>
              <TR>
                <TD valign="top">
                  <TABLE class="f13 c6 lh25" cellSpacing=0 cellPadding=0 
                  width="100%" border=0>
                    <TBODY>
                    <TR class=c3 bgColor=#e3f2d1>
                      <TD width=150 bgColor=#e8f3dc>&nbsp;擅长分类</TD>
                      <TD width=118 bgColor=#e8f3dc>昵称</TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif colSpan=9 
                      height=1></TD></TR>
                    <?php 
					while($row_score=mysql_fetch_object($result_score)) { 
				    $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			        $result=mysql_query($query);
			        $row=mysql_fetch_object($result);
			        $img_default="user.files/120_1570632011.gif";
			        $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
				    ?>
				  <TR>
                      <TD noWrap><?php 
					    $query="select part_name from ".$table_suffix."chapter where chapter_name='{$row_score->major}'";
						$part_name=mysql_result(mysql_query($query),0,"part_name");
					  ?>
                        <FONT 
                        class="f14 pl5">[<A class=c6ul 
                        href="ask_section.php?part=<?=urlencode($part_name)?>&chapter=<?=urlencode($row_score->major)?>" 
                        target=_blank><?=$row_score->major?></A>] </FONT></TD>
                      <TD><A 
                        class="f14 pl5" 
                        href="user_infor.php?user_id=<?=$row->id?>" 
                        target=_blank>
                        <?=$row->nick_name?>
                      </A></TD>
				  </TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif colSpan=9 
                      height=1></TD></TR>
					<?php } ?>
                    <TR>
                      <TD colSpan=9 height=1></TD></TR></TBODY></TABLE></TD>
                <?php if($num_of_honor>12) { ?>
				<TD valign="top">
                  <TABLE class="f13 c6 lh25" cellSpacing=0 cellPadding=0 
                  width="100%" border=0>
                    <TBODY>
                    <TR class=c3 bgColor=#e3f2d1>
                      <TD width=150 bgColor=#e8f3dc>&nbsp;擅长分类</TD>
                      <TD width=118 bgColor=#e8f3dc>昵称</TD></TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif colSpan=9 
                      height=1></TD></TR>
                    <?php 
					while($row_score=mysql_fetch_object($result_score)) { 
				    $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			        $result=mysql_query($query);
			        $row=mysql_fetch_object($result);
			        $img_default="user.files/120_1570632011.gif";
			        $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
				    ?>
				  <TR>
                      <TD noWrap><?php 
					    $query="select part_name from ".$table_suffix."chapter where chapter_name='{$row_score->major}'";
						$part_name=mysql_result(mysql_query($query),0,"part_name");
					  ?>
                        <FONT 
                        class="f14 pl5">[<A class=c6ul 
                        href="ask_section.php?part=<?=urlencode($part_name)?>&chapter=<?=urlencode($row_score->major)?>" 
                        target=_blank><?=$row_score->major?></A>]</FONT></TD>
                      <TD><A 
                        class="f14 pl5" 
                        href="user_infor.php?user_id=<?=$row->id?>" 
                        target=_blank>
                        <?=$row->nick_name?>
                      </A></TD>
				  </TR>
                    <TR>
                      <TD background=ask_expert.files/line_g22.gif colSpan=9 
                      height=1></TD></TR>
					<?php } ?>
                    <TR>
                      <TD colSpan=9 height=1></TD></TR></TBODY></TABLE>	
			   </TD>
			   <?php } ?>
              </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD width="3%">&nbsp;</TD>
    <TD width=175>
      <TABLE class=mb7 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD align=middle><A 
            href="post.php" 
            target=_blank><IMG alt=我要提问 src="ask_expert.files/img2_tw.gif" 
            width=138 border=0></A></TD>
        </TR></TBODY></TABLE>
      </TD>
  </TR></TBODY></TABLE><BR>
<?php  require_once("htm/foot.htm");?>
</BODY></HTML>
