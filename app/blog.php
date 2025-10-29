<?php 
 require_once("dbscripts/db_connect.php"); 
 require_once("config/base_cfg.php");
 require_once("config/auto_set.php");
 require_once("inc/often_function.php");
 require_once($cfg_admin_root."function/inc_function.php");
 require_once("member_editor/fckeditor.php");
 require_once($cfg_admin_root."scripts/constant.php");
 require_once(dirname(__FILE__)."/file_do/pic_upload.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/album.js" type="text/javascript"></script>
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
<script>
function check_title() {
 if(document.all.title.value=="")
 { alert("请输入内容的标题！");
   document.all.title.focus();
   return false;
 }
 else return true;
}
</script>
</head>
<body onLoad="resizeImages(<?=$cfg_body_width?>);">
<?php  
require_once("center_header.php"); 
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
                  <TD vAlign=top height=300>
 <?php  if(isset($_POST['submit_s'])) {
	     
		   //获取所有的提交POST变量
			if ( isset( $_POST ) )
			   $postArray = &$_POST ;
			foreach ( $postArray as $sForm => $value )
			{
				if ( get_magic_quotes_gpc() )
					$$sForm = stripslashes( trim($value) )  ;
				else
					$$sForm = trim($value)  ;
				   // echo "'\$".$sForm."',"; 
			
			} 
			 
			
			$body = stripslashes($body);
			
			//-------------------------------------------------------------------------------------------------------------------
			//把内容中远程的图片资源本地化
			  $upload_child_dir = $cfg_user_root; //用户图片下载目录
			  $body = GetCurContent($body);
			
			
			//写数据库
			$content=addslashes($body); 
			$keywords=msubstr(trim($keywords),0,60);
			require_once("inc/auto_keywords.php");
			$nowtime=date("y-m-d H:i:s");
			$title=msubstr(strip_tags(trim($_POST['title'])),0,50);
			$add_folder=trim($_POST['add_folder']);
			$folder_name=$add_folder==""?$_POST['folder_name']:$add_folder;
			$show_attribute=$_POST['show_attribute'];
			$blog_class=$_POST['blog_class'];
			
			if(empty($blog_type[$blog_class])) ShowMsg("博客类型不存在!","blog_admin.php"); 
			else {
			 if(($_POST['action']=="edit")&&(isset($_REQUEST['id']))) {
			 $result=mysql_query("select * from  ".$table_suffix."member_blog  where user_name='{$_SESSION['user_name']}' and id={$_REQUEST['id']} and blog_class='{$blog_class}'");
			 if(mysql_num_rows($result))  $result=mysql_query("update  ".$table_suffix."member_blog  set content = '$content', last_modify='$nowtime',infor_title='$title',folder_name='$folder_name',show_attribute='$show_attribute',keywords='$keywords' where id={$_REQUEST['id']}");
			 $object_id=$_REQUEST['id'];
			  }
			 elseif($_POST['action']=="add") { 
			 $result=mysql_query("insert into  ".$table_suffix."member_blog  (content,user_name,last_modify,post_time,folder_name,infor_title,show_attribute,blog_class,keywords) values ('$content','{$_SESSION['user_name']}','$nowtime','$nowtime','$folder_name','$title','$show_attribute','$blog_class','$keywords')");
			 $object_id=@mysql_insert_id();
			  }
			 
			 if($blog_class=="album") 	 require_once("inc/blog_album_inc.php");
			 
			 if($result) ShowMsg("成功完成操作","blog_admin.php?blog_class=$blog_class");
			 else  ShowMsg("操作失败,请重来",-1);  
		    }
         } 
     else{ 
	    if(!isset($_REQUEST['action'])) $_REQUEST['action']="add";
	    elseif($_REQUEST['action']=="edit"||$_REQUEST['action']=="view"){
		   $result=mysql_query("select * from ".$table_suffix."member_blog where user_name='{$_SESSION['user_name']}' and id={$_REQUEST['id']} and blog_class='{$_REQUEST['blog_class']}'");
	       if(!$result)  { ShowMsg("Sorry,访问出错或者数据库读错误",-1); exit;}
 		   else  $row=mysql_fetch_object($result);
		  } 
	   ?>
   <table width="100%" height="450"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3">
     <tr>
      <td valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D0D2E3">
       <tr>
         <td bgcolor="#D0D2E3">
           <div align="left">
             <table  border="0" cellspacing="0" cellpadding="5">
               <tr bgcolor="#D0D2E3">
                 <td height="5" colspan="3"></td>
                 </tr>
               <tr>
                 <td width="20" bgcolor="#D0D2E3">&nbsp;</td>
                 <?php if(isset($_REQUEST['id'])){ echo "<td ";
				 if($_REQUEST['action']=="view") echo " bgcolor=\"#FFFFFF\">查看".$blog_type[$_REQUEST['blog_class']]."</td>"; 
				 else echo "><div align=\"center\"><a href=\"?action=view&id=".$_REQUEST['id']."&blog_class={$_REQUEST['blog_class']}\">查看".$blog_type[$_REQUEST['blog_class']]."</a></div></td>"; 
                 echo "<td ";
				 if($_REQUEST['action']=="edit") echo " bgcolor=\"#FFFFFF\">编辑".$blog_type[$_REQUEST['blog_class']]."</td>"; 
				 else echo "><div align=\"center\"><a href=\"?action=edit&id=".$_REQUEST['id']."&blog_class={$_REQUEST['blog_class']}\">编辑".$blog_type[$_REQUEST['blog_class']]."</a> </div></td>";
                  } 
				 else echo "<td><div align=\"center\"><a href=\"blog_admin.php?blog_class={$_REQUEST['blog_class']}\">".$blog_type[$_REQUEST['blog_class']]."列表</a></div></td>";
				 echo  "<td ";
				 if($_REQUEST['action']=="add") echo " bgcolor=\"#FFFFFF\">添加".$blog_type[$_REQUEST['blog_class']]."</td>"; 
				 else echo "><div align=\"center\"><a href=\"?action=add&blog_class={$_REQUEST['blog_class']}\">添加".$blog_type[$_REQUEST['blog_class']]."</a> </div></td>";
			    ?>
			   </tr>
             </table>
         </div></td>
       </tr>
       <tr>
         <td colspan="2" bgcolor="#FFFFFF"><div align="center">
             <table width="100%"  border="0" cellspacing="0" cellpadding="5">
               <tr>
                 <td height="200" valign="top">
                     <?php if($_REQUEST['action']=="edit"||$_REQUEST['action']=="add") { ?>
					  <form name="form1" method="post" action="" enctype="multipart/form-data"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					   <tr>
						 <td> <div align="center">
						   <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                             <tr>
                               <td width="90"><div align="center"><?=$blog_type[$_REQUEST['blog_class']]?>标题</div></td>
                               <td><input name="title" type="text" class="INPUT" id="title" value="<?=$row->infor_title?>" size="30">
							    <?php 
								if($_REQUEST['action']=="edit") 
								echo "<input name=\"action\" type=\"hidden\" id=\"action\" value=\"edit\">";
								else echo "<input name=\"action\" type=\"hidden\" id=\"action\" value=\"add\">";?>
							   </td>
                               <td width="90"><div align="center">可读对象                                 </div></td>
                               <td><select name="show_attribute" class="INPUT">
                                 <?php    
									    $conArray = &$blog_show ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($_REQUEST['action']=="add") { if($con_name=="0") echo " selected";}
										elseif($_REQUEST['action']=="edit") { if($con_name==$row->show_attribute) echo "selected"; }
										echo ">{$$con_name}</option>";
										}
	                                ?>
                               </select></td>
                             </tr>
                             <tr>
                               <td><div align="center"><?=$blog_type[$_REQUEST['blog_class']]?>分类</div></td>
                               <td colspan="3">
							    <select name="folder_name" class="INPUT">
                                <?php 
								$result_row=mysql_query("select distinct folder_name from ".$table_suffix."member_blog where user_name='{$_SESSION['user_name']}' and blog_class='{$_REQUEST['blog_class']}'");
			                    if(!@mysql_num_rows($result_row)) echo "<option value=\"没有分类\">没有分类</option>";
								while($folder_row=@mysql_fetch_object($result_row)) {
                                echo "<option value=\"{$folder_row->folder_name}\"";
								if($row->folder_name==$folder_row->folder_name) echo "selected";
								echo ">{$folder_row->folder_name}</option>";
								 }
								 ?>
							   </select>
                                 　另外添加新的分类
                                 <input name="add_folder" type="text" class="INPUT" id="add_folder" size="10">                                 <div align="center"></div></td>
                               </tr>
                             <tr>
                               <td><div align="center">加标签</div></td>
                               <td colspan="3"><input name="keywords" type="text" class="INPUT" id="keywords" value="<?=$row->keywords?>"> 
                                 *汉字限30个以内,用空格间隔</td>
                               </tr>
                           </table>
                           <?php  
								 if($_REQUEST['blog_class']=="album") require_once("inc/blog_album_inc.php");
								 else {
								 $oFCKeditor = new FCKeditor('body') ;
								 $oFCKeditor->BasePath	= 'member_editor/';
								 $oFCKeditor->Width		= '100%';
								 $oFCKeditor->Height    = '400';
								 $oFCKeditor->Value		= $row->content ;
								 $oFCKeditor->ToolbarSet= "Small";
								 $oFCKeditor->Create() ;
								 }
						     ?>
						 </div></td>
					   </tr>
					   <tr>
						 <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
						   <tr>
							 <td width="100"><div align="center">
							   <input name="submit_s" type="submit" class="button" id="submit_s" value="提  交" onclick="return check_title();">
							 </div></td>
							 <td width="50"><div align="center">
							   <input name="blog_class" type="hidden" id="blog_class" value="<?=$_REQUEST['blog_class']?>">
							 </div></td>
							 <td>
							   <div align="left">
								 <input name="Submit2" type="button" class="button" value="放  弃" onclick="history.go(-1);">
							   </div></td>
						   </tr>
						 </table></td>
					   </tr>
					 </table>
					 </form><?php } 
					  else if($_REQUEST['action']=="view") { 
					  $md5_idkey=md5($_SESSION['user_name']);
					 ?>
					 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td id="con">
						 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                           <tr>
                             <td><div align="center" class="newstitle"><?=$row->infor_title?></div></td>
                           </tr>
                         </table></td>
                       </tr>
                       <tr>
                         <td><div align="center">标签: <?=$row->keywords?>  发布时间:<?=substr($row->post_time,3,11)?> 最后修改:<?=substr($row->last_modify,3,11)?></div></td>
                       </tr>
                       <tr>
                         <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                           <tr>
                             <td><?php if($_REQUEST['blog_class']=="album")  echo "<strong>[相册介绍]</strong> ";  echo $row->content;?></td>
                           </tr>
                         </table></td>
                       </tr>
                     </table>
					 <?php 
					 if($_REQUEST['blog_class']=="album") require_once("inc/blog_album_inc.php"); ?></td>
                       </tr>
                     </table>
					 <?php } ?>
					 </td>
               </tr>
             </table>
         </div></td>
       </tr>
     </table></td>
   </tr>
 </table> 
 <?php   }  ?></TD>
                </TR>
              </TBODY>
          </TABLE>
		  <?php } //blog class is valid
		  ?>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php"); 
	   } else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>