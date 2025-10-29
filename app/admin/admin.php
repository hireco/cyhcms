<?php session_start();
require_once(dirname(__FILE__)."/inc.php"); 
require_once(dirname(__FILE__)."/scripts/sys_test.php");
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
                <td style="line-height: 12px;" ><div align="center"><font color="#000000">欢迎登录后台管理系统</font></div></td>
              </tr>
              <tr>
                <td style="line-height:24px"><div align="center"></div></td>
              </tr>
              <tr>
                <td style="line-height:24px"><div align="center"> </div></td>
              </tr>
            </table>
        </div></td>
        <td colspan="2" align="left" valign="top">
          <?php 
	if(isset($_REQUEST['sys_info'])) require_once(dirname(__FILE__)."/php_info.php");
    else {	
	?>
          <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
            <tr>
              <td bgcolor="#EFC789"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td>用户信息&gt;&gt; </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                        <tr bgcolor="#FFFFFF">
                          <td width="200"><div align="left">&nbsp;&nbsp;您的用户名</div></td>
                          <td><div align="left">&nbsp;&nbsp;<?=$_SESSION['admin_valid']?></div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您的真实姓名</div></td>
                          <td><div align="left">&nbsp;&nbsp;<?=$_SESSION['real_name']?></div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您的用户级别</div></td>
                          <td><div align="left">&nbsp;&nbsp;<?=$_SESSION['admin_level']?></div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您上次登陆的时间</div></td>
                          <td><div align="left">&nbsp;&nbsp;<?=$_SESSION['last_login_time']==""?"第一次登录":$_SESSION['last_login_time']?></div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><div align="left">&nbsp;&nbsp;您上次登陆的IP</div></td>
                          <td><div align="left">&nbsp;&nbsp;<?=$_SESSION['last_login_ip']==""?"第一次登录":$_SESSION['last_login_ip']?></div></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2"><div align="right"><a href="admin_id_infor.php" style="text-decoration:underline;">修改个人信息&gt;&gt;</a>&nbsp;&nbsp;&nbsp;</div></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
          </table>
          <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
            <tr>
              <td bgcolor="#EFC789"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td>系统信息&gt;&gt; </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                        <?php for($i=0;$i<=12;$i++){ ?>
                        <tr bgcolor="#FFFFFF">
                          <td width="200"><div align="left">&nbsp;&nbsp;
                                  <?=$info[$i][0]?>
                          </div></td>
                          <td><div align="left">&nbsp;&nbsp;
                                  <?=$info[$i][1]?>
                          </div></td>
                        </tr>
                        <?php } ?>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2"><div align="right"><a href="admin.php?sys_info">查看系统更多信息&gt;&gt;</a>&nbsp;&nbsp;&nbsp;</div></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
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


