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
    $id=$_REQUEST['id'];
	$query="select * from ".$table_suffix."section where id=$id and locked='0'";
	$result=mysql_query($query);
	
	if(!mysql_num_rows($result))  
	
	ShowMsg("�鿴���󣡲����ڵĶ���",-1);
    
	else {
	$row=mysql_fetch_object($result);
	$chapter_id=$row->chapter_id;
	$query="select * from ".$table_suffix."chapter where id=$chapter_id"; 
	$result=mysql_query($query);
	
	if(!mysql_num_rows($result)) ShowMsg("�����ڵ��ϼ��½�","chapter_admin.php");
    
	else {
	
	$chapter_name=mysql_result($result,0,"chapter_name");
	$part_name=mysql_result($result,0,"part_name"); 

    echo $part_name." > ".$chapter_name." > �鿴С��"; 
?>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF">
    <td width="120"><div align="right">С������</div></td>
    <td width="20">&nbsp;</td>
    <td><strong><?=$row->section_name?></strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td valign="top"><div align="right">��Ҫ���ݸ���</div></td>
      <td>&nbsp;</td>
      <td valign="top"><?=$row->outline?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td valign="top"><div align="right">֪ʶҪ��</div></td>
      <td>&nbsp;</td>
      <td><?=$row->point?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td valign="top"><div align="right">�����ص�</div></td>
      <td>&nbsp;</td>
      <td><?=$row->importance?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td valign="top"><div align="right">�����ѵ�</div></td>
      <td>&nbsp;</td>
      <td><?=$row->difficulty?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td><div align="right"></div></td>
      <td>&nbsp;</td>
      <td><a href="section_edit.php?id=<?=$row->id?>"></a>
        <table width="200" border="0">
          <tr>
            <td><div align="center"><a href="section_edit.php?id=<?=$row->id?>" style="text-decoration:underline; color:#000099;">�� ��</a></div></td>
            <td>&nbsp;</td>
            <td><div align="center">
              <input name="cancel" type="button" class="inputbut" id="cancel" value="��  ��" onclick="history.go(-1);"/>
            </div></td>
          </tr>
        </table></td>
    </tr>
   </table>
  </td>
  </tr>
</table>
<?php } 
 } 
?>
</body>
</html>