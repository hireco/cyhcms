<DIV>
      <DIV class=user_pic>
    <?php   require_once(dirname(__FILE__)."/ask_level.php");
			 $friend_list=$row->friend_list;
			 $img_default="user.files/120_1570632011.gif";
			 $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
	?>
     <table  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
       <tr>
       <td bgcolor="#FEFEFE"><div align="center">
	   <a href="../user_infor.php?view=profile&host_id=<?=$row->id?>&idkey=<?=$idkey?>"><img src="<?=$sample_pic?>"  alt="�˽�����" border="0"  >	   </a></div></td>
       </tr>
       </table>
	  <br>
	  <A href="../blog_inc/add_friend.php?host_id=<?=$row->id?>&idkey=<?=$idkey?>" target="_blank" class=c07f>��Ϊ����</A> <A href="../user_infor.php?view=liuyan&host_id=<?=$row->id?>&idkey=<?=$idkey?>#say" target="_blank" class=c07f>��������</A> </DIV>
      <DIV class=user_detail>
      <H3><?=$row->nick_name?></H3>
      <DIV class=user_fg>���ı�ţ�<?=$row->id?><BR>
	  ��&nbsp;&nbsp;&nbsp;&nbsp;��<?=$row->sex=="m"?"<font color=blue>��</font>":"<font color=red>Ů</font>";?> <BR>
      <DIV id=div_birth>�������ڣ�<?=$row->birthday?><BR>
	  </DIV>
      <DIV id=div_from>��&nbsp;&nbsp;&nbsp;&nbsp;�ԣ�<?=$row->district?><BR></DIV>
      <DIV id=div_email style="DISPLAY: <?=$row->email_keep=="1"?"none":"block"?>">��&nbsp;&nbsp;&nbsp;&nbsp;�䣺<?=$row->email?>   </DIV></DIV>
      <?php 
	  $query="select * from ".$table_suffix."ask where poster='{$row->user_name}'"; 
	  $result_ask=mysql_query($query);
	  $num_ask=mysql_num_rows($result_ask);
	  
	  $query="select * from ".$table_suffix."ask_answer where poster='{$row->user_name}'"; 
	  $result_answer=mysql_query($query);
	  $num_answer=mysql_num_rows($result_answer);
	  
	  $query="select * from ".$table_suffix."ask_answer where poster='{$row->user_name}' and accept='1'"; 
	  $result_accept=mysql_query($query);
	  $num_accept=mysql_num_rows($result_accept);
	  
	  $right_percent=100*($num_accept*1.0)/($num_answer*1.0);
	  if($right_percent==NULL) $right_percent=0;
	  
	  $query="select * from  ".$table_suffix."ask_score where user_name='{$row->user_name}'";
	  $result_score=mysql_query($query);
	  $score_row=mysql_fetch_object($result_score);
	  $income=$score_row->income;
	  $payout=$score_row->payout;
	  ?>
	  <DIV class="pt10 c333">
	  ��&nbsp;&nbsp;&nbsp;&nbsp;�֣�<?=$income-$payout?><BR>
	  ��&nbsp;&nbsp;&nbsp;&nbsp;��<?php echo $mem_level[$row->user_level]; ?> ֪ʶ����<?=get_user_title($income)?><BR>
      �� �� ����<?=$num_ask?><BR>
	  �� �� ����<?=$num_answer?><BR>
	  �� �� �ʣ�<?=substr($right_percent,0,6)?>%<BR>
	  �ó�����<?=$score_row->major==""?"���ó�����":$score_row->major ?><BR>
	  </DIV></DIV>
      </DIV>
