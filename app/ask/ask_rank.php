<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
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
      src="ask_rank.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD noWrap width=25></TD>
    <TD vAlign=top>
      <?php require_once("include/top_right_nav.php");?><BR clear=all>
      <?php  require_once("include/main_form.php");?></TD></TR></TBODY></TABLE>
<!-- LOGO & 搜索框 end -->
<!-- navigation begin -->
<TABLE class="f13 cc" cellSpacing=0 cellPadding=0 width="100%" 
background=ask_rank.files/bg_nav_30.gif border=0>
  <TBODY>
  <TR vAlign=bottom align=middle>
    <TD width=20 height=23></TD>
    <TD width=1>|</TD>
    <TD noWrap width="5%"><A class=nav 
    href="index.php">首页</A></TD>
    <TD width=1>|</TD>
    <TD noWrap width="7%"><A class=nav 
      href="ask_class.php">问题分类</A></TD>
    <TD width=3><IMG src="ask_rank.files/nav_left.gif" border=0></TD>
    <TD noWrap width="9%" background=ask_rank.files/bg_nav_sy.gif 
    bgColor=#ffc52e><B class="cf fs13">问题排行榜</B></TD>
    <TD width=3><IMG src="ask_rank.files/nav_right.gif" border=0></TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_star.php">用户榜</A></TD>
    <TD width=1>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_expert.php">专家团</A></TD>
    <TD width=1>|</TD>
    <TD align=right><A 
      href="user.php" 
      target=_blank><IMG height=19 src="ask_rank.files/grzx.gif" width=78 
      border=0></A></TD>
    <TD width=15></TD></TR>
  <TR>
    <TD colSpan=6 height=7></TD>
    <TD align=middle><IMG src="ask_rank.files/yellow_xjt.gif" border=0></TD>
    <TD></TD></TR></TBODY></TABLE>
