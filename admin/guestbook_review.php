<?php session_start(); if(session_is_registered("root")) { ?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
      require_once("setting.php");
      require_once(RROOT."/dbscripts/db_connect.php");	
      require_once("function/inc_function.php");	
   if(isset($_POST['liuyan_sub'])) {
	  $content=strip_tags($_POST['content']);
	  $content_old=mysql_result(mysql_query("select content from ".$table_suffix."guestbook where id={$_REQUEST[reply_id]}"),0,"content");
	  $content_old="<table width=\"100%\"  border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#CCCCCC\"><tr><td bgcolor=\"#FFFFFF\">".$content_old."</td></tr></table>";
	  $content=$_SESSION['writer_name']."��".date("y-m-d H:i:s")."�Ļظ�:<br>".$content."<br>".$content_old;
	  $query="update ".$table_suffix."guestbook set content='$content' where id={$_REQUEST[reply_id]}";
	  $result=@mysql_query($query);
	  if($result)  { 
	  $query_guestbook="update ".$table_suffix."guestbook set processed='1' where id={$_REQUEST[reply_id]}";
	  $result=@mysql_query($query_guestbook);
	  echo "<br>"; ShowMsg("��ϲ��,���������Ѿ��ύ,лл!","-1"); echo "<br>"; exit; }
	  else 	{ echo "<br>"; ShowMsg("�Բ���,�����ύʧ��,������!","-1");  echo "<br>";  exit;}
    }
?>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<?php $next_flag=0; $front_flag=0;
       if(isset($_REQUEST['next'])) { $id=$_REQUEST['next']; $next_flag=1;}
	   elseif(isset($_REQUEST['front'])){ $id=$_REQUEST['front'];$front_flag=1;}
	   else { $id=$_REQUEST['id'];  session_register("id");}
					  if($next_flag==1) $result=@mysql_query("select * from ".$table_suffix."guestbook where id>='$id'");
					  elseif($front_flag==1) $result=@mysql_query("select * from ".$table_suffix."guestbook where id<='$id'");
					  else $result=@mysql_query("select * from ".$table_suffix."guestbook where id='$id'");
					  if(!$result)  { echo "failed to query the database"; return false;}
					  if($row=@mysql_fetch_array($result)) 
					  { $query_guestbook="update ".$table_suffix."guestbook set checked='1' where id='$id'";
					    $result=@mysql_query($query_guestbook); 					       
					  } 
					?>  
<table width="760" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td background="image/nei1.gif" height="37">
      <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>�ÿ����Ա����&gt;&gt;</td>
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td valign="middle" background="image/nei4.gif" >
        <?php if(!$row) { 
		 echo "<table  width=\"80%\"  height=\"100\" align=\"center\"><tr><td align=\"center\" vlign=\"middle\">������û��������</td></tr></table>";
		 echo "<table  width=\"80%\"  height=\"30\" align=\"center\"><tr><td align=\"right\" vlign=\"middle\">"; echo"��<a href=\"javascript:history.back(-1)\">����</a>����<a href=\"javascript:window.close()\">�ر�</a>��"; echo "</td></tr></table>";      
		 } else {?>
                 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;&lt;<a href="guestbook_review.php?front=<?php echo $id-1; ?>">��һ������</a><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ��<?php echo $id; ?>������<br>
		<table width="90%" align="center" cellpadding="1" cellspacing bgcolor="#CCCCCC">
          <tr>
            <td colspan="2"  valign="middle"><div align="center">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#FFFFFF"><div align="left">
                    </div>                    <div align="left">
                    </div>                    <div align="left">
                      <table width="100%"  border="0" cellpadding="3" cellspacing="1">
                        <tr bgcolor="#E0E0EF">
                          <td width="60" bgcolor="#FFFF99">������</td>
                          <td width="120"><?php echo $row['nickname'];?></td>
                          <td width="60">��������</td>
                          <td><?php echo $row['post_time'];?></td>
                        </tr>
                        <tr bgcolor="#DFEFCF">
                          <td bgcolor="#FFFF99">��ϵ�绰</td>
                          <td><?php echo $row['telephone'];?></td>
                          <td>�����ʼ�</td>
                          <td><?php echo "<a href=\"mailto:".$row['email']."\">".$row['email']."</a>";?></td>
                        </tr>
                        <tr bgcolor="#FFECC4">
                          <td bgcolor="#FFFF99">����</td>
                          <td colspan="3"><?php echo $row['topic'];?></td>
                        </tr>
                        <tr bgcolor="#E6E6E6">
                          <td valign="top" bgcolor="#FFFF99">����</td>
                          <td height="80" colspan="3" valign="top"><?php echo $row['content'];?>
                          </td>
                        </tr>
                        <tr bgcolor="#FFFFCC">
                          <td valign="top" bgcolor="#FFFF99">��Դ</td>
                          <td colspan="3" valign="top">
						  <?=$row['address']?>&nbsp;&nbsp;&nbsp;&nbsp;IP��ַ:<?php echo $row['post_ip'];?></td>
                        </tr>
                      </table>
                    </div>                    
                  <div align="left">                    </div></td>
                </tr>
              </table>
            </div></td>
          </tr>
      </table>
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="guestbook_review.php?next=<?php echo $id+1; ?>">��һ������&gt;&gt;</a><br>
         <?php } ?>
    </td>
  </tr>
  <tr>
    <td><img src="image/nei3.gif" width="760" height="12"></td>
  </tr>
</table>
<table width="760"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form method=post id="guestbook" name="guestbook" action="">
        <table width="100%" align="center" cellpadding="5" cellspacing>
                      <tr>
            <td width="80" align="right" valign="top">�ظ����ݣ�</td>
                        <td valign="top"><textarea name="content" rows="10" class="TEXTAREA" id="content" style="width:80%;"></textarea>            </td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right"><input name="reply_id" type="hidden" id="reply_id" value="<?=$_REQUEST['id']?>"></td>
                        <td valign="top">
							<input name="liuyan_sub" type="submit" class="inputbut" id="liuyan_sub" value="��  ��" LANGUAGE="javascript">
                            <input name="reset" type="reset" class="inputbut" id="reset" value="ȫ����д">                        </td>
                      </tr>
                </table>
              </form></td>
  </tr>
</table>
<?php  } else  require_once("login_wrong.php"); ?>

