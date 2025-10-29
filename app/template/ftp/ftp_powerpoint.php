<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title; if($article_title) echo " - ".$article_title;?></title>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$abstract?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<SCRIPT type=text/javascript>
function fontZoom(size)
{
   document.getElementById('con').style.fontSize=size+'px';
}
</SCRIPT>
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
</head>
<body onLoad="resizeImages(<?=$cfg_body_width?>);">
<?php  require_once("header.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      background=image/navbg.gif border=0>
        <TBODY>
        <TR>
          <TD class=nav height=25>您现在的位置: 
            <?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?></TD>
        </TR></TBODY></TABLE>
   <?php  if(!$num_of_ftp) {
	  ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr align=middle>
          <td  height=70 ><?php ShowMsg("Sorry! 没有找到资料...",-1); ?></td>
        </tr>
      </table>
	  <?php }  else { 
	  ?>
	  <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR align=middle>
          <TD class=newstitle height=70><?=$row->article_title?></TD></TR></TBODY></TABLE>
      <TABLE height=22 cellSpacing=1 cellPadding=3 width="90%" align=center 
      border=0>
        <TBODY>
        <TR align=middle>
          <TD class=newsinfo><?=$cfg_site_name?> &nbsp;  编辑:<?=$row->pen_name==""?"佚名":$row->pen_name?> &nbsp;  来源: <?=$row->ftp_from==""?"不详":$row->ftp_from?>&nbsp;  点击数: 
            <?=$row->read_times?>
            &nbsp; 文字大小:[<A class=newsinfo href="javascript:fontZoom(16)">大</A>][<A 
            class=newsinfo href="javascript:fontZoom(14)">中</A>][<A  class=newsinfo  href="javascript:fontZoom(12)">小</A>]</TD>
        </TR></TBODY></TABLE>
      <TABLE cellSpacing=1 cellPadding=0 width="90%" align=center 
      border=0>
        <TBODY>
          <TR vAlign=top>
            <TD class=newscon id=con height=100><br>
            <?=$row->content?>
			<p align="center">	
			<table border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#666666">
              <tr>
                <td bgcolor="#FFFFFF"><iframe height="450" width="600" src="<?=$row->filename?>"></iframe></td>
              </tr>
            </table>
			</p>		
			</TD>
          </TR>
        </TBODY>
      </TABLE>
	  <?php require_once("inc/similar_art.php"); ?>
	  <?php require_once("inc/add_times.php");//分别在文章表和索引表中更新点击数信息 ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
      <?php require_once("inc/comment_front.php"); ?>
	  <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
       <?php require_once("inc/add_comment.php");?>
	   <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table>
	   <BR>
		<?php } ?>
	  </TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>