<?php 
	    $query="update ".$table_suffix.$infor_class."  set read_times=read_times+1 where id={$_REQUEST['id']}";
		mysql_query($query);
		$query="update ".$table_suffix."infor_index  set read_times=read_times+1 where infor_id={$_REQUEST['id']} and infor_class='$infor_class'";
		mysql_query($query);
	    //分别在文章表和索引表中更新点击数信息
?>
