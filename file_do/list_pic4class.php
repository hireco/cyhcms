<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}scripts/constant.php");
require_once(dirname(__FILE__)."/../inc/often_function.php");

$v=$_REQUEST['v'];
$f=$_REQUEST['f'];
$l=$_REQUEST['l'];
$t=$_REQUEST['t'];

if(empty($f)) $f="form1.picname";
if(empty($v)) $v="picview";

if(isset($_REQUEST['delete_id'])) { 
  $pic_url=mysql_result(mysql_query("select * from  ".$table_suffix."picture  where id={$_REQUEST['delete_id']}"),0,"pic_url");
  $pic_url=ereg_replace($cfg_mainsite,"../", $pic_url);
  if(is_file($pic_url)) $result=@unlink($pic_url); else $result=1;
  if($result)  $result=mysql_query("delete from ".$table_suffix."picture  where id={$_REQUEST['delete_id']}");
  if($result)  {
    echo "<script>opener.location.reload()</script>";
	echo "<script>window.close();</script>";
   }
  else  echo "<script>alert(\"对不起,删除失败,请重来!\");window.close();</script>";
 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../<?=$cfg_admin_root?>css/admin.css" rel="stylesheet" type="text/css">
<title>选择图片并返回</title>
<script>
function no_show(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
function reload_pic(main_pic,maxWidth,maxHeight) {
    var imageArr=document.getElementById(main_pic);
    var imageRate = imageArr.offsetWidth / imageArr.offsetHeight;    
    
    if(imageArr.offsetWidth > maxWidth)
    {
        imageArr.style.width=maxWidth + "px";
        imageArr.style.Height=maxWidth / imageRate + "px";
    }
    
    if(imageArr.offsetHeight > maxHeight)
    {
        imageArr.style.width = maxHeight * imageRate + "px";
        imageArr.style.Height = maxHeight + "px";
    }
 }
</script>
<script>
function select_picture(getstr)
{
	var qstr,qstrs;
    qstrs = new Array(3);
    if(getstr!="") qstr = getstr;
	
	if(qstr=="") alert("你没选中任何内容！");
	else
	{
		qstrs = qstr.split("`");
		if(window.opener.document.getElementById('picture_title_select')) { 
		window.opener.document.form1.picture_select.value=qstrs[0];
		window.opener.document.form1.picture_title_select.value=qstrs[1];
		window.opener.document.form1.picture_link_select.value=qstrs[2];
		window.opener.document.all.picview.src=qstrs[0]; 
		}
		else {
		 window.opener.document.<?php echo $f?>.value=qstrs[0];
		 window.opener.document.<?php echo $l?>.value=qstrs[2];
		 window.opener.document.<?php echo $t?>.value=qstrs[1];
	     if(window.opener.document.getElementById('<?php echo $v?>')){
		 window.opener.document.getElementById('<?php echo $v?>').src = qstrs[0];
		 
	       }
		}
		window.opener=true;
    	window.close();
    }
}
</script>
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" background="../<?=$cfg_admin_root?>image/body_title_bg.gif">
      <tr>
        <td><table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>
                <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="../<?=$cfg_admin_root?>image/body_title_left.gif" width="3" height="27" /></td>
                    <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                        <div align="center" class="bigtext_b">图片浏览</div>
                    </div></td>
                    <td><img src="../<?=$cfg_admin_root?>image/body_title_right.gif" width="3" height="27" /></td>
                  </tr>
              </table></td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <div align="center"> </div></td>
        <td width="300"><div align="right">搜索数据库
                <select name='select_data' onchange="location=this.value;">
                  <?php    
									    $conArray = &$imgdata;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='?img_class={$con_name}&f={$_REQUEST['f']}&v={$_REQUEST['v']}&l={$_REQUEST['l']}&t={$_REQUEST['t']}'"; 
										if($con_name==$_REQUEST['img_class']) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                </select>
        </div></td>
        <td width="300"><div align="center">查看目录
                <select name='select_dir'  onchange="location=this.value;">
                  <?php    
									    $conArray = &$imglist;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='?imgstick={$con_name}&f={$_REQUEST['f']}&v={$_REQUEST['v']}&l={$_REQUEST['l']}&t={$_REQUEST['t']}'"; 
										if($con_name==$_REQUEST['imgstick']) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                </select>
        </div></td>
      </tr>
    </table>
      <?php
   if(isset($_REQUEST['img_class'])) {
   if($_REQUEST['img_class']=="all")           $query="select * from ".$table_suffix."picture order by id desc"; 
   else if($_REQUEST['img_class']=="article")  $query="select * from ".$table_suffix."picture where object_class='article' order by id desc";
   else if($_REQUEST['img_class']=="ftp")      $query="select * from ".$table_suffix."picture where object_class='ftp' order by id desc";
   else if($_REQUEST['img_class']=="soft")     $query="select * from ".$table_suffix."picture where object_class='soft' order by id desc";
   else if($_REQUEST['img_class']=="zhuanti")  $query="select * from ".$table_suffix."picture where object_class='zhuanti' order by id desc";  
   else if($_REQUEST['img_class']=="album")    $query="select * from ".$table_suffix."picture where object_class='album' order by id desc";
   else if($_REQUEST['img_class']=="member")   $query="select * from ".$table_suffix."picture where object_class='member' order by id desc";
   else if($_REQUEST['img_class']=="album_list")    $query="select * from ".$table_suffix."picture where object_class='album_list' order by id desc";
   
   $per_page_num=isset($_REQUEST['per_page_num'])?$_REQUEST['per_page_num']:15;
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
 ?>
      <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td><div align="left">
              <table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td><div align="left">
                      <?php require_once(dirname(__FILE__)."/../{$cfg_admin_root}function/page_divide.php"); ?>
                  </div></td>
                </tr>
              </table>
          </div></td>
          <td width="20">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td><div align="center">点击选择</div></td>
          <td><div align="center">图片显示</div></td>
          <td><div align="center">缩略图</div></td>
          <td><div align="center">名称和所属</div></td>
          <td><div align="center">删除图片</div></td>
        </tr>
        <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 if($row->object_class=="album_list")    $object_class="album"; 
		     else $object_class=$row->object_class; 
             $query="select article_title from ".$table_suffix."infor_index where infor_id={$row->object_id} and infor_class='$object_class'";
			 $row_title=mysql_fetch_object(mysql_query($query));
			 $article_title=$row_title->article_title;
		 ?>
        <tr bgcolor="#FFFFFF">
          <td><div align="center"><a href='#' onClick="select_picture('<?php 
		  if($pic_title=="") $pic_title=$article_title;
		  if($pic_link=="")  $pic_link=$cfg_mainsite."show_".$object_class.".php?id=".$row->object_id;
		  echo $row->pic_url."`".$pic_title."`".$pic_link;
		  ?>')">选择图片</a></div></td>
          <td><div align="center">
              <table width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td valign="middle" bgcolor="#FFFFFF"><div align="center"><a href="<?=$row->pic_url ?>" target="_blank"><img  id="pic_<?=$row->id?>" onload="reload_pic('pic_<?=$row->id?>',<?=$$img_small_w[$row->object_class]?>,<?=$$img_small_h[$row->object_class]?>);"  src="<?=$row->pic_url ?>" alt="<?=$row->title?>"    border="0"></a></div></td>
                </tr>
              </table>
          </div></td>
          <td><div align="center">
              <?php if($row->small_pic=="1")  { ?>
              <table width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td align="center" valign="middle" bgcolor="#FFFFFF">
                    <div align="center"><a href="../<?=$cfg_admin_root?>cut_pic.php?pic_url=<?=$row->pic_url?>&iwidth=<?=$$img_small_w[$row->object_class]?>&iheight=<?=$$img_small_h[$row->object_class]?>" target="_blank"> <img id="lit<?=$row->id?>" src="<?=get_small_pic($row->pic_url)?>"  width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" alt="" border="0"></a></div></td>
                </tr>
              </table>
              <?php } else { ?>
              <a href="../<?=$cfg_admin_root?>cut_pic.php?pic_url=<?=$row->pic_url?>&iwidth=<?=$$img_small_w[$row->object_class]?>&iheight=<?=$$img_small_h[$row->object_class]?>" target="_blank">点击设置</a>
              <?php } ?>
          </div></td>
          <td><div align="center"> <?php echo $pic_title==""?"<font color=red>无标题</font>":$pic_title?> </div>            <div align="center">
              <?php echo "<a href=\"../show_".$object_class.".php?id=".$row->object_id." \" target=\"_blank\">".$imgdata[$object_class]; echo "-> <strong>".$row->object_id."</strong></a>"; ?>
            </div></td>
          <td><div align="center"><?php echo "<a  href=\"javascript:no_show('?delete_id=$row->id')\">删除图片</a>"; ?></div></td>
        </tr>
        <?php } 
	     }
	   ?>
      </table>
    <?php } 
 else  require_once("select_images.php");

?></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 10px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 10px"></IFRAME>
</div>
</html>
