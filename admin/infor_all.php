<?php session_start(); 
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
require_once(dirname(__FILE__)."/function/string_cutoff.php");
function class_show($m, $n) {
global $post_type,$hide_type, $class_attribute, $table_suffix;
$result=mysql_query("select class_level from ".$table_suffix."infor  order by class_level desc,top desc limit 0,1");
$row0=mysql_fetch_object($result); 
if($n==$row0->class_level) {
 $rows=mysql_query("select * from ".$table_suffix."infor where class_level='$n' and upper_class_id='$m' order by top desc");
  while($row=@mysql_fetch_object($rows)){ 	     
		   $result_name=mysql_query("select * from  ".$table_suffix."infor_class where class_name='{$row->infor_class}'");
		   if($row_name=mysql_fetch_object($result_name))  $chinese_name=$row_name->chinese_name; 
		 ?>
		  <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">		
		  <tr bgcolor="#FFFFFF" >
              <td class="p20" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="left" style="word-wrap:break-word;"><?php for($i=1; $i<=$n;$i++) echo "&nbsp;&nbsp;&nbsp;&nbsp;";?><input type="checkbox" name="class_infor" value="<?php echo $row->id." ".$row->class_name." ".$row->class_level." ".$row->infor_class." ".$chinese_name;?>">
			  <?php echo "<font color=red>[-]</font>"; ?><a href="content_list.php?infor_class=<?=$row->infor_class?>&class_id=<?=$row->id?>&class_name=<?=urlencode($row->class_name)?>"><?php echo $row->class_name?></a>
                </div></td>
              <td class="p30" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px; word-wrap:break-word;"><div align="left" class="small_line"><font color=gray><?=msubstr($row->introduction,0,100)?>...</font></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$class_attribute[$row->class_attribute]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$hide_type[$row->hide_type]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$post_type[$row->post_type]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$row->top?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$row->creator==""?"未知":$row->creator?></div></td>
			  <td width="10%"style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=substr($row->create_time,0,8)?></div></td>
            </tr>
			</table>
		  <?php } 
		

}
else  { 
    $rows=mysql_query("select * from ".$table_suffix."infor where  class_level='$n' and upper_class_id='$m' order by top desc");
    while($row=@mysql_fetch_object($rows)){ 
	$sub_num=@mysql_num_rows(mysql_query("select * from ".$table_suffix."infor where upper_class_id={$row->id} order by top desc")); 
	$result_name=mysql_query("select * from  ".$table_suffix."infor_class where class_name='{$row->infor_class}'");
	if($row_name=mysql_fetch_object($result_name))  $chinese_name=$row_name->chinese_name; 
  ?>
    <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF" >
         <td class="p20" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="left" style="word-wrap:break-word;"><?php for($i=1; $i<=$n;$i++) echo "&nbsp;&nbsp;&nbsp;&nbsp;";?><input type="checkbox" name="class_infor" value="<?php echo $row->id." ".$row->class_name." ".$row->class_level." ".$row->infor_class." ".$chinese_name;?>">
			<?php if($sub_num) echo "<a href=\"javascript:show_div('div{$row->id}');\"><font color=red>[+]</font></a>"; else echo "<font color=red>[-]</font>";  ?><a href="content_list.php?infor_class=<?=$row->infor_class?>&class_id=<?=$row->id?>&class_name=<?=urlencode($row->class_name)?>"><?php echo $row->class_name?></a>
              </div></td>
              <td class="p30"style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px; word-wrap:break-word;"><div align="left" class="small_line"><font color=gray><?=msubstr($row->introduction,0,100)?>...</font></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$class_attribute[$row->class_attribute]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$hide_type[$row->hide_type]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$post_type[$row->post_type]?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$row->top?></div></td>
			  <td class="p8" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=$row->creator==""?"未知":$row->creator?></div></td>
			  <td class="p10"style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="center"><?=substr($row->create_time,0,8)?></div></td>
       </tr>
	   </table>	   
<?php if($sub_num)  { echo "<div id=\"div{$row->id}\" style=\"DISPLAY:block;\">";  class_show($row->id, $n+1); 
		echo "</div>"; }
    }

  } 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style>
  td.p20   {width:20%;}   
  td.p30   {width:30%;}   
  td.p8    {width:8%;}   
  td.p10   {width:10%;}   
</style>
<script>
function getCheckboxItem()
{
	var allSel="";
	if(document.all.class_infor.value) return document.all.class_infor.value;
	for(i=0;i<document.all.class_infor.length;i++)
	{
		if(document.all.class_infor[i].checked)
		{
			allSel=document.all.class_infor[i].value;
		}
	}
	return allSel;	
}
function getSelectItem()
{
	return document.all.infor_class.value;
}

function class_select(action_do)
{   var channels,channel=getSelectItem();
	var qstrs,qstr=getCheckboxItem();
	if(qstr=="") alert("你没选中任何类别！");
	else
	{
		qstrs = qstr.split(" ");
		channels=channel.split(" ");
		if(qstrs[3]!=channels[0]) { alert("选择的属性与栏目属性不符!");  return false; }
		location.href=action_do+"class_id="+qstrs[0]+"&class_name="+qstrs[1]+"&class_level="+qstrs[2]+"&infor_class="+channels[0]+"&chinese_name="+channels[1];
	}
}

function class_select2(action_do)
{   var channels,channel=getSelectItem();
	channels=channel.split(" ");
    location.href=action_do+"infor_class="+channels[0]+"&chinese_name="+channels[1];

}

function class_select3(action_do)
{   var qstrs,qstr=getCheckboxItem();
	if(qstr=="") alert("你没选中任何类别！");
	else
	{
		qstrs = qstr.split(" ");
		location.href=action_do+"class_id="+qstrs[0]+"&class_name="+qstrs[1]+"&class_level="+qstrs[2]+"&infor_class="+qstrs[3]+"&chinese_name="+qstrs[4];
	}
}
function class_select4(action_do)
{
	var qstrs,qstr=getCheckboxItem();
	if(qstr=="") alert("你没选中任何类别！");
	else
	{
		qstrs = qstr.split(" ");
		location.href=action_do+"class_id="+qstrs[0]+"&infor_class="+qstrs[3]+"&class_name="+qstrs[1];
	}
}
function show_div(div_id)
{
div=document.getElementById(div_id);
if(div.style.display=='block') div.style.display='none';
else div.style.display='block';
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="600"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
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
                  <div align="center">内容管理</div>
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

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td bgcolor="#FFFFFF">
		  <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
           <tr bgcolor="#FFFFFF">
			  <td class="p20" nowrap><div align="center">选择-栏目名称</div></td>
			  <td class="p30"><div align="center">栏目描述</div></td>
			  <td class="p8"><div align="center">栏目属性</div></td>
			  <td class="p8"><div align="center">访问权限</div></td>
			  <td class="p8"><div align="center">发布权限</div></td>
			  <td class="p8"><div align="center">置顶序号</div></td>
			  <td class="p8"><div align="center">建立者</div></td>
			  <td class="p10"><div align="center">建立日期</div></td>
		   </tr>		  
          </table>
		  <?php class_show(0,"0");?></td>
        </tr>
    </table>
    <table width="100%"  border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td><table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>选择栏目属性
              <select name="infor_class" style='width:110px'>
            <?php
		 	$query="select * from ".$table_suffix."infor_class order by id asc";
			$result=mysql_query($query); 
			while($row=mysql_fetch_object($result)) {
			?><option value="<?php echo $row->class_name." ".$row->chinese_name?>"><?=$row->chinese_name?></option><?php } ?>
             </select></td>
            <td width="30">&nbsp;</td>
            <td><div align="center">
              <input name="Submit1" type="button" class="inputbut" value="添加顶级栏目" onClick="class_select2('infor_add.php?');">
            </div></td>
            <td width="30"><div align="center"></div></td>
            <td><div align="center">
              <input name="Submit12" type="button" class="inputbut" value="添加下级栏目" onClick="class_select('infor_sub_add.php?');">
            </div></td>
            <td width="30"><div align="center"></div></td>
            <td><div align="center">
              <input name="Submit13" type="button" class="inputbut" value="更改栏目" onClick="class_select3('infor_mod.php?');">
            </div></td>
            <td width="30"><div align="center"></div></td>
            <td><div align="center">
              <input name="Submit15" type="button" class="inputbut" value="栏目详情" onClick="location='infor_detail.php';">
            </div></td>
            <td width="30"><div align="center"></div></td>
            <td><div align="center">
              <input name="Submit152" type="button" class="inputbut" value="信息列表" onClick="class_select4('content_list.php?');">
            </div></td>
            <td><div align="center"></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>