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
	if(isset($_REQUEST['delete'])) mysql_query("delete from  ".$table_suffix."guestbook where id={$temp2}");
	else if(isset($_REQUEST['hide'])) mysql_query("update ".$table_suffix."guestbook set hide=IFNULL(hide=0,0 ) where id={$temp2}");
	else if(isset($_REQUEST['comment_or_not'])) mysql_query("update ".$table_suffix."guestbook set comment_or_not=IFNULL(comment_or_not=0,0 ) where id={$temp2}");
	  }
	echo "<script>parent.location.reload()</script>";
	exit;
    }
   if($_REQUEST['list']=="unchecked")   $query="select * from ".$table_suffix."guestbook where checked='0' order by post_time desc";
   elseif($_REQUEST['list']=="unprocessed")   $query="select * from ".$table_suffix."guestbook where processed='0' order by post_time desc";
   elseif($_REQUEST['list']=="checkedbutunprocessed")   $query="select * from ".$table_suffix."guestbook where checked='1' and processed='0' order by post_time desc";
   elseif($_REQUEST['list']=="sametopic")   $query="select * from ".$table_suffix."guestbook where topic='{$_REQUEST['list_for']}' order by post_time desc";
   else $query="select * from ".$table_suffix."guestbook where 1=1 order by post_time desc";
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
                  <div align="center">留言管理</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table></td>
    <td width="120"><div align="center">
	<select name='view_type' style='width:110px' onchange="location=this.value;">         
		  <option value="guestbook.php" <?php if(!isset($_REQUEST['list'])) echo "selected"; ?>>全部留言</option>
		  <option value="guestbook.php?list=unchecked&list_for=<?=urlencode("未查看的")?>" <?php if($_REQUEST['list']=="unchecked")  echo "selected"; ?>>未查看的</option>
          <option value="guestbook.php?list=unprocessed&list_for=<?=urlencode("未处理的")?>" <?php if($_REQUEST['list']=="unprocessed")  echo "selected"; ?>>未处理的</option>
          <option value="guestbook.php?list=checkedbutunprocessed&list_for=<?=urlencode("查看而未处理的")?>" <?php if($_REQUEST['list']=="checkedbutunprocessed")  echo "selected"; ?>>查看而未处理的</option>
         
	  </select>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td><?php if(!isset($_REQUEST['list_for'])) echo "所有"; else echo $_REQUEST['list_for']; ?>留言列表</td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">选择</div></td>
        <td><div align="left">留言主题</div></td>
		<td><div align="center">同主题列表</div></td>
		<td><div align="center">留言人</div></td>
		<td><div align="center">留言内容</div></td>
        <td><div align="center">留言时间</div></td>
		<td><div align="center">操作</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 			 
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td><div align="left"><a href="javascript: opendwin('guestbook_review.php?id=<?=$row->id?>')" style="text-decoration:underline;"><?php echo msubstr($row->topic,0,50);?></a></div></td>
		<td><div align="center"><a href="guestbook.php?list=sametopic&list_for=<?=urlencode($row->topic)?>">点击显示</a></div></td>
		<td><div align="center"><?php echo $row->nickname?></div></td>
        <td><div align="center"><a href="javascript: opendwin('guestbook_review.php?id=<?=$row->id?>')">点击显示</a></div></td>
        <td><div align="center"><?=substr($row->post_time,0,8)?></div></td>
        <td><div align="center"><a href="#" onClick="if(really())  no_show2('guestbook.php?delete=yes&select_list=<?=$row->id?>')">删除</a>|<a href="#" onClick="no_show2('guestbook.php?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="1") echo "隐藏"; else echo "<font color=red>开放</font>"; ?></a>|<a href="#" onClick="opendwin('guestbook_review.php?action=reply&id=<?=$row->id?>')">回复</a>|<a href="#" onClick="no_show2('guestbook.php?comment_or_not=yes&select_list=<?=$row->id?>')"><?php if($row->comment_or_not=="0") echo "禁止评论"; else echo "<font color=red>允许评论</font>"; ?></a></div></td>
        </tr>
	   <?php } 
	     }
	   ?>	
    </table>
	</form>
	</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="全选" onClick="sel_arc();"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="隐藏" onclick="no_show('guestbook.php','hide');"></td>
        <td>&nbsp;</td>
        <td><input name="comment_or_not_arc" type="button" class="inputbut" value="禁止/允许评论" onclick="no_show('guestbook.php','comment_or_not');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('guestbook.php','delete');"></td>
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

function no_show(url,type){ 
 url_all=url+"?"+type+"=yes&select_list="+get_select_list();
 window.open(url_all,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}

function no_show2(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}

function opendwin(url)
{ window.open(url,"","height=700,width=820,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}

function really() {
 result="该对象将被删除,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
}

</script>
