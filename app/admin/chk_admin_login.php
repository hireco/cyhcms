<?php session_start(); if(isset($_SESSION['root'])) { ?>
<html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<!-- InstanceBeginEditable name="doctitle" -->
<?php 
      require_once("setting.php"); 
      require_once(RROOT."/dbscripts/db_connect.php");     
?>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
--> 
</style></head>
 
<body>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="头部" --><?php require_once(RROOT."/admin/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/bg_login.gif">
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="主体" -->
         <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/foot_navi.jpg">
           <tr>
             <td width="10" height="30">&nbsp;</td>
             <td valign="bottom"><table height="20" border="0" align="left" cellpadding="0" cellspacing="0" background="image/b2.gif">
                 <tr align="center" valign="bottom">
                  <td width="69" height="20" background="image/b2.gif"><div align="center"><a href="admin_id_edit.php">修改密码</a></div></td>
                  <td width="69" height="20" background="image/b2.gif"><div align="center"><a href="admin_id_list.php">用户管理</a></div></td>
                 <?php if($_SESSION['root']=="super_administrator") { ?><td width="69" background="image/b1.gif"><a href="chk_admin_login.php">登录情况</a></td>
                 <?php } ?>
                 </tr>
             </table></td>
           </tr>
         </table>
          <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/search_bar_bg.gif">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
		  <?php if($_SESSION['root']=="super_administrator") { 
		  if($_REQUEST['action']=="delete") {  
		   $query="select * from ".$table_suffix."admin_record order by id desc"; $result=@mysql_query($query);
		   if($result) $mini_id=@mysql_result($result,99,"id");
		   if($mini_id) {		
		   $query="delete from ".$table_suffix."admin_record where id<$mini_id";
		   $result=@mysql_query($query);
		   if(!$result) echo "DATABASE QUERY FAILED! PLEASE TRY AGAIN!";
		     }
		   }
		  ?>		  
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF">
			  <?php 
			     $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
				 $per_page_num=20;
				 $query="select * from ".$table_suffix."admin_record order by id desc";
			     $rows=@mysql_query($query); 
				 if(!$rows) echo "ERROR! DATABASE QUERY CANNOT BE DONE!";
				 $num=@mysql_num_rows($rows);
				 $page=intval(($num-1)/$per_page_num)+1;
				 if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
				 $page_front=($page_id<=1)?1:($page_id-1); 
				 $page_behind=($page_id>=$page)?$page:($page_id+1); 
				 @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
			   ?>
			  <?php if($num) { ?>
              <table width="100%"  border="0" cellpadding="2" cellspacing="1" bgcolor="#EFF7FF">
                <tr bgcolor="#CC9999">
                  <td  nowrap><div align="left" >编号</div></td>
				  <td  nowrap><div align="left" >姓名</div></td>
                  <td  nowrap><div align="left" >账号</div></td>
                  <td  nowrap><div align="left" >登录时间</div></td>
                  <td  nowrap><div align="left" >登录IP</div></td>
                </tr>
                <?php  
				for($i=1;$i<=$per_page_num;$i++)
				{
				if($row=@mysql_fetch_object($rows)){  ?>
				<tr> 
				  <td nowrap><div align=left><?=$row->id?></div></td>
                  <td nowrap bgcolor="#99CCFF"><div align=left> <?=$row->real_name?></div></td>
				  <td nowrap bgcolor="#CCFFFF"><div align=left> <?=$row->admin_id?></div></td>
				  <td nowrap><div align=left> <?=$row->login_time?></div></td>
				  <td nowrap bgcolor="#FFFFCC"><div align=left> <?php echo $row->login_ip;?> </div></td>
				  </tr> 
				  <?php
				   }
				}
				?>
              </table>
			  <?php } ?>
			  <?php if($num>100) { ?>
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20">&nbsp;</td>
                  <td>注：若要清除历史记录，只保留最新的100条记录，请<a href="<?=$PHP_SELF?>?action=delete"><font color=red>点击此处</font></a></td>
                </tr>
              </table>
			  <?php } ?>
			  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><form name="form_page" style="margin:0px"  method="get" action="<?=$PHP_SELF?>">
                      <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D4BFAA">
                        <tr valign="middle">
                          <td nowrap><div align="center">共找到<?php echo $num;?>条记录</div></td>
						  <?php if($num) { ?>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page_front; ?>">前一页</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page_behind; ?>">后一页</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo "1"; ?>">第一页</a></div></td>
                          <td nowrap><div align="center"><a href="<?=$PHP_SELF?>?page_id=<?php echo $page; ?>">最后一页</a></div></td>
                          <td nowrap><div align="center">去第<input name="page_id" type="text" id="page_id" size="4" onkeyup="value=value.replace(/[^\d]/g,'') " 
								onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" >页</div></td>
                          <td nowrap><div align="center">第<?php echo $page_id;?>页</div></td>
                          <td nowrap>共<?php echo $page; ?> 页</td>
						 <?php }?>
                        </tr>
                      </table>
                  </form></td>
                </tr>
              </table></td>
            </tr>
          </table>
		  <?php } else { ?>
		  
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFE7E7">您不是超级管理员，没有权限访问此页！</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFF3EF"><a href="javascript:history.go(-1)">点击返回</a></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table>
		  <script> alert("对不起，您无权访问此页！");</script>
		  <?php } ?>
		 
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!-- InstanceBeginEditable name="脚部" --><?php require_once("scripts/footer.php");?><!-- InstanceEndEditable --></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php } else  require_once("login_wrong.php"); ?>


