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
  $pic_url=mysql_result(mysql_query("select * from  ".$table_suffix."picture where id={$_REQUEST['delete_id']}"),0,"pic_url");
  $pic_url=ereg_replace($cfg_mainsite,"../", $pic_url);
  if(is_file($pic_url)) $result=@unlink($pic_url); else $result=1;
  if($result)  $result=mysql_query("delete from ".$table_suffix."picture where id={$_REQUEST['delete_id']}");
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
<?php require_once(dirname(__FILE__)."/../admin/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="../<?=$cfg_admin_root?>image/body_title_bg.gif">
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
      </table></td>
    <td><div align="right">搜索数据库
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
    <td width="300"><div align="center">
        查看目录
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
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
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
  <table width="100%"  border="0" cellspacing="0" cellpadding="2">
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
      <td><div align="center">图片所属</div></td>
	  <td><div align="center">原图显示</div></td>
      <td><div align="center">缩略图</div></td>
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
      <td><div align="center"><?php 
	  echo "<a href=\"../show_".$object_class.".php?id=".$row->object_id." \" target=\"_blank\">".$imgdata[$object_class]; echo "-> <strong>".$row->object_id."</strong>";
	  echo "<br>"; echo $article_title==""?"<font color=red>无标题</font>":$article_title."</a>"; ?>
      </div></td>
	  <td><div align="center">
        <table width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td valign="middle" bgcolor="#FFFFFF"><div align="center"><a href="<?=$row->pic_url ?>" target="_blank"><img  id="pic_<?=$row->id?>" onload="reload_pic('pic_<?=$row->id?>',<?=$$img_small_w[$row->object_class]?>,<?=$$img_small_h[$row->object_class]?>);"  src="<?=$row->pic_url ?>" alt="<?=$row->title?>"    border="0"></a></div></td>
          </tr>
        </table>
		</div></td>
      <td><div align="center">
        <?php if($row->small_pic=="1")  { ?><table width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td align="center" valign="middle" bgcolor="#FFFFFF">
              <div align="center"><a href="../<?=$cfg_admin_root?>cut_pic.php?pic_url=<?=$row->pic_url?>&iwidth=<?=$$img_small_w[$row->object_class]?>&iheight=<?=$$img_small_h[$row->object_class]?>" target="_blank">
                <img id="lit<?=$row->id?>" src="<?=get_small_pic($row->pic_url)?>"  width="<?=$$img_small_w[$row->object_class]?>" height="<?=$$img_small_h[$row->object_class]?>" alt="" border="0"></a></div></td>
          </tr>
        </table>
        <?php } else { ?><a href="../<?=$cfg_admin_root?>cut_pic.php?pic_url=<?=$row->pic_url?>&iwidth=<?=$$img_small_w[$row->object_class]?>&iheight=<?=$$img_small_h[$row->object_class]?>" target="_blank">点击设置</a><?php } ?>
      </div></td>
	  <script>
	  function really() {
      result="该对象将被删除,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
      }
	  </script>
      <td><div align="center"><a  href="#" onClick="if(really()) no_show('?delete_id=<?=$row->id?>')" style="text-decoration:underline; ">删除图片</a></div></td>
    </tr>
     <?php } 
	     }
	   ?>
  </table>
  
