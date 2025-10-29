<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
   
   if(isset($_REQUEST['select_list'])) {
    $nowtime=date("y-m-d H:i:s");
	$select_id=explode(",", $_REQUEST['select_list']);
	while($temp=each($select_id)) { 
	$temp2=$temp["value"];
	if(isset($_REQUEST['delete'])) { 
	  $delete_user=mysql_result(mysql_query("select user_name from  ".$table_suffix."member where id={$temp2}"),0,"user_name");
	  mysql_query("delete from  ".$table_suffix."member where user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."member_guestbook where to_user_name='{$delete_user}' or from_user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."member_url where user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."member_infor where user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."blog_cfg where user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."blog_comment where user_name='{$delete_user}'");
	  mysql_query("delete from  ".$table_suffix."visitor_list where visitor_id='{$delete_user}' or visited_id='{$delete_user}'");
	  
	  //删除不全,故不采用
	  //mysql_query("delete ".$table_suffix."member_blog .*,  ".$table_suffix."picture .*, ".$table_suffix."picture_msg .*  from  ".$table_suffix."member_blog left join ".$table_suffix."picture on ".$table_suffix."member_blog.id =".$table_suffix."picture.object_id  
	  //left join ".$table_suffix."picture_msg on ".$table_suffix."picture.id =".$table_suffix."picture_msg.pic_id 
	  //where ".$table_suffix."picture .object_class='member'  and ".$table_suffix."member_blog .user_name='{$delete_user}' and ".$table_suffix."member_blog .blog_class='album'");
      
	  $result=mysql_query("select id from ".$table_suffix."member_blog  where user_name='{$delete_user}' and blog_class='album'");
	  $list=0;
	  while($row=mysql_fetch_object($result)) {
	   $blog_list[$list]=$row->id;
	   $list++;
	  }
	  $blog_list=implode(",",$blog_list);
	  
	  mysql_query("delete from ".$table_suffix."picture where object_id in ({$blog_list}) and object_class='member'");
	  mysql_query("delete from ".$table_suffix."picture_msg where object_id in ({$blog_list}) and object_class='member'");
	  
	  mysql_query("delete from  ".$table_suffix."member_blog  where user_name='{$delete_user}'");
	   
	 }
	else if(isset($_REQUEST['check'])) mysql_query("update ".$table_suffix."member set checked=IFNULL(checked=0,0) where id={$temp2}");
	else if(isset($_REQUEST['top'])) mysql_query("update ".$table_suffix."member set top=IFNULL(top=0,0),top_time='$nowtime' where id={$temp2}");
	else if(isset($_REQUEST['recommend'])) mysql_query("update ".$table_suffix."member set recommend=IFNULL(recommend=0,0),recommend_time='$nowtime' where id={$temp2}");
	else if(isset($_REQUEST['qualified'])) mysql_query("update ".$table_suffix."member set qualified=IFNULL(qualified=0,0 ) where id={$temp2}");
	else if(isset($_REQUEST['modified_ok'])) mysql_query("update ".$table_suffix."member set modified_ok=IFNULL(modified_ok=0,0) where id={$temp2}");
	 }
	echo "<script>parent.location.reload()</script>";
	exit;
    }
   
   $query="select * from ".$table_suffix."member where 1=1";
   
   $per_page_num=isset($_REQUEST['per_page_num'])?$_REQUEST['per_page_num']:15;
   $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
   $rows=@mysql_query($query);
   $num=@mysql_num_rows($rows);
   $page=intval(($num-1)/$per_page_num)+1;
   if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
   $page_front=($page_id<=1)?1:($page_id-1); 
   $page_behind=($page_id>=$page)?$page:($page_id+1); 
   @mysql_data_seek($rows, ($page_id-1)*$per_page_num);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>文档管理</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td><img src="../image/body_title_left.gif" width="3" height="27"></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">会员管理</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<br>
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">ID</div></td>
        <td><div align="center">选择</div></td>
        <?php if(isset($_REQUEST['picture'])) { ?>
		<td><div align="center">用户图片</div></td>
		<?php  } ?>
		<td><div align="left">用户名</div></td>
		<td><div align="left">用户昵称</div></td>
		<td><div align="left">中/英文姓名</div></td>
        <td><div align="center">用户级别</div></td>
		<td><div align="center">首次审查</div></td>
		<?php if(isset($_REQUEST['picture'])) { ?>
		<td><div align="left">审批图片</div></td>
		<?php  } ?>
        <td width="80">  <div align="center">更新审查   </div></td>
        <td width="80"><div align="center">身份认证</div></td>
        <td width="50"><div align="center">删除</div></td>
        <td width="50"><div align="center">置顶</div></td>
        <td width="50"><div align="center">推荐</div></td>
      </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
		<?php if(isset($_REQUEST['picture'])) { ?>
        <td nowrap width=100><div align="center">				
		</div></td><?php } ?>
		<td><div align="left">
		  <a href="member_show.php?id=<?=$row->id?>" style="text-decoration:underline "><?=$row->user_name?></a>		</div></td>
		<td>
		  <div align="left">
		    <?=$row->nick_name?>
		  </div></td>
		<td>
          <div align="left"><?php echo $row->cn_name==""?($row->en_name==""?"未填":$row->en_name):($row->cn_name." ".($row->en_name==""?"":$row->en_name));?></div></td>
		<td>              <div align="center">
		  <?=$mem_level[$row->user_level]?>
		</div></td><td><div align="center"><a href="#" onClick="no_show2('member_admin.php?check=yes&select_list=<?=$row->id?>')">
		      </a><a href="#" onClick="no_show2('member_admin.php?check=yes&select_list=<?=$row->id?>')"><?php echo $row->checked=="1"?"已通过":"<font color=red>未通过</font>"; ?></a>
		      </div></td>
		<?php if(isset($_REQUEST['picture'])) { ?>
        <td nowrap width=100><div align="center">				
		</div></td><?php } ?>
		<td>
		  <div align="center"><a href="#" onClick="no_show2('member_admin.php?modified_ok=yes&select_list=<?=$row->id?>')">
		      <?php if($row->modified_ok=="1") echo "已审查"; else echo "<font color=red>未审查</font>"; ?>
	        </a></div></td>
        <td><div align="center"><a href="#" onClick="no_show2('member_admin.php?qualified=yes&select_list=<?=$row->id?>')">
            <?php if($row->qualified=="1") echo "已认证"; else echo "<font color=red>未认证</font>"; ?>
        </a></div></td>
        <td><div align="center"><a href="#" onClick="if(really()) no_show2('member_admin.php?delete=yes&select_list=<?=$row->id?>')">删除</a></div></td>
        <td><div align="center"><a href="#" onClick="no_show2('member_admin.php?recommend=yes&select_list=<?=$row->id?>')">
            <?php if($row->recommend=="1") echo "已推荐"; else echo "<font color=red>未推荐</font>"; ?>
        </a></div></td>
        <td><div align="center"><a href="#" onClick="no_show2('member_admin.php?top=yes&select_list=<?=$row->id?>')">
            <?php if($row->top=="1") echo "已置顶"; else echo "<font color=red>未置顶</font>"; ?>
        </a></div></td>
	   </tr>
	   <?php } 
	     }
	   ?>	
    </table>
	</form></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="全选" onClick="sel_arc();"></td>
        
        <td>&nbsp;</td>
        <td><input name="reply_ji" type="button" class="inputbut" value="首次审查" onclick="no_show('member_admin.php','check');"></td>
        <td>&nbsp;</td>
		<td><input name="reply_sh" type="button" class="inputbut" value="身份认证" onclick="no_show('member_admin.php','qualified');"></td>
        <td>&nbsp;</td>
		<td><input name="reply_new" type="button" class="inputbut" value="更新审查" onclick="no_show('member_admin.php','modified_ok');"></td>
        <td>&nbsp;</td>
		<td><input name="reply_arc" type="button" class="inputbut" value="置顶" onclick="no_show('member_admin.php','top');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="推荐" onclick="no_show('member_admin.php','recommend');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('member_admin.php','delete');"></td>
        <td>&nbsp;</td>
        <td><input name="select_list" type="hidden"></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td width="50%"><div align="right">第<?=$page_id?>页/共<?=$page?>页(<?=$num?>条记录)</div></td>
    <td><div align="center">
      <table border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php require_once("function/page_divide.php"); ?></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
