<?php 
   require_once("setting.php");
   require_once("inc.php"); 
   require_once("function/inc_function.php");    
?><html><!-- InstanceBegin template="/Templates/admin_root.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<!-- InstanceBeginEditable name="doctitle" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
--> 
</style></head>
 
<body>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="头部" --><?php require_once(RROOT."/admin/scripts/header.php"); ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/bg_login.gif">
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top"><!-- InstanceBeginEditable name="主体" -->
         <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/search_bar_bg.gif">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
            </tr>
          </table>
		  <?php if($_SESSION['root']=="super_administrator") { 
		    if(isset($_REQUEST['sub_add'])) { 
			$level=$_REQUEST['type'];
		    $real_name=trim($_REQUEST['real_name']);
			$admin_id=trim($_REQUEST['id']); 
			$password=md5(trim($_REQUEST['password']));
			$writer_name=trim($_REQUEST['writer_name']); 
			$telephone=trim($_REQUEST['telephone']);
			$register_time=date("y-m-d H:i:s");
			$life=$_REQUEST['life'];
			
			$result=mysql_query("select * from ".$table_suffix."member where user_name='$admin_id'");
            if(mysql_num_rows($result))  ShowMsg("对不起,该用户名已经被普通会员使用,请重试.",-1);
			else {
			$result=mysql_query("select * from ".$table_suffix."admin where admin_id='$admin_id'");
            if(mysql_num_rows($result))  ShowMsg("对不起,该用户名已经被其他管理员使用,请重试.",-1);
			else {
			$result=@mysql_query("insert into ".$table_suffix."admin (writer_name,telephone, admin_level,real_name,admin_id, admin_password, register_time,life) values 
			('$writer_name','$telephone', '$level','$real_name','$admin_id','$password','$register_time','$life')");
			if($result)  { 
			$out_string="OK！添加成功！用户名：".$id." 密码：".trim($_REQUEST['password']);
			MsgClose($out_string);
			}
			else {
			 $out_string="SORRY！添加失败，可能账号与已有帐号重复了，或者数据库暂时不能写入"; 
			 ShowMsg($out_string, -1);
			   }
			 }
		   }
		  }
		  elseif(isset($_REQUEST['add'])) { ?>
          <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><form name="form1" method="post" action="<?=$PHP_SELF?>">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="10" rowspan="5">&nbsp;</td>
                            <td colspan="2" bgcolor="#FFCCCC">请选择管理员帐号类型:
                              <input type="radio" name="type" value="9">
                              超级
                              <input name="type" type="radio" value="1" checked>
                              普通</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><p>姓名
                              <input name="real_name" type="text" id="real_name">
                            </p>                              </td>
                            <td>账号有效性
                              <select name="life" id="life">
                                <option value="1"selected>有效</option>
                                <option value="0">无效</option>
                              </select></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>笔名
                              <input name="writer_name" type="text" id="writer_name"></td>
                            <td>电话
                              <input name="telephone" type="text" id="real_name3"></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>账号
                              <input type="text" name="id" value=""></td>
                            <td>密码
                              <input name="password" type="text" id="password2" value=""></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><input name="sub_add" type="submit" id="sub_add" value="提 交" onClick="return chk_if_blank();"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
              </table></td>
            </tr>
          </table>
		    <?php }
				   elseif(isset($_REQUEST['submit'])) { 
				   $id=trim($_REQUEST['id']); 
				   $password=md5(trim($_REQUEST['password']));
				   $life=$_REQUEST['life'];
				   $result=@mysql_query("update ".$table_suffix."admin set admin_password='$password', life='$life' where admin_id='$id'");
				   if($result) { 
			       if($life=="1")  $out_string = " OK！更新成功！用户名：".$id." 密码：".trim($_REQUEST['password']);
			       else $out_string = "操作成功, 该用户已被禁止！";
				   if($_SESSION['admin_valid']==$id) $_SESSION['pass_valid']=$password;
				   MsgClose($out_string);
				   }
				   else  { 
				    $out_string="SORRY！更新失败!";   
			        ShowMsg($out_string, -1);
				    }
				   } 
				   elseif(isset($_REQUEST['edit_id'])){ 
				   $id=$_REQUEST['edit_id'];
				   $query="select * from ".$table_suffix."admin where admin_id='$id'";
				   $result=@mysql_query($query);
				   ?>
                    <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#808080">
                      <tr>
                        <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><form name="form1" method="post" action="<?=$PHP_SELF?>">
                              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td width="10" rowspan="3">&nbsp;</td>
                                  <td>账号:
                                  <?php echo $id=@mysql_result($result,0,"admin_id")?>
                                  <input type="hidden" name="id" value="<?php echo $id ?>"></td>
                                  <td>账号有效性
                                    <select name="life">
                                      <option value="1" <?php if(@mysql_result($result,0,"life")=="1") echo "selected"; ?>>有效</option>
                                      <option value="0" <?php if(@mysql_result($result,0,"life")=="0") echo "selected"; ?>>无效</option>
                                    </select>
</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>密码
                                  <input name="password" type="password" id="password1" value=""></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><input name="submit" type="submit" id="submit" value="提 交" onClick="return chk_if_blank();"></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table>
                            </form></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                <?php } 
		    }
		   else { ?>
		  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#A0A0A4">
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <table border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFFFFF">您不是超级管理员，没有权限访问此页！</td>
                  </tr>
                </table>
                <table border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><a href="javascript:history.go(-1)">点击返回</a></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table>
		  <script> alert("对不起，您无权访问此页！");</script>
		  <?php } ?>
		 <div id="bodyframe" style="VISIBILITY: hidden">
        <IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
		 </div>
          <!-- InstanceEndEditable --></td>
        </tr>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!-- InstanceBeginEditable name="脚部" --><?php require_once("scripts/footer.php");?><!-- InstanceEndEditable --></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<script>
function chk_if_blank(){
 var obj=document.all;
 if(obj.id.value==""||obj.password.value==""||obj.real_name.value==""||obj.writer_name.value==""||obj.telephone.value=="") 
  { if(obj.life.value=="0") return true; 
    else { 
	alert("请完整的填写表单！"); return false; 
	  }
	}
}
</script>


