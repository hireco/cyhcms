<?php  
if(isset($_SESSION['user_name'])) {
echo "<SCRIPT src=\"inc/dirtree.js\" 
                  type=text/javascript></SCRIPT>

                  <SCRIPT type=text/javascript> <!-- 
function dtree(){x = new dTree('x');
x.add(0,-1,'�û�����','member.php','','_self');
x.add('13','0','�û�����'); 
x.add('15','0','���ݹ���'); 
x.add('8','15','Ͷ������'); 
x.add('9','15','��������'); 
x.add('17','8','���¹���','tougao_admin.php?infor_class=article'); 
x.add('16','8','���·���');
x.add('6','8','ͼ������','tougao_admin.php?infor_class=album'); 
x.add('7','8','ͼ������'); ";

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

echo "x.add('20','9','��־����','blog_admin.php?blog_class=rizhi'); 
x.add('21','9','��־���','blog.php?action=add&blog_class=rizhi'); 
x.add('18','9','������','blog_admin.php?blog_class=album');
x.add('22','9','������','blog.php?action=add&blog_class=album');  
x.add('19','0','�ղؼй���','collection_admin.php'); 
x.add('4','0','���Թ���','guestbook_admin.php?list_for=get');
x.add('26','0','ϵͳ��Ϣ','inner_infor_admin.php');
x.add('25','0','��Ա��ϵ','guy_admin.php?list_for=friend');
x.add('23','0','��������','blog_cfg.php'); 
x.add('24','0','������ҳ','user_infor.php?idkey=".md5($_SESSION['user_name'])."&host_id=".$_SESSION['user_id']."');  
x.add('14','0','�˳���¼','logout.php?to_go=".urlencode("./")."'); 
x.add('1','13','�޸�����','amend.php'); 
x.add('2','13','���ҽ���','amend_introduction.php'); 
x.add('10','13','������Ƭ','amend_photo.php'); 
x.add('5','13','�޸�����','amend_pass.php'); 
document.write(x); } 
 //--></SCRIPT>
<SCRIPT>dtree();</SCRIPT>";
  }
  else echo "<div align=center>���ȵ�¼</div>";
?>