<?php 
require_once(dirname(__FILE__)."/../inc.php");
$string_rep = "<script>\n function ClassMenu(obj,aid,atitle){ \n var eobj,popupoptions  \n popupoptions = [\n"; 
$result=mysql_query("select * from ".$table_suffix."infor where infor_class='{$_REQUEST['infor_class']}'");
while($rows_class=mysql_fetch_object($result)) {
$con_name=$rows_class->id;
$$con_name=$rows_class->class_name;
$string_rep=$string_rep." new ContextItem(\"{$$con_name}\",function(){ changeArc('class_id',{$con_name},aid); }),\n";
}
$string_rep=$string_rep." new ContextSeperator()\n";
$string_rep=$string_rep. "]\n  ContextMenu.display(popupoptions)\n }\n </script>";

echo $string_rep;
?>
