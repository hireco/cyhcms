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
          <td height="5" colspan="9"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td>&nbsp;</td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">�鿴��Ϣ</div>
                </div></td>
                <td>&nbsp;</td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td valign="top"><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="inner_infor_add.php">������Ϣ</a></div>
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><div class="bigtext_b">
                  <div align="center"></div>
                </div></td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="inner_infor.php">�ѷ���Ϣ</a></div>
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td><div class="bigtext_b"><div align="center"></div></div></td>
        </tr>
    </table>      
    <div align="center">
      </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="50">
  <tr>
    <td><?php 
 $query="select * from ".$table_suffix."inner_infor where id={$_REQUEST['infor_id']}";
 $result=mysql_query($query);
 if(mysql_num_rows($result)) {
 $row=mysql_fetch_object($result);
 if($row->send_mode=="a") {
  $query="select user_id from ".$table_suffix."inner_record where infor_id={$_REQUEST['infor_id']}";
  $result=mysql_query($query);
  $num_of_user=@mysql_num_rows($result);
 } 
?>
      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="80"><div align="left">��Ϣ����</div></td>
        <td><div align="left"><?=$row->infor_title?></div></td>
      </tr>
      <tr>
        <td><div align="left">��������</div></td>
        <td><?=$row->post_time?>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="left">��������</div></td>
        <td><?php 
		  echo "<font color=red>";
		  echo $row->receiver_type=="s"?"��վ����":"��ͨ��Ա";
		  echo "</font>"; 
		  if($row->send_mode=="a") {
		   echo " ( "; 
		   $i=1;
		   while(($row_user=mysql_fetch_object($result))&&($i<=20)) { echo $row_user->user_id." ";  $i++; }
		   if($num_of_user>20) echo " ...��".$num_of_user."���� ";
		   echo ")";
		  }
		?>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="left">������ʽ</div></td>
        <td><?=$row->send_mode=="m"?"�ʼ���ʽ":"��������"?>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td>��Ϣ����</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td height="1" colspan="2"></td>
        </tr>
    </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td><?=$row->content?></td>
        </tr>
      </table>      <?php } else ShowMsg("û���ҵ���Ӧ����Ϣ",-1); ?></td>
  </tr>
</table>
</body>
</html>