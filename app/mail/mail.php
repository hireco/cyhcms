<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
    require_once(dirname(__FILE__)."/smtp.class.php");
    require_once(dirname(__FILE__)."/../config/mail_cfg.php");
	if((!isset($_POST['mail_password']))||($_POST['mail_password']=="")) {
	 $SMTPServer			=	$cfg_mail_server;    //����smtp�������ĵ�ַ			
     $SMTPServerUserName	=	$cfg_mail_account;	//����¼smtp���������û���				
     $SMTPServerPassword	=	$cfg_mail_password;  //����¼smtp������������				 
     $MailFrom			    =	$cfg_mail_reply; 
	}
	else {
	$SMTPServer			=	trim($_POST['mail_server']);    //����smtp�������ĵ�ַ			
    $SMTPServerUserName	=	trim($_POST['mail_account']);	//����¼smtp���������û���				
    $SMTPServerPassword	=	trim($_POST['mail_password']);  //����¼smtp������������				 
    $MailFrom			=	trim($_POST['reply_address']);  
	}
	$smtpport = 25; //smtp�������Ķ˿ڣ�һ���� 25 
	$mailtype = "HTML"; //�ʼ������ͣ���ѡֵ�� TXT �� HTML ,TXT ��ʾ�Ǵ��ı����ʼ�,HTML ��ʾ�� html��ʽ���ʼ�
	$smtp  =   new smtp($SMTPServer,$smtpport,true,$SMTPServerUserName,$SMTPServerPassword,$MailFrom); 
?>