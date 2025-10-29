<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php require_once(dirname(__FILE__)."/constant.php"); ?>
<table  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form2" method="post" action="">
      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <?php if(DISPLAY_WHAT=="all") { ?>
		  <td><div align="right">
            <?php $query="select * from ".$table_suffix."infor where infor_class='{$_REQUEST['infor_class']}'";
			       $result=mysql_query($query); 
				   if(mysql_num_rows($result)) {
				   ?>
			选择栏目:
                <select name="class_id" onChange="decide_class();">
				  <option value="" <?php if(""==$_REQUEST['class_id']) echo "selected"; ?>>不限栏目</option>
				  <?php 
				   while($rows=mysql_fetch_object($result)) {
				   ?>
				   <option value="<?=$rows->id?>" <?php if($rows->id==$_REQUEST['class_id']) echo "selected"; ?>><?=$rows->class_name?></option>
				  <?php } ?>
				</select>
                <input type="hidden" name="class_name" value="<?=$_REQUEST['class_name']?>">
			<?php } ?>
            </div></td>
			<?php } ?>
          <td><div align="center">
            搜索关键字:
                <input name="keywords" type="text" value="<?=$_REQUEST['keywords']?>" size="30">
                
            </div></td>
          <td><div align="center">
            排序方式: <select name="list_turn" id="list_turn">
                <?php    
									    $conArray = &$list_turns ;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$$con_name}'"; 
										if($$con_name==$_REQUEST['list_turn']) echo " selected";
										echo ">{$con_name}</option>";
										}
	                                ?>
									</select>
          </div></td>
          <td>页显示数:
            <select name="per_page_num" id="per_page_num">
			 <?php    
									    $conArray = &$per_page;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name==$_REQUEST['per_page_num']) echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
              </select></td>
          <td><div align="left">
            <input type="submit" name="Submit" class="inputbut" value="搜  索"  onFocus="return xmethod();">
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<script>
function decide_class(){
document.form2.class_name.value=document.form2.class_id.children[document.form2.class_id.selectedIndex].text;  
return true;
}
function xmethod(){
document.form2.method="post";
}
</script>