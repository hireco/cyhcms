<script language="JavaScript">
function opendwin(url){ window.open(url,"TripodPopup","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,left=0,top=0,width=500,height=200");
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td bgcolor="#EEF7F3"><strong>博客首页</strong></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#D5D5D5"></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><table  width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td id="con">
	<?php  
	$query="select * from ".$table_suffix."member_blog where  user_name='$host_name' order by post_time desc";  
	$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	$per_page_num=15;
	$rows=@mysql_query($query); 
	$num=@mysql_num_rows($rows);
	$page=intval(($num-1)/$per_page_num)+1;
    if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
    $page_front=($page_id<=1)?1:($page_id-1); 
    $page_behind=($page_id>=$page)?$page:($page_id+1); 
    @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
	for($i=1;$i<=$per_page_num;$i++)
		{ if($row=@mysql_fetch_object($rows)){ 
	$infor_title=$row->infor_title;
	$post_time=$row->post_time;
	$keywords=$row->keywords;
	$folder_name=$row->folder_name;
	?>
	<br>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="?view=<?=$row->blog_class?>&infor_id=<?=$row->id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><span class="blog_title"><?=$infor_title?></span></a> <span class="fonts">(<?=$post_time?>)</span></td>
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
          分类：<a href="user_infor.php?host_id=<?=$host_id?>&view=<?=$row->blog_class?>&view_class=<?=urlencode($folder_name)?>&idkey=<?=$_REQUEST['idkey']?>"  style="text-decoration:underline"><?=$folder_name?></a>
        </div></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  class="blogcon"><?php 
		if($row->blog_class=="rizhi") echo msubstr(strip_tags($row->content),0,300);
		else {
		$query="select * from ".$table_suffix."picture where object_id={$row->id} and object_class='member' limit 0, 1";
		$result=mysql_query($query);
		if($row_picture=mysql_fetch_object($result)) { 
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
		 <?php } 
		   }
		 ?>
		</td>
      </tr>
    </table>
	<?php 
	$query_comment="select * from ".$table_suffix."blog_comment where infor_id={$row->id} order by post_time asc";
    $result_comment=mysql_query($query_comment); 
   ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="left"><a href="?view=<?=$row->blog_class?>&infor_id=<?=$row->id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><strong>点击查看全文</strong></a></div></td>
        <td><div align="right"><a href="?view=<?=$row->blog_class?>&infor_id=<?=$row->id?>&idkey=<?=$_REQUEST['idkey']?>#say_list">评论</a>(<?=mysql_num_rows($result_comment)?>) | 阅读(<?=$row->read_times?>) | <a href="#" onClick="opendwin('blog_inc/share.php?url=<?=urlencode($cfg_mainsite."user_infor.php?view=".$row->blog_class."&infor_id=".$row->id."&idkey=".md5($row->user_name))?>')">分享</a> | <a href="javascript:window.print()">打印</a> | <a href="mailto:<?php $mail=explode(":",$cfg_webmaster); echo $mail[1];?>">举报</a></div></td>
      </tr>
    </table>
	<table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
      <tr>
       <td background="image/dash_line.jpg"></td>
      </tr>
     </table>
	<?php } 
	  }
 if(!$num) { ?>
 <table width="100%" border="0" cellpadding="10" cellspacing="0">
   <tr>
     <td>目前没有记录</td>
   </tr>
  </table>
  <?php } ?>
  <table width="100%"  border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="50%">&nbsp;</td>
        <td><?php  require_once("inc/page_divide.php"); ?></td>
      </tr>
  </table>
</td>
        </tr>
    </table></td>
  </tr>
</table>