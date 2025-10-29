<?php 
//获取所有的提交POST变量
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
//把内容中远程的图片资源本地化
  $upload_child_dir = $cfg_img_root; //文章图片下载目录
  $body = GetCurContent($body);
  
//-------------------------------------------------------------------------------------------------------------------
//去除内容中的站外链接
if($remote_link_del==1){
	$body = str_replace($cfg_base_url,'#basehost#',$body);
	$body = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$body);
    $body = str_replace('#basehost#',$cfg_base_url,$body);
}

?>
