<?php 
  require_once(dirname(__FILE__)."/kanwu_set.php");   
  require_once(dirname(__FILE__)."/main_fun.php"); 
  $string=explode(",",$string);
  $more=explode(",",$more);
  $string=array_unique(array_merge($string,$more)); 
  $string=implode(",",$string); if(strlen($string)<3) $string=""; 
  else $string=explode(",",$string); 
  $title=explode(",",$title); 
  if($kanwu) {
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0" bgcolor="#D6E6EE">
  <tr>
    <td>&nbsp;</td>
    <td><?=$kanwu?></td>
    <td><div align="center"><span class="fontg"><A 
                  href="kanwu_list.php"><IMG height=15 
                  src="image/more.gif" width=53 
              border=0></A></span></div></td>
  </tr>
</table>
<TABLE height=118 cellSpacing=0 cellPadding=0 width="100%"  background=image/left2.gif border=0>
        <TBODY><TR>
          <TD style="PADDING-LEFT: 80px; PADDING-TOP: 22px" vAlign=top>
    <?php 
	if($string<>"") { 
	for($i=0;$i<count($string)&&$i<4;$i++) if($string[$i]<>""){ 
	$string_j=explode(":",$string[$i]); 
	if($title[$i])
	  {  echo  "<a href=\"show_{$string_j[0]}.php?id={$string_j[1]}\" target=_blank>".$title[$i]."</a>"; echo "<br>"; }
	else { 
	    $result=mysql_query("select article_title,title_color from  ".$table_suffix."infor_index where infor_id={$string_j[1]} and infor_class='{$string_j[0]}'");
		$row=mysql_fetch_object($result);
		echo "<a href=\"show_{$string_j[0]}.php?id={$string_j[1]}\" target=_blank>".msubstr($row->article_title,0,12)."</a>"; echo "<br>";
	   }
	 } 
	 }
	else {
	   $kanwu_col=explode(",",$default_set);
	   $result=mysql_query("select article_title,title_color,infor_id from  ".$table_suffix."infor_index where infor_class='{$kanwu_col[0]}' and class_id={$kanwu_col[1]}");
	   $i=0;
	   while(($row=mysql_fetch_object($result))&&($i<4)) {
	   echo "<a href=\"show_{$kanwu_col[0]}.php?id={$row->infor_id}\" target=_blank>".msubstr($row->article_title,0,12)."</a>"; echo "<br>";
	   $i++;
	   }
	 }
	?></TD>
        </TR>
		</TBODY>
</TABLE>
<TABLE height=8 cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff 
      border=0>
  <TBODY>
    <TR>
      <TD align=middle></TD>
    </TR>
  </TBODY>
</TABLE>
<?php } ?>
