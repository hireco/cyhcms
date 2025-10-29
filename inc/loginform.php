<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="javascript" src="inc/form_check.js"></script>
<?php  if(isset($_SESSION['user_name'])) {  ?>
<table width=160 cellspacing=1 cellpadding=1 align=center>
  <tr> 
    <td  height=5 colspan="2" align=center></td>
  </tr>
 
    <tr> 
      <td  height=25 colspan="2" align=center > <div align="left"></div>        
      <div align="center"><a href="member.php" style="text-decoration:underline">欢迎<?=$_SESSION['nick_name']?>登录</a></div></td>
    </tr>
    <tr>
      <td height=25  align=center  ><div align="left">您的级别:</div></td>
      <td height=25 ><?=$mem_level[$_SESSION['user_level']]?></td>
    </tr>
    <tr>
      <td height=25  align=center  ><div align="left">历史记录</div></td>
      <td height=25  align=center  ><div align="left"><a href="logout.php?to_go=<?php 
	   if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	   else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);	  
	  ?>" style="text-decoration:underline"><font color="#003333">注销登录</font></a></div></td>
    </tr>
    <tr> 
      <td height=25  align=center  > <div align="left">登录IP值:</div></td>
      <td height=25 ><?=$_SESSION['last_ip']?></td>
    </tr>
    <tr> 
      <td height=26 align="right"><div align="left">登录时间:</div></td>
      <td height=26 valign="top"><?=substr($_SESSION['last_time'],3,8)?></td>
    <tr>
      <td height=26 align="right"><div align="left">登录次数:</div></td>
      <td height=26 valign="top" nowrap><?=$_SESSION['login_times']?>次</td>    
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
      <td  height=25 width=43% align=center > 用户名:</td>
      <td height=25 width=57%> 
        <input type=text name=user_name  maxlength=20 class=input style="width:90px">
      </td>
    </tr>
    <tr> 
      <td height=25 width=43%  align=center  > 密　码:</td>
      <td height=25 width=57% > 
        <input type=password name=user_pass  style="width:90px" maxlength=20 class=input>
      </td>
    </tr>
    <tr> 
      <td height=5 align="right" colspan="2"></td>
	</tr>
    <tr>
      <td align="center"><span class="left"><a href="lostpass.php" style="text-decoration:underline;">忘记密码</a></span></td>
      <td valign="top"><input name="imageField" type="image" src="image/denglu.gif" width="40" height="19" border="0" onClick="return chk_loginform();">
      <a href="register.php"><img src="image/zhuce.gif" width="40" height="19" border="0"></a></td>
    <tr> 
      <td height=30 colspan=2 align=center  class=left><input name="savelogin" type="checkbox" id="savelogin" value="1">        
        勾选以记住登录 <img src="image/mail.gif" width="14" height="13" border="0"></td>
      </tr>
  </form>
</table>
<script>
function chk_loginform() { 
  if(document.loginform.user_name.value=="") { alert("请填写用户名!"); document.loginform.user_name.focus(); return false ;}
  if(document.loginform.user_pass.value=="") { alert("请填写密码!"); document.loginform.user_pass.focus(); return false ;}  
 }
</script>
<?php } ?>