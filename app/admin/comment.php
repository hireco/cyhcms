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
	if(isset($_REQUEST['delete'])) mysql_query("delete from  ".$table_suffix."comment where id={$temp2}");
	else if(isset($_REQUEST['hide'])) mysql_query("update ".$table_suffix."comment set hide=IFNULL(hide=0,0 ) where id={$temp2}");
	else if(isset($_REQUEST['comment_or_not'])) mysql_query("update ".$table_suffix."comment set comment_or_not=IFNULL(comment_or_not=0,0 ) where id={$temp2}");
	  }
	echo "<script>parent.location.reload()</script>";
	exit;
    }
   if(isset($_REQUEST['infor_id']))   $query="select * from ".$table_suffix."comment where infor_id={$_REQUEST['infor_id']} order by post_time desc";
   elseif(isset($_REQUEST['infor']))  $query="select * from ".$table_suffix."comment where infor={$_REQUEST['infor']} order by post_time desc";
   else $query="select * from ".$table_suffix."comment where 1=1 order by post_time desc";
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
                  <div align="center">评论管理</div>
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
		  <option value="comment.php" <?php if(!isset($_REQUEST['infor'])) echo "selected"; ?>>全部评论</option>
		 <?php
		 	$query="select * from ".$table_suffix."infor order by id asc";
			$result=mysql_query($query); 
			while($row=mysql_fetch_object($result)) {
			?><option value="comment.php?infor=<?=$row->id?>&list_for=<?=urlencode("栏目 > ".$row->class_name." > 评论")?>" <?php if($_REQUEST['infor']==$row->id)  echo "selected"; ?>><?=$row->class_name?></option><?php } ?>
      </select>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td><?php if(!isset($_REQUEST['list_for'])) echo "所有评论列表"; else echo $_REQUEST['list_for']; ?></td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">文章ID</div></td>
        <td><div align="center">选择</div></td>
        <td><div align="left">文章标题</div></td>
		<td><div align="center">同主题列表</div></td>
		<td><div align="center">所属栏目</div></td>
		<td><div align="center">评论内容</div></td>
        <td><div align="center">评论时间</div></td>
		<td><div align="center">禁止评论</div></td>
        <td><div align="center">操作</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 $query="select * from ".$table_suffix."infor  where id = {$row->infor}";
			 $result=mysql_query($query);
			 $class_name=@mysql_result($result,0,"class_name");
			 $infor=@mysql_result($result,0,"infor_class");
			 
			 $query="select * from ".$table_suffix.$infor."  where id = {$row->infor_id}";
			 $result=mysql_query($query);
			 $article_title=@mysql_result($result,0,"article_title");
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center"><?=$row->infor_id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td><div align="left">
		<a style="text-decoration:underline;" href="../archive_view.php?id=<?=$row->infor_id?>&infor_class=<?=$infor?>" target="_blank" >
		<?php echo msubstr($article_title,0,50);?></a></div></td>
		<td><div align="center"><a href="comment.php?infor_id=<?=$row->infor_id?>&list_for=<?=urlencode("文章 > ".$article_title." > 评论")?>">点击显示</a></div></td>
		<td><div align="center"><a href="comment.php?infor=<?=$row->infor?>&list_for=<?=urlencode("栏目 > ".$class_name." > 评论")?>"><?=$class_name?></a></div></td>
        <td><div align="center"><a href="javascript: opendwin('comment_view.php?id=<?=$row->id?>')">点击显示</a></div></td>
        <td><div align="center"><?=substr($row->post_time,0,8)?></div></td>
        <td><div align="center"><a href="#" onClick="no_show2('comment.php?comment_or_not=yes&select_list=<?=$row->id?>')"><?php if($row->comment_or_not=="1") echo "已开放"; else echo "<font color=red>已禁止</font>"; ?></a></div></td>
		<td><div align="center"><a href="#" onClick="if(really()) no_show2('comment.php?delete=yes&select_list=<?=$row->id?>')">删除</a>|<a href="#" onClick="no_show2('comment.php?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="0") echo "隐藏"; else echo "<font color=red>开放</font>"; ?></a>|<a href="#" onClick="opendwin('comment_view.php?id=<?=$row->id?>')">回复</a></div></td>
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
        <td><input name="reply_arc" type="button" class="inputbut" value="回复" onclick="opendwin('comment_view.php?id=<?=$row->id?>');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="隐藏" onclick="no_show('comment.php','hide');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('comment.php','delete');"></td>
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
{ window.open(url,"","height=600,width=820,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}

function really() {
 result="该对象将被删除,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
}

</script>
