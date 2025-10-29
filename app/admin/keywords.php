<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
   if($_REQUEST['action']=="refresh") { 
    if($_REQUEST['infor_class']=="a") {  
	 mysql_query("delete from ".$table_suffix."keywords where infor_class='a'");
	 $query="select keywords from ".$table_suffix."infor_index";
	 $result=mysql_query($query);
	 while($row=mysql_fetch_object($result)) {
	    $keywords=$row->keywords;
		$keywords=explode(" ",$keywords);
		for($i=0;$i<count($keywords); $i++) {
			$keywords[$i]=trim($keywords[$i]);
		    if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9]+$/", $keywords[$i]))    mysql_query("insert into  ".$table_suffix."keywords (keywords,infor_class) values ('{$keywords[$i]}','a')"); 
		   }
		} 
	 }
     elseif($_REQUEST['infor_class']=="b") {  
	 mysql_query("delete from ".$table_suffix."keywords where infor_class='b'");
	 $query="select keywords from ".$table_suffix."member_blog";
	 $result=mysql_query($query);
	 while($row=mysql_fetch_object($result)) {
	    $keywords=$row->keywords;
		$keywords=explode(" ",$keywords);
		for($i=0;$i<count($keywords); $i++) {
			$keywords[$i]=trim($keywords[$i]);   
			if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9]+$/", $keywords[$i]))   mysql_query("insert into  ".$table_suffix."keywords (keywords,infor_class) values ('{$keywords[$i]}','b')"); 
		   }
		} 
	 }
   
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>文档管理</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if($_REQUEST['infor_class']=="b") echo "bgcolor=\"#FFFFFF\""?>>
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b"><a href="?infor_class=b">博客标签</a></div>
                    </div></td>
                  </tr>
              </table></td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        </table></td>
        <td><table  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>
                <table width="100%" height="27"  border="0" cellpadding="0" cellspacing="0" <?php if($_REQUEST['infor_class']=="a") echo "bgcolor=\"#FFFFFF\""?>>
                  <tr>
                    <td width="80" valign="bottom"><div class="bigtext_b">
                        <div align="center" class="bigtext_b"><a href="?infor_class=a">文章标签</a></div>
                    </div></td>
                  </tr>
              </table></td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<br>
<table width="100%"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>热门标签列表</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
	<?php 
	$query="SELECT keywords,count(keywords) as key_time FROM  ".$table_suffix."keywords  where infor_class='{$_REQUEST['infor_class']}'  GROUP BY keywords  ORDER BY key_time DESC";
	$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	$per_page_num=50;
	$rows=@mysql_query($query); 
	$num=@mysql_num_rows($rows);
	$page=intval(($num-1)/$per_page_num)+1;
	if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	$page_front=($page_id<=1)?1:($page_id-1); 
	$page_behind=($page_id>=$page)?$page:($page_id+1); 
	@mysql_data_seek($rows, ($page_id-1)*$per_page_num);
	for($i=1;$i<=$per_page_num;$i++)
		   { if($row=@mysql_fetch_object($rows)){ 
	echo "<a href=\"../similar_infor.php?infor_class=".$_REQUEST['infor_class']."&keywords=".urlencode($row->keywords)." \" target=_blank style=\"text-decoration:underline;\">".$row->keywords."</a>(".$row->key_time.") ";
	 }
	}
	?>
	</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100"><div align="center"><a href="?action=refresh&infor_class=b" style="text-decoration:underline">更新博客标签</a></div></td>
    <td width="100"><div align="center"><a href="?action=refresh&infor_class=a" style="text-decoration:underline">更新文章标签</a></div></td>
    <td>(注意:更新将会重新写关键字表,为前台搜索服务) </td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td width="50%"><div align="right">第<?=$page_id?>页/共<?=$page?>页(<?=$num?>条记录)</div></td>
    <td><div align="center">
      <table border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php require_once("function/page_divide.php"); ?></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>
</html>
