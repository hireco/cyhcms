<?php session_start();
require_once(dirname(__FILE__)."/inc.php"); 
require_once(dirname(__FILE__)."/scripts/sys_test.php");
require_once("function/inc_function.php");   
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<html>
<?php if(!isset($_REQUEST['sys_info'])) { ?>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<?php } ?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="600"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	<?php require_once("scripts/header.php");?>
	
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="900"><table width="900"  border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200" align="center" valign="top"><div align="center">
            <table width="100%"  border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><div align="center"><img src="image/index_11.jpg" width="175" height="133" hspace="0" vspace="0" align="texttop"></div></td>
              </tr>
              <tr>
                <td style="line-height: 12px;" ><div align="center"><font color="#000000">欢迎使用红棉内容管理系统</font></div></td>
              </tr>
              <tr>
                <td style="line-height:24px"><div align="center"></div></td>
              </tr>
              <tr>
                <td style="line-height:24px"><div align="center"> </div></td>
              </tr>
            </table>
        </div></td>
        <td colspan="2" align="left" valign="top"><table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td></td>
          </tr>
        </table>
		<?php if(isset($_POST['Submit'])) { 
			$writer_name_input=trim($_REQUEST['writer_name']);
		    $telephone=trim($_REQUEST['telephone']);
			$cellphone=trim($_REQUEST['cellphone']); 
			$qq=trim($_REQUEST['qq']);
			$msn=trim($_REQUEST['msn']); 
			$email=trim($_REQUEST['email']); 
			$result=@mysql_query("update ".$table_suffix."admin set writer_name='$writer_name_input', telephone='$telephone', cellphone='$cellphone',qq='$qq',msn='$msn',email='$email'  where admin_id='{$_SESSION['admin_valid']}'");  
			if($result) ShowMsg("OK,您的个人信息修改成功!",-1);
			else ShowMsg("Sorry,修改失败,请重来!",-1);			
			} else { ?>
          <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
            <tr>
              <td bgcolor="#EFC789"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td>修改您的个人信息更新&gt;&gt; </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td>		  
			  <table width="100%"  border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td bgcolor="#FFFFFF"><form name="form1" method="post" action="">
                      <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2">&nbsp;&nbsp;以下信息不可以修改</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="200"><div align="left">&nbsp;&nbsp;您的用户名</div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$_SESSION['admin_valid']?> (这是您的身份的最重要的标识)</div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您的真实姓名</div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$_SESSION['real_name']?>
                          </div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您的用户级别</div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$_SESSION['admin_level']?>
(由超级管理员指定)</div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您上次登陆的时间</div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$_SESSION['last_login_time']==""?"第一次登录":$_SESSION['last_login_time']?>
</div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您上次登陆的IP</div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$_SESSION['last_login_ip']==""?"第一次登录":$_SESSION['last_login_ip']?>
                          </div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2"><div align="left">&nbsp;&nbsp;可以修改的信息如下&nbsp;&nbsp;&nbsp;</div></td>
                        </tr>
                       <?php 
						$query="select * from ".$table_suffix."admin where admin_id='{$_SESSION['admin_valid']}'";
						$result=mysql_query($query);
						$row=mysql_fetch_object($result);
					   ?>
						<tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的笔名</td>
                          <td>&nbsp;&nbsp;
  <input name="writer_name" type="text" class="inputbut" id="writer_name" value="<?=$row->writer_name?>" size="30"> 
  发布文章时显示在前台</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的电话</td>
                          <td>&nbsp;&nbsp; <input name="telephone" type="text" class="inputbut" id="telephone" value="<?=$row->telephone?>" size="30"> </td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的手机</td>
                          <td>&nbsp;&nbsp; <input name="cellphone" type="text" class="inputbut" id="cellphone" value="<?=$row->cellphone?>" size="30"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的邮箱</td>
                          <td>&nbsp;&nbsp;
                            <input name="email" type="text" class="inputbut" id="email" value="<?=$row->email?>" size="30"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的qq号</td>
                          <td>&nbsp;&nbsp; <input name="qq" type="text" class="inputbut" id="qq" value="<?=$row->qq?>" size="30"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;您的MSN</td>
                          <td>&nbsp;&nbsp; <input name="msn" type="text" class="inputbut" id="msn" value="<?=$row->msn?>" size="30"> 
                            <a href="admin_id_edit.php"  style="text-decoration:underline">修改密码请点击这里</a></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td>&nbsp;&nbsp;
                            <input name="Submit" type="submit" class="inputbut" value="提  交"></td>
                          <td>&nbsp;&nbsp; <input name="Submit2" type="button" class="inputbut" onClick="history.go(-1)" value="取  消"> </td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
              </table>
			   </td>
            </tr>
          </table>
		  <?php } ?>
		  </td>
      </tr>
      <tr>
        <td height="5" colspan="3" valign="top"></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center"></div>
            <div align="right"> </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td></td>
      </tr>
    </table>      <?php if(!isset($_REQUEST['sys_info'])) require_once("scripts/calendar.htm");?></td>
  </tr>
</table>
	</td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>