<?php } 
 else { 
$base_dir=RROOT."/";
$activepath=$_REQUEST['activepath'];
$imgstick=$_REQUEST['imgstick'];
$f=$_REQUEST['f'];
$v=$_REQUEST['v'];
if(empty($imgstick))   $imgstick = "";
if($imgstick=="object_small")  $upload_child_dir=$cfg_obsmimg_root;
else if($imgstick=="column_small")  $upload_child_dir=$cfg_cosmimg_root;
else if($imgstick=="album")     $upload_child_dir=$cfg_album_root; 
else if($imgstick=="all")  $upload_child_dir=""; 
else $upload_child_dir=$cfg_img_root;

if(empty($activepath)) $activepath =ereg_replace("/$","",$cfg_upload_root.$upload_child_dir);

$activepath = str_replace("..","",$activepath);
$activepath = ereg_replace("^/{1,}","/",$activepath);

$inpath = $base_dir.$activepath; 

$activeurl = "..".$activepath;
if(empty($f)) $f="form1.picname";
if(empty($v)) $v="picview";

if(empty($comeback)) $comeback = "";

?>
  <div id="floater" class="napisdiv">
  <a href="javascript:nullLink();" onClick="ChangeImage('image/picviewnone.gif');"><img src='image/picviewnone.gif' name='picview' border='0' alt='单击关闭预览'></a>
  </div>
  <SCRIPT language=JavaScript src="js/float.js"></SCRIPT>
  <SCRIPT language=JavaScript>
function $DE(eid){ return document.getElementById(eid); }
function nullLink(){ return; }
function ChangeImage(surl){ if($DE('picview').src == surl) $DE('picview').src ="image/picviewnone.gif"; else  $DE('picview').src = surl; }
function ReturnImg(reimg)
{
	window.opener.document.<?php echo $f?>.value=reimg;
	if(window.opener.document.getElementById('<?php echo $v?>')){
		window.opener.document.getElementById('<?php echo $v?>').src = reimg;
	}
	if(document.all) window.opener=true;
  window.close();
}
</SCRIPT>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' align="center">
  <tr> 
  <td colspan='4' align='right'>
  <table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CBD8AC'>
  <tr bgcolor='#FFFFFF'> 
  <td colspan='4'>
  <table width='100%' border='0' cellspacing='0' cellpadding='2'>
  <tr bgcolor="#CCCCCC"> 
  <td width="62" align="left" background="image/wbg.gif" bgcolor='#EEF4EA' class='linerow'><div align="right"><strong>预览</strong></div></td>
  <td width="50%" align="left" background="image/wbg.gif" class='linerow'><strong>点击查看图片</strong></td>
  <td width="10%" align="left" background="image/wbg.gif" bgcolor='#EEF4EA' class='linerow'><strong>生成缩略</strong></td>
  <td width="15%" align="left" background="image/wbg.gif" bgcolor='#EEF4EA' class='linerow'><strong>文件大小</strong></td>
  <td width="20%" align="left" background="image/wbg.gif" class='linerow'><strong>最后修改时间</strong></td>
  </tr>
  <tr>
  <td class='linerow' colspan='4' bgcolor='#F9FBF0'>
  点击“V”预览图片，点击图片名选择图片，显示图片后点击该图片关闭预览。
  </td>
  </tr>
  <?php 

$dh = dir($inpath);
$ty1="";
$ty2="";
while($file = $dh->read()) {

 //-----计算文件大小和创建时间
 if($file!="." && $file!=".." && !is_dir("$inpath/$file")){
   $filesize = filesize("$inpath/$file");
   $filesize=$filesize/1024;
   if($filesize!="")
   if($filesize<0.1){
    @list($ty1,$ty2)=split("\.",$filesize);
    $filesize=$ty1.".".substr($ty2,0,2);
   }
   else{
    @list($ty1,$ty2)=split("\.",$filesize);
    $filesize=$ty1.".".substr($ty2,0,1);
  }
  $filetime = filemtime("$inpath/$file");
  $filetime = strftime("%y-%m-%d %H:%M:%S",$filetime);
 }
 
 if($file == ".") continue;
 else if($file == ".."){
   if($activepath == "") continue;
   $tmp = eregi_replace("[/][^/]*$","",$activepath);
   $line = "\n<tr>
   <td class='linerow' colspan='2' >
   <a href='?imgstick=$imgstick&v=$v&f=$f&activepath=".urlencode($tmp)."'><img src=image/dir2.gif border=0 width=16 height=16 align=absmiddle>上级目录</a></td>
   <td colspan='2' class='linerow' align=\"right\"> 当前目录:$activepath</td>
   </tr>
   ";
   echo $line;
}
else if(is_dir("$inpath/$file")){
   if(eregi("^_(.*)$",$file)) continue; #屏蔽FrontPage扩展目录和linux隐蔽目录
   if(eregi("^\.(.*)$",$file)) continue;
   $line = "\n<tr>
   <td bgcolor='#F9FBF0' class='linerow' colspan='2'>
   <a href='?imgstick=$imgstick&v=$v&f=$f&activepath=".urlencode("$activepath/$file")."'><img src=image/dir.gif border=0 width=16 height=16 align=absmiddle>$file</a></td>
   <td class='linerow'>　</td>
   <td bgcolor='#F9FBF0' class='linerow'>　</td>
   </tr>";
   echo "$line";
}
else if(eregi("\.(gif|png)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";

   $line = "\n<tr>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>
   <a href=\"#\" onClick=\"ChangeImage('$reurl');\"><img src='image/picviewnone.gif' width='16' height='16' border='0' align=absmiddle></a>
   </td>
   <td class='linerow' bgcolor='#F9FBF0'>
   <a href=\"$reurl\" target=\"_blank\" $lstyle><img src=image/gif.gif border=0 width=16 height=16 align=absmiddle>$file</a></td>
   <td class='linerow'> 设置缩略图 </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
   echo "$line";
 }
 else if(eregi("\.(jpg)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";

   $line = "\n<tr>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>
   <a href=\"#\" onClick=\"ChangeImage('$reurl');\"><img src='image/picviewnone.gif' width='16' height='16' border='0' align=absmiddle></a>
   </td>
   <td class='linerow' bgcolor='#F9FBF0'>
   <a href=\"$reurl\" target=\"_blank\" $lstyle><img src=image/jpg.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'> 设置缩略图 </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
   echo "$line";
 }
}//End Loop
$dh->close();
?>
  <tr> 
  <td colspan='4' bgcolor='#E8F1DE'>
  
<table width='100%'>
  <form action='select_images_post.php' method='POST' enctype="multipart/form-data" name='myform'>
  <input type='hidden' name='activepath' value='<?php echo $activepath?>'>
  <input type='hidden' name='f' value='<?php echo $f?>'>
  <input type='hidden' name='v' value='<?php echo $v?>'>
  <input type='hidden' name='imgstick' value='<?php echo $imgstick?>'>
  <input type='hidden' name='job' value='upload'>
  <tr>
  <td background="image/tbg.gif" bgcolor="#99CC00" style="clear:all">
  &nbsp;上　传:
    <input type='file' name='imgfile' style='width:200px' >
  &nbsp;
    图片调整                             
    <input name='resize' type='checkbox' style="clear:all" value='1' checked>
    <select name="picture_alt" id="picture_alt" onChange="input_wh();">
      <?php    
									    $conArray = &$picture_alt;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value;
										$option_i=explode(":",$$con_name);
										echo "<option value='{$con_name}'"; 
										if($con_name==4) echo "selected";
										echo ">{$option_i[0]}</option>";
										}
	                                ?>
    </select>
宽
<input type='text' style='width:30' name='iwidth' value='<?php echo $cfg_img_width?>'>
高
<input type='text' style='width:30' name='iheight' value='<?php echo $cfg_img_height?>'>
<script>
							 function input_wh() {
							     var picture_w=new Array(); 
							     var picture_h=new Array(); 
							   <?php    
									    $conArray = &$picture_alt;
										$i_select=0;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value;
										$option_i=explode(":",$$con_name);
										$option_i=explode(",",$option_i[1]);
										echo "picture_w[$i_select]=\"{$$option_i[0]}\"; ";
										echo "picture_h[$i_select]=\"{$$option_i[1]}\";\n";
										$i_select++;
										}
	                            ?>
							   var_i=document.all.picture_alt.value;
							   document.all.iwidth.value=picture_w[var_i];
							   document.all.iheight.value=picture_h[var_i];
							 }
							</script>
加水印
<select name="water" id="water">
  <option value="0" selected>不加</option>
  <option value="1">加</option>
</select>
<input type='submit' name='sb1' value='确定'>
  </td>
  </tr>
  </form>
  <form action='select_images_post.php' method='POST' name='myform2'>
  <input type='hidden' name='activepath' value='<?php echo $activepath?>' style='width:200'>
  <input type='hidden' name='f' value='<?php echo $f?>'>
  <input type='hidden' name='v' value='<?php echo $v?>'>
  <input type='hidden' name='imgstick' value='<?php echo $imgstick?>'>
  <input type='hidden' name='job' value='newdir'>
  <tr>
    <td background="image/tbg.gif" bgcolor='#66CC00'> &nbsp;新目录： 
    <input type='text' name='dirname' value='' style='width:150'>
    <input type='submit' name='sb2' value='创建' style='width:40'>
  </td>
  </tr>
  </form>
  </table>
  
</td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
<?php  }
?></td></tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 10px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 10px"></IFRAME>
</div>
</html>