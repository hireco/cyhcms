<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<TABLE height=31 cellSpacing=0 cellPadding=0 width=100% 
      background=image/lefttitle1.gif border=0>
        <TBODY>
        <TR>
          <TD width=20>&nbsp;</TD>
<TD>推荐物理站点</TD></TR></TBODY></TABLE>
      <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE height=90 cellSpacing=1 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top align=middle><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">
					  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="13"></td>
                        </tr>
                      </table>
				<?php
			    $query="select * from ".$table_suffix."link  where link_type='l' and checked='1' order by top_time desc limit 0,6";
		        $rows=mysql_query($query);
				if(mysql_num_rows($rows)) {
                ?>
					  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="14">&nbsp;</td>
                          <td><TABLE width="94%" border=0 align=center cellPadding=1 cellSpacing=1>
                                      <TBODY>
                                        <?php while($row=mysql_fetch_object($rows)){ ?>
                                        <TR>
                                          <TD align="center"><div align="center">
                                              <table  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                                                <tr>
                                                  <td bgcolor="#F7FBFF"><div align="center"><a href="<?=$row->url?>" target=_blank><img src="<?=$row->logo?>" width="130" border="0"></a></div></td>
                                                </tr>
                                            </table>
                                          </div></TD>
                                        </TR>
                                        <?php }?>
                                      </TBODY>
                                    </TABLE></td>
                          <td width="14">&nbsp;</td>
                        </tr>
                      </table>
					  <?php } ?>
				    </td>
                  </tr>
                </table></td>
              </tr>
          </table>
		 </TD>
        </TR></TBODY></TABLE>