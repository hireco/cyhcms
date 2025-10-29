<?php require_once("dbscripts/db_connect.php"); ?>
<?php require_once("config/base_cfg.php");?>
<?php require_once("inc/hometown.php");?>
<?php require_once("inc/show_msg.php");?>
<?php require_once("inc/main_fun.php"); ?>
<?php require_once($cfg_admin_root."scripts/constant.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/form_check.js"></script>
</head>
<body>
<?php  require_once("center_header.php"); if(isset($_SESSION['user_name'])) { ?>
<table width="<?=$cfg_body_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width=181 height=186 valign="top" background=image/leftbg.gif><TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>用户功能菜单</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      <TABLE height=120 cellSpacing=3 cellPadding=2 width="98%" align=center 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
            <TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <? require_once("inc/tree_menu.php");?>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
          <td width=6  background=image/hline.gif></td>
          <td vAlign=top bgcolor="#FFFFFF"><TABLE height=26 cellSpacing=0 cellPadding=0 width="100%" align=center 
      border=0>
            <TBODY>
              <TR>
                <TD class=nav>您现在的位置:<a href="./"> 首页</a> &gt; <a href="member.php">用户中心</a> &gt; 修改信息</TD>
              </TR>
            </TBODY>
          </TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
                <TR align=middle>
                  <TD vAlign=top height=300>
                   <?php 
				      if(isset($_POST['amend_sub'])) {
					  $email=quan2ban(trim($_POST['email']));
					  $question=trim($_POST['question']);
					  $answer=$question==""?"":trim($_POST['answer']);
					  
					  $district=$_POST['province']."-".$_POST['city']."-".$_POST['district'];
					  $district=$district=="省份,地级市,县、地区"?"":$district;
					  $career=$_POST['career'];
					  $nationality=$_POST['nationality'];
					  $blood=$_POST['blood'];
					  $address=trim($_POST['address']);
					  $telephone=quan2ban(trim($_POST['telephone']));
					  $mobile=quan2ban(trim($_POST['mobile']));
					  $zip_code=quan2ban(trim($_POST['zip_code']));
					  $qq=quan2ban(trim($_POST['qq']));
					  $msn=quan2ban(trim($_POST['msn']));
                      $home_page=quan2ban(trim($_POST['home_page']));
					  $introduction=nl2br(addslashes(strip_tags(trim($_POST['introduction']))));
					  
					  $email_keep=$_POST['email_keep'];
					  $qq_keep=$_POST['qq_keep'];
					  $msn_keep=$_POST['msn_keep'];
					  $mobile_keep=$_POST['mobile_keep'];
					  $address_keep=$_POST['address_keep'];
					  $telephone_keep=$_POST['telephone_keep'];
					  
					  $result=mysql_query("select * from  ".$table_suffix."member where  user_name='{$_SESSION['user_name']}'");
					  $row=mysql_fetch_object($result);
					  
					  $cn_name       = isset($_POST['cn_name'])?trim($_POST['cn_name']):$row->cn_name;
					  $en_name       = isset($_POST['en_name'])?quan2ban(trim($_POST['en_name'])):$row->en_name; 
					  $sex           = isset($_POST['sex'])?($_POST['sex']==""?"m":$_POST['sex']):$row->sex;
					  $identity_type = isset($_POST['identity_type'])?$_POST['identity_type']:$row->identity_type;
					  $identity_no   = isset($_POST['identity_no'])?$_POST['identity_no']:$row->identity_no;
					  $birthday      = isset($_POST['yy'])?($_POST['yy']."-".$_POST['mm']."-".$_POST['dd']):$row->birthday;
					  $state         = isset($_POST['state'])?$_POST['state']:$row->state;
					  $blood         = isset($_POST['blood'])?$_POST['blood']:$row->blood;
					  $nationality   = isset($_POST['nationality'])?$_POST['nationality']:$row->nationality;
					  
					  $nowtime=date("y-m-d H:i:s");
					   
					  $query="update ".$table_suffix."member set email='$email',question='$question',
					   answer='$answer',cn_name='$cn_name',en_name='$en_name',sex='$sex',identity_type='$identity_type',					   			 		                       identity_no='$identity_no',birthday='$birthday',blood='$blood',nationality='$nationality',
					   state='$state',district='$district',career='$career',address='$address',telephone='$telephone',
					   mobile='$mobile',zip_code='$zip_code',qq='$qq',msn='$msn',home_page='$home_page',last_modify='$nowtime', 
					   address_keep='$address_keep',email_keep='$email_keep',qq_keep='$qq_keep',msn_keep='$msn_keep',telephone_keep='$telephone_keep',
					   mobile_keep='$mobile_keep'  where user_name='{$_SESSION['user_name']}'";
					
					  $result=mysql_query($query);
					  if((!empty($introduction))&&$result) { 
					    $result=mysql_query("select * from  ".$table_suffix."member_infor  where user_name='{$_SESSION['user_name']}'");
					    if(mysql_num_rows($result))  $result=mysql_query("update  ".$table_suffix."member_infor  set content = '$introduction', html='0' ,last_modify='$nowtime' where user_name='{$_SESSION['user_name']}'");
					    else  $result=mysql_query("insert into  ".$table_suffix."member_infor  (content,user_name,html,last_modify) values ('$introduction','{$_SESSION['user_name']}','0','$nowtime')");
					   }
					  if($result) ShowMsg("成功更新个人资料","member.php");
					  else  ShowMsg("更新失败,请重来",-1);
					}
					 else 
					 {
					  $query="select * from ".$table_suffix."member  where user_name='{$_SESSION['user_name']}'";
					  $result=mysql_query($query);
					  $query_infor="select * from ".$table_suffix."member_infor  where user_name='{$_SESSION['user_name']}'";
					  $result_infor=mysql_query($query_infor);
					  if(!$result)  ShowMsg("访问出错",-1);
					  else {
					  $row=mysql_fetch_object($result);
					  $row_infor=mysql_fetch_object($result_infor);
					?>
					<TABLE class=table cellSpacing=1 cellPadding=0 width="100%" 
            align=center>
                      <TBODY>
                        <TR vAlign=top>
                          <FORM name=regform action="" method=post onSubmit="return checkAllTextValid(this);">
                            <TD class=noticerr height=72>
                              <TABLE class=table height=30 cellSpacing=0 cellPadding=0 
                  width="100%" align=center 
                  background=image/detailtitle.gif border=0>
                                <TBODY>
                                  <TR>
                                    <TD align=middle width=10></TD>
                                    <TD>基本资料</TD>
                                  </TR>
                                </TBODY>
                              </TABLE>
                              <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                                <TBODY>
                                  <TR>
                                    <TD>
                                      <TABLE cellSpacing=1 cellPadding=3 width="100%" 
border=0>
                                        <TBODY>
                                          <TR >
                                            <TD width="120" align=right >用 户 名: </TD>
                                            <TD style="COLOR: #666666"><?=$row->user_name?></TD>
                                          </TR>
										  <TR >
                                            <TD align=right >您的昵称: </TD>
                                            <TD style="COLOR: #666666"><?=$row->nick_name?></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >电子邮件: </TD>
                                            <TD style="COLOR: #666666"><INPUT class=input   size=35 name=email id="email" value="<?=$row->email?>"  onChange="chk_mail('email');">
                                                <FONT class=mustfill>* </FONT>[电子邮件地址] 保密 
                                                <select name="email_keep" class="INPUT" id="email_keep">
                                                  <option value="1" <?=$row->email_keep=="1"?"selected":""?>>是</option>
                                                  <option value="0" <?=$row->email_keep=="0"?"selected":""?>>否</option>
                                                </select></TD>
                                          </TR>                                          
										  <TR >
                                            <TD align=right>密码问题:</TD>
                                            <TD style="COLOR: #666666" height=22><select name="question" class=INPUT id="question" style="WIDTH: 150px;"> 
                                              <option value="">选择找回密码问题</option>
											  <?php    
									           $conArray = &$question ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$$con_name}'"; 
										       if($$con_name==$row->question) echo " selected"; 
											   echo ">{$$con_name}</option>";
										      }
	                                        ?>
                                            </select></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right>密码答案:</TD>
                                            <TD style="COLOR: #666666" height=22><input name="answer" type="text" class=INPUT id="answer" value="<?=$row->answer?>">
                                            <FONT class=mustfill>* </FONT>此答案和上问题帮助您找回密码</TD>
                                          </TR>
                                        </TBODY>
                                    </TABLE></TD>
                                  </TR>
                                </TBODY>
                              </TABLE>
                              <TABLE class=table height=30 cellSpacing=0 cellPadding=0 
                  width="100%" align=center 
                  background=image/detailtitle.gif border=0>
                                <TBODY>
                                  <TR>
                                    <TD align=middle width=10></TD>
                                    <TD>联系信息</TD>
                                  </TR>
                                </TBODY>
                              </TABLE>
                              <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                                <TBODY>
                                  <TR>
                                    <TD>
                                      <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                                        <TBODY> 
										  <TR >
                                            <TD align=right width=120>中文姓名: </TD>
                                            <TD style="COLOR: #666666" height=22>
											<INPUT name=cn_name   class=INPUT id="cn_name"  value="<?=$row->cn_name?>" onChange="isChineseName('cn_name')" <?php if($row->checked=="1"&&$row->cn_name<>"") echo "disabled"; ?>>      <FONT class=mustfill>* </FONT>
											</TD>
                                          </TR>
                                          <TR >
                                            <TD align=right>英文姓名: </TD>
                                            <TD style="COLOR: #666666" height=22>
											<INPUT name=en_name   class=INPUT id="en_name" value="<?=$row->en_name?>" onChange="isTrueName('en_name')" <?php if($row->checked=="1"&&$row->en_name<>"") echo "disabled"; ?>>
										    </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >性　　别: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT name=sex type=radio value=m <?php if($row->sex=="m") echo "checked";?> <?php if($row->checked=="1") echo "disabled"; ?>>
                                  男
                                    <INPUT type=radio    value=f name=sex <?php if($row->sex=="f") echo "checked";?> <?php if($row->checked=="1") echo "disabled"; ?>>
                                  女 <FONT class=mustfill>* </FONT></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >血　　型:</TD>
                                            <TD style="COLOR: #666666" height=22>
											<SELECT  name=blood id="blood"  <?php if($row->checked=="1") echo "disabled"; ?>>
                                              <?php    
									           $conArray = &$blood_type ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$con_name}'"; 
										       if($con_name==$row->blood) echo " selected"; 
											   elseif(($con_name=="1")&&($row->blood=="")) echo " selected";
										       echo ">{$$con_name}</option>";
										      }
	                                        ?>
                                            </SELECT></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >证件类型: </TD>
                                            <TD style="COLOR: #666666" height=22><SELECT 
                              name=identity_type id="identity_type" 
                              style="FONT-SIZE: 12px; COLOR: #666666" <?php if($row->qualified=="1") echo "disabled"; ?>>
                                                <OPTION value=身份证   <?php if($row->identity_type=="身份证") echo "selected";?> >身份证</OPTION>             

                                                <OPTION value=工作证   <?php if($row->identity_type=="工作证") echo "selected";?>>工作证</OPTION>
				  	  <OPTION value=学生证   <?php if($row->identity_type=="学生证") echo "selected";?>>学生证</OPTION>
                                                <OPTION value=驾驶证   <?php if($row->identity_type=="驾驶证") echo "selected";?>>驾驶证</OPTION>
                                                <OPTION value=军官证   <?php if($row->identity_type=="军官证") echo "selected";?>>军官证</OPTION>
                                                <OPTION value=其他证件 <?php if($row->identity_type=="其他证件") echo "selected";?>>其他证件</OPTION>
                                              </SELECT>
                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >证件号码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->identity_no?>"name=identity_no 
                              class=input id="identity_no" size=30 <?php if($row->qualified=="1"&&$row->identity_no<>"") echo "disabled"; ?>>（不是必须填写的，若填写，将绝对保密）
                                            </TD>
                                          </TR>
                                          <TR >
										  <?php $birthday=explode("-",$row->birthday);?>
                                            <TD align=right >出生年月: </TD>
                                            <TD style="COLOR: #666666" height=22><SELECT 
                              style="FONT-SIZE: 12px; COLOR: #666666" name=yy <?php if($row->checked=="1") echo "disabled"; ?>>
                                                <?php if($birthday[0]<>""){ ?>
												<OPTION value=<?=$birthday[0]?> selected><?=$birthday[0]?></OPTION>
												<?php } ?>
												<OPTION value=1902>1902</OPTION>
                                                <OPTION value=1903>1903</OPTION>
                                                <OPTION value=1904>1904</OPTION>
                                                <OPTION value=1905>1905</OPTION>
                                                <OPTION value=1906>1906</OPTION>
                                                <OPTION value=1907>1907</OPTION>
                                                <OPTION value=1908>1908</OPTION>
                                                <OPTION value=1909>1909</OPTION>
                                                <OPTION value=1910>1910</OPTION>
                                                <OPTION value=1911>1911</OPTION>
                                                <OPTION value=1912>1912</OPTION>
                                                <OPTION value=1913>1913</OPTION>
                                                <OPTION value=1914>1914</OPTION>
                                                <OPTION value=1915>1915</OPTION>
                                                <OPTION value=1916>1916</OPTION>
                                                <OPTION value=1917>1917</OPTION>
                                                <OPTION value=1918>1918</OPTION>
                                                <OPTION value=1919>1919</OPTION>
                                                <OPTION value=1920>1920</OPTION>
                                                <OPTION value=1921>1921</OPTION>
                                                <OPTION value=1922>1922</OPTION>
                                                <OPTION value=1923>1923</OPTION>
                                                <OPTION value=1924>1924</OPTION>
                                                <OPTION value=1925>1925</OPTION>
                                                <OPTION value=1926>1926</OPTION>
                                                <OPTION value=1927>1927</OPTION>
                                                <OPTION value=1928>1928</OPTION>
                                                <OPTION value=1929>1929</OPTION>
                                                <OPTION value=1930>1930</OPTION>
                                                <OPTION value=1931>1931</OPTION>
                                                <OPTION value=1932>1932</OPTION>
                                                <OPTION value=1933>1933</OPTION>
                                                <OPTION value=1934>1934</OPTION>
                                                <OPTION value=1935>1935</OPTION>
                                                <OPTION value=1936>1936</OPTION>
                                                <OPTION value=1937>1937</OPTION>
                                                <OPTION value=1938>1938</OPTION>
                                                <OPTION value=1939>1939</OPTION>
                                                <OPTION value=1940>1940</OPTION>
                                                <OPTION value=1941>1941</OPTION>
                                                <OPTION value=1942>1942</OPTION>
                                                <OPTION value=1943>1943</OPTION>
                                                <OPTION value=1944>1944</OPTION>
                                                <OPTION value=1945>1945</OPTION>
                                                <OPTION value=1946>1946</OPTION>
                                                <OPTION value=1947>1947</OPTION>
                                                <OPTION value=1948>1948</OPTION>
                                                <OPTION value=1949>1949</OPTION>
                                                <OPTION value=1950>1950</OPTION>
                                                <OPTION value=1951>1951</OPTION>
                                                <OPTION value=1952>1952</OPTION>
                                                <OPTION value=1953>1953</OPTION>
                                                <OPTION value=1954>1954</OPTION>
                                                <OPTION value=1955>1955</OPTION>
                                                <OPTION value=1956>1956</OPTION>
                                                <OPTION value=1957>1957</OPTION>
                                                <OPTION value=1958>1958</OPTION>
                                                <OPTION value=1959>1959</OPTION>
                                                <OPTION value=1960>1960</OPTION>
                                                <OPTION value=1961>1961</OPTION>
                                                <OPTION value=1962>1962</OPTION>
                                                <OPTION value=1963>1963</OPTION>
                                                <OPTION value=1964>1964</OPTION>
                                                <OPTION value=1965>1965</OPTION>
                                                <OPTION value=1966>1966</OPTION>
                                                <OPTION value=1967>1967</OPTION>
                                                <OPTION value=1968>1968</OPTION>
                                                <OPTION value=1969>1969</OPTION>
                                                <OPTION value=1970>1970</OPTION>
                                                <OPTION value=1971>1971</OPTION>
                                                <OPTION value=1972>1972</OPTION>
                                                <OPTION value=1973>1973</OPTION>
                                                <OPTION value=1974>1974</OPTION>
                                                <OPTION value=1975>1975</OPTION>
                                                <OPTION value=1976>1976</OPTION>
                                                <OPTION value=1977>1977</OPTION>
                                                <OPTION value=1978>1978</OPTION>
                                                <OPTION value=1979>1979</OPTION>
                                                <OPTION value=1980>1980</OPTION>
                                                <OPTION value=1981>1981</OPTION>
                                                <OPTION value=1982>1982</OPTION>
                                                <OPTION value=1983>1983</OPTION>
                                                <OPTION value=1984>1984</OPTION>
                                                <OPTION value=1985>1985</OPTION>
                                                <OPTION value=1986>1986</OPTION>
                                                <OPTION value=1987>1987</OPTION>
                                                <OPTION value=1988>1988</OPTION>
                                                <OPTION value=1989>1989</OPTION>
                                                <OPTION value=1990>1990</OPTION>
                                                <OPTION value=1991>1991</OPTION>
                                                <OPTION value=1992>1992</OPTION>
                                                <OPTION value=1993>1993</OPTION>
                                                <OPTION value=1994>1994</OPTION>
                                                <OPTION value=1995>1995</OPTION>
                                                <OPTION value=1996>1996</OPTION>
                                                <OPTION value=1997>1997</OPTION>
                                                <OPTION value=1998>1998</OPTION>
                                                <OPTION value=1999>1999</OPTION>
                                                <OPTION value=2000>2000</OPTION>
                                                <OPTION value=2001>2001</OPTION>
                                                <OPTION value=2002>2002</OPTION>
                                                <OPTION value=2003>2003</OPTION>
                                                <OPTION value=2004>2004</OPTION>
                                              </SELECT>
                                  年
                                  <SELECT    style="FONT-SIZE: 12px; COLOR: #666666" name=mm <?php if($row->checked=="1") echo "disabled"; ?>>
                                    <?php if($birthday[1]<>""){ ?>
								    <OPTION value=<?=$birthday[1]?> selected><?=$birthday[1]?></OPTION>
									<?php } ?>
									<OPTION value=1>1</OPTION>
                                    <OPTION value=2>2</OPTION>
                                    <OPTION value=3>3</OPTION>
                                    <OPTION value=4>4</OPTION>
                                    <OPTION value=5>5</OPTION>
                                    <OPTION value=6>6</OPTION>
                                    <OPTION value=7>7</OPTION>
                                    <OPTION value=8>8</OPTION>
                                    <OPTION value=9>9</OPTION>
                                    <OPTION value=10>10</OPTION>
                                    <OPTION value=11>11</OPTION>
                                    <OPTION value=12>12</OPTION>
                                  </SELECT>
                                  月
                                  <SELECT  style="FONT-SIZE: 12px; COLOR: #666666" name=dd <?php if($row->checked=="1") echo "disabled"; ?>>
                                    <?php if($birthday[2]<>""){ ?>
									<OPTION value=<?=$birthday[2]?> selected><?=$birthday[2]?></OPTION>
								   <?php } ?>
									<OPTION value=1>1</OPTION>
                                    <OPTION value=2>2</OPTION>
                                    <OPTION value=3>3</OPTION>
                                    <OPTION value=4>4</OPTION>
                                    <OPTION value=5>5</OPTION>
                                    <OPTION value=6>6</OPTION>
                                    <OPTION value=7>7</OPTION>
                                    <OPTION value=8>8</OPTION>
                                    <OPTION value=9>9</OPTION>
                                    <OPTION value=10>10</OPTION>
                                    <OPTION value=11>11</OPTION>
                                    <OPTION value=12>12</OPTION>
                                    <OPTION value=13>13</OPTION>
                                    <OPTION value=14>14</OPTION>
                                    <OPTION value=15>15</OPTION>
                                    <OPTION value=16>16</OPTION>
                                    <OPTION value=17>17</OPTION>
                                    <OPTION value=18>18</OPTION>
                                    <OPTION value=19>19</OPTION>
                                    <OPTION value=20>20</OPTION>
                                    <OPTION value=21>21</OPTION>
                                    <OPTION value=22>22</OPTION>
                                    <OPTION value=23>23</OPTION>
                                    <OPTION value=24>24</OPTION>
                                    <OPTION value=25>25</OPTION>
                                    <OPTION value=26>26</OPTION>
                                    <OPTION value=27>27</OPTION>
                                    <OPTION value=28>28</OPTION>
                                    <OPTION value=29>29</OPTION>
                                    <OPTION value=30>30</OPTION>
                                    <OPTION value=31>31</OPTION>
                                  </SELECT>
                                  日 </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >所属民族:</TD>
                                            <TD style="COLOR: #666666" height=22>
											<SELECT  name=nationality id="nationality"  <?php if($row->checked=="1") echo "disabled"; ?>>
                                              <?php    
									           $conArray = &$nationality_name ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$con_name}'"; 
										       if($con_name==$row->nationality) echo " selected"; 
											   elseif(($con_name=="1")&&($row->nationality=="")) echo " selected";
										       echo ">{$$con_name}</option>";
										      }
	                                        ?>
                                            </SELECT></TD>
                                          </TR>
										  <TR >
                                            <TD align=right >来自国家:</TD>
                                            <TD style="COLOR: #666666" height=22>
											<SELECT  name=state id="state"  onChange="show_div();" <?php if($row->checked=="1") echo "disabled"; ?>>
                                              <?php    
									           $conArray = &$state ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$con_name}'"; 
										       if($con_name==$row->state) echo " selected"; 
											   elseif(($con_name=="CN")&&($row->state=="")) echo " selected";
										       echo ">{$$con_name}</option>";
										      }
	                                        ?>
                                            </SELECT></TD>
                                          </TR>
                                          <TR id="area" <?php if($row->state<>"CN") echo "style=\"display:none\""; ?>>
                                            <TD align=right >所在地区: </TD>
                                            <TD style="COLOR: #666666" height=22>
                                              <SELECT id="province" runat="server" NAME="province">
                                              </SELECT>
                                              <SELECT id="city" runat="server" NAME="city">
                                              </SELECT>
                                              <SELECT id="county" runat="server" NAME="district">
                                              </SELECT>
                                              <?php 
											  $district=explode("-",$row->district);
											  if($district[0]<>"")  hometown($district[0],$district[1],$district[2]);
											  else hometown($province_default,$city_default,$district_default);?>
                                              <FONT class=mustfill>* </FONT></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >所属行业: </TD>
                                            <TD style="COLOR: #666666" height=22>
											 <SELECT  name=career id="career"    style="FONT-SIZE: 12px; WIDTH: 200px; COLOR: #666666">
                                               <?php    
									           $conArray = &$career ;
									           foreach ( $conArray as $con_name => $value ) {
	                                           $$con_name = $value  ;
										       echo "<option value='{$con_name}'"; 
										       if($con_name==$row->career) echo " selected";
										       echo ">{$$con_name}</option>";
										      }
	                                        ?>
                                              </SELECT>
                                                <FONT class=mustfill>* </FONT></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >通信地址: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->address?>"name=address 
                              class=input id="address" size=50>
                                            保密                                              
                                              <label>
                                              <select name="address_keep" class="INPUT" id="address_keep">
                                                <option value="1" <?=$row->address_keep=="1"?"selected":""?>>是</option>
                                                <option value="0" <?=$row->address_keep=="0"?"selected":""?>>否</option>
                                              </select>
                                            </label></TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >电话号码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->telephone?>"name=telephone 
                              class=input id="telephone" size=30 onChange="isTel('telephone');">
                                              保密
                                                <select name="telephone_keep" class="INPUT" id="telephone_keep">
                                                <option value="1" <?=$row->telephone_keep=="1"?"selected":""?>>是</option>
                                                <option value="0" <?=$row->telephone_keep=="0"?"selected":""?>>否</option>
                                              </select>                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >手机号码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->mobile?>"name=mobile 
                              class=input id="mobile" size=30 onChange="isMobil('mobile')">
                                              保密
                                                <select name="mobile_keep" class="INPUT" id="mobile_keep">
                                                <option value="1" <?=$row->mobile_keep=="1"?"selected":""?>>是</option>
                                                <option value="0" <?=$row->mobile_keep=="0"?"selected":""?>>否</option>
                                              </select>                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >邮政编码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->zip_code?>"name=zip_code 
                              class=input id="zip_code" size=12 onChange="isPostalCode('zip_code')">
                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >QQ号码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->qq?>"class=input size=12 name=qq id='qq' onChange="isQQ('qq')">
                                              保密
                                                <select name="qq_keep" class="INPUT" id="qq_keep">
                                                <option value="1" <?=$row->qq_keep=="1"?"selected":""?>>是</option>
                                                <option value="0" <?=$row->qq_keep=="0"?"selected":""?>>否</option>
                                              </select>                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >MSN号码: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->msn?>"class=input size=30 name=msn id="msn" onChange="chk_mail('msn');">
                                              保密
                                                <select name="msn_keep" class="INPUT" id="msn_keep">
                                                <option value="1" <?=$row->msn_keep=="1"?"selected":""?>>是</option>
                                                <option value="0" <?=$row->msn_keep=="0"?"selected":""?>>否</option>
                                              </select>                                            </TD>
                                          </TR>
                                          <TR >
                                            <TD align=right >网站网址: </TD>
                                            <TD style="COLOR: #666666" height=22><INPUT value="<?=$row->home_page?>"name=home_page 
                              class=input id="home_page" size=50>
                                            </TD>
                                          </TR>
                                          <?php if(!$row_infor->html) { ?>
										   <TR >
                                            <TD align=right >备注留言: </TD>
                                            <TD style="COLOR: #666666" height=22><TEXTAREA name=introduction cols=48 rows=5 class=textarea id="introduction"><?=stripslashes($row_infor->content)?></TEXTAREA>
                                            </TD>
                                          </TR>
										  <?php } ?>
                                          <TR>
                                            <TD align=right >&nbsp;</TD>
                                            <TD style="COLOR: #666666" height=22><INPUT name=amend_sub type=submit class=button id="amend_sub" value=填完了,提交信息>
                                            </TD>
                                          </TR>
                                        </TBODY>
                                    </TABLE></TD>
                                  </TR>
                                </TBODY>
                            </TABLE></TD>
                          </FORM>
                        </TR>
                      </TBODY>
                  </TABLE>
				  <?php } 
				      }
					?>
				  </TD>
                </TR>
              </TBODY>
          </TABLE></td>
        </tr>
      </table>
      <?php   require_once("footer.php"); 
	 	  } else ShowMsg("访问的权限不够或者访问出错","member.php?to_go=".urlencode($_SERVER["REQUEST_URI"])); ?> 
</body>
</html>
<script>
function show_div(){
  var obj=document.getElementById('area');
 if(document.regform.state.value=="CN")  
 obj.style.display="block";
 else
 obj.style.display="none";
}
show_div();
</script>