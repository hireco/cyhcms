<?php session_start(); ?>
<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("config/auto_set.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php"); 
       require_once("inc/find_cookie.php");
	   
   if(!isset($_REQUEST['view'])) $_REQUEST['view']="index";
   elseif(empty($_REQUEST['view']))  $_REQUEST['view']="index";
   
   if((!isset($_REQUEST['infor_id']))&&(!isset($_REQUEST['host_id']))) {ShowMsg("对不起,错误的访问",-1); exit;}
   
   if(isset($_REQUEST['infor_id'])) {
    if(empty($_REQUEST['infor_id'])) {ShowMsg("对不起,错误的访问",-1); exit;}
	if($_REQUEST['view']=="album"||$_REQUEST['view']=="rizhi")
	$query="select user_name from ".$table_suffix."member_blog  where id={$_REQUEST['infor_id']}";
	$host_name=mysql_result(mysql_query($query),0,"user_name"); 
	$query="select nick_name,id from ".$table_suffix."member  where user_name='$host_name'";
	$host_id=mysql_result(mysql_query($query),0,"id");
	$host_nick=mysql_result(mysql_query($query),0,"nick_name");
	if(!$host_id)  {ShowMsg("对不起,错误的访问",-1); exit;}
   }
   elseif(isset($_REQUEST['host_id'])) {
    if(empty($_REQUEST['host_id'])) {ShowMsg("对不起,错误的访问",-1); exit;}
	$query="select * from ".$table_suffix."member  where id={$_REQUEST['host_id']}";
	$host_name=mysql_result(mysql_query($query),0,"user_name"); 
	$host_nick=mysql_result(mysql_query($query),0,"nick_name");
	if(!$host_name)  {ShowMsg("对不起,错误的访问",-1); exit;}
	$host_id=$_REQUEST['host_id']; 
   }
   
   if(!isset($_REQUEST['idkey'])) {ShowMsg("对不起,错误的访问",-1); exit;}
   if(empty($_REQUEST['idkey']))  {ShowMsg("对不起,错误的访问",-1); exit;}
   
   if(md5($host_name)<>$_REQUEST['idkey'])  {ShowMsg("对不起,错误的访问",-1); exit;}
   
   $visited_one="visited_".$_SESSION['user_id']."_".$host_id;
   $nowtime=date("y-m-d H:i:s");
   if((isset($_SESSION['user_name']))&&(!isset($_SESSION[$visited_one]))&&($_SESSION['user_name']<>$host_name)) 
   { 
      mysql_query("delete from ".$table_suffix."visitor_list where visitor_id='{$_SESSION['user_id']}' and  visited_id='$host_id'");
      mysql_query("insert into ".$table_suffix."visitor_list (visitor_id,visited_id,visit_time) values ('{$_SESSION['user_id']}','$host_id','$nowtime')");    
      $_SESSION[$visited_one]=1;
   }
   //最新的访问记录
   
 //以下为设置博客的背景等项目
   $blog_title=$host_nick."的空间";
   $blog_title_color="#000000";
   $body_bg_type="c";
   $body_bg="#483D8B";
   $core_bg_type="c";
   $core_bg="#DCDCDC";
   $head_bg_type="c";
   $head_bg="";
   $body_width="800";
   $head_height="150";
   $banner="";    //image/top.png
   //默认值
   
   $query="select * from ".$table_suffix."blog_cfg  where user_name='$host_name'";
   $result_query=mysql_query($query);
   if($row=mysql_fetch_object($result_query)) { 
   $blog_title=$row->blog_title; 
   $blog_title_color=$row->blog_title_color==""?$blog_title_color:$row->blog_title_color;
   $body_bg_type=$row->body_bg_type==""?$body_bg_type:$row->body_bg_type;
   $body_bg=$row->body_bg==""?$body_bg:$row->body_bg;
   $core_bg_type=$row->core_bg_type==""?$core_bg_type:$row->core_bg_type;
   $core_bg=$row->core_bg==""?$core_bg:$row->core_bg;
   $head_bg_type=$row->head_bg_type==""?$head_bg_type:$row->head_bg_type;
   $head_bg=$row->head_bg==""?$head_bg:$row->head_bg;
   $body_width=$row->body_width==""?$body_width:$row->body_width;
   $head_height=$row->head_height==""?$head_height:$row->head_height;
   $banner=$row->banner==""?$banner:$row->banner;
   
 }  
  //用户设置值
   echo "\n<style type=\"text/css\">\n<!--\n body { \n";   
   if($body_bg_type=="c") echo "background-color: ".$body_bg.";\n";
   else echo "background-image: url(".$body_bg.");\n";
   echo "}\n -->\n</style>\n";
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $cfg_index_title;if($blog_title) echo "博客:".$blog_title;?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/blog.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
<SCRIPT type=text/javascript>
function fontZoom(size)
{
   document.getElementById('con').style.fontSize=size+'px';
}
</SCRIPT>
<script language="javascript" src="inc/resizeimg.js" type="text/javascript"></script>
</head>
<body onLoad="resizeImages(<?=$body_width?>);">
<?php  require_once("blog_inc/header.php"); ?>
<table width="<?=$body_width?>" border="0" align="center" cellpadding="0" cellspacing="0" <?php if($core_bg_type=="c") echo "bgcolor"; else echo "background"; echo "=\"".$core_bg."\""; ?>>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="6" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" height="29" border="0" cellpadding="0" cellspacing="0" background="image/menu.png">
          <tr background="image/menu.png">
            <td width="80" valign="bottom" >
			<?php if($_REQUEST['view']=="index") {?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#CCCCCC">
                  <td height="1" colspan="3"></td>
                </tr>
                <tr>
                  <td width="1" bgcolor="#CCCCCC"></td>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center">首　页</div></td>
                    </tr>
                  </table></td>
                  <td width="1" bgcolor="#CCCCCC"></td>
                </tr>
            </table>
			<?php } else { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center"><a href="user_infor.php?host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">首　页</a></div></td>
                    </tr>
                </table></td>
                <td width="3" valign="middle"><?php if($_REQUEST['view']<>"album") {?><img src="image/menu_jg.jpg" width="3" height="25"><?php } ?></td>
              </tr>
              <tr>
                <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
              </tr>
            </table>
			<?php } ?>
			</td>
            <td width="80" valign="bottom"><?php if($_REQUEST['view']=="album") {?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#CCCCCC">
                  <td height="1" colspan="3"></td>
                </tr>
                <tr>
                  <td width="1" bgcolor="#CCCCCC"></td>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center">相　册</div></td>
                      </tr>
                  </table></td>
                  <td width="1" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } else { ?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center"><a href="user_infor.php?view=album&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">相　册</a></div></td>
                      </tr>
                  </table></td>
                  <td width="3" valign="middle"><?php if($_REQUEST['view']<>"rizhi") { ?><img src="image/menu_jg.jpg" width="3" height="25"><?php } ?></td>
                </tr>
                <tr>
                  <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } ?></td>
            <td width="80" valign="bottom"><?php if($_REQUEST['view']=="rizhi") {?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#CCCCCC">
                  <td height="1" colspan="3"></td>
                </tr>
                <tr>
                  <td width="1" bgcolor="#CCCCCC"></td>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center">日　志</div></td>
                      </tr>
                  </table></td>
                  <td width="1" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } else { ?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center"><a href="user_infor.php?view=rizhi&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">日　志</a></div></td>
                      </tr>
                  </table></td>
                  <td width="3" valign="middle"><?php if($_REQUEST['view']<>"url") {?><img src="image/menu_jg.jpg" width="3" height="25"><?php } ?></td>
                </tr>
                <tr>
                  <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } ?></td>
            <td width="80" valign="bottom"><?php if($_REQUEST['view']=="url") {?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#CCCCCC">
                  <td height="1" colspan="3"></td>
                </tr>
                <tr>
                  <td width="1" bgcolor="#CCCCCC"></td>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center">收　藏</div></td>
                      </tr>
                  </table></td>
                  <td width="1" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } else { ?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><div align="center"><a href="user_infor.php?view=url&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">收　藏</a></div></td>
                      </tr>
                  </table></td>
                  <td width="3" valign="middle"><img src="image/menu_jg.jpg" width="3" height="25"></td>
                </tr>
                <tr>
                  <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
                </tr>
              </table>
              <?php } ?></td>
            <?php if($_SESSION['user_name']==$host_name) { ?>
			<td width="80" valign="bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center"><a href="member.php">管　理</a></div></td>
                    </tr>
                </table></td>
                <td width="3" valign="middle"><img src="image/menu_jg.jpg" width="3" height="25"></td>
              </tr>
              <tr>
                <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
              </tr>
            </table></td>
			<td width="80" valign="bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center"><a href="logout.php?to_go=<?php 
					  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	                  else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>">注　销</a></div></td>
                    </tr>
                </table></td>
                <td width="3" valign="middle"><img src="image/menu_jg.jpg" width="3" height="25"></td>
              </tr>
              <tr>
                <td height="1" colspan="2" bgcolor="#CCCCCC"></td>
              </tr>
            </table></td>
			<?php }  ?>			
            <td valign="bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="form1" method="post"   style="margin-top:0px; margin-bottom:0px;">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td>
                        <div align="left"><?php if($_SESSION['user_name']==$host_name) {  ?>
						<marquee onMouseOut=this.start() onMouseOver=this.stop() scrollamount=2 scrolldelay=5 width=150 align="left" >
						<font color=red>欢迎主人的到来</font>
						</marquee>
						<?php } ?>
						</div></td>
                      <td><div align="right">
                      <?php if(isset($_SESSION['user_name'])&&($_SESSION['user_name']<>$host_name)){ ?>
					  <a href="user_infor.php?host_id=<?=$_SESSION['user_id']?>&idkey=<?=md5($_SESSION['user_name'])?>"><img src="image/ico_home.gif" width="16" height="16" border="0" align="absmiddle"> 我的博客</a>
					  <?php } ?>
					        搜索博文
                            <input name="keywords" type="text" class="INPUT" id="keywords" style="width:120px;">
                            <input name="infor_class" type="hidden" id="infor_class" value="b">
                            <input name="Submit2" type="submit" class="INPUT" value="搜索博主" onClick="this.form.action ='user_infor.php?view=search&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>'; if(check_sch_form()) this.form.submit(); else return false;">
                            <input name="Submit" type="submit" class="INPUT" value="搜索全站"  onClick="this.form.action='similar_infor.php'; if(check_sch_form()) this.form.submit(); else return false;">
                      </div></td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table></td>
            </tr>
          </table></td>
      </tr>
    </table>    </td>
  </tr>
