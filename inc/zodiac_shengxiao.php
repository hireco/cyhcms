<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
// һ�����������ĺ���
/* 
* string get_zodiac_sign(string month, string day) 
* ���룺�·ݣ����� 
* ������������ƻ��ߴ��� 
*/
function get_zodiac_sign($month, $day) 
{ 
// ��������Ч�� 
if ($month < 1 || $month > 12 || $day < 1 || $day > 31) 
return (false);

// ���������Լ���ʼ���� 
$signs = array( 
array( "20" => "ˮƿ��"), 
array( "19" => "˫����"), 
array( "21" => "������"), 
array( "20" => "��ţ��"), 
array( "21" => "˫����"), 
array( "22" => "��з��"), 
array( "23" => "ʨ����"), 
array( "23" => "��Ů��"), 
array( "23" => "�����"), 
array( "24" => "��Ы��"), 
array( "22" => "������"), 
array( "22" => "Ħ����") 
); 
list($sign_start, $sign_name) = each($signs[(int)$month-1]); 
if ($day < $sign_start) 
list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]); 
return $sign_name;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
* ���������е����������������Ф
* 
* @param int $birth_year
* @return string
*/
function get_animal($birth_year)
{
$animal = array(
      '����','��ţ','����','î��','����','����',
      '����','δ��','���','�ϼ�','�繷','����'
      );

$my_animal = ($birth_year-1900)%12;
return $animal[$my_animal];
}

?>

