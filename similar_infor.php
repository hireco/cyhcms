<?php session_start(); ?>
<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
</head>
<body>
<?php  require_once("header.php"); ?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width=181 height=186 valign="top" background=image/leftbg.gif><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
            <TBODY>
              <TR>
                <TD>
                  <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                    <TBODY>
                      <TR>
                        <TD width=8></TD>
                        <TD>最新会员</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top>
				<?php 
			    $query="select * from ".$table_suffix."member  order by register_time desc, recommend desc limit 0, 10";
		        $result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
			  ?>
			  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                <TBODY>
                  <TR>
                    <TD class=piclist align=middle>
                      <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                        <TBODY>
                          <TR>
                            <TD vAlign=top width=70 style="line-height:110%;"><a href="user_infor.php?host_id=<?=$row_list->id?>&idkey=<?=md5($row_list->user_name)?>" style="text-decoration:underline"><?=$row_list->nick_name?></a></TD>
                            <TD vAlign=top style="line-height:100%;"><div align="right">
                              <?=substr($row_list->register_time,3,11)?>
                            </div></TD>
                          </TR>
                        </TBODY>
                      </TABLE>
                      <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                        <TBODY>
                          <TR>
                            <TD colSpan=2 height=4></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
              </TABLE>
			  <?php } ?></TD>
                </TR>
              </TBODY>
            </TABLE>
            <table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D2D2D1">
              <tr>
                <td></td>
              </tr>
            </table>            <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
              <TBODY>
                <TR>
                  <TD>
                    <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                      <TBODY>
                        <TR>
                          <TD width=8></TD>
                          <TD>最新日志</TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                </TR>
              </TBODY>
            </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top><?php 
			    $query="select * from ".$table_suffix."member_blog  where blog_class='rizhi' order by post_time desc limit 0, 10";
		        $result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
			  ?>
                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD class=piclist align=middle>
                            <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD vAlign=top width=70 style="line-height:130%;"><a href="user_infor.php?view=rizhi&infor_id=<?=$row_list->id?>&idkey=<?=md5($row_list->user_name)?>" style="text-decoration:underline">
                                    <?=$row_list->infor_title?>
                                  </a></TD>
                                  <TD vAlign=top style="line-height:100%;"><div align="right">
                                      <?=substr($row_list->post_time,3,11)?>
                                  </div></TD>
                                </TR>
                              </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD colSpan=2 height=4></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  <?php } ?> </TD>
                </TR>
              </TBODY>
            </TABLE>
            <table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D2D2D1">
              <tr>
                <td></td>
              </tr>
            </table>            
			<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>
            <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
              <TBODY>
                <TR>
                  <TD>
                    <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
                      <TBODY>
                        <TR>
                          <TD width=8></TD>
                          <TD>会员相册</TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                </TR>
              </TBODY>
            </TABLE>
            <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
              <TBODY>
                <TR>
                  <TD vAlign=top><?php 
			    $width=50; 
			    $height=50*$cfg_memsimg_height/$cfg_memsimg_width; 
			    $query="select * from ".$table_suffix."picture  where object_class='member' and hide='0' order by object_id desc limit 0, 20";
				$result_list=mysql_query($query);
				while($row_list=mysql_fetch_object($result_list)) { 
				$pic_url=get_small_img($row_list->pic_url,$row_list->small_pic);
				$user_name=mysql_result(mysql_query("select user_name from ".$table_suffix."member_blog where id={$row_list->object_id}"),0,"user_name"); 
			  ?>
                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TBODY>
                        <TR>
                          <TD class=piclist align=middle>
                            <TABLE cellSpacing=0 cellPadding=1 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD vAlign=top width="50%"><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$row_list->object_id?>&idkey=<?=md5($user_name)?>" style="text-decoration:underline"><img name="" src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="" border="1" style="border:1px solid #000;"></a></div></TD>
                                  <?php if($row_list=mysql_fetch_object($result_list)) { 
								  $pic_url=get_small_img($row_list->pic_url,$row_list->small_pic);  
								  $user_name=mysql_result(mysql_query("select user_name from ".$table_suffix."member_blog where id={$row_list->object_id}"),0,"user_name"); 
								  ?>
								  <TD vAlign=top><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$row_list->object_id?>&idkey=<?=md5($user_name)?>" style="text-decoration:underline"><img name="" src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="" border="1" style="border:1px solid #000;"></a></div></TD></TR>
                                  <?php } else echo "<TD></TD>"; ?>
							  </TBODY>
                            </TABLE>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                              <TBODY>
                                <TR>
                                  <TD colSpan=2 height=4></TD>
                                </TR>
                              </TBODY>
                          </TABLE></TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  <?php } ?> </TD>
                </TR>
              </TBODY>
            </TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; 内容搜索</TD>
              </TR>
            </TBODY>
          </TABLE>
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="form1" method="post" action="" style="margin-top:0px; margin-bottom:0px;">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td width="200"><div align="center">输入关键字(标签)搜索</div></td>
                      <td width="160"><input name="keywords" type="text" class="INPUT" id="keywords" style="width:160px;">                      </td>
                      <td><select name="infor_class" class="INPUT" id="infor_class">
                        <option value="b" <?php if($_REQUEST['infor_class']=="b") echo "selected";?>>博客</option>
                        <option value="a" <?php if($_REQUEST['infor_class']=="a") echo "selected";?>>文章</option>
                      </select></td>
                      <td><input name="Submit" type="submit" class="INPUT" value="搜  索" onClick="return check_form();"></td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table>
			<table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td>热门标签:<?php 
				if(!isset($_REQUEST['infor_class'])) $_REQUEST['infor_class']="b";
				$query="SELECT keywords,count(keywords) as key_time FROM  ".$table_suffix."keywords  where infor_class='{$_REQUEST['infor_class']}'  GROUP BY keywords  ORDER BY key_time DESC limit 0, 10";
				$result=mysql_query($query);
				if(!@mysql_num_rows($result)) echo "暂无热门标签";
				else { 
				while($row=mysql_fetch_object($result)) echo "<a href=\"?infor_class=".$_REQUEST['infor_class']."&keywords=".urlencode($row->keywords)." \" style=\"text-decoration:underline;\">".$row->keywords."</a> ";
				}
				?>
               </td>
              </tr>
            </table>
			<?php  
			    $keywords=trim($_REQUEST["keywords"]); 
				if(empty($keywords)) ShowMsg("无效的访问",-1); else {  
				if($_REQUEST['infor_class']=="b")	$query="select * from ".$table_suffix."member_blog where keywords like '%$keywords%' order by post_time desc";
				else $query="select * from ".$table_suffix."infor_index where keywords like '%$keywords%' order by post_time desc";
				$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				$per_page_num=25;
				$rows=@mysql_query($query); 
				$num=@mysql_num_rows($rows);
				$page=intval(($num-1)/$per_page_num)+1;
				if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
				$page_front=($page_id<=1)?1:($page_id-1); 
				$page_behind=($page_id>=$page)?$page:($page_id+1); 
				@mysql_data_seek($rows, ($page_id-1)*$per_page_num);  ?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td><div align="left">搜索结果</div></td>
                <td><div align="right">共找到<?=$num?>条记录</div></td>
              </tr>
            </table>		    
            <table width="100%" height="7"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td background="image/dash_line.jpg"></td>
              </tr>
            </table>
			<table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
			 <?php 
			   if($_REQUEST['infor_class']=="b") {
			   for($i=1;$i<=$per_page_num;$i++)
					   { if($row=@mysql_fetch_object($rows)){  
			   $infor_title=$row->infor_title;
	           $post_time=$row->post_time;
			   $blog_class=$row->blog_class;
			   $user_name=$row->user_name;
			   
	          ?>
         <tr>
        <td><div align="left" class="fonts"><a href="user_infor.php?view=<?=$blog_class?>&infor_id=<?=$row->id?>&idkey=<?=md5($user_name)?>" style="color:#3366CC; text-decoration:underline">
          <?=$infor_title?></a> <?php if($blog_class=="album") { ?> <img src="image/album_ico.gif" width="18" height="12" align="absmiddle">
          <?php } ?>(<?=$post_time?>)</div></td>
      </tr>
				<?php } 
	               }
				  }
			  else {
			  for($i=1;$i<=$per_page_num;$i++)
					   { if($row=@mysql_fetch_object($rows)){  
			   $article_title=$row->article_title;
	           $post_time=$row->post_time;
			   $infor_class=$row->infor_class;
			   
	          ?>
         <tr>
        <td><div align="left" class="fonts"><a href="show_<?=$infor_class?>.php?id=<?=$row->infor_id?>" style="color:#3366CC; text-decoration:underline">
          <?=$article_title?></a> <?php if($infor_class=="album") { ?> <img src="image/album_ico.gif" width="18" height="12" align="absmiddle">
          <?php } ?>(<?=$post_time?>)</div></td>
      </tr>
				<?php } 
	               }
			  }  
			 ?> </table>
	<br>
	<?php  require_once("inc/page_divide.php"); ?>
	            </td>
              </tr>
            </table>
			<?php } ?>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php"); ?>
</body>
</html>
<script>
function check_form() {
 if(document.form1.keywords.value=="") {
   alert("请填写搜索内容!");
   document.form1.keywords.focus();
   return false;
  }
  return true;
}
</script>
