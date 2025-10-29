<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php  require_once("header.php"); ?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD colspan="3" vAlign=top><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
      <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./">首页</a> > 查看日历</TD>
        </TR>
      </TBODY>
    </TABLE></TD>
  </TR>
  <TR>
    <TD width="181" height=200 vAlign=top><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php  require_once("inc/calendar.php");?></td>
      </tr>
    </table>      
      <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20" bgcolor="#D7DEE8"><div align="left"><img src="image/blue_angle.jpg" width="9" height="30"></div></td>
        <td bgcolor="#D7DEE8">按分类查看</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D7DEE8">
          <tr>
            <td bgcolor="#FFFFFF"><TABLE width="100%" height=90 border=0 align=center cellPadding=0 cellSpacing=0 
      bgColor=#ffffff>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE width="90%" height=27 
              border=0 align=center cellPadding=0 cellSpacing=0>
              <TBODY>
              <?php 
			  $query="select * from ".$table_suffix."infor where hide_type='0' and class_level='0' order by top desc,top_time desc";  
              $result=mysql_query($query);
		      while($row=mysql_fetch_object($result)) { ?>
		      <TR>
                <TD class=smenuv noWrap align=middle  height=30>
                    <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                      <?=$row->class_name?>
                    </A></div></TD>
				<?php if($row=mysql_fetch_object($result))  { ?>
				<TD class=smenuv noWrap align=middle  height=30>
                  <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                    <?=$row->class_name?>
                  </A></div></TD>
				<?php } ?> 
			 </TR>
              <?php } ?>
      </TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          </tr>
        </table></td>
      </tr>
    </table>
	 </TD>
    <TD width="12" vAlign=top></TD>
    <TD vAlign=top><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" bgcolor="#E5D9D9"><div align="left"><img src="image/gray_angle.jpg" width="9" height="29"></div></td>
        <td bgcolor="#E5D9D9">
		<?php 
		if($day<1){$day=31; $month-=1;}
        if($day>31) {$day=1; $month+=1; }
		if($month<1){$month=12; $year-=1;}
        if($month>12) {$month=1; $year+=1; }
	    ?>
		<table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center"><a href="<?php if($_REQUEST['time']<>"byday") echo "?month=".($month-1)."&year=".$year."&time=bymonth"; else echo "?month=".$month."&year=".$year."&day=".($day-1)."&time=byday"; ?>" onMouseOut="reset_img('before','image/arrowRedLeft0.gif')" onMouseOver="reset_img('before','image/arrowRedLeft1.gif');"><img src="image/arrowRedLeft0.gif" name="Image20" width="19" height="19" border="0" id="before"></a></div></td>
            <td nowrap><div align="center" class="calhead"><?php echo $year."年".$month."月"; if($_REQUEST['time']=="byday") echo $day."日"; ?></div></td>
            <td><div align="center"><a href="<?php if($_REQUEST['time']<>"byday") echo "?month=".($month+1)."&year=".$year."&time=bymonth"; else echo "?month=".$month."&year=".$year."&day=".($day+1)."&time=byday"; ?>" onMouseOut="reset_img('after','image/arrowRedRight0.gif')" onMouseOver="reset_img('after','image/arrowRedRight1.gif');"><img src="image/arrowRedRight0.gif" name="Image21" width="19" height="19" border="0" id="after"></a></div></td>
          </tr>
        </table></td>
        <td width="10" bgcolor="#E5D9D9">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#E5D9D9">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                  <td align="center">
				  <?php  
				      $year_i=substr($year,-2);
					  $month_i=$month>"9"?$month:"0".$month; 
					  $day_i=$day>"9"?$day:"0".$day; 					  
					 
					  if($_REQUEST['time']=="byday")	      { $from_time=$year_i."-".$month_i."-".$day_i;  $to_time=$year_i."-".$month_i."-".($day_i+1);}
					  elseif($_REQUEST['time']=="bymonth")	  { $from_time=$year_i."-".$month_i."-01";  $to_time=$year_i."-".($month_i+1)."-01";}
					  elseif($_REQUEST['time']=="byyear")	  { $from_time=$year_i."-".$month_i."-".$day_i;  $to_time=($year_i+1)."-01-01";  }
					  else  {$from_time=$year_i."-".$month_i."-01"; $to_time="$year_i-".($month_i+1)."-01";}
					  
					  $query="select * from ".$table_suffix."infor_index where TO_DAYS(post_time) >= TO_DAYS('$from_time') and TO_DAYS(post_time) < TO_DAYS('$to_time') order by post_time desc";
				    
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
					  $infor_id=$row->infor_id;
					  $infor_class=$row->infor_class;
					  $query="select * from ".$table_suffix.$infor_class." where id=$infor_id";
				      $result_arc=mysql_query($query);
					  $row_arc=mysql_fetch_object($result_arc);
				  ?>
				  <table width="100%" border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td width="70" align="center" valign="top"><DIV class=date>
                                        <DIV class=weekday><?=date_of_week(date("w", strtotime("20".substr($row->post_time,0,8))))?></DIV>
                              <?=substr($row->post_time,6,2)?></DIV></td>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><a href="show_<?=$infor_class?>.php?id=<?=$infor_id?>" target="_blank"><strong><font color="#009900"><?=$row->article_title?></font></strong></a></td>
                        </tr>
                        <tr>
                          <td><font color="#000099"><?=$row_arc->pen_name==""?"佚名":$row_arc->pen_name?></font>  <font color="#59586B"><?=$row_arc->post_time?></font></td>
                        </tr>
                        <tr>
                          <td><font color="#666666"><?=msubstr(strip_tags($row_arc->content),0,200)?>...</font></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
				  <?php }
				     }
				   ?>	</td>
                </tr>
              </table>
                <table border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><?php require_once("inc/page_divide.php");?></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
        </table></td>
      </tr>
    </table></TD>
  </TR>
  <TR>
    <TD colspan="3" vAlign=top>&nbsp;</TD>
  </TR>
  </TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
<script>
function reset_img(id,img) { 
  var img_obj=document.getElementById(id);
  img_obj.src=img;
 }
</script>