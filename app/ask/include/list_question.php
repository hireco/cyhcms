<?php 
  if($_SESSION['user_name']==$row->user_name) { 
  $for_who=$_SESSION['user_name'];
  $query="select * from ".$table_suffix."ask where poster='{$for_who}' order by id desc";
  }
  else { 
  $for_who=$row->user_name;
  $query="select * from ".$table_suffix."ask where poster='{$for_who}' and hide='0' order by id desc";
  }
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
<DIV class=cont>
  <DIV id=askNav>
    <UL class=on>
      <LI class=imgl></LI>
      <LI class=text><?=$who?>������(<?=$num?>)</LI>
      <LI class=imgr></LI>
    </UL>
    <DIV class=cb></DIV>
  </DIV>
  <DIV id=List>
    <UL class=aTitle>
      <LI class=category>���� </LI>
      <LI class=heading>���� </LI>
      <LI class=state>״̬ </LI>
      <LI class=date>����ʱ�� </LI>
      <LI class=ansNum>�ش��� </LI>
    </UL>
    <?php 
	  for($i=1;$i<=$per_page_num;$i++) {
	   if($row_q=@mysql_fetch_object($rows))
		{ 
		 $query="select id from ".$table_suffix."ask_answer where question_id={$row_q->id}";
         $num_of_answer=mysql_num_rows(mysql_query($query));
	 ?>
	<UL class=aList>
      <LI class=category>[<A class=c7fn 
        href="ask_point.php?section=<?=urlencode($row_q->section)?>&chapter=<?=urlencode($row_q->chapter)?>&part=<?=urlencode($row_q->part)?>" 
        target=_blank><?=$row_q->section?></A>] </LI>
      <LI class=heading><A class=f14 title="<?=$row_q->question?>" 
        href="question.php?id=<?=$row_q->id?>" target=_blank><?=$row_q->question?> </A><IMG height=12 src="user.files/money.gif" width=12 align=absMiddle 
        border=0> <?=$row_q->score?>�� </LI>
      <LI class=state><IMG height=15 src="index.files/zt_<?=$row_q->finished=="0"?"jjz":"yjj"?>.gif" width=41 
        border=0> </LI>
      <LI class=date><?=substr($row_q->post_time,0,8)?> </LI>
      <LI class=ansNum><?=$num_of_answer?> </LI>
    </UL>
	<?php } 
	  }
	?>
  </DIV>
</DIV>
<table width="100%" border="0">
        <tr>
          <td><?php require_once("include/page_devide.php");?></td>
        </tr>
      </table>

