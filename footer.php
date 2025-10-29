<?php 
  require_once(dirname(__FILE__)."/config/base_cfg.php");
  if(is_file(dirname(__FILE__)."/".$cfg_admin_root."scripts/html_set.php")) 
  require_once(dirname(__FILE__)."/".$cfg_admin_root."scripts/html_set.php"); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<TABLE height=29 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/menubg.gif border=0>
  <TBODY>
  <TR>
    <TD align=middle colSpan=2>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=btmenu style="PADDING-RIGHT: 8px; PADDING-LEFT: 8px" noWrap 
          align=middle><A class=btmenu 
            href="class_list.php" 
            target=_self>全站搜索</A> </TD>
          
          <?php $conArray = &$file ;
		               foreach ( $conArray as $con_name => $value ) {
	                   $$con_name = $value  ;
		               echo "<TD width=1><IMG height=12 src=\"image/split1.gif\" width=1></TD>";					   
					   echo "<TD class=btmenu style=\"PADDING-RIGHT: 8px; PADDING-LEFT: 8px\" noWrap align=middle><A class=btmenu 
                             href=\"about.php?html=".$$con_name."\" target=_self>".$con_name."</A></TD>";
			    }
	       ?>
		<TD width=1><IMG height=12 src="image/split1.gif" 
        width=1></TD>
		<TD class=btmenu style="PADDING-RIGHT: 8px; PADDING-LEFT: 8px" noWrap 
          align=middle><A class=btmenu 
            href="liuyan.php" target=_self>给我留言</A> 
          </TD>
          
		  <TD width=1><IMG height=12 src="image/split1.gif" 
        width=1></TD>
		  <TD class=btmenu style="PADDING-RIGHT: 8px; PADDING-LEFT: 8px" noWrap 
          align=middle><A class=btmenu 
            href="site_map.php" target=_self>站点地图</A> 
          </TD>
	   </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<TABLE height=14 cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/m2.gif border=0>
  <TBODY>
  <TR>
    <TD width=136><IMG height=14 src="image/m1.gif" width=10></TD>
    <TD><IMG height=14 src="image/m2.gif" width=24></TD>
    <TD align=right width=11><IMG height=14 src="image/m3.gif" 
    width=11></TD></TR></TBODY></TABLE>
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=8 cellSpacing=0 bgcolor="#FFFFFF">
  <TBODY>
  <TR align=middle bgColor=#e6e6e6>
    <TD height=1></TD></TR>
  <TR align=middle>
    <TD height=50><FONT color=#333333>
      Powered by <?=$cfg_site_name?> <?=$cfg_copyright?> <br>网站制作：<?=$cfg_webmaster?>
    </FONT></TD></TR>
  <TR align=middle>
    <TD height=30><FONT color=#000000> 
</FONT></TD>
  </TR></TBODY></TABLE>