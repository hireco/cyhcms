<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
	$query="select * from ".$table_suffix."link  where link_type='l'  and checked='1' order by post_time desc limit 0,12";
	$query2="select * from ".$table_suffix."link  where link_type='w' and checked='1' order by post_time desc limit 0,12";
	$rows=mysql_query($query);
	$rows2=mysql_query($query2);
	if(mysql_num_rows($rows)||mysql_num_rows($rows2)) { 
?>
<table width=<?=$cfg_body_width?> height="1" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#d2d2d2">
  <tr>
    <td></td>
  </tr>
</table>
<table width=<?=$cfg_body_width?>  border="0" align="center" cellpadding="10" cellspacing="0">
                                <tr>
                                  <td valign="top" bgcolor="#FFFFFF">
							        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <?php $i=0;
				                    while($row2=mysql_fetch_object($rows2)){  
									  $i++;
									  if($i%6==1) echo "<tr>"; ?>
									 <td align="left">
									 <table width="90"  border="0" cellpadding="0" cellspacing="0">
                                       <tr>
                                         <td  align="center" valign="middle" nowrap><div align="center">
										 <?php if($i==1) echo "<strong>友情链接</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										 <a href="<?=$row2->url?>" target=_blank><?=$row2->link_name?></a></div></td>
                                       </tr>
                                     </table></td>
                                    <?php if($i%6==0) echo "</tr>"; } ?>
                               </table>
							   <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                   <?php $i=0;
				                    while($row=mysql_fetch_object($rows)){  
									  $i++;
									  if($i%6==1) echo "<tr>"; ?>
									 <td align="left">
									 <table width="96" border="0" cellpadding="0" cellspacing="3">
                                       <tr>
                                         <td align="center" valign="middle"><table border="0"  cellspacing="1" bgcolor="#CCCCCC">
                                           <tr>
                                             <td  align="center" valign="middle" nowrap bgcolor="#FFFFFF"><a href="<?=$row->url?>" target=_blank><img src="<?=$row->logo?>" alt="<?=$row->link_name?>" height="30"  border="0"></a> </td>
                                           </tr>
                                         </table></td>
                                       </tr>
                                     </table></td>
                                    <?php if($i%6==0) echo "</tr>"; } ?>
                               </table>
							   </td>
                                </tr>
</table>
<?php } ?>