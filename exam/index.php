<?php session_start();?>
<?php require_once("../config/base_cfg.php");
       require_once("../dbscripts/db_connect.php"); 
       require_once("../inc/show_msg.php");
	   require_once("../inc/main_fun.php"); 
	   require_once("../".$cfg_admin_root."scripts/constant.php"); 
	   require_once("../inc/find_cookie.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�Բ�ϵͳ-<?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<script language="javascript" src="../inc/form_check.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
h1 
{ 
height:33px; 
line-height:33px; 
font-size:24px; 
color:#FFFFFF;
font-family:"����";
}
.inputBox {
	font-family: Verdana, PMingLiU;
	background-color:transparent;
	border:0px;
	border-bottom:1px solid #FFFFFF;
	color:#FFFFFF;
}
-->
</style>
</head>
<body>
<table width="100%" height="70"  border="0" cellpadding="0" cellspacing="0" bgcolor="#66A5E8">
  <tr>
    <td><table width="900" height="40" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><h1>��ӭ����<?=$cfg_site_name?>֮�Բ�ϵͳ</h1></td>
        <td><div align="right"><a href="../" style="text-decoration:underline; color:#FFFFFF;">��վ��ҳ</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="900" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<table border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#6CA8E7">
  <tr>
    <td><table width="900" height="600" border="0" align="center" cellpadding="10" cellspacing="0" background="image/bgimg.jpg">
        <tr>
          <td>
            <table width="300" height="150" border="0" align="center" cellpadding="20" cellspacing="1">
              <tr>
                <td>
                  <?php if(isset($_SESSION['user_name'])) { ?>
                  <table width="500" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                      <td><font color=white>
                        <?=$_SESSION['nick_name']?>���ã���ѡ��������Եķ�Χ</font></td>
                      <td><div align="right"><a href="test_record.php" style="text-decoration:underline; color:#FFFFFF;">����˴��鿴���Ĳ��Լ�¼</a></div></td>
                    </tr>
                  </table>
                  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0">
                    <form action="test.php" method="post" target="_self">
					<tr>
                      <td valign="top"><div align="center"><font color=white>ѡȡ��Χ</font></div></td>
                      <td valign="top" nowrap>
						  <?php 
						   $query="select distinct part_name from ".$table_suffix."chapter  order by id asc";
						   $result=mysql_query($query);
						   $i=1;
						   while($row=mysql_fetch_object($result)) {
						   if($i%4==0) echo "<br>";
						  ?>
						  <input type="checkbox" id="box<?=$i?>" name="part[]" value="<?=$row->part_name?>"><font color=white><?=$row->part_name?></font>
						  <?php 
						   $i++;
						  } ?>	<input name="select_all" type="button" class="INPUT" value="ȫ ѡ" onClick="sel_all();"></td>
                    </tr>
                    <tr>
                      <td><div align="center" style="color:#FFFFFF;">�����ʼ</div></td>
                      <td><input name="test_start" type="submit" class="INPUT" id="test_start" value="��ʼ����" onClick="return chk_if_select();">
                        <input type="hidden" name="server_time" value="<?=time()?>">
                        <input type="hidden" name="client_time">
						<script>
						var myDate = new Date();
						document.all.client_time.value=myDate.getTime()/1000;
						</script>
</td>
                    </tr>
                    <tr>
                      <td><div align="center" style="color:#FFFFFF;">����˳�</div></td>
                      <td><input name="withdraw" type="button" class="INPUT" id="withdraw" onClick="location='../logout.php'" value="�˳�ϵͳ"></td>
                    </tr>
					</form>
                  </table>
                  <?php } else { ?>
                  <table width="500" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                      <td><font color=white>
                      ���ã���ӭ���ԣ����ȵ�¼</font></td>
                    </tr>
                  </table>
                  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0">
                    <form name=loginform method=post action="../login.php?to_go=<?php 
					if(!isset($_REQUEST['to_go']))   
					{
					  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
					  else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);
					}
					else echo urlencode($_REQUEST['to_go']); ?>" onSubmit="return checkAllTextValid(this);">
                      <tr>
                        <td><div align="center" style="color:#FFFFFF; ">�û���</div></td>
                        <td><input name="user_name" type="text" id="user_name2"  class="inputBox" value=�����û��� onclick="if(this.value=='�����û���') this.value='';"></td>
                      </tr>
                      <tr>
                        <td><div align="center" style="color:#FFFFFF; ">��&nbsp;&nbsp;��</div></td>
                        <td><input name="user_pass" type="password" id="user_pass2" class="inputBox"></td>
                      </tr>
                      <tr>
                        <td colspan="2"><table border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input name="Submit" type="submit" class="INPUT" onClick="return chk_loginform();" value="��  ¼"></td>
                              <td width="20">&nbsp;</td>
                              <td><a href="../lostpass.php" style="text-decoration:underline; color:#FFFFFF; ">�������룿</a></td>
                            </tr>
                        </table></td>
                      </tr>
                    </form>
                  </table>
                  <?php } ?>
                </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td valign="bottom"><table width="100%" height="80"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><div align="center" style="color:#FFFFFF;">Powered by
                      <?=$cfg_site_name?>
                      <?=$cfg_copyright?>
                      <br>
                      ��վ��������
                      <?=$cfg_webmaster?>
              </div></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<script>
function chk_loginform() { 
  if((document.loginform.user_name.value=="")||(document.loginform.user_name.value=="�����û���")) { alert("����д�û���!"); document.loginform.user_name.focus(); return false ;}
  if(document.loginform.user_pass.value=="") { alert("����д����!"); document.loginform.user_pass.focus(); return false ;}  
 }
function chk_if_select() {
  var flag;
  var i=1;
  var box_i="box"+i;
  while(obj=document.getElementById(box_i)){
  if(obj.checked) { flag=1; break;} 
  i++;
  box_i="box"+i;
  }
  if(flag==1) return true;
  else { alert("��ѡ����Է�Χ��"); return false;}
 }

function sel_all()
{
	var sel_arc = document.all.select_all;
	i=1;
	box_i="box1";
  if(sel_arc.value=="ȫ ѡ"){
	while(obj=document.getElementById(box_i)){
     obj.checked=true;
     i++;
     box_i="box"+i;
    }
	 sel_arc.value="ȡ ��"; 
	 }
  else {
	while(obj=document.getElementById(box_i)){
     obj.checked=false;
     i++;
     box_i="box"+i;
    }
	 sel_arc.value="ȫ ѡ"; 
	 }
}
</script>
</body>
</html>