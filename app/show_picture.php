<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<?php 
  $id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."album where id=$id and hide_type='0'";
  $result=mysql_query($query);
  $row=mysql_fetch_object($result);
  $article_title=$row->article_title;
  $keywords=$row->keywords;
  $abstract=$row->abstract;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title; if($article_title) echo " - ".$article_title;?></title>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$abstract?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script>
function resizeImages(biggest_width) { 
if(document.getElementById("pic_show")) {
var table_obj   = document.getElementById("pic_show");
var width_value = table_obj.offsetWidth||table_obj.clientWidth;
if(width_value>biggest_width) width_value=biggest_width; 
var areaImages = document.getElementById("pic_show").getElementsByTagName("img"); 
var areaImagesCount = areaImages.length; 
var w = 0; 
for(var i=0;i<areaImagesCount;i++) { 
if(areaImages[i].width>width_value){ 
w = areaImages[i].width ; 
h = areaImages[i].height ;
areaImages[i].width = width_value; 
areaImages[i].height = h*width_value/w; 
  } 
  } 
 }
}
</script>
</head>
<body onLoad="resizeImages(<?=$cfg_body_width?>-300)">
<?php  require_once("header.php"); ?>
<?php 
  $id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."album where id=$id and hide_type='0'";
  $result=mysql_query($query);
  if($row=mysql_fetch_object($result)){
  $result_class=mysql_query("select class_name,id from  ".$table_suffix."infor where id={$row->class_id}");
  $class_name=mysql_result($result_class,0,"class_name");
  $infor_class="album";
  $class_id=mysql_result($result_class,0,"id");
  $article_title=$row->article_title;
  
  $query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$id}";
  $result_picture=mysql_query($query); 
