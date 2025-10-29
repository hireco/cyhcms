<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td bgcolor="#EEF7F3"><strong>收藏列表</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#D5D5D5"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>
	        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?php  
				    $result_row=mysql_query("select distinct folder_name from ".$table_suffix."member_url where user_name='$host_name'");
					if(@mysql_num_rows($result_row)) {
				    ?>
					选择分类：<select name="folder_name" class="INPUT" onchange="location=this.value;">
					<?php 
					while($folder_row=@mysql_fetch_object($result_row)) {
					echo "<option ";
					echo "value=\"user_infor.php?view=url&view_class=".urlencode($folder_row->folder_name)."&host_id=".$host_id."&idkey=".$_REQUEST['idkey']."\"";
					echo ">{$folder_row->folder_name}</option>";
					 }
					 ?>
			   </select>
			     <?php } ?>
			   </td>
              </tr>
            </table>
			<br>
	        <table width="100%"  border="0" cellspacing="0" cellpadding="2">
	<?php  
	if(isset($_REQUEST['view_class'])) $query="select * from ".$table_suffix."member_url where  folder_name='{$_REQUEST['view_class']}' and user_name='$host_name'";  
	else $query="select * from ".$table_suffix."member_url where user_name='$host_name'";  
	$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	$per_page_num=15;
	$rows=@mysql_query($query); 
	$num=@mysql_num_rows($rows);
	$page=intval(($num-1)/$per_page_num)+1;
    if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
    $page_front=($page_id<=1)?1:($page_id-1); 
    $page_behind=($page_id>=$page)?$page:($page_id+1); 
    @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
	for($i=1;$i<=$per_page_num;$i++)
		   { if($row=@mysql_fetch_object($rows)){ 
	$infor_title=$row->infor_title;
	$post_time=$row->post_time;
	$folder_name=$row->folder_name;
	$content=$row->content;
	?>
    <tr>
        <td><div align="left" class="fonts"><a href="<?=$content?>" style="color:#3366CC; text-decoration:underline" target="_blank">
          <?=$infor_title?></a> (<?=$post_time?>)</div></td>
      </tr>
	<?php } 
	  }
	?>
    </table>
<?php if(!$num) { ?>
 <table width="100%" border="0" cellpadding="10" cellspacing="0">
   <tr>
     <td>目前没有记录</td>
   </tr>
  </table>
<?php } ?>
  <br>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php  require_once("inc/page_divide.php"); ?></td>
      </tr>
    </table>
</td>
        </tr>
    </table></td>
  </tr>
</table>
