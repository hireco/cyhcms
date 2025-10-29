<?php 
session_start(); 
require_once("setting.php");
require_once("inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
require_once(dirname(__FILE__)."/scripts/constant.php");

if(!isset($_REQUEST['return_form'])) $_REQUEST['return_form']="receiver";
   if(isset($_REQUEST['member_level']))   
   { if($_REQUEST['member_level']<5) $query="select * from ".$table_suffix."member where user_level='{$_REQUEST['member_level']}'";
     else $query="select * from ".$table_suffix."admin where 1=1";
	}
   else $query="select * from ".$table_suffix."member where 1=1";
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
                  <div align="center">会员列表</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table></td>
    <td width="120"><div align="center">
      <select name='member_level' style='width:110px' onchange="location=this.value;">
        <?php    
				for($i=1;$i<=count($inner_type);$i++){
				if($i<>4) echo "<option value='?member_level=$i'"; 
				else  echo "<option value='member_list.php'"; 
				if($i==$_REQUEST['member_level']) echo " selected";
				else if($i=="0") echo " selected";
				echo ">{$inner_type[$i]}</option>";
				}
	            ?> 
	  </select>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td>会员列表 &nbsp;(请选择会员)</td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<?php if($_REQUEST['member_level']==5) { ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">选择</div></td>
        <td><div align="left">用户姓名</div></td>
		<td><div align="left">用户笔名</div></td>
		<td><div align="left">用户帐号</div></td>
		<td><div align="center">用户级别</div></td>
		<td><div align="center">注册日期</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 
	   ?>
	   <tr bgcolor="#FFFFFF"  onMouseMove="javascript:this.bgColor='#FFFFCC';" onMouseOut="javascript:this.bgColor='#FFFFFF';" height="22" >
       <td><div align="center">
          <input type="checkbox" name="arc_id" value="<?=$row->admin_id?>" onClick="set_name();">
        </div></td>
		<td bgcolor="#FFFFFF"><div align="left"><?php echo $row->real_name;?></div></td>
        <td bgcolor="#FFFFFF"><div align="left"><?php echo $row->writer_name;?></div></td>
		<td bgcolor="#FFFFFF"><div align="left"><?php echo $row->admin_id;?></div></td>
        <td><div align="center"><?php echo $row->admin_level?>级</div></td>
        <td><div align="center"><?php echo substr($row->register_time,3,8)?></div></td>
        </tr>
	   <?php } 
	     }
	   ?>	
    </table>
	
	<?php } else { ?>
	 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">选择</div></td>
        <td><div align="left">用户姓名</div></td>
		<td><div align="left">用户昵称</div></td>
		<td><div align="left">用户帐号</div></td>
		<td><div align="center">用户级别</div></td>
		<td><div align="center">注册日期</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 
	   ?>
	   <tr bgcolor="#FFFFFF"  onMouseMove="javascript:this.bgColor='#FFFFCC';" onMouseOut="javascript:this.bgColor='#FFFFFF';" height="22" >
        <td><div align="center">
          <input type="checkbox" name="arc_id" value="<?=$row->user_name?>" onClick="set_name();">
        </div></td>
		<td bgcolor="#FFFFFF"><div align="left"><a href="member_show.php?id=<?=$row->id?>" target="_blank" style="text-decoration:underline; "><?php echo $row->cn_name==""?($row->en_name==""?"<font color=green>未 填</font>":$row->en_name):$row->cn_name; ?></a></div></td>
        <td bgcolor="#FFFFFF"><div align="left"><?php echo $row->nick_name;?></div></td>
		<td bgcolor="#FFFFFF"><div align="left"><?php echo $row->user_name;?></div></td>
        <td><div align="center"><?php echo $mem_level[$row->user_level]?></div></td>
        <td><div align="center"><?php echo substr($row->register_time,3,8)?></div></td>
        </tr>
	   <?php } 
	     }
	   ?>	
    </table>
	<?php } ?>
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
</body>
</html>
<script>
function ReturnValue(receiver)
{   var obj=window.opener.document.getElementById(receiver);
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