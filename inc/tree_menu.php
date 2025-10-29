<?php  
if(isset($_SESSION['user_name'])) {
echo "<SCRIPT src=\"inc/dirtree.js\" 
                  type=text/javascript></SCRIPT>

                  <SCRIPT type=text/javascript> <!-- 
function dtree(){x = new dTree('x');
x.add(0,-1,'用户功能','member.php','','_self');
x.add('13','0','用户设置'); 
x.add('15','0','内容管理'); 
x.add('8','15','投稿内容'); 
x.add('9','15','博客内容'); 
x.add('17','8','文章管理','tougao_admin.php?infor_class=article'); 
x.add('16','8','文章发布');
x.add('6','8','图集管理','tougao_admin.php?infor_class=album'); 
x.add('7','8','图集发布'); ";

$result_row=mysql_query("select * from ".$table_suffix."infor where post_type<='{$_SESSION['user_level']}' and ( infor_class='article' or infor_class='album' ) order by top desc,top_time desc");
while($class_row=@mysql_fetch_object($result_row)){
 $class_name=$class_row->class_name;
 $class_id=26+$class_row->id;
 if($class_row->infor_class=="article") 
 { $upper_id=16; 
   echo "x.add('$class_id','$upper_id','$class_name','article_add.php?class_id={$class_row->id}'); ";
 } else {
   $upper_id=7;
   echo "x.add('$class_id','$upper_id','$class_name','album_add.php?class_id={$class_row->id}'); ";
 }
}

echo "x.add('20','9','日志管理','blog_admin.php?blog_class=rizhi'); 
x.add('21','9','日志添加','blog.php?action=add&blog_class=rizhi'); 
x.add('18','9','相册管理','blog_admin.php?blog_class=album');
x.add('22','9','相册添加','blog.php?action=add&blog_class=album');  
x.add('19','0','收藏夹管理','collection_admin.php'); 
x.add('4','0','留言管理','guestbook_admin.php?list_for=get');
x.add('26','0','系统消息','inner_infor_admin.php');
x.add('25','0','人员关系','guy_admin.php?list_for=friend');
x.add('23','0','博客设置','blog_cfg.php'); 
x.add('24','0','博客主页','user_infor.php?idkey=".md5($_SESSION['user_name'])."&host_id=".$_SESSION['user_id']."');  
x.add('14','0','退出登录','logout.php?to_go=".urlencode("./")."'); 
x.add('1','13','修改资料','amend.php'); 
x.add('2','13','自我介绍','amend_introduction.php'); 
x.add('10','13','个人照片','amend_photo.php'); 
x.add('5','13','修改密码','amend_pass.php'); 
document.write(x); } 
 //--></SCRIPT>
<SCRIPT>dtree();</SCRIPT>";
  }
  else echo "<div align=center>请先登录</div>";
?>