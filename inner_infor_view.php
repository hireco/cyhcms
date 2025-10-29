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
if(isset($_SESSION['user_name'])) { ?>
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
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 留言查看</TD>
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
               <td><table border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
                   <tr>
                     <td><div align="center"><a href="inner_infor_admin.php">系统消息</a></div></td>
                   </tr>
               </table></td>
             </tr>
         </table></td>
       </tr>
     </table></td>
	    </tr>
      <tr>
        <td height="400" valign="top" bgcolor="#FFFFFF">
		<?php 
		  $query="select * from ".$table_suffix."inner_record where infor_id={$_REQUEST['infor_id']} and  user_id='{$_SESSION['user_name']}'";
		  $result=mysql_query($query);
		  if(!@mysql_num_rows($result)) ShowMsg("对不起,您无权访问该信息或该信息不存在",-1);
		  else { 
		     $query="select * from ".$table_suffix."inner_infor where id={$_REQUEST['infor_id']}";
		     $result=mysql_query($query);
			 if($row=mysql_fetch_object($result)){ 
			 mysql_query("update  ".$table_suffix."inner_record  set read_or_not='1' where infor_id={$row->id} and user_id='{$_SESSION['user_name']}'");
		?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="10">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td>
                  <div align="center">
                    <strong><?=$row->infor_title?></strong>
                  </div></td>
                <td><font color=gray>
                   时间: <?=$row->post_time?></font>
                </td>
              </tr>
              <tr>
                <td colspan="2"><div align="left">
                    <?=$row->content?>
                </div></td>
              </tr>
            </table></td>
          </tr>
        </table>
		<?php } 
		  }
		?>
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
