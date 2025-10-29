<?php 
session_start(); 
require_once("setting.php");
require_once("inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
require_once(dirname(__FILE__)."/scripts/constant.php");

if(!isset($_REQUEST['return_form'])) $_REQUEST['return_form']="similar_id";

$turn=$_REQUEST['list_turn']==""?"id":$_REQUEST['list_turn'];
$keywords=$_REQUEST['keywords'];

if((isset($_REQUEST['class_id']))&&($_REQUEST['class_id']<>"")) {
 $cur_position=$_REQUEST['class_name'].">"; 
 define("DISPLAY_WHAT", "class");
 if(isset($_REQUEST['admin'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and poster='{$_SESSION['real_name']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['recommend'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and recommend = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['latest'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and new_or_not = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['uncheck'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and checked = '0'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['picture'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and picture!= ''  and keywords like '%{$keywords}%' order by  {$turn} desc";
 else 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and keywords like '%{$keywords}%' order by  {$turn} desc";
}

elseif(isset($_REQUEST['infor_class'])) { 
 $query="select * from ".$table_suffix."infor_class where class_name='{$_REQUEST['infor_class']}'";
 $result=mysql_query($query); 
 if($row=mysql_fetch_object($result)) { 
   $cur_position="全部".$row->chinese_name.">";
   define("DISPLAY_WHAT", "all");
 if(isset($_REQUEST['admin'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where poster='{$_SESSION['real_name']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['recommend'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where recommend = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['latest'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where new_or_not = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['uncheck'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where checked = '0'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['picture'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where picture!= ''  and keywords like '%{$keywords}%' order by  {$turn} desc";
 else 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where  1 and keywords like '%{$keywords}%' order by  {$turn} desc";
    }
 else { 
   ShowMsg("该栏目不存在！","-1");
   exit();
   }
 }
else { 
  ShowMsg("请选择操作栏目！","-1");
  exit();
 } 
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
<body onLoad="ContextMenu.intializeContextMenu()">
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
                  <div align="center">文档列表</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table></td>
    <td width="120"><div align="center">
      <select name='channelid' style='width:110px' onchange="location=this.value;">
         <?php
		 	$query="select * from ".$table_suffix."infor_class order by id asc";
			$result=mysql_query($query); 
			while($row=mysql_fetch_object($result)) {
			?><option value="?infor_class=<?=$row->class_name?>" <?php if($_REQUEST['infor_class']==$row->class_name) { $infor_class_name=$row->chinese_name; echo "selected"; }?>><?=$row->chinese_name?></option><?php } ?>
      </select>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td><?=$cur_position?>文档列表 &nbsp;(请选择文章)</td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">ID</div></td>
        <td><div align="center">选择</div></td>
        <td><div align="left">文章标题</div></td>
		<?php if(DISPLAY_WHAT=="class") { ?>
		<td><div align="center">栏目属性</div></td>
        <?php } else { ?>
		<td><div align="center">所属栏目</div></td>
        <?php } ?>
		<td><div align="center">发布者</div></td>
        <td><div align="center">发布时间</div></td>
        <td><div align="center">点击数</div></td>
        <td><div align="center">显示属性</div></td>
		<td><div align="center">置顶期</div></td>
		<td><div align="center">显示级别</div></td>        
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 $query="select class_name from ".$table_suffix."infor  where id = {$row->class_id}";
			 $result=mysql_query($query);
			 $class_name=@mysql_result($result,0,"class_name");
	   ?>
	   <tr bgcolor="#FFFFFF"  onMouseMove="javascript:this.bgColor='#FFFFCC';" onMouseOut="javascript:this.bgColor='#FFFFFF';" height="22" >
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="arc_id" value="<?=$_REQUEST['infor_class'].":".$row->id?>" onClick="set_name();">
        </div></td>
        <td><div align="left">
		<a style="text-decoration:underline;" href="../archive_view.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$row->class_id?>&id=<?=$row->id?>&article_title=<?=urlencode($row->article_title)?>" target="_blank" >
		<?php echo msubstr($row->article_title,0,50); 
		      if($row->recommend=="1") echo "<font color=blue>[荐]</font>";
			  if($row->title_bold=="1") echo "<font color=black>[粗]</font>";
			  if($row->picture<>"") echo "<font color=violet>[图]</font>";
			  if($row->new_or_not=="1") echo "<font color=red>[新]</font>";
		?></a></div></td>
        <?php if(DISPLAY_WHAT=="class") { ?>
		<td><div align="center"><?=$infor_class_name?></div></td>
        <?php } else { ?>
		<td><div align="center"><?=$class_name?></div></td>
        <?php } ?>		
        <td><div align="center"><?php echo $row->poster==""?"<font color=green>匿 名</font>":$row->poster; ?></div></td>
        <td><div align="center"><?=substr($row->post_time,0,8)?></div></td>
        <td><div align="center"><?=$row->read_times?></div></td>
        <td><div align="center"><?=$show_attribute[$row->show_attribute]?></div></td>
		<td><div align="center"><?=$top_se[$row->top]?></div></td>
		<td><div align="center"><?=$hide_type[$row->hide_type]?></div></td>
        </tr>
	   <?php } 
	     }
	   ?>	
    </table>
	</form>
	</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="全选" onClick="sel_arc();"></td>
        <td>&nbsp;</td>
        <td><input name="edit_arc" type="button" class="inputbut" value="写入ID" onClick="ReturnValue('<?=$_REQUEST['return_form']?>');"></td>
        <td>&nbsp;</td>
        <td><input type="button" name="close" class="inputbut" value="关闭" onclick="window.close();"></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td><div align="center">
      <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php require_once("function/page_divide.php"); ?></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td width="50%"><div align="right">第<?=$page_id?>页/共<?=$page?>页(<?=$num?>条记录)</div></td>
    <td><div align="center"></div></td>
  </tr>
</table>
<?php require_once(dirname(__FILE__)."/scripts/arc_search.php");?> 
</body>
</html>
<script>
function ReturnValue(similar_id)
{   var obj=window.opener.document.getElementById(similar_id);
    var old_str=obj.value;
    var add_str=getCheckboxItem();
	if(add_str=="") { alert("请选择文档!");  return false; }
	
	if(old_str.indexOf(",")==-1) 	old_str = add_str; 
	
	else { 
	var flag_same=0;
	var add_str_i=add_str.split(",");
	var add_to="";
	 for(i=0;i<add_str_i.length;i++) {
	 if(old_str.indexOf(add_str_i[i])>-1) { flag_same=1; continue; } 
	 else { 
	      if(add_to=="") add_to =add_str_i[i];
		  else add_to +=","+add_str_i[i];
	    }
	  }
	  if(add_to!="")  old_str =old_str.replace(/[ ]/g,"") + "," + add_to;
	}
	
	obj.value=old_str;
	
	if(flag_same==1) alert("重复的ID被清除!");
	
	unsel_arc();
}

function sel_arc()
{
	var sel_arc = document.getElementById('sel_arc');
	if(sel_arc.value=="全选"){
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(!document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=true;
		}
	}
	 sel_arc.value="取消";
	 }
    else {
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=false;
		}
	}
	 sel_arc.value="全选";
   }
}

function getCheckboxItem()
{
	var allSel="";
	if(document.form1.arc_id.value) {
		allSel=document.form1.arc_id.value;
		return  allSel;
	 }
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			if(allSel==""){
				allSel=document.form1.arc_id[i].value;
			   }
			else{
				addSel_i=document.form1.arc_id[i].value;
				allSel=allSel+","+addSel_i;
			   }
		}
	}
	return allSel;	
}

function unsel_arc() {
 var sel_arc = document.getElementById('sel_arc');
 for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=false;
		}
	}
  sel_arc.value="全选";
}
function set_name() {
 var sel_arc = document.getElementById('sel_arc');
 for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)  { sel_arc.value="取消";  break; }
		else if(i+1==document.form1.arc_id.length) { sel_arc.value="全选"; break; } 
	}
}
</script>