</table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="6" bordercolor="#D6EBE4" >
  <tr>
    <td width="181" valign="top"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td bgcolor="#EEF7F3"><strong>博主</strong></td>
            </tr>
            <tr>
              <td height="1" bgcolor="#D5D5D5"></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td><div align="center">
                        <?php  
				 $query="select * from ".$table_suffix."member where user_name='$host_name'"; 
				 $result=mysql_query($query);
				 $row=mysql_fetch_object($result);
				 $friend_list=$row->friend_list;
				 $img_default="image/".$row->sex.".jpg";
				 $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
				 ?>
                        <table  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                          <tr>
                            <td bgcolor="#FEFEFE"><div align="center"><a href="user_infor.php?view=profile&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>"><img src="<?=$sample_pic?>"  alt="了解主人" border="0"  ></a></div></td>
                          </tr>
                        </table>
                        <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                          <tr>
                            <td><div align="center"> <a href="user_infor.php?view=profile&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">
                                <?=$row->nick_name?>
                            </a> </div></td>
                          </tr>
                        </table>
                        <?php if($_SESSION['user_name']==$host_name) {  ?>
                        <table  border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr>
                            <td width="17"><img src="image/leave.gif" width="17" height="15"></td>
                            <td><div align="center">
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td nowrap bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=liuyan&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看留言</a></td>
                                  </tr>
                                </table>
                            </div></td>
                            <td><div align="left">
                              <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=zhitiao&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看纸条</a></td>
                                </tr>
                              </table>
                                </div></td>
                          </tr>
                          <tr>
                            <td><img src="image/firend.gif" width="17" height="14"></td>
                            <td><div align="center">
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=friend&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看好友</a></td>
                                  </tr>
                                </table>
                            </div></td>
                            <td><div align="left">
                              <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=visitor&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看访客</a></td>
                                </tr>
                              </table>
                            </div></td>
                          </tr>
                        </table>
						<?php } else { ?>
						<table  border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr>
                            <td width="17"><img src="image/leave.gif" width="17" height="15"></td>
                            <td><div align="center">
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td nowrap bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=liuyan&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>#say_list">查看留言</a></td>
                                  </tr>
                                </table>
                            </div></td>
                            <td><div align="left">
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=liuyan&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>#say">写留言</a></td>
                                  </tr>
                                </table>
                            </div></td>
                          </tr>
                          <tr>
                            <td><img src="image/firend.gif" width="17" height="14"></td>
                            <td><div align="center">
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=friend&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看好友</a></td>
                                  </tr>
                                </table>
                            </div></td>
                            <td><div align="left">
                                <table  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                  <tr>
                                    <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="blog_inc/add_friend.php?host_id=<?=$row->id?>&idkey=<?=$_REQUEST['idkey']?>">加好友</a></td>
                                  </tr>
                                </table>
                            </div></td>
                          </tr>
                          <tr>
                            <td><div align="center"><img src="image/visited.gif" width="11" height="14"></div></td>
                            <td><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=visitor&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">查看访客</a></td>
                                </tr>
                            </table></td>
                            <td><table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE" style="line-height:100%;"><a href="?view=zhitiao&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" title="悄悄话">发纸条</a></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
						<?php } ?>
                    </div></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
    </table>      
      <table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td></td>
        </tr>
      </table>      <?php require_once("blog_inc/calendar_nav.php");?>      <table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>文章</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td>
                         <?php  
					  $query="select * from  ".$table_suffix."member_blog where user_name='$host_name' order by read_times desc, post_time desc limit 0, 7"; 
					  $result=mysql_query($query);
					  $num=@mysql_num_rows($result);
					  while($row=mysql_fetch_object($result)) { 
					  ?>
					    <table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr>
                           <td style="line-height:140%"><a href="user_infor.php?view=<?=$row->blog_class?>&infor_id=<?=$row->id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><?=$row->infor_title?></a></td>
                           <td style="line-height:140%; color:#CCCCCC;"><div align="right">
                             <?=substr($row->post_time,3,8)?>
                           </div></td>
					    </tr></table> 
					   <?php } 
					 if($num==0) echo "<tr><td>没有文章</td></tr>";?>
					  </td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>      
