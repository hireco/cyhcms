<?php 
require_once("setting.php");
require_once("inc.php"); ?>
<html>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="5" colspan="6"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top" ><img src="image/body_title_left.gif" width="3" height="27"></td>
        <td bgcolor="#FFFFFF">
          <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0" style="display:<?php if($_REQUEST['action_do']=="selsource") echo "block"; else echo "none";?>;">
            <tr>
              <td><div class="style1">ѡ����Դ</div></td>
            </tr>
          </table>
		  <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0" style="display:<?php if($_REQUEST['action_do']=="selwriter") echo "block"; else echo "none";?>;">
            <tr>
              <td><div class="style1">ѡ������</div></td>
            </tr>
          </table>
		  <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0" style="display:<?php if($_REQUEST['action_do']=="edisource") echo "block"; else echo "none";?>; ">
            <tr>
              <td><div class="style1">��Դ���</div></td>
            </tr>
          </table>
		  <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0" style="display:<?php if($_REQUEST['action_do']=="ediwriter") echo "block"; else echo "none";?>; ">
            <tr>
              <td><div class="style1">�������</div></td>
            </tr>
          </table>        </td>
        <td valign="top" ><img src="image/body_title_right.gif" width="3" height="27"></td>
        <td>&nbsp;</td>
        <td style="display: <?php if($_REQUEST['action_do']=="selsource") echo "block"; else echo "none";?>;"><a href="source_writer.php?action_do=edisource">�����Դ</a></td>
		<td style="display: <?php if($_REQUEST['action_do']=="selwriter") echo "block"; else echo "none";?>;"><a href="source_writer.php?action_do=ediwriter">�������</a></td>
        <td style="display: <?php if($_REQUEST['action_do']=="edisource") echo "block"; else echo "none";?>;"><a href="source_writer.php?action_do=selsource">ѡ����Դ</a></td>
		<td style="display: <?php if($_REQUEST['action_do']=="ediwriter") echo "block"; else echo "none";?>;"><a href="source_writer.php?action_do=selwriter">ѡ������</a></td>
     </tr>
    </table></td>
  </tr>
</table>
<?php 
$action_do = $_GET['action_do'];
if($action_do=='selsource') //��Դ�б�
{
  $m_file = "inc/source.txt";
  $allsources = file($m_file);  
  foreach($allsources as $v){
	  $v = trim($v);
	  if($v!="") echo "<a href='#' onclick='javascript:PutSource(\"$v\")'>$v</a> | \r\n";
  }
  echo "&nbsp;\r\n";
}
else if($action_do=='selwriter'){ //�����б�
	$m_file = "inc/writer.txt";
	if(filesize($m_file)>0){
	   $fp = fopen($m_file,'r');
	   $str = fread($fp,filesize($m_file));
	   fclose($fp);
	   $strs = explode(',',$str);
	   foreach($strs as $str){
	   	 $str = trim($str);
	   	 if($str!="") echo "<a href='#' onclick='javascript:PutWriter(\"$str\")'>$str</a> | ";
	   }
  }
  echo "<br>&nbsp;\r\n";
}
if($action_do=="edisource"||$action_do=="ediwriter") {
if($action_do=='edisource') {
$dopost=$_POST['dopost'];
$allsource=$_POST['allsource'];
if(empty($dopost)) $dopost = "";
if(empty($allsource)) $allsource = "";
else $allsource = stripslashes($allsource);
$m_file ="inc/source.txt";
if($dopost=="save")
{
   $fp = fopen($m_file,'w');
   flock($fp,3);
   fwrite($fp,$allsource);
   fclose($fp);
   echo "<script>alert('�ɹ�д���¼!');</script>";
}

if(empty($allsource)&&filesize($m_file)>0){
   $fp = fopen($m_file,'r');
   $allsource = fread($fp,filesize($m_file));
   fclose($fp);
}
  } 
else if($action_do=='ediwriter') {
$dopost=$_POST['dopost'];
$allwriter=$_POST['allwriter'];
if(empty($dopost)) $dopost = "";
if(empty($allwriter)) $allwriter = "";
else $allwriter = stripslashes($allwriter);
$m_file ="inc/writer.txt";
if($dopost=="save")
{
   $fp = fopen($m_file,'w');
   flock($fp,3);
   fwrite($fp,$allwriter);
   fclose($fp);
   echo "<script>alert('�ɹ�д���¼!');</script>";
}
if(empty($allwriter)&&filesize($m_file)>0){
   $fp = fopen($m_file,'r');
   $allwriter = fread($fp,filesize($m_file));
   fclose($fp);
}
  }
?>
<form name="form2" action="source_writer.php?action_do=<?=$_REQUEST['action_do']?>" method="post">
    <input type="hidden" name="dopost" value="save">
<table width="96%" border="0" cellpadding="1" cellspacing="1" align="center" class="tbtitle" style="	background:#E2F5BC;">
		<tr>
				<td bgcolor="#EDF9D5" class="tbtitletxt"><strong>�������߹���</strong></td>
	</tr>
</table>
			
<table width="96%" border="0" cellpadding="1" cellspacing="0" align="center" style="margin:0px auto" class="tblist2">
		<tr align="center">
		  <td height="30" align="left">
		  <?php 
		  if($_REQUEST['action_do']=="ediwriter") echo "�����������ð�Ƕ��š�,���ֿ�,";
		  else echo "ÿ��һ����Դ,��д���ύ,";
		  ?>��д���ύ</td>
		</tr>
</table>
<table width="96%" border="0" cellpadding="1" cellspacing="0" align="center" style="margin:0px auto" class="tblist2">
		<tr align="center">
		  <td height="80" align="left"> <textarea name="<?php if($_REQUEST['action_do']=="ediwriter") echo "allwriter"; else echo "allsource"; ?>" rows="5"  style="width:100%;height:300"><?php if($_REQUEST['action_do']=="ediwriter") echo $allwriter; else echo $allsource; ?></textarea></td>
		</tr>
</table>
<table width="96%" border="0" cellpadding="5" cellspacing="1" align="center" style=" border:1px solid #E2F5BC;line-height:31px;margin:auto;">
		<tr>
		  <td height="35" align="center" style="background:#F9FFE6;padding:7px 6px 6px 10px;" ><input type="submit" name="Submit2" value="��������" class="inputbut"/></td>
		</tr>  
</table></form>
<?php 
 }
?>
</body>
</html>