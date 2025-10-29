<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
require_once(dirname(__FILE__)."/inc/find_cookie.php");
$query="select * from ".$table_suffix."infor where top_navi='1' and  hide_type='0' order by top desc,top_time desc limit 0,9";  
$result=mysql_query($query);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><table height="100" cellspacing="0" cellpadding="0" width="<?=$cfg_body_width?>" align="center" 
background="" border="0">
      <tbody>
        <tr>
          <td align="middle" width="150"><img src="image/user_center.gif" width="145" height="45" border="0" /></td>
          <td>&nbsp;</td>
          <td align="right" width="132">&nbsp;</td>
        </tr>
      </tbody>
    </table></td>
    <td valign="top"><table border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td><a href="./">本站首页</a></td>
        <td><a href="user_infor.php?idkey=<?=md5($_SESSION['user_name'])?>&host_id=<?=$_SESSION['user_id']?>">我的博客</a></td>
        <td><a href="ask/">问答系统</a></td>
		<td><a href="exam/">考试系统</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
  <TR>
    <TD>&nbsp;</TD>
    <TD width=<?=$cfg_body_width?>><table height="28" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="member.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="member.php" style="color:#FFFFFF">用户首页</a></td>
        <td width="5"></td>
        <td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="amend.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="amend.php" style="color:#FFFFFF">个人资料</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="tougao_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="tougao_admin.php" style="color:#FFFFFF">文章管理</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="blog_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="blog_admin.php" style="color:#FFFFFF">日志管理</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="inner_infor_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="inner_infor_admin.php" style="color:#FFFFFF">内部信息</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="guy_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="guy_admin.php?list_for=friend" style="color:#FFFFFF">我的好友</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="collection_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="collection_admin.php" style="color:#FFFFFF">收藏夹</a></td>
        <td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="guestbook_admin.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="guestbook_admin.php?list_for=get" style="color:#FFFFFF">我的留言</a></td>
		<td width="5"></td>
		<td width="80" align=middle bgcolor="<?=basename($_SERVER['PHP_SELF'])=="blog_cfg.php"?"#0094D6":"#4AB5DE"?>" style="PADDING-TOP: 5px"><a href="blog_cfg.php" style="color:#FFFFFF">博客设置</a></td>
      </tr>
    </table></TD>
    <TD>&nbsp;</TD>
    </TR>
  <TR>
    <TD height="2" colspan="3" bgcolor="#0096D4"></TD>
    </TR>
  </TBODY></TABLE>
<TABLE height=14 cellSpacing=0 cellPadding=0 width=100% align=center 
background=image/m2.gif border=0>
  <TBODY>
  <TR>
    <TD width=136><IMG height=14 src="image/m1.gif" width=10></TD>
    <TD><IMG height=14 src="image/m2.gif" width=24></TD>
    <TD align=right width=11><IMG height=14 src="image/m3.gif" 
    width=11></TD></TR></TBODY></TABLE>
<TABLE height=12 cellSpacing=0 cellPadding=0 width=100% align=center 
bgColor=#ffffff border=0>
  <TBODY>
  <TR>
    <TD></TD></TR></TBODY></TABLE>
