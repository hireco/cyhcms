<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
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
<?php  require_once("center_header.php"); 
   if(isset($_SESSION['user_name'])) {  
   if($_REQUEST['action']=="delete_fri") {
   $result=mysql_query("select  friend_list  from  ".$table_suffix."member where user_name='{$_SESSION['user_name']}'");
   $friend_list=mysql_result($result,0,"friend_list");
   $friend_list=explode(",",$friend_list);
   for($i=0;$i<count($friend_list); $i++) 
    { if($friend_list[$i]<>$_REQUEST['id']) $friend_list2[$i]=$friend_list[$i]; }
   $friend_list=implode(",",$friend_list2);
   $result=mysql_query("update  ".$table_suffix."member set friend_list='$friend_list' where user_name='{$_SESSION['user_name']}'");	
   if($result) {
	echo "<script>parent.location.reload()</script>";
	exit;
	 }
   }
   elseif($_REQUEST['action']=="delete_bla") {
   $result=mysql_query("select  black_list  from  ".$table_suffix."member where user_name='{$_SESSION['user_name']}'");
   $black_list=mysql_result($result,0,"black_list");
   $black_list=explode(",",$black_list);
   for($i=0;$i<count($black_list); $i++) 
    { if($black_list[$i]<>$_REQUEST['id']) $black_list2[$i]=$black_list[$i]; }
   $black_list=implode(",",$black_list2);
   $result=mysql_query("update  ".$table_suffix."member set black_list='$black_list' where user_name='{$_SESSION['user_name']}'");	
   if($result) {
	echo "<script>parent.location.reload()</script>";
	exit;
	 }
   } 
   ?>
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
                <TD>用户功能菜单</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <? require_once("inc/tree_menu.php");?>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF">
		  <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 人员关系</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3">
  <tr>
    <td valign="top" bgcolor="#FFFFFF">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
     <tr><td bgcolor="#D0D2E3"><table border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td height="5"></td>
       </tr>
       <tr>
         <td><table border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="10">&nbsp;</td>
             <td><table border="0" cellpadding="5" cellspacing="0" <?php if($_REQUEST['list_for']=="friend") echo "bgcolor=\"#FFFFFF\""; ?>>
               <tr>
                 <td><div align="center"><?php if($_REQUEST['list_for']=="friend") echo "好友列表";  else echo "<a href=\"?list_for=friend\">好友列表</a>" ?></div></td>
               </tr>
             </table></td>
             <td width="20">&nbsp;</td>
             <td><table border="0" cellpadding="5" cellspacing="0" <?php if($_REQUEST['list_for']=="blacklist") echo "bgcolor=\"#FFFFFF\""; ?>>
               <tr>
                 <td><div align="center"><?php if($_REQUEST['list_for']=="blacklist") echo "黑名单";  else echo "<a href=\"?list_for=blacklist\">黑名单</a>" ?></div></td>
               </tr>
             </table></td>
           </tr>
         </table></td>
       </tr>
     </table></td>
	    </tr>
      <tr>
        <td height="400" valign="top" bgcolor="#FFFFFF">
		<?php if($_REQUEST['list_for']=="blacklist") {?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td>
                      <?php  
					  echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					  $black_list=mysql_result(mysql_query("select black_list from ".$table_suffix."member where user_name='{$_SESSION['user_name']}' "),0,"black_list");
					  $width=70;  
					  $i_row=($body_width-181)/$width; 
					  if($black_list) { 
					  $black_list=explode(",",$black_list); 
					  for($i=0; $i<count($black_list); $i++) {
					   $query="select * from ".$table_suffix."member  where id={$black_list[$i]}";
					   $result=mysql_query($query);
					   $row=mysql_fetch_object($result); 
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
					   $md5_idkey=md5($row->user_name);
					   if($i%$i_row==0) echo "<tr>";
					   echo "<td>";
					  ?>
					  <table  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$black_list[$i]?>&idkey=<?=$md5_idkey?>" target="_blank" ><img src="<?=$sample_pic?>" alt="<?=$row->nick_name?>" width="<?=$width?>"  border="0" align="middle"></a></td>
                                </tr>
                            </table>                              
                              <br>
							  <div align="center"><a  style="text-decoration:underline; color:#006666" href="user_infor.php?host_id=<?=$black_list[$i]?>&idkey=<?=$md5_idkey?>">
                                <?=$row->nick_name?></a> <?php echo "<input type=button value=\"删除\" class=\"INPUT\" onClick=\" if(really())  no_show('?id=".$black_list[$i]."&action=delete_bla')\" target=\"_self\" >";  ?>
                     </div>
                          <?php 
						  echo "</td>"; 
						  if($i%$i_row==3) echo "</tr>";
						  }
					   }
					 else  echo "<tr><td>黑名单为空</td></tr>"; 
					 echo "</table>";
					 ?>
                      </td>
                    </tr>
                </table>
		<?php } elseif($_REQUEST['list_for']=="friend"){ ?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td>
                      <?php  
					  echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					  $friend_list=mysql_result(mysql_query("select friend_list from ".$table_suffix."member where user_name='{$_SESSION['user_name']}' "),0,"friend_list");
					  $width=70;  
					  $i_row=($body_width-181)/$width; 
					  if($friend_list) { 
					  $friend_list=explode(",",$friend_list); 
					  for($i=0; $i<count($friend_list); $i++) {
					   $query="select * from ".$table_suffix."member  where id={$friend_list[$i]}";
					   $result=mysql_query($query);
					   $row=mysql_fetch_object($result); 
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
					   $md5_idkey=md5($row->user_name);
					   if($i%$i_row==0) echo "<tr>";
					   echo "<td>";
					  ?>
					  <table  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=$md5_idkey?>" target="_blank" ><img src="<?=$sample_pic?>" alt="<?=$row->nick_name?>" width="<?=$width?>"  border="0" align="middle"></a></td>
                                </tr>
                            </table>                              
                              <br>
							  <div align="center"><a  style="text-decoration:underline; color:#006666" href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=$md5_idkey?>">
                                <?=$row->nick_name?></a> <?php echo "<input type=button value=\"删除\" class=\"INPUT\" onClick=\" if(really())  no_show('?id=".$friend_list[$i]."&action=delete_fri')\" target=\"_self\" >";  ?>
                     </div>
                          <?php 
						  echo "</td>"; 
						  if($i%$i_row==3) echo "</tr>";
						  }
					   }
					 else  echo "<tr><td>没有好友</td></tr>"; 
					 echo "</table>";
					 ?>
                      </td>
                    </tr>
                </table>
		<?php } ?>
		</td>
      </tr>
    </table>
	</td>
  </tr>
</table></TD></TR>
              </TBODY>
          </TABLE>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php");
 } else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
</body>
</html>
<script>
function no_show(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
function really() {
      result="您确定要删除吗？";   
       if   (confirm(result))    return true; 
       else return false;
 }
 </script>

