<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr bgcolor="#EEF7F3">
        <td width="9"></td>
        <td>
		<?php 
		if($day<1){$day=31; $month-=1;}
        if($day>31) {$day=1; $month+=1; }
		if($month<1){$month=12; $year-=1;}
        if($month>12) {$month=1; $year+=1; }
	    ?>
		<table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center"><a href="<?php if($_REQUEST['time']<>"byday") echo "?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST['idkey']."&month=".($month-1)."&year=".$year."&time=bymonth"; else echo "?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST['idkey']."&month=".$month."&year=".$year."&day=".($day-1)."&time=byday"; ?>" onMouseOut="reset_img('before','image/arrowRedLeft0.gif')" onMouseOver="reset_img('before','image/arrowRedLeft1.gif');"><img src="image/arrowRedLeft0.gif" name="Image20" width="19" height="19" border="0" id="before"></a></div></td>
            <td nowrap><div align="center"><?php echo $year."年".$month."月"; if($_REQUEST['time']=="byday") echo $day."日"; ?></div></td>
            <td><div align="center"><a href="<?php if($_REQUEST['time']<>"byday") echo "?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST['idkey']."&month=".($month+1)."&year=".$year."&time=bymonth"; else echo "?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST['idkey']."&month=".$month."&year=".$year."&day=".($day+1)."&time=byday"; ?>" onMouseOut="reset_img('after','image/arrowRedRight0.gif')" onMouseOver="reset_img('after','image/arrowRedRight1.gif');"><img src="image/arrowRedRight0.gif" name="Image21" width="19" height="19" border="0" id="after"></a></div></td>
          </tr>
        </table></td>
        <td width="10">&nbsp;</td>
      </tr>
      <tr bgcolor="#D5D5D5">
        <td height="1" colspan="3"></td>
      </tr>
      <tr>
        <td colspan="3"><table width="100%"  border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <?php  
				      $year_i=substr($year,-2);
					  $month_i=$month>"9"?$month:"0".$month; 
					  $day_i=$day>"9"?$day:"0".$day; 					  
					 
					  if($_REQUEST['time']=="byday")	      { $from_time=$year_i."-".$month_i."-".$day_i;  $to_time=$year_i."-".$month_i."-".($day_i+1);}
					  elseif($_REQUEST['time']=="bymonth")	  { $from_time=$year_i."-".$month_i."-01";  $to_time=$year_i."-".($month_i+1)."-01";}
					  elseif($_REQUEST['time']=="byyear")	  { $from_time=$year_i."-".$month_i."-".$day_i;  $to_time=($year_i+1)."-01-01";  }
					  else  {$from_time=$year_i."-".$month_i."-01"; $to_time="$year_i-".($month_i+1)."-01";}
					  
					  $query="select * from ".$table_suffix."member_blog where TO_DAYS(post_time) >= TO_DAYS('$from_time') and TO_DAYS(post_time) < TO_DAYS('$to_time') and user_name='$host_name' order by post_time desc";
				    
					  $rows=@mysql_query($query);
	    
	                  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	   
	                  $per_page_num=10;
	   
	                  $num=@mysql_num_rows($rows);
	                  
					  if(!$num) echo "没有找到记录";
					  
					  $page=intval(($num-1)/$per_page_num)+1;
	 
	                  if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	                  $page_front=($page_id<=1)?1:($page_id-1); 
	                  $page_behind=($page_id>=$page)?$page:($page_id+1); 
	                  @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
					  
					  for($i=1;$i<=$per_page_num;$i++)
					   { if($row=@mysql_fetch_object($rows)){  
					   $infor_title=$row->infor_title;
					   $post_time=$row->post_time;
					   $blog_class=$row->blog_class;
					   $host_name=$row->user_name;
					  ?>
                <tr>
                  <td><div align="left" class="fonts"><a href="user_infor.php?view=<?=$blog_class?>&infor_id=<?=$row->id?>&idkey=<?=md5($host_name)?>" style="color:#3366CC; text-decoration:underline">
                      <?=$infor_title?>
                      </a>
                          <?php if($blog_class=="album") { ?>
                          <img src="image/album_ico.gif" width="18" height="12" align="absmiddle">
                          <?php } ?>
                          (
                          <?=$post_time?>
                          )</div></td>
                </tr>
                <?php } 
						   }
						   ?>
              </table>
                <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><?php require_once("inc/page_divide.php");?></td>
                  </tr>
                </table></td>
            </tr>
        </table></td>
      </tr>
</table>
<script>
function reset_img(id,img) { 
  var img_obj=document.getElementById(id);
  img_obj.src=img;
 }
</script>