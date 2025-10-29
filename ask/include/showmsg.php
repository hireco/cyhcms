<script>
function hideobj(obj_id) {
  obj_id.style.display="none";
}

function showobj(obj_id) {
  obj_id.style.display="block";
}
</script>
<?php 
function showmsg($infor,$win_id) {
 global $cfg_site_name;
?>
<DIV class=main1 id=<?=$win_id?>  style="DISPLAY: none; RIGHT: 120px; POSITION: absolute; BOTTOM: 100px ">
      <DIV id=headerbg>
      <H2><?=$cfg_site_name?>系统提示</H2><SPAN><A 
      href="javascript:hideobj(<?=$win_id?>);"><IMG alt=关闭 src="user.files/close1.gif"></A></SPAN> 
      <DIV class=c></DIV></DIV>
      <DIV id=pop_cont1>
      <DIV class=area><IMG alt=notice src="user.files/notice_grzx.gif"> 
      <P style="LINE-HEIGHT: 22px"><?=$infor?></P>
      <DIV class=c></DIV></DIV>
      <DIV id=butt_area>
      <DIV style="PADDING-TOP: 7px">
	  <INPUT class=buttBg1 id=addtrue  onClick="javascript:hideobj(<?=$win_id?>);" 
	  type=button value="确 定" name=""> 
      </DIV></DIV></DIV></DIV>
<?php 
 }
function showcfm($infor,$win_id) {
  global $cfg_site_name;
 ?>
<DIV class=main1 id=<?=$win_id?>  style="DISPLAY: none; RIGHT: 120px; POSITION: absolute; BOTTOM: 100px">
      <DIV id=headerbg>
      <H2><?=$cfg_site_name?>系统提示</H2><SPAN><A href="javascript:hideobj(<?=$win_id?>);"><IMG alt=关闭 src="user.files/close1.gif"></A></SPAN> 
      <DIV class=c></DIV></DIV>
      <DIV id=pop_cont1>
      <DIV class=area><IMG alt=notice src="user.files/notice_grzx.gif"> 
      <P style="LINE-HEIGHT: 22px"><?=$infor?> </P>
      <DIV class=c></DIV></DIV>
      <DIV id=butt_area>
      <DIV style="PADDING-TOP: 7px">
      <INPUT class=buttBg1 type=button value="确 定" name="done_true" onclick="hideobj(<?=$win_id?>); return true;">&nbsp; 
      <INPUT class=buttBg1 type=button value="取 消" name="done_cancel" onclick="hideobj(<?=$win_id?>); return false;">
</DIV></DIV></DIV></DIV>
<?php } 
 //信息显示函数
function show_message($msg,$gourl,$onlymsg=0,$limittime=0)
{
	    $cfg_ver_lang = 'gb2312';
		$htmlhead  = "<html>\r\n<head>\r\n<title>系统提示</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$cfg_ver_lang}\" />\r\n";
		$htmlhead .= "<base target='_self'/>\r\n</head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
		$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n<br>";

		if($limittime==0) $litime = 5000;
		else $litime = $limittime;

		if($gourl=="-1"){
			if($limittime==0) $litime = 5000;
			$gourl = "javascript:history.go(-1);";
		}

		if($gourl==""||$onlymsg==1){
			$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
		}else{
			$func = "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
			$rmsg = $func;
			$rmsg .= "document.write(\"<br/><div style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>系统提示信息：</div>\");\r\n";
			$rmsg .= "document.write(\"<div style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3'><br/><br/>\");\r\n";
			$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
			$rmsg .= "document.write(\"";
			if($onlymsg==0){
				if($gourl!="javascript:;" && $gourl!=""){ $rmsg .= "<br/><br/><a href='".$gourl."'>如果你的浏览器没反应，请点击这里...</a>"; }
				$rmsg .= "<br/><br/></div>\");\r\n";
				if($gourl!="javascript:;" && $gourl!=""){ $rmsg .= "setTimeout('JumpUrl()',$litime);"; }
			}else{ $rmsg .= "<br/><br/></div>\");\r\n"; }
			$msg  = $htmlhead.$rmsg.$htmlfoot;
		}
		echo $msg;
}
 
?>