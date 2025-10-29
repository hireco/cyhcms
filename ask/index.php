<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  require_once(dirname(__FILE__)."/../inc/find_cookie.php");
  require_once("../".$cfg_admin_root."scripts/constant.php");
  require_once("include/set_score.php");  
  require_once(dirname(__FILE__)."/include/ask_level.php"); 
  require_once(dirname(__FILE__)."/include/cutoff.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> - 问答知识系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK href="style/z2.css" type=text/css rel=stylesheet><LINK 
href="style/grzx_v2.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<DIV id=head>
<DIV class="fl hd1"><A href="./"><IMG height=45 alt=物理知识人 
src="index.files/z2_logo.gif" width=145 border=0></A></DIV>
<DIV class="fr hd3"><A title=返回首页 href="<?=$cfg_mainsite?>">返回首页</A></DIV>
<DIV class=cb></DIV></DIV>
<DIV id=nav>
<DIV class=fl><IMG height=29 src="index.files/v2_nav_l.gif" width=2></DIV>
<DIV class="fl nav_n" title=首页 style="WIDTH: 52px">首页</DIV>
<DIV class=fl><IMG height=29 src="index.files/v2_nav_r.gif" width=2></DIV>
<DIV class=fl style="WIDTH: 78px"><A title=问题分类 
href="ask_class.php">问题分类</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 91px"><A title=问题排行榜 
href="ask_rank.php">问题排行榜</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 65px"><A title=用户榜 
href="ask_star.php">用户榜</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fl style="WIDTH: 65px"><A title=专家团 
href="ask_expert.php">专家团</A></DIV>
<DIV class=fl>|</DIV>
<DIV class=fr style="PADDING-TOP: 4px"><A title=个人中心 
href="user.php" target=_blank><IMG 
height=19 src="index.files/grzx.gif" width=78 border=0></A></DIV>
<DIV class=cb></DIV></DIV>
<DIV class=i_s style="WIDTH: 1003px" align=center>
<?php  require_once("include/main_form.php");?>
</DIV>
<DIV id=main>
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
<DIV id=i_m>
<DIV class=mb15>
<DIV class=i_mt>
<DIV class=p_it>
<P class=fl>
<A class=c3u title=推荐问题 href="ask_rank.php?list_for=top"  target=_blank><B class=f14>推荐问题</B></A>
</P>
<P class=fr><A title=更多 
href="ask_rank.php?list_for=top" 
target=_blank>更多<SPAN class=f10>&gt;&gt;</SPAN></A></P>
<P class=cb></P></DIV></DIV>
<?php 
  $query="select * from  ".$table_suffix."ask where hide='0' order by top desc, top_time desc limit 0, 5";
  $result_top=mysql_query($query);
?>
<DIV class=b1_7b_lr>
<DIV class="f14 p_im2">
<?php while($row_top=mysql_fetch_object($result_top)) { ?>
<DIV class="p1 mb8">
<P class="fl w80">[<A class=c7fn title=<?=$row_top->section?> 
href="ask_point.php?part=<?=urlencode($row_top->part)?>&chapter=<?=urlencode($row_top->chapter)?>&section=<?=urlencode($row_top->section)?>"><?=msubstr($row_top->section,0,8)?><SPAN 
class=ar></SPAN></A>]</P>
<P class="fl w300"><A title=<?=$row_top->question?> 
href="question.php?id=<?=$row_top->id?>" 
target=_blank><?=$row_top->question?></A></P>
<P class="fl w50"><IMG alt=<?=$row_top->finished=="0"?"解决中":"已解决"?> src="index.files/zt_<?=$row_top->finished=="0"?"jjz":"yjj"?>.gif"></P>
<P class=cb></P></DIV>
<?php } ?>
</DIV></DIV>
<DIV style="height:3px; width:455px;background-image:url(index.files/z2_i_mb.gif); background-position:top; background-repeat:no-repeat;"></DIV></DIV>
<DIV class=mb15>
<DIV class=i_mt>
<DIV class=p_it>
<P class=fl><A class=c3u title=最新问题 
href="ask_rank.php?list_for=new" 
target=_blank><B class=f14>最新问题</B></A></P>
<P class=fr><A title=更多 
href="ask_rank.php?list_for=new" 
target=_blank>更多<SPAN class=f10>&gt;&gt;</SPAN></A></P>
<P class=cb></P></DIV></DIV>
<?php 
  $query="select * from  ".$table_suffix."ask where hide='0' order by post_time desc limit 0, 15";
  $result_top=mysql_query($query);
?>
<DIV class=b1_7b_lr>
<DIV class="f14 p_im2">
<?php while($row_top=mysql_fetch_object($result_top)) { ?>
<DIV class="p1 mb8">
<P class="fl w80">[<A class=c7fn title=<?=$row_top->section?> 
href="ask_point.php?part=<?=urlencode($row_top->part)?>&chapter=<?=urlencode($row_top->chapter)?>&section=<?=urlencode($row_top->section)?>"><?=msubstr($row_top->section,0,8)?><SPAN 
class=ar></SPAN></A>]</P>
<P class="fl w300"><A title=<?=$row_top->question?> 
href="question.php?id=<?=$row_top->id?>" 
target=_blank><?=$row_top->question?></A></P>
<P class="fl w50"><IMG alt=<?=$row_top->finished=="0"?"解决中":"已解决"?> src="index.files/zt_<?=$row_top->finished=="0"?"jjz":"yjj"?>.gif"></P>
<P class=cb></P></DIV>
<?php } ?>

</DIV></DIV>
<DIV style="height:3px; width:455px;background-image:url(index.files/z2_i_mb.gif); background-position:top; background-repeat:no-repeat;"></DIV></DIV>
<DIV class=mb15>
<DIV class=i_mt>
<DIV class=p_it>
<P class=fl><A class=c3u title=未解决的问题 
href="ask_rank.php?list_for=fin" 
target=_blank><B class=f14>已解决的问题</B></A></P>
<P class=fr><A title=更多 
href=ask_rank.php?list_for=fin 
target=_blank>更多<SPAN class=f10>&gt;&gt;</SPAN></A></P>
<P class=cb></P></DIV></DIV>

<?php 
  $query="select * from  ".$table_suffix."ask where finished='1' and hide='0' order by post_time desc limit 0, 5";
  $result_top=mysql_query($query);
?>
<DIV class=b1_7b_lr>
<DIV class="f14 p_im2">
<?php while($row_top=mysql_fetch_object($result_top)) { ?>
<DIV class="p1 mb8">
<P class="fl w80">[<A class=c7fn title=<?=$row_top->section?> 
href="ask_point.php?part=<?=urlencode($row_top->part)?>&chapter=<?=urlencode($row_top->chapter)?>&section=<?=urlencode($row_top->section)?>"><?=msubstr($row_top->section,0,8)?></SPAN></A>]</P>
<P class="fl w350"><A title=<?=$row_top->question?> 
href="question.php?id=<?=$row_top->id?>" 
target=_blank><?=$row_top->question?></A><SPAN class="f12 o"> <IMG 
src="index.files/money.gif" align=absMiddle><?=$row_top->score?>分</SPAN></P>
<P class=cb></P></DIV>
<?php } ?>

<DIV class="f12 c9 mr5" align=right><A class=cql title=新手问题 
href="ask_rank.php?list_for=new" 
target=_blank>新提问题</A> ┊ <A class=cql title=高分问题 
href="ask_rank.php?list_for=score" 
target=_blank>高分问题</A> ┊ <A class=cql title=零回答问题 
href="ask_rank.php?list_for=zero" 
target=_blank>零回答问题</A></DIV>
</DIV></DIV>
<DIV style="height:3px; width:455px;background-image:url(index.files/z2_i_mb.gif); background-position:top; background-repeat:no-repeat;"></DIV></DIV>
</DIV>
<DIV id=i_r>
<?php require_once("include/login_form.php");?>
<?php $query="select * from ".$table_suffix."ask_score where honor='1' order by honor_time desc limit 0, 1";
	   $result_score=mysql_query($query);
	   if($row_score=mysql_fetch_object($result_score)) { 
	   $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
	   $result=mysql_query($query);
	   $row=mysql_fetch_object($result);
	   $img_default="user.files/120_1570632011.gif";
	   $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
	        
	   $query="select * from ".$table_suffix."ask_answer where poster='{$row_score->user_name}' and accept='1'"; 
	   $result_accept=mysql_query($query);
	   $num_accept=mysql_num_rows($result_accept);
?>
<DIV class=mb15>
<DIV class=i_lt>
<DIV class="fl p_it"><A class=c3u title=最新荣誉知识人 
href="ask_expert.php" 
target=_blank><B class=f14>荣誉知识人</B></A></DIV>
<DIV class="fr p_it"><A title=更多 
href="ask_expert.php" 
target=_blank>更多<SPAN class=f10>&gt;&gt;</SPAN></A></DIV>
<DIV class=cb></DIV></DIV>
<DIV class=b1_e0_lr>
<DIV class="p_c lh15">
<DIV class="fl w80" align=center><A title=zyq135333 
href="user_infor.php?user_id=<?=$row->id?>" target=_blank><IMG 
class=img1 height=50 src="<?=$sample_pic?>" width=50></A></DIV>
<DIV class="fl w150"><A class=c7f title=zyq135333 
href="user_infor.php?user_id=<?=$row->id?>" 
target=_blank><?=$row->nick_name?></A><SPAN class=c9>[<?=get_user_title($row_score->income)?>]</SPAN><BR>
<?php $query="select part_name from ".$table_suffix."chapter where chapter_name='{$row_score->major}'";
	   $part_name=mysql_result(mysql_query($query),0,"part_name");
?>
专长：<A class=c6ul href="ask_section.php?part=<?=urlencode($part_name)?>&chapter=<?=urlencode($row_score->major)?>" target=_blank><?=$row_score->major?></A><BR>回答：<?=$num_accept?></DIV>
<DIV class=cb></DIV></DIV>
<DIV class="p_6 cc" style="PADDING-BOTTOM: 8px">
<?php 
  $i=1;
  while($row=mysql_fetch_object($result_accept)) { 
  if($i>6) break;
  $query="select * from ".$table_suffix."ask where id={$row->question_id} and hide='0'";
  $result_question=mysql_query($query);
  $question_id=mysql_result($result_question,0,"id");
  $question=mysql_result($result_question,0,"question");
?>
<P class=mb8>·<A href="question.php?id=<?=$question_id?>" 
target=_blank><?=$question?></A></P>
<?php 
 $i++;
} ?>
</DIV></DIV>
<DIV><IMG height=3 src="index.files/z2_i_lb.gif" width=237></DIV></DIV>
<?php } ?>
<DIV class=mb15 style="WIDTH: 236px">
<DIV class=f14 align=center>
  <DIV class=yhb_y1_on id=zx_t >最新得分排行</DIV>
<DIV class=cb></DIV></DIV>
<DIV class="b1_e0 yhb_y1_m" style="PADDING-TOP: 8px">
<DIV id=zx_d>
 <?php 
	$query="select * from ".$table_suffix."ask_score  order by income desc limit 0,6";
	$result_score=mysql_query($query);
	$i=1;
	while($row_score=mysql_fetch_object($result_score)) { 
	  $query="select * from ".$table_suffix."member where user_name='{$row_score->user_name}'";
	  $result=mysql_query($query);
	  $row=mysql_fetch_object($result);
 ?>
<DIV class=p_8>
<DIV class=i_y1>
<P class=i_n style="MARGIN-TOP: 0px">1</P></DIV>
<DIV class=i_y4><A class=c7f title=<?=$row->nick_name?> 
href="user_infor.php?user_id=<?=$row->id?>" 
target=_blank><?=$row->nick_name?></A></DIV>
<DIV class=i_y5><IMG height=9 src="index.files/z2_sj_1.gif" width=9> <B 
class=cql><?=$row_score->income?></B></DIV>
<DIV class=cb></DIV></DIV>
<?php } ?>
</DIV>
<DIV class=p_e align=right><A title=更多 
href="ask_star.php" target=_blank>更多<SPAN 
class=f10>&gt;&gt;</SPAN></A></DIV>
</DIV>
<DIV class=b1_e0_3></DIV>
<DIV class=b1_e0_4></DIV></DIV></DIV></DIV>
<DIV class=cb></DIV></DIV>
<DIV id=btm align=center>
<DIV class=btm1>意见反馈 - 关于本站 - 加入收藏 - 友情链接</DIV>
<DIV class=btm2>&copy; 2008 <?=$cfg_site_name?> 免责声明</DIV>
</DIV>
</BODY></HTML>
