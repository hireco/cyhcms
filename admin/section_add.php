<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php"); 
   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ĵ�����</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once("scripts/header.php");?>
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
                <td><img src="../image/body_title_left.gif" width="3" height="27"></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">�γ�����</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<br>
 <?php 
    $chapter_id=$_REQUEST['chapter_id'];
	$query="select * from ".$table_suffix."chapter where id=$chapter_id"; 
	$result=mysql_query($query);
	
	if(!mysql_num_rows($result)) ShowMsg("�����ڵ��½�","chapter_admin.php");
    
	else {
	
	$chapter_name=mysql_result($result,0,"chapter_name");
	$part_name=mysql_result($result,0,"part_name"); 

    echo $part_name." > ".$chapter_name." > ���С��";
    
	if(isset($_POST['submit_section'])) {
     $section_name=msubstr(trim($_POST['chapter_name']),0,50);
	 $outline=$_POST['outline'];
     $outline = stripslashes($outline);
	 $importance=msubstr($_POST['importance'],0,250);
	 $point=msubstr($_POST['point'],0,250);
	 $difficulty=msubstr($_POST['difficulty'],0,250);
	 
	 //��������Զ�̵�ͼƬ��Դ���ػ�
     $upload_child_dir = $cfg_img_root; //����ͼƬ����Ŀ¼
     $outline = GetCurContent($outline);
	 
	 //ȥ�������е�վ������
	 $outline = str_replace($cfg_base_url,'#basehost#',$outline);
	 $outline = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$outline);
     $outline = str_replace('#basehost#',$cfg_base_url,$outline);
	 $poster=$_SESSION['real_name'];
	 $post_time=date("y-m-d H:i:s");
	 $query="insert into ".$table_suffix."section (section_name, outline, point, difficulty, importance,chapter_id,poster, post_time)  values ('$section_name','$outline','$point','$difficulty','$importance',$chapter_id,'$poster','$post_time')";
	 $result=mysql_query($query);
	 if($result) ShowMsg("�ɹ�������µ�С��","section_admin.php?chapter_id=".$chapter_id);
	 else ShowMsg("���С��ʧ�ܣ���������������������",-1);
    } 
    else { 
?>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <form name="form1" method="post" action="">
    <td>
      <table width="100%" border="0">
    <tr>
    <td width="120"><div align="right">����С������</div></td>
    <td width="20">&nbsp;</td>
    <td><input name="chapter_name" type="text" class="INPUT" id="chapter_name" style="width:500px;"></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">��Ҫ���ݸ���<br>HTML��ʽ</div></td>
      <td>&nbsp;</td>
      <td valign="top"><?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("outline");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '500' ;
					$fck->Height		= "200" ;
					$fck->ToolbarSet	= "Small" ;
					$fck->Value = "" ;
					$fck->Create(); ?></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">֪ʶҪ��</div></td>
      <td>&nbsp;</td>
      <td><label>
        <textarea name="point" rows="3" class="TEXTAREA" id="point" style="width:500px;"></textarea>
      </label></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">�����ص�</div></td>
      <td>&nbsp;</td>
      <td><textarea name="importance" rows="3" class="TEXTAREA" id="importance" style="width:500px;"></textarea></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">�����ѵ�</div></td>
      <td>&nbsp;</td>
      <td><textarea name="difficulty" rows="3" class="TEXTAREA" id="difficulty" style="width:500px;"></textarea></td>
    </tr>
    <tr>
      <td><div align="right">����ύ</div></td>
      <td>&nbsp;</td>
      <td><input name="submit_section" type="submit" class="inputbut" id="submit_section" value="�� ��" />
        <input name="cancel" type="button" class="inputbut" id="cancel" value="������" onclick="history.go(-1);"/></td>
    </tr>
   </table>
  </td>
	</form>
  </tr>
</table>
<?php } 
  }
?>
</body>
</html>