<?php 
    session_start(); 
    require_once(dirname(__FILE__)."/../config/base_cfg.php");
    require_once(dirname(__FILE__)."/../inc/show_msg.php"); 
	require_once(dirname(__FILE__)."/../inc/main_fun.php");
    require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
    
	if(isset($_POST['submit_comment'])) {
    if(($_SESSION['input_string']<>$_POST['check_input'])||(!isset($_SESSION['input_string']))) 
	{ ShowMsg("对不起,您的评论被取消","-1");   
      exit;
	 }
	
	$content=trim(strip_tags($_POST['content']));
	$infor_id=$_POST['infor_id'];
	$post_time=date("y-m-d H:i:s");
	$post_ip=$ip;
	$hide="0";
	
	if(isset($_SESSION['root']))  { $user_type="s"; $person="网站管理者"; $user_name=$_SESSION['admin_id']; }  
	elseif(isset($_SESSION['user_name'])) { $user_type="r"; $person=$_SESSION['nick_name']; $user_name=$_SESSION['user_name']; }  
	else { $user_type="a"; $person=$_POST['person']; $user_name="匿名用户"; }  
	
	if(empty($person)||empty($content))   { ShowMsg("对不起,您的评论内容丢失或为空白","-1"); echo "<br>";   exit; 	 }
	
	$query="select id from  ".$table_suffix."member_blog  where  id=$infor_id";
	if(!mysql_num_rows(mysql_query($query)))  { ShowMsg("对不起,您要评论的对象不存在","-1"); echo "<br>";   exit; 	 }
    
	$query="insert into  ".$table_suffix."blog_comment 
	(infor_id,content,user_name,person, user_type,post_time,post_ip,hide) 
	 values 
	('$infor_id','$content','$user_name','$person','$user_type','$post_time','$post_ip','$hide')";
    
	$result=mysql_query($query);
    if($result)  { ShowMsg("恭喜您,您的评论已经提交","-1");  echo "<br>";  exit; }
  } 
  elseif(!isset($_REQUEST['infor_id']))   { ShowMsg("无效的访问",-1); echo "<br>";  exit;}
  else {
?>
<TABLE cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
        <TBODY>
        <TR vAlign=top>
          <TD class=downintro colSpan=2 height=150><A name=say></A>
            <TABLE height=30 cellSpacing=0 cellPadding=0 width="100%" 
      align=center background=blog_inc/detailtitle.gif border=0>
              <TBODY>
                <TR>
                  <TD align=middle width=10></TD>
                  <TD><strong>发表评论</strong></TD>
                </TR>
              </TBODY>
            </TABLE>
            <table cellspacing=0 cellpadding=3 width="100%" 
            align=center border=0>
            <form  name="form" action="blog_inc/add_comment.php" method=post enctype=multipart/form-data>
              <tbody>
                <tr>
                  <td width=20 height=25 align=middle><div align="right"></div></td>
                  <?php if(isset($_SESSION['user_name'])&&isset($_SESSION['nick_name']))  { ?> 
				  <td width="150" height=25 nowrap class=bbscon>
				   <div align="left">评论人  <?php  echo  $_SESSION['nick_name']; ?>
			      <a href="logout.php" style="text-decoration:underline">退 出</a></div></td><?php }   
				  else { ?><td><?php echo "<input type=\"text\"  value=\"匿名访客 \"  name=\"person\" class=\"INPUT\" style=\"width:100px;\">"; ?> <a href="member.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" target="_self" style="text-decoration:underline;">登 录</a> | <a href="register.php?to_go=<?php  
				  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	              else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>" style="text-decoration:underline"> 注 册</a> <?php } ?></td>
                </tr>
                <tr>
                  <td align=middle height=25>&nbsp;</td>
                  <td height=25 colspan="3" class=bbscon><textarea name=content style="width:95%" rows=9 id="content" class="TEXTAREA"></textarea>
                    <input name="infor_id" type="hidden" id="infor_id" value="<?=$_REQUEST['infor_id']?>"> </td>
                </tr>
                <tr>
                  <td align=middle height=25>&nbsp;</td>
                  <td height=25 colspan="3" class=bbscon>
				   <div id="face_list" align=left>
                        <?php 
						  $i_row=($body_width-181)/32; 
						  echo "<table cellspacing=1 cellpadding=3 border=0>";
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
                  <td height=25 colspan="3" nowrap class=bbscon><div align="center">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="60" height=25 nowrap class=bbscon><div align="left">验证码</div></td>
                        <td width="200" class=bbscon><?php require_once(dirname(__FILE__)."/../code_check/code.php");?></td>
                        <td class=bbscon><input name="submit_comment" type=submit class=button id="submit_comment" value="发布评论" onclick="return check_form_comment();"></td>
                      </tr>
                    </table>
                  </div>                    </td>
                </tr>
            </form>
          </table></TD>
</TR></TABLE>
<?php } ?>
<script>
function check_form_comment() {
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