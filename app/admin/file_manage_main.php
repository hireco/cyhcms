<?php 
session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");

$base_dir=RROOT;

$activepath=$_REQUEST['activepath'];

if(empty($activepath)) $activepath =""; 

$inpath = $base_dir.$activepath; 

$activeurl = $base_dir.$activepath;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>文件管理器</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once(dirname(__FILE__)."/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
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
                <td><img src="../image/body_title_left.gif" width="3" height="27" /></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                    <div align="center" class="bigtext_b">文件管理器</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27" /></td>
              </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<?php if($_SESSION['root']=="super_administrator") { ?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" align="center" class="tbtitle" style="background:#E2F5BC;">
<tr height='24'> 
                      <td width="28%" align="center" bgcolor="#EDF9D5"><strong>文件名</strong></td>
                      <td width="16%" align="center" bgcolor="#EDF9D5"><strong>文件大小</strong></td>
                      <td width="22%" align="center" bgcolor="#EDF9D5"><strong>最后修改时间</strong></td>
                      <td width="34%" align="center" bgcolor="#EDF9D5"><strong>操作</strong></td>
  </tr>
                    <?php 
$dh = dir($inpath);
$ty1="";
$ty2="";
while($file = $dh->read()) {
     if($file!="." && $file!=".." && !is_dir("$inpath/$file"))
     {
       @$filesize = filesize("$inpath/$file");
       @$filesize=$filesize/1024;
       @$filetime = filemtime("$inpath/$file");
       @$filetime = strftime("%y-%m-%d %H:%M:%S",$filetime);
       if($filesize!="")
       if($filesize<0.1)
       {
         @list($ty1,$ty2)=explode(".",$filesize);
         $filesize=$ty1.".".substr($ty2,0,2);
       }
       else
       {
          @list($ty1,$ty2)=explode(".",$filesize);
          $filesize=$ty1.".".substr($ty2,0,1);
       }
     }
     if($file == ".") continue;
     else if($file == ".."){
            if($activepath == "") $present_path="/"; else $present_path=$activepath;
            $tmp = eregi_replace("[/][^/]*$","",$activepath);
			$line = "\n<tr height='22' bgcolor='#FFFFFF'>
            <td>
            <a href=file_manage_main.php?activepath=".urlencode($tmp)."><img src=../file_do/image/dir2.gif border=0 width=16 height=16 align=absmiddle>上级目录</a>
            </td>
            <td colspan='3' >
             当前目录:$present_path &nbsp;
             <a href='file_pic_view.php?activepath=".urlencode($activepath)."' style='color:red'>[图片浏览器]</a>
             </td>
            </tr>";
            echo $line;
      }
      else if(is_dir("$inpath/$file")){
             if(eregi("^_(.*)$",$file)) continue; #屏蔽FrontPage扩展目录和linux隐蔽目录
             if(eregi("^\.(.*)$",$file)) continue;
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
              <a href=file_manage_main.php?activepath=".urlencode("$activepath/$file")."><img src=../file_do/image/dir.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>　</td>
             <td>　</td>
             <td>
             <a href=file_manage_view.php?filename=".urlencode($file)."&activepath=".urlencode($activepath)."&fmdo=rename>[改名]</a>
             &nbsp;
             <a href=file_manage_view.php?filename=".urlencode($file)."&activepath=".urlencode($activepath)."&type=dir&fmdo=del>[删除]</a>
             </td>
             </td>
             </tr>";
             echo "$line";
      }
      else if(eregi("\.(gif|png)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/gif.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
     else if(eregi("\.(jpg)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/jpg.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(swf|fla|fly)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/flash.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(zip|rar|tar.gz)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/zip.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(exe)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/exe.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(mp3|wma)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/mp3.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(wmv|api)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/wmv.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(rm|rmvb)",$file)){
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/rm.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
     else if(eregi("\.(txt|inc|pl|cgi|asp|xml|xsl|aspx|cfm)",$file))
     {
             
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/txt.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='$edurl'>[编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
     else if(eregi("\.(htm|html)",$file))
     {
            
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/htm.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='$edurl'>[编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(php)",$file))
     {
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\"  bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/php.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='$edurl'>[编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(js)",$file))
     {
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             $line = "\n<tr onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\"  bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/js.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='$edurl'>[编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
	 else if(eregi("\.(css)",$file))
     {
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\"  bgcolor='#FFFFFF'>
             <td>
             <a href=$activeurl/$file target=_blank><img src=../file_do/image/css.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td>$filesize KB</td>
             <td align='center'>$filetime</td>
             <td>
             <a href='$edurl'>[编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
             echo "$line";
     }
     else
     {
             $line = "\n<tr height='22' onMouseMove=\"javascript:this.bgColor='#F9FBF0';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\" bgcolor='#FFFFFF'>
              <td><a href=$activeurl/$file target=_blank><img src=../file_do/image/none.jpg border=0 width=16 height=16 align=absmiddle> $file</td>
              <td>$filesize KB</td>
              <td align='center'>$filetime</td>
              <td>
              <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
              &nbsp;
              <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
              &nbsp;
              <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
              </td>
              </tr>";
              echo "$line";
     }
}
$dh->close();
?>
                    <tr bgcolor="#FFCC99"> 
                      <td height='24' colspan="4" align="left">
                      	<a href='file_manage_main.php'>[根目录]</a>
                      	&nbsp;
                      	<a href='file_manage_view.php?fmdo=newfile&activepath=<?php echo urlencode($activepath)?>'>[新建文件]</a>
                      	&nbsp;
                      	<a href='file_manage_view.php?fmdo=newdir&activepath=<?php echo urlencode($activepath)?>'>[新建目录]</a>
                      	&nbsp;
                      	<a href='file_manage_view.php?fmdo=upload&activepath=<?php echo urlencode($activepath)?>'>[文件上传]</a>
                      	&nbsp;
                      	<a href='file_manage_view.php?fmdo=space&activepath=<?php echo urlencode($activepath)?>'>[空间检查]</a>
                      	&nbsp;&nbsp;</td>
  </tr>
</table>
<?php } else ShowMsg("对不起,您无权限访问此页面",-1); ?>
</body>
</html>