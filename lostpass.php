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
          <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; 找回密码 </TD>
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
              $Subject			=	"找回密码-来自".$cfg_site_name;	
              $MailBody         =   "<html>\r\n<head>\r\n<title>找回密码</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
		      $MailBody        .=   "<base target='_self'/>\r\n</head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
		      $MailBody        .=   "</script>\r\n</center><div align='center' style='width:400px;padding-top:4px;height:24;font-size:10pt;border-left:1px solid #b9df92;border-top:1px solid #b9df92;border-right:1px solid #b9df92;background-color:#def5c2;'>找回密码</div>";
			  $MailBody        .=   "<div align='left' style='width:400px;height:100;font-size:10pt;border:1px solid #b9df92;background-color:#f9fcf3; padding-left:10px;'><br/>";
			  $MailBody		   .=	$row->user_name.", 您好! <br><br><div style='padding-left:30px;'>您的密码是: ".$row->user_pass." 请保管好!";
			  $MailBody        .=   "<br><br>来自".$cfg_site_name."<br>网址: <a href=\"".$cfg_mainsite."\" style=\"text-decoration:underline;\">".$cfg_mainsite."</a><br> 时间: <font color=gray>".date("y-m-d H:i:s")."</font>";
			  $MailBody        .=   "<br><br>此为系统自动发送,请不要回复此邮件!</div><br><br></div>";	
			  $MailBody        .=   "</body>\r\n</html>";	
              $result=$smtp->sendmail($MailtoAddress,$MailFrom,$Subject,$MailBody,$mailtype); 
			  if($result)  ShowMsg("恭喜！您的密码已经发送到您的邮箱中！","./");
			  else  ShowMsg("对不起！请重新试,<br>如果仍然不能找回,可能您的邮箱有误,请联系站长","./");
		    }
			elseif($_POST['way']=="q"){ 
			   if(($row->question==$_POST['question'])&&($row->answer==trim($_POST['answer'])))
			     ShowMsg("您的密码为：<font color=gray>{$row->user_pass}</font><br><br>请保管好您的密码^-^","./");
			   else ShowMsg("对不起，您不是本站的注册用户","./");
			   }
			else  ShowMsg("对不起，请选择查询方式","./");
			}
		   else ShowMsg("对不起，您不是本站的注册用户","./");
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
                      <TD height=25 align=middle class=title><div align="left">找回密码</div></TD>
                    </TR>
                    <TR valign="top">
                      <TD align=middle class=con><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td width="150"><div align="right">选择找回方式:</div></td>
                          <td><select name="way" class="INPUT" id="way" onChange="show_div();">
                            <option value="m">通过邮件找回</option>
                            <option value="q" selected>通过问题找回</option>
                          </select></td>
                        </tr>
                        <tr>
                          <td><div align="right">输入用户名:</div></td>
                          <td><div align="left"><input name="user_name" type="text" class="INPUT" id="user_name"></div>
						  </td>
                        </tr>
                        <tr id="question_way">
                          <td><div align="right">选择您的问题:</div><br><div align="right">
                            填写您的问题答案:</div></td>
                          <td><div align="left">
                            <select name="question" id="select" class=INPUT style="WIDTH: 150px;">
                              <option value="">选择找回密码问题</option>
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
                                    <INPUT name=find_sub type=submit class=button id="find_sub3"  value="提  交" onClick="return check_form();">
                                  </div></td>
                              <td width="20"><div align="center"></div></td>
                              <td>
                                  <div align="left">
                                    <INPUT  name=cancel1 type=button class=button id="cancel14" onclick="history.go(-1)" value="放  弃">
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
 if(document.form1.user_name.value=="") {alert("请输入您的用户名!"); document.form1.user_name.focus(); return false; } 
 if(document.form1.way.value=="q") {
  if(document.form1.question.value=="") {
   alert("请选择问题!"); document.form1.question.focus(); return false; 
   }
  if(document.form1.answer.value==""){ 
   alert("请填写答案!"); document.form1.answer.focus(); return false; 
    }
  } 
}
</script>
