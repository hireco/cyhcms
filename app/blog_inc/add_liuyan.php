<?php 
    session_start(); 
    require_once(dirname(__FILE__)."/../config/base_cfg.php");
    require_once(dirname(__FILE__)."/../inc/show_msg.php"); 
	require_once(dirname(__FILE__)."/../inc/main_fun.php");
    require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
    
	if(isset($_POST['submit_liuyan'])) {
    if(($_SESSION['input_string']<>$_POST['check_input'])||(!isset($_SESSION['input_string']))) 
	{ ShowMsg("对不起,您的留言被取消","-1");   
      exit;
	 }
	
	$content=trim(strip_tags($_POST['content']));
	$infor_title=msubstr(trim(strip_tags($_POST['infor_title'])),0,100);
	$post_time=date("y-m-d H:i:s");
	$post_ip=$ip;
	$hide="0";
	$to_user_name=$host_name;
	
	if(isset($_SESSION['root']))  {  $person="网站管理者"; $from_user_name=$_SESSION['admin_id'];   }  
	elseif(isset($_SESSION['user_name'])) { 
	  if($host_name==$_SESSION['user_name'])   { ShowMsg("对不起,不能为自己留言","-1"); echo "<br>";  exit; }
	  $person=$_SESSION['nick_name']; $from_user_name=$_SESSION['user_name']; 
	 }  
	else { ShowMsg("对不起,您还没有登录,请先登录","-1");  echo "<br>";   exit; }  
	
	$result=mysql_query("select black_list from ".$table_suffix."member where user_name='{$host_name}'");
	$black_list=mysql_result($result,0,"black_list");
	$black_list=explode(",",$black_list); 
	if(in_array($_SESSION['user_id'],$black_list))  { ShowMsg("抱歉,对方已经屏蔽了您的留言",-1); echo "<br>";  exit;}
	
	if(empty($content))   { ShowMsg("对不起,您的留言内容丢失或为空白","-1");  echo "<br>";   exit; 	 }
	
    
	$query="insert into  ".$table_suffix."member_guestbook 
	(infor_title,content,to_user_name,person, from_user_name,post_time,post_ip,hide) 
	 values 
	('$infor_title','$content','$to_user_name','$person','$from_user_name','$post_time','$post_ip','$hide')";
    
	$result=mysql_query($query);
    if($result)  { ShowMsg("恭喜您,您的留言已经提交","-1");  echo "<br>";  exit; }
  } 
  else {
?>
<TABLE cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
        <TBODY>
        <TR vAlign=top>
          <TD class=downintro colSpan=2><A name=say></A>
            <TABLE height=30 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=blog_inc/detailtitle.gif border=0>
              <TBODY>
                <TR>
                  <TD align=middle width=10></TD>
                  <TD><strong>给博主留言</strong></TD>
                </TR>
              </TBODY>
            </TABLE>
            <table cellspacing=0 cellpadding=3 width="100%" 
            align=center border=0>
            <form  name="form" action="" method=post enctype=multipart/form-data>
              <tbody>
                <tr>
                  <td width=20 height=25 align=middle><div align="right"></div></td>
                  <td height=25 nowrap class=bbscon>
				  <?php if(isset($_SESSION['user_name'])&&isset($_SESSION['nick_name']))  { ?>
				  
				                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="80">留 言 者</td>
                                          <td><?php echo  $_SESSION['nick_name']; ?> <a href="logout.php" style="text-decoration:underline">退 出</a></td>
                                        </tr>
                                      </table>
									  <?php }   
				  else { ?>您还没有登录,不可以留言 <a href="member.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" target="_self" style="text-decoration:underline;">登 录</a> | <a href="register.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" style="text-decoration:underline"> 注 册</a><?php } ?>
                </td> </tr>
                <?php if(isset($_SESSION['user_name']))  { ?>
				<tr>
                  <td height=25 align=middle>&nbsp;</td>
                  <td height=25 colspan="3" nowrap class=bbscon><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="80">留言标题</td>
                      <td><input type="text" name="infor_title" class="INPUT" style="width:300px;"></td>
                    </tr>
                  </table>                    </td>
                </tr>
				<tr>
                  <td align=middle height=25>&nbsp;</td>
                  <td height=25 colspan="3" valign="top" class=bbscon><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="80" valign="top">留言内容</td>
                        <td><textarea name=content style="width:95%" rows=9 id="textarea2" class="TEXTAREA"></textarea></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align=middle height=25>&nbsp;</td>
                  <td height=25 colspan="3" class=bbscon>
				   <div id="face_list" align=left>
                        <?php 
						  $i_row=($body_width-181)/32; 
						  echo "<table cellspacing=0 cellpadding=0 border=0>";
						  for($i=1;$i<=64;$i++) { 
						  if($i%$i_row==1) echo "<tr><td>";
                          echo "<img src=\"blog_inc/face/".$i.".gif\" onClick=\"set_face('".$i."');\" border=\"1\" style=\"border-color:#FFFFFF; cursor:pointer\"> ";
					      if($i%$i_row==0) echo "</td></tr>";
					      } 
					     echo "</table>";
					  ?>
                    </div></td>
                </tr>
                <tr>
                  <td  align=middle height=25></td>
                  <td height=25 colspan="3" nowrap class=bbscon><div align="left">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="60" height=25 nowrap class=bbscon><div align="left">验证码</div></td>
                        <td width="200" class=bbscon><?php require_once(dirname(__FILE__)."/../code_check/code.php");?></td>
                        <td class=bbscon><input name="submit_liuyan" type=submit class=button id="submit_comment" value="留言给博主" onclick="return check_form_liuyan();"></td>
                      </tr>
                    </table>
                  </div></td>
                </tr>
				<?php } ?>
            </form>
          </table></TD>
</TR></TABLE>
<?php } ?>
<script>
function check_form_liuyan() {
	if(document.form.content.value=="") { 
     alert("内容不能为空白!");
	 document.form.content.focus();
	 return false;
    }
   if(document.code_check.form.check_code_hide.value!=hex_md5(document.code_check.form.check_code.value))
	{alert("验证码填写不对，如果看不清，请点击按钮刷新！");
	 return false;
	} 
	
	else {
	 document.form.check_input.value=document.code_check.form.check_code.value;
	 return true;
	}
}

function selectface(face_id) { 
if(document.getElementById("face_list")) {
var areaImages = document.getElementById("face_list").getElementsByTagName("img"); 
var areaImagesCount = areaImages.length; 
for(var i=0;i<areaImagesCount;i++) { 
 if(face_id==i+1) areaImages[i].style.border="1px solid #FF0000"; 
 else areaImages[i].style.border="1px solid #FFFFFF";
  } 
 }
}

function set_face(face_id) {
  var string=document.form.content.value;
  document.form.content.value=string+"//f:" + face_id + "//f";
  selectface(face_id);
}


</script>