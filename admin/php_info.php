<?php 
session_start();
require_once("setting.php");
require_once("inc.php");
require_once("scripts/sys_test.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>�������ݹ���ϵͳ-�ռ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"></head>
<style type="text/css">
 td		{font-size:8pt; color: <?=$skin[tdfont]?>;font-family:Verdana}
 input		{BORDER-RIGHT: <?=$skin[tdborder]?> 1px solid; BORDER-TOP: <?=$skin[tdborder]?> 1px solid; BORDER-LEFT: <?=$skin[tdborder]?> 1px solid; COLOR: <?=$skin[tdfont]?>; BORDER-BOTTOM: <?=$skin[tdborder]?> 1px solid; BACKGROUND-COLOR: <?=$skin[bdcolor]?>} 
 body		{text-align: center; left: 0px; top: 200px; font-size:8pt; color: <?=$skin[tdfont]?>;font-family:Verdana; SCROLLBAR-FACE-COLOR: #ffffff; background color:<?=$skin[bdcolor]?>;cursor:SCROLLBAR-HIGHLIGHT-COLOR: #ffffff; SCROLLBAR-SHADOW-COLOR: #aaaaaa; SCROLLBAR-3DLIGHT-COLOR: #aaaaaa; SCROLLBAR-ARROW-COLOR: #dddddd; SCROLLBAR-TRACK-COLOR: #ffffff; SCROLLBAR-DARKSHADOW-COLOR: #ffffff }
 a:link		{text-decoration:none; color:<?=$skin[flink]?>} 
 a:visited	{text-decoration:none; color:<?=$skin[flink]?>} 
 a:active	{text-decoration:none; color:<?=$skin[flink]?>} 
 a:hover	{COLOR: <?=$skin[fhove]?>; }
 .tb		{BORDER-RIGHT: <?=$skin[tdborder]?> 1px solid; BORDER-TOP: <?=$skin[tdborder]?> 1px solid; BORDER-LEFT: <?=$skin[tdborder]?> 1px solid; BORDER-BOTTOM: <?=$skin[tdborder]?> 1px solid;background-color:<?=$skin[tdborder]?>}
 .tb0		{BORDER-RIGHT: <?=$skin[tdborder]?> 1px solid; BORDER-TOP: <?=$skin[tdborder]?> 1px solid; BORDER-LEFT: <?=$skin[tdborder]?> 1px solid; BORDER-BOTTOM: <?=$skin[tdborder]?> 1px solid;background-color:<?=$skin[tdbg]?>}
 .tb1		{background-color:<?=$skin[bdcolor]?>}
 .ture		{color: green}
 .false		{color:red}
 .u			{text-decoration: underline}
 .s			{text-decoration: line-through}
 </style>
<body >
<div  id="top" style="MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px">

<table width="700"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" >
<tr class="tb"><td align="left">
 <table width="100%"  border="0" cellpadding="2" cellspacing="1" style="background-color:<?=$skin[bdcolor]?>;">
 <tr><td class=tb0>
  <table width="100%" height="10" border="0" cellpadding="2" cellspacing="1" bgcolor=<?=$skin[bdcolor]?>>
  <tr><Td width=230 >
  <div id=gosite style="CURSOR: hand;" onclick="window.open('http://www.hongmian.net')">
  <P style="MARGIN-TOP: 0px; FONT-SIZE: 8pt; MARGIN-BOTTOM: 5px">&nbsp;<STRONG>Hongmian.net</STRONG></P>
  <P style="MARGIN-TOP: 0px; MARGIN-BOTTOM: -5px">&nbsp;<STRONG style="FONT-SIZE: 24pt">PHP�ռ����</STRONG></P>
  </td><td align=right width=10 valign=top>
  <a href="<?=$PHP_SELF?>?sys_info&style=sim" title="�Ұ׷��"><font color=#cccccc>��</font></a>
  <a href="<?=$PHP_SELF?>?sys_info&style=red" title="��ɫ���"><font color=#FF9933>��</font></a>
  <a href="<?=$PHP_SELF?>?sys_info&style=blu" title="ǳ�̷��"><font color=#66FFFF>��</font></a>
  </td><td ><div align="center">
  <?=$admessage?>
</div></td></tr>
  </table>
 </td></tr>
 </table>
</td></tr>
<tr class="tb"><td align="left">

 <table width="100%" border="0" cellpadding="2" cellspacing="1" style="background-color:<?=$skin[tdborder]?>;">
 <tr><td class="tb1">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" >
  <tr>
  <td ><a href="#server">����������</a></td>
  <td ><a href="#php">PHP��������</a></td>
  <td ><a href="#basic">���֧��״��</a></td>
  <td ><a href="#define">�Զ�����</a></td>
  <td ><a href="#power">���������ܼ��</a></td>
  <td ><?=$phpinfo?></td>
  </tr>
  </table>
 </td></tr>
 </table>

</td></tr>
<tr><td>
<?
for($a=0;$a<5;$a++){
	if($a == 0){
		$hp = array("server","����������");
	}elseif($a == 1){
		$hp = array("php","PHP��������");
	}elseif($a == 2){
		$hp = array("basic","���֧��״��");
	}elseif($a == 3){
		$hp = array("define","�Զ�����");
	}elseif($a == 4){
		$hp = array("power"," ���������ܼ�� ");
	}
?>

 <a name="<?=$hp[0]?>"></a>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" >
 <tr><td>

  <table width="100" border="0" align="left" cellpadding="4" cellspacing="0" >
   <tr><td align="left"  class="tb0" style="width:100"><?=$hp[1]?></td>
   </tr>
  </table>

 </td></tr>
 <tr><td>

  <table width="100%" border="0" cellpadding="2" cellspacing="1"  style="background-color:<?=$skin[tdborder]?>;">
  <tr><td class="tb1">
   <table width="100%" border="0" cellpadding="2" cellspacing="1" >
<?
if($a == 0){
	for($i=0;$i<=12;$i++){
		echo "<tr align=\"left\"><td style=\"width:30%\">".$info[$i][0]."</td><td style=\"width:70%\">".$info[$i][1]."</td></tr>\n";
	}
}elseif($a == 1){
	for($i=13;$i<=23;$i++){
		echo "<tr align=\"left\"><td style=\"width:70%\">".$info[$i][0]."</td><td style=\"width:30%\">".$info[$i][1]."</td></tr>\n";
	}
}elseif($a == 2){
	for($i=24;$i<=58;$i++){
		echo "<tr align=\"left\"><td style=\"width:70%\">".$info[$i][0]."</td><td style=\"width:30%\">".$info[$i][1]."</td></tr>\n";
	}

}elseif($a == 3){
?>
   <tr><td>

	<a name="<?=$hp[0]?>"></a>
	<table border="0" width="100%" cellspacing="1" cellpadding="1">
	<tr><td><label title="classname" >����������������������Ҫ���Ĳ�����</label><a href="#" title="����variables_order:gpc_order:magic_quotes_gpc:asp_tags:session.save_path">ProgId��ClassId��</a> 
	</td></tr>
	<tr><td align="center" style="height:30" >
	<form name="form1" action="<?=$PHP_SELF?>?sys_info#define" method="post" >
	<input name="ft" value="check" type="hidden" />
	<input name="style" value="<?=$style?>" type="hidden" />
	<input class="input" type="text" value="" name="classname" size="40" />
	<input type="submit" value="ȷ��" class="backc" name="submit1" />
	<input type="reset" value="����" class="backc" name="reset1" /> 
	</form>
	</td></tr>
	</table>

   </td></tr>
<?php if($ft=='check'){?>
   <tr><td>

	<table border="0" width="100%" cellspacing="2" cellpadding="1">
	<tr style="height:18" class="mytr" align="center">
	<td style="width:70%">�� ѯ �� �� �� ��</td>
	<td style="width:30%">����</td>
	</tr>
	<tr align="center" style="height:18">
	<td align="left">&nbsp;<?=$classname?>&nbsp;</td>
	<td align="center">&nbsp;�뿴����Ĳ���</td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Getenv��ʽ</td><td align="left">&nbsp;<?=getenv("$classname")?></td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Get_cfg_var��ʽ</td><td align="left">&nbsp;<?=get_cfg_var("$classname")?></td></tr>
	<tr align="cente" ><td align="left" style="height:18">&nbsp;Get_magic_quotes_gpc��ʽ</td><td align="left">&nbsp;<?=get_magic_quotes_gpc("$classname")?></td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Get_magic_quotes_runtime��ʽ</td><td align="left">&nbsp;<?=get_magic_quotes_runtime("$classname")?></td></tr>
	</table>

   </td></tr>
<?
}

}elseif($a == 4){
?>
   <tr><td>
	<a name="<?=$hp[0]?>"></a>

	<table width="100%" border="0" cellspacing="2" cellpadding="1">
	<?
	for($j=0;$j<3;$j++){
		if($j == 0) {
			$do = "int";
			if($vfloat) $otval = "<input type=\"hidden\" name=\"vfloat\" value=\"$vfloat\" />\n";
			if($vio) $otval .= "<input type=\"hidden\" name=\"vio\" value=\"$vio\" />\n";
			$show = $vint ? "���²���" : "����";
			$pval = array("1.782��","5.603��","67.371��","1.456��",te_val($vint));
			$phead = "����������������(1+1����300���)";
		 }elseif($j == 1){
			$do = "float";
			$otval = "";
			if($vint) $otval = "<input type=\"hidden\" name=\"vint\" value=\"$vint\" />\n";
			if($vio) $otval .= "<input type=\"hidden\" name=\"vio\" value=\"$vio\" />\n";
			$show = $vfloat ? "���²���" : "����";
			$pval = array("1.821��","2.618��","29.44��","1.291��",te_val($vfloat));
			$phead = "����������������(��ƽ��300���)";
		 }elseif($j == 2){
			$do = "io";
			$otval = "";
			if($vfloat) $otval = "<input type=\"hidden\" name=\"vfloat\" value=\"$vfloat\" />\n";
			if($vint) $otval .= "<input type=\"hidden\" name=\"vint\" value=\"$vint\" />\n";
			$show = $vio ? "���²���" : "����";
			$pval = array("0.073��","0.128��","0.332��","0.092��",te_val($vio));
			$phead = "����I/O��������(��ȡ10K�ļ�10000��)";
		 }
	?>
	<tr class="myhead" align="left"> 
	<td colspan="2" ><b><?=$phead?></b></td>
	</tr>
	<tr class="mytr" align="left"> 
	<td style="width:70%" >C1G�ĵ���(6C/1.4G+128M+Win2000)</td>
	<td style="width:30%" ><?=$pval[0]?></td>
	</tr>
	<tr class="mytr" align="left"> 
	<td style="width:70%" >zanadoo.com(C1.3G+256M+Linux)(2003/03/15 17:58)</td>
	<td style="width:30%" ><?=$pval[1]?></td>
	</tr>
	<tr class="mytr" align="left"> 
	<td>51.net������A��(598MHz+SCSI)(2003/03/15 17:28)</td>
	<td><?=$pval[2]?></td>
	</tr>
	<tr class="mytr" align="left"> 
	<td>�и������PHP��(2003/03/15 17:36)</td>
	<td><?=$pval[3]?></td>
	</tr>
	<tr class="mytr" align="left" valign="top">
	<td>
	<form name="test<?=$j?>" method="post" action="<?=$PHP_SELF?>?sys_info#power">
	������ʹ�õ���̨������<?=$otval?>
	<input name="style" value="<?=$style?>" type="hidden" />
	<input type="hidden" name="test" value="<?=$do?>" />
	[<a href="javascript:test<?=$j?>.submit()"><?=$show?></a>]
	</form>
	</td>
	<td><?=$pval[4]?></td>
	</tr>
	<?}?>
	</table>

   </td></tr>
   <?
   }
   ?>
   </table>
  </td></tr>
  </table>
 </td></tr>
 </table>
<?
}
?>
</td></tr>
<tr><td>
 <table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
 <td><FONT style="FONT-SIZE: 7pt" color=#333333><?=gettimeout()?>
   </FONT></td>
 <td align=right><a href=#top title="ǰ������">������</a></td>
 </tr>
 </table>
</td></tr>
</table>
</div>

<a name="bottom" id="bottom"></a>
</body>
</html>
<?
if($testinfo)phpinfo();
?>