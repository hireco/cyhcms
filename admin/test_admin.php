<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
   
   if(isset($_REQUEST['select_list'])) {
    $select_id=explode(",", $_REQUEST['select_list']);
	while($temp=each($select_id)) { 
	$temp2=$temp["value"];
	$this_time=date("y-m-d H:i:s");
	if(isset($_REQUEST['delete'])) { 
	if($_SESSION['root']=="super_administrator") mysql_query("delete from  ".$table_suffix."test where id={$temp2}");
	else mysql_query("delete from  ".$table_suffix."test where id={$temp2} and locked='0'");
	}
	else if(isset($_REQUEST['hide'])) { 
	if($_SESSION['root']=="super_administrator")  mysql_query("update ".$table_suffix."test set hide=IFNULL(hide=0,0 ) where id={$temp2}");
	else mysql_query("update ".$table_suffix."test set hide=IFNULL(hide=0,0 ) where id={$temp2} and locked='0'");
	}
	else if(isset($_REQUEST['checked'])) {
	if($_SESSION['root']=="super_administrator") mysql_query("update ".$table_suffix."test set checked=IFNULL(checked=0,0 ),checker='{$_SESSION['admin_valid']}' where id={$temp2}");
	else  mysql_query("update ".$table_suffix."test set checked=IFNULL(checked=0,0 ),checker='{$_SESSION['admin_valid']}' where id={$temp2} and locked='0'");
	}
	else if(isset($_REQUEST['locked']))  {
	if($_SESSION['root']=="super_administrator") mysql_query("update ".$table_suffix."test set locked=IFNULL(locked=0,0 ) where id={$temp2}");
    else mysql_query("update ".$table_suffix."test set locked=IFNULL(locked=0,0 ) where id={$temp2} and poster='{$_SESSION['admin_valid']}'");
	}
	 }
	if(mysql_affected_rows()) echo "<script>parent.location.reload()</script>";
	else  echo "<script>window.parent.alert(\"没有权限，可能对象被锁定！\");</script>";
	exit;
    }
   
   if(isset($_REQUEST['f']))      $query="select * from ".$table_suffix."test where poster='{$_REQUEST['f']}' order by post_time desc";
   else if(isset($_REQUEST['s'])) $query="select * from ".$table_suffix."test where section='{$_REQUEST['s']}' and  chapter='{$_REQUEST['c']}' and part='{$_REQUEST['p']}' order by post_time desc"; 
   else if(isset($_REQUEST['c'])) $query="select * from ".$table_suffix."test where chapter='{$_REQUEST['c']}' and part='{$_REQUEST['p']}' order by post_time desc"; 
   else if(isset($_REQUEST['p'])) $query="select * from ".$table_suffix."test where part='{$_REQUEST['p']}' order by post_time desc"; 
   else $query="select * from ".$table_suffix."test where 1=1 order by post_time desc"; 
   
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
<?php require_once("scripts/header.php"); ?>
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
                  <div align="center">试题管理</div>
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
	<table width="100%" border="0" cellpadding="10" cellspacing="0">
      <tr>
        <td><div align="center">
            <table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td><input  name="Submit1" type="button" class="inputbut" value="添加试题" onClick="location='test.php';"></td>
                <td>&nbsp;</td>
                <td><?php if(!isset($_REQUEST['f'])) { ?>
                    <input name="Submit2" type="button" class="inputbut" value="我的试题" onClick="location='test_admin.php?r=<?=$_SESSION['real_name']?>&f=<?=$_SESSION['admin_valid']?>';">
                    <?php } else { ?>
                    <input name="Submit3" type="button" class="inputbut" value="全部试题" onClick="location='test_admin.php';">
                    <?php } ?></td>
                </tr>
            </table>
        </div></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
      <tr>
        <td> 试题列表 ><?php	 
		if(isset($_REQUEST['r']))  echo " 由".$_REQUEST['r']."所发布的试题 >"; 
		else{ 
		if(isset($_REQUEST['p']))   echo " <a style=\"text-decoration:underline\" href=?p=".urlencode($_REQUEST['p']).">".$_REQUEST['p']."</a> > ";
		if(isset($_REQUEST['c']))   echo "<a style=\"text-decoration:underline\" href=?p=".urlencode($_REQUEST['p'])."&c=".urlencode($_REQUEST['c']).">".$_REQUEST['c']."</a> > ";
		if(isset($_REQUEST['s']))   echo "<a style=\"text-decoration:underline\" href=?p=".urlencode($_REQUEST['p'])."&c=".urlencode($_REQUEST['c'])."&s=".urlencode($_REQUEST['s']).">".$_REQUEST['s']."</a> > "; 
		
		}
		?></td>
        
	  </tr>
    </table>
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">ID</div></td>
        <td><div align="center">选择</div></td>
        <td><div align="left">试题内容</div></td>
		<td><div align="left">试题所属</div></td>
		<td><div align="left">初始发布</div></td>
		<td><div align="left">最新修改</div></td>
		<td><div align="left">审批者</div></td>
		<td><div align="center">答案</div></td>
        <td><div align="left">测次数(正确率)</div></td>
        <td><div align="center">操作</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			  $query="select real_name from  ".$table_suffix."admin where admin_id='{$row->poster}'";
			  $result=mysql_query($query);
			  $poster_name=mysql_result($result,0,"real_name");
			  
			  $query="select real_name from  ".$table_suffix."admin where admin_id='{$row->last_editor}'";
			  $result=mysql_query($query);
			  $editor_name=mysql_result($result,0,"real_name");
			  
			  if($row->checked=="1") {
			  $query="select real_name from  ".$table_suffix."admin where admin_id='{$row->checker}'";
			  $result=mysql_query($query);
			  $checker_name=mysql_result($result,0,"real_name");
			  }
			  else $checker_name="<font color=red>未审批</font>";
			  
			  $right_percent=$row->right_times*1.0/$row->test_times*100
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td nowrap width=200><div align="left">
		<a href="test_view.php?id=<?=$row->id?>" target="_blank" style="text-decoration:underline"><?=msubstr(strip_tags($row->problem_content),0,30)?></a>
		</div></td>
		<td nowrap width=300><div align="left">
		<a href="?p=<?=urlencode($row->part)?>"        style="text-decoration:underline"><?=$row->part?></a> >
		<a href="?p=<?=urlencode($row->part)?>&c=<?=urlencode($row->chapter)?>"  style="text-decoration:underline"><?=$row->chapter?></a> >
		<a href="?p=<?=urlencode($row->part)?>&c=<?=urlencode($row->chapter)?>&s=<?=urlencode($row->section)?>"  style="text-decoration:underline"><?=$row->section?></a>
		</div></td>
		<td><div align="left"><a href="?f=<?=$row->poster?>&r=<?=urlencode($poster_name)?>" style="text-decoration:underline"><?=$poster_name?></a>(<?=substr($row->post_time,3,8)?>)</div></td>
		<td><div align="left"><?php if($row->post_time==$row->last_time) echo "未曾修改"; else  echo $editor_name."(".substr($row->last_time,3,8).")";?></div></td>
        <td width="50"><div align="left"><?=$checker_name?></div>  </td>
		<td width="50"><div align="center"><?=$row->answer?></div>  </td>
        <td><div align="left"><?php echo $row->test_times."(".$right_percent."%)";?></div></td>
		<td><div align="center"><a href="#" onClick="opendwin('test_edit.php?id=<?=$row->id?>')">编辑</a>|<a href="#" onClick="if(really()) no_show2('?delete=yes&select_list=<?=$row->id?>')">删除</a>|<a href="#" onClick="no_show2('?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="1") echo "显示"; else echo "<font color=red>隐藏</font>"; ?></a>|<a href="#" onClick="no_show2('?checked=yes&select_list=<?=$row->id?>')"><?php if($row->checked=="1") echo "已审"; else echo "<font color=red>审批</font>"; ?></a>|<a href="#" onClick="no_show2('?locked=yes&select_list=<?=$row->id?>')"><?php if($row->locked=="1") echo "已锁"; else echo "<font color=red>锁定</font>"; ?></a></div></td>
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
        <td><input name="reply_arc" type="button" class="inputbut" value="审批" onclick="no_show('test_admin.php','checked');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="隐藏" onclick="no_show('test_admin.php','hide');"></td>
        <td>&nbsp;</td>
		<td><input name="hide_arc" type="button" class="inputbut" value="锁定" onclick="no_show('test_admin.php','locked');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('test_admin.php','delete');"></td>
        <td>&nbsp;</td>
        <td><input name="select_list" type="hidden"></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
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

function really() {
 result="该对象将被删除,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
}
</script>