<table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>分类</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                       <?php  
					  $query="select distinct folder_name, blog_class from  ".$table_suffix."member_blog where user_name='$host_name'  order by post_time"; 
					  $result=mysql_query($query);
					  $num1=@mysql_num_rows($result);
					  while($row=mysql_fetch_object($result)) { 
					  ?>
					    <tr>
                        <td style="line-height:140%">
					    <?=$blog_type[$row->blog_class]?>分类
					    </td>
                           <td style="line-height:140%"><div align="left"><a href="user_infor.php?view=<?=$row->blog_class?>&view_class=<?=urlencode($row->folder_name)?>&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"></a><a href="user_infor.php?view=<?=$row->blog_class?>&view_class=<?=urlencode($row->folder_name)?>&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><font color="#336633">
                             <?=$row->folder_name?>
                           </font></a></div></td>
					    </tr>
					    <?php } // 日志和相册 
					  $query="select distinct folder_name from  ".$table_suffix."member_url where user_name='$host_name'  order by post_time"; 
					  $result=mysql_query($query);
					  $num2=@mysql_num_rows($result);
					  while($row=mysql_fetch_object($result)) { 
					  ?>
					    <tr>
                        <td style="line-height:140%">
					    收藏分类
					    </td>
                           <td style="line-height:140%"><div align="left"><a href="user_infor.php?view=url&view_class=<?=urlencode($row->folder_name)?>&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"></a><a href="user_infor.php?view=url&view_class=<?=urlencode($row->folder_name)?>&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><font color="#336633">
                           </font></a><a href="user_infor.php?view=url&view_class=<?=urlencode($row->folder_name)?>&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>" style="text-decoration:underline"><font color="#336633">
                           <?=$row->folder_name?>
                           </font></a></div></td>
					    </tr>
					    <?php 
					  }// 收藏夹分类 
					  if($num1+$num2==0) echo "<tr><td>没有分类</td></tr>"; ?> 
                     </table></td></tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>      
