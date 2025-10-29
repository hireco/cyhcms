<?php 
  require_once("../../config/base_cfg.php");
  require_once("../../config/auto_set.php"); 
  require_once(dirname(__FILE__)."/../include/cutoff.php");
  require_once(dirname(__FILE__)."/../../dbscripts/db_connect.php"); 
  if($_REQUEST['list_for']=="zero")       $query="select * from  ".$table_suffix."ask  where daan_num=0 and hide='0' order by post_time desc";
  elseif($_REQUEST['list_for']=="top")    $query="select * from  ".$table_suffix."ask  where hide='0' order by top desc,top_time desc";
  elseif($_REQUEST['list_for']=="score")  $query="select * from  ".$table_suffix."ask  where hide='0'  order by score desc";
  elseif($_REQUEST['list_for']=="fin")    $query="select * from  ".$table_suffix."ask  where finished='1' and hide='0' order by post_time desc";
  elseif($_REQUEST['list_for']=="key")    $query="select * from  ".$table_suffix."ask  where question like '%{$_REQUEST['key']}%' and hide='0' order by post_time desc";
  else  $query="select * from  ".$table_suffix."ask  where hide='0' order by post_time desc";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>问题排行榜</TITLE>
<META http-equiv=Content-type content="text/html; charset=gb2312"><LINK 
href="../style/zhishi_style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">
<CENTER>
<TABLE class="f12 c6 lh25" cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <?php 
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $per_page_num=15;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
   for($i=1;$i<=$per_page_num;$i++) {
	   if($row_q=@mysql_fetch_object($rows))
		{  
		   $query="select * from  ".$table_suffix."member where user_name='{$row_q->poster}'";
		   $result=mysql_query($query);
		   $nick_name=mysql_result($result,0,"nick_name");
		   $user_id=mysql_result($result,0,"id");
		   
		?>
  <TR>
    <TD noWrap width=100>
      <DIV class="f14 c3">[<A title=<?=$row_q->section?> class=c3nul href="../ask_point.php?section=<?=urlencode($row_q->section)?>&chapter=<?=urlencode($row_q->chapter)?>&part=<?=urlencode($row_q->part)?>" 
      target=_top><?=msubstr($row_q->section,0,10)?></A>] </DIV></TD>
    <TD width="90%"><A class=f14 title="<?=$row_q->question?>" 
      href="../question.php?id=<?=$row_q->id?>"  target=_blank><?=$row_q->question?></A><IMG height=12 
      src="new_question.files/money.gif" width=12 align=absMiddle border=0> 
    <?=$row_q->score?>分</TD>
    <TD noWrap width=140><?=$row_q->post_time?></TD>
    <TD noWrap width=80><A class=c6nul 
      href="../user_infor.php?user_id=<?=$user_id?>" 
      target=_blank><?=$nick_name?></A></TD></TR>
  <TR>
    <TD background=new_question.files/line_g.gif colSpan=9 height=1><IMG 
      src="new_question.files/line_g.gif"></TD>
  </TR> 
  <?php } 
     }
  ?>
  <TR>
    <TD align=middle colSpan=9 height=60>
	<?php require_once("../include/page_devide.php");?>
	</TD></TR></TBODY></TABLE>
</CENTER></BODY></HTML>