?>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD valign="top" class=nav>您现在的位置:
            <?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?> 
      </TD>
        </TR></TBODY></TABLE>	    
	  <?php 
	   if(!mysql_num_rows($result_picture)) { 	  
	  ?>
	  <table width="100%" height="200"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center"><?php ShowMsg("Sorry! 没有找到相册内容...",-1); ?></div></td>
        </tr>
      </table>
	  <?php }  else {  
	    $query="select id from ".$table_suffix."comment where infor_class='album' and hide='0' and infor_id=$id";
	    $result_comment=mysql_query($query);
	    $num_of_comment=mysql_num_rows($result_comment);
	    
		$row_picture=mysql_fetch_object($result_picture);
		$picture_first=$row_picture->pic_url;
		$link_first=$row_picture->pic_link;
		$msg_first=$row_picture->pic_msg;
		$title_first=$row_picture->pic_title;
	  ?><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#DDDDDD">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF"><TABLE width="100%" border=0 align="center" cellPadding=0 cellSpacing=0>
            <TR>
              <TD align="center" valign="top" class=sml><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td><div align="center"><span class="newstitle"><font color="#FF0000">
                      <?=$row->article_title?>
                  </font></span></div></td>
                </tr>
                <tr>
                  <td><div align="center"> 发布： <font color="#FF6600">20<?=substr($row->post_time,0,8)?>
                      </font> 来源： <font color="#FF6600">
                      <?=$cfg_site_name?>
                      </font> 点击： <font color="#FF6600">
                      <?=$row->read_times?>
                  </font> 评论： 
                  <?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class=$infor_class&id=$row->id\">$num_of_comment</a>"; ?> 
                  <a href="#say" style="text-decoration:underline">我要评论</a> </div></td>
                </tr>
                <tr>
                  <td height="1" bgcolor="#E1E1E1"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td valign="top"><font color=blue>[相册简介]</font> <?=$row->content?></td>
                  </tr>
              </table></TD>
              <TD width="10" rowspan="2" align="center" valign="top" class=sml></TD>
              <TD width="220" rowspan="2" align="center" valign="top" class=sml><div align="left">
                  <?php 
				    $result_before=mysql_query("select id, article_title from ".$table_suffix."album where id < $id order by id desc limit 0, 1");
				    $result_after=mysql_query("select id, article_title from ".$table_suffix."album where id > $id order by id asc limit 0, 1");
				     $title_before=mysql_result($result_before,0,"article_title");
					 $title_after=mysql_result($result_after,0,"article_title");
					 $id_before=mysql_result($result_before,0,"id");
					 $id_after=mysql_result($result_after,0,"id");
				  ?>
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>上一篇：<?php if($title_before=="") echo "前面没有了"; else { ?><a style="text-decoration:underline; color:#003366" href="?id=<?=$id_before?>"><?=$title_before?></a><?php } ?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                    <tr>
                      <td>下一篇：<?php if($title_after=="") echo "后面没有了"; else { ?><a style="text-decoration:underline; color:#003366" href="?id=<?=$id_after?>"><?=$title_after?></a><?php }?></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                    </tr>
                  </table>
                 <?php 
				    $width=90;
					$height=90*$cfg_artsimg_height/$cfg_artsimg_width;
					echo "<TABLE width=\"100%\" border=0 align=\"center\" cellPadding=4 cellSpacing=1 bgColor=#999999>";
					$i_picture=1;
					$query="select * from ".$table_suffix."album where hide_type='0' order by top desc, top_time desc limit 0, 8";
					$result_album=mysql_query($query); 
					while($row_album=mysql_fetch_object($result_album)){
					$pic_id=$row_album->pic_id; 
                    $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                    $pic_row=mysql_fetch_object($pic_result);
					if($i_picture%2==1) echo "<TR>";
				    echo "<TD bgColor=black>";
	                echo "<DIV align=center>";
				    echo "<A href=\"?id=$row_album->id\">";
					$pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
					if(!empty($pic_url)) echo "<IMG height='$height' src=\"$pic_url\" alt=\"$row_album->article_title\" width='$width' border=0\">";
					else echo "<table width='$width' height='$height' border=0 cellpadding=0 cellspacing=0><tr>
                                <td><div align=center><A href=\"show_album.php?id=$row->id\"   target=_self>此文暂<br>无题图</A></div></td></tr>
                                </table>";
					echo "</A></DIV>";
                    echo "</TD>";
				   if($i_picture%2==0) echo "</TR>";
				   $i_picture++;
				   } 
				   echo "</TABLE>";
				   ?>                   
              </div></TD>
            </TR>
            <TR>
              <TD align="center" valign="top">
			  <table width="560" height="500"  border=0 align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" valign="middle">
                    <?php 
					$query="select * from  ".$table_suffix."picture where object_class='album_list' and object_id={$id}";
					$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				    $per_page_num=1;
				    $rows=@mysql_query($query);
				    $num=@mysql_num_rows($rows);
				    $page=intval(($num-1)/$per_page_num)+1;
				    if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
				    $page_front=($page_id<=1)?1:($page_id-1); 
				    $page_behind=($page_id>=$page)?$page:($page_id+1); 
				    @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
					
					for($i=1;$i<=$per_page_num;$i++)
				      { if($row_picture=@mysql_fetch_object($rows)){ 
					   $pic_url=$row_picture->pic_url;
					   $imgid=$row_picture->id;
					   $pic_title=$row_picture->pic_title;
	                   $pic_link=$row_picture->pic_link==""?$pic_url:$row_picture->pic_link;
					   $query_msg="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
	                   $result_msg=mysql_query($query_msg);
				       $row_msg=mysql_fetch_object($result_msg);
					   echo "<div align=\"center\" style=\"margin-top:20px\" id=\"pic_show\"><a href=\"".$pic_link."\" target=_blank><img id=\"pic_id".$imgid."\"  alt=\"".$pic_title."\" src=".$pic_url." border=\"1\" style=\"border:1px solid #000;\"></a><div>"; 
					   echo "<div align=\"center\" style=\"margin-top:20px\"><strong>{$pic_title}</strong></div>";
					   echo "<div align=\"left\" style=\"margin-top:20px; width:400px;\">{$row_msg->pic_msg}</div>";
					   } 
					  }
					 ?></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td><?php require_once("inc/page_divide.php");?></td>
                </tr>
              </table></TD>
              </TR>
          </TABLE></td>
        </tr>
      </table>
	  <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>	  <?php } ?>
	  </TD>
  </TR></TBODY></TABLE>  
  <table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>
	   <?php require_once("inc/similar_art.php"); ?>
	   <?php if($page_id==1) require_once("inc/add_times.php");//分别在文章表和索引表中更新点击数信息 ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
      <?php require_once("inc/comment_front.php"); ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
       <?php require_once("inc/add_comment.php");?>
	   <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table>
	   <BR>
	   </td></tr></table>
  <?php } else { ?>
  <table width="<?=$cfg_body_width?>" height="270" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><?php ShowMsg("Sorry! 相册不存在或者被隐藏...",-1); ?></div></td>
    </tr>
  </table>
  <?php } ?>
<?php   require_once("footer.php"); ?>
</body>
</html>
