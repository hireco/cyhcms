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
<title>文档管理</title>
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
                  <div align="center">课程设置</div>
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
	
	if(!mysql_num_rows($result)) ShowMsg("不存在的章节","chapter_admin.php");
    
	else {
	
	$chapter_name=mysql_result($result,0,"chapter_name");
	$part_name=mysql_result($result,0,"part_name"); 

    echo $part_name." > ".$chapter_name." > 添加小节";
    
	if(isset($_POST['submit_section'])) {
     $section_name=msubstr(trim($_POST['chapter_name']),0,50);
	 $outline=$_POST['outline'];
     $outline = stripslashes($outline);
	 $importance=msubstr($_POST['importance'],0,250);
	 $point=msubstr($_POST['point'],0,250);
	 $difficulty=msubstr($_POST['difficulty'],0,250);
	 
	 //把内容中远程的图片资源本地化
     $upload_child_dir = $cfg_img_root; //文章图片下载目录
     $outline = GetCurContent($outline);
	 
	 //去除内容中的站外链接
	 $outline = str_replace($cfg_base_url,'#basehost#',$outline);
	 $outline = preg_replace("/(<a[ \t\r\n]{1,}href=[\"']{0,}http:\/\/[^\/]([^>]*)>)|(<\/a>)/isU","",$outline);
     $outline = str_replace('#basehost#',$cfg_base_url,$outline);
	 $poster=$_SESSION['real_name'];
	 $post_time=date("y-m-d H:i:s");
	 $query="insert into ".$table_suffix."section (section_name, outline, point, difficulty, importance,chapter_id,poster, post_time)  values ('$section_name','$outline','$point','$difficulty','$importance',$chapter_id,'$poster','$post_time')";
	 $result=mysql_query($query);
	 if($result) ShowMsg("成功的添加新的小节","section_admin.php?chapter_id=".$chapter_id);
	 else ShowMsg("添加小节失败，可能有重名，请重来！",-1);
    } 
    else { 
?>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <form name="form1" method="post" action="">
    <td>
      <table width="100%" border="0">
    <tr>
    <td width="120"><div align="right">输入小节名称</div></td>
    <td width="20">&nbsp;</td>
    <td><input name="chapter_name" type="text" class="INPUT" id="chapter_name" style="width:500px;"></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">主要内容概述<br>HTML格式</div></td>
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
      <td valign="top"><div align="right">知识要点</div></td>
      <td>&nbsp;</td>
      <td><label>
        <textarea name="point" rows="3" class="TEXTAREA" id="point" style="width:500px;"></textarea>
      </label></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">本节重点</div></td>
      <td>&nbsp;</td>
      <td><textarea name="importance" rows="3" class="TEXTAREA" id="importance" style="width:500px;"></textarea></td>
    </tr>
    <tr>
      <td valign="top"><div align="right">本节难点</div></td>
      <td>&nbsp;</td>
      <td><textarea name="difficulty" rows="3" class="TEXTAREA" id="difficulty" style="width:500px;"></textarea></td>
    </tr>
    <tr>
      <td><div align="right">点击提交</div></td>
      <td>&nbsp;</td>
      <td><input name="submit_section" type="submit" class="inputbut" id="submit_section" value="提 交" />
        <input name="cancel" type="button" class="inputbut" id="cancel" value="不理返回" onclick="history.go(-1);"/></td>
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