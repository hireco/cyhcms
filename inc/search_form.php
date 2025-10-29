<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <FORM name=search action=search.php method="GET">
              <TR>
                <TD class=fontw align=middle width=80>频道搜索:</TD>
                <TD>
				  <INPUT name=keyword class=input id="keyword" size=38>
				  <select name="search_class" id="search_class">
                  <?php if(isset($infor_class))  { ?>
				  <option value="<?php echo $infor_class.":".$_REQUEST['class_id']; ?>">搜索此频道</option>
                  <?php } ?>
				  <option value="article:all">搜索文章</option>
				  <option value="album:all">搜索图片</option>
				  <option value="ftp:all">搜索资料</option>
				  <option value="soft:all">搜索软件</option>
				  <option value="all:all">搜索全站</option>
                </select>
                <INPUT name=sub_search type=submit class=button id="sub_search" value=搜索 onClick="return check_search();"> 
              </TD></TR></FORM></TABLE>
<script>
function check_search() { 
 if(document.all.keyword.value=="") {
 alert("请输入搜索内容");
 return false; 
  }
}
</script>