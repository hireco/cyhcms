<?php 
   require_once("setting.php");
   require_once("inc.php");    
?>
<html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<!-- InstanceBeginEditable name="doctitle" -->
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
                  <td width="69" height="20" background="image/b1.gif"><div align="center"><a href="admin_id_list.php">�û�����</a></div></td>
                 <?php if($_SESSION['root']=="super_administrator") { ?><td width="69" background="image/b2.gif"><a href="chk_admin_login.php">��¼���</a></td>
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
		      if(isset($_REQUEST['de_all'])) {
					 $delete_id=explode(",", $_REQUEST['select_list']);
					 while($temp=each($delete_id)) { 
					 $temp2=$temp["value"];
					 if($temp2<>$_SESSION['admin_valid']) {
					 $query="delete from ".$table_suffix."admin where admin_id='$temp2'"; 
					 $result=@mysql_query($query);
					 if(!$result)  { echo "failed to write the database"; return false; }
					 }
					  }
					 echo "<script>parent.location.reload()</script>";
					} 
					elseif(isset($_REQUEST['delete_id'])) { 
				    $delete_id=$_REQUEST['delete_id'];
					$query="delete from ".$table_suffix."admin where admin_id='$delete_id'";
					$result=@mysql_query($query);
					if(!$result)  { echo "failed to write the database"; return false; }
					echo "<script>parent.location.reload()</script>";
					 } 
		  ?>
		  
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF">
			  <?php 
			     $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				 $per_page_num=10;
				 $query="select * from ".$table_suffix."admin order by register_time asc";
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
                  <td  nowrap><div align="left" >ѡ��</div></td>
				  <td  nowrap><div align="left" >����</div></td>
                  <td  nowrap><div align="left" >�˺�</div></td>
				  <td  nowrap><div align="left" >����</div></td>
                  <td colspan="2"  nowrap><div align="center">��ϵ��ʽ
                    </div></td>
				  <td  nowrap><div align="left" >ע������</div></td>
                  <td  nowrap><div align="left" >�Ƿ���Ч</div></td>
				  <td  nowrap><div align="left" >Ȩ�޼���</div></td>
                  <td  nowrap><div align="left" >�༭</div></td>
				  <td  nowrap><div align="left" >ɾ��</div></td>
                </tr>
                <?php  
				for($i=1;$i<=$per_page_num;$i++)
				{
				if($row=@mysql_fetch_object($rows)){ ?>
				<tr valign="top"> 
				  <td rowspan="2" nowrap><div align=left><input type="checkbox" name="checkbox" value="<?=$row->admin_id?>"></div></td>
                  <td rowspan="2" nowrap bgcolor="#99CCFF"><div align=left> <?=$row->real_name?></div></td>
				  <td rowspan="2" nowrap bgcolor="#CCFFFF"><div align=left> <?=$row->admin_id?></div></td>
				  <td rowspan="2" nowrap bgcolor="#FFFFCC"><div align=left> <?=$row->writer_name?> </div></td>
				  <td nowrap bgcolor="#F9D7E4"><div align=left>�绰:
                      <?=$row->telephone<>""?$row->telephone:"δ��"?>
</div></td>
				  <td nowrap bgcolor="#F9D7E4">QQ��:
				    <?=$row->qq<>0?$row->qq:"δ��"?></td>
				  <td rowspan="2" nowrap bgcolor="#FFFFCC"><div align=left> <?=$row->register_time?> </div></td>
				  <td rowspan="2" nowrap bgcolor="#FFCC99"><div align=left> <?php if($row->life >= "1") echo "����Ч"; else echo "��ע��";?></div></td>
				  <td rowspan="2" nowrap bgcolor="#EFF7FF"><div align=left> <?php echo $row->admin_level=="9"?"<font color=blue>��������Ա</font>":"<font color=red>��ͨ����Ա</font>"; ?></div></td>
				  <td rowspan="2" nowrap bgcolor="#CCFF66"><div align=left> <?php if($_SESSION['admin_valid']<>$row->admin_id) { echo "<a href=\"javascript: opendwin('admin_id_admin.php?edit_id=$row->admin_id')\">"; echo "�༭</a>"; }  else echo "��ֹ"; ?></div></td>
				  <td rowspan="2" nowrap bgcolor="#FFFFFF"><div align=left> <?php if($_SESSION['admin_valid']<>$row->admin_id) echo "<input name=\"delete_$i\" type=\"button\" id=\"delete\" value=\"ɾ��\" onclick=\"if(really())  window.open('$PHP_SELF?delete_id=$row->admin_id','hide_frame','width=10,height=10')\">";
				  else echo "��ֹ" ?> </div></td>
                  </tr>
				<tr>
				  <td nowrap bgcolor="#F9D7E4">�ֻ�:				    <?=$row->cellphone<>""?$row->cellphone:"δ��"?></td>
				  <td nowrap bgcolor="#F9D7E4">MSN:				    <?=$row->msn<>""?$row->msn:"δ��"?></td>
				</tr> 
				  <?php
				   }
				}
				?>
              </table>
			  <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td><div align="center">
                    <a href="javascript: opendwin('admin_id_admin.php?add=1')"> �����˺�</a></div></td>
                  <td><div align="center">
                      <input type="reset" name="se_all" value="ȫ��ѡ��" onclick="return select_all();">
                  </div></td>
                  <td>&nbsp;</td>
                  <td><input name="de_all" type="button" id="de_all" value="ɾ����ѡ" onclick="if(really()) no_show('admin_id_list.php','de_all');"></td>
                  <td>
                    <div align="left"> </div>
                    <div align="center">
                      <input name="select_list" type="hidden">
                    </div>
                    <div align="left"> </div>
                    <div align="center"></div></td>
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
                          <td nowrap>��<?php echo $page; ?>ҳ</td>
                          <?php } ?>
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
		 <div id="bodyframe" style="VISIBILITY: hidden">
        <IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
		 </div>
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
<script language="JavaScript">
function opendwin(url){ window.open(url,"","height=500,width=820,resizable=no,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
</script>
<script language="JavaScript">
function select_all() {
   if(document.all.se_all.value=="ȫ��ѡ��")
   { var i; 
     if(document.all.checkbox.length>=2){
     for(i=0;i<document.all.checkbox.length;i++)
     document.all.checkbox[i].checked=true;}
     else document.all.checkbox.checked=true; 
	 document.all.se_all.value="ȡ��ȫѡ";  document.all.se_all.type="reset"; 
   }
   else 
   { var i;
     if(document.all.checkbox.length>=2){
	 for(i=0;i<document.all.checkbox.length;i++)
     document.all.checkbox[i].checked=false; }
     else document.all.checkbox.checked=false;
	 document.all.se_all.value="ȫ��ѡ��"; document.all.se_all.type="button"; 
   }
   return false;
   }
function  get_select_list() {
  var i=0,  abbr=document.all.checkbox, abbr2=document.all.select_list;
  if(abbr.length>=2) {
  for(i=0;i<abbr.length;i++) if(abbr[i].checked) 
  if(i==0) abbr2.value=abbr[i].value; 
  else abbr2.value=abbr2.value+","+abbr[i].value;
  }
  else abbr2.value=abbr.value;
  return abbr2.value;
}
function no_show(url,type){ 
 url_all=url+"?"+type+"=yes&select_list="+get_select_list();
 window.open(url_all,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
function really() {
      result="��ɾ��ȫ����֮��ص�����,ȷ����";   
       if   (confirm(result))    return true; 
       else return false;
}
</script>


