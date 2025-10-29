<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once(dirname(__FILE__)."/inc/show_msg.php");?>
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
    <TD vAlign=top><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
      <TBODY>
        <TR>
          <TD class=nav>您现在的位置:<a href="./">首页</a> > 内容搜索 </TD>
        </TR>
      </TBODY>
    </TABLE></TD>
  </TR>
  <TR>
    <TD height=200 vAlign=top><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="34" background=image/sbg.gif><?php require_once("inc/search_form.php");?></td>
      </tr>
    </table>      
      <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
          </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="181" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD">
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
          <td width="10" valign="top"></td>
          <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td>搜索结果列表</td>
            </tr>
          </table>            <table width="100%" border="0" cellpadding="10" cellspacing="1" bgcolor="#DDDDDD">
      <tr>
        <td bgcolor="#FFFFFF">
		<?php 
		if(!isset($_REQUEST["sub_search"]))   ShowMsg("无效的访问!",-1); 
		elseif(!isset($_REQUEST["search_class"]))   ShowMsg("无效的访问!",-1); 
		else { 
		 $search_class=explode(":",$_REQUEST['search_class']);
		 $keyword=trim($_REQUEST['keyword']);
		 if(empty($search_class)) { ShowMsg("无效的访问!",-1);  exit;}
		 elseif(empty($keyword)) { ShowMsg("无效的访问!",-1);  exit;}
		 
		 if($search_class[0]<>"all")  $string1="infor_class='{$search_class[0]}'"; else $string1="1=1";
		 if($search_class[1]<>"all")  $string2="class_id={$search_class[1]}"; else $string2="1=1";
		 
		 $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	     $per_page_num=20;
		 
		 $query="select * from ".$table_suffix."infor_index where article_title like '%$keyword%'  and $string1 and $string2 and hide_type='0' order by post_time desc";
		 $rows=@mysql_query($query); 
		 $num=@mysql_num_rows($rows);
		 
		 if(!$num)  echo "没有找到记录";
		 
		 else {	
		 $page=intval(($num-1)/$per_page_num)+1;
	     if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	     $page_front=($page_id<=1)?1:($page_id-1); 
	     $page_behind=($page_id>=$page)?$page:($page_id+1); 
	     @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
	   
	     for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows)){  
		  $content=mysql_result(mysql_query("select * from ".$table_suffix.$row->infor_class." where id={$row->infor_id}"),0,"content");
		 ?>
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td><font color="#CC6633" style="font-size:15px; "><strong><?=$i+($page_id-1)*$per_page_num?></strong></font> <a href="show_<?=$row->infor_class?>.php?id=<?=$row->infor_id?>" target="_blank"  style="color:#000099; font-size:15px; text-decoration:underline;"><strong>
               <?=$row->article_title?></strong></a></td>
           </tr>
           <tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;<?=msubstr(strip_tags($content),0,300)?>...</td>
           </tr>
         </table>
		 <table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td background="image/dash_line.jpg"></td>
           </tr>
         </table>		 <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td></td>
           </tr>
         </table>		 <?php }
		    }
		  }
		 }  
		?>
         <TABLE height=43 cellSpacing=0 cellPadding=4 width="100%" align=center border=0>
           <TBODY>
             <TR>
               <TD class=pagesinfo width=300>&nbsp;</TD>
               <TD class=pages align=right><table border="0" align="right" cellpadding="0" cellspacing="0">
                   <tr>
                     <td><div align="center">
                         <?php  require_once("inc/page_divide.php");?>
                     </div></td>
                   </tr>
               </table></TD>
             </TR>
           </TBODY>
         </TABLE></td>
      </tr>
    </table></td>
        </tr>
      </table> 
	 </TD>
  </TR>
  </TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>