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
	if(isset($_REQUEST['delete']))  mysql_query("delete from  ".$table_suffix."test_record where id={$temp2}");
	 }
     if(mysql_affected_rows()) echo "<script>parent.location.reload()</script>";
	 exit;
    }
   
   $query="select * from ".$table_suffix."test_record where 1=1 order by test_time desc"; 
   
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
<?php require_once("scripts/header.php"); ?>
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
                  <div align="center">测试记录</div>
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
        <td width="40"><div align="center">选择</div></td>
		<td width="60"><div align="left">测试者</div></td>
        <td width="100"><div align="left">试题所属</div></td>
		<td><div align="center">详细情况</div></td>
		<td width="70"><div align="center">考试时间</div></td>
		<td width="50"><div align="center">耗时(分)</div></td>
		<td width="60"><div align="center">得分</div></td>
      </tr>
       <?php  
		for($k=1;$k<=$per_page_num;$k++)
		  { if($row=@mysql_fetch_object($rows))
		    { 
			  $query="select nick_name,id from  ".$table_suffix."member where user_name='{$row->user_name}'";
			  $result=mysql_query($query);
			  $tester=mysql_result($result,0,"nick_name");
			  $tester_id=mysql_result($result,0,"id");
			  
			  $problem_list=explode(",",$row->problem_list);
			  $answer_list=explode(",",$row->answer_list); 
			 
	   ?>
	   <tr bgcolor="#FFFFFF" >
	     <td><div align="center"><?=$row->id?></div></td>
	     <td><div align="center">
            <input type="checkbox" name="obj_id" value="<?=$row->id?>">
        </div></td>
	     <td><div align="left"><a href="member_show.php?id=<?=$tester_id?>" target="_blank" style="text-decoration:underline;"><?=$tester?></a></div></td>
	     <td><?=$row->test_region?></td>
	     <td nowrap><table border="0" align="center" cellpadding="2" cellspacing="0">
           <tr>
             <td>测试题目</td>
             <?php for($i=0;$i<25;$i++){ 
			     $query="select answer from  ".$table_suffix."test where id={$problem_list[$i]}";
			     $result=mysql_query($query);
				 $answer[$i]=mysql_result($result,0,"answer");
			    ?><td>
               <a href="test_view.php?id=<?=$problem_list[$i]?>" target="_blank" style="text-decoration:underline">
               <?=$problem_list[$i]?>
               </a></td>
               <?php } ?>
           </tr>
           <tr>
             <td>标准答案</td>
             <?php for($i=0;$i<25;$i++){ ?><td><?=$answer[$i]?></td><?php } ?>
             </tr>
           <tr>
             <td>考生答案</td>
             <?php for($i=0;$i<25;$i++){ ?><td><?=$answer_list[$i]=="X"?"无":$answer_list[$i]?></td><?php } ?>
           </tr>
         </table></td>
	     <td nowrap><div align="center"><?=substr($row->test_time,3,8)?></div></td>
	     <td nowrap><div align="center"><?=$row->used_time?></div></td>
	     <td nowrap><div align="center"><?=$row->score?></div></td>
	   </tr>
	   <tr>
	     <td height="1" colspan="8" bgcolor="#CCCCCC" ></td>
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
        <td>&nbsp;</td>
        <td><input name="delete_arc" type="button" class="inputbut" value="删除" onclick="if(really()) no_show('test_record_admin.php','delete');"></td>
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


function opendwin(url)
{ window.open(url,"","height=600,width=820,resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no");}

function really() {
 result="该对象将被删除,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
}
</script>