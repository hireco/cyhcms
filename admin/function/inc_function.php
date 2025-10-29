<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<?php 
require_once("setting.php");    
require_once(dirname(__FILE__)."/../../config/base_cfg.php");
require_once(dirname(__FILE__)."/pub_httpdown.php");
require_once(dirname(__FILE__)."/../../file_do/image_do.php");

//获取内容
 function  get_content_url($imgurl,$root_relate) {
  global $cfg_mainsite;
  global $cfg_upload_root;
  global $upload_child_dir;
  
 if(!ereg($cfg_mainsite,$imgurl))
        {  $img_dir=$root_relate."/".$cfg_upload_root.$upload_child_dir;
           $img_url = $cfg_upload_root.$upload_child_dir;
		   $img_dir= $img_dir.strftime("%y%m%d",time()); $img_url= $img_url.strftime("%y%m%d",time()); 
           if(!is_dir($img_dir))  @mkdir($img_dir);
		   
		   $file_name = strftime("%H%M%S",time()).mt_rand(100,999);   
		   $file_suffix=explode(".",basename($imgurl));    
		   
		   $file_suffix[1]=strtolower($file_suffix[1]);
		   $sparr = Array("jpeg","jpg","gif","png","bmp");
		   
		   if(!in_array($file_suffix[1],$sparr))  return ""; //安全检查
		   
		   $file_name =$file_name.".".$file_suffix[1];
           
		        
		   $imgname =$img_dir."/".$file_name;
		   $img_url=$img_url."/".$file_name;
		   
		   $imgfile=file_get_contents($imgurl);
           
		   if($imgfile) {
		   $fp=@fopen($imgname, "a");
           fwrite($fp,$imgfile);
           fclose($fp);  
		   $imgurl=  $cfg_mainsite.$img_url; 
		  } 
		  else $imgurl="";
     }
   return $imgurl;
  }
  
//信息显示函数
function ShowMsg($msg,$gourl,$onlymsg=0,$limittime=0)
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

function MkdirAll($truepath,$mmode){
       if(!file_exists($truepath)){
		  	 mkdir($truepath,$mmode);
		  	 chmod($truepath,$mmode);
		  	 return true;
		  }else{
		  	return true;
		  }
  
}

//中文字符串截断
function msubstr($str, $start, $len) {
 $tmpstr = "";
 $strlen = $start + $len;
 for($i = 0; $i < $strlen; $i++) {
 if(ord(substr($str, $i, 1)) > 0xa0) {
  $tmpstr .= substr($str, $i, 2);
   $i++;
  } else
 $tmpstr .= substr($str, $i, 1);
 }
 return $tmpstr;
}

//获得文章body里的外部资源
function GetCurContent($body)
{   global $cfg_mainsite, $cfg_upload_root, $cfg_base_url,$upload_child_dir;
	
	$cfg_basehost=ereg_replace("/$","",$cfg_base_url);
	$cfg_uploaddir = $cfg_upload_root.$upload_child_dir;
	$cfg_basedir = RROOT."/";

	$htd = new DedeHttpDown();
	
	$basehost = "http://".$_SERVER["HTTP_HOST"];
	
    $img_array = array();
	preg_match_all("/(src|SRC)=[\"|'| ]{0,}(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png))/isU",$body,$img_array);
	$img_array = array_unique($img_array[2]);
	
	$imgUrl = $cfg_uploaddir.strftime("%y%m%d",time());
	$imgPath = $cfg_basedir.$imgUrl;
	
	if(!is_dir($imgPath))  MkdirAll($imgPath,"0755");  
		
	$milliSecond = strftime("%H%M%S",time());
	
	foreach($img_array as $key=>$value)
	{
		if(eregi($basehost,$value)) continue;
		if($cfg_basehost!=$basehost && eregi($cfg_basehost,$value)) continue;
		if(!eregi("^http://",$value)) continue;
		//随机命名文件
		$htd->OpenUrl($value);
		$itype = $htd->GetHead("content-type");
		if($itype=="image/gif") $itype = ".gif";
		else if($itype=="image/png") $itype = ".png";
		else $itype = ".jpg";
		$value = trim($value);
		$rndFileName = $imgPath."/".$milliSecond.$key.$itype;
		$fileurl = $cfg_mainsite.$imgUrl."/".$milliSecond.$key.$itype;
		//下载并保存文件
		$rs = $htd->SaveToBin($rndFileName);
		if($rs){
			$body = str_replace($value,$fileurl,$body);
			@WaterImg($rndFileName,'down');
	  }
	}
	$htd->Close();
	return $body;
}
//html转换为txt
function Html2Text($str){
	$str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU",'',$str);
	$str = str_replace(array('<br />','<br>','<br/>'), "\n", $str);
	$str = strip_tags($str);
	return $str;
}
//文档自动分页
function SpLongBody(&$mybody,$spsize,$sptag)
{
  if(strlen($mybody)<$spsize) return $mybody;
  $bds = explode('<',$mybody);
  $npageBody = "";
  $istable = 0;
  $mybody = "";
  foreach($bds as $i=>$k)
  {
  	 if($i==0){ $npageBody .= $bds[$i]; continue;}
  	 $bds[$i] = "<".$bds[$i];
  	 if(strlen($bds[$i])>6){
  		  $tname = substr($bds[$i],1,5);
  		  if(strtolower($tname)=='table') $istable++;
  		  else if(strtolower($tname)=='/tabl') $istable--;
  		  if($istable>0){ $npageBody .= $bds[$i]; continue; }
  		  else $npageBody .= $bds[$i];
  	 }else{
  		  $npageBody .= $bds[$i];
  	 }
  	 if(strlen($npageBody)>$spsize){
  		  $mybody .= $npageBody.$sptag;
  		  $npageBody = "";
     }
  }
  if($npageBody!="") $mybody .= $npageBody;
  return $mybody;
}

