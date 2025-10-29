<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../../../config/base_cfg.php");
require_once(dirname(__FILE__)."/../../../file_do/image_do.php");
require_once(dirname(__FILE__)."/../../../{$cfg_admin_root}function/inc_function.php");
require_once(dirname(__FILE__)."/../../../{$cfg_admin_root}inc.php");
require_once(dirname(__FILE__)."/../../../{$cfg_admin_root}scripts/constant.php");
require_once(dirname(__FILE__)."/../../../config/auto_set.php");

$base_dir=RROOT."/";
$activepath =$cfg_upload_root;
$urlValue=$_POST['urlValue'];
$imgsrcValue=$_POST['imgsrcValue'];

$dopost=$_POST['dopost'];
$dd=$_POST['resize'];
$w=$_POST['iwidth'];
$h=$_POST['iheight'];
$water=$_POST['water'];
$imgfile=$_FILES['imgfile'];
if(empty($dopost)) $dopost="";
if(empty($imgwidthValue)) $imgwidthValue=400;
if(empty($imgheightValue)) $imgheightValue=300;
if(empty($urlValue)) $urlValue="";
if(empty($imgsrcValue)) $imgsrcValue="";
if(empty($dd)) $dd="";

if($dopost=="upload")
{
	if(empty($imgfile)) $imgfile="";
	if(!is_uploaded_file($imgfile['tmp_name'])){
		 ShowMsg("��û��ѡ���ϴ����ļ�!","-1");
	   exit();
	}
	if(ereg("^text",$imgfile['type'])){
		ShowMsg("�������ı����͸���!","-1");
		exit();
	}
	if(!eregi("\.(jpg|gif|png|bmp)$",$imgfile['name'])){
		ShowMsg("�����ϴ����ļ����ͱ���ֹ��","-1");
		exit();
	}
	$sparr = Array("image/pjpeg","image/jpeg","image/gif","image/png","image/x-png","image/wbmp");
   $imgfile_type = strtolower(trim($imgfile['type']));
   if(!in_array($imgfile_type,$sparr)){
		ShowMsg("�ϴ���ͼƬ��ʽ������ʹ��JPEG��GIF��PNG��WBMP��ʽ������һ�֣�","-1");
		exit();
	}

	$sname = '.jpg';
	//�ϴ����ͼƬ�Ĵ���
	if($imgfile_type =='image/pjpeg'||$imgfile_type=='image/jpeg'){
		$sname = '.jpg';
	}else if($imgfile_type=='image/gif'){
		$sname = '.gif';
	}else if($imgfile_type=='image/png'){
		$sname = '.png';
	}else if($imgfile_type=='image/wbmp'){
		$sname = '.bmp';
	}

	$nowtime = time();
	$mdir = strftime("%y%m%d",$nowtime);
	if(!is_dir($base_dir.$activepath."/$mdir")){
		 MkdirAll($base_dir.$activepath."/$mdir","0755");
	}
    $rndname = strftime("%d%H%M%S",$nowtime).mt_rand(1000,9999);
	$filename = $mdir."/".$rndname;
	$rndname  = $rndname.$sname; //����ע����

  //��Сͼ��ַ
    $bfilename = $base_dir.$activepath.$filename.$sname;
	$litfilename = $base_dir.$activepath.$filename."_lit".$sname;
    
    
  //��Сͼ�洢URL
  $fullfilename = $cfg_mainsite.$activepath.$filename.$sname;
  $full_litfilename = $cfg_mainsite.$activepath.$filename."_lit".$sname;

  if(file_exists($bfilename)){
  	ShowMsg("��Ŀ¼�Ѿ�����ͬ�����ļ��������ԣ�","-1");
		exit();
  }

  //�ϸ������յ��ļ���
  if(eregi("\.(php|asp|pl|shtml|jsp|cgi|aspx)",$bfilename)){
		ShowMsg("�����ϴ����ļ����ͱ���ֹ��ϵͳֻ�����ϴ�<br>".$cfg_mb_mediatype." ���͸�����","-1");
		exit();
	}
	if(eregi("\.(php|asp|pl|shtml|jsp|cgi|aspx)",$litfilename)){
		ShowMsg("�����ϴ����ļ����ͱ���ֹ��ϵͳֻ�����ϴ�<br>".$cfg_mb_mediatype." ���͸�����","-1");
		exit();
	}

    @move_uploaded_file($imgfile['tmp_name'],$bfilename);
   
	if($dd=="yes")
	{
			copy($bfilename,$litfilename);
			if(in_array($imgfile_type,$cfg_photo_typenames)) ImageResize($litfilename,$w,$h);
			@unlink($imgfile['tmp_name']);
	}   
	  else { 
	       $imgsrcValue = $fullfilename;
		   $urlValue = $fullfilename;
		
		  }    
	        
   if($water==1){
  	if(in_array($imgfile_type,$cfg_photo_typenames)) WaterImg($bfilename,'up');
    
	}//��ˮӡ
	
   $kkkimg = $urlValue;
}
if(empty($kkkimg)) $kkkimg="picview.gif";
?>
<HTML>
<HEAD>
<title>����ͼƬ</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style>
td{font-size:10pt;}
</style>
<script language=javascript>
var oEditor	= window.parent.InnerDialogLoaded() ;
var oDOM		= oEditor.FCK.EditorDocument ;
var FCK = oEditor.FCK;
function ImageOK()
{
	var inImg,ialign,iurl,imgwidth,imgheight,ialt,isrc,iborder;
	ialign = document.form1.ialign.value;
	iborder = document.form1.border.value;
	imgwidth = document.form1.imgwidth.value;
	imgheight = document.form1.imgheight.value;
	ialt = document.form1.alt.value;
	isrc = document.form1.imgsrc.value;
	iurl = document.form1.url.value;
	if(ialign!=0) ialign = " align='"+ialign+"'";
	inImg  = "<img src='"+ isrc +"' width='"+ imgwidth;
	inImg += "' height='"+ imgheight +"' border='"+ iborder +"' alt='"+ ialt +"'"+ialign+"/>";
	if(iurl!="") inImg = "<a href='"+ iurl +"' target='_blank'>"+ inImg +"</a>\r\n";
	if(document.all) oDOM.selection.createRange().pasteHTML(inImg);
	else FCK.InsertHtml(inImg);
  window.close();
}
function SelectMedia(fname)
{
   if(document.all){
     var posLeft = window.event.clientY-100;
     var posTop = window.event.clientX-400;
   }
   else{
     var posLeft = 100;
     var posTop = 100;
   }
   window.open("../../../file_do/select_images.php?f="+fname+"&imgstick=big", "popUpImgWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=400,left="+posLeft+", top="+posTop);
}
function SeePic(imgid,fobj)
{
   if(!fobj) return;
   if(fobj.value != "" && fobj.value != null)
   {
     var cimg = document.getElementById(imgid);
     if(cimg) cimg.src = fobj.value;
   }
}
function UpdateImageInfo()
{
	var imgsrc = document.form1.imgsrc.value;
	if(imgsrc!="")
	{
	  var imgObj = new Image();
	  imgObj.src = imgsrc;
	  document.form1.himgheight.value = imgObj.height;
	  document.form1.himgwidth.value = imgObj.width;
	  document.form1.imgheight.value = imgObj.height;
	  document.form1.imgwidth.value = imgObj.width;
  }
}
function UpImgSizeH()
{
   var ih = document.form1.himgheight.value;
   var iw = document.form1.himgwidth.value;
   var iih = document.form1.imgheight.value;
   var iiw = document.form1.imgwidth.value;
   if(ih!=iih && iih>0 && ih>0 && document.form1.autoresize.checked)
   {
      document.form1.imgwidth.value = Math.ceil(iiw * (iih/ih));
   }
}
function UpImgSizeW()
{
   var ih = document.form1.himgheight.value;
   var iw = document.form1.himgwidth.value;
   var iih = document.form1.imgheight.value;
   var iiw = document.form1.imgwidth.value;
   if(iw!=iiw && iiw>0 && iw>0 && document.form1.autoresize.checked)
   {
      document.form1.imgheight.value = Math.ceil(iih * (iiw/iw));
   }
}
</script>
<link href="base.css" rel="stylesheet" type="text/css">
<base target="_self">
</HEAD>
<body bgcolor="#EBF6CD" leftmargin="4" topmargin="2">
<form enctype="multipart/form-data" name="form1" id="form1" method="post">
<input type="hidden" name="dopost" value="upload">
<input type="hidden" name="himgheight" value="<?php echo $imgheightValue?>">
<input type="hidden" name="himgwidth" value="<?php echo $imgwidthValue?>">
  <table width="100%" border="0">
    <tr height="20">
      <td colspan="3">
      <fieldset>
        <legend>ͼƬ����</legend>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="65" height="25" align="right">��ַ��</td>
            <td colspan="2">
            	<input name="imgsrc" type="text" id="imgsrc" size="30" onChange="SeePic('picview',this);" value="<?php echo $imgsrcValue?>">
              <input onClick="SelectMedia('form1.imgsrc');" type="button" name="selimg" value=" ���... " class="binput" style="width:80">
            </td>
          </tr>
          <tr>
            <td height="25" align="right">��ȣ�</td>
            <td colspan="2" nowrap>
			 <input type="text"  id="imgwidth" name="imgwidth" size="8" value="<?php echo $imgwidthValue?>" onChange="UpImgSizeW()">
              &nbsp;&nbsp; �߶�:
              <input name="imgheight" type="text" id="imgheight" size="8" value="<?php echo $imgheightValue?>" onChange="UpImgSizeH()">
              <input type="button" name="Submit" value="ԭʼ" class="binput" style="width:40" onclick="UpdateImageInfo()">
              <input name="autoresize" type="checkbox" id="autoresize" value="1" checked>
              ����Ӧ</td>
          </tr>
          <tr>
            <td height="25" align="right">�߿�</td>
            <td colspan="2" nowrap><input name="border" type="text" id="border" size="4" value="0">
              &nbsp;�������:
              <input name="alt" type="text" id="alt" size="10"></td>
          </tr>
          <tr>
            <td height="25" align="right">���ӣ�</td>
            <td width="166" nowrap><input name="url" type="text" id="url" size="30"   value="<?php echo $urlValue?>"></td>
            <td width="155" align="center" nowrap>&nbsp;</td>
          </tr>
		  <tr>
            <td height="25" align="right">���룺</td>
            <td nowrap><select name="ialign" id="ialign">
                <option value="0" selected>Ĭ��</option>
                <option value="right">�Ҷ���</option>
                <option value="center">�м�</option>
                <option value="left">�����</option>
                <option value="top">����</option>
                <option value="bottom">�ײ�</option>
              </select></td>
            <td align="right" nowrap>
            	<input onClick="ImageOK();" type="button" name="Submit2" value=" ȷ�� " class="binput">&nbsp;
            </td>
          </tr>
        </table>
        </fieldset>
        </td>
    </tr>
    <tr height="25">
      <td colspan="3" nowrap> <fieldset>
        <legend>�ϴ���ͼƬ</legend>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr height="30">
            <td align="right" nowrap>����ͼƬ��</td>
            <td colspan="2" nowrap><input name="imgfile" type="file" id="imgfile" onChange="SeePic('picview',this);" style="height:22" class="binput">
              &nbsp; <input type="submit" name="picSubmit" id="picSubmit" value=" �� ��  " style="height:22" class="binput"></td>
          </tr>
          <tr height="30">
            <td rowspan="2" align="right" nowrap>��ѡ���</td>
            <td colspan="2" nowrap>
			������ͼ
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
���Կ�
<input type='text' style='width:30' name='iwidth' value='<?php echo $cfg_img_width?>'>
���Ը�
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
							</script></td>
          </tr>
          <tr height="30">
            <td colspan="2" nowrap>ԭͼ��ˮӡ
              <select name="water" id="water">
                <option value="0" selected>����</option>
                <option value="1">��</option>
              </select>
(*ע��:ԭͼ��С���䱣��!)</td>
          </tr>
        </table>
        </fieldset></td>
    </tr>
    <tr height="50">
      <td height="140" align="right" nowrap>Ԥ����:</td>
      <td height="140" colspan="2" nowrap>
	  <table width="150" height="120" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td align="center"><img name="picview" id="picview" src="<?php echo $kkkimg?>" width="160" height="120" alt="Ԥ��ͼƬ"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</body>
</HTML>
