<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="javascript" src="inc/form_check.js"></script>
<?php  if(isset($_SESSION['user_name'])) {  ?>
<table width=160 cellspacing=1 cellpadding=1 align=center>
  <tr> 
    <td  height=5 colspan="2" align=center></td>
  </tr>
 
    <tr> 
      <td  height=25 colspan="2" align=center > <div align="left"></div>        
      <div align="center"><a href="member.php" style="text-decoration:underline">��ӭ<?=$_SESSION['nick_name']?>��¼</a></div></td>
    </tr>
    <tr>
      <td height=25  align=center  ><div align="left">���ļ���:</div></td>
      <td height=25 ><?=$mem_level[$_SESSION['user_level']]?></td>
    </tr>
    <tr>
      <td height=25  align=center  ><div align="left">��ʷ��¼</div></td>
      <td height=25  align=center  ><div align="left"><a href="logout.php?to_go=<?php 
	   if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	   else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);	  
	  ?>" style="text-decoration:underline"><font color="#003333">ע����¼</font></a></div></td>
    </tr>
    <tr> 
      <td height=25  align=center  > <div align="left">��¼IPֵ:</div></td>
      <td height=25 ><?=$_SESSION['last_ip']?></td>
    </tr>
    <tr> 
      <td height=26 align="right"><div align="left">��¼ʱ��:</div></td>
      <td height=26 valign="top"><?=substr($_SESSION['last_time'],3,8)?></td>
    <tr>
      <td height=26 align="right"><div align="left">��¼����:</div></td>
      <td height=26 valign="top" nowrap><?=$_SESSION['login_times']?>��</td>    
</table>
<?php } else { ?>
<table width=160 cellspacing=1 cellpadding=1 align=center>
    <tr> 
      <td height=5 align="right" colspan="2"></td>
	</tr>
	<form name=loginform method=post action="login.php?to_go=<?php 
	if(!isset($_REQUEST['to_go']))   
	{
	  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	  else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);
	}
	else echo urlencode($_REQUEST['to_go']); ?>" onSubmit="return checkAllTextValid(this);">
    <tr> 
      <td  height=25 width=43% align=center > �û���:</td>
      <td height=25 width=57%> 
        <input type=text name=user_name  maxlength=20 class=input style="width:90px">
      </td>
    </tr>
    <tr> 
      <td height=25 width=43%  align=center  > �ܡ���:</td>
      <td height=25 width=57% > 
        <input type=password name=user_pass  style="width:90px" maxlength=20 class=input>
      </td>
    </tr>
    <tr> 
      <td height=5 align="right" colspan="2"></td>
	</tr>
    <tr>
      <td align="center"><span class="left"><a href="lostpass.php" style="text-decoration:underline;">��������</a></span></td>
      <td valign="top"><input name="imageField" type="image" src="image/denglu.gif" width="40" height="19" border="0" onClick="return chk_loginform();">
      <a href="register.php"><img src="image/zhuce.gif" width="40" height="19" border="0"></a></td>
    <tr> 
      <td height=30 colspan=2 align=center  class=left><input name="savelogin" type="checkbox" id="savelogin" value="1">        
        ��ѡ�Լ�ס��¼ <img src="image/mail.gif" width="14" height="13" border="0"></td>
      </tr>
  </form>
</table>
<script>
function chk_loginform() { 
  if(document.loginform.user_name.value=="") { alert("����д�û���!"); document.loginform.user_name.focus(); return false ;}
  if(document.loginform.user_pass.value=="") { alert("����д����!"); document.loginform.user_pass.focus(); return false ;}  
 }
</script>
<?php } ?>