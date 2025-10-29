<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
require_once(dirname(__FILE__)."/inc/find_cookie.php");
$query="select * from ".$table_suffix."infor where top_navi='1' and  hide_type='0' order by top desc,top_time desc limit 0,8";  
$result=mysql_query($query);
?>
<table width=<?=$cfg_body_width?> border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table border="0" align="right" cellpadding="3" cellspacing="0">
      <tr>
        <td><a href="./">首 页</a></td>        
        <td>|</td>
        <td><a href="class_list.php">搜 索</a></td>
        <td>|</td>
        <td><a href="tuwen.php">图 片 </a></td>
        <td>|</td>
        <td><a href="member_list.php">博 客</a></td>
        <td>|</td>
        <td><a href="ask/">问 答</a></td>
		<td>|</td>
		<td><a href="exam/">考 试</a></td>
		<td>|</td>
        <td><a href="site_map.php">导 航</a></td>
        <td>|</td>
        <td><a href="calendar.php">日 历</a></td>
        <td>|</td>
        <td><a href="member.php">会 员</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<TABLE height=100 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/top.png border=0>
  <TBODY>
  <TR>
    <TD align=middle width=150><IMG src="<?=$cfg_logo?>" border=0></TD>
    <TD>&nbsp;</TD>
    <TD align=right width=132>&nbsp;</TD></TR></TBODY></TABLE>
<TABLE height=32 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/menubg.gif border=0>
  <TBODY>
  <TR>
    <TD width=25>&nbsp;</TD>
    <TD>
      <TABLE height=32 cellSpacing=0 cellPadding=0 
      background=image/menubg.gif border=0>
        <TBODY>
        <TR>
		  <TD style="PADDING-TOP: 5px" align=middle><A class=menunow 
            href="./" target=_self>首 页</A> </TD>
          <?php 
             $i=1;
             while($row_head=mysql_fetch_object($result)) { 
             ?>		    
          <TD align=middle width=10><IMG height=32  src="image/menudivid.gif" width=3></TD>
		  <TD style="PADDING-TOP: 5px" align=middle><A class=menunow 
            href="<?=$row_head->infor_class?>.php?class_id=<?=$row_head->id?>" target=_self><?=$row_head->class_name?></A></TD>
     <?php if($i==3) { ?>
     <TD align=middle width=10><IMG height=32  src="image/menudivid.gif" width=3></TD>  
     <TD style="PADDING-TOP: 5px" align=middle><A class=menunow href="ask/" target=_self>知识问答</A> </TD>
     <TD align=middle width=10><IMG height=32  src="image/menudivid.gif" width=3></TD>  
     <TD style="PADDING-TOP: 5px" align=middle><A class=menunow href="exam/" target=_self>在线测试<img src="image/new_fun.gif" width="24" height="11" border="0" align="texttop"></A> </TD>
     <?php } $i++;
      } ?>     
     </TR>
    </TBODY></TABLE> 
    </TD>
    <TD align=right width=11>&nbsp;</TD></TR></TBODY></TABLE>
<TABLE height=14 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/m2.gif border=0>
  <TBODY>
  <TR>
    <TD width=136><IMG height=14 src="image/m1.gif" width=10></TD>
    <TD><IMG height=14 src="image/m2.gif" width=24></TD>
    <TD align=right width=11><IMG height=14 src="image/m3.gif" 
    width=11></TD></TR></TBODY></TABLE>
<TABLE height=12 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
bgColor=#ffffff border=0>
  <TBODY>
  <TR>
    <TD></TD></TR></TBODY></TABLE>