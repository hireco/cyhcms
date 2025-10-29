<?php 
function get_sub_class($class_id) { ?>
<table border="0" cellspacing="0" cellpadding="5">
   <?php 
   global $table_suffix;
   $query="select * from ".$table_suffix."infor where upper_class_id=$class_id order by top desc";
   $result=mysql_query($query);
   $flag=0; 
   while($row=mysql_fetch_object($result)) {
   ?>   
   <tr>
   <td width="30"></td>
   <td><a href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" style="text-decoration:underline;"><?=$row->class_name?></a></td>
    <?php if($row=mysql_fetch_object($result)) { ?>
     <td><a href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" style="text-decoration:underline;"><?=$row->class_name?></a></td>
    <?php } if($row=mysql_fetch_object($result)) { ?>
	 <td><a href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" style="text-decoration:underline;"><?=$row->class_name?></a></td>
	<?php } if($row=mysql_fetch_object($result)) { ?>
	 <td><a href="<?=$row->infor_class?>.php?class_id=<?=$row->id?>" style="text-decoration:underline;"><?=$row->class_name?></a></td>
	<?php } ?>
   </tr>
   <?php 
   $flag=1;
   }
   ?>
</table>   
<?php 
   return $flag;
 }
?>