<table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>相册</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td>
					  <table  border="0" align="left" cellpadding="3" cellspacing="0">
					  <?php 
					   $width=60; 
			           $height=60*$cfg_memsimg_height/$cfg_memsimg_width; 
					   $query="select infor_title, id from ".$table_suffix."member_blog where user_name='$host_name' and blog_class='album' order by last_modify desc limit 0, 6"; 
					   $result=mysql_query($query);
					   $num=mysql_num_rows($result);
					   while($row=mysql_fetch_object($result)) {
					   $infor_title=$row->infor_title;
					   $object_id=$row->id;
					   $query="select * from ".$table_suffix."picture where object_class='member' and object_id=$object_id limit 0, 1"; 
					   $result_pic=mysql_query($query);
					   $row_pic=mysql_fetch_object($result_pic);
					   $pic_url=get_small_img($row_pic->pic_url,$row_pic->small_pic);
					   ?>
                        <tr>
                          <td><table  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
						  <tr>
                            <td bgcolor="#FEFEFE"><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$object_id?>&idkey=<?=$_REQUEST['idkey']?>"><img src="<?=$pic_url?>" alt="<?=$infor_title?>" width="<?=$width?>" height="<?=$height?>" border="0"></a></div></td>
                          </tr>
                        </table>
					     </td>
                          <td>
						  <?php if($row=mysql_fetch_object($result)){
						$infor_title=$row->infor_title;
					    $object_id=$row->id;
					    $query="select * from ".$table_suffix."picture where object_class='member' and object_id=$object_id limit 0, 1"; 
					    $result_pic=mysql_query($query);
					    $row_pic=mysql_fetch_object($result_pic);
					    $pic_url=get_small_img($row_pic->pic_url,$row_pic->small_pic); ?>
						  <table  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
						  <tr>
                            <td bgcolor="#FEFEFE"><div align="center"><a href="user_infor.php?view=album&infor_id=<?=$object_id?>&idkey=<?=$_REQUEST['idkey']?>"><img src="<?=$pic_url?>" alt="<?=$infor_title?>" width="<?=$width?>" height="<?=$height?>" border="0"></a></div></td>
                          </tr>
                        </table>
					    <?php } ?>
					      </td>
                        </tr>
					    <?php 
					   } 
					  if($num==0) echo "<tr><td>没有相册</td></tr>";
					  ?>
				      </table></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>      
