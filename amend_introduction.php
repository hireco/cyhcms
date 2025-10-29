<?php session_start();?>
<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once($cfg_admin_root."function/inc_function.php");?>
<?php require_once("member_editor/fckeditor.php");  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
</head>
<body onLoad="resizeImages(<?=$cfg_body_width?>);">
<?php
    require_once("center_header.php");  
    if(isset($_SESSION['user_name'])) { 
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
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 自我介绍</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top height=300 id="td_par">
 <?php if(isset($_POST['submit_s'])) {
	     
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
			$nowtime=date("y-m-d H:i:s");
			
			$result=mysql_query("select * from  ".$table_suffix."member_infor  where user_name='{$_SESSION['user_name']}'");
			if(mysql_num_rows($result))  $result=mysql_query("update  ".$table_suffix."member_infor  set content = '$content', html='1', last_modify='$nowtime' where user_name='{$_SESSION['user_name']}'");
			else  $result=mysql_query("insert into  ".$table_suffix."member_infor  (content,user_name,html,last_modify) values ('$content','{$_SESSION['user_name']}','1','$nowtime')");
			
			if($result) ShowMsg("成功更新个人资料","amend_introduction.php");
			else  ShowMsg("更新失败,请重来",-1);  
		
        } 
     else{ 
	    $result=mysql_query("select * from ".$table_suffix."member_infor where user_name='{$_SESSION['user_name']}'");
	    if(!$result) ShowMsg("Sorry,访问出错或者数据库读错误",-1);
 		else { 
		  $row=mysql_fetch_object($result); 
	   ?>
   <table width="100%" height="450"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3" >
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
                 <?php  
				 echo "<td"; 
				 if(!isset($_REQUEST['edit_intro'])) echo " bgcolor=\"#FFFFFF\"><div align=\"center\">查看内容</div></td>"; 
				 else echo "><div align=\"center\"><a href=\"?view_intro\" style=\"text-decoration:underline \" >查看内容</a></div></td>";
				 echo "<td ";
				 if(isset($_REQUEST['edit_intro']))  echo " bgcolor=\"#FFFFFF\"><div align=\"center\">编辑介绍</div></td>"; 
				 else echo "><div align=\"center\"><a href=\"?edit_intro\" style=\"text-decoration:underline \" >编辑介绍</a> </div></td>";
				  ?>
               </tr>
             </table>
         </div></td>
         <td bgcolor="#D0D2E3"><div align="center">
           <table width="90%"  border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td><div align="right">
                     <?php if($row) echo "更新时间：".substr($row->last_modify,3,11); ?>
               </div></td>
             </tr>
           </table>
         </div></td>
       </tr>
       <tr>
         <td colspan="2" bgcolor="#FFFFFF"><div align="center">
             <table width="100%"  border="0" cellspacing="0" cellpadding="5">
               <tr>
                 <td height="200" valign="top">
                     <?php if(isset($_REQUEST['edit_intro'])) { ?>
					  <form name="form1" method="post" action=""><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					   <tr>
						 <td> <div align="center"><?php  
						 $oFCKeditor = new FCKeditor('body') ;
						 $oFCKeditor->BasePath	= 'member_editor/';
						 $oFCKeditor->Width		= '100%';
						 $oFCKeditor->Height    = '400';
						 $oFCKeditor->Value		= $row->content ;
						 $oFCKeditor->ToolbarSet= "Small";
						 $oFCKeditor->Create() ;
							 ?>
						  </div></td>
					   </tr>
					   <tr>
						 <td><table width="100%"  border="0" cellspacing="0" cellpadding="10">
						   <tr>
							 <td width="100"><div align="center">
							   <input name="submit_s" type="submit" class="button" id="submit_s" value="提  交">
							 </div></td>
							 <td width="50"><div align="center"></div></td>
							 <td>
							   <div align="left">
								 <input name="Submit2" type="button" class="button" value="放  弃" onclick="history.go(-1);">
							   </div></td>
						   </tr>
						 </table></td>
					   </tr>
					 </table>
					 </form>
<?php } else if($row) { ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="con"><?php echo $row->content;?></td>
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
 <?php  
       }
	 }
?></TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php"); ?>
<?php 
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>
