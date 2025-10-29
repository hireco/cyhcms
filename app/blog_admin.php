<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
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
     //这种连接删除的方法在有些情况,例如文章没有缩略图,文章就不能删除,建议不要使用!
	 //if($_REQUEST['blog_class']=="album") 
	 //$result=mysql_query("delete ".$table_suffix."member_blog .*,  ".$table_suffix."picture .*, ".$table_suffix."picture_msg .*  from  ".$table_suffix."member_blog left join ".$table_suffix."picture on ".$table_suffix."member_blog.id =".$table_suffix."picture.object_id  
	 // left join ".$table_suffix."picture_msg on ".$table_suffix."picture.id =".$table_suffix."picture_msg.pic_id 
	 //where ".$table_suffix."picture .object_class='member' and ".$table_suffix."member_blog .id={$_REQUEST['id']} and ".$table_suffix."member_blog .user_name='{$_SESSION['user_name']}'");
      
	 //else $result=mysql_query("delete from  ".$table_suffix."member_blog  where id={$_REQUEST['id']} and user_name='{$_SESSION['user_name']}'");
    
	 $result=mysql_query("delete from ".$table_suffix."member_blog where id = {$_REQUEST['id']} and  user_name='{$_SESSION['user_name']}'");
	 if($_REQUEST['blog_class']=="album")  {   
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture     where object_id = {$_REQUEST['id']} and object_class='member'");
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture_msg where object_id = {$_REQUEST['id']} and object_class='member'");
	  }
	
   
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
		 <?php 
		  if(!isset($_REQUEST['blog_class'])) $_REQUEST['blog_class']="rizhi";
		  elseif(empty($blog_type[$_REQUEST['blog_class']])) { unset($_REQUEST['blog_class']);  ShowMsg("博客类型不存在!","blog_admin.php");  }//blog class is invalid
		  if(isset($_REQUEST['blog_class'])) {
		  ?>
		  <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; <?=$blog_type[$_REQUEST['blog_class']]?>管理</TD>
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
     <tr><td width="10" bgcolor="#D0D2E3"></td>
	  <?php
	    $result_row=mysql_query("select distinct folder_name from ".$table_suffix."member_blog where user_name='{$_SESSION['user_name']}' and blog_class='{$_REQUEST['blog_class']}'");
		$num_of_folder=mysql_num_rows($result_row);
		if(isset($_REQUEST['more_folder'])) 
		    { 
		      echo "<td bgcolor=\"#D0D2E3\"><table  border=\"0\" cellspacing=\"0\" cellpadding=\"2\"><tr>"; 
			   for($i=0;$i<=$num_of_folder;$i++){  
			    if(($i%3==0)&&($i<>1)) echo "<tr>"; if($i%3==0) echo "</tr>";
				if($i==0) {
				 echo "<td"; 
			     if(!isset($_REQUEST['folder_name']))  echo " bgcolor=\"#FFFFFF\">所有".$blog_type[$_REQUEST['blog_class']]."</td>";   
			     else  echo "><a href=\"blog_admin.php?more_folder&blog_class=".$_REQUEST['blog_class']."\" style=\"text-decoration:underline \" >所有".$blog_type[$_REQUEST['blog_class']]."</a></td>";
			         }
				else { 
				 $folder_row=@mysql_fetch_object($result_row);  
				 echo "<td"; 
				 if($folder_row->folder_name==$_REQUEST['folder_name'])  echo " bgcolor=\"#FFFFFF\""; 
				 echo "><div align=\"center\">"; 
				 if($folder_row->folder_name==$_REQUEST['folder_name'])   echo $folder_row->folder_name;
				 else echo "<a href=\"?folder_name=".urlencode($folder_row->folder_name)."&more_folder&blog_class=".$_REQUEST['blog_class']."\" style=\"text-decoration:underline \" >".$folder_row->folder_name."</a>";
				 echo "</div></td>";          
                 }
			    }
			   echo "</tr></table></td>";
			  } 
	    else { 
	           echo "<td bgcolor=\"#D0D2E3\"><table  border=\"0\" cellspacing=\"0\" cellpadding=\"5\"><tr bgcolor=\"#D0D2E3\">
                   <td height=\"5\" colspan=\"3\"></td></tr><tr>";
               echo "<td"; 
			   if(!isset($_REQUEST['folder_name']))  echo " bgcolor=\"#FFFFFF\">所有".$blog_type[$_REQUEST['blog_class']]."</td>";   
			   else  echo "><a href=\"blog_admin.php?blog_class={$_REQUEST['blog_class']}\" style=\"text-decoration:underline \" >所有".$blog_type[$_REQUEST['blog_class']]."</a></td>";
			   $i=1;
			   while(($folder_row=@mysql_fetch_object($result_row))&&($i<5)){ 
			   echo "<td"; 
			   if($folder_row->folder_name==$_REQUEST['folder_name']) echo " bgcolor=\"#FFFFFF\"";  
			   echo "><div align=\"center\">"; 
			   if($folder_row->folder_name==$_REQUEST['folder_name'])   echo $folder_row->folder_name;
			   else echo "<a href=\"?folder_name=".urlencode($folder_row->folder_name)."&blog_class=".$_REQUEST['blog_class']."\" style=\"text-decoration:underline \" >".$folder_row->folder_name."</a>";
			   echo "</div></td>";
			   $i++;
			   }
			   echo "<td><a href=\"?more_folder&blog_class=".$_REQUEST['blog_class']."\" style=\"text-decoration:underline \">更多></a></td>"; 
			   echo "<td><a href=\"blog.php?action=add&blog_class=".$_REQUEST['blog_class']."\" style=\"text-decoration:underline \">发表</a></td>";
			   echo "</tr></table></td>";
		    }	 
		 ?>
	  </tr>
      <tr>
        <td height="400" colspan="2" valign="top" bgcolor="#FFFFFF">
		<?php 
          if(isset($_REQUEST['folder_name'])) $condition="folder_name='{$_REQUEST['folder_name']}'"; else $condition="1=1";
		  $query="select * from ".$table_suffix."member_blog  where ".$condition." and user_name='{$_SESSION['user_name']}' and blog_class='{$_REQUEST['blog_class']}' order by post_time desc";
          
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
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10">&nbsp;</td>
				<td><?=$blog_type[$_REQUEST['blog_class']]?>标题</td>
                <td>发布时间</td>
				<td><?=$blog_type[$_REQUEST['blog_class']]?>分类</td>
                <td> 编 辑</td>
                <td><div align="center">删 除</div></td>
              </tr>
              <?php  
                for($i=1;$i<=$per_page_num;$i++)
		         { if($row=@mysql_fetch_object($rows)){ 
              ?>
              <tr>
                <td>&nbsp;</td>
                <td><a href="blog.php?action=view&id=<?=$row->id?>&blog_class=<?=$_REQUEST['blog_class']?>"  style="text-decoration:underline ">
                <?=$row->infor_title?>
                </a></td>
                <td class="fonts"><?=substr($row->post_time,3,11)?>
                  </td>
                <td><a href="blog_admin.php?folder_name=<?=urlencode($row->folder_name)?>&blog_class=<?=$_REQUEST['blog_class']?>">
                  <?=$row->folder_name?>
                </a></td>
                <td><a href="blog.php?action=edit&id=<?=$row->id?>&blog_class=<?=$_REQUEST['blog_class']?>">编 辑</a></td>
                <td>
                  <div align="center">
                    <?php 
				    echo "<input type=button value=\"删除\" class=\"INPUT\" onClick=\" if(really())  no_show('?id=".$row->id."&action=delete&blog_class=".$_REQUEST['blog_class']."')\" target=\"_self\" >";  ?>
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
</table></TD>
                </TR>
              </TBODY>
          </TABLE>
		  <?php }//blog class is valid
		   ?>
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
