<?php 
session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
require_once(dirname(__FILE__)."/scripts/chk_name_valid.php");

$base_dir=RROOT;

$activepath=$_REQUEST['activepath'];

if(empty($activepath)) $activepath =""; 

$inpath = $base_dir.$activepath; 

$activeurl = $base_dir.$activepath;

$present_path=$activepath==""?"/":$activepath;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>文件管理器</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once(dirname(__FILE__)."/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="../image/body_title_left.gif" width="3" height="27" /></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                    <div align="center" class="bigtext_b">文件管理器</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27" /></td>
              </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<?php if($_SESSION['root']=="super_administrator") { ?>
<table width="100%" height="200"  border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td valign="top">
	<?php 
	  if(isset($_POST['mkdir_sub'])) { 
	   $dirname=trim($_POST['mkdir']);
	   $dirname = trim(ereg_replace($dir_chk_str,"",$dirname));
	   if($dirname=="")		ShowMsg("目录名非法！","-1");
	   elseif(!is_dir($base_dir.$activepath."/$dirname")) {
	   MkdirAll($base_dir.$activepath."/".$dirname,"0755");
	   ShowMsg("成功创建一个目录！","file_manage_main.php?activepath=".urlencode($activepath));
	   }
	   else  ShowMsg("创建目录失败，可能有重名！","-1");  
       exit();	  
	 }
	 
	 else if(isset($_POST['mkfile_sub'])) { 
	 $filecontent=stripslashes(trim($_POST['filecontent']));
	 $filename=trim($_POST['mkfile']);
	 $filename = trim(ereg_replace($file_chk_str,"",$filename));
	 if($filename=="")	ShowMsg("文件名非法！","-1");
	 else if(!is_file($base_dir.$activepath."/".$filename)) {
	   $fp=fopen($base_dir.$activepath."/".$filename,"w");
       $result=fwrite($fp,$filecontent);
       fclose($fp);
	   if($result) ShowMsg("成功创建文件！","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("创建文件失败！","file_manage_main.php?activepath=".urlencode($activepath));
	  }
	 else ShowMsg("创建文件失败，可能有重名！","-1");
	 exit(); 
	 }
	 
	 else if(isset($_POST['edit_sub'])) { 
	 $filecontent=stripslashes(trim($_POST['filecontent']));
	 $filename=$_REQUEST['filename'];
	 if(!is_file($base_dir.$activepath."/".$filename)) ShowMsg("对不起,原文件不存在!","-1"); 
	 else {
	   $fp=fopen($base_dir.$activepath."/".$filename,"w");
       $result=fwrite($fp,$filecontent);
       fclose($fp);
	   if($result) ShowMsg("成功编辑文件！","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("编辑文件失败！","file_manage_main.php?activepath=".urlencode($activepath));
	    }
	  exit(); 
	 }
	 
	  else if(isset($_POST['del_sub'])) { 
	  $filename=$_REQUEST['filename'];
	  if((!is_file($base_dir.$activepath."/".$filename))&&(!is_dir($base_dir.$activepath."/".$filename))) ShowMsg("对不起,删除对象不存在!","-1"); 
	  elseif(is_file($base_dir.$activepath."/".$filename)){
	   $result=unlink($base_dir.$activepath."/".$filename);
	   if($result) ShowMsg("成功删除对象！","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("删除对象失败！","file_manage_main.php?activepath=".urlencode($activepath));
	    }
	  elseif(is_dir($base_dir.$activepath."/".$filename)) {
	   $result=rmdir($base_dir.$activepath."/".$filename);
	   if($result) ShowMsg("成功删除目录!","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("删除目录失败,可能目录非空!","-1");
	   }	 
	  exit(); 
	 }
	 
	 else if(isset($_POST['upload_sub'])) { 
	  $uploadfile=$_FILES['uploadfile'];
	  if(empty($uploadfile)) $uploadfile="";
	  if(!is_uploaded_file($uploadfile['tmp_name'])) ShowMsg("你没有选择上传的文件!","-1");
      else 	{
	    if(empty($_POST['filename'])) $filename=$uploadfile['name']; else $filename=$_POST['filename'];
		if(is_file($base_dir.$activepath."/".$filename)) ShowMsg("你的文件名与现有文件名重复!","-1");
		else {
		    if(!eregi("\.(".$cfg_mb_filetype.")$",$filename)) ShowMsg("你所上传的文件类型被禁止！","-1");
		    else { 
			      @move_uploaded_file($uploadfile['tmp_name'],$base_dir.$activepath."/".$filename);
				  ShowMsg("恭喜，成功上传文件!","file_manage_main.php?activepath=".urlencode($activepath));
				  }
			 }
	      }

	 }
	 
	 else if(isset($_POST['rename_sub'])) { 
	 $new_name=trim($_POST['new_name']);
	 $filename=$_REQUEST['filename'];
	 $new_name = trim(ereg_replace($file_chk_str,"",$new_name));
	 if($new_name=="")	ShowMsg("文件名非法！","-1");
	 else { 
	      $result=rename($base_dir.$activepath."/".$filename, $base_dir.$activepath."/".$new_name);
	      if($result) ShowMsg("恭喜，成功重新命名文件!","file_manage_main.php?activepath=".urlencode($activepath));
		  else ShowMsg("操作失败，请重来！","-1");
		  }
	 }
	 
	 else if(isset($_POST['move_sub'])) { 
	 $new_dir=trim($_POST['new_dir']);
	 $filename=$_REQUEST['filename'];
	 $new_dir = trim(ereg_replace($dir_chk_str,"",$new_dir));
	 if($new_dir=="")	ShowMsg("目录名非法！","-1");
	 else if(!is_dir($base_dir."/".$new_dir)) ShowMsg("目录不存在，自动返回！","-1");
	 else { 
	      $result=copy($base_dir.$activepath."/".$filename, $base_dir."/".$new_dir."/".$filename);
	      if($result) { unlink($base_dir.$activepath."/".$filename); ShowMsg("成功移动文件,现在转向目标文件夹","file_manage_main.php?activepath=".urlencode($new_dir)); }
		  else ShowMsg("操作失败，请重来！","-1");
		  }
	 }
	 
	 else if($_REQUEST['fmdo']=="newdir") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
          <table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td bgcolor="#CFCFC2">文件管理器＞建立新目录</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td width="300">                <div align="left">
                  <input name="mkdir" type="text" class="inputbut" id="mkdir" style="width:250px;"  />
                </div></td>
              <td>请输入目录名称　　当前目录：<?=$present_path?>                 (相对本系统的根目录<?=$cfg_root?>来说)</td>
            </tr>
            <tr>
              <td>
                <div align="left">
                  <input name="mkdir_sub" type="submit" class="inputbut" id="mkdir_sub" value="提　交" />
                  <input name="reset" type="reset" class="inputbut" id="mkdir_sub3" value="重　设" />
				  <input name="cancel" type="button" class="inputbut" id="cancel" value="不理返回" onclick="history.go(-1);"/>             
                    </div></td>
              <td>注意：目录中不要带＂／＂字符</td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table>
	<?php } else if(($_REQUEST['fmdo']=="newfile")||($_REQUEST['fmdo']=="edit")) { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#CBD6C7">文件管理器＞<?php echo $_REQUEST['fmdo']=="edit"?"编辑":"建立新"; ?>文件</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><div align="left"><?php if($_REQUEST['fmdo']=="edit") { 
				   $filename=$_REQUEST['filename'];
				   $fileurl=$base_dir.$activepath."/".$filename;
				   $fp=fopen($fileurl,"r");
                   $filecontent=fread($fp,filesize($fileurl));
                   fclose($fp); 
				   echo "当前编辑的文件：".$filename; ?>
				  <?php } else { ?>
				  文件名
				  <input name="mkfile" type="text" class="inputbut" id="mkfile" style="width:250px;" />
				  <?php } ?>
				  当前目录：
				  <?=$present_path?>(相对本系统的根目录<?=$cfg_root?>来说)
				  <?php if(!isset($_REQUEST['view'])) { ?>
				  <input name="view_edit" type="button" class="inputbut" onclick="location='?view&fmdo=<?=$_REQUEST['fmdo']?>&filename=<?=$_REQUEST['filename']?>&activepath=<?=urlencode($activepath)?>'" value="可视化编辑" />
                  <?php } else { ?>
				  <input name="view_edit" type="button" class="inputbut" onclick="location='?fmdo=<?=$_REQUEST['fmdo']?>&filename=<?=$_REQUEST['filename']?>&activepath=<?=urlencode($activepath)?>'" value="文本编辑" />
                  <?php } ?>
				 </div></td>
                </tr>
              <tr>
                <td>
				<?php if(!isset($_REQUEST['view'])) {  ?>
				<textarea name="filecontent" cols="100" rows="20"  id="filecontent" style="width:800px;"><?=htmlspecialchars($filecontent)?></textarea></td>
                <?php } else {
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("filecontent");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '800' ;
					$fck->Height		= "400" ;
					$fck->ToolbarSet	= "Default" ;
					$fck->Value = $filecontent ;
					$fck->Create(); 
				    } 
			    ?>
			  </tr>
              <tr>
                <td>                  <div align="left"><?php if($_REQUEST['fmdo']=="newfile") { ?>
                    <input name="mkfile_sub" type="submit" class="inputbut" id="mkfile_sub" value="提　交" />
                    <?php } else { ?>
					<input name="edit_sub" type="submit" class="inputbut" id="edit_sub" value="提　交" />
					<?php } ?>
					<input name="reset2" type="reset" class="inputbut" id="reset" value="重　设" />
                    <input name="cancel2" type="button" class="inputbut" id="cancel2" value="不理返回" onclick="history.go(-1);"/>
                    注意：文件名中不要带特殊字符</div></td>
                </tr>
            </table>
            </form></td>
      </tr>
    </table>
	<?php } else if($_REQUEST['fmdo']=="upload") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#E8D0FF">文件管理器＞上传文件</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="uploadfile" type="file" id="uploadfile"  class="inputbut" style="width:250px;"/>
</div></td>
                <td>请输入选择文件　　当前目录：
                    <?=$present_path?>
              (相对本系统的根目录
              <?=$cfg_root?>
              来说)</td>
              </tr>
              <tr>
                <td><input type="text" name="filename" class="inputbut" style="width:185px;"/> 
                  修改文件名</td>
                <td>注意：文件中不要带特殊字符，不填则保持原名</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="upload_sub" type="submit" class="inputbut" id="upload_sub" value="提　交" />
                    <input name="reset3" type="reset" class="inputbut" id="reset2" value="重　设" />
                    <input name="cancel3" type="button" class="inputbut" id="cancel3" value="不理返回" onclick="history.go(-1);"/>
                </div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table>
	<?php } elseif($_REQUEST['fmdo']=="space") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#DFDF9F">文件管理器＞查看空间概况</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td colspan="2">
                  <span class="bigtext_b">本目录(<?=$present_path?>)的大小为:
                  <div align="left">
				  <?php $dir_see = $base_dir.$activepath;
                         $cc = dirsize($dir_see);
						 $bb=$cc/1023;
                         $aa=$bb/1024;
                         echo "<font color=red>".$aa." MB</font>"."<br><font color=blue>".$bb." K</font>"."<br><font color=violet>".$cc." 字节</font>"; ?>
</div></span></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
	
	<?php } else if($_REQUEST['fmdo']=="rename") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#CEDBFF">文件管理器＞更改文件名</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><span class="bigtext_b"><font color="#FF0000"><?=$_REQUEST['filename']?></font></span></td>
                <td>原文件名</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="new_name" type="text" class="inputbut" id="new_name" style="width:250px;" />
                </div></td>
                <td>请输入新文件名　　当前目录：
                    <?=$present_path?>
              (相对本系统的根目录
              <?=$cfg_root?>
              来说)</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="rename_sub" type="submit" class="inputbut" id="rename_sub" value="提　交" />
                    <input name="reset4" type="reset" class="inputbut" id="reset3" value="重　设" />
                    <input name="cancel4" type="button" class="inputbut" id="cancel4" value="不理返回" onclick="history.go(-1);"/>
                  </div></td>
                <td>注意：不要带特殊字符</td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table>
	
	<?php } else if($_REQUEST['fmdo']=="del") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#D7F9FB">文件管理器＞删除文件</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><div class="bigtext_b">
                  您将要删除<?php if(is_dir($base_dir.$activepath."/".$_REQUEST['filename'])) echo $object_del="目录"; else echo $object_del="文件"; ?>名：<font color="#FF0000">
                     <?=$_REQUEST['filename']?>
                </font></div></td>
                <td><?php echo "当前".$object_del."所在上级目录：".$present_path; ?>
(相对本系统的根目录
<?=$cfg_root?>
来说)</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">您确实要删除这个<?=$object_del?>吗?                </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <div align="left">
                    <input name="del_sub" type="submit" class="inputbut" id="del_sub" value="提　交" />
                    <input name="reset42" type="reset" class="inputbut" id="reset4" value="取  消" onclick="history.go(-1);" />
                </div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table>
	
	<?php } else if($_REQUEST['fmdo']=="move") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#CEDBFF">文件管理器＞更改文件名</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><div class="bigtext_b">
                  您将要移动的文件：<font color="#FF0000">
                     <?=$_REQUEST['filename']?>
                </font></div></td>
                <td>文件原来所在目录：
                  <?=$present_path?>
