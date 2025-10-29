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
<title>�ļ�������</title>
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
                    <div align="center" class="bigtext_b">�ļ�������</div>
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
	   if($dirname=="")		ShowMsg("Ŀ¼���Ƿ���","-1");
	   elseif(!is_dir($base_dir.$activepath."/$dirname")) {
	   MkdirAll($base_dir.$activepath."/".$dirname,"0755");
	   ShowMsg("�ɹ�����һ��Ŀ¼��","file_manage_main.php?activepath=".urlencode($activepath));
	   }
	   else  ShowMsg("����Ŀ¼ʧ�ܣ�������������","-1");  
       exit();	  
	 }
	 
	 else if(isset($_POST['mkfile_sub'])) { 
	 $filecontent=stripslashes(trim($_POST['filecontent']));
	 $filename=trim($_POST['mkfile']);
	 $filename = trim(ereg_replace($file_chk_str,"",$filename));
	 if($filename=="")	ShowMsg("�ļ����Ƿ���","-1");
	 else if(!is_file($base_dir.$activepath."/".$filename)) {
	   $fp=fopen($base_dir.$activepath."/".$filename,"w");
       $result=fwrite($fp,$filecontent);
       fclose($fp);
	   if($result) ShowMsg("�ɹ������ļ���","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("�����ļ�ʧ�ܣ�","file_manage_main.php?activepath=".urlencode($activepath));
	  }
	 else ShowMsg("�����ļ�ʧ�ܣ�������������","-1");
	 exit(); 
	 }
	 
	 else if(isset($_POST['edit_sub'])) { 
	 $filecontent=stripslashes(trim($_POST['filecontent']));
	 $filename=$_REQUEST['filename'];
	 if(!is_file($base_dir.$activepath."/".$filename)) ShowMsg("�Բ���,ԭ�ļ�������!","-1"); 
	 else {
	   $fp=fopen($base_dir.$activepath."/".$filename,"w");
       $result=fwrite($fp,$filecontent);
       fclose($fp);
	   if($result) ShowMsg("�ɹ��༭�ļ���","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("�༭�ļ�ʧ�ܣ�","file_manage_main.php?activepath=".urlencode($activepath));
	    }
	  exit(); 
	 }
	 
	  else if(isset($_POST['del_sub'])) { 
	  $filename=$_REQUEST['filename'];
	  if((!is_file($base_dir.$activepath."/".$filename))&&(!is_dir($base_dir.$activepath."/".$filename))) ShowMsg("�Բ���,ɾ�����󲻴���!","-1"); 
	  elseif(is_file($base_dir.$activepath."/".$filename)){
	   $result=unlink($base_dir.$activepath."/".$filename);
	   if($result) ShowMsg("�ɹ�ɾ������","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("ɾ������ʧ�ܣ�","file_manage_main.php?activepath=".urlencode($activepath));
	    }
	  elseif(is_dir($base_dir.$activepath."/".$filename)) {
	   $result=rmdir($base_dir.$activepath."/".$filename);
	   if($result) ShowMsg("�ɹ�ɾ��Ŀ¼!","file_manage_main.php?activepath=".urlencode($activepath));
	   else ShowMsg("ɾ��Ŀ¼ʧ��,����Ŀ¼�ǿ�!","-1");
	   }	 
	  exit(); 
	 }
	 
	 else if(isset($_POST['upload_sub'])) { 
	  $uploadfile=$_FILES['uploadfile'];
	  if(empty($uploadfile)) $uploadfile="";
	  if(!is_uploaded_file($uploadfile['tmp_name'])) ShowMsg("��û��ѡ���ϴ����ļ�!","-1");
      else 	{
	    if(empty($_POST['filename'])) $filename=$uploadfile['name']; else $filename=$_POST['filename'];
		if(is_file($base_dir.$activepath."/".$filename)) ShowMsg("����ļ����������ļ����ظ�!","-1");
		else {
		    if(!eregi("\.(".$cfg_mb_filetype.")$",$filename)) ShowMsg("�����ϴ����ļ����ͱ���ֹ��","-1");
		    else { 
			      @move_uploaded_file($uploadfile['tmp_name'],$base_dir.$activepath."/".$filename);
				  ShowMsg("��ϲ���ɹ��ϴ��ļ�!","file_manage_main.php?activepath=".urlencode($activepath));
				  }
			 }
	      }

	 }
	 
	 else if(isset($_POST['rename_sub'])) { 
	 $new_name=trim($_POST['new_name']);
	 $filename=$_REQUEST['filename'];
	 $new_name = trim(ereg_replace($file_chk_str,"",$new_name));
	 if($new_name=="")	ShowMsg("�ļ����Ƿ���","-1");
	 else { 
	      $result=rename($base_dir.$activepath."/".$filename, $base_dir.$activepath."/".$new_name);
	      if($result) ShowMsg("��ϲ���ɹ����������ļ�!","file_manage_main.php?activepath=".urlencode($activepath));
		  else ShowMsg("����ʧ�ܣ���������","-1");
		  }
	 }
	 
	 else if(isset($_POST['move_sub'])) { 
	 $new_dir=trim($_POST['new_dir']);
	 $filename=$_REQUEST['filename'];
	 $new_dir = trim(ereg_replace($dir_chk_str,"",$new_dir));
	 if($new_dir=="")	ShowMsg("Ŀ¼���Ƿ���","-1");
	 else if(!is_dir($base_dir."/".$new_dir)) ShowMsg("Ŀ¼�����ڣ��Զ����أ�","-1");
	 else { 
	      $result=copy($base_dir.$activepath."/".$filename, $base_dir."/".$new_dir."/".$filename);
	      if($result) { unlink($base_dir.$activepath."/".$filename); ShowMsg("�ɹ��ƶ��ļ�,����ת��Ŀ���ļ���","file_manage_main.php?activepath=".urlencode($new_dir)); }
		  else ShowMsg("����ʧ�ܣ���������","-1");
		  }
	 }
	 
	 else if($_REQUEST['fmdo']=="newdir") { ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form name="form1" id="form1" method="post" action="">
          <table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td bgcolor="#CFCFC2">�ļ���������������Ŀ¼</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td width="300">                <div align="left">
                  <input name="mkdir" type="text" class="inputbut" id="mkdir" style="width:250px;"  />
                </div></td>
              <td>������Ŀ¼���ơ�����ǰĿ¼��<?=$present_path?>                 (��Ա�ϵͳ�ĸ�Ŀ¼<?=$cfg_root?>��˵)</td>
            </tr>
            <tr>
              <td>
                <div align="left">
                  <input name="mkdir_sub" type="submit" class="inputbut" id="mkdir_sub" value="�ᡡ��" />
                  <input name="reset" type="reset" class="inputbut" id="mkdir_sub3" value="�ء���" />
				  <input name="cancel" type="button" class="inputbut" id="cancel" value="������" onclick="history.go(-1);"/>             
                    </div></td>
              <td>ע�⣺Ŀ¼�в�Ҫ���������ַ�</td>
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
                <td bgcolor="#CBD6C7">�ļ���������<?php echo $_REQUEST['fmdo']=="edit"?"�༭":"������"; ?>�ļ�</td>
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
				   echo "��ǰ�༭���ļ���".$filename; ?>
				  <?php } else { ?>
				  �ļ���
				  <input name="mkfile" type="text" class="inputbut" id="mkfile" style="width:250px;" />
				  <?php } ?>
				  ��ǰĿ¼��
				  <?=$present_path?>(��Ա�ϵͳ�ĸ�Ŀ¼<?=$cfg_root?>��˵)
				  <?php if(!isset($_REQUEST['view'])) { ?>
				  <input name="view_edit" type="button" class="inputbut" onclick="location='?view&fmdo=<?=$_REQUEST['fmdo']?>&filename=<?=$_REQUEST['filename']?>&activepath=<?=urlencode($activepath)?>'" value="���ӻ��༭" />
                  <?php } else { ?>
				  <input name="view_edit" type="button" class="inputbut" onclick="location='?fmdo=<?=$_REQUEST['fmdo']?>&filename=<?=$_REQUEST['filename']?>&activepath=<?=urlencode($activepath)?>'" value="�ı��༭" />
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
                    <input name="mkfile_sub" type="submit" class="inputbut" id="mkfile_sub" value="�ᡡ��" />
                    <?php } else { ?>
					<input name="edit_sub" type="submit" class="inputbut" id="edit_sub" value="�ᡡ��" />
					<?php } ?>
					<input name="reset2" type="reset" class="inputbut" id="reset" value="�ء���" />
                    <input name="cancel2" type="button" class="inputbut" id="cancel2" value="������" onclick="history.go(-1);"/>
                    ע�⣺�ļ����в�Ҫ�������ַ�</div></td>
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
                <td bgcolor="#E8D0FF">�ļ����������ϴ��ļ�</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="uploadfile" type="file" id="uploadfile"  class="inputbut" style="width:250px;"/>
</div></td>
                <td>������ѡ���ļ�������ǰĿ¼��
                    <?=$present_path?>
              (��Ա�ϵͳ�ĸ�Ŀ¼
              <?=$cfg_root?>
              ��˵)</td>
              </tr>
              <tr>
                <td><input type="text" name="filename" class="inputbut" style="width:185px;"/> 
                  �޸��ļ���</td>
                <td>ע�⣺�ļ��в�Ҫ�������ַ��������򱣳�ԭ��</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="upload_sub" type="submit" class="inputbut" id="upload_sub" value="�ᡡ��" />
                    <input name="reset3" type="reset" class="inputbut" id="reset2" value="�ء���" />
                    <input name="cancel3" type="button" class="inputbut" id="cancel3" value="������" onclick="history.go(-1);"/>
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
                <td bgcolor="#DFDF9F">�ļ����������鿴�ռ�ſ�</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td colspan="2">
                  <span class="bigtext_b">��Ŀ¼(<?=$present_path?>)�Ĵ�СΪ:
                  <div align="left">
				  <?php $dir_see = $base_dir.$activepath;
                         $cc = dirsize($dir_see);
						 $bb=$cc/1023;
                         $aa=$bb/1024;
                         echo "<font color=red>".$aa." MB</font>"."<br><font color=blue>".$bb." K</font>"."<br><font color=violet>".$cc." �ֽ�</font>"; ?>
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
                <td bgcolor="#CEDBFF">�ļ��������������ļ���</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><span class="bigtext_b"><font color="#FF0000"><?=$_REQUEST['filename']?></font></span></td>
                <td>ԭ�ļ���</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="new_name" type="text" class="inputbut" id="new_name" style="width:250px;" />
                </div></td>
                <td>���������ļ���������ǰĿ¼��
                    <?=$present_path?>
              (��Ա�ϵͳ�ĸ�Ŀ¼
              <?=$cfg_root?>
              ��˵)</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="rename_sub" type="submit" class="inputbut" id="rename_sub" value="�ᡡ��" />
                    <input name="reset4" type="reset" class="inputbut" id="reset3" value="�ء���" />
                    <input name="cancel4" type="button" class="inputbut" id="cancel4" value="������" onclick="history.go(-1);"/>
                  </div></td>
                <td>ע�⣺��Ҫ�������ַ�</td>
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
                <td bgcolor="#D7F9FB">�ļ���������ɾ���ļ�</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><div class="bigtext_b">
                  ����Ҫɾ��<?php if(is_dir($base_dir.$activepath."/".$_REQUEST['filename'])) echo $object_del="Ŀ¼"; else echo $object_del="�ļ�"; ?>����<font color="#FF0000">
                     <?=$_REQUEST['filename']?>
                </font></div></td>
                <td><?php echo "��ǰ".$object_del."�����ϼ�Ŀ¼��".$present_path; ?>
(��Ա�ϵͳ�ĸ�Ŀ¼
<?=$cfg_root?>
��˵)</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">��ȷʵҪɾ�����<?=$object_del?>��?                </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <div align="left">
                    <input name="del_sub" type="submit" class="inputbut" id="del_sub" value="�ᡡ��" />
                    <input name="reset42" type="reset" class="inputbut" id="reset4" value="ȡ  ��" onclick="history.go(-1);" />
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
                <td bgcolor="#CEDBFF">�ļ��������������ļ���</td>
              </tr>
            </table>
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><div class="bigtext_b">
                  ����Ҫ�ƶ����ļ���<font color="#FF0000">
                     <?=$_REQUEST['filename']?>
                </font></div></td>
                <td>�ļ�ԭ������Ŀ¼��
                  <?=$present_path?>
(��Ա�ϵͳ�ĸ�Ŀ¼ <?=$cfg_root?> ��˵)</td>
              </tr>
              <tr>
                <td width="300">
                  <div align="left">
                    <input name="new_dir" type="text" class="inputbut" id="new_dir" style="width:250px;" />
                </div></td>
                <td>�������µ��ļ�Ŀ¼ ע�⣺��Ҫ�������ַ� (·����� <?=$cfg_root?>)</td>
              </tr>
              <tr>
                <td>                  <div align="left">
                    <input name="move_sub" type="submit" class="inputbut" id="move_sub" value="�ᡡ��" />
                    <input name="reset42" type="reset" class="inputbut" id="reset3" value="�ء���" />
                    <input name="cancel5" type="button" class="inputbut" id="cancel5" value="������" onclick="history.go(-1);"/>
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
    <td bgcolor="#FFCC99"><a href='file_manage_main.php'>[��Ŀ¼]</a> &nbsp; <a href='<?php echo "file_manage_main.php?activepath=".urlencode($activepath);?>'>[��ǰĿ¼]</a> &nbsp; <a href='file_manage_view.php?fmdo=newfile&amp;activepath=<?php echo urlencode($activepath)?>'></a><a href='file_manage_view.php?fmdo=newfile&amp;activepath=<?php echo urlencode($activepath)?>'>[�½��ļ�]</a> &nbsp; <a href='file_manage_view.php?fmdo=newdir&amp;activepath=<?php echo urlencode($activepath)?>'>[�½�Ŀ¼]</a> &nbsp; <a href='file_manage_view.php?fmdo=upload&amp;activepath=<?php echo urlencode($activepath)?>'>[�ļ��ϴ�]</a> &nbsp; <a href='file_manage_view.php?fmdo=space&amp;activepath=<?php echo urlencode($activepath)?>'>[�ռ���]</a> &nbsp;&nbsp;</td>
  </tr>
</table>
<?php } else ShowMsg("�Բ���,����Ȩ�޷��ʴ�ҳ��",-1); ?>
</body>
</html>
