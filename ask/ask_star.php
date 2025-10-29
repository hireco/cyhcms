<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  require_once(dirname(__FILE__)."/include/ask_level.php");
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
      href="./"><IMG height=45 alt=ask_star 
      src="ask_rank.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD noWrap width=25></TD>
    <TD vAlign=top>
       <?php require_once("include/top_right_nav.php");?><BR clear=all>
       <?php  require_once("include/main_form.php");?></TD></TR></TBODY></TABLE>
<!-- LOGO & 搜索框 end -->
<!-- navigation begin -->
<TABLE class="f13 cc" cellSpacing=0 cellPadding=0 width="100%" 
background=ask_star.files/bg_nav_30.gif border=0>
  <TBODY>
  <TR vAlign=bottom align=middle>
    <TD width=20 height=23></TD>
    <TD width=3>|</TD>
    <TD noWrap width="5%"><A class=nav 
    href="index.php">首页</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="7%"><A class=nav 
      href="ask_class.php">问题分类</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="9%"><A class=nav 
      href="ask_rank.php">问题排行榜</A></TD>
    <TD width=3><IMG src="ask_star.files/nav_left.gif" border=0></TD>
    <TD noWrap width="6%" background=ask_star.files/bg_nav_sy.gif 
    bgColor=#ffc52e><B class="cf fs13">用户榜</B></TD>
    <TD width=3><IMG src="ask_star.files/nav_right.gif" border=0></TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_expert.php">专家团</A></TD>
    <TD width=3>|</TD>
    <TD align=right><A href="user.php" 
      target=_blank><IMG height=19 src="ask_star.files/grzx.gif" width=78 
      border=0></A></TD>
    <TD width=15></TD></TR>
  <TR>
    <TD colSpan=8 height=7></TD>
    <TD align=middle><IMG src="ask_star.files/yellow_xjt.gif" border=0></TD>
    <TD></TD></TR></TBODY></TABLE>
