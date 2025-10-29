<?php   
  if($_SESSION['user_name']==$row->user_name) $for_who=$_SESSION['user_name'];
  else $for_who=$row->user_name;
  $query="select * from ".$table_suffix."member_msg where user_name='$for_who'  or to_who='$for_who' order by id desc";
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $per_page_num=10;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
?>
<DIV>
        <DIV>
        <DIV id=askNav>
    <UL class=on>
      <LI class=imgl></LI>
      <LI class=text><?=$who?>µƒ¡Ù—‘(<?=$num?>)</LI>
      <LI class=imgr></LI>
    </UL>
    <DIV class=cb></DIV>
  </DIV>
        <DIV class="pt10 c333" style="padding-left:20px;">
	  <?php	   
	   for($i=1;$i<=$per_page_num;$i++) {
	      { if($row_msg=@mysql_fetch_object($rows))
		  { $from_who=$row_msg->user_name;
		    if($from_who<>$_SESSION['user_name']) 
			{
			  $query="select id,nick_name from ".$table_suffix."member where user_name='{$from_who}'";
			  $result_from=mysql_query($query);
			  $row_from=mysql_fetch_object($result_from);
			  $from_nick_name=$row_from->nick_name;
			  $from_id=$row_from->id;
			 }
			else 
			 { 
			  $from_nick_name=$_SESSION['nick_name'];
			  $from_id=$_SESSION['user_id'];
			 }
		    echo $row_msg->content."<font color=gray>(".substr($row_msg->post_time,3,8).")</font> By 
			<a href=user_infor.php?user_id=".$from_id." style=\"text-decoration:underline; color:blue;\">".$from_nick_name."</a><br><br>";
           }
		 }
	   }
	   ?><BR>
	  <DIV ></DIV>
      </DIV>
      </DIV>
      </DIV>
	  
      <table width="100%" border="0">
        <tr>
          <td><?php require_once("include/page_devide.php");?></td>
        </tr>
      </table>