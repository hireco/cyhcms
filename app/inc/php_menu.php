<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
   require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
   $query="select * from  ".$table_suffix."infor order by top desc, top_time desc";
   $result_col=mysql_query($query);
   $query="select * from  ".$table_suffix."infor_class where 1=1";
   $result_mod=mysql_query($query);
   
   echo "<SCRIPT src=\"inc/dirtree.js\" 
                  type=text/javascript></SCRIPT>

                  <SCRIPT type=text/javascript> <!-- 
function dtree(){x = new dTree('x');
x.add(0,-1,'首页','./','','_self');
x.add(1100,0,'图文频道','tuwen.php','','_self');
x.add(1104,1100,'更多图文','tuwen_list.php','','_self');
x.add(1101,0,'本站周报','kanwu_list.php','','_self');
x.add(1102,0,'日历表','calendar.php','','_self');
x.add(1103,0,'用户中心','member.php','','_self');
x.add(1105,0,'问答系统','ask/','','_self');
x.add(1106,0,'考试系统','exam/','','_self');
x.add(1104,0,'博客系统','member_list.php','','_self');";
while($rows=mysql_fetch_object($result_mod)){ 
 $upper_id[$rows->class_name]=$rows->id;
 echo "x.add('100{$rows->id}','0','{$rows->chinese_name}','');";
 } 
while($row=mysql_fetch_object($result_col)) {
if($row->upper_class_id==0)  $upper_class_id="100".$upper_id[$row->infor_class]; else $upper_class_id=$row->upper_class_id;
echo "x.add('{$row->id}','{$upper_class_id}','{$row->class_name}','{$row->infor_class}.php?class_id={$row->id}');"; 
}
echo "document.write(x); } 
 //--></SCRIPT>

                  <SCRIPT>dtree();</SCRIPT>
";
?>