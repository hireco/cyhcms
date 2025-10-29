<?php require_once(dirname(__FILE__)."/../config/base_cfg.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style>
.poll_index {FONT-SIZE: 12px; LINE-HEIGHT: 150%; FONT-FAMILY: Arial,宋体,Sans-serif }
.poll_table {BORDER-RIGHT: #ed9b9b 1px solid; BORDER-BOTTOM: #ed9b9b 1px solid; BORDER-LEFT: #ed9b9b 1px solid; BACKGROUND-COLOR: #fff6f0
}
</style>
<?php require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); ?>
<?php 
    if(isset($_POST['poll_do'])) {
    echo "<link href=\"../css/style.css\" rel=\"stylesheet\" type=\"text/css\">";
   	$poll_opt=$_POST['poll_opt']; 
		$query="update ".$table_suffix."poll_selection set hit=hit+1 where id=$poll_opt";
		$result=mysql_query($query);
		if($result) {
		   setcookie("poll", "1 hour",time()+1800,"/"); 
		 ?>
        <script> opener.document.form_poll_chk.poll_flag.value="polled"; </script>
		<table width="100%" height="100%" align="center" bgcolor="#FF0000">
         <tr><td align="center" valign="middle"><font color="yellow"><strong>您的投票已经提交，谢谢您!</strong></font></td></tr></table>
       <?php }	
	 }
 else{     
    $nowtime=date("y-m-d H:i:s");
    $query="select * from ".$table_suffix."poll_topics where hide='0' and end_time > '$nowtime' order by post_time desc limit 0,1";
	$result=mysql_query($query);
	if(mysql_num_rows($result)) {
	  $row=mysql_fetch_object($result);
	  $poll_content[0]=$row->poll_title;
	   
	  $i=1; 
	  $query="select * from ".$table_suffix."poll_selection where poll_id={$row->id} order by id asc";
	  $result=mysql_query($query);
	  if(mysql_num_rows($result)) {
	    while($row=mysql_fetch_object($result))
	    { $poll_content[$i]=$row->selection;
		  $selection_id[$i]=$row->id;
		  $poll_result[$i-1]=$row->hit;
		  $i+=1; 
	    }
	  $height=($i>=5?$i-4:0)*30+220;
if(!isset($_REQUEST['action'])) {
?>
       <TABLE height=31 cellSpacing=0 cellPadding=0 width=100% 
      background=image/lefttitle1.gif border=0>
         <TBODY>
           <TR>
             <TD width=20>&nbsp;</TD>
             <TD>本站调查</TD>
           </TR>
         </TBODY>
       </TABLE>
       <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
      <TBODY>
        <TR>
          <TD><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10">&nbsp;</td>
                <td><TABLE width="100%" border=0 align=center cellPadding=2 cellSpacing=2>
                    <TBODY>
                      <TR>
                        <TD  ><span class="poll_index">&nbsp;&nbsp;<?php echo $poll_content[0]; ?>
                              <form name="form_poll_chk" style="margin-bottom:0px; margin-top:0px; ">
                                <input type="hidden" name="poll_flag" value="<?php  if(isset($_COOKIE['poll'])) echo "polled"; else echo "topoll"; ?>">
                              </form>
                        </span></TD>
                      </TR>
                    <form  name="form_poll" action="inc/poll.php"  method=post  target="newWin" onsubmit="window.open('','newWin','width=200,height=100,toolbar=no,menubar=no,scrollbars=no')">
                      <?php for($k=1;$k<$i;$k++) {  ?>
                      <TR>
                        <TD vAlign=center><INPUT id=radio<?=$selection_id[$k]?> type=radio value=<?=$selection_id[$k]?>  name=poll_opt>						<span class="style1"><?php echo $k.".".$poll_content[$k];?></span></TD>
                        </TR>
                      <?php }?>
                      <TR>
                        <TD height=30 align=middle nowrap>                          <DIV align=center>                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>&nbsp;</td>
                                <td><div align="right">
                                  <INPUT id=poll_do3 value=提交  type=submit name="poll_do" onclick="return check_poll();" class="INPUT">
                                </div></td>
                                <td width="20">&nbsp;</td>
                                <td><div align="left">
                                  <INPUT id=poll_re3 class="INPUT" onclick="javascript:window.open('inc/poll.php?action=read','红棉调查','width=600,height=<?php echo $height; ?>')" type=button value=结果 name="poll_re">
                                </div></td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                          </DIV></TD>
                      </TR>
                    </FORM>
                </TABLE></td>
                <td width="10">&nbsp;</td>
              </tr>
          </table></TD>
        </TR>
      </TBODY>
    </TABLE></td>
  </tr>
</table>
<?php } else { 
   echo "<link href=\"../css/style.css\" rel=\"stylesheet\" type=\"text/css\">";
?>
<table width="100%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="gold">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td align="center"><div align="center">投票结果</div></td>
      </tr>
    </table>
	<table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
	 <?php 
	     $total=0; $width=400; $height=$height-30;
		 while($element=each($poll_result)) $total+=$element["value"]; 
		 $height_bar=15; $interval=20; $sideedge=30; 
		 for($k=0;$k<$i-1; $k++){		 
		  if($total==0) $width_bar=0; else $width_bar=($width-2*sideedge)*$poll_result[$k]/(1.0*$total);  
		  $percent=$width_bar/($width-2*sideedge)*100; ?>
		  <tr bgcolor="#FFFFFF">
          <td align="center" valign="middle" nowrap><?php echo $k+1; ?>
		   </td> 
		  <td align="center" valign="middle" nowrap><?php echo "<img src=\"draw_poll.php?sideedge=$sideedge&k=$k&height_bar=$height_bar&interval=$interval&width_bar=$width_bar&width=$width"."\" >";?></td>
		  <td nowrap>
		  <?php echo "票数：".$poll_result[$k]."  占".substr($percent,0,4)."%"; ?>
		  </td>
        </tr>
		 <?php }?>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td align="center" nowrap>到目前投票共有<?php echo $total; ?>人参与，谢谢您的关注！</td>
          <td align="center" nowrap><span class="black1220bolder">【<a href="javascript:window.close()">关闭</a>】</span></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php } ?>
<script>
function check_poll() {
var var1=document.form_poll.poll_opt;
var flag=0;
for(var i=0;i<var1.length;i++)
 { if(!var1[i].checked)
   continue;
   else flag=1;
 }

if(flag==0) 
 {alert("对不起，不投空白票哦！"); return false; }  

else if(document.form_poll_chk.poll_flag.value=="polled") 
   { alert("你已经投过票了,谢谢！");
     return false;
   } 
}
</script>
<?php } 
  }
}
?>