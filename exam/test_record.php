<?php session_start();?>
<?php require_once("../config/base_cfg.php");
       require_once("../dbscripts/db_connect.php"); 
       require_once("../inc/show_msg.php");
	   require_once("../inc/main_fun.php"); 
	   require_once("../".$cfg_admin_root."scripts/constant.php"); 
	   require_once("../inc/find_cookie.php");
	   require_once("../".$cfg_admin_root."scripts/test_constant.php"); 
   
   $query="select * from ".$table_suffix."test_record where user_name='{$_SESSION['user_name']}' order by test_time desc"; 
   
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
<?php if(isset($_SESSION['user_name'])) { ?>
<table width="100%" height="70"  border="0" cellpadding="0" cellspacing="0" bgcolor="#66A5E8">
  <tr>
    <td><table width="900" height="40" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><h1>欢迎光临<?=$cfg_site_name?>之自测系统</h1></td>
        <td><div align="right"><a href="#" onClick="location='./'" style="text-decoration:underline; color:#FFFFFF;">本站首页</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>以下为您的测试历史记录&gt;</td>
    <td><div align="center"><a href="index.php" style="text-decoration:underline; color:blue;">开始新的测验</a></div></td>
    <td><div align="center"><a href="../logout.php?to_go=<?=urlencode("exam/index.php")?>" style="text-decoration:underline; color:blue;">退出系统</a></div></td>
  </tr>
</table>
<br>
<table border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#999999">
  <tr>
    <td bgcolor="#FFFFFF"><table width="1000"  border="0" align="center" cellpadding="5" cellspacing="1">
      <tr bgcolor="#C1E0FF">
        <td width="60"><div align="left"><strong>测试者</strong></div></td>
        <td width="100"><div align="left"><strong>试题所属</strong></div></td>
		<td><div align="left"><strong>考试反映您的知识欠缺</strong></div></td>
		<td width="70"><div align="center"><strong>考试时间</strong></div></td>
		<td width="70"><div align="center"><strong>耗时(分)</strong></div></td>
		<td width="60"><div align="center"><strong>得分</strong></div></td>
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
	   <tr bgcolor="#E3E3E3" >
	     <td><div align="left"><?=$tester?></div></td>
	     <td><?=$row->test_region?></td>
	     <td>
             <?php 
			     for($i=0;$i<$num_of_p;$i++){ 
			     $query="select answer,point from  ".$table_suffix."test where id={$problem_list[$i]}";
			     $result=mysql_query($query);
				 $answer=mysql_result($result,0,"answer");
			     if($answer<>$answer_list[$i]) $point[$i]=mysql_result($result,0,"point");
				 } 
				 
                                      $point=implode(",",$point);
				 $point=explode(",",$point);
                                      $point=array_unique($point);
				 $point=implode(" ",$point);
				 echo $point==""?"无":$point;
		    ?></td>
	     <td nowrap><div align="center"><?=substr($row->test_time,3,8)?></div></td>
	     <td nowrap><div align="center"><?=$row->used_time?></div></td>
	     <td nowrap><div align="center"><?=$row->score?></div></td>
	   </tr>
	   <tr>
	     <td height="1" colspan="6" bgcolor="#CCCCCC" ></td>
  </tr>
	   <?php } 
	     }
	   ?>	
</table>
<table width="1000"  border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#BEDEDE">
  <tr>
    <td width="50%"><div align="right">第
            <?=$page_id?>
            页/共
            <?=$page?>
            页(
            <?=$num?>
            条记录)</div></td>
    <td><div align="center">
        <table border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td><?php require_once("function/page_divide.php"); ?></td>
          </tr>
        </table>
    </div></td>
  </tr>
</table></td>
  </tr>
</table>
<table width="100%" height="80"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><div align="center">Powered by
                      <?=$cfg_site_name?>
                      <?=$cfg_copyright?>
                      <br>
                      网站制作服务：
                      <?=$cfg_webmaster?>
              </div></td>
            </tr>
</table>
<?php } 
 else showmsg("您还没有登录，请先登录","index.php");
?>
</body>
</html>