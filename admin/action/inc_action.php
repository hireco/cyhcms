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
 
//--------------------------------------------------------------------------------------------------------------------
//测试所选栏目是否存在
if(empty($class_id)){
	ShowMsg("请指定文档的栏目！","-1");
	exit();
}


$body = stripslashes($body);
//--------------------------------------------------------------------------------------------------------------------
//自动摘要
if($abstract==""){
	$abstract = stripslashes(msubstr(strip_tags($body),0,100));
	$abstract = trim(preg_replace("/#p#|#e#/","",$abstract));
	$abstract = addslashes($abstract);
}
//-------------------------------------------------------------------------------------------------------------------
//把内容中远程的图片资源本地化
if($remote_down==1) {
  $upload_child_dir = $cfg_img_root; //文章图片下载目录
  $body = GetCurContent($body);
 }
//-------------------------------------------------------------------------------------------------------------------
//去除内容中的站外链接
if($remote_link_del==1){
	$body = str_replace($cfg_base_url,'#basehost#',$body);
	$body = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$body);
    $body = str_replace('#basehost#',$cfg_base_url,$body);
}

//-----------------------------------------------------------------------------------------------------------------
//自动分页
$sptype = (empty($sptype) ? '' : $sptype);
if($sptype=="auto"){
	$body = SpLongBody($body,$spsize*1024,"#p#分页标题#e#");
}

//------------------------------------------------------------------------------------------------------------------
//自动获取文章中的关键字
if($auto_keywords==1){
	require_once(dirname(__FILE__)."/../function/pub_splitword_www.php");
	$keywords = "";
	$sp = new SplitWord();
	$titleindexs = explode(" ",trim($sp->GetIndexText($sp->SplitRMM($title))));
	$allindexs = explode(" ",trim($sp->GetIndexText($sp->SplitRMM(Html2Text($body)),200)));
	if(is_array($allindexs) && is_array($titleindexs)){
		foreach($titleindexs as $k){	
			if(strlen($keywords)>=50) break;
			else $keywords .= $k." ";
		}
		foreach($allindexs as $k){
			if(strlen($keywords)>=50) break;
			else if(!in_array($k,$titleindexs)) $keywords .= $k." ";
	  }
	}
	$sp->Clear();
	unset($sp);
	$keywords = preg_replace("/#p#|#e#/","",$keywords);
	$keywords = addslashes($keywords); 
	
	$keywords=explode(" ",$keywords);
	for($i=0;$i<count($keywords); $i++) {
	$keywords[$i]=trim($keywords[$i]);
	if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9]+$/", $keywords[$i]))  
	$keyword[$i]=$keywords[$i];
	}
	$keywords=implode(" ",$keyword);
}
?>
