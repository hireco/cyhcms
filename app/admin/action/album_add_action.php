<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../../config/base_cfg.php");
require_once(dirname(__FILE__)."/../inc.php");
require_once(dirname(__FILE__)."/../function/inc_function.php");
require_once(dirname(__FILE__)."/../../config/auto_set.php");
require_once(dirname(__FILE__)."/../function/getip.php");
require_once(dirname(__FILE__)."/../../file_do/pic_upload.php");

 $cfg_basehost=ereg_replace("/$","",$cfg_base_url);
if(isset($_POST['submit'])) {
//-------------------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__)."/inc_action.php");

//д���ݿ�
 
$article_title=msubstr(trim($title),0,100);
$content=addslashes($body);
$short_title=msubstr(trim($short_title),0,50);
$vice_title=msubstr(trim($vice_title),0,100);
$jump_url=msubstr(trim($jump_url),0,100);
$visit_times=trim($visit_times);
$post_time=$post_time==""?date("y-m-d H:i:s"):$post_time;
$top=trim($top); 
$keywords=strip_tags(msubstr(trim($keywords),0,60));
$abstract=strip_tags(msubstr(trim($abstract),0,250));
$similar_id=strip_tags(msubstr(trim($similar_id),0,250));

if($top) $top_time=$post_time; else $top_time="00-00-00 00:00:00";
$poster=$_SESSION['admin_valid'];
$last_ip=$ip;
$last_editor=$poster;
$last_time=$post_time;
$article_from=$source_input;
$pen_name=$writer_input;

$query="insert into ".$table_suffix."album
 (top_time,last_ip,last_editor,last_time,article_from,article_title,
  title_bold,title_color,pen_name,content,short_title,
  show_attribute,vice_title,hide_type,jump_url,new_or_not,read_times,
  checked,comment_or_not,poster,post_time,new_or_not_time,recommend_time,show_attribute_time,locked,top,recommend,keywords,abstract,
  similar_id,refer_url,class_id,show_style,rows_num,big_width,small_width,template)
 values
 ('$top_time','$last_ip','$last_editor','$last_time','$article_from','$article_title',
 '$title_bold','$title_color','$pen_name','$content','$short_title',
 '$show_attribute','$vice_title','$hide_type','$jump_url','$new_or_not','$visit_times',
 '$checked','$comment_or_not','$poster','$post_time','$post_time','$post_time','$post_time','$locked','$top','$recommend','$keywords','$abstract',
 '$similar_id','$refer_url','$class_id','$show_style','{$hang}x{$lie}','$big_width','$small_width','$template')";

$result=mysql_query($query);

//��������

$object_id=@mysql_insert_id();
$infor_class="album";
$query="insert into ".$table_suffix."infor_index 
(infor_id,class_id,infor_class,article_title,post_time,new_or_not_time,recommend_time,show_attribute_time,poster,hide_type,top,top_time,new_or_not,
 keywords,read_times,comment_or_not,checked,recommend,title_bold,title_color,show_attribute,locked)
 values
($object_id,$class_id,'$infor_class','$article_title','$post_time','$post_time','$post_time','$post_time','$poster','$hide_type','$top','$top_time','$new_or_not',
 '$keywords','$visit_times','$comment_or_not','$checked','$recommend','$title_bold','$title_color','$show_attribute','$locked')";

mysql_query($query); 

require_once(dirname(__FILE__)."/image_action.php"); //д��ͼƬ

//д��ͼ����ͼƬ��Ϣ
if($result) {
   
   $upload_child_dir=$cfg_album_root;
   $dir_relate="../../";
   
   for($i=1;$i<=$num_of_img; $i++) {
   
	$imgfile="imgfile".$i; $imgurl="imgurl".$i; $imgtitle="imgtitle".$i; $imglink="imglink".$i; $imgmsg="imgmsg".$i;
	if(is_uploaded_file($_FILES[$imgfile]['tmp_name'])) 
	 $$imgurl=image_upload($dir_relate,$upload_child_dir,$imgfile,$imgtitle,$imglink);
	 //�ϴ��µ�ͼƬ
	
	elseif($$imgurl<>"") 	$$imgurl=get_content_url($$imgurl,RROOT);
     //ֱ���ṩ��ַ��������Զ����վ��ͼƬ�ĵ�ַ 
	 
	 if($$imgurl<>"") {
	  $pic_url=$$imgurl; 
	  $pic_title=$$imgtitle;
	  $pic_link =$$imglink;
	  $pic_msg  =$$imgmsg;
	  $object_class="album_list";
	  
	  $query="insert into ".$table_suffix."picture  (pic_url, object_class,object_id, pic_title,pic_link,sample_pic,small_pic) values
                                                    ('$pic_url','$object_class','$object_id','$pic_title', '$pic_link','0','0')";
      
	  $result=mysql_query($query);  
	  if($result) 	   $pic_id=@mysql_insert_id();
      else continue;
	  
	  if( $input_img_flag==0) {
		  $query="insert into ".$table_suffix."picture  (pic_url, object_class,object_id, pic_title,pic_link,sample_pic,small_pic) values
                                                    ('$pic_url','album','$object_id','$pic_title', '$pic_link','0','0')";
		  $pic_id_album=@mysql_insert_id();
		  $query="update ".$table_suffix.$infor_class." set pic_id=$pic_id_album  where  id=$object_id";
		  $result=mysql_query($query);
		  if($result) $input_img_flag=1;
	   }
  
	  if($pic_msg<>"") {
	  $query="insert into ".$table_suffix."picture_msg (pic_id,pic_msg,object_class,object_id) values ('$pic_id','$pic_msg','$object_class','$object_id')";
	  if($result) $result=mysql_query($query);
	  
	  }
	 
	 }
   
   }

}

 
  if($result) ShowMsg("ͼƬ������ɹ�,���Զ������������Ŀ��","../content_list.php?class_id={$class_id}&infor_class=album&class_name={$class_name}");
  else  ShowMsg("����ʧ��,��������","-1");

 }
else {
  ShowMsg("����ʧ�ܻ���Ч�ķ��ʣ�","-1");
  exit(); 
  }
?>
