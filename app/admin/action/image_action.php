<?php 
require_once(dirname(__FILE__)."/../../inc/often_function.php");
//-------------------------------------------------------------------------------------------------------------------
//��ȡ��������ͼ
$input_img_flag=0; //�Ƿ���д���ݿ�

if(empty($first_pic)) {
   if(!empty($pic_remote)) {
    if(!empty($picture_select))    $picture=get_content_url($picture_select,RROOT);
   }//��pic_remote����ѡ,��վ��ѡ������ͼƬ
   else if(!empty($pic_local)) {
    $picture=$_FILES['picture_input'];
	$upload_child_dir=$cfg_obsmimg_root;
	require(dirname(__FILE__)."/../../file_do/image_small.php");
   }//��pic_local����ѡ,�ӱ����ϴ�ͼƬ 
   else if(!empty($picture_select)) $picture=get_content_url($picture_select,RROOT);
   else if(!empty($_FILES['picture_input']['name'])) {
    $picture=$_FILES['picture_input'];
	$upload_child_dir=$cfg_obsmimg_root;
	require(dirname(__FILE__)."/../../file_do/image_small.php");
   }
 }//�ϴ����ߴӷ�������ѡȡ,���ȿ��Ƿ���дѡȡ��ַ
else {
    $picture = '';
	preg_match_all("/(src|SRC)=[\"|'| ]{0,}(.*\.(gif|jpg|jpeg|bmp|png))/isU",$body,$img_array);
	$img_array = array_unique($img_array[2]);
	if(count($img_array)>0){
		$picture_select = preg_replace("/[\"|'| ]{1,}/","",$img_array[0]);
		$picture=get_content_url($picture_select,RROOT);  	   
	}
	
 }//��������ѡȡ
 //---------------------------------------------------------------------------------------------------------------
  
  if(!$input_img_flag) {
  if($picture<>"") {
  $pic_link="";
  $pic_title="";
  $pic_url=$picture;
  $small_pic="0"; 
  $sample_pic="0";
  
  $pic_check=ereg_replace($cfg_mainsite,"",$pic_url);
  $pic_check=ereg_replace("_lit","",$pic_check);
  if(is_file(dirname(__FILE__)."/".RROOT."/".$pic_check)) $pic_url=$cfg_mainsite.$pic_check;
  
  $pic_small=get_small_pic($pic_url);
  $pic_small=ereg_replace($cfg_mainsite,"",$pic_small);
  if(is_file(dirname(__FILE__)."/".RROOT."/".$pic_small)) $small_pic="1"; 
  
  $result=mysql_query("delete from ".$table_suffix."picture  where object_class='$infor_class' and object_id='$object_id'");
  
  if($result) {
  $query="insert into ".$table_suffix."picture  (pic_url, object_class,object_id, pic_title,pic_link,sample_pic,small_pic) values
         ('$pic_url','$infor_class','$object_id','$pic_title', '$pic_link','$sample_pic','$small_pic')";
  $result=mysql_query($query);
  
      }//ɾ���ظ���ͼƬ,���е��ĵ�ֻ����һ��ͼƬ��Ӧ
  if($result) $input_img_flag=1;
	}
	  
  }//д�����ݿ�
  
  if( $input_img_flag==1) {
  $pic_id=@mysql_insert_id();
  $query="update ".$table_suffix.$infor_class." set pic_id=$pic_id  where  id=$object_id";
  if($result) $result=mysql_query($query);
  }
?>
