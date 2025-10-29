<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
     require_once("setting.php");
     require_once(dirname(__FILE__)."/../config/base_cfg.php");
     require_once(dirname(__FILE__)."/../config/auto_set.php");
     require_once(dirname(__FILE__)."/../{$cfg_admin_root}inc.php");
     require_once(dirname(__FILE__)."/../{$cfg_admin_root}function/inc_function.php");
     require_once(dirname(__FILE__)."/image_do.php");
	 
     $picture=$_FILES['picture_input'];
     $picture_title=$_POST['picture_title_input'];
     $picture_link=$_POST['picture_link_input'];
     $resize=$_POST['resize']; 
	 $water=$_POST['water'];
	 $iwidth=$_POST['iwidth']==""?$cfg_colsimg_width:$_POST['iwidth'];
	 $iheight=$_POST['iheight']==""?$cfg_colsimg_height:$_POST['iheight'];

   if(empty($picture)) $picture="";
	 if(!is_uploaded_file($picture['tmp_name'])){
	   echo "<script>alert(\"您没有选择上传文件!\"); history.go(-1);</script>";
	   exit();
	 }
	if(ereg("^text",$picture['type'])){
	   echo "<script>alert(\"不允许文本类型附件!\"); history.go(-1);</script>";
	   exit();
	 }
	
	$sparr = Array("image/pjpeg","image/jpeg","image/gif","image/png","image/x-png","image/wbmp");
    $picture_type = strtolower(trim($picture['type']));
    
    if(!in_array($picture_type,$sparr)){
		echo "<script>alert(\"上传的图片格式错误，请使用JPEG、GIF、PNG、WBMP格式的其中一种！\"); history.go(-1);</script>";
		exit();
	}
	
	$file_suffix = '.jpg';
	//图片的限定扩展名
	if($picture_type=='image/pjpeg'||$picture_type=='image/jpeg'){
		$file_suffix = '.jpg';
	}else if($picture_type=='image/gif'){
		$file_suffix = '.gif';
	}else if($picture_type=='image/png'){
		$file_suffix = '.png';
	}else if($picture_type=='image/wbmp'){
		$file_suffix = '.bmp';
	}
	
	$img_root=$cfg_upload_root.$upload_child_dir;
    $img_dir= $img_root.strftime("%y%m%d",time());
    $file_name = strftime("%H%M%S",time()).mt_rand(100,999);
    $img_url="../".$img_dir."/".$file_name.$file_suffix; 
    $img_url_small="../".$img_dir."/".$file_name."_lit".$file_suffix; 
	
	if(!is_dir("../".$img_dir))  @mkdir("../".$img_dir);
    
	 
  if(file_exists($img_url)){
  	echo "<script>alert(\"本目录已经存在同名的文件，请更改！\"); history.go(-1);</script>";
		exit();
  }
  
  if(!eregi("\.(jpg|gif|png|bmp)$",$img_url)){
		echo "<script>alert(\"你所上传的文件类型被禁止，系统只允许上传jpg、gif、png、bmp类型图片！\"); history.go(-1);</script>";
		exit();
	}
  
  $result=@move_uploaded_file($picture['tmp_name'],$img_url);
  if(!$result) { 
	echo "<script>alert(\"Sorry! 上传图片失败,请重来!\"); history.go(-1);</script>";   
	exit; 
   }
  if(empty($resize)) $resize = 0;
  
  if($resize==1){
  	copy($img_url,$img_url_small);
	if(in_array($picture_type,$cfg_photo_typenames))
	ImageResize($img_url_small,$iwidth,$iheight);
  }//生成缩略图
  
  if($water==1){
  	if(in_array($picture_type,$cfg_photo_typenames)) WaterImg($img_url,'up');
  }//给原图加水印
	
  $picture=$cfg_mainsite.$img_dir."/".$file_name.$file_suffix;
  $picture_small=$cfg_mainsite.$img_dir."/".$file_name."_lit".$file_suffix;
 
  if($resize==1)
  $picture=$picture_small;

 ?>
