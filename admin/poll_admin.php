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
	if(isset($_REQUEST['delete'])) { 
	 mysql_query("delete from  ".$table_suffix."poll_topics where id={$temp2}");
	 mysql_query("delete from  ".$table_suffix."poll_selection where poll_id={$temp2}");
	 }
	else if(isset($_REQUEST['hide'])) mysql_query("update ".$table_suffix."poll_topics set hide=IFNULL(hide=0,0 ) where id={$temp2}");
     }
	echo "<script>parent.location.reload()</script>";
	exit;
    }
   
   $query="select * from ".$table_suffix."poll_topics where 1=1";
   
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
                  <div align="center">ͶƱ����</div>
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
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr bgcolor="#FFFFFF">
        <td><div align="center">ID</div></td>
        <td><div align="center">ѡ��</div></td>
        <td><div align="left">ͶƱ����</div></td>
		<td><div align="center">����״̬</div></td>
		<td nowrap><div align="center">ͶƱѡ�֧�ֵ������ٷֱ�</div></td>
		<td><div align="center">����</div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <td colspan="6" bgcolor="#CCCCCC"></td>
        </tr>
       <?php  
		for($i=1;$i<=$per_page_num;$i++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
	   ?>
	   <tr bgcolor="#FFFFFF" >
        <td><div align="center"><?=$row->id?></div></td>
        <td><div align="center">
          <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
        <td nowrap bgcolor="#FFFFFF">
		  <div align="left"><?=$row->poll_title?></div></td>
		<td><div align="center"><?php $cur_time=date("y-m-d H:i:s"); if($cur_time<$row->end_time) echo "������..."; else echo "�ѽ���..."; ?></div></td>
		<td><div align="center">
		  <?php 
		   $query_new="select * from  ".$table_suffix."poll_selection  where poll_id={$row->id}";
		   $result_new=mysql_query($query_new);	
		   $total_hit=mysql_query("select sum(hit) as total_hit from  ".$table_suffix."poll_selection where poll_id={$row->id}");
		   $total_hit=mysql_result($total_hit,0,"total_hit");
		  ?>
		  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                <tr bgcolor="#DBDBDB">
                  <td><div align="center">���</div></td>
                  <td><div align="left">ѡ������</div></td>
                  <td><div align="center">֧�ֵ���</div></td>
                  <td><div align="center">�ٷֱ�</div></td>
                </tr>
                <?php 
				$i=1;
				while($row_new=mysql_fetch_object($result_new)){ ?>
                <tr bgcolor="#FFFFFF">
                  <td><div align="center">
                      <?=$i?>
                  </div></td>
                  <td><div align="left">
                      <?=$row_new->selection?>
                  </div></td>
                  <td><div align="center">
                      <?=$row_new->hit?>
                  </div></td>
                  <td><div align="center"><?php echo substr(100*$row_new->hit/($total_hit*1.00),0,4);?>%</div></td>
                </tr>
                <?php
				 $i++;
				 } ?>
              </table></td>
            </tr>
          </table>
		  </div></td>
        <td><div align="center"><a href="#" onClick="if(really()) no_show2('poll_admin.php?delete=yes&select_list=<?=$row->id?>')">ɾ��</a>|<a href="#" onClick="no_show2('poll_admin.php?hide=yes&select_list=<?=$row->id?>')"><?php if($row->hide=="0") echo "����"; else echo "<font color=red>����</font>"; ?></a>|<a href="#" onClick="opendwin('poll_edit.php?id=<?=$row->id?>')">�༭</a></div></td>
        </tr>
		<tr bgcolor="#FFFFFF">
        <td colspan="6" bgcolor="#CCCCCC"></td>
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
        <td><input name="sel_arc" id="sel_arc" type="button" class="inputbut" value="ȫѡ" onClick="sel_arc();"></td>
        
        <td>&nbsp;</td>
        <td><input name="hide_arc" type="button" class="inputbut" value="����/����" onclick="no_show('poll_admin.php','hide');"></td>
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="ɾ��" onclick="if(really()) no_show('poll_admin.php','delete');"></td>
        <td>&nbsp;</td>
        <td><input name="select_list" type="hidden"></td>
      </tr>
    </table></td>
    <td><a href="poll_edit.php">�����µ�ͶƱ</a></td>
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
 result="�ö��󽫱�ɾ��,ȷ����";   
       if   (confirm(result))    return true; 
       else return false;
}
</script>