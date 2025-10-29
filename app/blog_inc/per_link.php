<script language="JavaScript">
function opendwin(url){ window.open(url,"TripodPopup","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,left=0,top=0,width=500,height=200");
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
  $query_update="update  ".$table_suffix."member_blog set read_times=read_times+1 where id={$_REQUEST['infor_id']}";
  mysql_query($query_update);
  $query_comment="select * from ".$table_suffix."blog_comment where infor_id={$_REQUEST['infor_id']} order by post_time asc";
  $result_comment=mysql_query($query_comment);
  $query_after="select * from ".$table_suffix."member_blog  where id>{$_REQUEST['infor_id']} and user_name ='$host_name' limit 0, 1"; 
  $query_before="select * from ".$table_suffix."member_blog where id<{$_REQUEST['infor_id']} and user_name ='$host_name' limit 0, 1"; 
  $result_after=mysql_query($query_after);
  $result_before=mysql_query($query_before);
  $row_after=mysql_fetch_object($result_after);
  $row_before=mysql_fetch_object($result_before); 
  
  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  $this_file = urlencode($_SERVER['HTTP_X_REWRITE_URL']);
  else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) $this_file = urlencode($_SERVER['REQUEST_URI']);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
<tr>
  <td><div align="right"><a href="#say_list">评论</a>(<?=mysql_num_rows($result_comment)?>) | 阅读(<?=$row->read_times?>) | <a href="#" onClick="opendwin('blog_inc/share.php?url=<?=urlencode(ereg_replace("/$","",$cfg_base_url).$this_file)?>')">分享</a> | <a href="javascript:window.print()">打印</a> | <a href="mailto:<?php $mail=explode(":",$cfg_webmaster); echo $mail[1];?>">举报</a></div></td>
</tr>
<tr>
  <td style="line-height:100%;">上一篇：<?php if(!$row_before)  echo "没有了"; else echo  "<a style=\"text-decoration:underline;\" href=\"user_infor.php?view=".$row_before->blog_class."&infor_id=".$row_before->id."&idkey=".$_REQUEST['idkey']."\">".$row_before->infor_title."</a>";?></td>
</tr>
<tr>
  <td style="line-height:100%;">下一篇：<?php if(!$row_after)  echo "没有了";  else echo  "<a style=\"text-decoration:underline;\" href=\"user_infor.php?view=".$row_after->blog_class."&infor_id=".$row_after->id."&idkey=".$_REQUEST['idkey']."\">".$row_after->infor_title."</a>";?></td>
</tr>
</table>