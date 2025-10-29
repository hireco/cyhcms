<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}function/inc_function.php");
require_once(dirname(__FILE__)."/image_do.php");

$base_dir=RROOT."/";
$activepath=$_POST['activepath'];
$job=$_POST['job'];
$imgstick=$_POST['imgstick'];
$f=$_POST['f'];
$v=$_POST['v'];

if(empty($job)) $job = "";
if($job=="newdir")
{
	$dirname=$_POST['dirname'];
	$dirname = trim(ereg_replace("[ \r\n\t\.\*\%\\/\?><\|\":]{1,}","",$dirname));
	if($dirname==""){
		ShowMsg("Ŀ¼���Ƿ���","-1");
		exit();
	}
	MkdirAll($base_dir.$activepath."/".$dirname,"0755");
	ShowMsg("�ɹ�����һ��Ŀ¼��","select_images.php?imgstick=$imgstick&v=$v&f=$f&activepath=".urlencode($activepath."/".$dirname));
	exit();
}
if($job=="upload")
{
	$imgfile=$_FILES['imgfile'];
	$resize=$_POST['resize'];
	$iwidth=$_POST['iwidth'];
	$iheight=$_POST['iheight']; 
	$water=$_POST['water'];
	
	if(empty($imgfile)) $imgfile="";
	if(!is_uploaded_file($imgfile['tmp_name'])){
		 ShowMsg("��û��ѡ���ϴ����ļ�!","-1");
	   exit();
	}
	if(ereg("^text",$imgfile['type'])){
		ShowMsg("�������ı����͸���!","-1");
		exit();
	}
	$nowtme = time();
	$sparr = Array("image/pjpeg","image/jpeg","image/gif","image/png","image/x-png","image/wbmp");
    $imgfile_type = strtolower(trim($imgfile['type']));
  if(!in_array($imgfile_type,$sparr)){
		ShowMsg("�ϴ���ͼƬ��ʽ������ʹ��JPEG��GIF��PNG��WBMP��ʽ������һ�֣�","-1");
		exit();
	}
	
	$mdir = strftime("%y%m%d",$nowtme);
	if(!is_dir($base_dir.$activepath."/$mdir")){
		 MkdirAll($base_dir.$activepath."/$mdir","0755");
	}
	
	$sname = '.jpg';
	//ͼƬ���޶���չ��
	if($imgfile_type=='image/pjpeg'||$imgfile_type=='image/jpeg'){
		$sname = '.jpg';
	}else if($imgfile_type=='image/gif'){
		$sname = '.gif';
	}else if($imgfile_type=='image/png'){
		$sname = '.png';
	}else if($imgfile_type=='image/wbmp'){
		$sname = '.bmp';
	}
	
	$filename_name = strftime("%H%M%S",$nowtme).mt_rand(100,999);
	$filename = $mdir."/".$filename_name;
	
	$filename = $filename.$sname;
	$filename_name = $filename_name.$sname;
    $fullfilename = $base_dir.$activepath."/".$filename;
  
  if(file_exists($fullfilename)){
  	ShowMsg("��Ŀ¼�Ѿ�����ͬ�����ļ�������ģ�","-1");
		exit();
  }
  
  if(!eregi("\.(jpg|gif|png|bmp)$",$fullfilename)){
		ShowMsg("�����ϴ����ļ����ͱ���ֹ��ϵͳֻ�����ϴ�jpg��gif��png��bmp����ͼƬ��","-1");
		exit();
	}
  
  @move_uploaded_file($imgfile['tmp_name'],$fullfilename);
  
  if(empty($resize)) $resize = 0;
  
  if($resize==1){
  	if(in_array($imgfile_type,$cfg_photo_typenames)) ImageResize($fullfilename,$iwidth,$iheight);
  }
  
  if($water==1){
  	if(in_array($imgfile_type,$cfg_photo_typenames)) WaterImg($fullfilename,'up');
  }//��ˮӡ
  
    @unlink($imgfile['tmp_name']);
	ShowMsg("�ɹ��ϴ�һ��ͼƬ��","select_images.php?imgstick=$imgstick&comeback=".urlencode($filename_name)."&v=$v&f=$f&activepath=".urlencode($activepath)."/$mdir&d=".time());
	exit();
	
}
?>