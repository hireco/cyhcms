<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php	 
     require_once("setting.php");
	 require_once(dirname(__FILE__)."/image_do.php");
     
     function image_upload($dir_relate,$upload_child_dir,$imgfile,$imgtitle,$imglink) {

     global $table_suffix,$cfg_photo_typenames,$cfg_upload_root, $cfg_mainsite;
	 
	 $picture=$_FILES[$imgfile];
     $picture_title=$_POST[$imgtitle];
     $picture_link=$_POST[$imglink];	
	 $water=$_POST['water'];//水印选项
   
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
    $img_url=$dir_relate.$img_dir."/".$file_name.$file_suffix; 
	
	if(!is_dir($dir_relate.$img_dir))  @mkdir($dir_relate.$img_dir);
    
    $result=@move_uploaded_file($picture['tmp_name'],$img_url);
    if(!$result) { 
	 echo "<script>alert(\"Sorry! 上传图片失败,请重来!\"); history.go(-1);</script>";   
	 exit; 
    }

  if($water=="1") {
  if(in_array($picture_type,$cfg_photo_typenames))  WaterImg($img_url,'up');
  }
 
  $picture=$cfg_mainsite.$img_dir."/".$file_name.$file_suffix;

  return $picture;
  }
?>
