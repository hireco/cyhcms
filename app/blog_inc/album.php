<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td bgcolor="#EEF7F3"><strong>正文</strong></td>
    <td bgcolor="#EEF7F3"><div align="right"><span class="newsinfo">大小：[<A class=newsinfo href="javascript:fontZoom(16)">大</A>][<A 
            class=newsinfo href="javascript:fontZoom(14)">中</A>][<A  class=newsinfo  href="javascript:fontZoom(12)">小</A>]</span></div></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#D5D5D5"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>
	<?php  
	$query="select * from ".$table_suffix."member_blog where blog_class='album' and id={$_REQUEST['infor_id']}";  
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
        <td>标签：<?php 
		   if($keywords=="") echo "无标签"; 
		   else {
		   $keywords=explode(" ",$keywords); 
		   for($i=0;$i<count($keywords); $i++)
		   echo "<a href=\"similar_infor.php?keywords=".urlencode($keywords[$i])."\"  style=\"text-decoration:underline\">".$keywords[$i]."</a>  ";
		   }
		   ?></td>
        <td><div align="right">
          分类：<a href="user_infor.php?host_id=<?=$host_id?>&view=album&view_class=<?=urlencode($folder_name)?>&idkey=<?=$_REQUEST['idkey']?>"  style="text-decoration:underline"><?=$folder_name?></a>
        </div></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td id="con" class="blogcon">		<?=$content?>
		<br><br>
		<?php 
		$query="select * from ".$table_suffix."picture where object_id={$_REQUEST['infor_id']} and object_class='member'";
		$result=mysql_query($query);
		while($row_picture=mysql_fetch_object($result)) { 
		$pic_url=$row_picture->pic_url;
		$query="select * from ".$table_suffix."picture_msg where pic_id={$row_picture->id}";
		$pic_msg=mysql_result(mysql_query($query),0,"pic_msg");
		?>
		<div align="left"><?=$row_picture->pic_title?></div>
		<div align="left"><?=$pic_msg?></div>
		<br>
		<div align="center">
		  <table  border="0" cellpadding="0" cellspacing="1" bgcolor="#DBDBDB">
            <tr>
              <td bgcolor="#FFFFFF"><img src="<?=$pic_url?>"  alt="<?=$row_picture->pic_title?>" align="middle"></td>
            </tr>
          </table>
		  </div><br>
		  <table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td background="image/dash_line.jpg"></td>
            </tr>
          </table>
		<?php } ?>
		</td>
      </tr>
    </table>
	<?php require_once("blog_inc/per_link.php"); ?>
	<?php require_once("blog_inc/comment_list.php"); ?>
	<?php require_once("blog_inc/add_comment.php"); ?>
	<?php } else { ?>
	<font color="#006633"><strong>相册不存在</strong></font>
	<?php } ?>
</td>
        </tr>
    </table></td>
  </tr>
</table>
