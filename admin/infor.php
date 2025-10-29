<?php session_start(); 
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
require_once(dirname(__FILE__)."/function/string_cutoff.php");
$infor_class=(!isset($_REQUEST['infor_class'])||$_REQUEST['infor_class']=="")?"article":$_REQUEST['infor_class'];
$result=mysql_query("select * from  ".$table_suffix."infor_class where class_name='$infor_class'");
if($row=mysql_fetch_object($result))
 { 
   $id=$row->id;
   $chinese_name=$row->chinese_name; 
   $table_name=$row->table_name;
   $mate_file=$row->mate_file;
   $template_list=$row->template_list;
 } else 
  { echo "<script>alert(\"请选择操作栏目!\"); location.replace(\"admin.php\");</script>"; exit; } 
function class_show($m, $n) {
global $post_type,$hide_type, $class_attribute, $table_suffix, $infor_class;
$result=mysql_query("select class_level from ".$table_suffix."infor where infor_class='$infor_class' order by class_level desc, top desc limit 0,1");
$row0=mysql_fetch_object($result); 
if($n==$row0->class_level) {
 $rows=mysql_query("select * from ".$table_suffix."infor where infor_class='$infor_class' and  class_level='$n' and upper_class_id='$m' order by top desc");
  while($row=@mysql_fetch_object($rows)){ 	     
		 ?>
		  <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">		
		  <tr bgcolor="#FFFFFF" >
              <td class="p20" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="left" style="word-wrap:break-word;"><?php for($i=1; $i<=$n;$i++) echo "&nbsp;&nbsp;&nbsp;&nbsp;";?><input type="checkbox" name="class_infor" value="<?php echo $row->id." ".$row->class_name." ".$row->class_level." ".$row->infor_class;?>">
			  <?php echo "<font color=red>[-]</font>"; ?><a href="content_list.php?infor_class=<?=$infor_class?>&class_id=<?=$row->id?>&class_name=<?=urlencode($row->class_name)?>"><?php echo $row->class_name?></a>
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
    $rows=mysql_query("select * from ".$table_suffix."infor where infor_class='$infor_class' and  class_level='$n' and upper_class_id='$m' order by top desc");
    while($row=@mysql_fetch_object($rows)){ 
	$sub_num=@mysql_num_rows(mysql_query("select * from ".$table_suffix."infor where infor_class='$infor_class' and upper_class_id={$row->id}"));
  ?>
    <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF" >
         <td class="p20" style="border-bottom-style:dotted; border-bottom-color: #000000; border-bottom-width:1px;"><div align="left" style="word-wrap:break-word;"><?php for($i=1; $i<=$n;$i++) echo "&nbsp;&nbsp;&nbsp;&nbsp;";?><input type="checkbox" name="class_infor" value="<?php echo $row->id." ".$row->class_name." ".$row->class_level." ".$row->infor_class;?>">
			<?php if($sub_num) echo "<a href=\"javascript:show_div('div{$row->id}');\"><font color=red>[+]</font></a>"; else echo "<font color=red>[-]</font>";  ?><a href="content_list.php?infor_class=<?=$infor_class?>&class_id=<?=$row->id?>&class_name=<?=urlencode($row->class_name)?>"><?php echo $row->class_name?></a>
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
<script language="javascript" src='js/chan_list.js'></script>
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
function class_select(action_do)
{
	var qstrs,qstr=getCheckboxItem();
	if(qstr=="") alert("你没选中任何类别！");
	else
	{
		qstrs = qstr.split(" ");
		location.href=action_do+"class_id="+qstrs[0]+"&class_name="+qstrs[1]+"&class_level="+qstrs[2];
	}
}
function class_select2(action_do)
{
	var qstrs,qstr=getCheckboxItem();
	if(qstr=="") location.href=action_do;
	else
	{
		qstrs = qstr.split(" ");
		location.href=action_do+"#"+qstrs[0];
	}
}
function class_select3(action_do)
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

function sel_cha()
{
	var sel_cha = document.getElementById('sel_cha');
	if(sel_cha.value=="全选"){
	for(i=0;i<document.form1.class_infor.length;i++)
	{
		if(!document.form1.class_infor[i].checked)
		{
			document.form1.class_infor[i].checked=true;
		}
	}
	 sel_cha.value="取消";
	 }
    else {
	for(i=0;i<document.form1.class_infor.length;i++)
	{
		if(document.form1.class_infor[i].checked)
		{
			document.form1.class_infor[i].checked=false;
		}
	}
	 sel_cha.value="全选";
   }
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
                  <div align="center"><?=$chinese_name?></div>
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
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td bgcolor="#F1EFE2"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3" rowspan="3" bgcolor="#FFFFFF"></td>
        <td height="3" colspan="2" bgcolor="#FFFFFF"></td>
      </tr>
      <tr>
        <td bgcolor="#F4D8AC"><table width="100%"  border="0" cellspacing="0" cellpadding="1">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#666666">
                      <tr>
                        <td bgcolor="#FFFFFF"><div align="center" class="small_line"><a href="infor_add.php?infor_class=<?=$infor_class?>&chinese_name=<?=$chinese_name?>">添加顶级栏目</a></div></td>
                      </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                  <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#666666">
                      <tr>
                        <td bgcolor="#FFFFFF"><div align="center" class="small_line"><a href='javascript:class_select("infor_sub_add.php?chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&");'>添加子栏目</a></div></td>
                      </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                  <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#666666">
                      <tr>
                        <td bgcolor="#FFFFFF"><div align="center" class="small_line"><a href='javascript:class_select("infor_mod.php?chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&");'>更改栏目</a></div></td>
                      </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                  <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#666666">
                      <tr>
                        <td bgcolor="#FFFFFF"><div align="center" class="small_line"><a href='javascript:class_select3("content_list.php?");'><?=substr($chinese_name,0,4)?>列表</a></div></td>
                      </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                  <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#666666">
                      <tr>
                        <td bgcolor="#FFFFFF"><div align="center" class="small_line"><a href='javascript:class_select2("infor_detail.php");'>栏目信息</a></div></td>
                      </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="3" bgcolor="#CC6633"></td>
      </tr>
      <tr>
        <td height="3" bgcolor="#CC6633"></td>
        <td width="3" bgcolor="#CC6633"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td bgcolor="#FFFFFF">
		  <form name="form1">
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
		  <?php class_show(0,"0");?>
		  </form>
		  </td>
        </tr>
    </table></td>
  </tr>
</table>
    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><input name="sel_cha" id="sel_cha" type="button" class="inputbut" value="全选" onClick="sel_cha();"></td>
              <td>&nbsp;</td>
              <td><input name="edit_cha" type="button" class="inputbut" value="编辑" onClick="class_select('infor_mod.php?chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&');"></td>
              <td>&nbsp;</td>
              <td><input name="top_cha" type="button" class="inputbut" value="置顶"  onClick="class_select('infor_mod_submit.php?action=top&chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&');"></td>
              <td>&nbsp;</td>
              <td><input name="hide_cha" type="button" class="inputbut" value="隐藏" onClick="class_select('infor_mod_submit.php?action=hide&chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&');"></td>
              <td>&nbsp;</td>
              <td><input name="del_cha" type="button" class="inputbut" value="删除"  onClick="if(really())  class_select('infor_mod_submit.php?action=delete&chinese_name=<?=$chinese_name?>&infor_class=<?=$infor_class?>&');"></td>
              <td>&nbsp;</td>
              <td width="200"><div align="center"><a href="template_list.php?activepath=/template/column&for_class=infor_class&for_id=<?=$id?>&description=<?=urlencode("添加".$chinese_name."类模版")?>" target="_blank">添加<?=$chinese_name?>类模版</a></div></td>
              <td>现有模版:<?=$template_list?></td>
            </tr>
        </table>          
        <div align="center">
            </div></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
function really() {
      result="将删除全部与之相关的数据,确定吗？";   
       if   (confirm(result))    return true; 
       else return false;
 }
</script>

