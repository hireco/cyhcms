<?php 
function  random_string(){
 $chr_all=""; 
 for($i=0;$i<=4;$i++)
 { $flag=rand(0,1); if($flag==1)  $chr[$i]=rand(97,122); 
   else  $chr[$i]=rand(48,57); 
   $chr[$i]=chr($chr[$i]);
   $chr_all=$chr_all.$chr[$i].",";
 }
   return $chr_all;
}

?>