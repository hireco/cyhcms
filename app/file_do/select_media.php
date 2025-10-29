<?php 
session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");

$base_dir=RROOT."/";
$activepath=$_REQUEST['activepath'];

if($_REQUEST['med_class']=="flash")  $upload_child_dir=$cfg_flash_root;
else  $upload_child_dir=$cfg_media_root;

if(empty($activepath)) $activepath =ereg_replace("/$","",$cfg_upload_root.$upload_child_dir);

$f=$_REQUEST['f'];
$comeback=$_REQUEST['comeback'];

if(empty($activepath)) $activepath =ereg_replace("/","",$cfg_upload_root);
else $activepath =ereg_replace("/$","",$activepath);

$activepath = str_replace("..","",$activepath);
$activepath = ereg_replace("^/{1,}","/",$activepath);

$inpath = $base_dir.$activepath; 
$activeurl=$activepath;
if(empty($f)) $f="form1.enclosure";

if(empty($comeback)) $comeback = "";

?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>媒体文件管理器</title>
<link href='../<?=$cfg_admin_root?>css/admin.css' rel='stylesheet' type='text/css'>
<style>
.linerow {border-bottom: 1px solid #CBD8AC;}
</style>
</head>
<body background='image/allbg.gif' leftmargin='0' topmargin='0'>
<SCRIPT language='JavaScript'>
function nullLink()
{
	return;
}
function ReturnValue(reimg)
{
	window.opener.document.<?php echo $f?>.value=reimg;
	if(document.all) window.opener=true;
  window.close();
}
</SCRIPT>
<table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CBD8AC' align="center">
<tr bgcolor='#FFFFFF'> 
<td colspan='3'>
<!-- 开始文件列表  -->
<table width='100%' border='0' cellspacing='0' cellpadding='2'>
<tr bgcolor="#CCCCCC"> 
<td width="55%" align="center" background="image/wbg.gif" class='linerow'><strong>点击名称选择文件</strong></td>
<td width="15%" align="center" bgcolor='#EEF4EA' class='linerow'><strong>文件大小</strong></td>
<td width="30%" align="center" background="image/wbg.gif" class='linerow'><strong>最后修改时间</strong></td>
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
 
 //------判断文件类型并作处理
 if($file == ".") continue;
 else if($file == "..")
 {
    if($activepath == "") continue;
    $tmp = eregi_replace("[/][^/]*$","",$activepath);
    $line = "\n<tr>
    <td class='linerow'> <a href=select_media.php?f=$f&activepath=".urlencode($tmp)."><img src=image/dir2.gif border=0 width=16 height=16 align=absmiddle>上级目录</a></td>
    <td colspan='2' class='linerow'> 当前目录:$activepath</td>
    </tr>\r\n";
    echo $line;
}
else if(is_dir("$inpath/$file"))
{
   if(eregi("^_(.*)$",$file)) continue; #屏蔽FrontPage扩展目录和linux隐蔽目录
   if(eregi("^\.(.*)$",$file)) continue;
     $line = "\n<tr>
   <td bgcolor='#F9FBF0' class='linerow'>
    <a href=select_media.php?f=$f&activepath=".urlencode("$activepath/$file")."><img src=image/dir.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>-</td>
   <td bgcolor='#F9FBF0' class='linerow'>-</td>
   </tr>";
   echo "$line";
}
else if(eregi("\.(swf|fly|fla)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";
   
   $line = "\n<tr>
   <td class='linerow' bgcolor='#F9FBF0'>
     <a href=\"javascript:ReturnValue('$reurl');\"><img src=image/flash.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
    echo "$line";
}
else if(eregi("\.(wmv|api)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";
   
   $line = "\n<tr>
   <td class='linerow' bgcolor='#F9FBF0'>
     <a href=\"javascript:ReturnValue('$reurl');\"><img src=image/wmv.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
    echo "$line";
}
else if(eregi("\.(rm|rmvb)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";
   
   $line = "\n<tr>
   <td class='linerow' bgcolor='#F9FBF0'>
     <a href=\"javascript:ReturnValue('$reurl');\"><img src=image/rm.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
    echo "$line";
}
else if(eregi("\.(mp3|wma)",$file)){
   
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";
   
   $line = "\n<tr>
   <td class='linerow' bgcolor='#F9FBF0'>
     <a href=\"javascript:ReturnValue('$reurl');\"><img src=image/mp3.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
    echo "$line";
}
else
{
   $reurl = "$activeurl/$file";
   $reurl = ereg_replace("^\.\.","",$reurl);
   $reurl = $cfg_mainsite.$reurl;
   
   if($file==$comeback) $lstyle = " style='color:red' ";
   else  $lstyle = "";
   
   $line = "\n<tr>
   <td class='linerow' bgcolor='#F9FBF0'>
     <a href=\"javascript:ReturnValue('$reurl');\"><img src=image/exe.gif border=0 width=16 height=16 align=absmiddle>$file</a>
   </td>
   <td class='linerow'>$filesize KB</td>
   <td align='center' class='linerow' bgcolor='#F9FBF0'>$filetime</td>
   </tr>";
   echo "$line";
}
}//End Loop
$dh->close();
?>
<!-- 文件列表完 -->
<tr> 
<td colspan='3' bgcolor='#E8F1DE'>

<table width='100%'>
<form action='select_media_post.php' method='POST' enctype="multipart/form-data" name='myform'>
<input type='hidden' name='activepath' value='<?php echo $activepath?>'>
<input type='hidden' name='f' value='<?php echo $f?>'>
<input type='hidden' name='job' value='upload'>
<tr>
<td background="image/tbg.gif" bgcolor="#99CC00">
  &nbsp;上　传： <input type='file' name='uploadfile' style='width:200'>
  改名：<input type='text' name='filename' value='' style='width:100'>
  <input type='submit' name='sb1' value='确定'>
</td>
</tr>
</form>
<form action='select_media_post.php' method='POST' name='myform2'>
<input type='hidden' name='activepath' value='<?php echo $activepath?>' style='width:200'>
<input type='hidden' name='f' value='<?php echo $f?>'>
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

</body>
</html>
