<?php error_reporting(0); ?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/rand_string.php");
?><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
.button{color:#333333;font-size:12px;border:1px outset}
-->
</style>
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form">
      <table border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php $result_string=random_string(); session_register("result_string"); $_SESSION['result_string']=$result_string;
					 $input_chr=explode(",",$result_string); 
					 $_SESSION['input_string']=""; for($i=0;$i<=4;$i++) $_SESSION['input_string']=$_SESSION['input_string'].$input_chr[$i];
					 echo"<img src=\"".RROOT."/code_check/check_code.php\" align=\"absmiddle\" border=1 width=\"70\" height=\"25\">";
		      ?>
              <input type="hidden" name="check_code_hide" value="<?php echo md5($_SESSION['input_string']); ?>">
              <input name="check_code" type="text" id="check_code24" size="10" maxlength="10">
		      <input class=button type="submit" name="submit_ifr" value="看不清?" onclick="javascript: parent.code_check.location.reload();">
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>