<table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>收藏</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                         <?php  
					  $query="select * from  ".$table_suffix."member_url where user_name='$host_name' order by  post_time desc limit 0, 10"; 
					  $result=mysql_query($query);
					  $num=@mysql_num_rows($result);
					  while($row=mysql_fetch_object($result)) { 
					  ?>
					    <tr>
                           <td style="line-height:140%"><a href="<?=$row->content?>" target="_blank" style="text-decoration:underline"><?=$row->infor_title?></a></td>
                           <td style="line-height:140%; color:#CCCCCC;"><div align="right">
                             <?=substr($row->post_time,3,5)?>
                           </div></td>
					    </tr> 
					   <?php } 
					 if($num==0) echo "<tr><td>没有收藏</td></tr>";?> 
                      </table>
                        <?php if($num) { ?>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div align="right"><a href="user_infor.php?view=url&host_id=<?=$host_id?>&idkey=<?=$_REQUEST['idkey']?>">更多收藏</a></div></td>
                          </tr>
                        </table>
				        <?php } ?>
					  </td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>      
<table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>好友</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                          <?php  
					  $width=32; 
					  if($friend_list) { 
					  $friend_list=explode(",",$friend_list); 
					  for($i=0; $i<count($friend_list); $i++) {
					   $query="select * from ".$table_suffix."member  where id={$friend_list[$i]}";
					   $result=mysql_query($query);
					   $row=mysql_fetch_object($result); 
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row->pic_checked=='1'?(empty($row->sample_pic)?$img_default:$row->sample_pic):$img_default;
					  ?>
                          <tr>
                            <td width="34"><table  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=md5($row->user_name)?>" target="_blank" style="text-decoration:underline"><img src="<?=$sample_pic?>" alt="<?=$row->nick_name?>" width="32"  border="0" align="middle"></a></td>
                                </tr>
                            </table></td>
                            <td><a  style="text-decoration:underline; color:#006666" href="user_infor.php?host_id=<?=$friend_list[$i]?>&idkey=<?=md5($row->user_name)?>">
                              <?=$row->nick_name?>
                            </a></td>
                          </tr>
                          <?php } 
					   }
					 else  echo "<tr><td>没有好友</td></tr>";?>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>      