(相对本系统的根目录 <?=$cfg_root?> 来说)</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="new_dir" type="text" class="inputbut" id="new_dir" style="width:250px;" />
                </div></td>
                <td>请输入新的文件目录 注意：不要带特殊字符 (路径相对 <?=$cfg_root?>)</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="move_sub" type="submit" class="inputbut" id="move_sub" value="提　交" />
                    <input name="reset42" type="reset" class="inputbut" id="reset3" value="重　设" />
                    <input name="cancel5" type="button" class="inputbut" id="cancel5" value="不理返回" onclick="history.go(-1);"/>
                  </div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table>
	<?php } ?>
	</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td bgcolor="#FFCC99"><a href='file_manage_main.php'>[根目录]</a> &nbsp; <a href='<?php echo "file_manage_main.php?activepath=".urlencode($activepath);?>'>[当前目录]</a> &nbsp; <a href='file_manage_view.php?fmdo=newfile&amp;activepath=<?php echo urlencode($activepath)?>'></a><a href='file_manage_view.php?fmdo=newfile&amp;activepath=<?php echo urlencode($activepath)?>'>[新建文件]</a> &nbsp; <a href='file_manage_view.php?fmdo=newdir&amp;activepath=<?php echo urlencode($activepath)?>'>[新建目录]</a> &nbsp; <a href='file_manage_view.php?fmdo=upload&amp;activepath=<?php echo urlencode($activepath)?>'>[文件上传]</a> &nbsp; <a href='file_manage_view.php?fmdo=space&amp;activepath=<?php echo urlencode($activepath)?>'>[空间检查]</a> &nbsp;&nbsp;</td>
  </tr>
</table>
<?php } else ShowMsg("对不起,您无权限访问此页面",-1); ?>
</body>
</html>
