<?php session_start();
require_once("setting.php");
require_once("inc.php");
require_once("../config/auto_set.php");
require_once(dirname(__FILE__)."/scripts/constant.php");
$infor_class=$_REQUEST['infor_class'];
if(empty($infor_class)) { echo "<script>alert(\"��ѡ����Ŀ����!\"); history.go(-1);</script>"; exit; } 
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/picture_check.js" type="text/javascript"></script>
<script language="javascript" src="js/admin.js" type="text/javascript"></script>
<script>
function expand(x,y) {
	if (x.style.display=='block') {
		x.style.display='none';
		y.style.display='block';
		}
	else
		{
		y.style.display='none';
		x.style.display='block';
		}   
	if(document.all.select_pic.style.display=='block')  SeePic(document.picview,document.form1.picture_select);
	else  SeePic(document.picview,document.form1.picture_input);
	 }
function SeePic(img,f)
{
   if ( f.value != "" ) { img.src = f.value; }
}
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
	window.open(URLStr, 'popUpWin', 'scrollbars=yes,resizable=yes,statebar=yes,width='+width+',height='+(screen.height-100)+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</SCRIPT>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
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
                  <div align="center"><?=$_REQUEST['chinese_name']?></div>
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

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="form1" method="post" action="infor_add_submit.php" enctype="multipart/form-data">
                <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                  <tr bgcolor="#F4D8AC">
                    <td colspan="2"><table border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="10">&nbsp;</td>
                        <td>Ƶ������&gt;&gt;<a href="infor.php?infor_class=<?=$_REQUEST['infor_class']?>"><?=$_REQUEST['chinese_name']?></a>&gt;&gt;���Ӷ�����Ŀ</td>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td width="100">��Ŀ���ƣ�                      </td>
                    <td nowrap><input name="class_name" type="text" id="class_name">
                      <input name="infor_class" type="hidden" value="<?=$infor_class?>">
                      ѡ��ģ��
                      <select name="template" id="template">
                        <?php 
						  $result=mysql_query("select template_list from ".$table_suffix."infor_class  where class_name='{$_REQUEST['infor_class']}'");
						  $template_list=mysql_result($result,0,"template_list");
						  $template_list=explode(",",$template_list);
						  for($i=0;$i<count($template_list); $i++) 
						 echo "<option value=\"".$template_list[$i]."\">".$template_list[$i]."</option>";
                        ?>
					  </select>
					  </td>
                    </tr>
                  <tr>
                    <td valign="top">��Ŀ������                      </td>
                    <td valign="top"><textarea name="introduction" cols="50" rows="5" id="introduction"></textarea></td>
                    </tr>
                  <tr>
                    <td valign="top">�ؼ��ֱ� </td>
                    <td><textarea name="keywords" cols="50" rows="4" id="keywords"></textarea></td>
                  </tr>
                  <tr>
                    <td>��Ŀ���ԣ�</td>
                    <td><select name="class_attribute" id="class_attribute">
                      <?php    
									    $conArray = &$class_attribute;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="3") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                    </select></td>
                    </tr>
                  <tr>
                    <td>����Ȩ�ޣ�</td>
                    <td><select name="hide_type" id="hide_type">
                      <?php    
									    $conArray = &$hide_type;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="0") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td>����Ȩ�ޣ�</td>
                    <td><select name="post_type" id="post_type">
                       <?php    
									    $conArray = &$post_type;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value  ;
										echo "<option value='{$con_name}'"; 
										if($con_name=="4") echo " selected";
										echo ">{$$con_name}</option>";
										}
	                                ?>
                                                                                                    </select></td>
                  </tr>
                  <tr>
                    <td>��Ŀ�ö���</td>
                    <td><select name="top" id="top">
                      <option value="1" selected>�ö�</option>
                      <option value="0">���ö�</option>
                    </select>
                    �ö����
                    <input name="top_input" type="text" id="top_input" size="5">
                    *��д0,1,2������,������Ĭ��Ϊǰ��ѡȡֵ</td>
                    </tr>
                  <tr>
                    <td>����������</td>
                    <td><select name="top_navi" id="top_navi">
                      <option value="1" selected>��ʾ</option>
                      <option value="0">����ʾ</option>
                                                            </select></td>
                    </tr>
                  <tr>
                    <td>��ർ����</td>
                    <td><select name="left_navi" id="left_navi">
                      <option value="1" selected>��ʾ</option>
                      <option value="0">����ʾ</option>
                    </select></td>
                    </tr>
                  <tr>
                    <td>��ҳ��Ŀ��</td>
                    <td><select name="index_block" id="index_block">
                      <option value="1">��ʾ</option>
                      <option value="0" selected>����ʾ</option>
                                        </select></td>
                  </tr>
                  <tr>
                    <td rowspan="2" valign="top">��ĿͼƬ��</td>
                    <td>
                      <select onChange="expand(document.all.select_pic, document.all.input_pic); " name="select_or_input">
                        <option value="input" selected>�ϴ��µ�ͼƬ</option>
                        <option value="select">ѡ������ͼƬ</option>
                      </select></td>
                    </tr>
                  <tr>
                    <td>
					<div style="DISPLAY:none;" id="select_pic">
					<table width="100%"  border="0" cellspacing="0" cellpadding="2">                     
                      <tr>
                        <td valign="top"><strong>
                          <input name="click_for_select" type="button" id="click_for_select" onClick="popUpWindow('../file_do/list_pic4class.php?imgstick=mysql&f=form1.picture_select&v=picview&l=form1.picture_link_select&t=form1.picture_title_select', 50, 0,800,300)" value="ѡ��ͼƬ������">
                        </strong></td>
                      </tr>
                      <tr>
                        <td valign="top">ͼƬ��ַ��
                          <input name="picture_select" type="text" id="picture_select" size="50"></td>
                      </tr>
                      <tr>
                        <td valign="top">ͼƬ���⣺
                          <input name="picture_title_select" type="text" id="picture_title_select" size="50"></td>
                      </tr>
                      <tr>
                        <td valign="top" nowrap>ͼƬ���ӣ�
                          <input name="picture_link_select" type="text" id="picture_link_select" size="50"></td>
                      </tr>
                    </table>
					</div>
					<div style="DISPLAY:block;" id="input_pic">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td valign="top">ѡ���ļ���
                            <input name="picture_input" type="file" size="50" onChange="c(this); SeePic(document.picview,document.form1.picture_input);"></td>
                        </tr>
                        <tr>
                          <td valign="top">�趨���⣺
                              <input name="picture_title_input" type="text" size="50"></td>
                        </tr>
                        <tr>
                          <td valign="top" nowrap>�趨���᣺
                              <input name="picture_link_input" type="text"  size="50">
                              </td>
                        </tr>
                      </table>
					  
					  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>ͼƬ����
                            ԭͼ��ˮӡ 
                             <select name="water" id="select">
                               <option value="0" selected>����</option>
                               <option value="1">��</option>
                             </select>
