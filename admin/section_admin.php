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
<script>
function really() {
 result="�ö��󽫱�ɾ��,ȷ����";   
       if   (confirm(result))    return true; 
       else return false;
}
function no_show(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
</script>
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
if(isset($_REQUEST['action'])) {
 if($_REQUEST['action']=="delete"){
     $id=$_REQUEST['id'];
	 $query1="select id from ".$table_suffix."test where section_id=$id";
	 $result1=mysql_query($query1);
	 $query2="select id from ".$table_suffix."ask where section_id=$id";
	 $result2=mysql_query($query2);
	 $num_of_content=mysql_num_rows($result1)+mysql_num_rows($result2);
	 if($num_of_content) $showmsg="�ý�����Ӧ���ݣ�����պ�ſ�ɾ����";
	 else {
	 $query="delete  from ".$table_suffix."section where id=$id and locked='0'" ;
	 $result=mysql_query($query);
	 if(mysql_affected_rows()) $showmsg="�ɹ�ɾ����С��";
	 else          $showmsg="ɾ��ʧ�ܣ����ܶ���������������";
    }
  }

elseif($_REQUEST['action']=="lock"){
     if($_SESSION['root']<>"super_administrator") $showmsg="�Բ�����û��Ȩ�ޣ�";
	 else {
	 $id=$_REQUEST['id'];
	 $query="update  ".$table_suffix."section set locked = IFNULL(locked=0,0 ) where id=$id";
	 $result=mysql_query($query);
	 if($result) $showmsg="�ɹ��ı�����״̬";
	 else        $showmsg="����ʧ�ܣ�������";
    }
  }

elseif($_REQUEST['action']=="check"){
     $id=$_REQUEST['id'];
	 $query="update  ".$table_suffix."section set checked = IFNULL(checked=0,0 ) where id=$id";
	 $result=mysql_query($query);
	 if($result) $showmsg="�ɹ��ı����״̬";
	 else        $showmsg="����ʧ�ܣ�������";
  }
  
elseif($_REQUEST['action']=="top"){
     $id=$_REQUEST['id'];
	 $top_time=date("y-m-d H:i:s");
	 $query="update  ".$table_suffix."section set top_time = '$top_time' where id=$id";
	 $result=mysql_query($query);
	 if($result) $showmsg="�ɹ��ö���С��";
	 else        $showmsg="����ʧ�ܣ�������";
  }
   echo "<script>window.parent.alert(\"".$showmsg."\");</script>";
   if(($result)&&(mysql_affected_rows())) echo "<script>parent.location.reload()</script>";
   exit;
}
    
	$chapter_id=$_REQUEST['chapter_id'];
	$query="select * from ".$table_suffix."chapter where id=$chapter_id"; 
	$result=mysql_query($query);
	
	if(!mysql_num_rows($result)) ShowMsg("�����ڵ��½�","chapter_admin.php");
    
	else {
	
	$chapter_name=mysql_result($result,0,"chapter_name");
	$part_name=mysql_result($result,0,"part_name"); 

    echo $part_name." > ".$chapter_name." > С���б�";
   
   $query="select * from ".$table_suffix."section where chapter_id=$chapter_id order by  top_time desc";
   
   $per_page_num=isset($_REQUEST['per_page_num'])?$_REQUEST['per_page_num']:15;
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
?>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td bgcolor="#FFFFFF"><div align="center">С��ID</div></td>
        <td bgcolor="#FFFFFF">С������</td>		
        <td bgcolor="#FFFFFF">�����½�</td>
        <td bgcolor="#FFFFFF"><div align="center">����</div></td>
		<td bgcolor="#FFFFFF">�༭��ʷ</td>
        </tr>
      <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
	   ?>
	   <tr>
        <td bgcolor="#FFFFFF"><div align="center"><?=$row->id?></div></td>
        <td bgcolor="#FFFFFF"><strong><?=$row->section_name?></strong></td>
        <td bgcolor="#FFFFFF"><?=$chapter_name?></td>
        <td bgcolor="#FFFFFF"><div align="center"><a href="#" onClick="if(really()) no_show('?action=delete&id=<?=$row->id?>')">ɾ��</a> | <a href="#" onClick="no_show('?action=top&id=<?=$row->id?>')">�ö�</a> | <a href="section_edit.php?id=<?=$row->id?>">�޸�</a> | <a href="section_view.php?id=<?=$row->id?>">���</a> | <a href="#" onClick="no_show('?action=lock&id=<?=$row->id?>')"><?php echo $row->locked=="1"?"<font color=red>����</font>":"����";?></a> | <a href="#" onClick="no_show('?action=check&id=<?=$row->id?>')"><?php echo $row->checked=="1"?"<font color=red>����</font>":"���";?></a></div></td>
        <td bgcolor="#FFFFFF">��������<?=$row->poster?>�������£�<?php echo $row->last_editor==""?"δ����":$row->last_editor; ?>��</td>
		</tr>
      <?php } 
	     }
	   ?>
    </table>
      <br>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td width="200"><a href="section_add.php?chapter_id=<?=$_REQUEST['chapter_id']?>" style="text-decoration:underline;color:#000099;">�����µ�С��</a></td>
          <td><a href="section_add.php?chapter_id=<?=$_REQUEST['chapter_id']?>">
            <input name="cancel" type="button" class="inputbut" id="cancel" value="��  ��" onclick="history.go(-1);"/>
          </a></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td width="50%"><div align="right">��<?=$page_id?>ҳ/��<?=$page?>ҳ(<?=$num?>����¼)</div></td>
    <td><div align="center">
      <table border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php require_once("function/page_divide.php"); ?></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
<?php 
   }
?>
</body>
</html>