//确认后执行
function ConfMsg($cf_str) 
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<html>
<head>
<title>系统提示</title>
</head>
<body leftmargin='0' topmargin='0'>
<center>
<br/><div style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>系统提示信息：</div>
<div  style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3'><br/><br/>
<form name=\"form1\" method=\"post\" action=\"\">";
echo $cf_str;
echo "<br/><br/>
<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td><div align=\"center\">
        <input name=\"confirm_sub\" type=\"submit\" id=\"confirm_sub\" value=\"确  认\">
      </div></td>
      <td><div align=\"center\">
        <input name=\"cancel\" type=\"button\" id=\"cancel\" onclick=\"window.close();\" value=\"放 弃\">
      </div></td>
    </tr>
  </table>
<br/>
<br/>
</form>
</div>
</center>
</body>
</html>
";
}

//关闭窗口
function MsgClose1($cf_str) 
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<html>
<head>
<title>系统提示</title>
</head>
<body leftmargin='0' topmargin='0'>
<center>
<br/><div style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>系统提示信息：</div>
<div style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3'><br/><br/>";
echo $cf_str;
echo "<br/><br/>
  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td><div align=\"center\">
        <input name=\"close_refresh\" type=\"button\" id=\"close_refresh\" value=\"<关闭窗口>\" onclick=\" window.close();\">
      </div></td>
    </tr>
  </table>
<br/>
<br/></div>
</center>
</body>
</html>
";
} 

//关闭窗口并刷新主窗口
function MsgClose($cf_str) 
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<html>
<head>
<title>系统提示</title>
</head>
<body leftmargin='0' topmargin='0'>
<center>
<br/><div style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>系统提示信息：</div>
<div style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3'><br/><br/>";
echo $cf_str;
echo "<br/><br/>
  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td><div align=\"center\">
        <input name=\"close_refresh\" type=\"button\" id=\"close_refresh\" value=\"<关闭并刷新>\" onclick=\"opener.location.reload(); window.close();\">
      </div></td>
    </tr>
  </table>
<br/>
<br/></div>
</center>
</body>
</html>
";
} 

//获取目录的大小
function dirsize($dir) {
@$dh = opendir($dir);
$size = 0;
while ($file = @readdir($dh)) {
if ($file != "." and $file != "..") {
$path = $dir."/".$file;
if (is_dir($path)) {
$size += dirsize($path);
} elseif (is_file($path)) {
$size += filesize($path);
}
}
}
@closedir($dh);
return $size;
}

//评论的回复模式的获取
function comment_reply_mode($content,$user_type,$person,$face,$post_ip,$post_time,$flag) { 
      global $cfg_mainsite; 
	  if($flag=="") {
   ?>
   <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><font color=blue><?php if($user_type=="a")  echo "匿名"; elseif($user_type=="s") echo "管理员"; else echo "注册用户"; ?>： <strong><?=$person;?></strong></font> <img src="<?=$cfg_mainsite?>image/face/<?=$face?>.gif" align="absmiddle"> IP：<?=$post_ip;?></td>
                      <td> <div align="right"><?=$post_time;?> 发表</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF">				  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td>
   <?php }	    
	$content=stripslashes($content);
	$person1="<table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#CCCCCC\"><tr><td bgcolor=\"#FFF8F5\"><!-comment-><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"2\"><tr><td><div align=\"right\">评论人："; 
	$content=ereg_replace("<!-person1->",$person1,$content);
	
	$person2="</div></td>"; 
	$content=ereg_replace("<!-person2->",$person2,$content);
	
	$ip1="<td><div align=\"right\">IP："; 
	$content=ereg_replace("<!-ip1->",$ip1,$content);
	
	$ip2="</div></td>"; 
	$content=ereg_replace("<!-ip2->",$ip2,$content);
	
	$time1="<td><div align=\"right\">时间："; 
	$content=ereg_replace("<!-time1->",$time1,$content);
	
	$time2="</div></td>"; 
	$content=ereg_replace("<!-time2->",$time2,$content);
	
	$content1="</tr><tr><td colspan=\"3\">"; 
	$content=ereg_replace("<!-content1->",$content1,$content);
	
	$content2="</td></tr></table></td></tr></table>"; 
	$content=ereg_replace("<!-content2->",$content2,$content);
	
	$content=ereg_replace("<!-face"," <img src=\"".$cfg_mainsite."image/face/",$content);
	$content=ereg_replace("face->",".gif\" align=\"absmiddle\">",$content);
	echo $content; 
	if($flag=="") { ?>
	</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
	<?php }
   }
 
//评论内容的数据库格式转换  
  function comment_sql_mode($person,$face,$post_ip,$post_time,$content) {
        return "<!-person1->"."$person"."<!-face"."$face"."face-><!-person2->
                              <!-ip1->"."$post_ip"."<!-ip2->
                              <!-time1->"."$post_time"."<!-time2->
                              <!-content1->"."$content"."<!-content2->";
  }
?>
