<?php 
session_start(); 
   require_once("setting.php");
   require_once("inc.php"); 
   require_once(dirname(__FILE__)."/../config/base_cfg.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/function/getip.php");
   require_once(dirname(__FILE__)."/scripts/constant.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css">
  <?php $next_flag=0; $front_flag=0;
       if(isset($_REQUEST['next'])) { $id=$_REQUEST['next']; $next_flag=1;}
	   elseif(isset($_REQUEST['front'])){ $id=$_REQUEST['front'];$front_flag=1;}
	   else { $id=$_REQUEST['id']; $name=$_REQUEST['name'];} 
	   
	   if(isset($_POST['reply'])) { 
            $person=trim($_POST['person']);
			$content=addslashes(strip_tags(trim($_POST['content'])));
			$post_time=date("y-m-d H:i:s");
			$post_ip=$ip;
			$comment_or_not=$_POST['comment_or_not'];
			$id=$_POST['id'];
			$face=$_POST['face'];
			$user_type="s";
			
			$query="select * from  ".$table_suffix."comment where id={$id}";
			$row=mysql_fetch_object(mysql_query($query));
			$content_old=comment_sql_mode($row->person,$row->face,$row->post_ip,$row->post_time,$row->content);
			$content.=$content_old;		
			$query="update ".$table_suffix."comment set 
			person='$person',
			content='$content',
			post_time='$post_time',
			post_ip='$post_ip',
			comment_or_not='$comment_or_not',
			face='$face',
			user_type='$user_type' where id='$id'
			
			";
			if(!@mysql_query($query)) $out_result="对不起,数据库写入失败,请重新在下面表单录入!";
		    else $out_result="恭喜您,操作成功!";
			
			ShowMsg($out_result,-1); exit;
       }
	   
	   if($next_flag==1) $result=@mysql_query("select * from   ".$table_suffix."comment where id>='$id' order by id asc limit 0,1");
		  elseif($front_flag==1) $result=@mysql_query("select * from   ".$table_suffix."comment where id<='$id' order by id desc limit 0,1");
		  else $result=@mysql_query("select * from   ".$table_suffix."comment where id=$id");
		  if(!$result)  { ShowMsg("对应的评论不存在!",-1); exit;}
		  $row=@mysql_fetch_object($result); $id=$row->id;
		?>  
<table width="760" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td background="image/nei1.gif" height="37">
      <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>查看评论&gt;&gt;</td>
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td valign="middle" background="image/nei4.gif" >
        <?php if(!$row) { 
		 ShowMsg("对应的评论不存在!",-1);
         } else {?>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td>
              <a href="comment_view.php?front=<?php echo $id-1; ?>">&lt;&lt;前一评论</a> </td>
            <td width="20">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>第<?php echo $id; ?>条评论
              <div align="left">
			    </div></td>
            <td>&nbsp;</td>
          </tr>
        </table>
		
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td>   <?php  comment_reply_mode($row->content,$row->user_type,$row->person,$row->face,$row->post_ip,$row->post_time,""); ?></td>
            <td width="20">&nbsp;</td>
          </tr>
        </table>
        <table width="100%" height="10"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td></td>
          </tr>
        </table>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td><form name="form1" method="post" action="" onSubmit="return chk_if_blank();">
              <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFF8F5"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>回复此评论&gt;&gt; </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#FFF8F5"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td> <div align="center">称呼</div></td>
                      <td><input name="person" type="text" id="person" style="width:100px" value="<?=$_SESSION['writer_name']==""?"匿名的主人":$_SESSION['writer_name']?>"></td>
                    </tr>
                    <tr>
                      <td valign="top"><div align="center">内容</div></td>
                      <td><font color=blue>
                        <textarea name="content" rows="5" id="textarea4" style="width:600px"></textarea>
                      </font></td>
                    </tr>
                    <tr>
                      <td valign="top">表情</td>
                      <td><table cellspacing=1 cellpadding=3 width=450 border=0>
                        <tbody>
                          <tr>
                            <td><input type=radio checked value=1 name=face>
                                <img 
                        src="../image/face/1.gif"> </td>
                            <td><input type=radio value=2 name=face>
                                <img 
                        src="../image/face/2.gif"> </td>
                            <td><input type=radio value=3 name=face>
                                <img 
                        src="../image/face/3.gif"> </td>
                            <td><input type=radio value=4 name=face>
                                <img 
                        src="../image/face/4.gif"> </td>
                            <td><input type=radio value=5 name=face>
                                <img 
                        src="../image/face/5.gif"> </td>
                            <td><input type=radio value=6 name=face>
                                <img 
                        src="../image/face/6.gif"> </td>
                            <td><input type=radio value=7 name=face>
                                <img 
                        src="../image/face/7.gif"> </td>
                            <td><input type=radio value=8 name=face>
                                <img 
                        src="../image/face/8.gif"> </td>
                          </tr>
                          <tr>
                            <td><input type=radio value=9 name=face>
                                <img 
                        src="../image/face/9.gif"> </td>
                            <td><input type=radio value=10 name=face>
                                <img 
                        src="../image/face/10.gif"> </td>
                            <td><input type=radio value=11 name=face>
                                <img 
                        src="../image/face/11.gif"> </td>
                            <td><input type=radio value=12 name=face>
                                <img 
                        src="../image/face/12.gif"> </td>
                            <td><input type=radio value=13 name=face>
                                <img 
                        src="../image/face/13.gif"> </td>
                            <td><input type=radio value=14 name=face>
                                <img 
                        src="../image/face/14.gif"> </td>
                            <td><input type=radio value=15 name=face>
                                <img 
                        src="../image/face/15.gif"> </td>
                            <td><input type=radio value=16 name=face>
                                <img 
                        src="../image/face/16.gif"> </td>
                          </tr>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td><div align="center">选项</div></td>
                      <td><select name="comment_or_not" id="select2">
                          <option value="1" selected>允许回复</option>
                          <option value="0">禁止回复</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                        <input type="hidden" name="id" value="<?=$id?>">
                      </div></td>
                      <td><input name="reply" type="submit" class="inputbut" id="reply" value="提 交"> <input name="close" type="button" class="inputbut" value="关 闭" onclick="window.close();"></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            </form></td>
            <td width="20">&nbsp;</td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20">&nbsp;</td>
            <td><a href="comment_view.php?next=<?php echo $id+1;?>">下一评论&gt;&gt;</a> </td>
            <td width="20">&nbsp;</td>
          </tr>
        </table>
    <?php } ?>    </td>
  </tr>
  <tr>
    <td><img src="image/nei3.gif" width="760" height="12"></td>
  </tr>
</table>
<script>
function chk_if_blank() {
  if(document.all.person.value=="") { 
   alert("请输入您的称呼!");
   document.form1.person.focus();
   return false;
  }
  
  if(document.all.content.value=="") { 
   alert("请输入回复内容!");
   document.form1.content.focus();
   return false;
  }
}
</script>
