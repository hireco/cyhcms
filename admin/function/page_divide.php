<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table  border="0" cellpadding="3" cellspacing="5">
  <tr bgcolor="#CC6600"><?php 
		$url_suffix=$_SERVER["QUERY_STRING"];
        $page_url=ereg_replace("page_id=[0-9]*[1-9][0-9]*","",$url_suffix);
		$page_url=$page_url==""?"":$page_url."&";
		$page_url=ereg_replace("&&","&",$page_url);
		if($num>$per_page_num) { 
		$page_next=$page_id+1; $page_before=$page_id-1; 
		if($page_id>1) echo "<td style=\"line-height:100%;\"><a href=\"?{$page_url}page_id=$page_before\" style=\"color:#FFFFCC; \"><<</a></td> ";
		if($page_id<=5) 
		{for($kk=1;$kk<$page_id+6,$kk<=$page;$kk++) 
		 if($kk!=$page_id) echo "<td style=\"line-height:100%;\"><a href=\"?{$page_url}page_id=$kk\" style=\"color:#FFFFCC; \">[".$kk."]</a></td> ";
		 else echo "<td style=\"line-height:100%;\" bgcolor=\"#FFFFFF\"><font color=red>[".$kk."]</font></td> ";
		 if($page_id<$page) echo "<td style=\"line-height:100%;\"><a href=\"?{$page_url}page_id=$page_next\" style=\"color:#FFFFCC; \">>></a></td> ";
		 
		 }
		else if($page_id>=5)  
		{for($kk=$page_id-4;$kk<$page_id+5,$kk<=$page;$kk++) 
		 if($kk!=$page_id)  echo "<td style=\"line-height:100%;\"><a href=\"?{$page_url}page_id=$kk\" style=\"color:#FFFFCC; \">[".$kk."]</a></td> ";
		 else echo "<td style=\"line-height:100%;\" bgcolor=\"#FFFFFF\"><font color=red>[".$kk."]</font></td> ";
		 if($page_id<$page) echo "<td style=\"line-height:100%;\"><a href=\"?{$page_url}page_id=$page_next\" style=\"color:#FFFFCC; \">>></a></td>";
		}
	  }
?>
  </tr>
</table>

