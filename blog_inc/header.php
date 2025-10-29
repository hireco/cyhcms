<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table border="0" align="center" cellpadding="0" cellspacing="0" width="<?=$body_width?>">
      <tr>
        <td><div align="left"><a href="<?=$cfg_mainsite?>" style="text-decoration:underline ">
            <?=$cfg_site_name?>首页</a> <a href="<?=$cfg_mainsite?>member_list.php" style="text-decoration:underline ">博客首页</a></div></td>
        <td><div align="right">
            <?php if(!isset($_SESSION['user_name'])) { ?>
            <a href="member.php?to_go=<?php 
			 if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	         else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" target="_self" style="text-decoration:underline">登录</a> | <a href="register.php?to_go=<?php 
			 if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	         else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" style="text-decoration:underline">注册</a>
            <?php } else  echo "<a href=\"logout.php\" style=\"text-decoration:underline\">注销登录</a>";	 ?>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" <?php if($head_bg_type=="c") echo "bgcolor"; else echo "background"; echo "=\"".$head_bg."\""; ?>>
  <tr>
    <td><TABLE height=<?=$head_height?> cellSpacing=0 cellPadding=0 width=<?=$body_width?> align=center 
<?php if($banner<>"")  echo "background=$banner"; ?>  border=0>
      <TBODY>
        <TR>
          <TD width="50%" align=middle><div align="center">
            <table width="100%"  border="0" cellpadding="10" cellspacing="0">
              <tr>
                <td width="20">&nbsp;</td>
                <td><span class="blog_head"><font color="<?=$blog_title_color?>"><?=$blog_title?></font></span> <table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="<?php echo $cfg_mainsite."user_infor.php?host_id=".$host_id."&idkey=".$_REQUEST['idkey'];?>" style="text-decoration:underline; color:<?=$blog_title_color?>;">地址:<?php echo $cfg_mainsite."user_infor.php?host_id=".$host_id."&idkey=".$_REQUEST['idkey'];?></a></td>
  </tr>
</table>
</td>
              </tr>
            </table>
            </div></TD>
          <TD></TD>
          </TR>
      </TBODY>
    </TABLE></td>
  </tr>
</table>