<P></P>
<TABLE width="100%" border=0>
  <TBODY>
  <TR>
    <TD height=10></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="97%" align=center border=0>
  <TBODY>
  <TR vAlign=top>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=wt_wt width=130 background=ask_star.files/ryzsr_bg.gif 
          height=28><IMG hspace=10 src="ask_star.files/wt_l_wt.gif" 
            align=absMiddle border=0><B>荣誉知识人</B></TD>
          <TD>
            <DIV align=right></DIV></TD></TR></TBODY></TABLE>      
	  <TABLE class=wt_wtbg cellSpacing=10 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD>
            <?php  
	        $query="select * from ".$table_suffix."ask_score where honor='1' order by honor_time desc limit 0, 1";
	        $result_score=mysql_query($query);
	        if($row_score=mysql_fetch_object($result_score)) { 
			 $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			 $result=mysql_query($query);
			 $row=mysql_fetch_object($result);
			 $img_default="user.files/120_1570632011.gif";
			 $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
	        
			$query="select * from ".$table_suffix."ask_answer where poster='{$row_score->user_name}'"; 
	        $result_answer=mysql_query($query);
	        $num_answer=mysql_num_rows($result_answer);
	  
	        $query="select * from ".$table_suffix."ask_answer where poster='{$row_score->user_name}' and accept='1'"; 
	        $result_accept=mysql_query($query);
	        $num_accept=mysql_num_rows($result_accept);
	  
	        $right_percent=100*($num_accept*1.0)/($num_answer*1.0);
	        if($right_percent==NULL) $right_percent=0;
	  
			?>
			<TABLE width="100%" border=0>
              <TBODY>
              <TR vAlign=top>
                <TD width=140><A 
                  href="user_infor.php?user_id=<?=$row->id?>" 
                  target=_blank><IMG src="<?=$sample_pic?>" 
                  border=0 name=iconimg></A></TD>
                <TD>
                  <TABLE class="f13 ar" cellPadding=2 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD width="25%"><B>简　介：</B></TD>
                      <TD>&nbsp;</TD></TR>
                    <TR>
                      <TD noWrap>昵　称：<A title=zyq135333 
                        href="user_infor.php?user_id=<?=$row->id?>" 
                        target=_blank><?=$row->nick_name?></A></TD>
                      <TD noWrap>回答总数：<FONT color=#ff6600><?=$num_answer?></FONT>条</TD></TR>
                    <TR>
                      <TD noWrap>级　别：<?=get_user_title($row_score->income)?></TD>
                      <TD noWrap><SPAN class=style2>回答被采纳</SPAN>：<FONT 
                        color=#ff6600><?=$num_accept?></FONT>条</TD></TR>
                    <TR>
                      <TD>知识人得分：<FONT color=#ff6600><?=$row_score->income?></FONT></TD>
                      <TD>回答被采纳率：<FONT color=#ff6600><?=substr($right_percent,0,5)?>%</FONT></TD></TR>
                    <TR>
                      <TD colspan="2">个人博客：<a href="../user_infor.php?host_id=<?=$row->id?>&idkey=<?=md5($row->user_name)?>" target="_blank">点击进入</a></TD>
                      </TR>
                    </TBODY></TABLE>
                  </TD>
              </TR></TBODY></TABLE>
				 <?php } ?>
				  </TD></TR></TBODY></TABLE><BR>
                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD class=wt_wt width=130 background=ask_star.files/ryzsr_bg.gif 
          height=28><IMG hspace=10 src="ask_star.files/wt_l_wt.gif" 
            align=absMiddle border=0><B>排名前30人</B></TD>
                          <TD>
                            <DIV align=right></DIV></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <TABLE class=wt_wtbg cellSpacing=10 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD>
						  
						  <TABLE class="f13 lh20 ka ar" cellSpacing=0 cellPadding=0 
            width="100%" border=0>
                            <TBODY>
							 <?php 
							    $query="select max(last_time) as max_time from ".$table_suffix."ask_score where 1=1";
								$result=mysql_query($query);
								$last_time=mysql_result($result,0,"max_time");
							 ?>
                              <TR>
                                <TD class=c6 colSpan=9>统计日期截止到20<?=substr($last_time,0,2)?>年<?=substr($last_time,3,2)?>月<?=substr($last_time,6,2)?>日 <?=substr($last_time,9,5)?></TD>
                              </TR>
                              <TR class=bt1bb1 bgColor=#effae3>
                                <TD noWrap align=middle width="7%">排名</TD>
                                <TD noWrap width="20%">昵称</TD>
                                <TD noWrap width="18%">最新登录时间</TD>
                                <TD noWrap width="10%">性别</TD>
                                <TD noWrap width="12%">级别</TD>
                                <TD noWrap width="15%">回答采纳率</TD>
                                <TD noWrap align=right width="10%">知识人得分</TD>
                                <TD>&nbsp;</TD>
                              </TR>
                              <?php 
								$query="select * from ".$table_suffix."ask_score  order by income desc";
							    $result_score=mysql_query($query);
								$i=1;
	                            while($row_score=mysql_fetch_object($result_score)) { 
								  $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
			                      $result=mysql_query($query);
			                      $row=mysql_fetch_object($result);
								  
								  $query="select * from ".$table_suffix."ask_answer where poster='{$row_score->user_name}'"; 
	                              $result_answer=mysql_query($query);
	                              $num_answer=mysql_num_rows($result_answer);
	  
	                              $query="select * from ".$table_suffix."ask_answer where poster='{$row_score->user_name}' and accept='1'"; 
	                              $result_accept=mysql_query($query);
	                              $num_accept=mysql_num_rows($result_accept);
	  
	                              $right_percent=100*($num_accept*1.0)/($num_answer*1.0);
	                              if($right_percent==NULL) $right_percent=0;
								  
								  ?>
							  <TR>
                                <TD align=middle><?=$i?></TD>
                                <TD><A  href="user_infor.php?user_id=<?=$row->id?>"   target=_blank><?=$row->nick_name?></A></TD>
                                <TD><?=$row->last_time?></TD>
                                <TD><IMG alt=<?=$row->sex=="m"?"男":"女" ?> src="ask_star.files/<?=$row->sex=="m"?"gg":"mm" ?>.gif" align=absMiddle  border=0></TD>
                                <TD><?=get_user_title($row_score->income)?></TD>
                                <TD><?=substr($right_percent,0,5)?>%</TD>
                                <TD align=right><?=$row_score->income?></TD>
                              </TR>
							  <TR>
                                <TD background=ask_star.files/line_g22.gif colSpan=9   height=1><IMG src="ask_star.files/line_g22.gif" border=0></TD>
                              </TR>
							  <?php 
							   $i++;
							  } ?>
                            </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                    <BR>
      <P></P></TD>
    <TD width="2%">&nbsp;</TD>
    <TD width=175>
      <TABLE class=mb7 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD align=middle><A 
            href="post.php" 
            target=_blank><IMG alt=我要提问 src="ask_star.files/img2_tw.gif" 
            width=138 border=0></A></TD>
        </TR></TBODY></TABLE>
      </TD>
  </TR></TBODY></TABLE><BR>

</BODY></HTML>
