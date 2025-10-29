<?php 
session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}scripts/constant.php");
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
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>图片浏览器</title>
<link href='../<?=$cfg_admin_root?>css/admin.css' rel='stylesheet' type='text/css'>
<style>
.linerow {border-bottom: 1px solid #CBD8AC;}
.napisdiv {left:87px;top:5px;width:150;height:100;position:absolute;z-index:3}
</style>
</head>
<body background='image/allbg.gif' leftmargin='0' topmargin='0'>
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
<td width="62" align="center" background="image/wbg.gif" bgcolor='#EEF4EA' class='linerow'><div align="right"><strong>预览</strong></div></td>
<td width="47%" align="center" background="image/wbg.gif" class='linerow'><strong>点击名称选择图片</strong></td>
<td width="15%" align="center" background="image/wbg.gif" bgcolor='#EEF4EA' class='linerow'><strong>文件大小</strong></td>
<td width="30%" align="center" background="image/wbg.gif" class='linerow'><strong>最后修改时间</strong></td>
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
   <td class='linerow' colspan='2'>
   <a href='select_images.php?imgstick=$imgstick&v=$v&f=$f&activepath=".urlencode($tmp)."'><img src=image/dir2.gif border=0 width=16 height=16 align=absmiddle>上级目录</a></td>
   <td colspan='2' class='linerow'> 当前目录:$activepath</td>
   </tr>
   ";
   echo $line;
}
else if(is_dir("$inpath/$file")){
   if(eregi("^_(.*)$",$file)) continue; #屏蔽FrontPage扩展目录和linux隐蔽目录
   if(eregi("^\.(.*)$",$file)) continue;
   $line = "\n<tr>
   <td bgcolor='#F9FBF0' class='linerow' colspan='2'>
   <a href='select_images.php?imgstick=$imgstick&v=$v&f=$f&activepath=".urlencode("$activepath/$file")."'><img src=image/dir.gif border=0 width=16 height=16 align=absmiddle>$file</a></td>
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
   <a href=# onclick=\"ReturnImg('$reurl');\" $lstyle><img src=image/gif.gif border=0 width=16 height=16 align=absmiddle>$file</a></td>
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
   <a href=# onclick=\"ReturnImg('$reurl');\" $lstyle><img src=image/jpg.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
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
                             宽<input type='text' style='width:30' name='iwidth' value='<?php echo $cfg_img_width?>'>
                             高<input type='text' style='width:30' name='iheight' value='<?php echo $cfg_img_height?>'>
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
							</script>加水印
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
</body>
</html>