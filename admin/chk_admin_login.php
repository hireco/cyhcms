<?php session_start(); if(isset($_SESSION['root'])) { ?>
<html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<!-- InstanceBeginEditable name="doctitle" -->
<?php 
      require_once("setting.php"); 
      require_once(RROOT."/dbscripts/db_connect.php");     
?>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
--> 
</style></head>
 
<body>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="ͷ��" --><?php require_once(RROOT."/admin/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/bg_login.gif">
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="����" -->
         <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/foot_navi.jpg">
           <tr>
             <td width="10" height="30">&nbsp;</td>
             <td valign="bottom"><table height="20" border="0" align="left" cellpadding="0" cellspacing="0" background="image/b2.gif">
                 <tr align="center" valign="bottom">
                  <td width="69" height="20" background="image/b2.gif"><div align="center"><a href="admin_id_edit.php">�޸�����</a></div></td>
                  <td width="69" height="20" background="image/b2.gif"><div align="center"><a href="admin_id_list.php">�û�����</a></div></td>
                 <?php if($_SESSION['root']=="super_administrator") { ?><td width="69" background="image/b1.gif"><a href="chk_admin_login.php">��¼���</a></td>
                 <?php } ?>
                 </tr>
             </table></td>
           </tr>
         </table>
          <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/search_bar_bg.gif">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
		  <?php if($_SESSION['root']=="super_administrator") { 
		  if($_REQUEST['action']=="delete") {  
		   $query="select * from ".$table_suffix."admin_record order by id desc"; $result=@mysql_query($query);
		   if($result) $mini_id=@mysql_result($result,99,"id");
		   if($mini_id) {		
		   $query="delete from ".$table_suffix."admin_record where id<$mini_id";
		   $result=@mysql_query($query);
		   if(!$result) echo "DATABASE QUERY FAILED! PLEASE TRY AGAIN!";
		     }
		   }
		  ?>		  
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF">
			  <?php 
			     $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				 $per_page_num=20;
				 $query="select * from ".$table_suffix."admin_record order by id desc";
			     $rows=@mysql_query($query); 
				 if(!$rows) echo "ERROR! DATABASE QUERY CANNOT BE DONE!";
				 $num=@mysql_num_rows($rows);
				 $page=intval(($num-1)/$per_page_num)+1;
				 if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
				 $page_front=($page_id<=1)?1:($page_id-1); 
				 $page_behind=($page_id>=$page)?$page:($page_id+1); 
				 @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
			   ?>
			  <?php if($num) { ?>
              <table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#EFF7FF">
                <tr bgcolor="#CC9999">
                  <td  nowrap><div align="left" >���</div></td>
				  <td  nowrap><div align="left" >����</div></td>
                  <td  nowrap><div align="left" >�˺�</div></td>
                  <td  nowrap><div align="left" >��¼ʱ��</div></td>
                  <td  nowrap><div align="left" >��¼IP</div></td>
                </tr>
                <?php  
				for($i=1;$i<=$per_page_num;$i++)
				{
				if($row=@mysql_fetch_object($rows)){  ?>
				<tr> 
				  <td nowrap><div align=left><?=$row->id?></div></td>
                  <td nowrap bgcolor="#99CCFF"><div align=left> <?=$row->real_name?></div></td>
				  <td nowrap bgcolor="#CCFFFF"><div align=left> <?=$row->admin_id?></div></td>
				  <td nowrap><div align=left> <?=$row->login_time?></div></td>
				  <td nowrap bgcolor="#FFFFCC"><div align=left> <?php echo $row->login_ip;?> </div></td>
				  </tr> 
				  <?php
				   }
				}
				?>
              </table>
			  <?php } ?>
			  <?php if($num>100) { ?>
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20">&nbsp;</td>
                  <td>ע����Ҫ�����ʷ��¼��ֻ�������µ�100����¼����<a href="<?=$PHP_SELF?>?action=delete"><font color=red>����˴�</font></a></td>
                </tr>
              </table>
			  <?php } ?>
			  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><form name="form_page" style="margin:0px"  method="get" action="<?=$PHP_SELF?>">
                      <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D4BFAA">
                        <tr valign="middle">
                          <td nowrap><div align="center">���ҵ�<?php echo $num;?>����¼</div></td>
						  <?php if($num) { ?>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page_front; ?>">ǰһҳ</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page_behind; ?>">��һҳ</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo "1"; ?>">��һҳ</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page; ?>">���һҳ</a></div></td>
                          <td nowrap><div align="center">ȥ��<input name="page_id" type="text" id="page_id" size="4" onkeyup="value=value.replace(/[^\d]/g,'') " 
								onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" >ҳ</div></td>
                          <td nowrap><div align="center">��<?php echo $page_id;?>ҳ</div></td>
                          <td nowrap>��<?php echo $page; ?> ҳ</td>
						 <?php }?>
                        </tr>
                      </table>
                  </form></td>
                </tr>
              </table></td>
            </tr>
          </table>
		  <?php } else { ?>
		  
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFE7E7">�����ǳ�������Ա��û��Ȩ�޷��ʴ�ҳ��</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFF3EF"><a href="javascript:history.go(-1)">�������</a></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table>
		  <script> alert("�Բ�������Ȩ���ʴ�ҳ��");</script>
		  <?php } ?>
		 
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!-- InstanceBeginEditable name="�Ų�" --><?php require_once("scripts/footer.php");?><!-- InstanceEndEditable --></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php } else  require_once("login_wrong.php"); ?>


