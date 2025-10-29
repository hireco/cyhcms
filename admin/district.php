<?php 
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
require_once(dirname(__FILE__)."/../inc/cn2en.php");
require_once(dirname(__FILE__)."/scripts/constant.php");

$query="select * from ".$table_suffix."province  order by top_time desc";
$result=mysql_query($query); 
$num_of_prov=mysql_num_rows($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>地区管理</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<?php echo "
<script> 
                        var i=4;
						function 
						insRow()
						{var x=document.getElementById('myTable').insertRow(i+1);
						var h1=x.insertCell(0);
						var h2=x.insertCell(1);
						var h3=x.insertCell(2);
						var h4=x.insertCell(3);
						var h5=x.insertCell(4);
						var h6=x.insertCell(5);
						h1.innerHTML=\"城市名称 \"+i+\"：\";
						h2.innerHTML=\"<input name=city_name\"+i+\" type=text style='width:200px'><input type=hidden name=city_id\"+i+\">\";
						h3.innerHTML=\"邮政编码：\";
						h4.innerHTML=\"<input name=zip_code\"+i+\" type=text style='width:100px'>\";
						h5.innerHTML=\"类型：\";
						h6.innerHTML=\"<select name=name_suffix\"+i+\" >"; 
						for($j=1; $j<=count($city_suffix);$j++ )  
	                    echo "<option value='{$city_suffix[$j]}'>{$city_suffix[$j]}</option>";
						echo "</select>\";
						i=i+1;}
</script>";
?>
</head>
<body>
<?php require_once(dirname(__FILE__)."/scripts/header.php")?>
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
                <td><img src="../image/body_title_left.gif" width="3" height="27" /></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                    <div align="center" class="bigtext_b"><a href="district.php">地区管理</a></div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27" /></td>
              </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
        <div align="center"> </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCC66">
  <tr>
    <td height="5"></td>
  </tr>
</table>
<table width="100%" height="400"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <?php 
     $i=1; 
	 while($row=mysql_fetch_object($result)) { if($i%40==1) echo "<tr bgcolor=\"#FFCC66\"><td></td>"; ?>    
	<td align="center"  style="line-height:120%;" <?php if($_REQUEST['prov_id']==$row->id) echo "bgcolor=\"#FFFFFF\""; ?>><a href="?view_city&prov_id=<?=$row->id?>&prov_name=<?=urlencode($row->prov_name)?>" target="_self"><?=$row->prov_name?></a></td>
    <?php if(($i/40==1)||($i==$num_of_prov)) echo "<td></td></tr>"; $i++; } ?>
</table>
<?php 
$ereg_str=implode("|",$city_suffix);
if(isset($_REQUEST['top'])) {
   $top_time=date("y-m-d H:i:s");
   $result=mysql_query("update ".$table_suffix.$_REQUEST['top']." set top_time='$top_time' where id={$_REQUEST['top_id']}");
   if($result) echo "<script>parent.location.reload(); window.close();</script>";   
}
elseif(isset($_POST['amend_city_sub'])) { 
	$city_name=ereg_replace($ereg_str."$","",trim($_POST['city_name']));
	$zip_code=trim($_POST['zip_code']);
	$district_list=explode(" ",trim($_POST['district_list']));
	$district_list=implode(",",$district_list);
	$name_suffix=$_POST['name_suffix'];
	
	$university_list=explode("　",trim($_POST['university_list']));
	$university_list=implode(",",$university_list);
	
	$en_name=c($_POST['city_name']);			
	$query="update ".$table_suffix."city  set city_name='$city_name',en_name='{$en_name}',zip_code='$zip_code',prov_id='{$_REQUEST['prov_id']}',name_suffix='$name_suffix',district_list='$district_list',university_list='$university_list' where id={$_REQUEST['city_id']}";
	$result=mysql_query($query);
	if($result) ShowMsg("操作成功！","?view_city&prov_name=".urlencode($_REQUEST['prov_name'])."&prov_id={$_REQUEST['prov_id']}");
	else ShowMsg("操作失败！",-1);
  }

elseif(isset($_POST['reset_city_sub']))  { 
           mysql_query("delete from ".$table_suffix."city where prov_id={$_REQUEST['prov_id']}");
           $i=1; $city_name_str="city_name".$i; $zip_code_str="zip_code".$i; $name_suffix_str="name_suffix".$i; $city_id_str="city_id".$i;
		   $city_name="";
		    while(($_POST[$city_name_str]<>"")&&(isset($_POST[$city_name_str]))) 
		   {
		    $_POST[$city_name_str]=ereg_replace($ereg_str."$","",trim($_POST[$city_name_str]));
			$_POST[$zip_code_str]=trim($_POST[$zip_code_str]);
			$en_name=c($_POST[$city_name_str]);			
			if($_POST[$city_id_str]<>"")
			$query="insert into ".$table_suffix."city  (id, city_name,en_name,zip_code,prov_id,name_suffix) values ({$_POST[$city_id_str]},'{$_POST[$city_name_str]}','{$en_name}','{$_POST[$zip_code_str]}','{$_REQUEST['prov_id']}','{$_POST[$name_suffix_str]}')";
			else $query="insert into ".$table_suffix."city  (city_name,en_name,zip_code,prov_id,name_suffix) values ('{$_POST[$city_name_str]}','{$en_name}','{$_POST[$zip_code_str]}','{$_REQUEST['prov_id']}','{$_POST[$name_suffix_str]}')";
			$result=mysql_query($query);
			$i++; $city_name_str="city_name".$i; $zip_code_str="zip_code".$i; $name_suffix_str="name_suffix".$i; $city_id_str="city_id".$i;
		    }
     if($result) ShowMsg("操作成功！","?view_city&prov_name=".urlencode($_REQUEST['prov_name'])."&prov_id={$_REQUEST['prov_id']}");
	 else ShowMsg("操作失败！",-1);
  }

elseif(isset($_REQUEST['amend_city'])) { 
  $query="select * from ".$table_suffix."city  where id={$_REQUEST['city_id']}";
  $result=mysql_query($query); 
  if($result) $row=mysql_fetch_object($result);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td><?=$_REQUEST['prov_name'];?>>><?=$_REQUEST['city_name']?>&gt;&gt;编辑</td>
      </tr>
</table>
 <table width="100%"  border="0" cellpadding="10" cellspacing="1" bgcolor="#D2D2D2">
   <tr>
     <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="">
                <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="2" cellspacing="0">
                                    <tbody>
									  <tr>
                                        <td width="90">城市名称 ：</td>
                                        <td width="300"><input name="city_name" type="text"  style="width:200px"  value="<?=$row->city_name?>"/></td>
                                        <td width="90">邮政编码：</td>
                                        <td width="200"><input name="zip_code" type="text"   style="width:100px"  value="<?=$row->zip_code?>"/>
                                        </td>
                                        <td width="50">类型：</td>
                                        <td>
                                        <?php  
										echo "<select name=\"name_suffix\">";  
									    for($j=1; $j<=count($city_suffix);$j++ )  {
	                                    echo "<option value='{$city_suffix[$j]}'"; 
										if($city_suffix[$j]==$row->name_suffix) echo " selected";
										echo ">{$city_suffix[$j]}</option>";
										}
										echo "</select>";
	                                    ?></td>
                                      </tr>
									  <tr>
									    <td>所属地区 ：</td>										
									    <td colspan="5"><textarea name="district_list" cols="100" rows="4"><?=$row->district_list?></textarea></td>
								      </tr>
									  <tr>
									    <td>所属大学 ：</td>
										<td colspan="5"><textarea name="university_list" cols="100" rows="6" id="university_list"><?=$row->university_list?>
									    </textarea></td>
								      </tr>                                     
                                    </tbody>
                        </table></td>
                  </tr>
                  <tr>
                    <td><input name="amend_city_sub" type="submit" class="inputbut" id="edit_city_sub" value="提  交"> <input name="cancel" type="button" class="inputbut" id="cancel" value="不理返回" onClick="history.go(-1)"> </td>
                  </tr>
                </table>
              </form></td>
            </tr>
          </table></td>
   </tr>
 </table></td>
  </tr>
</table>
<?php }
 elseif(isset($_REQUEST['reset_city'])) {
   $prov_id=$_REQUEST['prov_id'];
   $prov_name=$_REQUEST['prov_name'];   
   $query="select * from ".$table_suffix."city  where prov_id={$prov_id}";
   $result=mysql_query($query); 
   $num_of_city=mysql_num_rows($result);
 ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td><?=$prov_name;?>&gt;&gt;编辑城市列表</td>
      </tr>
    </table>
      <table width="100%"  border="0" cellpadding="10" cellspacing="1" bgcolor="#D2D2D2">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="">
                <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="2" cellspacing="0" id="mytable">
                                    <tbody>
                                      <tr>
                                        <td colspan="6" align="center" bordercolor="#rgb(32,44,96)" class="inquiry"><div align="left"></div>                                          <div align="left">
                                              <input name="button" type="button" class="inputbut" onclick="insRow()" value="增加表单" />
                                                                                  </div></td>
                                      </tr>
                                      <?php
									    $end_i=$num_of_city>3?$num_of_city:3;
										echo "<script>var i={$end_i}+1;</script>";
									    for($i=1;$i<=$end_i;$i++) {
									    $row=mysql_fetch_object($result);
									   ?>
									  <tr>
                                        <td width="90">城市名称 <?=$i?>：</td>
                                        <td width="300"><input name="city_name<?=$i?>" type="text"  style="width:200px"  value="<?=$row->city_name?>"/>
                                        <input type="hidden" name="city_id<?=$i?>" value="<?=$row->id?>"></td>
                                        <td width="90">邮政编码：</td>
                                        <td width="200"><input name="zip_code<?=$i?>" type="text"   style="width:100px"  value="<?=$row->zip_code?>"/>
                                        </td>
                                        <td width="50">类型：</td>
                                        <td>
                                        <?php  
										echo "<select name=\"name_suffix{$i}\">";  
									    for($j=1; $j<=count($city_suffix);$j++ )  {
	                                    echo "<option value='{$city_suffix[$j]}'"; 
										if($city_suffix[$j]==$row->name_suffix) echo " selected";
										echo ">{$city_suffix[$j]}</option>";
										}
										echo "</select>";
	                                    ?></td>
                                      </tr>
                                      <?php } ?>
                                      <tr>
                                        <td colspan="6" align="right"><div align="left"> </div></td>
                                      </tr>
                                    </tbody>
                        </table></td>
                  </tr>
                  <tr>
                    <td><input name="reset_city_sub" type="submit" class="inputbut" id="reset_city_sub" value="提  交" onClick="return really();"> 
					   <input name="cancel" type="button" class="inputbut" id="cancel" value="不理返回" onClick="history.go(-1)"> </td>
                  </tr>
                </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
   
<?php }
   elseif(isset($_REQUEST['view_city']))  { 
   $prov_id=$_REQUEST['prov_id'];
   $prov_name=$_REQUEST['prov_name'];     
   ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td><?=$prov_name;?>&gt;&gt;城市列表</td>
        </tr>
      </table>
        <table width="100%"  border="0" cellpadding="10" cellspacing="1" bgcolor="#D2D2D2">
          <tr>
            <td bgcolor="#FFFFFF">
			<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D1D1D1">
			  <tr bgcolor="#FFFFFF">
			  　<td><div align="center">城市ID</div></td>
			    <td><div align="center">修改城市</div></td>
			    <td><div align="center">城市名称</div></td>
				<td><div align="center">邮政编码</div></td>
				<td><div align="center">置顶城市</div></td>
			  </tr>
	     <?php 
          $query="select * from ".$table_suffix."city  where prov_id={$prov_id} order by top_time desc";
		  $result=mysql_query($query);
		  $num=mysql_num_rows($result);
		  while($row=mysql_fetch_object($result)) { ?>    
	      <tr bgcolor="#FFFFFF">
		  <td><div align="center"><?=$row->id?></div></td>
		  <td><div align="center"><a href="?amend_city&prov_name=<?=urlencode($_REQUEST['prov_name'])?>&prov_id=<?=$_REQUEST['prov_id']?>&city_id=<?=$row->id?>&city_name=<?=urlencode($row->city_name)?>">点击进入</a></div></td>
		  <td><div align="center"><a href="?view_district&city_id=<?=$row->id?>&city_name=<?=urlencode($row->city_name)?>" target="_self">
		      <?=$row->city_name.$row->name_suffix?>
		      </a></div></td>
		  <td><div align="center"><?=$row->zip_code==""?"未填":$row->zip_code?>
		    </div></td>
		  <td bgcolor="#FFFFFF"><div align="center"><a href="#" onClick="window.open('?top_id=<?=$row->id?>&top=city','hide_frame','width=1,height=1')">点击置顶</a>		    </div></td>
		  </tr>
		  <?php } ?>
          </table>
		    <table width="100%"  border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td><input name="edit_add" type="button" 
				   <?php if($_SESSION['root']<>"super_administrator")  echo "disabled"; ?>
				   class="inputbut"  onClick="if(really())  location='?reset_city&prov_id=<?=$prov_id?>&prov_name=<?=urlencode($prov_name)?>'"value="<?php if(!$num) echo "开始添加"; else echo "重新编辑"; ?>城市列表">
                  <input name="top_prov" type="button" class="inputbut" id="top_prov" value="置顶省份" onClick="window.open('?top_id=<?=$prov_id?>&top=province','hide_frame','width=1,height=1')"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
<?php  } 
      else { ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%"  border="0" cellpadding="10" cellspacing="1" bgcolor="#D2D2D2">
      <tr>
        <td bgcolor="#FFFFFF"><?php $result=@mysql_query("select distinct area from ".$table_suffix."province where 1=1"); 
				   if($result)
				   while($row=@mysql_fetch_object($result)) { 
				   $area=$row->area; ?>
                  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="10">&nbsp;</td>
                      <td><font color=red><strong>
                        <a href="#" onClick="display_table('<?=$area?>')"><?=$area?>地区</a></strong></font></td>
                    </tr>
					<tr><td></td>
                    <td>
					<div style="display:block;" id="<?=$area?>">
					<?php $result_1=@mysql_query("select * from ".$table_suffix."province where area='$area'"); 
						       if($result_1)
							   while($row_1=@mysql_fetch_object($result_1)){ ?>                    
					<table width="100%"  border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="3%"  style="line-height:140%;">&nbsp;</td>
                        <td width="100" nowrap style="line-height:140%;"><?php 
					           echo "<a href=\"?view_city&prov_id=$row_1->id&prov_name=".urlencode($row_1->prov_name)."\">";
							   echo $row_1->prov_name.$row_1->prov_type;
							   echo "</a>";							   
							   echo "&nbsp&nbsp&nbsp"; 
							   ?></td>
                        <td style="line-height:140%;"><?php 
						$query="select * from ".$table_suffix."city  where prov_id={$row_1->id} order by top_time desc";
		                $result_2=mysql_query($query);
		                while($row_2=mysql_fetch_object($result_2))    
						echo $row_2->city_name.$row_2->name_suffix."&nbsp;&nbsp; ";
						?>
						</td>
                      </tr>
                    </table>					
					<?php } ?>
					 </div>
					 </td>
                    </tr>
                  </table>
                <?php }
					?></td>
      </tr>
    </table></td>
  </tr>
</table><?php } ?></td>
  </tr>
</table>
<?php require_once(dirname(__FILE__)."/scripts/footer.php")?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
</body>
</html>
<script>
function display_table(div_id) {
 var div=document.getElementById(div_id);
 if(div.style.display=="block") div.style.display="none";
 else div.style.display="block";
}

function really() {
 result="注意!更新操作将清除此省份的已有记录,继续吗?";   
       if   (confirm(result))    return true; 
       else return false;
}

</script>
