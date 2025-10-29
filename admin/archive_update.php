<?php
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
$echo_str="对不起,操作未完成！";

if(isset($_REQUEST['infor_class'])) { 
 $query="select table_name from ".$table_suffix."infor_class where class_name='{$_REQUEST['infor_class']}'";
 $result=mysql_query($query); 
 if($row=mysql_fetch_object($result)) { 
    $table_name=$row->table_name;
	if($_REQUEST['action']=="delete") { 
	  if(isset($_POST['confirm_sub'])) {
	  
	  //这种连接删除的方法在有些情况,例如文章没有缩略图,文章就不能删除,建议不要使用!
	  //if($table_name=="album") 	  
	  //$result=mysql_query("delete ".$table_suffix."album .*,  ".$table_suffix."picture .*,  ".$table_suffix."picture_msg .*  from  ".$table_suffix."album left join ".$table_suffix."picture on ".$table_suffix."album.id =".$table_suffix."picture.object_id  
	  //left join ".$table_suffix."picture_msg on ".$table_suffix."picture.id =".$table_suffix."picture_msg.pic_id 
	  //where (".$table_suffix."picture .object_class='album' or  ".$table_suffix."picture .object_class='album_list') and ".$table_suffix."album .id in ({$_REQUEST['article_id']})");
      
	  ///else $result=mysql_query("delete ".$table_suffix."{$table_name} .*,  ".$table_suffix."picture .*  from  ".$table_suffix."{$table_name} left join ".$table_suffix."picture on ".$table_suffix."{$table_name}.id =".$table_suffix."picture.object_id  
	  //where ".$table_suffix."picture .object_class='{$table_name}' and ".$table_suffix."{$table_name} .id in ({$_REQUEST['article_id']})");
      
	  $result=mysql_query("delete from ".$table_suffix."{$table_name} where id in ({$_REQUEST['article_id']})");
	  if($result) $result=mysql_query("delete from ".$table_suffix."picture where object_id in ({$_REQUEST['article_id']}) and object_class='$table_name'");
	  if($result) $result=mysql_query("delete from ".$table_suffix."picture_msg where object_id in ({$_REQUEST['article_id']}) and object_class='$table_name'");
	  if($table_name=="album") {   
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture where object_id in ({$_REQUEST['article_id']}) and object_class='album_list'");
	   if($result) $result=mysql_query("delete from ".$table_suffix."picture_msg where object_id in ({$_REQUEST['article_id']}) and object_class='album_list'");
	  }
	  
	  //删除索引信息
	  if($result)  $result=mysql_query("delete from ".$table_suffix."infor_index  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	  
	  if($result) $echo_str="已经成功的删除文档!"; 
	   }
	  else {
	  $cf_str="<strong><font color=blue>确认后下列编号的文档将被删除:</font><font color=red>{$_REQUEST['article_id']}</font></strong>";
	  ConfMsg($cf_str);
	  exit();
	   }
	 }//删除文章
    
	else if($_REQUEST['action']=="move")  {
	  if(isset($_POST['confirm_sub'])) { 
	  $query="update ".$table_suffix.$table_name." set class_id={$_POST['class_reset']}  where id in ({$_REQUEST['article_id']})"; 
	  $result=mysql_query($query);
	  //修改索引信息
	  if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set class_id={$_POST['class_reset']} where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	 
	  if($result) $echo_str="已经成功的移动文档!"; 
	   }
	  else {
	   $cf_str="<strong><font color=blue>将被移动的文档的编号为</font><font color=red>{$_REQUEST['article_id']}</font></strong><br><br>
	           请选择目的文章栏目&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"class_reset\">";
       $query="select * from ".$table_suffix."infor where infor_class='{$_REQUEST['infor_class']}'";
	   $result=mysql_query($query);
	   while($rows=mysql_fetch_object($result)) {
	   if($rows->id==$_REQUEST['class_id'])
	   $cf_str=$cf_str."<option value=\"{$rows->id}\" selected>{$rows->class_name}</option>";
	   else $cf_str=$cf_str."<option value=\"{$rows->id}\">{$rows->class_name}</option>";
	   }
	   $cf_str=$cf_str."</select>";
	   ConfMsg($cf_str);
	   exit();		
	    } 
	  }//移动文章
    
	else if(isset($_REQUEST['action_detail'])) {
		$query="update ".$table_suffix.$table_name." set {$_REQUEST['action']} = {$_REQUEST['action_detail']}  where id in ({$_REQUEST['article_id']})";
	    $result=mysql_query($query);	
		//修改索引信息
	    if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set {$_REQUEST['action']} = {$_REQUEST['action_detail']} where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	    
		$action_time=date("y-m-d H:i:s");  $column_name=$_REQUEST['action']."_time";
		$row=mysql_fetch_array(mysql_query("describe ".$table_suffix.$table_name."  {$column_name}"));
		if($row[0])	{ 
		 $result=mysql_query("update ".$table_suffix.$table_name." set {$column_name} = '{$action_time}'  where id in ({$_REQUEST['article_id']})");		
	     if($result) $result=mysql_query("update ".$table_suffix."infor_index set {$column_name} = '{$action_time}'  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");		
	     }
		if($result) { 
		//$echo_str="已经成功的更新文档!";  
		echo "<script>parent.location.reload();</script>";
		echo "<script>window.close();</script>";
		exit(); 
		}
	  }//设置置顶时间期限,显示属性等等.
	 
	else { 
	  $query="update ".$table_suffix.$table_name." set {$_REQUEST['action']} = IFNULL({$_REQUEST['action']}=0,0 )  where id in ({$_REQUEST['article_id']})";
	  $result=mysql_query($query);
	  //修改索引信息
	  if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set {$_REQUEST['action']} = IFNULL({$_REQUEST['action']}=0,0 ) where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	  
	  $action_time=date("y-m-d H:i:s");  $column_name=$_REQUEST['action']."_time";
		$row=mysql_fetch_array(mysql_query("describe ".$table_suffix.$table_name."  {$column_name}"));
		if($row[0])	{ 
		 $result=mysql_query("update ".$table_suffix.$table_name." set {$column_name} = '{$action_time}'  where id in ({$_REQUEST['article_id']})");		
	     if($result) $result=mysql_query("update ".$table_suffix."infor_index set {$column_name} = '{$action_time}'  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");		
	     }
		 
      if($result) { 
	  $echo_str="已经成功的更新文档!";  
	  /* echo "<script>parent.location.reload();</script>";
	  echo "<script>window.close();</script>";
	  exit();
	  */ 
	    }
	  }//其他不需要会话的操作
	
	 if($result) 	MsgClose($echo_str.",点击下面的按钮,关闭并刷新主窗口!");
	 else 	 ShowMsg($echo_str,"-1");
	 //执行操作及结果
	}
  else {
    ShowMsg("错误的文档属性！","-1");
    exit();
    }//没有查询到	 
 }
else { 
  ShowMsg("请选择文档属性！","-1");
  exit();
 }//错误的访问
?>
