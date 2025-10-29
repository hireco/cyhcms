<?php require_once("config/base_cfg.php");?>
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
    <TD width="181" vAlign=top>
	  <?php require_once("inc/poll.php"); ?>
	<?php require_once("inc/link.php");?>	</TD>
    <TD width="6" vAlign=top></TD>
    <TD height=200 vAlign=top bgcolor="#EDD9C2">
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置: <a href="./">首 页</a> &gt; 站点地图</TD>
        </TR></TBODY></TABLE>
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td><?php require_once("inc/php_menu.php"); ?></td>
        </tr>
      </table>      </TD>
  </TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
