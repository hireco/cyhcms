<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
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
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if(basename($_SERVER['PHP_SELF'])=="flash.php") echo "bgcolor=\"#FFFFFF\""?>>
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b"><a href="flash.php">��������</a></div>
                    </div></td>
                    
                  </tr>
              </table></td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td><table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if(basename($_SERVER['PHP_SELF'])=="flash_edit.php") echo "bgcolor=\"#FFFFFF\""?>>
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b"><a href="flash_edit.php">���ж���</a></div>
                    </div></td>
                    
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
	<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="10" align="center" bgcolor="#EDF9D5"></td>
      <td align="center" bgcolor="#EDF9D5"><div align="left"><strong>Ԥ���ļ�</strong></div></td>
	  <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>�����ļ�</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>�ļ���С</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>����޸�ʱ��</strong></div></td>
      <td  align="center" bgcolor="#EDF9D5"><div align="left"><strong>����</strong></div></td>
    </tr>
	<?php 
	$base_dir=RROOT;
	$activepath="/inc/flash/";
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
	 if(eregi("\.(php)",$file))
     {
             $edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file)."&activepath=".urlencode($activepath);
             echo "\n<tr height='22'";
			 if($_REQUEST['dir'].$_REQUEST['file']=="$activepath$file")  echo "bgcolor='yellow'>"; else echo "bgcolor='#FFFFFF'>"; 
             echo "<td width=10></td>
			 <td align='left'><a href=../flash.php?file=inc/flash/$file target=_blank><img src=../file_do/image/php.gif border=0 width=16 height=16 align=absmiddle> $file</a></td>
             <td align='left'><a href=flash_edit.php?dir=$inpath&file=$file>�������</a></td>
			 <td align='left'>$filesize KB</td>
             <td align='left'>$filetime</td>
             <td align='left'>
             <a href='$edurl'>[�ı��༭]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[����]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[ɾ��]</a>
             &nbsp;
             <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file)."&activepath=".urlencode($activepath)."'>[�ƶ�]</a>
             </td>
             </tr>";
     }
   }
