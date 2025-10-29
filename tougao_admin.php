<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
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
    if(isset($_SESSION['user_name'])) { 
    if(!isset($_REQUEST['infor_class']))  $_REQUEST['infor_class']="article"; 
    elseif(empty($user_submit_type[$_REQUEST['infor_class']])) { unset($_REQUEST['infor_class']);  ShowMsg("文档类型不存在!",-1);   exit; }
	if(isset($_REQUEST['infor_class'])) {
	
	if($_REQUEST['action']=="delete") {
    $result=mysql_query("select * from   ".$table_suffix.$_REQUEST['infor_class']."  where id={$_REQUEST['article_id']} and poster='{$_SESSION['user_name']}'");
	$row=mysql_fetch_object($result);
	if(!$row) {ShowMsg("不存在该删除对象",-1); exit;} else if($row->locked=="1") { ShowMsg("Sorry,删除对象被管理员锁定",-1); exit;}
	else  { 
	
	//这种连接删除的方法在有些情况,例如文章没有缩略图,文章就不能删除,建议不要使用!
	//if($_REQUEST['infor_class']=="album") 
	//$result=mysql_query("delete ".$table_suffix."album .*,  ".$table_suffix."picture .*,  ".$table_suffix."picture_msg .*  from  ".$table_suffix."album left join ".$table_suffix."picture on ".$table_suffix."album.id =".$table_suffix."picture.object_id  
	// left join ".$table_suffix."picture_msg on ".$table_suffix."picture.id =".$table_suffix."picture_msg.pic_id 
	//where (".$table_suffix."picture .object_class='album' or  ".$table_suffix."picture .object_class='album_list') and ".$table_suffix."album .id={$_REQUEST['article_id']} and ".$table_suffix."album .poster='{$_SESSION['user_name']}' and ".$table_suffix."album .locked='0'");
    
	//else $result=mysql_query("delete ".$table_suffix."{$_REQUEST['infor_class']} .*,  ".$table_suffix."picture .*  from  ".$table_suffix."{$_REQUEST['infor_class']} left join ".$table_suffix."picture on ".$table_suffix."{$_REQUEST['infor_class']}.id =".$table_suffix."picture.object_id  
	//where ".$table_suffix."picture .object_class='{$_REQUEST['infor_class']}' and ".$table_suffix."{$_REQUEST['infor_class']} .id={$_REQUEST['article_id']} and ".$table_suffix."{$_REQUEST['infor_class']} .poster='{$_SESSION['user_name']}' and ".$table_suffix."{$_REQUEST['infor_class']} .locked='0'");
    
	$result=mysql_query("delete from ".$table_suffix."{$_REQUEST['infor_class']} where id ={$_REQUEST['article_id']} and  poster='{$_SESSION['user_name']}' and locked='0'");
	if($result) $result=mysql_query("delete from ".$table_suffix."picture where object_id ={$_REQUEST['article_id']} and object_class='{$_REQUEST['infor_class']}'");
	if($result) $result=mysql_query("delete from ".$table_suffix."picture_msg where object_id ={$_REQUEST['article_id']} and object_class='{$_REQUEST['infor_class']}'");
	if($_REQUEST['infor_class']=="album") {   
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture where object_id ={$_REQUEST['article_id']} and object_class='album_list'");
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture_msg where object_id ={$_REQUEST['article_id']} and object_class='album_list'");
	 }
	
	if($result) $result=mysql_query("delete from ".$table_suffix."infor_index  where infor_class='{$_REQUEST['infor_class']}' and infor_id={$_REQUEST['article_id']}");
	if($result) {
	echo "<script>parent.location.reload()</script>";
	exit;
	   }
	 }
   }
?>
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
                <TD>用户功能菜单</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
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
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 投稿 &gt; <?php echo $_REQUEST['infor_class']=="article"?"<a href=\"?infor_class=article\">文章</a>":"<a href=\"?infor_class=album\">图集</a>"; if(isset($_REQUEST['class_name'])) echo " > ".$_REQUEST['class_name']; ?></TD>
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
      <tr>
        <td bgcolor="#D0D2E3">
          <table  border="0" cellspacing="0" cellpadding="5">
            <tr bgcolor="#D0D2E3">
              <td height="5" colspan="3"></td>
            </tr>
            <tr>
              <td width="20" bgcolor="#D0D2E3">&nbsp;</td>
			  <?php 
			  echo "<td"; 
			  if(!isset($_REQUEST['class_id'])) echo " bgcolor=\"#FFFFFF\">所有文章</td>";  
			  else echo "><a href=\"tougao_admin.php?infor_class={$_REQUEST['infor_class']}\" style=\"text-decoration:underline \" >所有文章</a></td>";
			  $result_row=mysql_query("select * from ".$table_suffix."infor where post_type<='{$_SESSION['user_level']}' and infor_class='{$_REQUEST['infor_class']}' order by top desc,top_time desc");
			  while($class_row=@mysql_fetch_object($result_row)){  
			  echo "<td";
			  if($class_row->id==$_REQUEST['class_id']) echo " bgcolor=\"#FFFFFF\">".$class_row->class_name."</td>";  
			  else echo "><div align=\"center\"><a href=\"?infor_class={$_REQUEST['infor_class']}&class_id=".$class_row->id."&class_name=".urlencode($class_row->class_name)."\" style=\"text-decoration:underline \" >".$class_row->class_name."</a></div></td>";              
               } ?>
			</tr>
        </table></td>
      </tr>
      <tr>
        <td height="400" valign="top" bgcolor="#FFFFFF">
		<?php  
          if(isset($_REQUEST['class_id'])) $condition="class_id={$_REQUEST['class_id']}"; else $condition="1=1";
		  $query="select * from ".$table_suffix."{$_REQUEST['infor_class']}  where ".$condition." and poster='{$_SESSION['user_name']}' order by post_time desc";
          $page_id=isset($_REQUEST['page_id'])?$_REQUEST['page_id']:1;
	      $per_page_num=20;
          $rows=@mysql_query($query); 
		  $num=@mysql_num_rows($rows);
		  $page=intval(($num-1)/$per_page_num)+1;
	      if($page_id<=1) $page_id=1; if($page_id>=$page) $page_id=$page; 
	      $page_front=($page_id<=1)?1:($page_id-1); 
	      $page_behind=($page_id>=$page)?$page:($page_id+1); 
	      @mysql_data_seek($rows, ($page_id-1)*$per_page_num);
   ?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10">&nbsp;</td>
                <td>文章标题</td>
                <td>发布时间</td>
                <td>所属栏目</td>
                <td>审查状态</td>
                <td> 编 辑</td>
				<td> <div align="center">删 除</div></td>
              </tr>
              <?php  
                for($i=1;$i<=$per_page_num;$i++)
		         { if($row=@mysql_fetch_object($rows)){ 
                 $class_row=@mysql_fetch_object(mysql_query("select * from ".$table_suffix."infor where id='{$row->class_id}'"));
                 $class_name=$class_row->class_name;
              ?>
              <tr>
                <td>&nbsp;</td>
                <td><a href="<?=$_REQUEST['infor_class']?>_view.php?id=<?=$row->id?>&class_id=<?=$row->class_id?>&class_name=<?=urlencode($class_name)?>" style="text-decoration:underline ">
                  <?=$row->article_title?>
                </a>
				</td>
                <td class="fonts"><?=substr($row->post_time,3,11)?></td>
                <td><a href="<?=$_REQUEST['infor_class']?>.php?class_id=<?=$row->class_id?>" target="_blank">
                  <?=$class_name?>
                </a></td>
                <td><?=$row->checked=="0"?"<font color=red>未审查</font>":"<font color=green>已审查</font>"?></td>
                <td><?php if(!$row->locked) { ?><a href="<?=$_REQUEST['infor_class']?>_add.php?action=amend&article_id=<?=$row->id?>&class_id=<?=$class_row->id?>" target="_self">编 辑</a><?php } else echo "禁 止"; ?></td>
                <td><div align="center">
                  <?php 
				    echo "<input type=button class=\"INPUT\"";					
					echo " onClick=\"";
					if($row->checked=="1")  echo " if(really()) "; 
					else  echo " if(really2()) ";
					echo " no_show('?article_id=".$row->id."&action=delete&infor_class=".$_REQUEST['infor_class']."');\" target=\"_self\"";
				    if($row->locked) echo " value=\"禁止\"  disabled"; else echo " value=\"删除\"";
					echo ">";  ?>
                </div></td>
			  </tr>
              <?php } 
			     }
			  ?>
            </table>
        </td>
      </tr>
    </table>
	<TABLE height=43 cellSpacing=0 cellPadding=4 width="100%" align=center border=0>
      <TBODY>
        <TR>
          <TD class=pagesinfo width=300>&nbsp;</TD>
          <TD class=pages align=right><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center">
                    <?php  require_once("inc/page_divide.php");?>
                </div></td>
              </tr>
          </table></TD>
        </TR>
      </TBODY>
    </TABLE>	</td>
  </tr>
</table>
                  </TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php"); ?>
<div id="bodyframe" style="VISIBILITY: hidden">
<IFRAME frameBorder=1 id=heads src="" name=hide_frame style="HEIGHT: 20px; LEFT: 20px; POSITION: absolute; TOP: 20px; WIDTH: 20px"></IFRAME>
</div>
<?php 
  }
} else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"]));
?>
</body>
</html>
<script>
function no_show(url){ 
 window.open(url,"hide_frame","height=1,width=1,resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no");
}
function really() {
      result="对象已经通过审查,继续吗？";   
       if   (confirm(result))    return true; 
       else return false;
 }
function really2() {
      result="该对象还未审查,将被删除,继续吗？";   
       if   (confirm(result))    return true; 
       else return false;
 }
</script>
