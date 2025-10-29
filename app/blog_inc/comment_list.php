<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<TABLE height=30 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=blog_inc/detailtitle.gif border=0>
  <TBODY>
    <TR>
      <TD align=middle width=10></TD>
      <TD><strong>评论<a name="say_list"></a></strong></TD>
      <TD><div align="right"><a href="#say" style="text-decoration:underline ">发表评论</a></div></TD>
    </TR>
  </TBODY>
</TABLE>
<?php  
  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
  $per_page_num=20;
  $rows=$result_comment; 
  $num=@mysql_num_rows($rows);
  $page=intval(($num-1)/$per_page_num)+1;
  if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
  $page_front=($page_id<=1)?1:($page_id-1); 
  $page_behind=($page_id>=$page)?$page:($page_id+1); 
  @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
  for($i=1;$i<=$per_page_num;$i++)
	   { if($row_comment=@mysql_fetch_object($rows)){
  $content=ereg_replace("//f:"," <img align=absmiddle src=".$cfg_mainsite."blog_inc/face/",$row_comment->content);
  $content=ereg_replace("//f",".gif> ",$content);
  if($row_comment->user_type=="a")   $comment_person=$row_comment->user_name;
  else $comment_person=$row_comment->person;
  
  $img_default="image/memsimg.gif";
  
  if($row_comment->user_type=="r") {
   $query="select * from ".$table_suffix."member  where user_name='{$row_comment->user_name}'";
   $result_who=mysql_query($query);
   $row_who=mysql_fetch_object($result_who); 
   $sample_pic=$row_who->pic_checked=='1'?(empty($row_who->sample_pic)?$img_default:$row_who->sample_pic):$img_default;
  }
  
  else $sample_pic=$img_default;
 ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="60" valign="top"><div align="center">
	<?php if($row_comment->user_type=="r") { ?>
	<a href="user_infor.php?host_id=<?=$row_who->id?>&idkey=<?=md5($row_comment->user_name)?>"><img src="<?=$sample_pic?>" alt="<?=$comment_person?>" width="40" border="1"  style="border:1px solid #cccccc;"></a>
	<?php } else { ?>
	<img src="<?=$sample_pic?>" alt="<?=$comment_person?>" width="40" border="1"  style="border:1px solid #cccccc;">
	<?php } ?>
	</div></td>
	<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td><?=$content?></td>
      </tr>
      <tr>
        <td><span style="color:#666666; font-size:10px;">(20<?=$row_comment->post_time?>)</span></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php } 
   }
 ?>
  <br>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php  require_once("inc/page_divide.php"); ?></td>
      </tr>
    </table>
