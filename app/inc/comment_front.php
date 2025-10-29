<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
   session_start(); 
   require_once("setting.php");
   require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
   require_once(dirname(__FILE__)."/show_msg.php");
   if(isset($_REQUEST['id'])) { ?>
   <TABLE width="90%" border=0 align=center cellPadding=0 cellSpacing=1 bgcolor="#E1E1E1">
     <TBODY>
       <TR vAlign=top>
         <TD colSpan=2 bgcolor="#FFFFFF" class=downintro>
		 <TABLE class=table height=30 cellSpacing=0 cellPadding=0 width="100%" align=center background=image/detailtitle.gif border=0>
        <TBODY>
        <TR>
          <TD align=middle width=10></TD>
          <TD>最新评论</TD>
          <TD><div align="center"><a href="comment_list.php?id=<?=$_REQUEST['id']?>&infor_class=<?=$infor_class?>">更多评论</a></div></TD>
        </TR>
    </TBODY></TABLE>
         <table width="100%"  border="0" cellspacing="0" cellpadding="5">
           <tr>
             <td>
  <?php 
   $show_num=6;
   $id=$_REQUEST['id'];
   $result=@mysql_query("select * from ".$table_suffix."comment where infor_id=$id and infor_class='$infor_class'  and hide='0' order by post_time desc limit 0,$show_num");
   if(mysql_num_rows($result)) { 
   $num=0;  
  while(($row=mysql_fetch_object($result))&&($num<$show_num)) { 
        $person[0]=$row->person;
	    $post_ip[0]=$row->post_ip;
		$post_time[0]=$row->post_time;
		$face[0]=$row->face;
		
		$temp=explode("<!-person1->",$row->content);
		$content[0]=$temp[0];
		
		if(ereg("<!-person1->",$row->content)) {
	    $person_arr=explode("<!-person1->",$row->content);		 
	    $post_ip_arr=explode("<!-ip1->",$row->content);
		$post_time_arr=explode("<!-time1->",$row->content);
		$content_arr=explode("<!-content1->",$row->content);
		$face_arr=explode("<!-face",$row->content);
		for($i=1;$i<=count($person_arr);$i++){ 
		   $temp=explode("<!-face",$person_arr[$i]);
		   $person[$i]=$temp[0];
		   $temp=explode("<!-ip2",$post_ip_arr[$i]);
		   $post_ip[$i]=$temp[0];
		   $temp=explode("<!-time2",$post_time_arr[$i]);
		   $post_time[$i]=$temp[0];
		   $temp=explode("<!-person1",$content_arr[$i]);
		   $content[$i]=$temp[0];		
		   $temp=explode("face->",$face_arr[$i]);
		   $face[$i]=$temp[0];   
		  }
		}
		
		for($i=0;$i<=count($person)&&$person[$i]&&$num<$show_num;$i++){
		$num+=1; 
		if($i==0) $reply_mode="add"; else  $reply_mode="insert";
	  ?>
      <TABLE width="100%" border=0 cellPadding=0 cellSpacing=1 bgcolor="#E1E1E1">
        <TBODY>
          <TR align=left>
            <TD bgcolor="#FFFFFF">
			<table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td bgcolor="#EEF0F0"><strong><img src="image/face/<?=$face[$i]?>.gif" border="0" align="absmiddle" >
                    <?=$person[$i]?></strong> (<font color="#336699"><?=ereg_replace(".[0-9]+$",".*",$post_ip[$i])?></font>) 发表于： <?=$post_time[$i]?> </td>
                </tr>
                <tr>
                  <td><?php echo $content[$i]; if($row->comment_or_not) echo " <a style=\"cursor:pointer;\" onclick=\"open_small('inc/reply_comment.php?id=".$row->id."&content=".urlencode($content[$i])."&reply_mode=".$reply_mode."&person=".urlencode($person[$i])."&face=".$face[$i]."&post_time=".$post_time[$i]."&post_ip=".$post_ip[$i]."')\" target=\"_blank\"><strong>[回复]</strong></a>"; ?></td>
                </tr>
            </table></TD>
          </TR>
        </TBODY>
      </TABLE>
      <table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
      <?php } 
	       }
	     }
  else { ?>
<TABLE width="100%" border=0 align=center cellPadding=5 cellSpacing=1 bgcolor="#E1E1E1">
  <TBODY>
    <TR vAlign=top>
      <TD colSpan=2 bgcolor="#FFFFFF" class=downintro>
        目前没有评论
      </TD>
    </TR>
  </TBODY>
</TABLE>
 <?php } ?>
  </td>
           </tr>
         </table></TD>
       </TR>
     </TBODY>
   </TABLE>
<?php 
  } else ShowMsg("对不起,该地址无法访问!",-1);
 ?>
 <script>
 function open_small(url){ window.open(url,"","height=600,width=800,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
 </script>