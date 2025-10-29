<?php 
  if(isset($_REQUEST['id'])&&($infor_class<>"zhuanti")) { 
  $id=$_REQUEST['id'];
  $query="select similar_id from ".$table_suffix.$infor_class." where id=$id and hide_type='0'";
  $similar_result=mysql_query($query);
  $similar_row=mysql_fetch_object($similar_result);
  $similar_id=explode(",",$similar_row->similar_id);
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<TABLE class=table height=30 cellSpacing=0 cellPadding=0 width="90%" 
      align=center background=image/detailtitle.gif border=0>
  <TBODY>
    <TR>
      <TD align=middle width=10></TD>
      <TD>主题相关</TD>
    </TR>
  </TBODY>
</TABLE>
<?php if($similar_row->similar_id) { ?>
<TABLE cellSpacing=3 cellPadding=3 width="90%" align=center border=0>
  <TBODY>
    <TR vAlign=top>
      <TD class=downintro colSpan=2>
        <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
          <TBODY>
          </TBODY>
        </TABLE>
   <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
          <TBODY>
    <?php for($i=0;$i<count($similar_id);$i++) {
    $similar_id_i=explode(":",$similar_id[$i]);
	$query="select article_title, post_time, title_color, class_id from ".$table_suffix."infor_index where infor_id={$similar_id_i[1]} and infor_class='{$similar_id_i[0]}' and hide_type='0'";
    $similar_result_i=mysql_query($query);
	$article_title_i=mysql_result($similar_result_i,0,"article_title");
	$class_id_i=mysql_result(mysql_query($query),0,"class_id");
	$post_time_i=mysql_result(mysql_query($query),0,"post_time");
	$title_color_i=mysql_result(mysql_query($query),0,"title_color");
	
	$query="select chinese_name from ".$table_suffix."infor_class  where class_name='{$similar_id_i[0]}'";
	$article_mode_i=substr(mysql_result(mysql_query($query),0,"chinese_name"),0,4);
	
	$query="select class_name from ".$table_suffix."infor  where id='{$class_id_i}'";
	$class_name_i=mysql_result(mysql_query($query),0,"class_name"); 
	if($article_title_i) {
	?>
	 <TR align=left>
        <TD><?php echo "[$article_mode_i]-$class_name_i:<A class=more href=\"show_$similar_id_i[0].php?id=$similar_id_i[1]\"><font color=\"$title_color_i\">$article_title_i</font></A>"; ?></TD>
        <TD><?=substr($post_time_i,3,11)?></TD>
	  </TR>          
     <?php }
	    }
	  ?></TBODY>
     </TABLE>	  </TD>
    </TR>
  </TBODY>
</TABLE>
<?php }
  else { ?>
<TABLE cellSpacing=3 cellPadding=3 width="90%" align=center border=0>
  <TBODY>
    <TR vAlign=top>
      <TD class=downintro colSpan=2>
        没有相关主题
      </TD>
    </TR>
  </TBODY>
</TABLE>
  
<?php } 
  }
 ?>