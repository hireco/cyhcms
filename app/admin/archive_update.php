<?php
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
$echo_str="�Բ���,����δ��ɣ�";

if(isset($_REQUEST['infor_class'])) { 
 $query="select table_name from ".$table_suffix."infor_class where class_name='{$_REQUEST['infor_class']}'";
 $result=mysql_query($query); 
 if($row=mysql_fetch_object($result)) { 
    $table_name=$row->table_name;
	if($_REQUEST['action']=="delete") { 
	  if(isset($_POST['confirm_sub'])) {
	  
	  //��������ɾ���ķ�������Щ���,��������û������ͼ,���¾Ͳ���ɾ��,���鲻Ҫʹ��!
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
	  
	  //ɾ��������Ϣ
	  if($result)  $result=mysql_query("delete from ".$table_suffix."infor_index  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	  
	  if($result) $echo_str="�Ѿ��ɹ���ɾ���ĵ�!"; 
	   }
	  else {
	  $cf_str="<strong><font color=blue>ȷ�Ϻ����б�ŵ��ĵ�����ɾ��:</font><font color=red>{$_REQUEST['article_id']}</font></strong>";
	  ConfMsg($cf_str);
	  exit();
	   }
	 }//ɾ������
    
	else if($_REQUEST['action']=="move")  {
	  if(isset($_POST['confirm_sub'])) { 
	  $query="update ".$table_suffix.$table_name." set class_id={$_POST['class_reset']}  where id in ({$_REQUEST['article_id']})"; 
	  $result=mysql_query($query);
	  //�޸�������Ϣ
	  if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set class_id={$_POST['class_reset']} where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	 
	  if($result) $echo_str="�Ѿ��ɹ����ƶ��ĵ�!"; 
	   }
	  else {
	   $cf_str="<strong><font color=blue>�����ƶ����ĵ��ı��Ϊ</font><font color=red>{$_REQUEST['article_id']}</font></strong><br><br>
	           ��ѡ��Ŀ��������Ŀ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"class_reset\">";
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
	  }//�ƶ�����
    
	else if(isset($_REQUEST['action_detail'])) {
		$query="update ".$table_suffix.$table_name." set {$_REQUEST['action']} = {$_REQUEST['action_detail']}  where id in ({$_REQUEST['article_id']})";
	    $result=mysql_query($query);	
		//�޸�������Ϣ
	    if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set {$_REQUEST['action']} = {$_REQUEST['action_detail']} where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	    
		$action_time=date("y-m-d H:i:s");  $column_name=$_REQUEST['action']."_time";
		$row=mysql_fetch_array(mysql_query("describe ".$table_suffix.$table_name."  {$column_name}"));
		if($row[0])	{ 
		 $result=mysql_query("update ".$table_suffix.$table_name." set {$column_name} = '{$action_time}'  where id in ({$_REQUEST['article_id']})");		
	     if($result) $result=mysql_query("update ".$table_suffix."infor_index set {$column_name} = '{$action_time}'  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");		
	     }
		if($result) { 
		//$echo_str="�Ѿ��ɹ��ĸ����ĵ�!";  
		echo "<script>parent.location.reload();</script>";
		echo "<script>window.close();</script>";
		exit(); 
		}
	  }//�����ö�ʱ������,��ʾ���Եȵ�.
	 
	else { 
	  $query="update ".$table_suffix.$table_name." set {$_REQUEST['action']} = IFNULL({$_REQUEST['action']}=0,0 )  where id in ({$_REQUEST['article_id']})";
	  $result=mysql_query($query);
	  //�޸�������Ϣ
	  if($result)  $result=mysql_query("update ".$table_suffix."infor_index  set {$_REQUEST['action']} = IFNULL({$_REQUEST['action']}=0,0 ) where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");
	  
	  $action_time=date("y-m-d H:i:s");  $column_name=$_REQUEST['action']."_time";
		$row=mysql_fetch_array(mysql_query("describe ".$table_suffix.$table_name."  {$column_name}"));
		if($row[0])	{ 
		 $result=mysql_query("update ".$table_suffix.$table_name." set {$column_name} = '{$action_time}'  where id in ({$_REQUEST['article_id']})");		
	     if($result) $result=mysql_query("update ".$table_suffix."infor_index set {$column_name} = '{$action_time}'  where infor_class='$table_name' and infor_id  in ({$_REQUEST['article_id']})");		
	     }
		 
      if($result) { 
	  $echo_str="�Ѿ��ɹ��ĸ����ĵ�!";  
	  /* echo "<script>parent.location.reload();</script>";
	  echo "<script>window.close();</script>";
	  exit();
	  */ 
	    }
	  }//��������Ҫ�Ự�Ĳ���
	
	 if($result) 	MsgClose($echo_str.",�������İ�ť,�رղ�ˢ��������!");
	 else 	 ShowMsg($echo_str,"-1");
	 //ִ�в��������
	}
  else {
    ShowMsg("������ĵ����ԣ�","-1");
    exit();
    }//û�в�ѯ��	 
 }
else { 
  ShowMsg("��ѡ���ĵ����ԣ�","-1");
  exit();
 }//����ķ���
?>
