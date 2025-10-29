<?php 
   session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
  
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
                  <div align="center">编辑投票</div>
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
		  <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0" bgcolor="#E3DFB0">
            <tr>
              <td width="10">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
</table>
		  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td>
						  <?php if(isset($_POST['poll_add'])) { 
						  $poll_title=trim($_POST['poll_title']); 
		                  $introduction=addslashes(trim($_POST['introduction']));
		                  $end_time=trim($_POST['end_time']);
						  $post_time=date("y-m-d H:i:s");
						  $hide="1";
						  if(isset($_REQUEST['id'])) 
						    $query="update  ".$table_suffix."poll_topics  set poll_title='$poll_title', introduction='$introduction',
							 post_time='$post_time',end_time='$end_time',hide='$hide' where id={$_REQUEST['id']}";
						  else 
						    $query="insert into ".$table_suffix."poll_topics (poll_title,introduction,post_time,end_time,hide)  values
		                  ('$poll_title', '$introduction','$post_time','$end_time','$hide')";
						  $result=@mysql_query($query);
						  if($result) { 
						  if(isset($_REQUEST['id'])) { 
						    $poll_id=$_REQUEST['id'];
							mysql_query("delete from ".$table_suffix."poll_selection where poll_id={$poll_id}"); 
							 }
						  else $poll_id=mysql_insert_id();
						  $i=1; $selection_str="selection".$i; $hit_str="hit".$i;
		                  $selection="";
		                  while(($_POST[$selection_str]<>"")&&(isset($_POST[$selection_str]))) 
		                   {
		                    $_POST[$selection_str]=trim($_POST[$selection_str]);
			                $_POST[$hit_str]=trim($_POST[$hit_str])==""?"0":trim($_POST[$hit_str]);			                
							$query="insert into ".$table_suffix."poll_selection  (poll_id, selection, hit) values ($poll_id,'{$_POST[$selection_str]}','$_POST[$hit_str]')";
							$result=mysql_query($query);
			                $i++; $selection_str="selection".$i; $hit_str="hit".$i;
		                    }
						  }
		                  if(!$result) $out_result="sorry, can not write to the database now"; 
						  else    $out_result="添加成功，返回继续加入！";
						  ShowMsg($out_result,"poll_admin.php"); exit;
						  } 
						  else  { 
						  if(isset($_REQUEST['id'])) {
						  $query="select * from ".$table_suffix."poll_topics where id={$_REQUEST['id']}";
						  $result=mysql_query($query);
						  if($row=mysql_fetch_object($result)) { 
						    $query_new="select * from ".$table_suffix."poll_selection where poll_id={$_REQUEST['id']}";
						    $result_new=mysql_query($query_new);
						    $num=@mysql_num_rows($result_new);
						  ?><table width="100%"  border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                      <td><FORM name="form1" action="" method=post>
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="100">调查题目</td>
                                            <td><input name="poll_title" type="text" id="poll_title" style="width:480px" value="<?=$row->poll_title?>"></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">调查简介</td>
                                            <td><textarea name="introduction" rows="5" id="introduction" style="width:480px"><?=$row->introduction?></textarea></td>
                                          </tr>
                                          <tr>
                                            <td>结束日期</td>
                                            <td><input name="end_time" type="text" id="end_time" value="<?=$row->end_time?>"></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">调查选项</td>
                                            <td>
											<table width="100%" border="0" cellpadding="2" cellspacing="0" id="mytable">
                                              <tbody>
                                                <tr>
                                                  <td colspan="4" align="center" bordercolor="#rgb(32,44,96)" class="inquiry"><div align="left"></div>
                                                      <div align="left">
                                                        <input name="button" type="button" class="inputbut" onclick="insRow()" value="增加选项..." />
                                                    </div></td>
                                                </tr>
                                                <?php 	$i=1; while($row_new=mysql_fetch_object($result_new)) { ?>
												<tr>
                                                  <td width="60" nowrap><div align="left">选项 <?=$i?>：</div></td>
                                                  <td width="300"><input name="selection<?=$i?>" type="text" id="selection<?=$i?>" value="<?=$row_new->selection?>" style="width:300px" /></td>
                                                  <td width="60">点击数：</td>
                                                  <td><input name="hit<?=$i?>" type="text" id="hit<?=$i?>" value="<?=$row_new->hit?>" style="width:50px" /></td>
                                                </tr>
                                                <?php	 $i++;	} ?>
                                                <tr>
                                                  <td colspan="4" align="right"><div align="left"> </div></td>
                                                </tr>
                                              </tbody>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">&nbsp;</td>
                                            <td><input name="poll_add" type="submit" class="inputbut" value="提　　交"></td>
                                          </tr>
                                        </table>
                                        </FORM></td>
                                    </tr>
                                  </table>
						 <?php }
						 else { ShowMsg("对象不存在！","poll_admin.php"); 　exit; }
						 }
						   else { 
						       $i=4;
						       ?>								  
								  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                      <td><FORM name="form1" action="" method=post>
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="100">调查题目</td>
                                            <td><input name="poll_title" type="text" id="poll_title" style="width:480px"></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">调查简介</td>
                                            <td><textarea name="introduction" rows="5" id="introduction" style="width:480px"></textarea></td>
                                          </tr>
                                          <tr>
                                            <td>结束日期</td>
                                            <td><input name="end_time" type="text" id="end_time" value="<?=date("y-m-d H:i:s")?>"></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">调查选项</td>
                                            <td><table width="100%" border="0" cellpadding="2" cellspacing="0" id="mytable">
                                              <tbody>
                                                <tr>
                                                  <td colspan="4" align="center" bordercolor="#rgb(32,44,96)" class="inquiry"><div align="left"></div>
                                                      <div align="left">
                                                        <input name="button" type="button" class="inputbut" onclick="insRow()" value="增加选项..." />
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                  <td width="60"><div align="left">选项 1：</div></td>
                                                  <td width="300"><input name="selection1" type="text" id="selection1" style="width:300px" /></td>
                                                  <td width="60">初始数：</td>
                                                  <td><input name="hit1" type="text" id="hit1" style="width:50px" />
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td>选项 2：</td>
                                                  <td><input name="selection2" type="text" id="selection2" style="width:300px" /></td>
                                                  <td>初始数：</td>
                                                  <td><input name="hit2" type="text" id="hit2" style="width:50px" />
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td>选项 3：</td>
                                                  <td><input name="selection3" type="text" id="selection3" style="width:300px" /></td>
                                                  <td>初始数：</td>
                                                  <td><input name="hit3" type="text" id="hit3" style="width:50px" />
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4" align="right"><div align="left"> </div></td>
                                                </tr>
                                              </tbody>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td valign="top">&nbsp;</td>
                                            <td><input name="poll_add" type="submit" class="inputbut" value="提　　交"></td>
                                          </tr>
                                        </table>
                                        </FORM></td>
                                    </tr>
                                  </table>
                                  </td>
                                </tr>
</table>
							  <?php } 
				 }			  
	?>
</body>
</html>
<SCRIPT language=javascript>
var i=<?php echo $i; ?>;
						function 
						insRow()
						{var x=document.getElementById('myTable').insertRow(i+1);
						var h1=x.insertCell(0);
						var h2=x.insertCell(1);
						var h3=x.insertCell(2);
						var h4=x.insertCell(3);
						h1.innerHTML="选项 "+i+"：";
						h2.innerHTML="<input name=selection"+i+" type=text style='width:300px'>";
						h3.innerHTML="初始数：";
						h4.innerHTML="<input name=hit"+i+" type=text style='width:50px'>";
						i=i+1;}
</SCRIPT>