<!-- navigation end --><!-- decoration bar begin -->
<TABLE cellSpacing=0 cellPadding=0 width="97%" align=center border=0>
  <TBODY>
  <TR vAlign=top>
    <TD>
      <TABLE width="100%" border=0>
        <TBODY>
        <TR>
          <TD class="f13 c6" height=30><A class=a05 
            href="http://iask.sina.com.cn/">知识人</A> &gt; 
      问题排行榜</B></TD></TR></TBODY></TABLE><!-- decoration bar end -->
      <TABLE border=0>
        <TBODY>
        <TR>
          <TD width=15><IMG src="ask_rank.files/i12.gif" border=0></TD>
          <TD class="f12 c9" height=40>回答问题，帮助别人，还能赢积分！</TD>
        </TR></TBODY></TABLE>
      <?php if($_REQUEST['list_for']=="new"||!isset($_REQUEST['list_for'])) {?>
	  <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
      background=ask_rank.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>          
		  <TD width=3><IMG height=30 src="ask_rank.files/lb_t_l.gif" width=3  
            border=0></TD>          
		  <TD noWrap width="12%" background=ask_rank.files/lb_t_bg.gif>
		  <DIV><B><FONT color=#336600>最新问题</FONT></B></DIV>
		  </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_lt_rl.gif" width=8 
            border=0></TD>
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
           <DIV><A href="?list_for=zero">零回答问题</A></DIV>
		   </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=top">推荐问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=score">高分问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=fin">已解决问题</A></DIV></TD>
          <TD width=3><IMG height=30 src="ask_rank.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
		 <?php } elseif($_REQUEST['list_for']=="zero") { ?>
		  <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
		  background=ask_rank.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>          
		  <TD width=3><IMG height=30 src="ask_rank.files/lb_l_l.gif" width=3  
            border=0></TD>          
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
		  <DIV><a href="?list_for=new">最新问题</a></DIV>
		  </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rt.gif" width=8 
            border=0></TD>
		  <TD noWrap width="12%" background=ask_rank.files/lb_t_bg.gif>
           <DIV><B><FONT color=#336600>零回答问题</FONT></B></DIV>
		   </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_lt_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=top">推荐问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=score">高分问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=fin">已解决问题</A></DIV></TD>
          <TD width=3><IMG height=30 src="ask_rank.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
		 <?php } elseif($_REQUEST['list_for']=="top") {?>
		 <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
		  background=ask_rank.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>          
		  <TD width=3><IMG height=30 src="ask_rank.files/lb_l_l.gif" width=3  
            border=0></TD>          
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
		  <DIV><a href="?list_for=new">最新问题</a></DIV>
		  </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
           <DIV><a href="?list_for=zero">零回答问题</a></DIV>
		   </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rt.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_t_bg.gif>
            <DIV><B><FONT color=#336600>推荐问题</FONT></B></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_lt_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=score">高分问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=fin">已解决问题</A></DIV></TD>
          <TD width=3><IMG height=30 src="ask_rank.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
		 <?php } elseif($_REQUEST['list_for']=="score") {?>
		 <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
		  background=ask_rank.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>          
		  <TD width=3><IMG height=30 src="ask_rank.files/lb_l_l.gif" width=3  
            border=0></TD>          
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
		  <DIV><a href="?list_for=new">最新问题</a></DIV>
		  </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
           <DIV><a href="?list_for=zero">零回答问题</a></DIV>
		   </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rt.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=top">推荐问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rt.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_t_bg.gif>
            <DIV><B><FONT color=#336600>高分问题</FONT></B></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_lt_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=fin">已解决问题</A></DIV></TD>
          <TD width=3><IMG height=30 src="ask_rank.files/lb_l_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
		 <?php } elseif($_REQUEST['list_for']=="fin") { ?>
		 <TABLE class="f14 lb_tt" cellSpacing=0 cellPadding=0 width="100%" 
		  background=ask_rank.files/lb_bg.gif border=0>
        <TBODY>
        <TR align=middle>          
		  <TD width=3><IMG height=30 src="ask_rank.files/lb_l_l.gif" width=3  
            border=0></TD>          
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
		  <DIV><a href="?list_for=new">最新问题</a></DIV>
		  </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
		  <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
           <DIV><a href="?list_for=zero">零回答问题</a></DIV>
		   </TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=top">推荐问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rl.gif" width=8 
            border=0></TD>
          <TD width="12%" noWrap background=ask_rank.files/lb_l_bg.gif>
            <DIV><A 
            href="?list_for=score">高分问题</A></DIV></TD>
          <TD width=8><IMG height=30 src="ask_rank.files/lb_ll_rt.gif" width=8 
            border=0></TD>
          <TD noWrap width="12%" background=ask_rank.files/lb_t_bg.gif>
            <DIV><B><FONT color=#336600>已解决问题</FONT></B></DIV></TD>
          <TD width=3><IMG height=30 src="ask_rank.files/lb_t_r.gif" width=3 
            border=0></TD>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
		 <?php } ?>
		  
      <TABLE class=f12 cellSpacing=0 cellPadding=0 width="100%" 
      background=ask_rank.files/lb_wt_t_bg.gif border=0>
        <TBODY>
        <TR>
          <TD width=12 background=ask_rank.files/lb_wt_l.gif height=27><IMG 
            height=3 src="ask_rank.files/lb_wt_l.gif" width=12 border=0></TD>
          <TD>标题</TD>
          <TD width=130>提问时间</TD>
          <TD width=80>提问者</TD>
          <TD width=12 background=ask_rank.files/lb_wt_r.gif><IMG height=3 
            src="ask_rank.files/lb_wt_r.gif" width=12 
      border=0></TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=bottom width=12 
            background=ask_rank.files/lb_wt_l.gif><IMG height=3 
            src="ask_rank.files/lb_wt_lb.gif" width=12 border=0></TD>
          <TD style="BORDER-TOP: #ebf5e2 1px solid" vAlign=top 
            height=600>
			<?php if(isset($_POST['key'])) {?>
			<iframe id=ifra name=ifram 
            src="ask_rank.files/question_list.php?list_for=<?=$_REQUEST['list_for']?>&key=<?=$_POST['key']?>" frameborder=0 width="100%" 
            scrolling=no height=600></iframe>
			<?php } else { ?>
			<iframe id=ifra name=ifram 
            src="ask_rank.files/question_list.php?list_for=<?=$_REQUEST['list_for']?>" frameborder=0 width="100%" 
            scrolling=no height=600></iframe>
			<?php } ?>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD background=ask_rank.files/lb_wt_b.gif colSpan=9 
                  height=3><IMG src="ask_rank.files/lb_wt_b.gif" 
              border=0></TD></TR></TBODY></TABLE></TD>
          <TD vAlign=bottom width=12 
            background=ask_rank.files/lb_wt_r.gif><IMG height=3 
            src="ask_rank.files/lb_wt_rb.gif" width=12 
      border=0></TD></TR></TBODY></TABLE>
      <TABLE cellPadding=8 width="100%" border=0>
        <TBODY>
        <TR>
          <TD align=right><A class=f14 
            href="post.php" 
            target=_blank>我要提问&gt;&gt;</A></TD>
        </TR></TBODY></TABLE></TD>
    <TD width="2%">&nbsp;</TD>
    <TD width="175"><BR>
      <TABLE class=mb7 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
          <TR>
            <TD align=middle><A 
            href="post.php" 
            target=_blank><IMG id=newImag alt=我要提问 
            src="ask_rank.files/img2_tw.gif" width=138 border=0></A> </TD>
          </TR>
        </TBODY>
      </TABLE>
      <!-- Ask Button End -->
      <!-- ask button end -->
      <!-- bulletin begin -->
      <TABLE class=f12 style="BORDER-LEFT: #eeeeee 1px solid" cellSpacing=1 
      cellPadding=0 width="100%" align=center border=0>
        <TBODY>
          <TR>
            <TD class=r_tt align=middle height=26><B class=f14>知识人得分排名</B></TD>
          </TR>
          <TR>
            <TD height=5></TD>
          </TR>
          <TR>
            <TD class=lh15><TABLE class=c9 cellSpacing=0 cellPadding=5 width="100%" 
            align=center border=0>
                <TBODY>
      <?php 
	  $query="select * from ".$table_suffix."ask_score  order by income desc limit 0,6";
	  $result_score=mysql_query($query);
	  while($row_score=mysql_fetch_object($result_score)) { 
	  $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
	  $result=mysql_query($query);
	  $row=mysql_fetch_object($result);
      ?>
     <TR><TD width=110><SPAN class=f10>·</SPAN> <A class=c3ul href=user_infor.php?user_id=<?=$row->id?>" target=_blank><?=$row->nick_name?></A></TD>
     <TD noWrap><FONT color=black><SPAN style="COLOR: #00ff00">→</SPAN><?=$row_score->income?></FONT></TD>
     </TR>
                  <?php } ?>
                </TBODY>
            </TABLE>
                <TABLE width="98%" align=right border=0>
                  <TBODY>
                    <TR>
                      <TD style="BORDER-BOTTOM: #ccc 1px dashed" height=1><IMG 
                  src="ask_rank.files/blank.gif"></TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
      <!-- bulletin end -->
      <!-- recommand begin -->
      </TD>
  </TR></TBODY>
        <TR>
          <TD colSpan=9 height=5></TD></TR></TBODY></TABLE>
<!-- login end --><!-- ask button begin --><!-- Ask Button Begin -->
<BR>
<!-- recommand end --><!-- content end --><BR></TD></TR></TBODY><!-- 尾部 begin --><!--开始：底部--><!-- 尾部 begin --><BR>
<?php require_once("htm/foot.htm");?>
</BODY></HTML>
