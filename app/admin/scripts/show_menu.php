<?php 
require_once(dirname(__FILE__)."/constant.php");

$string_rep = "<script>\n function ShowMenu(obj,aid,atitle){ \n var eobj,popupoptions  \n popupoptions = [\n"; 
$conArray = &$show_attribute;
foreach ( $conArray as $con_name => $value ) {
$$con_name = $value  ;
$string_rep=$string_rep." new ContextItem(\"{$$con_name}\",function(){ changeArc('show_attribute',{$con_name},aid); }),\n";
}
$string_rep=$string_rep." new ContextSeperator()\n";
$string_rep=$string_rep. "]\n  ContextMenu.display(popupoptions)\n }\n </script>";

echo $string_rep;
?>
