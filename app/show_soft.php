<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/main_fun.php");?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); ?>
<?php 
  $soft_id=$_REQUEST['id'];
  $query="select * from ".$table_suffix."soft where id=$soft_id and hide_type='0'";
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
    <TD vAlign=top width=181 background=image/leftbg.gif height=186>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
          <TR>
            <TD>
              <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                <TBODY>
                  <TR>
                    <TD width=8></TD>
                    <TD>分类导航</TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE>
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
                  <td style="PADDING-LEFT: 10px; BORDER-BOTTOM: #d2d2d2 1px solid" ><div align="center">本栏目没有分类</div></td>
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
                  href="soft.php?class_id=<?=$row->id?>" 
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
      <TABLE width="100%" height=8 
      border=0 cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
        <TBODY>
          <TR>
            <TD align=middle></TD>
          </TR>
        </TBODY>
      </TABLE>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
          <TR>
            <TD>
              <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                <TBODY>
                  <TR>
                    <TD width=8></TD>
                    <TD>热门软件</TD>
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
			  $query="select * from ".$table_suffix."soft  order by read_times desc,top desc, top_time desc limit 0,6";
			  $result=mysql_query($query);
			 ?>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <?php while($row=mysql_fetch_object($result)) { ?>
                  <TR>
                    <TD align=middle width=22><IMG height=10 
                  src="image/dot1.gif" width=11></TD>
                    <TD height=21><A class=tList 
                  href="show_soft.php?id=<?=$row->id?>" 
                  target=_self><font color="<?=$row->title_color?>">
                      <?=msubstr($row->article_title,0,24)?>
                    </font></A></TD>
                  </TR>
                  <TR>
                    <?php } ?>
                    <TD background=image/line.gif colSpan=2 height=3></TD>
                  </TR>
                  <TR>
                    <TD background=image/line.gif colSpan=2 
              height=3></TD>
                  </TR>
                </TBODY>
              </TABLE>
              <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
                <TBODY>
                  <TR align=right>
                    <TD><A class=more 
                  href="djyd/class/?45.html"></A></TD>
                  </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width=5 background=image/hline.gif></TD>
    <TD vAlign=top height=200>
	  <?php
	     $soft_id=$_REQUEST['id'];
         $query="select * from ".$table_suffix."soft where id=$soft_id and hide_type='0'";
	     $result=mysql_query($query);
         $num_of_soft=@mysql_num_rows($result); 
		 $row=mysql_fetch_object($result);
		 $infor_class="soft";
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
      <TABLE height=200 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD>
		  <?php           
	        if(!$num_of_soft) {
	      ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr align=middle>
          <td  height=70 ><?php ShowMsg("Sorry! 没有找到软件...",-1); ?></td>
        </tr>
      </table>
	  <?php }  else {     
	  ?>
		  <TABLE class=table height=50 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=show_soft_files/detailtitle.gif border=0>
        <TBODY>
        <TR>
          <TD align=middle width=10></TD>
          <TD><div align="center"><font color="<?=$row->title_color?>" style="font-size:20px; font-weight:<?=$row->title_bold=="1"?"bold":"normal"?>"><?=$row->article_title?></font>
            </div></TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD height=150>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR vAlign=top>
                <TD width="300" height=150><TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                  <TBODY>
                    <TR>
                      <TD class=downpropname align=middle width=80>文件名称:</TD>
                      <TD class=downprop><?=$row->article_title?></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>文件大小:</TD>
                      <TD class=downprop><?php 
								  $filesize=filesize(ereg_replace($cfg_mainsite,"",$row->saved_url))/1024.0;
								  if(empty($filesize)) echo "不详";
								  else { 
								  $filesize=explode(".",$filesize);
								  if($filesize[1]=="") $filesize[1]="0";
								  $filesize=$filesize[0].".".substr($filesize[1],0,1);
								  echo $filesize."k";
								  }
								  ?></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>文件类型:</TD>
                      <TD class=downprop><?=$row->file_type?>
                      </TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>上传时间:</TD>
                      <TD class=downprop><?=$row->post_time?></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>点击次数:</TD>
                      <TD class=downprop><?=$row->read_times?>
                        次</TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>软件类型:</TD>
                      <TD class=downprop><?=$soft_type[$row->soft_type]?>
                      </TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle width=80>运行环境:</TD>
                      <TD class=downprop><?=$os[$row->os]?></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle>软件语言:</TD>
                      <TD class=downprop><font color=red>
                        <?=$file_lang[$row->file_lang]?>
                      </font></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle>授权方式:</TD>
                      <TD class=downprop><font color=blue>
                        <?=$soft_right[$row->soft_right]?>
                      </font></TD>
                    </TR>
                    <TR>
                      <TD class=downpropname align=middle>官方地址:</TD>
                      <TD class=downprop><font color=blue>
                        <?=$row->official_url==""?"<font color=green>不详</font>":$row->official_url?>
                      </font></TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
                <TD height=150 align=center valign="middle"><div align="center">
                  <table border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td><?php if(strlen($row->saved_url)>7) echo "<a href=\"{$row->saved_url}\"><IMG  height=100 src=\"image/download.gif\" width=100 border=0></a>";  
					  else echo "<IMG height=100 src=\"image/download.gif\" width=100  border=0>"; ?> </td>
                    </tr>
                    <tr>
                      <td><div align="center" style="cursor:pointer"><?php if(strlen($row->saved_url)>7) echo "<a href=\"{$row->saved_url}\">本站下载</a>"; else echo "本站无下载"; ?></div></td>
                    </tr>
                  </table>
                </div></TD>
              </TR></TBODY></TABLE>
            <TABLE class=table height=30 cellSpacing=0 cellPadding=0 
            width="100%" align=center background=show_soft_files/detailtitle.gif 
            border=0>
              <TBODY>
              <TR>
                <TD align=middle width=10></TD>
              <TD width="547">文件简介</TD></TR></TBODY></TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR vAlign=top>
                <TD>
                  <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
                    <TBODY>
                    <TR vAlign=top>
                      <TD class=downintro colSpan=2  id="con"
                  height=30><span class="downprop">
                        <?=$row->content?>
                      </span></TD>
                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE class=table height=30 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=show_soft_files/detailtitle.gif border=0>
        <TBODY>
        <TR>
          <TD align=middle width=10></TD>
          <TD>更多下载地址:</TD>
        </TR></TBODY></TABLE>
       <TABLE cellSpacing=0 cellPadding=3 width="100%" border=0>
        <TBODY>
        <TR vAlign=top>
          <TD colSpan=2 bgcolor="#E9EEFE" class=downintro><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <?php if($row->file_links) { 
				   $url=explode(",",$row->file_links);
				   if(($row->file_links<>"")&&(count($url)<>0)) {
				   for($j=0;$j<count($url);$j++) { 
					$url_str=explode("*",$url[$j]);
				   ?>
				  <tr>
					<td width="90">地址<?=$j+1?>：</td>
					<td nowrap><a href="<?=$url_str[1]?>" target="_blank">
					<?=$url_str[1]?></a></td>
					<td><?=$url_str[0]?></td>
				  </tr>
           <?php } 
		      }
			} else echo "<TR><TD align=middle width=10></TD><TD>暂无地址</TD></TR>"; 
		    ?>
          </table></TD>
        </TR></TBODY></TABLE>		
      <table width="100%" height="20"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
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
	  </TD>
        </TR></TBODY></TABLE>
      </TD>
  </TR></TBODY></TABLE>

<?php   require_once("footer.php"); ?>
</body>
</html>
