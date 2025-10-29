<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
</head>
<body>
<?php  require_once("center_header.php"); 
if(isset($_SESSION['user_name'])) { ?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width=181 height=186 valign="top" background=image/leftbg.gif><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>用户功能菜单</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <? require_once("inc/tree_menu.php");?>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 修改密码</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top height=300>
 <br><br>
 <?php 
      if(isset($_POST['submit_s'])) {
	  $user_name=$_SESSION['user_name'];
	  $old_password=quan2ban(trim($_POST['old_password']));
	  $password=quan2ban(trim($_POST['password']));
      $result=mysql_query("select * from ".$table_suffix."member where user_name='$user_name' and user_pass='$old_password'");
	  if(!mysql_num_rows($result)) ShowMsg("错误的用户名和密码!",-1); 
	  else { 
	   $result=mysql_query("update ".$table_suffix."member set user_pass='$password' where user_name='$user_name' and user_pass='$old_password'");
	    if($result) { 
	       $_SESSION['user_pass']=$password;
		   ShowMsg("恭喜您,成功的更改密码!","member.php"); 
		  }
	    else   ShowMsg("修改密码失败,请重来!",-1); 
	   }
      } 
   else 
    { ?>
<table width="300" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#CCCCCC">
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF">
            <table width="300" height="100%"  border="0" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
              <tr>
                <td valign="middle" bgcolor="#FFFFFF"><form  onSubmit="return checkAllTextValid(this);" style="margin:0px"  action=""  method="post" name="form" id="form">
                    <table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><span class="style1">修改密码</span></td>
                      </tr>
                    </table>
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" nowrap>请输入旧密码
                            <input name="old_password" type="password" id="old_password" size="20" class=input></td>
                      </tr>
                      <tr>
                        <td align="center" nowrap>请输入新密码
                            <input name="password" type="password" id="password" size="20" class=input onChange="isPasswd('password')"></td>
                      </tr>
                      <tr>
                        <td align="center" nowrap>请确人新密码
                            <input name="password2" type="password" id="password2" size="20" class=input></td>
                      </tr>
                    </table>
                    <table width="100%"  border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td align="center"><input name="submit_s" type="submit" class=button  id="submit_s" value="确  定" onclick="return chk_password();"></td>
                        <td align="center"><div align="left">
                          <input name="submit" type="reset" id="submit" class=button  value="重  填">
                        </div></td>
                      </tr>
                    </table>
                </form></td>
              </tr>
            </table>
            </td>
      </tr>
    </table>
	<?php }	 ?>
</TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php"); 
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>
<script>
 function chk_password(){
if(document.form.old_password.value=="")
   { alert("请输入旧密码！");
     document.form.old_password.value="";
	 document.form.old_password.focus();
	 return false;
	} 
if ((document.form.password.value=="")||(document.form.password.value!=document.form.password2.value ))
     {
        alert("新密码输入不正确！");
		document.form.password.value="";
		document.form.password2.value="";
	    document.form.password.focus();
	    return false;
       }
else if((document.form.password.value.length<6)||(document.form.password.value.length>12))
     {
        alert("密码字符数不在6到12之间");
		document.form.password.value="";
		document.form.password2.value="";
	    document.form.password.focus();
	    return false;
       }
}
 </script>
