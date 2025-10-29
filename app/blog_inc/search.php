<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
<?php  
			    $keywords=trim($_REQUEST["keywords"]); 
				if(empty($keywords)) ShowMsg("无效的访问",-1); else {  
				$query="select * from ".$table_suffix."member_blog where user_name='$host_name' and keywords like '%$keywords%' order by post_time desc";
				$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				$per_page_num=25;
				$rows=@mysql_query($query); 
				$num=@mysql_num_rows($rows);
				$page=intval(($num-1)/$per_page_num)+1;
				if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
				$page_front=($page_id<=1)?1:($page_id-1); 
				$page_behind=($page_id>=$page)?$page:($page_id+1); 
				@mysql_data_seek($rows, ($page_id-1)*$per_page_num);  ?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr bgcolor="#EEF7F3">
                <td><div align="left"><strong>搜索结果</strong></div></td>
                <td><div align="right">共找到<?=$num?>条记录</div></td>
              </tr>
              <tr bgcolor="#CCCCCC">
                <td height="1" colspan="2"></td>
              </tr>
            </table>		    
            <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
			 <?php 
			   for($i=1;$i<=$per_page_num;$i++)
					   { if($row=@mysql_fetch_object($rows)){  
			   $infor_title=$row->infor_title;
	           $post_time=$row->post_time;
			   $blog_class=$row->blog_class;
			   $host_name=$row->user_name;
			   
	          ?>
         <tr>
        <td><div align="left" class="fonts"><a href="user_infor.php?view=<?=$blog_class?>&infor_id=<?=$row->id?>&idkey=<?=md5($host_name)?>" style="color:#3366CC; text-decoration:underline">
          <?=$infor_title?></a> <?php if($blog_class=="album") { ?> <img src="image/album_ico.gif" width="18" height="12" align="absmiddle">
          <?php } ?>(<?=$post_time?>)</div></td>
      </tr>
				<?php } 
	            }
			 ?> </table>
	<br>
	<?php  require_once("inc/page_divide.php"); ?>
	            </td>
              </tr>
            </table>
			<?php } ?>