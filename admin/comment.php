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
<title>�ĵ�����</title>
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
                  <div align="center">���۹���</div>
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
		  <option value="comment.php" <?php if(!isset($_REQUEST['infor'])) echo "selected"; ?>>ȫ������</option>
		 <?php
		 	$query="select * from ".$table_suffix."infor order by id asc";
			$result=mysql_query($query); 
			while($row=mysql_fetch_object($result)) {
			?><option value="comment.php?infor=<?=$row->id?>&list_for=<?=urlencode("��Ŀ > ".$row->class_name." > ����")?>" <?php if($_REQUEST['infor']==$row->id)  echo "selected"; ?>><?=$row->class_name?></option><?php } ?>
      </select>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td><?php if(!isset($_REQUEST['list_for'])) echo "���������б�"; else echo $_REQUEST['list_for']; ?></td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">����ID</div></td>
        <td><div align="center">ѡ��</div></td>
        <td><div align="left">���±���</div></td>
		<td><div align="center">ͬ�����б�</div></td>
		<td><div align="center">������Ŀ</div></td>
		<td><div align="center">��������</div></td>
        <td><div align="center">����ʱ��</div></td>
		<td><div align="center">��ֹ����</div></td>
        <td><div align="center">����</div></td>
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
		<td><div align="center"><a href="comment.php?infor_id=<?=$row->infor_id?>&list_for=<?=urlencode("���� > ".$article_title." > ����")?>">�����ʾ</a></div></td>
		<td><div align="center"><a href="comment.php?infor=<?=$row->infor?>&list_for=<?=urlencode("��Ŀ > ".$class_name." > ����")?>"><?=$class_name?></a></div></td>
        <td><div align="center"><a href="javascript: opendwin('comment_view.php?id=<?=$row->id?>')">�����ʾ</a></div></td>
        <td><div align="center"><?=substr($row->post_time,0,8)?></div></td>
        <td><div align="center"><a href="#" onClick="no_show2('comment.php?comment_or_not=yes&select_list=<?=$row->id?>')"><?php if($row->comment_or_not=="1") echo "�ѿ���"; else echo "<font color=red>�ѽ�ֹ</font>"; ?></a></div></td>
		<td><div align="center"><a href="#" onClick="if(really()) no_show2('comment.php?delete=yes&select_list=<?=$row->id?>')">ɾ��</a>|<a href="#" onClick="no_show2('comment.php?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="0") echo "����"; else echo "<font color=red>����</font>"; ?></a>|<a href="#" onClick="opendwin('comment_view.php?id=<?=$row->id?>')">�ظ�</a></div></td>
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
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="ȫѡ" onClick="sel_arc();"></td>
        
        <td>&nbsp;</td>
        <td><input name="reply_arc" type="button" class="inputbut" value="�ظ�" onclick="opendwin('comment_view.php?id=<?=$row->id?>');"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="����" onclick="no_show('comment.php','hide');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="ɾ��" onclick="if(really()) no_show('comment.php','delete');"></td>
        <td>&nbsp;</td>
        <td><input name="select_list" type="hidden"></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td width="50%"><div align="right">��<?=$page_id?>ҳ/��<?=$page?>ҳ(<?=$num?>����¼)</div></td>
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
	if(sel_arc.value=="ȫѡ"){
	for(i=0;i<document.form1.obj_id.length;i++)
	{
		if(!document.form1.obj_id[i].checked)
		{
			document.form1.obj_id[i].checked=true;
		}
	}
	 sel_arc.value="ȡ��";
	 }
    else {
	for(i=0;i<document.form1.obj_id.length;i++)
	{
		if(document.form1.obj_id[i].checked)
		{
			document.form1.obj_id[i].checked=false;
		}
	}
	 sel_arc.value="ȫѡ";
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
 result="�ö��󽫱�ɾ��,ȷ����";   
       if   (confirm(result))    return true; 
       else return false;
}

</script>
