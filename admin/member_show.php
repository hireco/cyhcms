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
                    <div align="center">��Ա����</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>
          </table></td>
          <td valign="top">&nbsp;</td>
          <td><table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td width="80" valign="bottom"><div class="bigtext_b">
                  <div align="center"><a href="member_admin.php">��Ա����</a></div>
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
                      <td><div align="center">ϵͳ��Ϣ </div></td>
                    </tr>
                  </table>
                </div></TD>
                <TD colspan="5" >&nbsp;</TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD height="1" colspan="6" bgcolor="#CCCCCC" ></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">�����ʺ�:</div></TD>
                <TD class=memberinfo><?=$row->user_name?></TD>
                <TD width=90 align=right class=memberinfo>�ö����:</TD>
                <TD width="15" >&nbsp;</TD>
                <TD class=memberinfo><?=$row->top=="1"?"<font color=green>���ö�</font>":"<font color=red>δ�ö�</font>"?></TD>
                <TD width="1" rowspan="6" bgcolor="#CCCCCC" ></TD>
              </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">ע��ʱ��:</div></TD>
                <TD class=memberinfo><?=$row->register_time?></TD>
                <TD width=90 align=right class=memberinfo>��¼����:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->login_times?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">��Ա����:</div></TD>
                <TD class=memberinfo><?php echo $mem_level[$row->user_level]; ?></TD>
                <TD width=90 align=right class=memberinfo>�����֤:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo>                  <?=$row->qualified=="1"?"<font color=green>��ͨ��</font>":"<font color=red>δͨ��</font>"?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD width=90 align=right class=memberinfo><div align="center">�µ�¼IP:</div></TD>
                <TD class=memberinfo>                  <?=$row->last_ip?></TD>
                <TD width=90 align=right class=memberinfo>�������:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->checked=="1"?"<font color=green>��ͨ��</font>":"<font color=red>δͨ��</font>"?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD align=right class=memberinfo><div align="center">ĩ�ε�¼:</div></TD>
                <TD class=memberinfo><?=$row->last_time?></TD>
                <TD align=right class=memberinfo>����ע��:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->read_times?></TD>
                </TR>
              <TR bgcolor="#EEEEEE">
                <TD align=right class=memberinfo><div align="center">�����޸�:</div></TD>
                <TD class=memberinfo><?=$row->last_modify?></TD>
                <TD align=right class=memberinfo>�Ƽ����:</TD>
                <TD >&nbsp;</TD>
                <TD class=memberinfo><?=$row->recommend=="1"?"<font color=green>���Ƽ�</font>":"<font color=red>δ�Ƽ�</font>"?></TD>
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
                      <td><div align="center">��������</div></td>
                    </tr>
                  </table>
                  </div></TD>
                <TD colspan="5" >&nbsp;</TD>
                </TR>
              <TR>
                <TD height="1" colspan="6" align=right bgcolor="#CCCCCC" ></TD>
                </TR>
               <TR bgcolor="#EEEEEE">
                 <TD width=90 align=right class=memberinfo><div align="center">�û��ǳ�:</div></TD>
                       <TD class=memberinfo><?=$row->nick_name?></TD>
                       <TD width=90 align=right class=memberinfo>��������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->cn_name==""?"<font color=red>δ��д</font>":$row->cn_name;?></TD>
                       <TD rowspan="10" bgcolor="#CCCCCC" ></TD>
               </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">Ӣ������:</div></TD>
                       <TD class=memberinfo><?=$row->en_name==""?"<font color=red>δ��д</font>":$row->en_name;?></TD>
                       <TD width=90 align=right class=memberinfo>��������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->birthday==""?"<font color=red>δ��д</font>":$row->birthday;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">�����Ա�:</div></TD>
                       <TD class=memberinfo><?=$row->sex=="m"?"<font color=blue>��</font>":"<font color=red>Ů</font>";?></TD>
                       <TD width=90 align=right class=memberinfo>֤������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->identity_no==""?"<font color=red>δ��д</font>":$row->identity_no;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">����ְҵ:</div></TD>
                       <TD class=memberinfo><?=$row->career==""?"<font color=red>δ��д</font>":$career[$row->career];?></TD>
                       <TD width=90 align=right class=memberinfo>���ڹ���:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->state==""?"<font color=red>δ��д</font>":$state[$row->state];?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">��������:</div></TD>
                       <TD class=memberinfo><?=$nationality_name[$row->nationality]?></TD>
                       <TD align=right class=memberinfo>����Ѫ��:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$blood_type[$row->blood]?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">���ڵ���:</div></TD>
                       <TD class=memberinfo><?=$row->district=="ʡ��-�ؼ���-�ء�����"?"":ereg_replace("-�ؼ���","",ereg_replace("-�ء�����","",$row->district))?></TD>
                       <TD align=right class=memberinfo>��������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->zip_code==""?"<font color=red>δ��д</font>":$row->zip_code;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">Ŀǰסַ:</div></TD>
                       <TD class=memberinfo><?=$row->address==""?"<font color=red>δ��д</font>":$row->address;?></TD>
                       <TD align=right class=memberinfo>�����ʼ�:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->email==""?"<font color=red>δ��д</font>":$row->email;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">QQ����:</div></TD>
                       <TD class=memberinfo><?=$row->qq=="0"?"<font color=red>δ��д</font>":$row->qq;?></TD>
                       <TD align=right class=memberinfo>MSN:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->msn==""?"<font color=red>δ��д</font>":$row->msn;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">�ֻ�����:</div></TD>
                       <TD class=memberinfo><?=$row->mobile==""?"<font color=red>δ��д</font>":$row->mobile;?></TD>
                       <TD align=right class=memberinfo>�绰����:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->telephone==""?"<font color=red>δ��д</font>":$row->telephone;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">������ҳ:</div></TD>
                       <TD colspan="4" class=memberinfo><?=$row->home_page==""?"<font color=red>δ��д</font>":$row->home_page;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right bgcolor="#CCCCCC" ></TD>
                       <TD height="1" colspan="5" align=right bgcolor="#CCCCCC" ></TD>
                       <TD bgcolor="#CCCCCC" ></TD>
                     </TR>
              </TBODY></TABLE>
			  <?php }  
			  else  ShowMsg("�����ڸö���!",-1);
				}
			  else  ShowMsg("ȱ�ٱ�Ҫ�Ĳ���!",-1); ?>
			  <br>
			  <?php require_once("scripts/footer.php"); ?>
</body>
</html>
