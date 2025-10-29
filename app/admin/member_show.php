<?php session_start(); 
   require_once("setting.php");
   require_once("inc.php");
   require_once(dirname(__FILE__)."/function/inc_function.php");
   require_once(dirname(__FILE__)."/scripts/constant.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
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
                    <div align="center">会员资料</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="member_admin.php">会员管理</a></div>
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
        <div align="center"> </div></td>
  </tr>
</table>
<br>
<?php 
  if(isset($_REQUEST['id'])) {
  $query="select * from ".$table_suffix."member where id={$_REQUEST['id']}";
  $result=mysql_query($query);
  if($row=mysql_fetch_object($result)) {
?>
<TABLE cellSpacing=0 cellPadding=0 width="90%" 
            align=center border=0>
              <TBODY>
              <TR>
                <TD width="1" rowspan="8" align=right bgcolor="#CCCCCC"></TD>
                <TD align=right bgcolor="#CCCCCC" class=memberinfo><div align="center">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center">系统信息 </div></td>
                    </tr>
                  </table>
                </div></TD>
                <TD colspan="5" >&nbsp;</TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD height="1" colspan="6" bgcolor="#CCCCCC" ></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">您的帐号:</div></TD>
                <TD class=memberinfo><?=$row->user_name?></TD>
                <TD width=90 align=right class=memberinfo>置顶情况:</TD>
                <TD width="15" >&nbsp;</TD>
                <TD class=memberinfo><?=$row->top=="1"?"<font color=green>已置顶</font>":"<font color=red>未置顶</font>"?></TD>
                <TD width="1" rowspan="6" bgcolor="#CCCCCC" ></TD>
              </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">注册时间:</div></TD>
                <TD class=memberinfo><?=$row->register_time?></TD>
                <TD width=90 align=right class=memberinfo>登录次数:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->login_times?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">会员级别:</div></TD>
                <TD class=memberinfo><?php echo $mem_level[$row->user_level]; ?></TD>
                <TD width=90 align=right class=memberinfo>身份认证:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo>                  <?=$row->qualified=="1"?"<font color=green>已通过</font>":"<font color=red>未通过</font>"?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">新登录IP:</div></TD>
                <TD class=memberinfo>                  <?=$row->last_ip?></TD>
                <TD width=90 align=right class=memberinfo>初次审查:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->checked=="1"?"<font color=green>已通过</font>":"<font color=red>未通过</font>"?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD align=right class=memberinfo><div align="center">末次登录:</div></TD>
                <TD class=memberinfo><?=$row->last_time?></TD>
                <TD align=right class=memberinfo>被关注度:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->read_times?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD align=right class=memberinfo><div align="center">最新修改:</div></TD>
                <TD class=memberinfo><?=$row->last_modify?></TD>
                <TD align=right class=memberinfo>推荐情况:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->recommend=="1"?"<font color=green>已推荐</font>":"<font color=red>未推荐</font>"?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD align=right bgcolor="#CCCCCC"></TD>
                <TD height="1" colspan="5" align=right bgcolor="#CCCCCC" ></TD>
                <TD bgcolor="#CCCCCC" ></TD>
              </TR>
              <TR>
                <TD colspan="7" align=right >&nbsp;</TD>
                </TR>
              <TR>
                <TD rowspan="12" align=right bgcolor="#CCCCCC" ></TD>
                <TD align=right bgcolor="#CCCCCC" class=memberinfo><div align="center">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><div align="center">基本资料</div></td>
                    </tr>
                  </table>
                  </div></TD>
                <TD colspan="5" >&nbsp;</TD>
                </TR>
              <TR>
                <TD height="1" colspan="6" align=right bgcolor="#CCCCCC" ></TD>
                </TR>
               <TR bgcolor="#EEEEEE">
                 <TD width=90 align=right class=memberinfo><div align="center">用户昵称:</div></TD>
                       <TD class=memberinfo><?=$row->nick_name?></TD>
                       <TD width=90 align=right class=memberinfo>中文姓名:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->cn_name==""?"<font color=red>未填写</font>":$row->cn_name;?></TD>
                       <TD rowspan="10" bgcolor="#CCCCCC" ></TD>
               </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">英文姓名:</div></TD>
                       <TD class=memberinfo><?=$row->en_name==""?"<font color=red>未填写</font>":$row->en_name;?></TD>
                       <TD width=90 align=right class=memberinfo>您的生日:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->birthday==""?"<font color=red>未填写</font>":$row->birthday;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">您的性别:</div></TD>
                       <TD class=memberinfo><?=$row->sex=="m"?"<font color=blue>男</font>":"<font color=red>女</font>";?></TD>
                       <TD width=90 align=right class=memberinfo>证件号码:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->identity_no==""?"<font color=red>未填写</font>":$row->identity_no;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">从事职业:</div></TD>
                       <TD class=memberinfo><?=$row->career==""?"<font color=red>未填写</font>":$career[$row->career];?></TD>
                       <TD width=90 align=right class=memberinfo>所在国家:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->state==""?"<font color=red>未填写</font>":$state[$row->state];?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">您的民族:</div></TD>
                       <TD class=memberinfo><?=$nationality_name[$row->nationality]?></TD>
                       <TD align=right class=memberinfo>您的血型:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$blood_type[$row->blood]?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">所在地区:</div></TD>
                       <TD class=memberinfo><?=$row->district=="省份-地级市-县、地区"?"":ereg_replace("-地级市","",ereg_replace("-县、地区","",$row->district))?></TD>
                       <TD align=right class=memberinfo>邮政编码:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->zip_code==""?"<font color=red>未填写</font>":$row->zip_code;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">目前住址:</div></TD>
                       <TD class=memberinfo><?=$row->address==""?"<font color=red>未填写</font>":$row->address;?></TD>
                       <TD align=right class=memberinfo>电子邮件:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->email==""?"<font color=red>未填写</font>":$row->email;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">QQ号码:</div></TD>
                       <TD class=memberinfo><?=$row->qq=="0"?"<font color=red>未填写</font>":$row->qq;?></TD>
                       <TD align=right class=memberinfo>MSN:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->msn==""?"<font color=red>未填写</font>":$row->msn;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">手机号码:</div></TD>
                       <TD class=memberinfo><?=$row->mobile==""?"<font color=red>未填写</font>":$row->mobile;?></TD>
                       <TD align=right class=memberinfo>电话号码:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->telephone==""?"<font color=red>未填写</font>":$row->telephone;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">个人主页:</div></TD>
                       <TD colspan="4" class=memberinfo><?=$row->home_page==""?"<font color=red>未填写</font>":$row->home_page;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right bgcolor="#CCCCCC" ></TD>
                       <TD height="1" colspan="5" align=right bgcolor="#CCCCCC" ></TD>
                       <TD bgcolor="#CCCCCC" ></TD>
                     </TR>
              </TBODY></TABLE>
			  <?php }  
			  else  ShowMsg("不存在该对象!",-1);
				}
			  else  ShowMsg("缺少必要的参数!",-1); ?>
			  <br>
			  <?php require_once("scripts/footer.php"); ?>
</body>
</html>
