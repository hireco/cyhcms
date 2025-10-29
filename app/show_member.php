<?php 
 session_start();
 require_once("setting.php");
 require_once(dirname(__FILE__)."/config/base_cfg.php");
 require_once(dirname(__FILE__)."/inc/show_msg.php");
 require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title;if($blog_title) echo "博客:".$blog_title;?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/blog.css" rel="stylesheet" type="text/css">
<SCRIPT type=text/javascript>
function fontZoom(size)
{
   document.getElementById('con').style.fontSize=size+'px';
}
</SCRIPT>
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
</head>
<body onLoad="resizeImages(<?=$body_width?>);">
<?php require_once("header.php");  
	$query="select * from ".$table_suffix."member_blog where blog_class='album' and id={$_REQUEST['id']}";  
	$result=mysql_query($query);
	if($row=mysql_fetch_object($result)) {
	$infor_title=$row->infor_title;
	$post_time=$row->post_time;
	$keywords=$row->keywords;
	$folder_name=$row->folder_name;
	$content=$row->content;
	?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
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
        </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td id="con" class="blogcon">		<?=$content?>
		<br><br>
		<?php 
		$query="select * from ".$table_suffix."picture where object_id={$_REQUEST['id']} and object_class='member'";
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
</td>
        </tr>
    </table></td>
  </tr>
</table></td>
  </tr>
</table>
<?php } else showmsg("没有相册",-1); 
 require_once("footer.php");?>
</body></html>