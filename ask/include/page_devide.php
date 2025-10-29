<?php 
		$url_suffix=$_SERVER["QUERY_STRING"];
        $page_url=ereg_replace("page_id=[0-9]*[1-9][0-9]*","",$url_suffix);
		$page_url=$page_url==""?"":$page_url."&";
		$page_url=ereg_replace("&&","&",$page_url);
		if($num>$per_page_num) { 
		$page_next=$page_id+1; $page_before=$page_id-1; 
		if($page_id!=1) echo "<a href=\"?{$page_url}page_id=1\">第一页</a> ";
		if($page_id>1)  echo "<a href=\"?{$page_url}page_id=$page_before\">上一页</a> ";
		if($page_id<=5) 
		{for($kk=1;($kk<$page_id+6)&&($kk<=$page);$kk++) 
		 if($kk!=$page_id) echo "<A class=page_off href=\"?{$page_url}page_id=$kk\">".$kk."</a> ";
		 else echo "<SPAN class=page_on>".$kk."</SPAN> ";
		 if($page_id<$page) echo "<a href=\"?{$page_url}page_id=$page_next\">下一页</a> ";		 
		 }
		else if($page_id>=5)  
		{for($kk=$page_id-4;($kk<$page_id+5)&&($kk<=$page);$kk++) 
		 if($kk!=$page_id)  echo "<a class=page_off href=\"?{$page_url}page_id=$kk\">".$kk."</a> ";
		 else echo "<SPAN class=page_on>".$kk."</SPAN> ";
		 if($page_id<$page) echo "<a href=\"?{$page_url}page_id=$page_next\">下一页</a> ";
		}
		if($page_id!=$page) echo "<a href=\"?{$page_url}page_id=$page\">最后页</a> ";
	  }
?>