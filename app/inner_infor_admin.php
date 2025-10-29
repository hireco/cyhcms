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
   if($_REQUEST['action']=="delete") {
   $result=mysql_query("delete from  ".$table_suffix."inner_record  where infor_id={$_REQUEST['id']} and user_id='{$_SESSION['user_name']}'");
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
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 留言管理</TD>
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
                 <td><div align="center">系统消息</div></td>
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
		  $query="select * from ".$table_suffix."inner_infor, ".$table_suffix."inner_record where ".$table_suffix."inner_record.user_id='{$_SESSION['user_name']}' and ".$table_suffix."inner_infor.id = ".$table_suffix."inner_record.infor_id and ".$table_suffix."inner_infor.hide='0' order by ".$table_suffix."inner_infor.id desc";
		  $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	      $per_page_num=20;
          $rows=@mysql_query($query); 
		  $num=@mysql_num_rows($rows);
		  $page=intval(($num-1)/$per_page_num)+1;
	      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	      $page_front=($page_id<=1)?1:($page_id-1); 
	      $page_behind=($page_id>=$page)?$page:($page_id+1); 
	      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
		?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td><div align="center">编号</div></td>
            <td>消息主题</td>
            <td><div align="center">发布时间</div></td>
			<td><div align="center">状态</div></td>
            <td><div align="center">删除</div></td>
          </tr>
           <?php for($i=1;$i<=$per_page_num;$i++)
		         { if($row=@mysql_fetch_object($rows)){ 				   
				  ?>
		  <tr>
            <td><div align="center">
              <?=$i+($page_id-1)*$per_page_num?>
            </div></td>
            <td><a href="inner_infor_view.php?infor_id=<?=$row->infor_id?>" style="text-decoration:underline "><?=$row->infor_title==""?"无标题":$row->infor_title?></a></td>
			<td><div align="center">
              <?=substr($row->post_time,3,11)?>
            </div></td>
            <td><div align="center">
              <?php 
			 if($row->read_or_not) echo "<img src=\"image/mail_open.gif\" width=\"14\" height=\"10\" alt=\"已读\">"; 
			 else echo "<img src=\"image/mail_new.gif\" width=\"14\" height=\"10\" alt=\"未读\">"; 
			 ?>
            </div></td>
			<td><div align="center">
			  <?php 
				    echo "<input type=button value=\"删除\" class=\"INPUT\" onClick=\" if(really())  no_show('?id=".$row->infor_id."&action=delete')\" target=\"_self\" >";  ?>
			</div></td>
            </tr>
		  <?php }
		    }
		  ?>
        </table>
		</td>
      </tr>
    </table>
	<TABLE height=43 cellSpacing=0 cellPadding=4 width="100%" align=center border=0>
      <TBODY>
        <TR>
          <TD class=pagesinfo width=300>&nbsp;</TD>
          <TD class=pages align=right><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center">
                    <?php  require_once("inc/page_divide.php");?>
                </div></td>
              </tr>
          </table></TD>
        </TR>
      </TBODY>
    </TABLE></td>
  </tr>
</table></TD></TR>
              </TBODY>
          </TABLE>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php"); ?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
<?php 
 } else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
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
