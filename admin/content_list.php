<?php 
session_start(); 
require_once("setting.php");
require_once("inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
require_once(dirname(__FILE__)."/scripts/constant.php");

$turn=$_REQUEST['list_turn']==""?"id":$_REQUEST['list_turn'];
$keywords=$_REQUEST['keywords'];

if((isset($_REQUEST['class_id']))&&($_REQUEST['class_id']<>"")) {
 $cur_position=$_REQUEST['class_name'].">"; 
 define("DISPLAY_WHAT", "class");
 if(isset($_REQUEST['admin'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and poster='{$_SESSION['admin_valid']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['recommend'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and recommend = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['latest'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and new_or_not = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['uncheck'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and checked = '0'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['picture'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and pic_id!=0  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['show_attribute'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and show_attribute = '{$_REQUEST['show_attribute']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['top'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and top = '{$_REQUEST['top']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['hide_type'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and hide_type= '{$_REQUEST['hide_type']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 else 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where class_id ={$_REQUEST['class_id']} and keywords like '%{$keywords}%' order by  {$turn} desc";
}

elseif(isset($_REQUEST['infor_class'])) { 
 $query="select * from ".$table_suffix."infor_class where class_name='{$_REQUEST['infor_class']}'";
 $result=mysql_query($query); 
 if($row=mysql_fetch_object($result)) { 
   $cur_position="ȫ��".$row->chinese_name.">";
   define("DISPLAY_WHAT", "all");
 if(isset($_REQUEST['admin'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where poster='{$_SESSION['admin_valid']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['recommend'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where recommend = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['latest'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where new_or_not = '1'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['uncheck'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where checked = '0'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['picture'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where picture!= ''  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['show_attribute'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where show_attribute = '{$_REQUEST['show_attribute']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['top'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where top = '{$_REQUEST['top']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 elseif(isset($_REQUEST['hide_type'])) 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where hide_type= '{$_REQUEST['hide_type']}'  and keywords like '%{$keywords}%' order by  {$turn} desc";
 else 
   $query="select * from ".$table_suffix.$_REQUEST['infor_class']. " where  1 and keywords like '%{$keywords}%' order by  {$turn} desc";
    }
 else { 
   ShowMsg("����Ŀ�����ڣ�","-1");
   exit();
   }
 }
else { 
  ShowMsg("��ѡ�������Ŀ��","-1");
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
<title>�ĵ�����</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script language="javascript" src='js/con_list.js'></script>
<script language="javascript" src="js/context_menu.js"></script>
<?php require_once(dirname(__FILE__)."/scripts/top_menu.php"); ?>
<?php require_once(dirname(__FILE__)."/scripts/hide_menu.php"); ?>
<?php require_once(dirname(__FILE__)."/scripts/show_menu.php"); ?>
<?php require_once(dirname(__FILE__)."/scripts/class_menu.php"); ?>
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
                  <div align="center">�ĵ�����</div>
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
			?><option value="content_list.php?infor_class=<?=$row->class_name?>" <?php if($_REQUEST['infor_class']==$row->class_name) { $infor_class_name=$row->chinese_name; echo "selected"; }?>><?=$row->chinese_name?></option><?php } ?>
      </select>
    </div></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td><div align="center">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input <?php if(DISPLAY_WHAT=="all") echo "disabled"; ?> name="Submit1" type="button" class="inputbut" value="����ĵ�" onClick="location='archive_add.php?class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';"></td>
          <td>&nbsp;</td>
          <td><?php if(!isset($_REQUEST['admin'])) { ?>
            <input name="Submit2" type="button" class="inputbut" value="�ҵ��ĵ�" onClick="location='content_list.php?admin&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';">
            <?php } else { ?>
            <input name="Submit3" type="button" class="inputbut" value="ȫ���ĵ�" onClick="location='content_list.php?class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';">
            <?php } ?></td>
          <td>&nbsp;</td>
          <td><input name="Submit5" type="button" class="inputbut" value="�Ƽ��ĵ�" onClick="location='content_list.php?recommend&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';"></td>
          <td>&nbsp;</td>
          <td><input name="Submit6" type="button" class="inputbut" value="�����ĵ�" onClick="location='content_list.php?latest&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';"></td>
          <td>&nbsp;</td>
          <td><input name="Submit7" type="button" class="inputbut" value="����ĵ�" onClick="location='content_list.php?uncheck&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';"></td>
          <td>&nbsp;</td>
          <td><input name="Submit8" type="button" class="inputbut" value="��ͼ�ĵ�" onClick="location='content_list.php?picture&class_id=<?=$_REQUEST['class_id']?>&class_name=<?=urlencode($_REQUEST['class_name'])?>&infor_class=<?=$_REQUEST['infor_class']?>';"></td>
          <td>&nbsp;</td>
          <td><input name="Submit9" type="button" class="inputbut" value="��Ŀ����" onClick="location='infor_all.php';"></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3DFB0">
  <tr>
    <td><?=$cur_position?>�ĵ��б� &nbsp;(ʹ������Ҽ����г��ò���)</td>
  </tr>
</table>
<table width="100%" height="<?php if($per_page_num>$num) echo $num*27; else echo $per_page_num*27; ?>"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td valign="top">
	<form name="form1">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">ID</div></td>
        <td><div align="center">ѡ��</div></td>
        <td><div align="left">���±���</div></td>
		<?php if(DISPLAY_WHAT=="class") { ?>
		<td><div align="center">��Ŀ����</div></td>
        <?php } else { ?>
		<td><div align="center">������Ŀ</div></td>
        <?php } ?>
		<td><div align="center">������</div></td>
        <td><div align="center">����ʱ��</div></td>
        <td><div align="center">�����</div></td>
        <td><div align="center">��ʾ����</div></td>
		<td><div align="center">�ö���</div></td>
		<td><div align="center">��ʾ����</div></td>
        <td><div align="center"></div>          
          <div align="center">����</div></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			 $query="select class_name from ".$table_suffix."infor  where id = {$row->class_id}";
			 $result=mysql_query($query);
			 $class_name=@mysql_result($result,0,"class_name");
			 
			 if($row->poster=="")  $poster_name="�� ��"; else {
			 $query="select real_name from  ".$table_suffix."admin where admin_id='{$row->poster}'";
			 $result=mysql_query($query);
			 $poster_name=mysql_result($result,0,"real_name");
			 if($poster_name==NULL) $poster_name=$row->poster;
			 }
	   ?>
	   <tr bgcolor="#FFFFFF"  onMouseMove="javascript:this.bgColor='#FFFFCC';" onMouseOut="javascript:this.bgColor='#FFFFFF';" height="22" oncontextmenu="TotalMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')">
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="arc_id" value="<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>">
        </div></td>
        <td><div align="left">
		<a style="text-decoration:underline;" href="archive_edit.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$row->class_id?>&article_id=<?=$row->id?>&article_title=<?=urlencode($row->article_title)?>" target="_self"  oncontextmenu="TotalMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')">
		<?php echo msubstr($row->article_title,0,50); 
		      if($row->recommend=="1") echo "<font color=blue>[��]</font>";
			  if($row->title_bold=="1") echo "<font color=black>[��]</font>";
			  if($row->pic_id<>0) echo "<font color=violet>[ͼ]</font>";
			  if($row->new_or_not=="1") echo "<font color=red>[��]</font>";
		?></a></div></td>
        <?php if(DISPLAY_WHAT=="class") { ?>
		<td><div align="center"><?=$infor_class_name?></div></td>
        <?php } else { ?>
		<td><div align="center"><a href="#" oncontextmenu="ClassMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')"><?=$class_name?></a></div></td>
        <?php } ?>		
        <td><div align="center"><?php echo $poster_name ?></div></td>
        <td><div align="center"><?=substr($row->post_time,0,8)?></div></td>
        <td><div align="center"><?=$row->read_times?></div></td>
        <td><div align="center"><a href="#" oncontextmenu="ShowMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')"><?=$show_attribute[$row->show_attribute]?></a></div></td>
		<td><div align="center"><a href="#" oncontextmenu="TopMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')"><?=$top_se[$row->top]?></a></div></td>
		<td><div align="center"><a href="#" oncontextmenu="HideMenu(this,'<?=$_REQUEST['infor_class']." ".$row->class_id." ".$row->id." ".urlencode($row->article_title)?>','<?=urlencode($row->article_title)?>')"><?=$hide_type[$row->hide_type]?></a></div></td>
        <td><div align="center"><a href="archive_edit.php?infor_class=<?=$_REQUEST['infor_class']?>&class_id=<?=$row->class_id?>&article_id=<?=$row->id?>&article_title=<?=urlencode($row->article_title)?>" target="_self">�༭</a> | <a href="../archive_view.php?id=<?=$row->id?>&infor_class=<?=$_REQUEST['infor_class']?>" target="_blank">Ԥ��</a></div></td>
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
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="ȫѡ" onClick="sel_arc();"></td>
        <td>&nbsp;</td>
        <td><input name="edit_arc" type="button" class="inputbut" value="�༭" onClick="editArc(0);"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="reco_arc" type="button" class="inputbut" value="�Ƽ�" onClick="updateArc('recommend',0);"></td>
        <td>&nbsp;</td>
        <td><input name="top_arc" type="button" class="inputbut" value="�ö�" onClick="updateArc('top',0);"></td>
        <td>&nbsp;</td>
        <td><input name="new_arc" type="button" class="inputbut" value="����" onClick="updateArc('new_or_not',0);"></td>
        <td>&nbsp;</td>
        <td><input name="bold_ti" type="button" class="inputbut" value="�Ӵ�" onClick="updateArc('title_bold',0);"></td>
        <td>&nbsp;</td>
        <td><input name="check_arc" type="button" class="inputbut" value="���" onClick="updateArc('checked',0);"></td>
        <td>&nbsp;</td>
        <td><input name="lock_arc" type="button" class="inputbut" value="����" onClick="updateArc('locked',0);"></td>
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="����" onClick="updateArc('hide_type',0);"></td>
        <td>&nbsp;</td>
        <td><input name="move_arc" type="button" class="inputbut" value="�ƶ�" onClick="updateArc('move',0);"></td>
        <td>&nbsp;</td>
        <td><input name="del_arc" type="button" class="inputbut" value="ɾ��" onClick="updateArc('delete',0);"></td>
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
<?php require_once(dirname(__FILE__)."/scripts/arc_search.php");?> 
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
</body>
</html>
