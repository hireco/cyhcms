<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
</head>
<body>
<?php  require_once("center_header.php"); 
        if(isset($_SESSION['user_name'])) { ?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width=181 height=186 valign="top" background=image/leftbg.gif><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>�û����ܲ˵�</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <? require_once("inc/tree_menu.php");?>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF">
		  <TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>�����ڵ�λ��:<a href="./"> ��ҳ</a> &gt; <a href="member.php">�û�����</a> &gt; ���Բ鿴</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#D0D2E3">
  <tr>
    <td valign="top" bgcolor="#FFFFFF">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
     <tr><td bgcolor="#D0D2E3"><table border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td height="5"></td>
       </tr>
       <tr>
         <td><table border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="10">&nbsp;</td>
             <td><table border="0" cellpadding="5" cellspacing="0" <?php if($_REQUEST['list_for']=="get") echo "bgcolor=\"#FFFFFF\""; ?>>
               <tr>
                 <td><div align="center"><?php echo "<a href=\"guestbook_admin.php?list_for=get\">�յ�������</a>" ?></div></td>
               </tr>
             </table></td>
             <td width="20">&nbsp;</td>
             <td><table border="0" cellpadding="5" cellspacing="0" <?php if($_REQUEST['list_for']=="sent") echo "bgcolor=\"#FFFFFF\""; ?>>
               <tr>
                 <td><div align="center"><?php echo "<a href=\"guestbook_admin.php?list_for=sent\">����������</a>" ?></div></td>
               </tr>
             </table></td>
           </tr>
         </table></td>
       </tr>
     </table></td>
	    </tr>
      <tr>
        <td height="400" valign="top" bgcolor="#FFFFFF">
    <?php if($_REQUEST['list_for']=="get") { 
		   $query="select * from ".$table_suffix."member_guestbook where to_user_name='{$_SESSION['user_name']}' and id={$_REQUEST['infor_id']}";
		   $result=mysql_query($query);
		   if($row=mysql_fetch_object($result)){ 
		   mysql_query("update ".$table_suffix."member_guestbook set checked='1' where to_user_name='{$_SESSION['user_name']}' and id={$_REQUEST['infor_id']}");
		   $infor_title=$row->infor_title==""?"������":$row->infor_title;
		   $content=ereg_replace("//f:"," <img align=absmiddle src=".$cfg_mainsite."blog_inc/face/",$row->content);
           $content=ereg_replace("//f",".gif> ",$content);
		   $query="select * from  ".$table_suffix."member where user_name='{$row->from_user_name}'";
		   $result_person=mysql_query($query);
		   $row_person=mysql_fetch_object($result_person);
		   $md5_idkey=md5($row_person->user_name);
		   $img_default="image/".$row_person->sex.".jpg";
		   $sample_pic=$row_person->pic_checked=='1'?(empty($row_person->sample_pic)?$img_default:$row_person->sample_pic):$img_default;
		?>
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><strong>�Ķ��ʼ�</strong></td>
                <td><div align="right"> ����ʱ�䣺20<?=$row->post_time?> </div></td>
              </tr>
            </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td>�����ˣ�<a href="user_infor.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" target="_blank" style="text-decoration:underline "><?=$row->person?></a></td>
                  <td><div align="right"> <a href="blog_inc/add_friend.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��Ϊ����</a> <a href="user_infor.php?view=liuyan&host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��TA����</a> <a href="user_infor.php?view=zhitiao&host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��ֽ��</a> <a href="blog_inc/add_blacklist.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��ֹ������</a></div></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="100" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td><table  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                          <tr>
                            <td bgcolor="#FEFEFE"><div align="center"><a href="user_infor.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" target="_blank"><img src="<?=$sample_pic?>"  alt="<?=$row->person?>" border="0"></a></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                  <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>���⣺<strong><?=$infor_title?></strong></td>
                    </tr>
                  </table>
                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td height="150" valign="top"><?=$content?></td>
                      </tr>
                    </table>
                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><div align="right">
						<?php 
						$query_after="select id from ".$table_suffix."member_guestbook where to_user_name='{$_SESSION['user_name']}' and id>{$_REQUEST['infor_id']} limit 0, 1";
		                $result_after=mysql_query($query_after);
						$query_before="select id from ".$table_suffix."member_guestbook where to_user_name='{$_SESSION['user_name']}' and id<{$_REQUEST['infor_id']} limit 0, 1";
		                $result_before=mysql_query($query_before);
						if($row_before=mysql_fetch_object($result_before)){
						?>
						<a href="?infor_id=<?=$row_before->id?>&list_for=<?=$_REQUEST['list_for']?>" target="_self" style="text-decoration:underline ">��һ��</a> 
						<?php } 
						if($row_after=mysql_fetch_object($result_after)){
						?>
						<a href="?infor_id=<?=$row_after->id?>&list_for=<?=$_REQUEST['list_for']?>" target="_self" style="text-decoration:underline ">��һ��</a> </div></td>
                        <?php } ?>
					  </tr>
                    </table></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><form name="form1" method="post" action="blog_inc/reply_liuyan.php">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td bgcolor="#EAEBF2"><strong>�ظ�������</strong></td>
                      </tr>
                      <tr>
                        <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                          <tr>
                            <td width="60">��������</td>
                            <td><input name="infor_title" type="text" class="INPUT" id="infor_title" style="width:200px;" value="Re:<?=$infor_title?>">
                              <input name="infor_id" type="hidden" id="infor_id" value="<?=$_REQUEST['infor_id']?>">
                              <input name="whisper" type="hidden" id="whisper" value="<?=$row->whisper?>"></td>
                          </tr>
                          <tr>
                            <td valign="top">��������</td>
                            <td><textarea name="content" rows="8" class="TEXTAREA" id="content" style="width:90%;"></textarea></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><table  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input name="reply_liuyan" type="submit" class="button" id="reply_liuyan" value="��  ��"></td>
                                <td width="30">&nbsp;</td>
                                <td><input name="Submit2" type="button" class="button" value="��  ��" onclick="history.go(-1);"></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                  </form></td>
                </tr>
              </table></td>
          </tr>
        </table>
		<?php 
		    } else ShowMsg("��Ҫ�鿴�Ķ��󲻴���!",-1);
		  } 
		  elseif($_REQUEST['list_for']=="sent") { 
		  $query="select * from ".$table_suffix."member_guestbook where from_user_name='{$_SESSION['user_name']}' and id={$_REQUEST['infor_id']}";
		  $result=mysql_query($query);
		  if($row=mysql_fetch_object($result)){ 
		  $infor_title=$row->infor_title==""?"������":$row->infor_title;
		  $content=ereg_replace("//f:"," <img align=absmiddle src=".$cfg_mainsite."blog_inc/face/",$row->content);
          $content=ereg_replace("//f",".gif> ",$content);
		  $query="select * from  ".$table_suffix."member where user_name='{$row->to_user_name}'";
		  $result_person=mysql_query($query);
		  $row_person=mysql_fetch_object($result_person);
		  $md5_idkey=md5($row_person->user_name);
		  $img_default="image/".$row_person->sex.".jpg";
		  $sample_pic=$row_person->pic_checked=='1'?(empty($row_person->sample_pic)?$img_default:$row_person->sample_pic):$img_default;
		?>
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><strong>�Ķ��ʼ�</strong></td>
                <td><div align="right"> ����ʱ�䣺20<?=$row->post_time?>
                </div></td>
              </tr>
            </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td>�����ˣ�<a href="user_infor.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" target="_blank" style="text-decoration:underline "><?=$row->person?></a></td>
                  <td><div align="right"><a href="blog_inc/add_friend.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��Ϊ����</a> <a href="user_infor.php?view=liuyan&host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��TA����</a> <a href="user_infor.php?view=zhitiao&host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��ֽ��</a> <a href="blog_inc/add_blacklist.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" style="text-decoration:underline ">��ֹ������</a> </div></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="100" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><table  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                              <td bgcolor="#FEFEFE"><div align="center"><a href="user_infor.php?host_id=<?=$row_person->id?>&idkey=<?=$md5_idkey?>" target="_blank"><img src="<?=$sample_pic?>"  alt="<?=$row->person?>" border="0"></a></div></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                  <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td>���⣺<strong><?=$infor_title?></strong></td>
                      </tr>
                    </table>
                      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td height="150" valign="top"><?=$content?></td>
                        </tr>
                    </table>
                      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td><div align="right">
                        <?php 
						$query_after="select id from ".$table_suffix."member_guestbook where from_user_name='{$_SESSION['user_name']}' and id>{$_REQUEST['infor_id']} limit 0, 1";
		                $result_after=mysql_query($query_after);
						$query_before="select id from ".$table_suffix."member_guestbook where from_user_name='{$_SESSION['user_name']}' and id<{$_REQUEST['infor_id']} limit 0, 1";
		                $result_before=mysql_query($query_before);
						if($row_before=mysql_fetch_object($result_before)){
						?>
                        <a href="?infor_id=<?=$row_before->id?>&list_for=<?=$_REQUEST['list_for']?>" target="_self" style="text-decoration:underline ">��һ��</a>
                        <?php } 
						if($row_after=mysql_fetch_object($result_after)){
						?>
                        <a href="?infor_id=<?=$row_after->id?>&list_for=<?=$_REQUEST['list_for']?>" target="_self" style="text-decoration:underline ">��һ��</a> </div></td>
                        <?php } ?>
                        </tr>
                      </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
		<?php 
		     } else ShowMsg("��Ҫ�鿴�Ķ��󲻴���!",-1);
		  } else ShowMsg("����ķ���",-1); ?>
		</td>
      </tr>
    </table>
	</td>
  </tr>
</table></TD></TR>
              </TBODY>
          </TABLE>
		  </td>
        </tr>
      </table>
      <?php   require_once("footer.php");
 } else ShowMsg("���ʵ�Ȩ�޲������߷��ʳ���","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
</body>
</html>
<script>
function no_show(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
function really() {
      result="��ȷ��Ҫɾ����";   
       if   (confirm(result))    return true; 
       else return false;
 }
 </script>
