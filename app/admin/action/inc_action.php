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
 
//--------------------------------------------------------------------------------------------------------------------
//������ѡ��Ŀ�Ƿ����
if(empty($class_id)){
	ShowMsg("��ָ���ĵ�����Ŀ��","-1");
	exit();
}


$body = stripslashes($body);
//--------------------------------------------------------------------------------------------------------------------
//�Զ�ժҪ
if($abstract==""){
	$abstract = stripslashes(msubstr(strip_tags($body),0,100));
	$abstract = trim(preg_replace("/#p#|#e#/","",$abstract));
	$abstract = addslashes($abstract);
}
//-------------------------------------------------------------------------------------------------------------------
//��������Զ�̵�ͼƬ��Դ���ػ�
if($remote_down==1) {
  $upload_child_dir = $cfg_img_root; //����ͼƬ����Ŀ¼
  $body = GetCurContent($body);
 }
//-------------------------------------------------------------------------------------------------------------------
//ȥ�������е�վ������
if($remote_link_del==1){
	$body = str_replace($cfg_base_url,'#basehost#',$body);
	$body = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$body);
    $body = str_replace('#basehost#',$cfg_base_url,$body);
}

//-----------------------------------------------------------------------------------------------------------------
//�Զ���ҳ
$sptype = (empty($sptype) ? '' : $sptype);
if($sptype=="auto"){
	$body = SpLongBody($body,$spsize*1024,"#p#��ҳ����#e#");
}

//------------------------------------------------------------------------------------------------------------------
//�Զ���ȡ�����еĹؼ���
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
