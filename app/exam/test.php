<?php session_start();?>
<?php require_once("../config/base_cfg.php");
       require_once("../dbscripts/db_connect.php"); 
       require_once("../inc/show_msg.php");
	   require_once("../inc/main_fun.php"); 
	   require_once("../".$cfg_admin_root."scripts/constant.php"); 
	   require_once("../inc/find_cookie.php");
	   require_once("../".$cfg_admin_root."scripts/test_constant.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>自测系统-<?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<script language="javascript" src="../inc/form_check.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
h1 
{ 
height:33px; 
line-height:33px; 
font-size:24px; 
color:#FFFFFF;
font-family:"黑体";
}

h2 
{ 
height:33px; 
line-height:33px; 
font-size:20px; 
color:red;
font-family:"黑体";
}
.inputBox {
	font-family: Verdana, PMingLiU;
	background-color:transparent;
	border:0px;
	border-bottom:1px solid #14a346
}
-->
</style>
</head>
<body>
<?php if(isset($_SESSION['user_name'])) { 
 if(isset($_POST['test_submit'])) {
   
  $end_time=date("y-m-d H:i:s");
   
  $used_time=explode(".",substr((time()-$_SESSION['start_time'])/60.0,0,6));
   
  $used_time=$used_time[0];
   
  if($used_time<=$shortest_time) {
     showmsg("时间太短，属违规操作","index.php");
    }
  
 else{
  
  $score=0;
  
  for($i=1;$i<=$num_of_p;$i++)  { 
   
    $answer_i="answer".$i;
	$problem_i="problem".$i;
	
	$query="select answer from ".$table_suffix."test where id={$_SESSION[$problem_i]}";
	$result=mysql_query($query);
	if($row=mysql_fetch_object($result))  $right_answer=$row->answer;  else $right_answer=NULL;
	
	
	$answer=$_POST[$answer_i]==NULL?"X":$_POST[$answer_i];
	if($answer==$right_answer)  { 
	  echo $score=$score+$per_score;
	  mysql_query("update ".$table_suffix."test set  test_times=test_times+1, right_times=right_times+1 where id={$_SESSION[$problem_i]}");
	}
	
	else  mysql_query("update ".$table_suffix."test set  test_times=test_times+1 where id={$_SESSION[$problem_i]}");
	
	if($i==1){
	$answer_list=$answer;
    $problem_list=$_SESSION[$problem_i];
	 }
	
	else {
	$answer_list=$answer_list.",".$answer;
    $problem_list=$problem_list.",".$_SESSION[$problem_i];
     }
    
	session_unregister($problem_i);
	
   }
   
   if($used_time<=$test_time+$out_time) {
   $query="insert into ".$table_suffix."test_record 
   (user_name,test_time,test_region,problem_list,answer_list,score,used_time) values 
   ('{$_SESSION['user_name']}','$end_time','{$_SESSION['test_region']}','$problem_list','$answer_list','$score','$used_time') ";
   
   $result=mysql_query($query);
   if($result) showmsg("考试耗时".$used_time."分钟，<br>您的分数是<h2>".$score."</h2><br>考试结果已经被提交到数据库系统","index.php");
 }
   else { 
   $excess_time=$used_time-$test_time;
   showmsg("考试超时太久，达到".$excess_time."分钟，<br>您的分数是<h2>".$score."</h2><br>考试结果<font color=red>没有</font>提交数据库","index.php");
  }  
 }
}   
 elseif(isset($_POST['test_start'])) { 
  session_register("start_time","time_diff");
  $_SESSION['start_time']=time();
  $_SESSION['time_diff']=$_POST['server_time']-$_POST['client_time'];
?>
<table width="100%" height="70"  border="0" cellpadding="0" cellspacing="0" bgcolor="#66A5E8">
  <tr>
    <td><table width="900" height="40" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><h1>欢迎光临<?=$cfg_site_name?>之自测系统</h1></td>
        <td>
		<iframe src="iframe.php" height="50" width="160" allowtransparency="yes" scrolling="no" frameborder="0"></iframe>
		</td>
        <td><div align="right"><a href="#" onClick="if(really()) location='./'" style="text-decoration:underline; color:#FFFFFF;">本站首页</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="20" cellspacing="0">
  <tr>
    <td width="200" valign="top"><div align="center">
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="130" height="130">
        <param name="movie" value="clock.swf">
        <param name="quality" value="high"><param name="BGCOLOR" value="#FFFFFF">
        <embed src="clock.swf" width="130" height="130" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#FFFFFF"></embed>
      </object>
	  <br>
	  <br>
	  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#BBD7F4">
        <tr>
          <td bgcolor="#BBD7F4">注意事项</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" style="line-height:120%;">
		  1. 测试内容包含<?=implode("、",$_POST['part']); ?>，题目是从题库中随机抽取的；
		  <br>
		  <br>
		  2.试题全部在一屏显示，无需翻页，共<?=$num_of_p?>道题目；
		  <br>
		  <br>
		  3.每题<?=$per_score?>分，满分<?=$per_score*$num_of_p?>分；
		  <br><br>
		  4.从<font color=red><strong><?=date("H:i:s")?></strong></font>开始计时,<?=$test_time?>分钟后结束，切勿中间刷新，退出或者关闭页面；
		  <br>
		  <br>
		  5.为了方便查看，您可以随意显示或者隐藏某些题目，通过点击试题上方的题号来操作；
		  <br>
		  <br>
		  6.所有的单位如果没有指明，均为国际主单位；
		  <br>
		  <br>
		  7.测试时间如果太短，<?=$shortest_time?>分钟以内，视为无效测试；时间太长（超过考试时间<?=$out_time?>分钟以上者）给出成绩，但是不写入考试记录。
		  </td>
        </tr>
      </table>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>  
      <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#BBD7F4">
        <tr>
          <td bgcolor="#BBD7F4">个人信息</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" style="line-height:120%;">
		  昵称：<?=$_SESSION['nick_name']?> 
          <br><br>
		  账号：<?=$_SESSION['user_name']?>
		  <br><br>
		  IP地址：<?=$ip?>		  </td>
		</tr>
      </table>
    </div></td>
    <td width="925" valign="top"><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#BBD7F4">
      <form method="post" action="test.php">
	  <tr>
        <td bgcolor="#FFFFFF">
		<?php 
	    $test_part=implode("' or part='",$_POST['part']);
		
		session_register("test_region");
		$_SESSION['test_region']=implode(",",$_POST['part']);
		
		$query="select * from ".$table_suffix."test where  part =  '$test_part' order  by   rand()  limit 0,$num_of_p";
		$result=mysql_query($query);
		$num_of_ti=mysql_num_rows($result);
		if($num_of_ti<$num_of_p) showmsg("您选取的测试范围的相关试题未完善，请稍后再试",-1); 
		else { ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr style="cursor:pointer; background-color:#99CCCC;">
            <?php for($i=1;$i<=$num_of_p; $i++) {?>
			<td width=4% onClick="hide_show('tab<?=$i?>','hide<?=$i?>','show<?=$i?>');" ><div align="center"><?=$i?></div></td>
            <?php } ?>
          </tr>
		  <tr>
            <?php for($i=1;$i<=$num_of_p; $i++) {?>
			<td width=4%  style="background-color:#CCCCCC"><div align="center" id="show<?=$i?>" style="display:block"><开></div><div align="center" id="hide<?=$i?>" style="display:none; color:#993300;">>关<</div></td>
            <?php } ?>
          </tr>
        </table>
		<br>
		<?php 
		$i=1;
		while($row=mysql_fetch_object($result)){ 
		$problem_i="problem".$i;
		session_register($problem_i);
		$_SESSION[$problem_i]=$row->id;
		?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" id="tab<?=$i?>" style="display:block;">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%" valign="top"><strong><?=$i?></strong></td>
            <td colspan="2"><?=$row->problem_content?></td>
          </tr>
          <tr>
            <td colspan="3">			 <div align="center">
			  <table width="300" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>A
                      <input name="answer<?=$i?>" type="radio" value="A" id="answer<?=$i?>1"></td>
                    <td>B
                      <input type="radio" name="answer<?=$i?>" value="B" id="answer<?=$i?>2"></td>
                    <td>C
                      <input type="radio" name="answer<?=$i?>" value="C" id="answer<?=$i?>3"></td>
                    <td>D
                      <input type="radio" name="answer<?=$i?>" value="D" id="answer<?=$i?>4"></td>
                  </tr>
                </table>
              </div></td>
            </tr>
        </table>
		
		<table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#BBD7F4">
          <tr>
            <td></td>
          </tr>
        </table>
		<br>
		<br></td>
          </tr>
        </table>
		<?php 
		  $i++;
		} ?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%"><div align="center">
              <input name="test_submit" type="submit" class="INPUT" id="test_submit" value="提交测试" onClick="return check_test();">
            </div></td>
            <td width="33%"><div align="center">
              <input name="Submit2" type="button" class="INPUT" value="放弃测试" onClick="if(really()) window.close();">
            </div></td>
            <td width="34%">&nbsp;</td>
          </tr>
        </table>
		<?php } ?>
		</td>
      </tr></form>
    </table></td>
  </tr>
</table>
<?php } else  showmsg("您没有选择测试内容，请返回选择！","index.php");
 } else showmsg("您没有登录，请先登录！","./");?>
</body>
</html>
<?php 
echo "<script>
   var start_time=".$_SESSION['start_time'].";
   var out_time=".$out_time.";
   var shortest_time=".$shortest_time.";
   var num_of_p=".$num_of_p.";
   var time_diff=".$_SESSION['time_diff'].";
</script>";
?>
<script>
function check_test(){
  var myDate = new Date();
  var cur_time=myDate.getTime();
  var used_time=(cur_time/1000-start_time+time_diff)/60;
  var left_time=100-used_time;
  if(used_time<=shortest_time) return weigui(used_time);
  else if(left_time>=0)  return tiqian(left_time);
  else if(used_time-100>out_time)  { 
   alert("超时太多，达到"+(used_time-100).toFixed(0)+"分钟考试被取消");
   return true;
  }
  else return chk_if_select();
}

function weigui(used_time) {
 result="才过"+used_time.toFixed(1)+"分钟,提交被视违规，确定吗？";   
       if   (confirm(result))    return true; 
       else return false;
}

function tiqian(left_time) {
 result="还剩"+left_time.toFixed(1)+"分钟,确定要交卷吗？";   
       if   (confirm(result))    return true; 
       else return false;
}

function really() {
 result="此操作将取消测试,确认吗？";   
       if   (confirm(result))    return true; 
       else return false;
}

function unfinish(string) {
 result=string;  
       if   (confirm(result))    return true; 
       else return false;
}


function ShowObj(objname){
   var obj = $Obj(objname);
   obj.style.display = "block";
}

function HideObj(objname){
   var obj = $Obj(objname);
   obj.style.display = "none";
}

function $Obj(objname){
	return document.getElementById(objname);
}
function hide_show(objname1,objname2,objname3) {
  var obj1 = $Obj(objname1);
  var obj2 = $Obj(objname2);
  var obj3 = $Obj(objname3);
  
  if(obj1.style.display=="block") obj1.style.display="none";
  else obj1.style.display="block";
  
  if(obj2.style.display=="block") obj2.style.display="none";
  else obj2.style.display="block";
  
  if(obj3.style.display=="block") obj3.style.display="none";
  else obj3.style.display="block";
}

function chk_if_select() {
  var undo="";
  for(i=1;i<=num_of_p;i++){
  var flag=0;
  for(j=1;j<=4;j++){
  var answer_i="answer"+i+j;
  obj=document.getElementById(answer_i);
  if(obj.checked) { flag=1; break;} 
   }
  if(flag==0) undo=undo+" "+i;
  }
  if(undo!="") return  unfinish("还有（"+undo+"）没有完成！确实要提交吗？");
  else { alert("测试时间已到,请交卷!"); return true;}
 }
 
</script>