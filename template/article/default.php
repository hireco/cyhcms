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
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
        <TBODY>
        <TR>
          <TD class=nav height=25>�����ڵ�λ��: 
            <?php  echo "<a href=\"./\">�� ҳ</a> "; require_once("inc/get_position.php"); ?></TD>
        </TR></TBODY></TABLE>
  
	  <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#DDDDDD">
        <tr>
          <td bgcolor="#FFFFFF"><?php   if(!$num_of_article) {
	  ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr align=middle>
          <td height=70 ><?php ShowMsg("Sorry! û���ҵ���������...",-1); ?></td>
        </tr>
      </table>
	  <?php }  else { ?>
	  <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR align=middle>
          <TD class=newstitle height=70><?=$row->article_title?></TD></TR></TBODY></TABLE>
      <TABLE height=22 cellSpacing=1 cellPadding=3 width="90%" align=center 
      border=0>
        <TBODY>
        <TR align=middle>
          <TD class=newsinfo><?=substr($row->post_time,0,14)?> &nbsp;  �༭:<?=$row->pen_name==""?"����":$row->pen_name?> &nbsp;  ��Դ: <?=$row->article_from==""?"����":$row->article_from?>&nbsp;  �����: 
            <?=$row->read_times?>
            &nbsp; ���ִ�С:[<A class=newsinfo href="javascript:fontZoom(16)">��</A>][<A 
            class=newsinfo href="javascript:fontZoom(14)">��</A>][<A  class=newsinfo  href="javascript:fontZoom(12)">С</A>]</TD>
        </TR></TBODY></TABLE>
      <TABLE height=200 cellSpacing=1 cellPadding=0 width="90%" align=center 
      border=0>
        <TBODY>
        <TR vAlign=top>
          <TD class=newscon id="con" height=100><?=$row->content?></TD></TR></TBODY></TABLE>
	  <?php require_once("inc/similar_art.php"); ?>
	  <?php require_once("inc/add_times.php");//�ֱ������±���������и��µ������Ϣ ?>
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
		<?php } ?></td>
        </tr>
      </table></TD></TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>