<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
if(isset($_POST['submit_temp'])) {  
          $template_list=$_POST['template_list'];
		  $template_list=implode(",",$template_list);
		  if($template_list<>"") 
		  $result=mysql_query("update ".$table_suffix.$_REQUEST['for_class']." set template_list='$template_list' where id={$_REQUEST['for_id']}");
		  if($result) ShowMsg("恭喜,设置成功",-1);
		  else  ShowMsg("对不起,设置没有成功,请稍后再来",-1);
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="javascript" src="js/flash.js" type="text/javascript"></script>
<script language="javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
	window.open(URLStr, 'popUpWin', 'scrollbars=yes,resizable=yes,statebar=yes,width='+width+',height='+(screen.height-100)+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
	<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td>        <div align="left">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b">模版选取</div></div>						</td>                   
                  </tr>
              </table></td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
      </table>
    </div></td></tr>
</table>
	<table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td></td>
      </tr>
    </table>
	   <table width="100%"  border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td><form name="form1" id="form1" method="post" action="">
             <table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="10" align="center" bgcolor="#EDF9D5"></td>
      <td align="center" bgcolor="#EDF9D5"><div align="left"><strong>预览文件</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>文件大小</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>最后修改时间</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>操作</strong></div></td>
    </tr>
	<?php 
	$base_dir=RROOT;
	$activepath=$_REQUEST['activepath'];
	$for_id=$_REQUEST['for_id'];
	$for_class=$_REQUEST['for_class'];
	if(empty($activepath)) $activepath="/template/";
	$inpath = $base_dir.$activepath; 
	$activeurl = $base_dir.$activepath;
	
	$dh = dir($inpath);
	$ty1="";$ty2="";
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
      else if($file == "..") continue;
       if(eregi("\.(htm)",$file)||eregi("\.(html)",$file)||eregi("\.(php)",$file))
     {
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             echo "\n<tr height='22'";
			 if($_REQUEST['dir'].$_REQUEST['file']=="$activepath$file")  echo "bgcolor='yellow'>"; else echo "bgcolor='#FFFFFF'>"; 
             echo "<td width=10></td>
			 <td align='left'><input name=\"template_list[]\" type=\"checkbox\" id=\"template_list\" value=\"$file\" /> <a href=".$activepath."/".$file." target=_blank><img src=../file_do/image/php.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td align='left'>$filesize KB</td>
             <td align='left'>$filetime</td>
             <td align='left'>
             <a href='$edurl'>[文本编辑]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[改名]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[删除]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[移动]</a>
             </td>
             </tr>";
     }
   }
$dh->close();?>		
    </table></td>
               </tr>
               <tr>
                 <td>
				 <?php  if(!isset($_REQUEST['description']))  { ShowMsg("操作不明确,返回中...",-1);  exit; } else { 
				  $result=mysql_query("select template_list from ".$table_suffix.$_REQUEST['for_class']."  where id={$_REQUEST['for_id']}");
				  if($result) $template_list=mysql_result($result,0,"template_list"); else echo "Wrong!";
				 ?>
				 <table width="98%"  border="0" align="center" cellpadding="5" cellspacing="0">
                   <tr bgcolor="#EDF9D5">
                     <td>您现在的操作是 </td>
                     <td colspan="2"><?php echo $_REQUEST['description']; ?></td>
                   </tr>
                   <tr>
                     <td width="200">系统已经添加的模版有</td>
                     <td colspan="2"><?=$template_list==""?"默认设置":$template_list?></td>
                   </tr>
                   <tr>
                     <td>选择并提交新的模版 </td>
                     <td width="100"><input name="submit_temp" type="submit" class="inputbut" id="submit_temp" value="提  交" />                       </td>
                     <td><font color="#FF3300">请注意,不要选错,否则前台显示出错!</font></td>
                   </tr>
                 </table>
				 <?php } ?>				 </td>
               </tr>
             </table>
           </form></td>
         </tr>
       </table></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
function check_form() {
 if(document.all.filename.value=="") { 
 alert("没有填写文件名！");
 document.all.filename.focus();
 return false;
  }
  return true;
}
function set_wh() {
  if(document.all.flash_style.value=="index")  {document.all.width.value="220"; document.all.height.value="181";}
  else if(document.all.flash_style.value=="twpd")  {document.all.width.value="305"; document.all.height.value="200";}
  else {document.all.width.value="480"; document.all.height.value="270";}
}
</script>
<?php } ?>