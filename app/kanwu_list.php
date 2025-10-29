<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php  require_once(dirname(__FILE__)."/inc/kanwu_set.php");　?>
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
<TABLE width=<?=$cfg_body_width?> border=0 align=center cellPadding=0 cellSpacing=0 
background=image/centerbg.gif>
  <TBODY>
  <TR>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./">首页</a> &gt; <?=$kanwu?> > 列表</TD>
        </TR></TBODY></TABLE>
	  <TABLE class=table height=26 cellSpacing=0 cellPadding=0 
            width="100%" background=image/tbg.jpg border=0>
        <TBODY>
          <TR>
            <TD align=middle width=35><IMG height=12 
                  src="image/sp.gif" width=5></TD>
            <TD class=fontg>
              <P>&nbsp;</P></TD>
            <TD class=fontg align=middle 
            width=50>&nbsp;</TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE width="100%" height=120 
              border=0 cellPadding=3 cellSpacing=1 bgcolor="#DDDDDD">
        <TBODY>
          <TR>
            <TD vAlign=top bgcolor="#FFFFFF">
              <TABLE cellSpacing=0 cellPadding=5 width="100%" border=0>
                <TBODY>
                  <?php 
				      $kanwu_col=explode(",",$default_set);
					  $query="select * from ".$table_suffix."infor_index where class_id={$kanwu_col[1]}  and infor_class='{$kanwu_col[0]}' order by top desc, top_time desc";
                      $rows=mysql_query($query);
					  $i=0;
					  while($row=mysql_fetch_object($rows)){ 
					    $string_sql[$i]=$kanwu_col[0].":".$row->infor_id;
					    $i++;
					   }
					  $string=explode(",",$string);
					  $string=array_unique(array_merge($string,$string_sql));
					  
					  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
                      $per_page_num=16;
                      $rows=@mysql_query($query);
                      $num=count($string);
                      $page=intval(($num-1)/$per_page_num)+1;
                      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
                      $page_front=($page_id<=1)?1:($page_id-1); 
                      $page_behind=($page_id>=$page)?$page:($page_id+1); 
					  $j=($page_id-1)*$per_page_num;
					  $k=0;
					  for($i=$j;$i<$j+$per_page_num;$i++){
					  if($string[$i]){					  
					  $string_j=explode(":",$string[$i]);
					  $result=mysql_query("select article_title, post_time,pic_id from ".$table_suffix.$string_j[0]." where id={$string_j[1]} order by top desc, top_time desc");
					  $row=mysql_fetch_object($result);
					  $pic_id=$row->pic_id; 
                      $pic_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
                      $pic_row=mysql_fetch_object($pic_result);
					  if($k%5==0) echo "<TR>";
					 ?>
                <TD class=cpquery align=middle>
                    <?php 
						    $width=64;
					        $height=64*$cfg_artsimg_height/$cfg_artsimg_width;
						  ?>
                    <TABLE class=table cellSpacing=0 cellPadding=5 
                  border=0>
                      <TBODY>
                        <TR>
                          <TD bgColor=#f0f0f0>
                            <TABLE cellSpacing=1 cellPadding=1 
                        align=center bgColor=#e5e5e5 border=0>
                              <TBODY>
                                <TR>
                                  <TD width=<?=$width+2?> height=<?=$height?> align=middle valign="bottom" bgColor=#ffffff ><?php 
							  $pic_url=get_small_img($pic_row->pic_url,$pic_row->small_pic);
							  if($pic_url<>"") {?>
                                      <A 
                              href="show_<?=$string_j[0]?>.php?id=<?=$string_j[1]?>" 
                              target=_self><IMG height=<?=$height?> alt="<?=$row->article_title?>"
                              src="<?=$pic_url?>" width=<?=$width?> 
                              border=0></A>
                                      <?php }  else { ?>
                                      <table width=<?=$width?> height=<?=$height?> border=0 align="center" cellpadding=0 cellspacing=0>
                                        <tr><TD vAlign=middle align=middle >
                                        <DIV class=date>
                                        <DIV class=weekday><?=date_of_week(date("w", strtotime("20".substr($row->post_time,0,8))))?></DIV><?=substr($row->post_time,6,2)?></DIV>
										</TD></tr>
                                      </table>
                                      <?php } ?></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                        <TR>
                          <TD align=middle bgColor=#f0f0f0><SPAN 
                        class=pictitle><A 
                              href="show_<?=$string_j[0]?>.php?id=<?=$string_j[1]?>" 
                              target=_self>
                            <?=$row->article_title==""?substr($row->post_time,3,11):msubstr($row->article_title,0,12)?>
                          </A></SPAN></TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                    <?php 
					      if($k%5==4) echo "</TR>"; $k++;
						 }
						}
					  ?>
              </TABLE>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <TR align=right>
                    <TD><A class=more 
                        href="news/class/?1.html"></A></TD>
                  </TR>
                </TBODY>
              </TABLE>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp; </td>
                  <td><div align="right">
                      <?php  require_once("inc/page_divide.php");?>
                  </div></td>
                  <td width="30">&nbsp;</td>
                </tr>
            </table></TD>
          </TR>
      </TABLE></TD></TR></TBODY></TABLE>
	  <?php   require_once("footer.php"); ?>
</body>
</html>
