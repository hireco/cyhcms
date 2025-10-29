<?php require_once("config/base_cfg.php");
       require_once("inc/hometown.php");
	   require_once("dbscripts/db_connect.php"); 
       require_once("inc/main_fun.php"); 
       require_once("inc/show_msg.php"); 
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
<?php  require_once("header.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD style="BORDER-RIGHT: #cccccc 1px solid" vAlign=top width=100><IMG 
      height=230 src="image/35.gif" width=94> </TD>
    <TD vAlign=top>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; 用户注册</TD>
        </TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR align=middle>
          <TD vAlign=top>
         <?php 
         if(isset($_POST['submit_regi'])) {         
           
           $user_name=trim($_POST['user_name']);
           $user_pass=quan2ban(trim($_POST['user_pass']));
           $email=quan2ban(trim($_POST['email']));
           $nick_name=trim($_POST['nick_name']);
           
		   if(empty($user_name)||empty($user_pass)||empty($nick_name))  ShowMsg("对不起,表单提交出错,请重试.","register.php");
		   else 
		   {
            $result=mysql_query("select * from ".$table_suffix."member where user_name='$user_name'");
            if(mysql_num_rows($result))  ShowMsg("对不起,该用户名已经被使用,请重试.","register.php"); 
			else{ 
			 $result=mysql_query("select * from ".$table_suffix."admin where admin_id='$user_name'");
             if(mysql_num_rows($result))  ShowMsg("对不起,该用户名已经被使用,请重试.","register.php");
             else {
			     $last_time=date("y-m-d H:i:s"); 
		         $result=mysql_query("insert into ".$table_suffix."member (user_name,user_pass,email,nick_name,login_times,last_ip,last_modify,last_time,register_time) values ('$user_name','$user_pass','$email','$nick_name',1,'$ip','$last_time','$last_time','$last_time')");
			     if($result) { 
				   session_register("user_id","user_name","user_pass","nick_name","last_ip","last_time","login_times","user_level");
				   $_SESSION['user_id']=@mysql_insert_id();
				   $_SESSION['user_name']=$user_name;
				   $_SESSION['user_pass']=$user_pass;
				   $_SESSION['nick_name']=$nick_name;
				   $_SESSION['last_ip']=$ip;
				   $_SESSION['last_time']=$last_time;
				   $_SESSION['login_times']=1;
				   $_SESSION['user_level']="1";
				   
				   
				   if(!isset($_REQUEST['to_go']))   ShowMsg("恭喜!,您已经成功注册为会员!","member.php");
				   else  ShowMsg("恭喜!,您已经成功注册为会员!",$_REQUEST['to_go']);
				   }
			     else ShowMsg("对不起,由于某种原因,您的注册失败,请重试.","register.php");
			  }
		    }
		 }
		} 
		 elseif(isset($_POST['agree_xy'])) { ?>   
		  <TABLE class=table cellSpacing=1 cellPadding=0 width="100%" 
            align=center>
              <TBODY>
              <TR vAlign=top>
                <FORM name=regform action="" method=post onSubmit="return checkAllTextValid(this);">
                <TD class=noticerr height=72>
                  <TABLE class=table height=30 cellSpacing=0 cellPadding=0 
                  width="100%" align=center 
                  background=image/detailtitle.gif border=0>
                    <TBODY>
                    <TR>
                      <TD align=middle width=10></TD>
                      <TD>基本资料</TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" 
border=0>
                          <TBODY>
                          <TR >
                            <TD align=right width=120>用 户 名: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_name class=input id="user_name" 
                              style="WIDTH: 150px" onChange="isRegisterUserName('user_name')"> 
                            <FONT 
                              class=mustfill>* </FONT>[5-20位,不可以有特殊字符] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>登录密码: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_pass type=password class=input id="user_pass" 
                              style="WIDTH: 150px" onChange="isPasswd('user_pass')"> 
                              <FONT class=mustfill>* </FONT>[6-20位英文或数字] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>重复密码: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_pass2 type=password class=input id="user_pass2"  onChange="chk_password()"
                              style="WIDTH: 150px"> 
                              <FONT class=mustfill>* </FONT>[6-20位英文或数字] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>电子邮件: </TD>
                            <TD style="COLOR: #666666"><INPUT class=input  onChange="chk_mail('email');"  id="email" size=35 name=email> <FONT class=mustfill>* 
                              </FONT>[请输入正确的电子邮件] 
                    </TD></TR>
                          <TR >
                            <TD align=right width=120>您的昵称: </TD>
                            <TD style="COLOR: #666666"><INPUT name=nick_name class=input id="nick_name" 
                              size=35>
                              <FONT class=mustfill>* </FONT>[请输入您在本站使用的昵称,例如&quot;青蛙王子&quot;] </TD>
                          </TR>
                          <TR >
                            <TD align=right>&nbsp;</TD>
                            <TD style="COLOR: #666666"><INPUT name=submit_regi type=submit class=button id="submit_regi" value=填完了,提交注册 onClick="return check_form();"></TD>
                          </TR>
                          </TBODY></TABLE></TD></TR></TBODY></TABLE>
                  
                  </TD>
                </FORM></TR></TBODY></TABLE>					
					
					<?php } else { ?>
					<TABLE height=300 cellSpacing=1 cellPadding=1 width="100%" 
            align=center border=0>
              <TBODY>
              <TR vAlign=top align=middle>
                <TD>
                  <TABLE class=table cellSpacing=1 cellPadding=4 width="100%" 
                  align=center>
                    <TBODY>
                    <TR>
                      <TD class=title align=middle height=25>用户注册协议</TD></TR>
                    <TR>
                      <TD class=con align=middle height=72>
					  <TEXTAREA class=textarea name=xy rows=16 readOnly cols=85>具体协议条款待加!</TEXTAREA> 
                      </TD></TR>
                    <TR>
                      <TD class=title align=middle height=27><form name="form1" method="post" action="">
					  <INPUT name=agree_xy type=submit class=button id="agree_xy"  value=同意以上协议，开始注册> 
                      <INPUT class=button onclick="window.location='./'" type=button value=不同意协议 name=Submit2>
                      </form> 
                      </TD>
                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
					
			  <?php } ?>
			  </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
<script>
function chk_password(){
if ((document.regform.user_pass.value=="")||(document.regform.user_pass.value!=document.regform.user_pass2.value ))
     {
        alert("密码输入不正确！");
		document.regform.user_pass.value="";
		document.regform.user_pass2.value="";
	    document.regform.user_pass.focus();
	    return false;
       }
else if((document.regform.user_pass.value.length<6)||(document.regform.user_pass.value.length>20))
     {
        alert("密码字符数不在6到20之间");
		document.regform.user_pass.value="";
		document.regform.user_pass2.value="";
	    document.regform.user_pass.focus();
	    return false;
       }
}
function check_form() {
  if(document.regform.user_name.value=="") { alert("请填写用户名!"); document.regform.user_name.focus(); return false ;}
  if(document.regform.user_pass.value=="") { alert("请填写密码!"); document.regform.user_pass.focus(); return false ;}  
  if(document.regform.user_pass2.value=="") { alert("请填写密码!"); document.regform.user_pass2.focus(); return false ;}
  if(document.regform.email.value=="") { alert("请填写邮件!"); document.regform.email.focus(); return false ;}
  if(document.regform.nick_name.value=="") { alert("请填写昵称!"); document.regform.nick_name.focus(); return false ;}
} 
</script>
