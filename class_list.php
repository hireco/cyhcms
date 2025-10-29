<?php require_once("config/base_cfg.php");?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php");?>
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
    <TD vAlign=top height=200><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
      <TBODY>
        <TR>
          <TD class=nav>您现在的位置: <a href="./">首 页</a> &gt; 全站搜索</TD>
        </TR>
      </TBODY>
    </TABLE>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="34" background=image/sbg.gif><?php require_once("inc/search_form.php");?></td>
      </tr>
      <tr>
        <td>
		<table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td></td>
          </tr>
        </table>
		<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#DDDDDD">
              <tr>
                <td bgcolor="#FFFFFF"><?php 
		  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	      $per_page_num=10;
		  $list_for=isset($_REQUEST['list_for'])?$_REQUEST['list_for']:"最新文章";
		  $query="select * from ".$table_suffix."infor_index  where hide_type='0' order by {$show_turn[$list_for]}";
		  $rows=@mysql_query($query); 
		  $num=@mysql_num_rows($rows);
		  if($num) {
		  $page=intval(($num-1)/$per_page_num)+1;
	      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	      $page_front=($page_id<=1)?1:($page_id-1); 
	      $page_behind=($page_id>=$page)?$page:($page_id+1); 
	      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
		  ?>
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <?php    
		  for($i=1;$i<=$per_page_num;$i++)
		   { if($row=@mysql_fetch_object($rows)){ 
		    $query="select * from  ".$table_suffix.$row->infor_class." where id={$row->infor_id}";
		    $result=mysql_query($query);
			$pen_name=mysql_result($result,0,"pen_name");
			$content="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".msubstr(strip_tags(mysql_result($result,0,"content")),0,200);
		    
			$query="select id from ".$table_suffix."comment where infor_class='{$row->infor_class}' and hide='0' and infor_id={$row->infor_id}";
	        $result_comment=mysql_query($query);
	        $num_of_comment=mysql_num_rows($result_comment);
		   ?>
                    <tr>
                      <td colspan="5"><img src="image/ico_2.gif" width="10" height="9" border="0" align="absmiddle"> <a href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" target="_blank" style="text-decoration:underline; font-size:14px;"> <font color="#333399"><strong>
                        <?=$row->article_title?>
                      </strong></font></a></td>
                    </tr>
                    <tr>
                      <td colspan="5"><font color="#666666">
                        <?=$content?>
                        ... </font></td>
                    </tr>
                    <tr>
                      <td width="100"><span class="fonts"> 作者：<font color="#FF9933">
                        <?=$pen_name?>
                      </font></span></td>
                      <td width="200" class="fonts">发表于：<font color="#FF9933">
                        <?="20".$row->post_time?>
                      </font></td>
                      <td width="80" class="fonts">点击：<font color="#FF9933">
                        <?=$row->read_times?>
                      </font></td>
                      <td width="80" class="fonts">评论：<font color="#FF9933">
                        <?=$num_of_comment?>
                      </font></td>
                      <td><div align="right"><a href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" style="text-decoration:underline"><font color="#333399">查看全文</font></a></div></td>
                    </tr>
                    <tr>
                      <td height="20" colspan="5"><table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td background="image/dash_line.jpg"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <?php  }
		   }
		?>
                  </table>
                  <?php  require_once("inc/page_divide.php");
	 } 
    else { ShowMsg("没有找到记录!",-1); echo "<br>"; } 
 ?></td>
              </tr>
            </table></td>
            <td width="10" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td width="181" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD">
              <tr>
                <td bgcolor="#FFFFFF"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                  <TBODY>
                    <TR>
                      <TD vAlign=top background="image/tbg.jpg"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td><strong>热点推荐</strong></td>
                        </tr>
                        <tr>
                          <td height="1" bgcolor="#DDDDDD"></td>
                        </tr>
                      </table></TD>
                    </TR>
                    <TR>
                      <TD vAlign=top>
                        <?php
			  $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['点击排行']." limit 0,10";
			  $result=mysql_query($query);
			 ?>
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                            <?php while($row=mysql_fetch_object($result)) { ?>
                            <TR>
                              <TD align=middle width=22><IMG 
                  src="image/dot1.gif" width=11 height=10 align="left"></TD>
                              <TD height=21><A class=tList 
                  href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" 
                  target=_self style="text-decoration:underline;"><font color="#333399">
                                <?=msubstr($row->article_title,0,24)?>
                              </font></A></TD>
                            </TR>
                            <?php } ?>
                          </TBODY>
                      </TABLE></TD>
                    </TR>
                  </TBODY>
                </TABLE></td>
              </tr>
            </table>
              <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD">
                <tr>
                  <td bgcolor="#FFFFFF"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD vAlign=top background="image/tbg.jpg"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                              <tr>
                                <td><strong>最新动态</strong></td>
                              </tr>
                              <tr>
                                <td height="1" bgcolor="#DDDDDD"></td>
                              </tr>
                          </table></TD>
                        </TR>
                        <TR>
                          <TD vAlign=top>
                            <?php
			  $query="select * from ".$table_suffix."infor_index  order by ".$show_turn['最新文章']." limit 0,10";
			  $result=mysql_query($query);
			 ?>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                              <TBODY>
                                <?php while($row=mysql_fetch_object($result)) { ?>
                                <TR>
                                  <TD align=middle width=22><IMG 
                  src="image/dot1.gif" width=11 height=10 align="left"></TD>
                                  <TD height=21><A class=tList 
                  href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" 
                  target=_self style="text-decoration:underline;"><font color="#333399">
                                    <?=msubstr($row->article_title,0,24)?>
                                  </font></A></TD>
                                </TR>
                                <?php } ?>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                  </TABLE></td>
                </tr>
              </table>
			  <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td></td>
                </tr>
              </table>
			  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DBDBDB">
                <tr>
                  <td bgcolor="#FFFFFF">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td background="image/tbg.jpg"><strong>栏目导航</strong></td>
                      </tr>
                      <tr>
                        <td height="1" bgcolor="#DDDDDD"></td>
                      </tr>
                    </table>
                    <TABLE width="100%" height=27 
              border=0 align=center cellPadding=0 cellSpacing=0>
                      <TBODY>
                        <?php 
			  $query="select * from ".$table_suffix."infor where hide_type='0' and class_level='0' order by top desc,top_time desc";  
              $result=mysql_query($query);
		      while($row=mysql_fetch_object($result)) { ?>
                        <TR>
                          <TD class=smenuv noWrap align=middle  height=30>
                            <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                              <?=$row->class_name?>
                          </A></div></TD>
                          <?php if($row=mysql_fetch_object($result))  { ?>
                          <TD class=smenuv noWrap align=middle  height=30>
                            <div align="center"><A class=smenuv 
                  href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" 
                  target=_self>
                              <?=$row->class_name?>
                          </A></div></TD>
                          <?php } ?>
                        </TR>
                        <?php } ?>
                      </TBODY>
                    </TABLE></td>
                </tr>
              </table></td>
          </tr>
        </table>		 </td>
      </tr>
    </table>
    </TD>
  </TR></TBODY></TABLE>
<?php   require_once("footer.php"); ?>
</body>
</html>