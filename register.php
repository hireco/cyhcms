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
          <TD class=nav>�����ڵ�λ��:<a href="./"> ��ҳ</a> &gt; �û�ע��</TD>
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
           
		   if(empty($user_name)||empty($user_pass)||empty($nick_name))  ShowMsg("�Բ���,���ύ����,������.","register.php");
		   else 
		   {
            $result=mysql_query("select * from ".$table_suffix."member where user_name='$user_name'");
            if(mysql_num_rows($result))  ShowMsg("�Բ���,���û����Ѿ���ʹ��,������.","register.php"); 
			else{ 
			 $result=mysql_query("select * from ".$table_suffix."admin where admin_id='$user_name'");
             if(mysql_num_rows($result))  ShowMsg("�Բ���,���û����Ѿ���ʹ��,������.","register.php");
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
				   
				   
				   if(!isset($_REQUEST['to_go']))   ShowMsg("��ϲ!,���Ѿ��ɹ�ע��Ϊ��Ա!","member.php");
				   else  ShowMsg("��ϲ!,���Ѿ��ɹ�ע��Ϊ��Ա!",$_REQUEST['to_go']);
				   }
			     else ShowMsg("�Բ���,����ĳ��ԭ��,����ע��ʧ��,������.","register.php");
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
                      <TD>��������</TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" 
border=0>
                          <TBODY>
                          <TR >
                            <TD align=right width=120>�� �� ��: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_name class=input id="user_name" 
                              style="WIDTH: 150px" onChange="isRegisterUserName('user_name')"> 
                            <FONT 
                              class=mustfill>* </FONT>[5-20λ,�������������ַ�] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>��¼����: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_pass type=password class=input id="user_pass" 
                              style="WIDTH: 150px" onChange="isPasswd('user_pass')"> 
                              <FONT class=mustfill>* </FONT>[6-20λӢ�Ļ�����] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>�ظ�����: </TD>
                            <TD style="COLOR: #666666"><INPUT name=user_pass2 type=password class=input id="user_pass2"  onChange="chk_password()"
                              style="WIDTH: 150px"> 
                              <FONT class=mustfill>* </FONT>[6-20λӢ�Ļ�����] </TD>
                          </TR>
                          <TR >
                            <TD align=right width=120>�����ʼ�: </TD>
                            <TD style="COLOR: #666666"><INPUT class=input  onChange="chk_mail('email');"  id="email" size=35 name=email> <FONT class=mustfill>* 
                              </FONT>[��������ȷ�ĵ����ʼ�] 
                    </TD></TR>
                          <TR >
                            <TD align=right width=120>�����ǳ�: </TD>
                            <TD style="COLOR: #666666"><INPUT name=nick_name class=input id="nick_name" 
                              size=35>
                              <FONT class=mustfill>* </FONT>[���������ڱ�վʹ�õ��ǳ�,����&quot;��������&quot;] </TD>
                          </TR>
                          <TR >
                            <TD align=right>&nbsp;</TD>
                            <TD style="COLOR: #666666"><INPUT name=submit_regi type=submit class=button id="submit_regi" value=������,�ύע�� onClick="return check_form();"></TD>
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
                      <TD class=title align=middle height=25>�û�ע��Э��</TD></TR>
                    <TR>
                      <TD class=con align=middle height=72>
					  <TEXTAREA class=textarea name=xy rows=16 readOnly cols=85>����Э���������!</TEXTAREA> 
                      </TD></TR>
                    <TR>
                      <TD class=title align=middle height=27><form name="form1" method="post" action="">
					  <INPUT name=agree_xy type=submit class=button id="agree_xy"  value=ͬ������Э�飬��ʼע��> 
                      <INPUT class=button onclick="window.location='./'" type=button value=��ͬ��Э�� name=Submit2>
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
        alert("�������벻��ȷ��");
		document.regform.user_pass.value="";
		document.regform.user_pass2.value="";
	    document.regform.user_pass.focus();
	    return false;
       }
else if((document.regform.user_pass.value.length<6)||(document.regform.user_pass.value.length>20))
     {
        alert("�����ַ�������6��20֮��");
		document.regform.user_pass.value="";
		document.regform.user_pass2.value="";
	    document.regform.user_pass.focus();
	    return false;
       }
}
function check_form() {
  if(document.regform.user_name.value=="") { alert("����д�û���!"); document.regform.user_name.focus(); return false ;}
  if(document.regform.user_pass.value=="") { alert("����д����!"); document.regform.user_pass.focus(); return false ;}  
  if(document.regform.user_pass2.value=="") { alert("����д����!"); document.regform.user_pass2.focus(); return false ;}
  if(document.regform.email.value=="") { alert("����д�ʼ�!"); document.regform.email.focus(); return false ;}
  if(document.regform.nick_name.value=="") { alert("����д�ǳ�!"); document.regform.nick_name.focus(); return false ;}
} 
</script>
