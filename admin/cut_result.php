<?php 
session_start(); 
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../inc/often_function.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
?>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<html>
<head>
<title>图片缩略图处理结果</title>
<STYLE type=text/css>
div,table{font-size: 12px; color: #AA5FB8; line-height: 20px;}
.filt {
	FILTER: alpha(opacity=50); BACKGROUND-COLOR: #fff; -moz-opacity: 0.5; opacity: 0.5
}
.filt1 {	FILTER: alpha(opacity=50); BACKGROUND-COLOR: #fff; -moz-opacity: 0.5; opacity: 0.5
}
.cut_update{ background:url(image/cut_update_bn.jpg) no-repeat; border: none; width: 151px; height:34px; cursor: hand; margin: 0 0 0 100px;}
.coltable{ float:left;text-align: center; color: #7D7D7D;margin: 5px 0 0 60px !important; margin-left: 30px; line-height: 15px;}
.cut_img img{ 
	padding: 1px;
	float: left;
	border: 5px solid #E7D3FF;
	margin-right: 40px;
 }
#logo{width: 758px;} 
#cut_div_top{ width: 100%; background: url(image/login_body_bg.gif); }
.cut_top_img{ width: 100%;  background: url(image/login_body_bg.gif); } 
.filt11 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.filt111 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE6 {
	FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.cut_intro{margin: 15px 0 0 35px;}
.STYLE7 {	FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt112 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE71 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt1121 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE711 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt11211 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE7111 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt112111 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.td_window {BORDER-RIGHT: violet 1px solid; BORDER-BOTTOM: violet 1px solid; BORDER-LEFT: violet 1px solid; BORDER-TOP: violet 1px solid;
}
</STYLE>
</head>
<BODY style="TEXT-ALIGN: left；padding: 0; margin:0;" >
<?php 

$small_photo=get_small_pic($_POST['pic_url']);
$small_photo=ereg_replace($cfg_mainsite,"",$small_photo);
$imgname=ereg_replace($cfg_mainsite,"",$_POST['pic_url']);

$imgname=RROOT."/".$imgname;
$small_photo=RROOT."/".$small_photo;

list($width, $height) = @getimagesize($imgname);
$percent = ($_POST['width']*1.0)/$width;
$newheight = $height * $percent;
$newwidth = $_POST['width'];
$angle=(4-$_POST['turn'])*90; 

$temp_photo=basename($imgname); 
$iwidth = $_POST['iwidth'];
$iheight = $_POST['iheight'];

$type=explode(".",$temp_photo);
if(($type[1]=="jpeg")||($type[1]=="jpg")) $source = @imagerotate(imagecreatefromjpeg($imgname),$angle,0);
elseif($type[1]=="png") $source = @imagerotate(imagecreatefrompng($imgname),$angle,0);
else $source = @imagerotate(@imagecreatefromgif($imgname),$angle,0);

$im_temp = @imagecreatetruecolor($_POST['scwidth'], 690);
$white=imagecolorallocate($im_temp, 255, 255,255);
imagefill($im_temp, 0, 0,$white);

$im = @imagecreatetruecolor($iwidth, $iheight);

@imagecopyresized ($im_temp, $source, $_POST['left'], $_POST['top'], 0, 0, $newwidth, $newheight, $width, $height);

@imagecopy ($im, $im_temp, 0,0,200+(600-$iwidth)/2,90+(500-$iheight)/2, $iwidth, $iheight); 

if(($type[1]=="jpeg")||($type[1]=="jpg")) @imagejpeg($im,$temp_photo);
elseif($type[1]=="png") @imagepng($im,$temp_photo);
else @imagegif($im,$temp_photo); 

$result=copy($temp_photo,$small_photo);
if(!$result)  { ShowMsg("系统出错，请稍后重试！"); exit; } 
$result=unlink($temp_photo);
if(!$result)  { ShowMsg("系统出错，请稍后重试！"); exit; } 

session_register("small_photo");
$_SESSION['small_photo']=$small_photo;

$result=mysql_query("update ".$table_suffix."picture set small_pic='1' where pic_url='{$_POST['pic_url']}'");
if(!$result)  { ShowMsg("系统出错，请稍后重试！"); exit; } 
?>
<table width="100%" height="90"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" height="500" align="center" valign="top" bgcolor="#E7CDCD">&nbsp;</td>
        <td width="600" align="center" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="center"><?php echo "<img src=\"$small_photo\">"; ?></div></td>
          </tr>
          <tr>
            <td><div align="center"><a style="cursor:pointer" href="cut_pic.php?pic_url=<?=$_POST['pic_url']?>&iwidth=<?=$_POST['iwidth']?>&iheight=<?=$_POST['iheight']?>&action=cancel"><img src="image/reg_bn11.jpg" width="122" height="22" border="0"></a></div></td>
          </tr>
          <tr>
            <td><div align="center"> 您的形象照已经完成，谢谢！ </div></td>
          </tr>
          <tr>
            <td><div align="center"><a style="cursor:pointer" href="javascript:opener.location.reload(); window.close();"><img src="image/update_bn.jpg"  width="149" height="50" border="0"></a></div></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 
imagedestroy($im); 
unset($_POST['width'],$_POST['left'],$_POST['top'],$_POST['photo'],$_POST['scwidth']);
?> 
</BODY>
</html>

