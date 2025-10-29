<?php require_once(dirname(__FILE__)."/showmsg.php");
       require_once(dirname(__FILE__)."/ask_level.php");
?>
<?php showmsg("更新得分失败，请重来！","score_false"); ?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<DIV>
      <DIV class=user_pic>
    <?php  
			 if(isset($_REQUEST['major'])) { 
			 mysql_query("update ".$table_suffix."ask_score set major='{$_REQUEST['major']}' where user_name='{$_SESSION['user_name']}'");
			 echo "<script>parent.location.reload()</script>";
	         exit;
			 }
			 $friend_list=$row->friend_list;
			 $img_default="user.files/120_1570632011.gif";
			 $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
	?>
     <table  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
       <tr>
       <td bgcolor="#FEFEFE"><div align="center">
	   <a href="../user_infor.php?view=profile&host_id=<?=$_SESSION['user_id']?>&idkey=<?=md5($_SESSION['user_name'])?>"><img src="<?=$sample_pic?>"  alt="了解主人" border="0"  >	   </a></div></td>
       </tr>
       </table>
	  <br>
	  <A href="../amend_photo.php" target="_blank" class=c07f>修改头像</A> <A href="../amend_introduction.php" target="_blank" 
      class=c07f>修改个人资料</A> </DIV>
      <DIV class=user_detail>
      <H3><?=$_SESSION['nick_name']?><SPAN class=mesColor> <A href="../inner_infor_admin.php" target="_blank"><IMG 
      height=10 src="user.files/img2_xx_n.gif" width=14 border=0></A> <A href="../inner_infor_admin.php" target="_blank">短消息</A></SPAN></H3>
      <DIV class=user_fg>您的账号：<?=$_SESSION['user_name']?><BR>性&nbsp;&nbsp;&nbsp;&nbsp;别：<?=$row->sex=="m"?"<font color=blue>男</font>":"<font color=red>女</font>";?> <BR>
      <DIV id=div_birth>出生日期：<?=$row->birthday?><BR></DIV>
      <DIV id=div_from>来&nbsp;&nbsp;&nbsp;&nbsp;自：<?=$row->district?><BR></DIV>
      <DIV id=div_email style="DISPLAY: <?=$row->email_keep=="1"?"none":"block"?>">邮&nbsp;&nbsp;&nbsp;&nbsp;箱：<?=$row->email?>   </DIV></DIV>
      <?php 
	  $query="select * from ".$table_suffix."ask where poster='{$_SESSION['user_name']}'"; 
	  $result_ask=mysql_query($query);
	  $num_ask=mysql_num_rows($result_ask);
	  
	  $query="select * from ".$table_suffix."ask_answer where poster='{$_SESSION['user_name']}'"; 
	  $result_answer=mysql_query($query);
	  $num_answer=mysql_num_rows($result_answer);
	  
	  $query="select * from ".$table_suffix."ask_answer where poster='{$_SESSION['user_name']}' and accept='1'"; 
	  $result_accept=mysql_query($query);
	  $num_accept=mysql_num_rows($result_accept);
	  
	  $right_percent=100*($num_accept*1.0)/($num_answer*1.0);
	  if($right_percent==NULL) $right_percent=0;
	  
	  $query="select * from  ".$table_suffix."ask_score where user_name='{$_SESSION['user_name']}'";
	  $result_score=mysql_query($query);
	  $score_row=mysql_fetch_object($result_score);
	  $income=$score_row->income;
	  $payout=$score_row->payout;
	  ?>
	  <DIV class="pt10 c333">
	  积&nbsp;&nbsp;&nbsp;&nbsp;分：<?=$income-$payout?> 【<a href="#" class="c9,c6nul" onClick="opendwin('fresh_score.php');">刷新</a>】<BR>
	  
	  级&nbsp;&nbsp;&nbsp;&nbsp;别：<?php echo $mem_level[$row->user_level]; ?> 知识级别：<?=get_user_title($income)?><BR>
      提 问 数：<?=$num_ask?><BR>
	  回 答 数：<?=$num_answer?><BR>
	  采 纳 率：<?=substr($right_percent,0,6)?>%<BR>
	  擅长领域：<select name="menu1" onChange="MM_jumpMenu('iframe_data',this,0)">
		   <option value="?major=" <?php if($score_row->major=="")  echo "selected"; ?>>没有擅长领域</option>
		    <?php 
			 $query="select chapter_name from  ".$table_suffix."chapter order by id desc"; 
			 $result_c=mysql_query($query);
			 while($row_c=mysql_fetch_object($result_c)) { 
			?>  
			<option value="?major=<?=urlencode($row_c->chapter_name)?>" <?php if($row_c->chapter_name==$score_row->major) echo "selected"; ?>><?=$row_c->chapter_name?></option>
           <?php } ?>
		  </select><BR>
	  </DIV></DIV>
      </DIV>
	  <IFRAME style="DISPLAY: none" name=iframe_data src="about:blank"></IFRAME>
<script>
function opendwin(url)
{ 
 window.open(url,"iframe_data","height=550,width=700,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");
}
</script>