<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td bgcolor="#EEF7F3"><strong>����</strong></td>
    <td bgcolor="#EEF7F3"><div align="right"><span class="newsinfo">��С��[<A class=newsinfo href="javascript:fontZoom(16)">��</A>][<A 
            class=newsinfo href="javascript:fontZoom(14)">��</A>][<A  class=newsinfo  href="javascript:fontZoom(12)">С</A>]</span></div></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#D5D5D5"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>
	<?php  
	$query="select * from ".$table_suffix."member_blog where blog_class='rizhi' and id={$_REQUEST['infor_id']}";  
	$result=mysql_query($query);
	if($row=mysql_fetch_object($result)) {
	$infor_title=$row->infor_title;
	$post_time=$row->post_time;
	$keywords=$row->keywords;
	$folder_name=$row->folder_name;
	$content=$row->content;
	?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><span class="blog_title"><?=$infor_title?></span> <span class="fonts">(<?=$post_time?>)</span></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td>��ǩ��<?php 
		   if($keywords=="") echo "�ޱ�ǩ"; 
		   else {
		   $keywords=explode(" ",$keywords); 
		   for($i=0;$i<count($keywords); $i++)
		   echo "<a href=\"similar_infor.php?keywords=".urlencode($keywords[$i])."\"  style=\"text-decoration:underline\">".$keywords[$i]."</a>  ";
		   }
		   ?></td>
        <td><div align="right">
          ���ࣺ<a href="user_infor.php?host_id=<?=$host_id?>&view=rizhi&view_class=<?=urlencode($folder_name)?>&idkey=<?=$_REQUEST['idkey']?>"  style="text-decoration:underline"><?=$folder_name?></a>
        </div></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td id="con" class="blogcon"><?=$content?>
		<br>
		</td>
      </tr>
    </table>
	<?php require_once("blog_inc/per_link.php"); ?>
	<?php require_once("blog_inc/comment_list.php"); ?>
	<?php require_once("blog_inc/add_comment.php"); ?>
	<?php } else { ?>
	<font color="#006633"><strong>��־������</strong></font>
	<?php } ?>
</td>
        </tr>
    </table></td>
  </tr>
</table>
