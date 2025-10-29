<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
    require_once(dirname(__FILE__)."/smtp.class.php");
    require_once(dirname(__FILE__)."/../config/mail_cfg.php");
	if((!isset($_POST['mail_password']))||($_POST['mail_password']=="")) {
	 $SMTPServer			=	$cfg_mail_server;    //您的smtp服务器的地址			
     $SMTPServerUserName	=	$cfg_mail_account;	//您登录smtp服务器的用户名				
     $SMTPServerPassword	=	$cfg_mail_password;  //您登录smtp服务器的密码				 
     $MailFrom			    =	$cfg_mail_reply; 
	}
	else {
	$SMTPServer			=	trim($_POST['mail_server']);    //您的smtp服务器的地址			
    $SMTPServerUserName	=	trim($_POST['mail_account']);	//您登录smtp服务器的用户名				
    $SMTPServerPassword	=	trim($_POST['mail_password']);  //您登录smtp服务器的密码				 
    $MailFrom			=	trim($_POST['reply_address']);  
	}
	$smtpport = 25; //smtp服务器的端口，一般是 25 
	$mailtype = "HTML"; //邮件的类型，可选值是 TXT 或 HTML ,TXT 表示是纯文本的邮件,HTML 表示是 html格式的邮件
	$smtp  =   new smtp($SMTPServer,$smtpport,true,$SMTPServerUserName,$SMTPServerPassword,$MailFrom); 
?>