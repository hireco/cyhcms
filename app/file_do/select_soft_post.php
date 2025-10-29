<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}function/inc_function.php");
require_once(dirname(__FILE__)."/image_do.php");
require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");
$base_dir=RROOT."/";
$activepath=$_POST['activepath']; 
$job=$_POST['job'];
$f=$_POST['f'];
$file_class=$_REQUEST['file_class'];

if(empty($job)) $job = "";
if($job=="newdir")
{
	$dirname = trim(ereg_replace("[ \r\n\t\.\*\%\\/\?><\|\":]{1,}","",$dirname));
	if($dirname==""){
		ShowMsg("目录名非法！","-1");
		exit();
	}
	MkdirAll($base_dir.$activepath."/".$dirname,"0755");
	ShowMsg("成功创建一个目录！","select_soft.php?f=$f&activepath=".urlencode($activepath."/".$dirname));
	exit();
}
if($job=="upload")
{
	$uploadfile=$_FILES['uploadfile'];
	$filename=$_POST['filename'];
	if(empty($uploadfile)) $uploadfile = "";
	if(!is_uploaded_file($uploadfile['tmp_name'])){
		 ShowMsg("你没有选择上传的文件或者文件过大!","-1");
	   exit();
	}
	if(ereg("^text",$uploadfile['type'])){
		ShowMsg("不允许文本类型附件!","-1");
		exit();
	}
	if(!eregi("\.".$cfg_mb_filetype,$uploadfile['name']))
	 {
		ShowMsg("你所上传的文件类型不能被识别，请更改系统对扩展名限定的配置！","-1");
		exit();
	 }
	
	$nowtme = time();
	if($filename!="") $filename = trim(ereg_replace("[ \r\n\t\*\%\\/\?><\|\":]{1,}","",$filename));
	if($filename==""){
		$y = substr(strftime("%Y",$nowtme),2,2);
		$filename = $y.strftime("%m%d%H%M%S",$nowtme);
		$fs = explode(".",$uploadfile['name']);
		$filename = $filename.".".$fs[count($fs)-1];
	}
  
  $mdir = strftime("%y%m%d",$nowtme);
	if(!is_dir($base_dir.$activepath."/$mdir")){
		 MkdirAll($base_dir.$activepath."/$mdir","0755");
	}
  
  $fullfilename = $base_dir.$activepath."/".$mdir."/".$filename;
  if(file_exists($fullfilename)){
  	ShowMsg("本目录已经存在同名的文件，请更改！","-1");
		exit();
  }
  $result=@move_uploaded_file($uploadfile['tmp_name'],$fullfilename);
   
   if($result){    
	ShowMsg("成功上传文件！","select_soft.php?comeback=".urlencode($filename)."&f=$f&activepath=".urlencode($activepath)."&d=".time());
	exit();
	}
	else {
	 ShowMsg("上传文件失败！");
	 exit();
	}
}
?>