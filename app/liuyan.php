<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once(dirname(__FILE__)."/inc/show_msg.php"); ?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php  require_once("header.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD vAlign=top width=181 background=image/leftbg.gif height=186><?php require_once("inc/link.php");?></TD>
    <TD vAlign=top width=5 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>�����ڵ�λ��:��ҳ &gt; ���Ա�</TD>
        </TR></TBODY></TABLE>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF">
<?php 
 if(isset($_POST['liuyan_sub'])) 
  {
	  if(($_SESSION['input_string']<>$_POST['check_input'])||(!isset($_SESSION['input_string']))) 
	  { ShowMsg("�Բ���,�������۱�ȡ��","-1");   
        exit;
	  }
	  
	  $nickname=$_POST['name'];
	  $telephone=quan2ban($_POST['telephone']);
	  $email=quan2ban($_POST['email']);
	  $topic=$_POST['title'];
	  $content=strip_tags($_POST['content']);
	  $post_time=date("y-m-d H:i:s");
	  $address=$_POST['address'];
	  
	  $query="insert into ".$table_suffix."guestbook (nickname, telephone, address, topic,content, post_time, post_ip,checked,processed, email)  values
	  ('$nickname', '$telephone','$address','$topic','$content','$post_time','$ip','0','0','$email')";
	  $result=@mysql_query($query);
	  if($result)  { echo "<br>"; ShowMsg("��ϲ��,���������Ѿ��ύ,лл!","-1"); echo "<br>"; }
	  else 	{ echo "<br>"; ShowMsg("�Բ���,�����ύʧ��,������!","-1");  echo "<br>"; }
 } 
else
 { 
	  ?>
	  <form method=post id="guestbook" name="guestbook" action="liuyan.php">
                 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <table width="100%" align="center" cellpadding="5" cellspacing>
                      <tr> 
                        
            <td width="80" align="right" valign="middle" nowrap>������</td>
                        <td valign="top">                          <input name="name" type="text" class="INPUT" id="name" style="width:20%;"></td>
                      </tr>
                      <tr> 
                        
            <td valign="middle" align="right">��ַ��</td>
                        <td valign="top"><input name="address" type="text" class="INPUT" id="address2" style="width:50%;"></td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right">�绰��</td>
                        <td valign="top"><input name="telephone" type="text" class="INPUT" id="telephone" style="width:30%;">            </td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right">E-mail��</td>
                        <td valign="top"><input name="email" type="text" class="INPUT" id="email"  style="width:30%;">            </td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right">���Ա��⣺</td>
                        <td valign="top"><input name="title" type="text" class="INPUT" id="title"  style="width:50%;"></td>
                      </tr>
                      <tr> 
                        
            <td valign="top" align="right">�������ݣ�</td>
                        <td valign="top"><textarea name="content" rows="10" class="TEXTAREA" id="content" style="width:80%;"></textarea>            </td>
                      </tr>
                      <tr>
                        <td valign="middle" align="right">������֤��</td>
                        <td valign="top"><?php require_once(dirname(__FILE__)."/code_check/code.php");?>
                      </td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right">&nbsp;</td>
                        <td valign="top">
							<input name="liuyan_sub" type="submit" class="INPUT" id="liuyan_sub" onclick="return form_chk()" value="��  ��" LANGUAGE="javascript">
                            <input name="reset" type="reset" class="INPUT" id="reset" value="ȫ����д">                        </td>
                      </tr>
                </table>
              </form>
		<?php } ?> 
		    </td>
  </tr>
</table>
      </TD>
  </TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
<script>
function form_chk(){
   if (document.guestbook.address.value=="" )
     {
         alert("����д�����ڳ��У�");
	    document.guestbook.address.focus();
	    return false;
     }
   if (document.guestbook.name.value=="" )
     {
         alert("����д�����ǳƣ�");
	    document.guestbook.name.focus();
	    return false;
       }
	   if (document.guestbook.telephone.value=="" )
     {
         alert("��ϵ�绰����Ϊ�գ�");
	    document.guestbook.telephone.focus();
	    return false;
     }
	   if (document.guestbook.email.value=="" )
     {
         alert("����д���ĵ����ʼ���");
	    document.guestbook.email.focus();
	    return false;
     } 
	 if (document.guestbook.title.value=="" )
     {
         alert("������д�������⣡");
	    document.guestbook.title.focus();
	    return false;
     }
	 if (document.guestbook.content.value=="" )
     {
         alert("������д�������ݣ�");
	    document.guestbook.content.focus();
	    return false;
     }
	
	if(document.code_check.form.check_code_hide.value!=hex_md5(document.code_check.form.check_code.value))
	{alert("��֤����д���ԣ���������壬��ˢ�£�");
	 return false;
	} 
	
	else {
	 document.guestbook.check_input.value=document.code_check.form.check_code.value;
	 return true;
	}
} 
</script>
