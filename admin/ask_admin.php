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
	if(isset($_REQUEST['delete'])) 
	{ 
	mysql_query("delete from  ".$table_suffix."ask where id={$temp2}");
	mysql_query("delete from  ".$table_suffix."ask_answer where question_id={$temp2}");
	}
	else if(isset($_REQUEST['hide'])) mysql_query("update ".$table_suffix."ask set hide=IFNULL(hide=0,0 ) where id={$temp2}");
	else if(isset($_REQUEST['top'])) mysql_query("update ".$table_suffix."ask set top=IFNULL(top=0,0),top_time='{$this_time}' where id={$temp2}");
	  }
	if(mysql_affected_rows()) echo "<script>parent.location.reload()</script>";
	else  echo "<script>window.parent.alert(\"操作失败，稍后重试！\");</script>";
	exit;
    }
   
   $query="select * from ".$table_suffix."ask where 1=1 order by post_time desc";
   
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
                  <div align="center">问答管理</div>
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
        <td><div align="left">问题标题</div></td>
		<td><div align="left">问题所属</div></td>
		<td><div align="center">提问时间</div></td>
		<td><div align="left">提问者</div></td>
		<td><div align="left">悬赏分</div></td>
        <td><div align="center">状态</div></td>
        <td><div align="center">操作</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			  $query="select nick_name,id from  ".$table_suffix."member where user_name='{$row->poster}'";
			  $result=mysql_query($query);
			  $poster_name=mysql_result($result,0,"nick_name");
			  $poster_id=mysql_result($result,0,"id");
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td nowrap width=200><div align="left">
		<a href="../ask/question.php?id=<?=$row->id?>" target="_blank" style="text-decoration:underline"><?=msubstr($row->question,0,30)?></a>
		</div></td>
		<td nowrap width=300><div align="left">
		<a href="../ask/ask_chapter.php?part=<?=urlencode($row->part)?>" target="_blank" style="text-decoration:underline"><?=$row->part?></a> >
		<a href="../ask/ask_section.php?part=<?=urlencode($row->part)?>&chapter=<?=urlencode($row->chapter)?>" target="_blank" style="text-decoration:underline"><?=$row->chapter?></a> >
		<a href="../ask/ask_point.php?part=<?=urlencode($row->part)?>&chapter=<?=urlencode($row->chapter)?>&section=<?=urlencode($row->section)?>" target="_blank" style="text-decoration:underline"><?=$row->section?></a>
		</div></td>
		<td><div align="center"><?=substr($row->post_time,3,8)?></div></td>
		<td><div align="left"><a href=member_show.php?id=<?=$poster_id?> target="_blank" style="text-decoration:underline;"><?=$poster_name?></a></div></td>
        <td width="50"><div align="left"><?=$row->score?></div>  </td>
        <td><div align="center"><IMG alt=问题 src="../ask/index.files/zt_<?=$row->finished=="0"?"jjz":"yjj"?>.gif" align=absMiddle></div></td>
		<td><div align="center"><a href="#" onClick="if(really()) no_show2('ask_admin.php?delete=yes&select_list=<?=$row->id?>')">删除</a>|<a href="#" onClick="no_show2('ask_admin.php?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="1") echo "显示"; else echo "<font color=red>隐藏</font>"; ?></a>|<a href="#" onClick="no_show2('ask_admin.php?top=yes&select_list=<?=$row->id?>')"><?php if($row->top=="1") echo "已推荐"; else echo "<font color=red>未推荐</font>"; ?></a></div></td>
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
        <td><input name="reply_arc" type="button" class="inputbut" value="推荐" onclick="no_show('ask_admin.php','top');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="隐藏" onclick="no_show('ask_admin.php','hide');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('ask_admin.php','delete');"></td>
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