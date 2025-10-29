<?php 
 session_start();
 require_once("setting.php");
 require_once(dirname(__FILE__)."/config/base_cfg.php");
 require_once(dirname(__FILE__)."/inc/show_msg.php");
 require_once(dirname(__FILE__)."/dbscripts/db_connect.php"); 
 require_once(dirname(__FILE__)."/inc/main_fun.php");
 
 if(isset($_REQUEST['id'])) {
 
  $id=$_REQUEST['id'];
  $article_id=$_REQUEST['id'];
  $infor_class=$_REQUEST['infor_class'];
  $query="select * from ".$table_suffix.$infor_class." where id=$article_id and hide_type='0'";
  $result=mysql_query($query);
  $row=mysql_fetch_object($result);  
  $article_title=$row->article_title;
  $class_id=$row->class_id;
  $keywords=$row->keywords;
  $abstract=$article_title."相关评论";
  $title_color=$row->title_color;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title; if($article_title) echo " - ".$article_title;?></title>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$abstract?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<SCRIPT type=text/javascript>
function fontZoom(size)
{
   document.getElementById('con').style.fontSize=size+'px';
}
</SCRIPT>
</head>
<body>
<?php  require_once(dirname(__FILE__)."/header.php"); ?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center 
background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
    <TD vAlign=top height=200>
      <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      background=image/navbg.gif border=0>
        <TBODY>
        <TR>
          <TD class=nav height=25>您现在的位置: 
            <?php  echo "<a href=\"./\">首 页</a> "; require_once(dirname(__FILE__)."/inc/get_position.php"); ?> > 评论</TD>
        </TR></TBODY></TABLE>
      <table width="100%"  border="0" cellpadding="10" cellspacing="0">
        <tr>          
          <td class="newstitle"><div align="left">主题:<font color="<?=$title_color?>">
            <?=$article_title?>
          </font><font color="<?=$title_color?>"></font></div></td>
          <td class="newstitle"><div align="center" class="picname"><a href="show_<?=$infor_class?>.php?id=<?=$id?>">查看主题内容-></a></div></td>
        </tr>
      </table>
	  <?php 
	    $num=0;
		$per_page_num=6; 
		$page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
        $id=$_REQUEST['id']; 
	    $query="select * from ".$table_suffix."comment where infor_id=$id and infor_class='$infor_class'  and hide='0' order by post_time desc";
		
		if($_REQUEST['show_style']=="reply") {
		 $result=@mysql_query($query);
		 $rows=@mysql_query($query);
		 $num=@mysql_num_rows($rows);
		}	
		else {
	    $result=@mysql_query($query);
		while($row=mysql_fetch_object($result)) { 
          $num_i=substr_count($row->content,"<!-person1->");
		  $num+=$num_i+1;      	     
	       }
		 } 	
	   $page=intval(($num-1)/$per_page_num)+1; 
       if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
       $page_front=($page_id<=1)?1:($page_id-1); 
       $page_behind=($page_id>=$page)?$page:($page_id+1); 	   
	  ?>
      <TABLE class=table height=30 cellSpacing=0 cellPadding=0 width="100%" align=center background=image/detailtitle.gif border=0>
        <TBODY>
          <TR>
            <TD align=middle width=10></TD>
            <TD>全部评论 (共有<?=$num?>条评论) 
              <?php if($_REQUEST['show_style']=="reply") {?>
			  <a href="?id=<?=$_REQUEST['id']?>&infor_class=<?=$_REQUEST['infor_class']?>&page_id=<?=$_REQUEST['page_id']?>">列表风格</a>
			  <?php } else { ?>
			  <a href="?id=<?=$_REQUEST['id']?>&infor_class=<?=$_REQUEST['infor_class']?>&page_id=<?=$_REQUEST['page_id']?>&show_style=reply">同主题阅读</a>
			  <?php } ?>			</TD>
            <TD><?php  require_once("inc/page_divide.php");?></TD>
          </TR>
        </TBODY>
      </TABLE><TABLE width="100%" border=0 align=center cellPadding=0 cellSpacing=1 bgcolor="#E1E1E1">
     <TBODY>
       <TR vAlign=top>
         <TD colSpan=2 bgcolor="#FFFFFF" class=downintro>
		 <table width="100%"  border="0" cellspacing="0" cellpadding="5">
           <tr>
             <td>
  <?php 
   if($_REQUEST['show_style']=="reply"){
      @mysql_data_seek($rows, ($page_id-1)*$per_page_num); 
	  for($i=1;$i<=$per_page_num;$i++)
		{ if($row=@mysql_fetch_object($rows)){  ?>
	   <TABLE width="100%" border=0 cellPadding=0 cellSpacing=1 bgcolor="#E1E1E1">
        <TBODY>
          <TR align=left>
            <TD bgcolor="#FFFFFF">
			<table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td width="10%" nowrap bgcolor="#EEF0F0"><?=$num-($i+$per_page_num*($page_id-1))+1?></td>
                  <td bgcolor="#EEF0F0"><div align="right"><strong><img src="image/face/<?=$row->face?>.gif" border="0" align="absmiddle" > <font color="#003399">
                      <?=$row->person?>
                    </font></strong>(<font color="#336699">
                    <?=ereg_replace(".[0-9]+$",".*",$row->post_ip)?>
                  </font>) </div></td>
                  <td width="25%" bgcolor="#EEF0F0"><div align="right">发表于：
                        <?=$row->post_time?>
                  </div></td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0" style="table-layout: fixed;WORD-BREAK: break-all; WORD-WRAP: break-word" >
                    <tr>
                      <td><span style="font-size:13px"><?php echo comment_reply_mode($row->content,"","","","","",1); ?></span></td>
                    </tr>
                    <tr>
                      <td><div align="right"><a href="mailto:<?php $mail=explode(":",$cfg_webmaster); echo $mail[1];?>">[举报]</a> <?php if($row->comment_or_not) echo " <a style=\"cursor:pointer;\" onclick=\"open_small('inc/reply_comment.php?id="."$row->id"."&content=".urlencode($row->content)."&reply_mode=add&person=".urlencode($row->person)."&face=".$row->face."&post_time=".$row->post_time."&post_ip=".$row->post_ip."')\" target=\"_blank\">[回复]</a>"; else echo "楼主限制回复"; ?></div></td>
                    </tr>
                  </table></td>
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
   else {
   $num_record=0; 
   $num_from=$per_page_num*($page_id-1);
   $num_to=$per_page_num*$page_id;
   
   $result=@mysql_query($query);
   if(mysql_num_rows($result)) { 
   while($row=mysql_fetch_object($result)) { 
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
		
		for($i=0;$i<=count($person)&&$person[$i];$i++){
		if($i==0) $reply_mode="add"; else  $reply_mode="insert"; 
		$num_record++;
		if(($num_record>$num_from)&&($num_record<=$num_to)) {
	  ?>
      <TABLE width="100%" border=0 cellPadding=0 cellSpacing=1 bgcolor="#E1E1E1">
        <TBODY>
          <TR align=left>
            <TD bgcolor="#FFFFFF">
			<table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td width="10%" nowrap bgcolor="#EEF0F0">第<?=$num-$num_record+1?>楼</td>
                  <td bgcolor="#EEF0F0"><div align="right"><strong><img src="image/face/<?=$face[$i]?>.gif" border="0" align="absmiddle" > <font color="#003399">
                      <?=$person[$i]?>
                    </font></strong>(<font color="#336699">
                    <?=ereg_replace(".[0-9]+$",".*",$post_ip[$i])?>
                  </font>) </div></td>
                  <td width="25%" bgcolor="#EEF0F0"><div align="right">发表于：
                        <?=$post_time[$i]?>
                  </div></td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0" style="table-layout: fixed;WORD-BREAK: break-all; WORD-WRAP: break-word" >
                    <tr>
                      <td><span style="font-size:13px"><?php echo "<font color=black>".$content[$i]."</font>"; ?></span></td>
                    </tr>
                    <tr>
                      <td><div align="right"><a href="mailto:<?php $mail=explode(":",$cfg_webmaster); echo $mail[1];?>">[举报]</a> <?php if($row->comment_or_not) echo " <a style=\"cursor:pointer;\" onclick=\"open_small('inc/reply_comment.php?id=".$row->id."&content=".urlencode($content[$i])."&reply_mode=".$reply_mode."&person=".urlencode($person[$i])."&face=".$face[$i]."&post_time=".$post_time[$i]."&post_ip=".$post_ip[$i]."')\" target=\"_blank\">[回复]</a>"; else echo "楼主限制回复"; ?></div></td>
                    </tr>
                  </table></td>
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
 <?php }
    } 
?>
  </td>
           </tr>
         </table></TD>
       </TR>
     </TBODY>
   </TABLE></TD>
  </TR></TBODY></TABLE>
<table width="<?=$cfg_body_width?>" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php require_once("inc/add_comment.php");?></td>
  </tr>
</table><br>
<?php   require_once(dirname(__FILE__)."/footer.php"); ?>
</body>
</html>
<?php } else ShowMsg("对不起,该地址无法访问!",-1);
?>
 <script>
 function open_small(url){ window.open(url,"","height=600,width=800,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
 </script>
