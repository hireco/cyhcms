<?php
//<-------����ͨ��GET�����ύ�ı���;��ʼ-------->
if($HTTP_GET_VARS[year]=="")
{
    $HTTP_GET_VARS[year]=date("Y");
}
if($HTTP_GET_VARS[month]=="")
{
    $HTTP_GET_VARS[month]=date("n");
}
if($HTTP_GET_VARS[day]=="")
{
    $HTTP_GET_VARS[day]=date("d");
}
$month=$HTTP_GET_VARS[month];
$year=$HTTP_GET_VARS[year];
$day=$HTTP_GET_VARS[day];
//<-------����ͨ��GET�����ύ�ı���;����-------->
if($year<1971)
{
    echo "����!";
    echo "<BR>";
    echo "<a href=$HTTP_SERVER_VARS[PHP_SELF]>Back</a>";
    exit();
}
//<-------���·ݳ���1��12ʱ�Ĵ���;��ʼ------->
if($day<1)
{   $day=31; 
    $month-=1;
}

if($day>31) 
{   $day=1; 
    $month+=1; 
}

if($month<1)
{
    $month=12;
    $year-=1;
}
if($month>12)
{
    $month=1;
    $year+=1;
}
?>
<table align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	<?php echo "<a href=user_infor.php?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&year=".($year-1)."&month=".$month."&time=byyear><img src=\"image/findButtonBack0.gif\" alt=\"Back Year\"  border=\"0\"></a>"; ?><img height="24" src="image/findSeasonSummer.gif" width="81"><?php echo "<a href=user_infor.php?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&year=".($year+1)."&month=".$month."&time=byyear><img src=\"image/findButtonNext0.gif\" alt=\"Next Year\"  border=\"0\"></a>"; ?></td>
  </tr>
  <tr>
    <td bgcolor="#C4CCDF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><div align="center">
<?php 
echo "<a href=user_infor.php?view=calendar&view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&month=".($month-1)."&year=".$year."&time=bymonth><img src=\"image/before_m.gif\" alt=\"Back Month\"  border=\"0\"></a>";
?>
              </div></td>
              <td><div align="center"><?php echo $year."��".$month."��";?></div></td>
              <td><div align="center">
<?php 
echo "<a href=user_infor.php?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&month=".($month+1)."&year=".$year."&time=bymonth><img src=\"image/next_m.gif\" alt=\"Next Month\"  border=\"0\"></a>";
?>
              </div></td>
            </tr>
          </table>
            <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#E7E7E7">
              <tr align=center>
                <td><font color="red">��</font></td>
                <td>һ</td>
                <td>��</td>
                <td>��</td>
                <td>��</td>
                <td>��</td>
                <td>��</td>
              </tr>
              <tr>
<?php
$year_i=substr($year,-2);
if($month>9) $month_i=$month; else $month_i="0".$month;
$d=date("d");
$FirstDay=date("w",mktime(0,0,0,$month,1,$year));//ȡ���κ�һ���µ�һ�������ڼ�,���ڼ���һ�����ɱ��ĵڼ���ʼ
$bgtoday=date("d");
function font_color($month,$today,$year)//���ڼ����������������ɫ
{
    $sunday=date("w",mktime(0,0,0,$month,$today,$year));
    if($sunday=="0")
    {
                $FontColor="red";
    }
    else
    {
                $FontColor="black";
    }
    return $FontColor;
}
function bgcolor($month,$bgtoday,$today_i,$year)//���ڼ��㵱�յı�����ɫ
{   global $day;
    $show_today=date("d",mktime(0,0,0,$month,$today_i,$year));
    $sys_today=date("d",mktime(0,0,0,$month,$bgtoday,$year));
    if($today_i==$day)
    {
                $bgcolor="bgcolor=#6699FF";
    }
	elseif($show_today==$sys_today)
    {
                $bgcolor="bgcolor=#CCCCCC";
    }
    else
    {
                $bgcolor="";
    }
    return $bgcolor;
}
function font_style($month,$today,$year)//���ڼ����������������
{
    $sunday=date("w",mktime(0,0,0,$month,$today,$year));
    if($sunday=="0")
    {
                $FontStyle="<strong>";
    }
    else
    {
                $FontStyle="";
    }
    return $FontStyle;
}
for($i=0;$i<=$FirstDay;$i++)//��for�������ĳ���µ�һ��λ��
{
    for($i;$i<$FirstDay;$i++)
    {
                echo "<td align=center>&nbsp;</td>\n";
    }
    if($i==$FirstDay)
    {           
	            $query_string="year=".$year."&month=".$month."&day=1&time=byday";
                echo "<td align=center ".bgcolor($month,$bgtoday,1,$year)."><a href=\"user_infor.php?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&$query_string\"><font color=".font_color($month,1,$year).">".font_style($month,1,$year)."1</font></a></td>\n";
                if($FirstDay==6)//�ж�1���Ƿ�������
                {
                        echo "</tr>";
                }
    }
}
$countMonth=date("t",mktime(0,0,0,$month,1,$year));//ĳ�µ�������
for($i=2;$i<=$countMonth;$i++)//�����1�Ŷ�λ,���2��ֱ����β�����к���
{   
    if($i>9) $day_i=$i; else $day_i="0".$i;
    $query_string="year=".$year."&month=".$month."&day=".$i."&time=byday";
	echo "<td align=center ".bgcolor($month,$bgtoday,$i,$year)."><a href=\"user_infor.php?view=calendar&host_id=".$host_id."&idkey=".$_REQUEST[idkey]."&$query_string\"><font color=".font_color($month,$i,$year).">".font_style($month,$i,$year).$i."</font></a></td>\n";
    if(date("w",mktime(0,0,0,$month,$i,$year))==6)//�жϸ����Ƿ�������
    {
        echo "</tr>\n";
    }
}
?>
          </table></td>
        </tr>
        </table></td>
  </tr>
  <tr>
    <td><img height="13" src="image/findBtm.gif" width="179"></td>
  </tr>
</table>
