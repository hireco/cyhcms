<?php session_start();?>
<?php require_once("config/base_cfg.php");
       require_once("dbscripts/db_connect.php"); 
       require_once("inc/show_msg.php");
	   require_once("inc/main_fun.php"); 
	   require_once($cfg_admin_root."scripts/constant.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$cfg_index_title?></title>
<meta name="keywords" content="<?=$cfg_meta_keywords?>" />
<meta name="description" content="<?=$cfg_meta_description?>" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<SCRIPT type=text/javascript>
function fontZoom(size)
{
   document.getElementById('con').style.fontSize=size+'px';
}
</SCRIPT>
</head>
<body>
<?php if(isset($_SESSION['user_name'])&&(!empty($_SESSION['user_name']))){   
	   require_once("center_header.php");
	   ?>
<TABLE cellSpacing=0 cellPadding=0 width=<?=$cfg_body_width?> align=center background=image/centerbg.gif border=0>
  <TBODY>
  <TR>
	<TD vAlign=top width=181 background=image/leftbg.gif height=186>
      <TABLE height=31 cellSpacing=0 cellPadding=0 width=181 
      background=image/lefttitle.gif border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width=180 border=0>
              <TBODY>
              <TR>
                <TD width=8></TD>
                <TD>�û����ܲ˵�</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
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
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top width=6 background=image/hline.gif></TD>
    <TD height=200 vAlign=top bgcolor="#E3E3E1">
      <TABLE width="100%" height=26 
      border=0 align=center cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
        <TBODY>
        <TR>
          <TD class=nav>�����ڵ�λ��: ��ҳ &gt;  �û�����</TD>
        </TR></TBODY></TABLE>
      <table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#E3E3E1">
        <tr>
          <td><?php echo $_SESSION['nick_name']." ���ã���ӭ�����û����ģ������û����� ".$_SESSION['user_name'];  ?></td>
          <?php if(isset($_SESSION['user_name'])) { ?>
		  <td width="100"><div align="center"><A  style="FONT-SIZE: 12px" href="logout.php?to_go=<?php 
		  if(ereg("IIS",$_SERVER['SERVER_SOFTWARE']))  echo urlencode($_SERVER['HTTP_X_REWRITE_URL']);
	      else if(ereg("Apache",$_SERVER['SERVER_SOFTWARE'])) echo urlencode($_SERVER['REQUEST_URI']);?>">�˳���¼</A></div></td>
		  <?php } ?>
        </tr>
      </table>
      <table width="100%" height="1"  border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
        <tr>
          <td></td>
        </tr>
      </table>
	  <?php 
	    $query="select * from ".$table_suffix."member where user_name='{$_SESSION['user_name']}'";
	    $result=mysql_query($query);
	    if(!$result) ShowMsg("��ѯ����,���Ժ�����.",-1);
		else { 
		$row=mysql_fetch_object($result);
	    $id=$row->id;
	  ?>
<TABLE width="100%" border=0 cellPadding=0 cellSpacing=5 bgcolor="#FFFFFF">
        <TBODY>
        <TR>
          <TD vAlign=top>
		  <?php if($row->modified_ok=="0") {?>
		  <table width="90%"  border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td>��ʾ���������ϲ���ǰ�и���,������ڽ�����...</td>
              </tr>
          </table>
		  <?php } ?>
		  <BR><TABLE cellSpacing=0 cellPadding=0 width="90%" 
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
                       <TD align=right class=memberinfo><div align="center">����Ѫ��:</div></TD>
                       <TD class=memberinfo><?=$blood_type[$row->blood]?></TD>
                       <TD align=right class=memberinfo>��������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$nationality_name[$row->nationality]?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD width=90 align=right class=memberinfo><div align="center">����ְҵ:</div></TD>
                       <TD class=memberinfo><?=$row->career==""?"<font color=red>δ��д</font>":$career[$row->career];?></TD>
                       <TD width=90 align=right class=memberinfo>���ڹ���:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->state==""?"<font color=red>δ��д</font>":$state[$row->state];?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">���ڵ���:</div></TD>
                       <TD class=memberinfo><?=$row->district=="ʡ��-�ؼ���-�ء�����"?"":ereg_replace("-�ؼ���","",ereg_replace("-�ء�����","",$row->district))?></TD>
                       <TD align=right class=memberinfo>��������:</TD>
                       <TD >&nbsp;</TD>
                       <TD class=memberinfo><?=$row->zip_code==""?"<font color=red>δ��д</font>":$row->zip_code;?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right class=memberinfo><div align="center">ͨѶ��ַ:</div></TD>
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
                       <TD colspan="4" class=memberinfo><?=$row->home_page==""?"<font color=red>δ��д</font>":"<a href=".$row->home_page." target=blank style=\"text-decoration:underline;\">".$row->home_page."</a>";?></TD>
                     </TR>
                     <TR bgcolor="#EEEEEE">
                       <TD align=right bgcolor="#CCCCCC" ></TD>
                       <TD height="1" colspan="5" align=right bgcolor="#CCCCCC" ></TD>
                       <TD bgcolor="#CCCCCC" ></TD>
                     </TR>
              </TBODY></TABLE>
				 <br>
				 <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                   <tr>
                     <td bgcolor="#EEEEEE"><table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0">
                       <tr>
                         <td><?php 
				 $j=0;
				 $k=0;
				 $result=mysql_query($query); 
				 while ($property = mysql_fetch_field($result)){   
				 if($property->max_length>1) {
				    $k++;
				   }
				  $j++;
				 }
				  
				 $query="select * from ".$table_suffix."member_infor where user_name='{$_SESSION['user_name']}'";
				 $result=mysql_query($query); 
				 if(@mysql_num_rows($result)) $add1=5;  else $add1=0;
				 //������Ϣ����--------------------------------------------------------
				 
				 
				 $query="select * from ".$table_suffix."picture where object_class='member' and object_id=$id";
				 $result=mysql_query($query); 
				 if(@mysql_num_rows($result)) $add2=5;  else $add2=0;
				 //������Ϣ����--------------------------------------------------------
				 
				 $j=$j+10;
				 $k=$k+$add1+$add2;
				 
				 $percent=substr(100*$k*1.0/$j,0,2)."%"; 
				 $manyidu=substr(100*$k*1.0/$j,0,6)."%";
				 echo "����������ɶ�:";
				 ?></td>
                         <td width="400"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
                             <tr>
                               <td width="<?=$percent?>"><div align="center" style="color:#FFFFFF;">
                                   <?=$manyidu?>
                               </div></td>
                               <td bgcolor="#FFFFFF">&nbsp;</td>
                             </tr>
                         </table></td>
                       </tr>
                     </table></td>
                   </tr>
                 </table>
			  <br>			  </TD>
        </TR></TBODY></TABLE>
	  <?php 
	     }
	  ?></TD></TR></TBODY></TABLE>
<?php } else {  
 require_once("header.php");?>
<table width="<?=$cfg_body_width?>"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="70%" bgcolor="#F4F4F4"><table width="60%"  border="0" align="right" cellpadding="0" cellspacing="0" bgcolor="#E3E3E1">
            <tr>
              <td width="104" height="129" bgcolor="#F4F4F4"><div align="left"><img src="image/business.jpg" width="104" height="129" hspace="0" vspace="0" border="0"> </div></td>
              <td><div align="left">
                  <?php  require_once("inc/loginform.php") ?>
              </div></td>
            </tr>
          </table></td>
          <td bgcolor="#E3E3E1">&nbsp;</td>
        </tr>
</table>
<?php  } require_once("footer.php"); ?>
</body>
</html>