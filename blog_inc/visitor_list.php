<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>访客</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td>
                      <?php 
					  echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					  $query="select * from ".$table_suffix."visitor_list where visited_id=$host_id group by (visitor_id) order by visit_time desc"; 
					  $result=mysql_query($query);
					  $num_of_visitor=mysql_num_rows($result);
					  $width=50;  
					  $i_row=($body_width-181)/$width; 
					  if($num_of_visitor) { 
					  while($row=mysql_fetch_object($result)) {
					   $query="select * from ".$table_suffix."member  where id={$row->visitor_id}";
					   $result_visitor=mysql_query($query);
					   $row_visitor=mysql_fetch_object($result_visitor); 
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row_visitor->pic_checked=='1'?(empty($row_visitor->sample_pic)?$img_default:$row_visitor->sample_pic):$img_default;
					   $md5_idkey=md5($row_visitor->user_name);
					   if($i%$i_row==0) echo "<tr>";
					   echo "<td>";
					  ?>
					  
					  <table  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=$md5_idkey?>" target="_blank" ><img src="<?=$sample_pic?>" alt="<?=$row_visitor->nick_name?>" width="<?=$width?>"  border="0" align="middle"></a></td>
                                </tr>
                            </table>                              
                              <div align="center"><a href="user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=$md5_idkey?>" target="_blank" style="text-decoration:underline">
                                <?=$row_visitor->nick_name?>
                            </a></div><div align="center">(<?=substr($row->visit_time,0,11)?>)</div>
                          <?php 
						  echo "</td>"; 
						  if($i%$i_row==3) echo "</tr>";
						  }
					   }
					 else  echo "<tr><td>没有访客</td></tr>"; 
					 echo "</table>";
					 ?>
                      </td>
                    </tr>
                </table></td>
              </tr>
          </table>