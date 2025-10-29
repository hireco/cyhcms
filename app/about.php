<?php   
  require_once(dirname(__FILE__)."/config/base_cfg.php");
  if(is_file(dirname(__FILE__)."/".$cfg_admin_root."scripts/html_set.php")) 
  require_once(dirname(__FILE__)."/".$cfg_admin_root."scripts/html_set.php"); 
?>
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
    <TD vAlign=top width=181 background=image/leftbg.gif 
height=186><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
      <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
                <TR>
                  <TD width=8></TD>
                  <TD></TD>
                </TR>
              </TBODY>
          </TABLE></TD>
        </TR>
      </TBODY>
    </TABLE>
      <TABLE height=120 cellSpacing=0 cellPadding=0 width=179 align=center 
      border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <TABLE cellSpacing=0 cellPadding=0 width=179 align=center border=0>
                <TBODY>
                  <TR>
                    <TD vAlign=top>
                     <TABLE cellSpacing=0 cellPadding=3 width="100%" border=0>
                        <TBODY>
                          <?php $conArray = &$file ;
		                   foreach ( $conArray as $con_name => $value ) {
	                       $$con_name = $value  ;
		                  ?>		   
					      <TR class=list>
                            <TD style="PADDING-LEFT: 10px; BORDER-BOTTOM: #d2d2d2 1px solid"  width="100%" height=27><IMG height=14   src="image/items.gif" width=16> <A class=class  href="?html=<?=$$con_name?>" target=_self><?=$con_name?></A>&nbsp; </TD>
                          </TR>
			              <?php  }
	                      ?>
					   </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./">首页</a> &gt; 
		   <?php $conArray = &$file ;
		          foreach ( $conArray as $con_name => $value ) {
	              $$con_name = $value;
				  if($$con_name==$_REQUEST['html']) { echo $con_name; break; }  
		   }
		 ?></TD>
        </TR></TBODY></TABLE>
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td><?php require_once("html/".$_REQUEST['html']);?></td>
        </tr>
      </table></TD>
  </TR></TBODY></TABLE>
<?php   require_once("footer.php"); ?>
</body>
</html>