<table width="100%" height="6"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
  </tr>
</table><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FEFEFE"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td bgcolor="#EEF7F3"><strong>访客</strong></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#D5D5D5"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                          <?php  
					   $width=32; 
					   $query="select * from ".$table_suffix."visitor_list  where visited_id=$host_id  group by visitor_id order by visit_time desc limit 0, 10";
					   $result=mysql_query($query);
					   $num=mysql_num_rows($result);
					   while($row=mysql_fetch_object($result)) { 
					   $query="select * from ".$table_suffix."member where id={$row->visitor_id}";
					   $result_visitor=mysql_query($query);
					   $row_visitor=mysql_fetch_object($result_visitor);
					   $img_default="image/memsimg.gif";
				       $sample_pic=$row_visitor->pic_checked=='1'?(empty($row_visitor->sample_pic)?$img_default:$row_visitor->sample_pic):$img_default;
					  ?>
                          <tr>
                            <td width="34" rowspan="2"><table  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td bgcolor="#FEFEFE"><a href="user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=md5($row_visitor->user_name)?>" target="_blank" style="text-decoration:underline"><img src="<?=$sample_pic?>" alt="<?=$row_visitor->nick_name?>" width="32"  border="0" align="middle"></a></td>
                                </tr>
                            </table></td>
                            <td style="line-height:120%;"><a  style="text-decoration:underline; color:#006666" href="user_infor.php?host_id=<?=$row_visitor->id?>&idkey=<?=md5($row_visitor->user_name)?>">
                              <?=$row_visitor->nick_name?>
                            </a></td>
                          </tr>
                          <tr>
                            <td class="fonts" style="line-height:120%;"><?=substr($row->visit_time,3,11)?></td>
                          </tr>
                          <?php } 
					   if(!$num) echo "<tr><td>没有访客</td></tr>";?>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
    <td valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td bgcolor="#FFFFFF">
		  <?php 
		  if($_REQUEST['view']=="index") require_once("blog_inc/index.php"); 
		  elseif($_REQUEST['view']=="calendar") require_once("blog_inc/calendar.php"); 
		  elseif($_REQUEST['view']=="liuyan")   require_once("blog_inc/liuyan_list.php");
		  elseif($_REQUEST['view']=="zhitiao")  require_once("blog_inc/zhitiao_list.php");
		  elseif($_REQUEST['view']=="friend")   require_once("blog_inc/friend_list.php");
		  elseif($_REQUEST['view']=="visitor")   require_once("blog_inc/visitor_list.php");
		  elseif($_REQUEST['view']=="rizhi")    { if(isset($_REQUEST['infor_id'])) require_once("blog_inc/rizhi.php");  else require_once("blog_inc/rizhi_list.php");} 
		  elseif($_REQUEST['view']=="album")    { if(isset($_REQUEST['infor_id'])) require_once("blog_inc/album.php");  else require_once("blog_inc/album_list.php");} 
		  elseif($_REQUEST['view']=="url")      require_once("blog_inc/url_list.php");
		  elseif($_REQUEST['view']=="search")      require_once("blog_inc/search.php");
		  elseif($_REQUEST['view']=="profile")      require_once("blog_inc/profile.php");
		  ?>&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
</table></td>
  </tr>
</table>
<?php   require_once("blog_inc/footer.php"); ?>
</body>
</html>
<script>
function check_sch_form() {
 if(document.form1.keywords.value=="") {
   alert("请填写搜索内容!");
   document.form1.keywords.focus();
   return false;
  }
  return true;
}
</script>