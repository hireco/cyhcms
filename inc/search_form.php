<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <FORM name=search action=search.php method="GET">
              <TR>
                <TD class=fontw align=middle width=80>Ƶ������:</TD>
                <TD>
				  <INPUT name=keyword class=input id="keyword" size=38>
				  <select name="search_class" id="search_class">
                  <?php if(isset($infor_class))  { ?>
				  <option value="<?php echo $infor_class.":".$_REQUEST['class_id']; ?>">������Ƶ��</option>
                  <?php } ?>
				  <option value="article:all">��������</option>
				  <option value="album:all">����ͼƬ</option>
				  <option value="ftp:all">��������</option>
				  <option value="soft:all">�������</option>
				  <option value="all:all">����ȫվ</option>
                </select>
                <INPUT name=sub_search type=submit class=button id="sub_search" value=���� onClick="return check_search();"> 
              </TD></TR></FORM></TABLE>
<script>
function check_search() { 
 if(document.all.keyword.value=="") {
 alert("��������������");
 return false; 
  }
}
</script>