ͼƬ����                             
<input name='resize' type='checkbox' style="clear:all" value='1' checked>
                             <select name="picture_alt" id="picture_alt" onChange="input_wh();">
                              <?php    
									    $conArray = &$picture_alt;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value;
										$option_i=explode(":",$$con_name);
										echo "<option value='{$con_name}'"; 
										if($con_name==0) echo "selected";
										echo ">{$option_i[0]}</option>";
										}
	                                ?>
                              </select>
                             ��<input type='text' style='width:30' name='iwidth' value='<?php echo $cfg_colsimg_width?>'>
                             ��<input type='text' style='width:30' name='iheight' value='<?php echo $cfg_colsimg_height?>'>
							<script>
							 function input_wh() {
							     var picture_w=new Array(); 
							     var picture_h=new Array(); 
							   <?php    
									    $conArray = &$picture_alt;
										$i_select=0;
									    foreach ( $conArray as $con_name => $value ) {
	                                    $$con_name = $value;
										$option_i=explode(":",$$con_name);
										$option_i=explode(",",$option_i[1]);
										echo "picture_w[$i_select]=\"{$$option_i[0]}\"; ";
										echo "picture_h[$i_select]=\"{$$option_i[1]}\";\n";
										$i_select++;
										}
	                            ?>
							   var_i=document.all.picture_alt.value;
							   document.all.iwidth.value=picture_w[var_i];
							   document.all.iheight.value=picture_h[var_i];
							 }
							</script>
							</td>
                          </tr>
                      </table>
					</div>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="150" valign="top">ͼƬԤ����</td>
                          <td><table border="0" align="left" cellpadding="10" cellspacing="0" bgcolor="#E6E6E6">
                              <tr>
                                <td align="center" valign="middle"><div align="center"><img onload="reload_pic('picview');" src="image/picview.jpg" name="picview" id="picview"></div></td>
                              </tr>
                          </table></td>
                        </tr>
                      </table>				  
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><table width="300" border="0" cellspacing="0" cellpadding="10">
                            <tr align="center">
                              <td><input name="submit_class" type="submit" id="submit_class" value="�� ��"></td>
                              <td><input name="reset" type="reset" id="reset" value="�� ��"></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                </table>
              </form></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
    </td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>
<script>
if(document.all.select_or_input.value=="select") 
		  { document.all.select_pic.style.display="block"; document.all.input_pic.style.display="none"; }
		  else  { document.all.select_pic.style.display="none"; document.all.input_pic.style.display="block"; }
</script>
