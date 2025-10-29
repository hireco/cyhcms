<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/often_function.php");?>
<?php require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<?php 
      $id=$_REQUEST['id'];
	  $query="select * from ".$table_suffix."zhuanti where id=$id and hide_type='0' order by top desc, top_time desc";
	  $result=mysql_query($query);	 
	  $row=mysql_fetch_object($result);
      $article_title=$row->article_title;  
	  $keywords=$row->keywords;
      $abstract=$row->abstract;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title; if($article_title) echo " - ".$article_title;?></title>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$abstract?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
</head>
<body onLoad="resizeImages(<?=$cfg_body_width?>);">
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
                <TD>分类导航</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=179 align=center 
      border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <?php 
			    $query="select * from ".$table_suffix."infor where upper_class_id=$class_id";
                $result=mysql_query($query); 
				if(!@mysql_num_rows($result)) {
			?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td><div align="center">本栏目没有分类</div></td>
                </tr>
              </table>
              <?php } ?>
              <TABLE cellSpacing=0 cellPadding=3 width="100%" border=0>
                <TBODY>
                  <?php 
			    $id_list=$class_id;
				while($row=mysql_fetch_object($result)) {
			    $id_list.=",".$row->id;
			  ?>
                  <TR class=list>
                    <TD style="PADDING-LEFT: 10px; BORDER-BOTTOM: #d2d2d2 1px solid" 
                width="100%" height=27><IMG height=14 
                  src="image/items.gif" width=16> <A class=class 
                  href="article.php?class_id=<?=$row->id?>" 
                  target=_self>
                      <?=$row->class_name?>
                    </A>&nbsp; </TD>
                  </TR>
                  <?php } ?>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
	  <TABLE height=1 cellSpacing=0 cellPadding=0 width="100%" bgColor=#d2d2d2 
      border=0>
        <TBODY>
        <TR>
        <TD></TD></TR></TBODY></TABLE>
      <TABLE width="100%" height=8 
      border=0 cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
        <TBODY>
        <TR>
      <TD align=middle></TD></TR></TBODY></TABLE>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
          <TR>
            <TD>
              <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                <TBODY>
                  <TR>
                    <TD width=8></TD>
                    <TD>专题排行</TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=90 cellSpacing=5 cellPadding=0 width="100%" border=0>
        <TBODY>
          <TR>
            <TD vAlign=top>
              <?php
			  $query="select * from ".$table_suffix."zhuanti  order by read_times desc,top desc, top_time desc limit 0,6";
			  $result=mysql_query($query);
			 ?>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <?php while($row=mysql_fetch_object($result)) { ?>
                  <TR>
                    <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                    <TD height=21><A class=tList 
                  href="show_zhuanti.php?id=<?=$row->id?>" 
                  target=_self><font color="<?=$row->title_color?>">
                      <?=msubstr($row->article_title,0,24)?>
                    </font></A></TD>
                  </TR>
				  <TR>
                    <TD background=image/line.gif colSpan=2 height=3></TD>
                  </TR>
                    <?php } ?>
                </TBODY>
              </TABLE>
              </TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
	 <?php 	   
	  $id=$_REQUEST['id'];
	  $query="select * from ".$table_suffix."zhuanti where id=$id and hide_type='0' order by top desc, top_time desc";
	  $result=mysql_query($query);
	  $num_of_zhuanti=@mysql_num_rows($result); 
	  $row=mysql_fetch_object($result);
	  $infor_class="zhuanti";
      $class_id=$row->class_id;
      $article_title=$row->article_title;
	 ?>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD class=nav>您现在的位置:
            <?php  echo "<a href=\"./\">首 页</a> "; require_once("inc/get_position.php"); ?></TD>
        </TR></TBODY></TABLE>
       <TABLE height=34 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/sbg.gif border=0>
        <TR>
          <TD>
            <?php require_once("inc/search_form.php"); ?></TD></TR></TABLE>
      <?php 
		    
			 if($num_of_zhuanti) { 
			 $query="select id from ".$table_suffix."comment where infor_class='zhuanti' and hide='0' and infor_id={$row->id}";
			 $result_comment=mysql_query($query);
			 $num_of_comment=mysql_num_rows($result_comment);
	  ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
		   <TABLE height=80 cellSpacing=1 cellPadding=0 width="100%" 
                  border=0>
            <TBODY>
              <TR>
                <TD style="PADDING-LEFT: 6px; PADDING-TOP: 6px" 
vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                    <TBODY>                     
                      <TR>
                        <TD height="40"><div align="center" class="newstitle">
                            <font color="<?=$row->title_color?>">
                            <?=$row->article_title?>
                            </font></div></TD>
                        </TR>
                      <TR>
                        <TD background=image/line.gif 
                            height=3> <div align="center">日期：<font color="#339966">20<?=$row->post_time?>
                          </font>&nbsp;&nbsp;点击：<font color="#CC3300">
                          <?=$row->read_times?>
                          </font>&nbsp;&nbsp;<a href="comment_list.php?infor_class=<?=$infor_class?>&id=<?=$row->id?>">评论</a>：
                          <?php if(!$num_of_comment) echo $num_of_comment; else echo "<a href=\"comment_list.php?infor_class=$infor_class&id=$row->id\">$num_of_comment</a>"; ?>
                        </div></TD>
                      </TR>
                      <TR>
                        <TD background=image/line.gif 
                            height=5></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
				  <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td></td>
                    </tr>
                  </table>				  
				  <TABLE cellSpacing=0 cellPadding=0 width="98%"   border=0>
                    <TBODY>
                      <TR>
                        <TD id="con">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->content?></TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
            </TBODY>
          </TABLE>
		  </td>
        </tr>
      </table>
      <br>
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
            <?php 
			 $query="select * from ".$table_suffix."zhuanti where id=$id and hide_type='0' order by top desc, top_time desc";
		     $result=mysql_query($query);
			 if($row=mysql_fetch_object($result)) { 
			 $archive_list=explode(";",$row->archive_list);
			 for($j=0;$j<count($archive_list);$j++) {
			 $list_object=explode("-",$archive_list[$j]);
			 ?>
			<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD vAlign=top><TABLE class=table height=26 cellSpacing=0 cellPadding=0 
                  width="100%" background=image/tbg.jpg border=0>
                  <TBODY>
                    <TR>
                      <TD align=middle width=35><IMG height=12 
                        src="image/sp.gif" width=5></TD>
                      <TD class=fontg><a href="zhuanti_node.php?id=<?=$id?>&node=<?=urlencode($list_object[0])?>">
                        <?=$list_object[0]?>
                      </a></TD>
                      <TD class=fontg align=middle 
                    width=50>&nbsp;</TD>
                    </TR>
                  </TBODY>
                </TABLE>
                  <TABLE class=table cellSpacing=1 cellPadding=0 
                  width="100%" border=0>
                    <TBODY>
                      <TR>
                        <TD vAlign=top><?php if($list_object[2]=="")  echo "该专题没有内容"; else { ?>
                            <TABLE cellSpacing=0 cellPadding=0 width="98%" 
                          border=0>
                              <TBODY>
                           <?php 
						   $list_of_article=explode(",", $list_object[2]);
						   for($k=0;$k<=count($list_of_article);$k++) {
						   $first_infor=explode(":",$list_of_article[$k]);
						   $infor_class=$first_infor[0];
						   $infor_id=$first_infor[1];
						   $query="select * from ".$table_suffix."infor_index  where infor_id=$infor_id and infor_class='$infor_class'";
						   $result=mysql_query($query);
						   $row=mysql_fetch_object($result);
						   if($row->article_title<>"") {
						   ?>
                           <TR>
                            <TD align=middle width=22><IMG height=9 
                              src="image/titledot.gif" width=9></TD>
                                  <TD height=21><A class=tList 
                              href="show_<?=$infor_class?>.php?id=<?=$row->infor_id?>" 
                              target=_self>
                                    <?=$row->article_title?>
                                  </A>&nbsp;</TD>
                            </TR>
							<TR>
                                  <TD background=image/line.gif colSpan=2 
                            height=3></TD>
                            </TR>
                            <?php } 
								 }
							 ?>
                              </TBODY>
                            </TABLE>
                            <?php } ?>
                        </TD>
                      </TR>
                    </TBODY>
                  </TABLE></TD>
                <?php if($row=mysql_fetch_object($result))  {?>
				<?php } ?>
              </TR></TBODY></TABLE>
            <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD></TD></TR></TBODY></TABLE>
            <TABLE height=5 cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD></TD></TR>
			</TBODY>
	   </TABLE>
	   <?php } 
	      }
	    ?>
       </TD></TR></TBODY></TABLE>
	   <?php $infor_class="zhuanti"; ?>
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
	   <BR><?php } else { ?>
		
		<table width="100%" height="200"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center">
              <?php ShowMsg("Sorry! 没有找到专题内容...",-1); ?>
            </div></td>
          </tr>
        </table>
		<?php } ?>
      </TD></TR></TBODY></TABLE>
<?php   require_once("footer.php"); ?>
</body>
</html>