</body>
</html>
<script>
function really() {
      result="将删除全部与之相关的数据,确定吗？";   
       if   (confirm(result))    return true; 
       else return false;
 }

function sel_arc()
{
	var sel_arc = document.getElementById('sel_arc');
	if(sel_arc.value=="全选"){
	for(i=0;i<document.form1.obj_id.length;i++)
	{
		if(!document.form1.obj_id[i].checked)
		{
			document.form1.obj_id[i].checked=true;
		}
	}
	 sel_arc.value="取消";
	 }
    else {
	for(i=0;i<document.form1.obj_id.length;i++)
	{
		if(document.form1.obj_id[i].checked)
		{
			document.form1.obj_id[i].checked=false;
		}
	}
	 sel_arc.value="全选";
   }
}

function  get_select_list() {
  var i=0,  abbr=document.all.obj_id, abbr2=document.all.select_list;
  if(abbr.length>=2) {
  for(i=0;i<abbr.length;i++) if(abbr[i].checked) 
  if(i==0) abbr2.value=abbr[i].value; 
  else abbr2.value=abbr2.value+","+abbr[i].value;
  }
  else abbr2.value=abbr.value;
  return abbr2.value;
}

function no_show(url,link_type){ 
 url_all=url+"?"+link_type+"=yes&select_list="+get_select_list();
 window.open(url_all,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}

function no_show2(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}

function opendwin(url)
{ window.open(url,"","height=600,width=820,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}
</script>