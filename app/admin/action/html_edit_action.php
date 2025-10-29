<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../../config/base_cfg.php");
require_once(dirname(__FILE__)."/../inc.php");
require_once(dirname(__FILE__)."/../function/inc_function.php");
require_once(dirname(__FILE__)."/../../config/auto_set.php");

$cfg_basehost=ereg_replace("/$","",$cfg_base_url);
if(isset($_POST['html_sub'])) {
//-------------------------------------------------------------------------------------------------------------
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
 
//-------------------------------------------------------------------------------------------------------------------
//把内容中远程的图片资源本地化

  $upload_child_dir = $cfg_img_root; //文章图片下载目录
  $body = GetCurContent($body);
//-------------------------------------------------------------------------------------------------------------------
//去除内容中的站外链接

	$body = str_replace($cfg_base_url,'#basehost#',$body);
	$body = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$body);
    $body = str_replace('#basehost#',$cfg_base_url,$body);


//写数据库
 

$content=$body;
$title=trim($title);
$file=trim($filename);

$filename="../scripts/html_set.php";

$string_read="";
if(is_file($filename)) { 
 $fp=fopen($filename,"r");
 $string_read=$string_read.fread($fp,filesize($filename));
 fclose($fp);
}
$string_read=ereg_replace("<\?php ","",$string_read);
$string_read=ereg_replace(" \?>","",$string_read);

$string_read=$string_read."\$file['$title']=\"$file\";"; 
$string_read=array_unique(explode(";",$string_read));
$string_read=implode(";",$string_read); 

$string_read="<?php ".$string_read." ?>";
$fp=fopen($filename,"w");
$result=fwrite($fp,$string_read);
fclose($fp);


$filename="../../html/$file";
$fp=fopen($filename,"w");
$result=fwrite($fp,$content);
fclose($fp);
if($result)  ShowMsg("恭喜,成功生成文件!","-1");
else  ShowMsg("文章发表失败,请重来！","-1");
 }
else {
  ShowMsg("操作失败或无效的访问！","-1");
  exit(); 
  }
?>
