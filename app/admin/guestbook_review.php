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
	  $content=$_SESSION['writer_name']."于".date("y-m-d H:i:s")."的回复:<br>".$content."<br>".$content_old;
	  $query="update ".$table_suffix."guestbook set content='$content' where id={$_REQUEST[reply_id]}";
	  $result=@mysql_query($query);
	  if($result)  { 
	  $query_guestbook="update ".$table_suffix."guestbook set processed='1' where id={$_REQUEST[reply_id]}";
	  $result=@mysql_query($query_guestbook);
	  echo "<br>"; ShowMsg("恭喜您,您的留言已经提交,谢谢!","-1"); echo "<br>"; exit; }
	  else 	{ echo "<br>"; ShowMsg("对不起,留言提交失败,请重来!","-1");  echo "<br>";  exit;}
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
          <td>访客留言本浏览&gt;&gt;</td>
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td valign="middle" background="image/nei4.gif" >
        <?php if(!$row) { 
		 echo "<table  width=\"80%\"  height=\"100\" align=\"center\"><tr><td align=\"center\" vlign=\"middle\">往后再没有留言了</td></tr></table>";
		 echo "<table  width=\"80%\"  height=\"30\" align=\"center\"><tr><td align=\"right\" vlign=\"middle\">"; echo"【<a href=\"javascript:history.back(-1)\">返回</a>】【<a href=\"javascript:window.close()\">关闭</a>】"; echo "</td></tr></table>";      
		 } else {?>
                 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;&lt;<a href="guestbook_review.php?front=<?php echo $id-1; ?>">上一条留言</a><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 第<?php echo $id; ?>条留言<br>
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
                          <td width="60" bgcolor="#FFFF99">留言者</td>
                          <td width="120"><?php echo $row['nickname'];?></td>
                          <td width="60">留言日期</td>
                          <td><?php echo $row['post_time'];?></td>
                        </tr>
                        <tr bgcolor="#DFEFCF">
                          <td bgcolor="#FFFF99">联系电话</td>
                          <td><?php echo $row['telephone'];?></td>
                          <td>电子邮件</td>
                          <td><?php echo "<a href=\"mailto:".$row['email']."\">".$row['email']."</a>";?></td>
                        </tr>
                        <tr bgcolor="#FFECC4">
                          <td bgcolor="#FFFF99">主题</td>
                          <td colspan="3"><?php echo $row['topic'];?></td>
                        </tr>
                        <tr bgcolor="#E6E6E6">
                          <td valign="top" bgcolor="#FFFF99">内容</td>
                          <td height="80" colspan="3" valign="top"><?php echo $row['content'];?>
                          </td>
                        </tr>
                        <tr bgcolor="#FFFFCC">
                          <td valign="top" bgcolor="#FFFF99">来源</td>
                          <td colspan="3" valign="top">
						  <?=$row['address']?>&nbsp;&nbsp;&nbsp;&nbsp;IP地址:<?php echo $row['post_ip'];?></td>
                        </tr>
                      </table>
                    </div>                    
                  <div align="left">                    </div></td>
                </tr>
              </table>
            </div></td>
          </tr>
      </table>
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="guestbook_review.php?next=<?php echo $id+1; ?>">下一条留言&gt;&gt;</a><br>
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
            <td width="80" align="right" valign="top">回复内容：</td>
                        <td valign="top"><textarea name="content" rows="10" class="TEXTAREA" id="content" style="width:80%;"></textarea>            </td>
                      </tr>
                      <tr> 
                        <td valign="middle" align="right"><input name="reply_id" type="hidden" id="reply_id" value="<?=$_REQUEST['id']?>"></td>
                        <td valign="top">
							<input name="liuyan_sub" type="submit" class="inputbut" id="liuyan_sub" value="提  交" LANGUAGE="javascript">
                            <input name="reset" type="reset" class="inputbut" id="reset" value="全部重写">                        </td>
                      </tr>
                </table>
              </form></td>
  </tr>
</table>
<?php  } else  require_once("login_wrong.php"); ?>

