<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once("../inc/show_msg.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  if(!isset($_REQUEST['part']))  ShowMsg("错误的分类！",-1);
  else {
    if(!isset($_REQUEST['chapter']))  ShowMsg("错误的分类！",-1);
    else { 	
	 if(!isset($_REQUEST['section']))  ShowMsg("错误的分类！",-1);
       else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$_REQUEST['section']?>-物理知识系统-<?=$cfg_site_name?></TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/z2.css" type=text/css rel=stylesheet><LINK 
href="style/grzx_v2.css" type=text/css rel=stylesheet><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<DIV id=head>
<DIV class="fl hd1"><A href="./"><IMG height=45 alt=爱问知识人 
src="user.files/z2_logo.gif" width=145 border=0></A></DIV>
<?php  if(isset($_SESSION['user_name'])) { ?>
<DIV class=fr 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; Z-INDEX: 11; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; POSITION: relative"><FONT 
color=#000000>您好，</FONT><A href="../member.php"><?=$_SESSION['user_name']?></A><SPAN 
class=c9 style="MARGIN: 10px">|</SPAN><A 
href="../logout.php">退出</A><SPAN 
class=c9 style="MARGIN: 10px">|</SPAN> <A title=知识人首页 
href="./" target=_blank>知识人首页</A> </DIV>
<?php } ?>
<DIV class=cb></DIV></DIV>
<DIV id=nav>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 52px"><A title=首页 
href="./">首页</A></DIV>
  <DIV class=fl><IMG height=29 src="ask_class.files/v2_nav_l.gif" width=2></DIV>
  <DIV class="fl nav_n" title=问题分类 style="WIDTH: 78px">问题分类</DIV>
  <DIV class=fl><IMG height=29 src="ask_class.files/v2_nav_r.gif" width=2></DIV>
  <DIV class=fl style="WIDTH: 91px"><A title=问题排行榜 
href="ask_rank.php">问题排行榜</A></DIV>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 65px"><A title=用户榜 
href="ask_star.php">用户榜</A></DIV>
  <DIV class=fl>|</DIV>
  <DIV class=fl style="WIDTH: 65px"><A title=专家团 
href="ask_expert.php">专家团</A></DIV>
<DIV class=fr style="PADDING-TOP: 4px"><A title=个人中心 
href="user.php"><IMG height=19 
src="ask_class.files/grzx.gif" width=78 border=0></A></DIV>
  <DIV class=cb></DIV>
</DIV>
<DIV id=nav2><A title=问题分类 
href="ask_class.php">问题分类</FONT></A>&nbsp;&gt;&nbsp;<A href="ask_chapter.php?part=<?=urlencode($_REQUEST['part'])?>"><?=$_REQUEST['part']?></A> 
&nbsp;&gt;&nbsp;<A href="ask_section.php?part=<?=urlencode($_REQUEST['part'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>"><?=$_REQUEST['chapter']?></A>&nbsp;&gt;&nbsp;<A href="ask_point.php?part=<?=urlencode($_REQUEST['part'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&section=<?=urlencode($_REQUEST['section'])?>"><?=$_REQUEST['section']?></A>
&nbsp;&gt;&nbsp;<?=$_REQUEST['point']?>
</DIV>
<DIV id=main>
  <DIV class=fl style="WIDTH: 690px">
    <DIV class=xy1 id=fl_t>
      <DIV class=fl><A href="javascript:open_close(fl_xx,fl_img);void(0);"><IMG 
id=fl_img height=25 src="ask_class.files/fl_jh1.gif" width=18 
border=0></A></DIV>
      <DIV class=fl id=fl_tt><B><?=$_REQUEST['section']?></B></DIV>
      <DIV class=cb></DIV>
    </DIV>    
    <DIV class=p150>
      <DIV class="fl c9"><IMG src="ask_class.files/i12.gif" align=absMiddle> 回答问题，帮助别人，还能赢积分！</DIV>
      <DIV class=cb></DIV>
    </DIV>
    <?php 
	  if((!isset($_REQUEST['list_for']))||($_REQUEST['list_for']=="unf"))
	  $query="select * from ".$table_suffix."ask where chapter='{$_REQUEST['chapter']}' and section='{$_REQUEST['section']}' and points
	  like '%{$_REQUEST['point']}%' and finished='0' and hide='0' order by id desc";
	  else if($_REQUEST['list_for']=="fed")
	  $query="select * from ".$table_suffix."ask where chapter='{$_REQUEST['chapter']}' and section='{$_REQUEST['section']}' and points
	  like '%{$_REQUEST['point']}%' and finished='1' and hide='0' order by id desc";
	  else if($_REQUEST['list_for']=="rec")
	  $query="select * from ".$table_suffix."ask where chapter='{$_REQUEST['chapter']}' and section='{$_REQUEST['section']}' and points
	  like '%{$_REQUEST['point']}%' and hide='0' order by top_time desc";
	?>
    <DIV class="f14 xy1" align=center>
      <?php if((!isset($_REQUEST['list_for']))||($_REQUEST['list_for']=="unf")) { ?>
	  <P class=fl_on id=flk1 >待解决问题</P>
      <P class=fl_of id=flk5 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=fed>已解决问题</A></P>
      <P class=fl_of id=flk6 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=rec>推荐问题</A></P>
	  <?php } 
	   elseif($_REQUEST['list_for']=="fed") { ?>
	  <P class=fl_of id=flk1 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=unf>待解决问题</A></P>
      <P class=fl_on id=flk5 ><A href=>已解决问题</A></P>
      <P class=fl_of id=flk6 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=rec>推荐问题</A></P>
	   <?php }
	   elseif($_REQUEST['list_for']=="rec") { ?>
	  <P class=fl_of id=flk1 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=unf>待解决问题</A></P>
      <P class=fl_of id=flk5 ><A href=?point=<?=urlencode($_REQUEST['point'])?>&section=<?=urlencode($_REQUEST['section'])?>&chapter=<?=urlencode($_REQUEST['chapter'])?>&part=<?=urlencode($_REQUEST['part'])?>&list_for=fed>已解决问题</A></P>
      <P class=fl_on id=flk6 ><A href=>推荐问题</A></P>
	   <?php } ?>
      <P class=cb></P>
    </DIV>
    <DIV class="b1_e0 lh25">
      <DIV 
style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px">
   <?php 
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $per_page_num=10;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
   ?>	
   <DIV id=questionlist>
          <DIV class=bb1e>
            <P class="fl w1">标题</P>
            <P class="fl o" style="WIDTH: 380px"></P>
            <P class="fl w50" align=center>回答数</P>
            <P>时 间 提问者</P>
            <P class=cb></P>
          </DIV>
          <?php 
	  for($i=1;$i<=$per_page_num;$i++) {
	   if($row_q=@mysql_fetch_object($rows))
		{  $query="select * from ".$table_suffix."member where user_name='{$row_q->poster}'";
		   $result_id=mysql_query($query);
		   $userid=mysql_result($result_id,0,"id");
		   $usernick=mysql_result($result_id,0,"nick_name");
		   
		   $query="select id from ".$table_suffix."ask_answer where question_id={$row_q->id}";
		   $result_answer=mysql_query($query);
		   $answer_num=@mysql_num_rows($result_answer);
		  ?>
		  <DIV class=bb1de>
            <P class="fl w1 f14">[<A class=c7fn 
href="ask_point.php?part=<?=urlencode($row_q->part)?>&chapter=<?=urlencode($row_q->chapter)?>&section=<?=urlencode($row_q->section)?>"><?=$row_q->section?></A>]</P>
            <P class="fl o" style="WIDTH: 380px"><A class=f14a 
href="question.php?id=<?=$row_q->id?>" target=_blank><?=substr($row_q->question,0,50)?></A> </P>
            <P class="fl w50 c9" align=center><B class=o><?=$answer_num?></B></P>
            <P><font color=gray><?=substr($row_q->post_time,9,5)?></font> <A class=c7fn 
href="user_infor.php?user_id=<?=$userid?>" 
target=_blank><?=$usernick?></A></P>
            <P class=cb></P>
          </DIV>
		  <?php } 
		    }
		  ?>
        </DIV>
        <DIV class="f14 p4" id=questionpages align=center><?php require_once("include/page_devide.php");?></DIV>
      </DIV>
    </DIV>
    <DIV class=p10 align=right><A class=f14 title=我要提问 
href="post.php" 
target=_blank>我要提问&gt;&gt;</A></DIV>
  </DIV>
  <DIV class=fr style="WIDTH: 237px">
    <DIV>
        <DIV>
          <DIV id=i_l>
<DIV class=mb15>
<DIV class=i_lt>
<DIV class=p_it><A class=c3u title=问题分类 
href="ask_class.php" target=_blank><B 
class=f14>问题分类</B></A></DIV></DIV>
<?php 
  $query="select * from ".$table_suffix."chapter group by part_name order by top_time desc";
  $result=mysql_query($query);
?>
<DIV class="b1_e0_lr lh15">
<DIV class=p_im>
<?php while($row=mysql_fetch_object($result)) {
	   $query="select * from ".$table_suffix."chapter where  part_name='{$row->part_name}'";
	   $result_chapter=mysql_query($query);
?>
<A title=<?=$row->part_name?> 
href="ask_chapter.php?part=<?=urlencode($row->part_name)?>"><B 
class=f14><?=$row->part_name?></B></A><br>
<?php 
$i=1;
while(($row_chapter=mysql_fetch_object($result_chapter))&&($i<=5)) { ?>
<A title=<?=$row_chapter->chapter_name?> 
href="ask_section.php?part=<?=urlencode($row->part_name)?>&chapter=<?=urlencode($row_chapter->chapter_name)?>"><?=$row_chapter->chapter_name?></A> 
<?php 
  $i++;
} 
?>
<a href="ask_chapter.php?part=<?=urlencode($row->part_name)?>" class="f10"> &raquo;</a>
<DIV class=i_ld></DIV>
<?php } ?>
</DIV>
</DIV>
</DIV>
<DIV class=mb15><DIV class="b1_e0_lr lh15"><DIV class=p_im></DIV>
</DIV>
<DIV><IMG height=3 
src="index.files/z2_i_lb(1).gif" 
width=237></DIV></DIV>
<DIV class=mb15>
<DIV class=i_lt>
<DIV class=p_it><A class=c3u title=推荐分类 
href="ask_rank.php?list_for=top" 
target=_blank><B class=f14>推荐分类</B></A></DIV></DIV>
<?php 
  $query="select * from ".$table_suffix."chapter order by top_time desc limit 0,1";
  $result=mysql_query($query);
  $row_top=mysql_fetch_object($result);
?>
<DIV class=b1_e0_lr>
<DIV class=p_im>
<DIV class=fl><A title=<?=$row_top->chapter_name?> href="ask_section.php?part=<?=urlencode($row_top->part_name)?>&chapter=<?=urlencode($row_top->chapter_name)?>" 
target=_blank><IMG src="index.files/1127.jpg" 
width=80 height=60 hspace="5" class=img1></A></DIV>
<DIV class=fl></DIV>
<DIV class=fl style="WIDTH: 120px">
<P class="mb8 f14"><A title=<?=$row_top->chapter_name?> 
href="ask_section.php?part=<?=urlencode($row_top->part_name)?>&chapter=<?=urlencode($row_top->chapter_name)?>" 
target=_blank><?=$row_top->chapter_name?></A></P>
<?php 
  $query="select * from ".$table_suffix."ask where chapter='{$row_top->chapter_name}' order by top_time desc limit 0,8";
  $result=mysql_query($query);
  if($row_top2=mysql_fetch_object($result)) {
?>
<P><A title=<?=$row_top2->question?> href="question.php?id=<?=$row_top2->id?>" target=_blank><?=$row_top2->question?></A></P>
<?php } 
else {
?>
<P>目前没有提问</P>
<?php } ?>
</DIV>
<DIV class="cb mb8"></DIV>
<?php while($row_top2=mysql_fetch_object($result)) { ?>
<P class="cc mb8">·<A title=<?=$row_top2->question?> href="question.php?id=<?=$row_top2->id?>" target=_blank><?=$row_top2->question?></A></P>
<?php } ?>
</DIV></DIV>
<DIV><IMG height=3 src="index.files/z2_i_lb.gif" width=237></DIV></DIV></DIV>
        </DIV>
      <BR>
    </DIV>
    <DIV style="TEXT-ALIGN: center"></DIV>
  </DIV>
  <DIV class=cb></DIV>
</DIV>
<DIV id=btm align=center>
  <DIV class=btm1>意见反馈 - 关于本站 - 加入收藏 - 友情链接</DIV>
  <DIV class=btm2>&copy; 2008
    <?=$cfg_site_name?>
    免责声明</DIV>
</DIV>
</BODY></HTML>
<?php } 
    }
  }
?>