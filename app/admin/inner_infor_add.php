<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");   
   require_once(dirname(__FILE__)."/../config/mail_cfg.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ĵ�����</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script>
function expand(x) {
	if (x.style.display=='block') 
		x.style.display='none';
	else
		x.style.display='block';
  }  

function expand2(x) {
	if (document.all.send_mode.value=='m') 
		x.style.display='block';
	else
		x.style.display='none';
  } 
</script>
</head>
<body>
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="7"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td>&nbsp;</td>
                <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="inner_infor.php">��Ϣ����</a></div>
                </div></td>
                <td>&nbsp;</td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td valign="top"><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="inner_infor_mine.php">�ҵ���Ϣ</a></div>
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><div class="bigtext_b">
                  <div align="center">
                    <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                            <div align="center">��Ϣ����</div>
                        </div></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </div>
                </div></td>
        </tr>
    </table>      
    <div align="center">
      </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<?php 
  if(isset($_POST['submit_inner'])) {
	   //��ȡ���е��ύPOST����
	    if ( isset( $_POST ) )
			   $postArray = &$_POST ;
			foreach ( $postArray as $sForm => $value )
			{
				if ( get_magic_quotes_gpc() )
					$$sForm = stripslashes( trim($value) )  ;
				else
					$$sForm = trim($value)  ;
		     }
	    $content = stripslashes($content);
        $post_time=date("y-m-d H:i:s");
		if($receiver=="") {
		  if($select_object=="s") $query="select admin_id, email from ".$table_suffix."admin where 1=1";
		  else if($_REQUEST['mem_type']<>4)  $query="select user_name, email from ".$table_suffix."member where user_level ='{$_REQUEST['mem_type']}'";
		  else $query="select user_name, email from ".$table_suffix."member where 1=1";
		  $result=mysql_query($query);
		  $i=0;
		  while($row=mysql_fetch_object($result)) {
		    if($select_object=="s") $receiver[$i]=$row->admin_id;
			else  $receiver[$i]=$row->user_name;
		    $i++;
		   }
		  }
		else {
		  $receiver=explode(",",$receiver);
		  $receiver=implode("','",$receiver);
		  if($select_object=="s") $query="select email from ".$table_suffix."admin where admin_id in ('{$receiver}')";
		  else   $query="select email from ".$table_suffix."member where  user_name in ('{$receiver}')";
		  $receiver=explode("','",$receiver);
		}
		
		$result=mysql_query($query);
		if(!@mysql_num_rows($result))  { ShowMsg("û�в�������",-1);  exit; }
		
		if($send_mode=="m") {
            require_once(dirname(__FILE__)."/../mail/mail.php");
			while($row=mysql_fetch_object($result))	{		 
			 $MailtoAddress		=	$row->email;		
             $Subject			=	$infor_title;	
             $MailBody			=	$content;		
             $result=$smtp->sendmail($MailtoAddress,$MailFrom,$Subject,$MailBody,$mailtype); 
		    }
		 }
		$content=addslashes($content);
		if($result)  { 
		$query="insert into ".$table_suffix."inner_infor (infor_title,content,post_time,receiver_type,hide,send_mode,poster,pen_name) 
		                                          values ('$infor_title','$content','$post_time','$select_object','0','$send_mode','{$_SESSION['admin_valid']}','{$_SESSION['writer_name']}')";	  
	    $result=mysql_query($query);
		
		}
		
		$infor_id=mysql_insert_id();
		if($send_mode=="a") {
		   for($i=0;$i<count($receiver);$i++) {
			$query="insert into ".$table_suffix."inner_record (infor_id,read_or_not,user_id) 
		                                          values ('$infor_id','0','{$receiver[$i]}')";	  
	        $result=mysql_query($query);
		   }
		}
	   
	   if($result)  ShowMsg("�ɹ������ڲ���Ϣ","inner_infor.php");   else ShowMsg("����ʧ��,������",-1); 
	       
	 }
 else 
	 { 
	?>
	<form name="form1" action="" method="post" >
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="100"><div align="right">��Ϣ����</div></td>
          <td width="10">&nbsp;</td>
          <td><div align="left">
            <input name="infor_title" type="text" id="infor_title" style="width:400px; ">
          </div></td>
        </tr>
        <tr>
          <td valign="top"><div align="right">��Ϣ����</div></td>
          <td>&nbsp;</td>
          <td><div align="left"><?php
					require_once(dirname(__FILE__)."/../FCKeditor/fckeditor.php");
					$fck = new FCKeditor("content");
					$fck->BasePath		= $cfg_mainsite.'FCKeditor/' ;
					$fck->Width		= '800' ;
					$fck->Height		= "200" ;
					$fck->ToolbarSet	= "Small" ;
					$fck->Value = "" ;
					$fck->Create(); ?></div></td>
        </tr>
        <tr>
          <td><div align="right">��������</div></td>
          <td>&nbsp;</td>
          <td><div align="left">
		    <select name="select_object" onChange="expand(document.all.div_r)">
		      <option value="s">��վ����</option>
		      <option value="r" selected>��վ��Ա</option>
		      </select>
		    </div></td>
          </tr>
         <tr id="div_r" style="display: block;">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><select name="mem_type">
          <?php    
				for($i=1;$i<=4;$i++){
				echo "<option value=$i "; 
				if($i=="4") echo " selected";
				echo ">{$inner_type[$i]}</option>";
				}
	            ?> 
		 </select></td>
        </tr>
        <tr>
          <td valign="top"><div align="right">��������</div></td>
          <td>&nbsp;</td>
          <td><div align="left">
            <textarea name="receiver" rows="3" class="TEXTAREA" id="receiver" style="width:400px;" onChange="if(this.value)  document.form1.inner_type.value='5'; " ></textarea>
          <input name="select_article" type="button" class="INPUT" id="select_article" 
								  onClick="OpenMywin_wider('member_list.php')" value="ѡ��">
          *����Ŀ���û���ID��,��,���</div></td>
        </tr>
        <tr>
          <td><div align="right">������ʽ</div></td>
          <td>&nbsp;</td>
          <td><div align="left">
            <select name="send_mode" id="send_mode" onChange="expand2(document.all.div_m)">
              <option value="m">�����ʼ�</option>
              <option value="a" selected>��������</option>
            </select>
          </div></td>
        </tr>
        <tr id="div_m" style="display: none;">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><table  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td colspan="5">������ΪĬ��Ϊϵͳ�����õ��ʼ�������,��ϵͳδ����,���ܷ����ʼ�,<a href="sys_config.php?action_do=mail" style="text-decoration:underline;">����˴�����</a></td>
              </tr>
            <tr>
              <td>�ʼ�������                </td>
              <td><input name="mail_server" type="text" id="mail_server" style="width:200px; "></td>
              <td>�ʼ��ʺ�                </td>
              <td><input name="mail_account" type="text" id="mail_account" style="width:150px; "></td>
              <td nowrap>*ע�������ʼ�����������֧����Ӧ����</td>
            </tr>
            <tr>
              <td>�ʼ�����                </td>
              <td><input name="mail_password" type="password" id="mail_password" style="width:200px; "></td>
              <td>�ظ��ʼ�</td>
              <td><input name="reply_address" type="text" id="mail_address" style="width:150px; "></td>
              <td>*�ظ��ʼ�������ʺ�һ��,������ܳ���</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div align="right"></div></td>
          <td>&nbsp;</td>
          <td><div align="left">
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><input name="submit_inner" type="submit" class="inputbut" id="submit_inner" value="��  ��" onClick="return check_form(); "></td>
                <td><input name="cancel" type="button" class="inputbut" id="cancel" value="������" onclick="history.go(-1);"/></td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table>
	</form>
<?php } ?>
	</td>
  </tr>
</table>
</body>
</html>
<script>
function check_form(){
  if(document.form1.infor_title.value=="") { alert("��Ϣ���ⲻ��Ϊ��!"); document.form1.infor_title.focus();  return false;}
}
</script>
