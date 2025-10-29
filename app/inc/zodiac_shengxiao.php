<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
// 一个计算星座的函数
/* 
* string get_zodiac_sign(string month, string day) 
* 输入：月份，日期 
* 输出：星座名称或者错误 
*/
function get_zodiac_sign($month, $day) 
{ 
// 检查参数有效性 
if ($month < 1 || $month > 12 || $day < 1 || $day > 31) 
return (false);

// 星座名称以及开始日期 
$signs = array( 
array( "20" => "水瓶座"), 
array( "19" => "双鱼座"), 
array( "21" => "白羊座"), 
array( "20" => "金牛座"), 
array( "21" => "双子座"), 
array( "22" => "巨蟹座"), 
array( "23" => "狮子座"), 
array( "23" => "处女座"), 
array( "23" => "天秤座"), 
array( "24" => "天蝎座"), 
array( "22" => "射手座"), 
array( "22" => "摩羯座") 
); 
list($sign_start, $sign_name) = each($signs[(int)$month-1]); 
if ($day < $sign_start) 
list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]); 
return $sign_name;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
* 根据生日中的年份来计算所属生肖
* 
* @param int $birth_year
* @return string
*/
function get_animal($birth_year)
{
$animal = array(
      '子鼠','丑牛','寅虎','卯兔','辰龙','巳蛇',
      '午马','未羊','申猴','酉鸡','戌狗','亥猪'
      );

$my_animal = ($birth_year-1900)%12;
return $animal[$my_animal];
}

?>

