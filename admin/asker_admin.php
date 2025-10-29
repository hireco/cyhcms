<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
   require_once(dirname(__FILE__)."/../ask/include/ask_level.php");
   
   if(isset($_REQUEST['select_list'])) {
    $select_id=explode(",", $_REQUEST['select_list']);
	while($temp=each($select_id)) { 
	$temp2=$temp["value"];
	$this_time=date("y-m-d H:i:s");
	if(isset($_REQUEST['score'])) require("scripts/set_score.php");
	else if(isset($_REQUEST['major'])) mysql_query("update ".$table_suffix."ask_score set major='{$_REQUEST['major']}' where id={$temp2}");
	else if(isset($_REQUEST['honor'])) mysql_query("update ".$table_suffix."ask_score set honor=IFNULL(honor=0,0 ),honor_time='{$this_time}' where id={$temp2}");
	else if(isset($_REQUEST['top']))   mysql_query("update ".$table_suffix."ask_score set top=IFNULL(top=0,0),top_time='{$this_time}' where id={$temp2}");
	  }
	echo "<script>parent.location.reload()</script>";
	exit;
    }
   
   $query="select * from ".$table_suffix."ask_score  order by last_time desc";
   
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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
                  <div align="center">人员管理</div>
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
        <td><div align="center">选择</div></td>
        <td><div align="left">用户昵称</div></td>
		<td><div align="left">用户级别</div></td>
		<td><div align="left">知识级别</div></td>
		<td><div align="left">擅长领域</div></td>
		<td width="50"><div align="left">总分</div></td>
		<td width="50"><div align="left">获得</div></td>
		<td width="50"><div align="left">支出</div></td>
        <td width="50"><div align="left">提问数</div></td>
        <td width="50"><div align="left">回答数</div></td>
		<td width="50"><div align="left">采纳率</div></td>
		<td width="80"><div align="center">注册日期</div></td>
		<td width="80"><div align="center">最新登录</div></td>
		<td><div align="center">操作</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			  $query="select * from  ".$table_suffix."member where user_name='{$row->user_name}'";
			  $result=mysql_query($query);
			  $poster_name=mysql_result($result,0,"nick_name");
			  $poster_id=mysql_result($result,0,"id");
			  $register_time=mysql_result($result,0,"register_time");
			  $last_time=mysql_result($result,0,"last_time");
			  $poster_level=mysql_result($result,0,"user_level");
			  
			  $query="select id from ".$table_suffix."ask where poster='{$row->user_name}'";
			  $result=mysql_query($query);
			  $num_of_question=mysql_num_rows($result);
			  
			  $query="select id from ".$table_suffix."ask_answer where poster='{$row->user_name}'";
			  $result=mysql_query($query);
			  $num_of_answer=mysql_num_rows($result);
			  
			  $query="select id from ".$table_suffix."ask_answer where poster='{$row->user_name}' and accept='1'";
			  $result=mysql_query($query);
			  $num_of_accept=mysql_num_rows($result);
			  
			  $per_of_accept=substr(100*($num_of_accept*1.0)/($num_of_answer*1.0),0,5);
			  if($per_of_accept==NULL) $per_of_accept=0;
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td><div align="left">
		<a href=member_show.php?id=<?=$poster_id?> target="_blank" style="text-decoration:underline"><?=$poster_name?></a>
		</div></td>		
		<td><div align="left"><?=$mem_level[$poster_level]; ?></div></td>
		<td><div align="left"><?=get_user_title($row->income)?></div></td>
		<td><div align="left">
		  <select name="menu1" onChange="MM_jumpMenu('hide_frame',this,0)">
		   <option value="?major=&select_list=<?=$row->id?>" <?php if($row->major=="")  echo "selected"; ?> style="color:#999999">没有擅长领域</option>
		    <?php 
			 $query="select chapter_name from  ".$table_suffix."chapter order by id desc"; 
			 $result_c=mysql_query($query);
			 while($row_c=mysql_fetch_object($result_c)) { 
			?>  
			<option value="?major=<?=urlencode($row_c->chapter_name)?>&select_list=<?=$row->id?>" <?php if($row_c->chapter_name==$row->major) echo "selected"; ?>><?=$row_c->chapter_name?></option>
           <?php } ?>
		  </select>
		</div></td>
		<td><div align="left"><?=$row->income-$row->payout?></div></td>
		<td><div align="left"><?=$row->income?></div></td>
        <td><div align="left"><?=$row->payout?></div>  </td>
        <td><div align="left"><?=$num_of_question?></div></td>
		<td><div align="left"><?=$num_of_answer?></div></td>
		<td><div align="left"><?=$per_of_accept?>%</div></td>
		<td><div align="center"><?=substr($register_time,0,8)?></div></td>
		<td><div align="center"><?=substr($last_time,0,8)?></div></td>
		<td><div align="center"><a href="#" onClick="no_show2('asker_admin.php?score=yes&select_list=<?=$row->id?>')">刷新得分</a>|<a href="#" onClick="no_show2('asker_admin.php?top=yes&select_list=<?=$row->id?>')"><?php if($row->top=="1") echo "已置顶"; else echo "<font color=red>未置顶</font>"; ?></a>|<a href="#" onClick="no_show2('asker_admin.php?honor=yes&select_list=<?=$row->id?>')"><?php if($row->honor=="1") echo "荣誉专家"; else echo "<font color=red>荣誉推荐</font>"; ?></a></div></td>
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
        <td><input name="reply_arc" type="button" class="inputbut" value="刷新得分" onclick="no_show('asker_admin.php','score');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="荣誉推荐" onclick="no_show('asker_admin.php','honor');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="置顶" onclick="no_show('asker_admin.php','top');"></td>
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
</script>