<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>好友</strong></td>
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
					  $friend_list=mysql_result(mysql_query("select friend_list from ".$table_suffix."member where user_name='$host_name' "),0,"friend_list");
					  $width=50;  
					  $i_row=($body_width-181)/$width; 
					  if($friend_list) { 
					  $friend_list=explode(",",$friend_list); 
					  for($i=0; $i<count($friend_list); $i++) {
					   $query="select * from ".$table_suffix."member  where id={$friend_list[$i]}";
					   $result=mysql_query($query);
					   $row=mysql_fetch_object($result); 
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
					   $md5_idkey=md5($row->user_name);
					   if($i%$i_row==0) echo "<tr>";
					   echo "<td>";
					  ?>
					  
					  <table  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=$md5_idkey?>" target="_blank" ><img src="<?=$sample_pic?>" alt="<?=$row->nick_name?>" width="<?=$width?>"  border="0" align="middle"></a></td>
                                </tr>
                            </table>                              
                              <div align="center"><a  style="text-decoration:underline; color:#006666" href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=$md5_idkey?>">
                                <?=$row->nick_name?>
                            </a></div>
                          <?php 
						  echo "</td>"; 
						  if($i%$i_row==3) echo "</tr>";
						  }
					   }
					 else  echo "<tr><td>没有好友</td></tr>"; 
					 echo "</table>";
					 ?>
                      </td>
                    </tr>
                </table></td>
              </tr>
          </table>