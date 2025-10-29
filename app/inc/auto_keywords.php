<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php  
 if($keywords=="") {
	require_once(dirname(__FILE__)."/../".$cfg_admin_root."function/pub_splitword_www.php");
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
  }
	$keywords=explode(" ",$keywords);
	for($i=0;$i<count($keywords); $i++) {
	$keywords[$i]=trim($keywords[$i]);
	if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9]+$/", $keywords[$i]))  
	$keyword[$i]=$keywords[$i];
	}
	$keywords=implode(" ",$keyword);

?>