$dh->close();?>		
    </table>
	<?php 
	 if(is_file($_REQUEST['dir'].$_REQUEST['file'])) {
	  $fileread=$_REQUEST['dir'].$_REQUEST['file'];
      $fp=fopen($fileread,"r");
      $string_read=fread($fp,filesize($fileread));
      fclose($fp);
	  $string_read=explode("<!---top--->",$string_read);
	  $tempfile=$_REQUEST['dir']."temp";
      $fp=fopen($tempfile,"w");
      $result=fwrite($fp,$string_read[0]);
      fclose($fp);
	  require_once($tempfile);
  } 
    
 if(isset($_REQUEST['file'])) { 
	?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="action/flash_add_action.php" enctype="multipart/form-data" onsubmit="return check_form();">
                <table width="100%"  border="0" cellspacing="4" cellpadding="0" id="needset">
                  <tr>
                    <td> </td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="90">�������</td>
                          <td>
                            <select name="flash_style" id="flash_style" onchange="set_wh();">
                              <option value="index" <?php if($flash_style=="index") echo "selected"; ?>>������ʽ</option>
                              <option value="twpd"  <?php if($flash_style=="twpd") echo "selected"; ?>>Ѥ��ģʽ</option>
                              <option value="kuan"  <?php if($flash_style=="kuan") echo "selected"; ?>>������ʽ</option>
                            </select>
                            ͼƬ��ȣ�
                              <input name="width" id="width"value="<?php if(isset($width)) echo $width; else echo "220"; ?>" size="5">
                            �߶ȣ�<input name="height" id="height"value="<?php if(isset($height)) echo $height; else echo "181"; ?>" size="5">
            ����            
            <input name="num_of_img" type="hidden" id="num_of_img" value="12" /></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="90">&nbsp;ͼƬ������</td>
                          <td><input name="picnum" type="text" id="picnum" style="width:30px" value="3"/>
                              <input name="add_picnum" type="button" id="add_picnum" onclick="MakeUpload(0);" value="����ͼƬ����"/>
            �� ע�����10���� </td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>
	   <?php 	  
	   $string=explode("&",$string);
	   $pic_url=explode("|",ereg_replace("pics=","",$string[0]));
	   $pic_link=explode("|",ereg_replace("links=","",$string[1]));
	   $pic_title=explode("|",ereg_replace("texts=","",$string[2]));
	   
	   for($j=1;$j<=count($pic_url);$j++) {
	   $fhtml = "";
	   $fhtml .= "<table width='100%'><tr><td><input type='checkbox' name='isokcheck$j' id='isokcheck$j' value='1'   onClick='CheckSelTable($j)' checked='checked'>��ʾͼƬ[$j]��ѡ��</td></tr></table>";
	   $fhtml .= "<table width=\"100%\" border=\"0\" id=\"seltb$j\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#E8F5D6\" style=\"margin-bottom:6px;margin-left:10px\"><tobdy>";
	   $fhtml .= "<tr bgcolor=\"#F4F9DD\">\r\n";
	   $fhtml .= "<td height=\"25\" colspan=\"2\">��<strong>ͼƬ{$j}��</strong></td>";
	   $fhtml .= "</tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td width=\"40%\" height=\"25\"> �������ϴ��� ";
	   $fhtml .= "<input type=\"file\" name='imgfile$j' style=\"width:330px\" onChange=\"SeePic(document.picview$j,document.form1.imgfile$j);\"></td>";
	   $fhtml .= "<td width=\"60%\" rowspan=\"3\" align=\"center\"><a href=\"cut_pic.php?pic_url={$pic_url[$j-1]}&iwidth=$width&iheight=$height&cut_self\" target=\"_blank\"><img alt=\"������вü�\" src=\"{$pic_url[$j-1]}\" onload=\"javascripts: if(this.width>300) this.width=300; \" id=\"picview$j\" border=\"0\" name=\"picview$j\"></a></td>";
	   $fhtml .= "</tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> ��ָ����ַ�� ";
	   $fhtml .= "<input type=\"text\" name='imgurl$j' style=\"width:260px\" value=\"{$pic_url[$j-1]}\" > ";
	   $fhtml .= "<input type=\"button\" name='selpic$j' value=\"ѡȡ\" style=\"width:65px\" onClick=\"SelectImageN('form1.imgurl$j','big','picview$j')\" class=\"inputbut\">";
	   $fhtml .= "</td></tr>"; 
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> ��ͼƬ���⣺ ";
	   $fhtml .= "<input type=\"text\" name='imgtitle$j' style=\"width:260px\" value=\"{$pic_title[$j-1]}\"> ";
	   $fhtml .= "</td></tr>";
	   $fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	   $fhtml .= "<td height=\"25\"> ��ͼƬ���ӣ� ";
	   $fhtml .= "<input type=\"text\" name='imglink$j' style=\"width:260px\"  value=\"{$pic_link[$j-1]}\"> ";
	   $fhtml .= "</td></tr>";
	   $fhtml .= "</tobdy></table>\r\n";
       
	   echo $fhtml; 
       
	   }
	   ?> <span id="uploadfield"></span>
		<script language="JavaScript"> startNum = <?php echo $j?>;</script>
	    </td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="90">&nbsp;�����ļ���</td>
                        <td><input name="filename" type="text" id="filename"  value="<?=$_REQUEST['file']?>"/> 
                          *����Ϻ�׺.php��д���Ŀ¼�� ��Ŀ¼�µġ�inc/flash/�� </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="800" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div align="center">
                          <input name="submit_flash" type="submit" id="submit_flash" value="��  ��" onclick="check_form()" />
                        </div></td>
                        <td>&nbsp;</td>
                        <td><input type="reset" name="Submit2" value="ȡ  ��" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                </form></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<?php } ?>
    </td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
function check_form() {
 if(document.all.filename.value=="") { 
 alert("û����д�ļ�����");
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

