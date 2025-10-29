<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php  
if($_SESSION['user_name']<>$host_name) require_once(dirname(__FILE__)."/add_liuyan.php"); ?>
<TABLE height=30 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=blog_inc/detailtitle.gif border=0>
  <TBODY>
    <TR>
      <TD align=middle width=10></TD>
      <TD><strong>所有留言<a name="say_list"></a></strong></TD>
      <TD><div align="center"><a href="#say" style="text-decoration:underline ">发布留言</a></div></TD>
    </TR>
  </TBODY>
</TABLE>
<?php 
  $query_liuyan="select * from ".$table_suffix."member_guestbook where whisper='0' and to_user_name='$host_name' order by post_time desc";
  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
  $per_page_num=20;
  $rows=mysql_query($query_liuyan); 
  $num=@mysql_num_rows($rows);
  $page=intval(($num-1)/$per_page_num)+1;
  if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
  $page_front=($page_id<=1)?1:($page_id-1); 
  $page_behind=($page_id>=$page)?$page:($page_id+1); 
  @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
  for($i=1;$i<=$per_page_num;$i++)
	   { if($row_liuyan=@mysql_fetch_object($rows)){
  $content=ereg_replace("//f:"," <img align=absmiddle src=".$cfg_mainsite."blog_inc/face/",$row_liuyan->content);
  $content=ereg_replace("//f",".gif> ",$content);
  $infor_title=$row_liuyan->infor_title==""?"无标题":$row_liuyan->infor_title;
  $liuyan_person=$row_liuyan->person;
  
  $img_default="image/memsimg.gif";
  
  $query="select * from ".$table_suffix."member  where user_name='{$row_liuyan->from_user_name}'";
  $result_who=mysql_query($query);
  $row_who=mysql_fetch_object($result_who); 
  $sample_pic=$row_who->pic_checked=='1'?(empty($row_who->sample_pic)?$img_default:$row_who->sample_pic):$img_default;
  $md5_idkey=md5($row_liuyan->from_user_name);
 ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="60" valign="top"><div align="center"><a href="user_infor.php?host_id=<?=$row_who->id?>&idkey=<?=$md5_idkey?>" target="_blank"><img src="<?=$sample_pic?>" alt="<?=$liuyan_person?>" width="40" border="1"  style="border:1px solid #cccccc;"></a></div></td>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td><a href="user_infor.php?host_id=<?=$row_who->id?>&idkey=<?=$md5_idkey?>" target="_blank"><?php echo $liuyan_person; ?></a> <?php echo "<br><strong>".$infor_title."</strong> "; echo $content?></td>
      </tr>
      <tr>
        <td><span style="color:#666666; font-size:10px;">(20<?=$row_liuyan->post_time?>)</span></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php } 
   }
 if(!$num) {
 ?>
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