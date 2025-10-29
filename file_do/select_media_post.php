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

if(empty($job)) $job = "";
if($job=="newdir")
{   $dirname=$_POST['dirname'];
	$dirname = trim(ereg_replace("[ \r\n\t\.\*\%\\/\?><\|\":]{1,}","",$dirname));
	if($dirname==""){
		ShowMsg("Ŀ¼���Ƿ���","-1");
		exit();
	}
	MkdirAll($base_dir.$activepath."/".$dirname,"0755");
	ShowMsg("�ɹ�����һ��Ŀ¼��","select_media.php?f=$f&activepath=".urlencode($activepath."/".$dirname));
	exit();
}
if($job=="upload")
{   $uploadfile=$_FILES['uploadfile'];
	$filename=$_POST['filename'];
	if(empty($uploadfile)) $uploadfile = "";
	if(!is_uploaded_file($uploadfile['tmp_name'])){
		 ShowMsg("��û��ѡ���ϴ����ļ����ļ�����!","-1");
	   exit();
	}
	if(ereg("^text",$uploadfile['type'])){
		ShowMsg("�������ı����͸���!","-1");
		exit();
	}
	if(!eregi("\.".$cfg_mb_mediatype,$uploadfile['name']))
	{
		ShowMsg("�����ϴ���ý�����Ͳ��ܱ�ʶ�������ϵͳ����չ���޶������ã�","-1");
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
  $fullfilename = $base_dir.$activepath."/".$filename;
  if(file_exists($fullfilename)){
  	ShowMsg("��Ŀ¼�Ѿ�����ͬ�����ļ�������ģ�","-1");
		exit();
  }
   
    $result=@move_uploaded_file($uploadfile['tmp_name'],$fullfilename);
	
	if($result) {
	ShowMsg("�ɹ��ϴ��ļ���","select_media.php?comeback=".urlencode($filename)."&f=$f&activepath=".urlencode($activepath)."&d=".time());
	exit();
	}
	else {
	ShowMsg("�ϴ��ļ�ʧ�ܣ�");
	exit();
	}
}
?>