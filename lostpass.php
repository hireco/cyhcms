<?php require_once("config/base_cfg.php");
       require_once("inc/hometown.php");
       require_once("dbscripts/db_connect.php"); 
       require_once("inc/main_fun.php"); 
       require_once("inc/show_msg.php"); 
	   require_once($cfg_admin_root."scripts/constant.php");
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
          <TD class=nav>�����ڵ�λ��:<a href="./"> ��ҳ</a> &gt; �һ����� </TD>
        </TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR align=middle>
          <TD vAlign=top>
         <?php 
         if(isset($_POST['find_sub'])) {        
           $user_name=trim($_POST['user_name']);
		   $result=mysql_query("select * from ".$table_suffix."member  where user_name='{$user_name}'");
		   if($row=@mysql_fetch_object($result)) {
            if($_POST['way']=="m") {
			  require_once(dirname(__FILE__)."/mail/mail.php");
			  $MailtoAddress	=	$row->email;		
              $Subject			=	"�һ�����-����".$cfg_site_name;	
              $MailBody         =   "<html>\r\n<head>\r\n<title>�һ�����</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
		      $MailBody        .=   "<base target='_self'/>\r\n</head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
		      $MailBody        .=   "</script>\r\n</center><div align='center' style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>�һ�����</div>";
			  $MailBody        .=   "<div align='left' style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3; padding-left:10px;'><br/>";
			  $MailBody		   .=	$row->user_name.", ����! <br><br><div style='padding-left:30px;'>����������: ".$row->user_pass." �뱣�ܺ�!";
			  $MailBody        .=   "<br><br>����".$cfg_site_name."<br>��ַ: <a href=\"".$cfg_mainsite."\" style=\"text-decoration:underline;\">".$cfg_mainsite."</a><br> ʱ��: <font color=gray>".date("y-m-d H:i:s")."</font>";
			  $MailBody        .=   "<br><br>��Ϊϵͳ�Զ�����,�벻Ҫ�ظ����ʼ�!</div><br><br></div>";	
			  $MailBody        .=   "</body>\r\n</html>";	
              $result=$smtp->sendmail($MailtoAddress,$MailFrom,$Subject,$MailBody,$mailtype); 
			  if($result)  ShowMsg("��ϲ�����������Ѿ����͵����������У�","./");
			  else  ShowMsg("�Բ�����������,<br>�����Ȼ�����һ�,����������������,����ϵվ��","./");
		    }
			elseif($_POST['way']=="q"){ 
			   if(($row->question==$_POST['question'])&&($row->answer==trim($_POST['answer'])))
			     ShowMsg("��������Ϊ��<font color=gray>{$row->user_pass}</font><br><br>�뱣�ܺ���������^-^","./");
			   else ShowMsg("�Բ��������Ǳ�վ��ע���û�","./");
			   }
			else  ShowMsg("�Բ�����ѡ���ѯ��ʽ","./");
			}
		   else ShowMsg("�Բ��������Ǳ�վ��ע���û�","./");
		  }
		  else { ?>
<TABLE cellSpacing=1 cellPadding=1 width="100%" 
            align=center border=0>
              <TBODY>
              <TR vAlign=top align=middle>
                <TD valign="top">
                  <form name="form1" method="post" action="" onSubmit="return checkAllTextValid(this);"><TABLE class=table cellSpacing=1 cellPadding=4 width="100%" 
                  align=center>
                    <TBODY>
                    <TR>
                      <TD height=25 align=middle class=title><div align="left">�һ�����</div></TD>
                    </TR>
                    <TR valign="top">
                      <TD align=middle class=con><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td width="150"><div align="right">ѡ���һط�ʽ:</div></td>
                          <td><select name="way" class="INPUT" id="way" onChange="show_div();">
                            <option value="m">ͨ���ʼ��һ�</option>
                            <option value="q" selected>ͨ�������һ�</option>
                          </select></td>
                        </tr>
                        <tr>
                          <td><div align="right">�����û���:</div></td>
                          <td><div align="left"><input name="user_name" type="text" class="INPUT" id="user_name"></div>
						  </td>
                        </tr>
                        <tr id="question_way">
                          <td><div align="right">ѡ����������:</div><br><div align="right">
                            ��д���������:</div></td>
                          <td><div align="left">
                            <select name="question" id="select" class=INPUT style="WIDTH: 150px;">
                              <option value="">ѡ���һ���������</option>
                              <?php    
									           $conArray = &$question ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$$con_name}'"; 
											   echo ">{$$con_name}</option>";
										      }
	                                        ?>
                            </select>
                          </div><br>
                            <div align="left">
                              <input name="answer" type="text" class="INPUT" id="answer">
                            </div></td>
                        </tr>
                        <tr id="question_way">
                          <td>&nbsp;</td>
                          <td><table  border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                  <div align="left">
                                    <INPUT name=find_sub type=submit class=button id="find_sub3"  value="��  ��" onClick="return check_form();">
                                  </div></td>
                              <td width="20"><div align="center"></div></td>
                              <td>
                                  <div align="left">
                                    <INPUT  name=cancel1 type=button class=button id="cancel14" onclick="history.go(-1)" value="��  ��">
                                  </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></TD>
                    </TR>
                    </TBODY></TABLE>
                  </form> </TD></TR></TBODY></TABLE>
			  <?php } ?>			  </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
<script>
function show_div() {
 var obj=document.getElementById('question_way');
 if(document.form1.way.value=="m") obj.style.display="none"; 
 else if(document.form1.way.value=="q") obj.style.display="block"; 
}
function check_form() {
 if(document.form1.user_name.value=="") {alert("�����������û���!"); document.form1.user_name.focus(); return false; } 
 if(document.form1.way.value=="q") {
  if(document.form1.question.value=="") {
   alert("��ѡ������!"); document.form1.question.focus(); return false; 
   }
  if(document.form1.answer.value==""){ 
   alert("����д��!"); document.form1.answer.focus(); return false; 
    }
  } 
}
</script>
