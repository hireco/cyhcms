<?php 
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

$body = stripslashes($body);

//-------------------------------------------------------------------------------------------------------------------
//��������Զ�̵�ͼƬ��Դ���ػ�
  $upload_child_dir = $cfg_img_root; //����ͼƬ����Ŀ¼
  $body = GetCurContent($body);
  
//-------------------------------------------------------------------------------------------------------------------
//ȥ�������е�վ������
if($remote_link_del==1){
	$body = str_replace($cfg_base_url,'#basehost#',$body);
	$body = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$body);
    $body = str_replace('#basehost#',$cfg_base_url,$body);
}

?>
