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
    $id=$_REQUEST['id'];
	$query="select * from ".$table_suffix."chapter where id=$id and locked='0'";
	$result=mysql_query($query);
	
	if(!mysql_num_rows($result))  
	
	ShowMsg("不存在的编辑对象或者对象被锁定","chapter_admin.php");
     
	else {  
	if(isset($_POST['submit_chapter'])) {
    $chapter_name=msubstr(trim($_POST['chapter_name']),0,40);
	$part_name=msubstr(trim($_POST['part_name']),0,20);
     
	$query="update ".$table_suffix."chapter set chapter_name='$chapter_name', part_name='$part_name' where id=$id";
	$result=mysql_query($query);
	if($result) ShowMsg("成功更新章节","chapter_admin.php");
	else ShowMsg("更新章节失败，可能有重名，请重来！",-1);
   } 
   
   else { 
   
   $row=mysql_fetch_object($result);
?>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <form name="form1" method="post" action="">
    <td>
      <table width="100%" border="0">
    <tr>
    <td width="120"><div align="right">输入章节名称</div></td>
    <td width="20">&nbsp;</td>
    <td><input name="chapter_name" type="text" id="chapter_name" style="width:400px;" value="<?=$row->chapter_name?>"></td>
    </tr>
    <tr>
      <td><div align="right">章节所属课程</div></td>
      <td>&nbsp;</td>
      <td><label>      
	  <select name="part_select" id="part_select" onchange="set_part_name();">
       <?php 
	    $query1="select distinct part_name from ".$table_suffix."chapter"; 
	    $result1=mysql_query($query1);
		while($row1=mysql_fetch_object($result1)) 
	    echo "<option value=\"".$row1->part_name."\">".$row1->part_name."</option>";
       ?>
	  </select>
      </label>
        <input name="part_name" type="text" id="part_name" style="width:200px;" value="<?=$row->part_name?>">
        说明：章节所属课程 </p>
        </td>
    </tr>
    <tr>
      <td><div align="right">点击提交</div></td>
      <td>&nbsp;</td>
      <td><input name="submit_chapter" type="submit" class="inputbut" id="submit_chapter" value="提 交" />
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
<script>
function set_part_name() {
  document.form1.part_name.value=document.form1.part_select.value;
  return;
}
</script>