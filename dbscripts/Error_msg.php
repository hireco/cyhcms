<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
//��Ϣ��ʾ����
function Error_msg($msg,$gourl,$onlymsg=0,$limittime=0)
{
	    $cfg_ver_lang = 'gb2312';
		$htmlhead  = "<html>\r\n<head>\r\n<title>ϵͳ��ʾ</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$cfg_ver_lang}\" />\r\n";
		$htmlhead .= "<base target='_self'/>\r\n</head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
		$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n<br>";

		if($limittime==0) $litime = 5000;
		else $litime = $limittime;

		if($gourl=="-1"){
			if($limittime==0) $litime = 5000;
			$gourl = "javascript:history.go(-1);";
		}

		if($gourl==""||$onlymsg==1){
			$msg = "<script>alert(\"".str_replace("\"","��",$msg)."\");</script>";
		}else{
			$func = "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
			$rmsg = $func;
			$rmsg .= "document.write(\"<br/><div style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>ϵͳ��ʾ��Ϣ��</div>\");\r\n";
			$rmsg .= "document.write(\"<div style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3'><br/><br/>\");\r\n";
			$rmsg .= "document.write(\"".str_replace("\"","��",$msg)."\");\r\n";
			$rmsg .= "document.write(\"";
			if($onlymsg==0){
				if($gourl!="javascript:;" && $gourl!=""){ $rmsg .= "<br/><br/><a href='".$gourl."'>�����������û��Ӧ����������...</a>"; }
				$rmsg .= "<br/><br/></div>\");\r\n";
				if($gourl!="javascript:;" && $gourl!=""){ $rmsg .= "setTimeout('JumpUrl()',$litime);"; }
			}else{ $rmsg .= "<br/><br/></div>\");\r\n"; }
			$msg  = $htmlhead.$rmsg.$htmlfoot;
		}
		echo $msg;
}

?>
