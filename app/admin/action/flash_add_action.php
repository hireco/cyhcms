<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../../config/base_cfg.php");
require_once(dirname(__FILE__)."/../inc.php");
require_once(dirname(__FILE__)."/../function/inc_function.php");
require_once(dirname(__FILE__)."/../../config/auto_set.php");
require_once(dirname(__FILE__)."/../function/getip.php");
require_once(dirname(__FILE__)."/../../file_do/pic_upload.php");

if(isset($_POST['submit_flash'])) {
//-------------------------------------------------------------------------------------------------------------
//��ȡ���е��ύPOST����
if ( isset( $_POST ) )
   $postArray = &$_POST ;
foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$$sForm = stripslashes( trim($value) )  ;
	else
		$$sForm = trim($value)  ;
       // echo "'\$".$sForm."',"; 

} 

//д��ͼ����ͼƬ��Ϣ
   
   $upload_child_dir=$cfg_img_root;
   $dir_relate="../../";
   
   $string="";
   $string1="";
   
   $title_width=0;
   $title_height=0;
   
   $saved_pic="pics=";
   $saved_link="&links="; 
   $saved_title="&texts=";
   
   $pic_i=1;
   
   for($i=1;$i<=$num_of_img; $i++) {
   
	$imgfile="imgfile".$i; $imgurl="imgurl".$i; $imgtitle="imgtitle".$i; $imglink="imglink".$i; 
	if(is_uploaded_file($_FILES[$imgfile]['tmp_name'])) 
	 $$imgurl=image_upload($dir_relate,$upload_child_dir,$imgfile,$imgtitle,$imglink);
	 //�ϴ��µ�ͼƬ
	
	elseif($$imgurl<>"") 	$$imgurl=get_content_url($$imgurl,RROOT);
     //ֱ���ṩ��ַ��������Զ����վ��ͼƬ�ĵ�ַ 
	 
	 if($$imgurl<>"") {
	  $pic_url=$$imgurl;
	  $pic_title=$$imgtitle==""?$pic_i:$$imgtitle;
	  $pic_link =$$imglink==""?"./":$$imglink;
	 
	  
	  if($flash_style=="twpd") { 
	  $string_i="\nlinkarr[$pic_i] = \"$pic_link\";\n"."picarr[$pic_i] = \"$pic_url\";\n"."textarr[$pic_i] = \"$pic_title\";\naddInfo(textarr[$pic_i],picarr[$pic_i],linkarr[$pic_i]);\n";
	  $string.=" ".$string_i; 
	  $title_width+=21;
	  }
	  
	  elseif($flash_style=="kuan") {
	  $pic_j=$pic_i-1;
	  if($pic_i==1) $string_i="<DIV style=\"DISPLAY: block\"><A href=\"$pic_link\" target=_blank><IMG  alt=\"$pic_title\"  src=\"$pic_url\"></A></DIV>\n";
	  else $string_i="<DIV style=\"DISPLAY: none\"><A href=\"$pic_link\" target=_blank><IMG  alt=\"$pic_title\"  src=\"$pic_url\"></A></DIV>\n";
	  $string.=" ".$string_i; 
	  if($pic_i==1) $string_j="<SPAN class=bbg1 id=t".$pic_j." onmouseover=Mea(".$pic_j.");clearAuto(); onmouseout=setAuto()>".$pic_i."</SPAN>\n";
	  else $string_j="<SPAN class=bbg0 id=t".$pic_j." onmouseover=Mea(".$pic_j.");clearAuto(); onmouseout=setAuto()>".$pic_i."</SPAN>\n";
	  $string1.=" ".$string_j; 
	  }
	  
	  if($pic_i==1) {
	  $saved_pic=$saved_pic.$pic_url;
      $saved_link=$saved_link.$pic_link;
      $saved_title=$saved_title.$pic_title;
	   } 
	  else {
	  $saved_pic=$saved_pic."|".$pic_url;
      $saved_link=$saved_link."|".$pic_link;
      $saved_title=$saved_title."|".$pic_title;
	   } 
	  $pic_i+=1;
	 }
   
   }
    $pic_i-=1;
    
 if($pic_i) {
	if($flash_style=="twpd") { 
	  $fileread="../../inc/flash_for_twpd.php";
      $fp=fopen($fileread,"r");
      $string_read=fread($fp,filesize($fileread));
      fclose($fp);
	  $string=ereg_replace("{string}",$string,$string_read);
	  $width=$width+$title_width;
	 }
	
	elseif($flash_style=="kuan") {
	  $fileread="../../inc/flash_for_kuan.php";
      $fp=fopen($fileread,"r");
      $string_read=fread($fp,filesize($fileread));
      fclose($fp);
	  $string=ereg_replace("{string}",$string,$string_read);
	  $string=ereg_replace("{string1}",$string1,$string);
	 }
	
	else  { 
	 $string= $saved_pic.$saved_link.$saved_title;
	 $fileread="../../inc/flash_for_index.php";
     $fp=fopen($fileread,"r");
     $string_read=fread($fp,filesize($fileread));
     fclose($fp);
	 $string=ereg_replace("{string}",$string,$string_read);
	 $height=$height+$title_height;
	 }
	
	$string=ereg_replace("{width}","$width",$string);
	$string=ereg_replace("{height}","$height",$string);
	$string=ereg_replace("{num_of_pic}","$pic_i",$string);
	
	$string= "<?php \n\$num_of_pic=$pic_i;\n\$flash_style=\"$flash_style\";\n\$width=$width-$title_width;\n\$height=$height-$title_height;\n\$string=\"".$saved_pic.$saved_link.$saved_title."\";\n?>\n".$string;
	
	$flashfile="../../inc/flash/$filename";
    $fp=fopen($flashfile,"w");
    $result=fwrite($fp,$string);
    fclose($fp);
	if($result)  ShowMsg("��ϲ,�ɹ����ɶ���!","../flash_edit.php");
  }
  else  ShowMsg("����ʧ��,û������ͼƬ�ļ���","-1");
}
   
else {
  ShowMsg("����ʧ�ܻ���Ч�ķ��ʣ�","-1");
  exit(); 
  } 
 
?>
