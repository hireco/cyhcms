<?php session_start();
require_once("setting.php");
require_once(dirname(__FILE__)."/inc.php");
require_once(dirname(__FILE__)."/function/inc_function.php");

  if(isset($_POST['submit_kanwu'])) {
    $string1=explode(",",trim($_POST['similar_id1'])); $string1=$string1[0];
	$string2=explode(",",trim($_POST['similar_id2'])); $string2=$string2[0];
	$string3=explode(",",trim($_POST['similar_id3'])); $string3=$string3[0];
	$string4=explode(",",trim($_POST['similar_id4'])); $string4=$string4[0];
	for($i=1;$i<=4;$i++) {
	$temp="string".$i;
	if($$temp<>"") $string[$i]=$$temp;
	 }
	$string=implode(",",$string);
	
	$title1=explode(",",trim($_POST['title1'])); $title1=$title1[0];
	$title2=explode(",",trim($_POST['title2'])); $title2=$title2[0];
	$title3=explode(",",trim($_POST['title3'])); $title3=$title3[0];
	$title4=explode(",",trim($_POST['title4'])); $title4=$title4[0];
	for($i=1;$i<=4;$i++) {
	$temp="title".$i;
	if($$temp<>"") $title[$i]=$$temp;
	 }
	$title=implode(",",$title);
	
	$more=trim($_POST['similar_id']); //更多的期刊设置
	$kanwu=trim($_POST['kanwu']); //刊物名称
	
	if($_POST['select_this']) $default_set=$_POST['class_id']; else $default_set="";
	
	$input_string="<?php \n\$kanwu=\"$kanwu\";\n\$string=\"$string\";\n\$more=\"$more\";\n\$default_set=\"$default_set\";\n\$title=\"$title\";\n ?>";
	
	$filename="../inc/kanwu_set.php";
    $fp=fopen($filename,"w");
    $result=fwrite($fp,$input_string);
    fclose($fp);
	if($result)  {ShowMsg("成功完成设置",-1); exit;} 
	else  {ShowMsg("设置没有完成",-1); exit;} 
  }
 if(is_file("../inc/kanwu_set.php")) require_once("../inc/kanwu_set.php");
 $string=explode(",",$string); $title=explode(",",$title);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script language="javascript">
var popUpWin=0;
function popUpWindow(basename){   
    var infor_class,class_name,infor;
	infor="ftp,";
	if(document.all.class_id.value=="") { infor_class=infor.split(","); class_name=""; }
	else { infor_class=document.all.class_id.value.split(","); class_name=document.all.class_name.value; }
	URLStr=basename+"&infor_class="+infor_class[0]+"&class_id="+infor_class[1]+"&class_name="+class_name;
	window.open(URLStr, 'popUpWin', 'scrollbars=yes,resizable=yes,statebar=yes');
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td><img src="../image/body_title_left.gif" width="3" height="27"></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">刊物管理</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><form name="form1" id="form1" method="post" action="">
      <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td colspan="2">注意：此项功能为设置最新的站刊，例如周报，月报等，设置后将在首页刊物处显示，请尽量选择资料下载类的栏目</td>
          </tr>
        <tr>
          <td>刊物名称：</td>
          <td><input name="kanwu" type="text" id="kanwu" size="30" value="<?=$kanwu?>"/></td>
        </tr>
        <tr>
          <td width="100">选择分类：</td>
          <td><select name="class_id" id="class_id" onclick="set_value();">
			 <option value="">不限类别</option>
			 <?php 
			 $query="select * from ".$table_suffix."infor order by  IFNULL(infor_class='ftp',0 ) desc";
			 $result=mysql_query($query);
			 while($rows=mysql_fetch_object($result)) {
			  ?>
			  <option value="<?=$rows->infor_class.",".$rows->id?>"  <?php if($rows->infor_class.",".$rows->id==$default_set)  echo "selected";?>>
			  <?=$rows->class_name?>
			  </option>
			  <?php } ?>
            </select>		  
            <input name="class_name" type="hidden" id="class_name" /> 
            <input name="select_this" type="checkbox" id="select_this" value="1" <?php if($default_set<>"") echo "checked=\"checked\""; ?>/>
            此为默认自动显示，下面的设置将优先！</td>
          </tr>
        <tr>
          <td rowspan="4" align="center" valign="top"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>首页４个</td>
            </tr>
            <tr>
              <td>相关文章</td>
            </tr>
          </table>            <p>&nbsp;</p>
            </td>
          <td width="700"><input name="similar_id1" id="similar_id1" style="width:100px" value="<?=$string[0]?>">
              <input name="select_article" type="button" id="select_article" value="选择" 
								  onclick="popUpWindow('select_list.php?return_form=similar_id1')" />
              标题：
            <input name="title1" type="text" id="title1" style="width:200px" value="<?=$title[0]?>"/>
            　注：每个空只能填一个，下同</td>
          </tr>
        <tr>
          <td><input name="similar_id2" id="similar_id2" style="width:100px" value="<?=$string[1]?>" />
            <input name="select_article2" type="button" id="select_article2" value="选择" 
								  onclick="popUpWindow('select_list.php?return_form=similar_id2')" />
            标题：
            <input name="title2" type="text" id="title2" style="width:200px" value="<?=$title[1]?>"/>
　多填将自动截去</td>
          </tr>
        <tr>
          <td><input name="similar_id3" id="similar_id3" style="width:100px" value="<?=$string[2]?>" />
            <input name="select_article3" type="button" id="select_article3" value="选择" 
								  onclick="popUpWindow('select_list.php?return_form=similar_id3')" />
            标题：
            <input name="title3" type="text" id="title3" style="width:200px" value="<?=$title[2]?>"/></td>
          </tr>
        <tr>
          <td><input name="similar_id4" id="similar_id4" style="width:100px" value="<?=$string[3]?>" />
            <input name="select_article4" type="button" id="select_article4" value="选择" 
								  onclick="popUpWindow('select_list.php?return_form=similar_id4')" />
            标题：
            <input name="title4" type="text" id="title4" style="width:200px" value="<?=$title[3]?>"/></td>
          </tr>
        <tr>
          <td valign="top">更多设置</td>
          <td><textarea name="similar_id" rows="6" id="similar_id" style="width:600px"><?=$more?></textarea>
            <input name="select_article42" type="button" id="select_article42" value="选择" 
								  onclick="popUpWindow('select_list.php?return_form=similar_id')" /></td>
          </tr>
        <tr>
          <td>提交设置</td>
          <td><input name="submit_kanwu" type="submit" class="inputbut" id="submit_kanwu" value="提 交" />
            <input name="cancel" type="button" class="inputbut" id="cancel" value="不理返回" onclick="history.go(-1);"/></td>
          </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
function set_value() {
  document.form1.class_name.value=document.all.class_id.children[document.all.class_id.selectedIndex].text; 
   }
</script>
