<?php 
 /*此级别是模仿新浪的爱问级别制定的 
级别         积分             （星数） 
新手         300分以下        （1） 
学生         301—350分       （2） 
学长         351—500分       （3） 
学者         501—1000分      （4） 
大师         1001—2000分     （5） 
智者         2001—3000分     （6） 
圣人         3001—5000分     （7） 
先知         5001－8000分     （8） 
风神         8001－10000分    （9） 
真人         10001—13000分   （10） 
飞仙         13001—15000分   （11） 
天尊         15001～20000分   （12） 
文曲星       20001～30000分   （13） 
紫薇星       30001分以上      （14）
*/
$score_level['0']=0;
$score_level['1']=300;
$score_level['2']=301;
$score_level['3']=350;
$score_level['4']=351;
$score_level['5']=500;
$score_level['6']=501;
$score_level['7']=1000;
$score_level['8']=1001;
$score_level['9']=2000;
$score_level['10']=2001;
$score_level['11']=3000;
$score_level['12']=3001;
$score_level['13']=5000;
$score_level['14']=5001;
$score_level['15']=8000;
$score_level['16']=8001;
$score_level['17']=10000;
$score_level['18']=10001;
$score_level['19']=13000;
$score_level['20']=13001;
$score_level['21']=15000;
$score_level['22']=15001;
$score_level['23']=20000;
$score_level['24']=20001;
$score_level['25']=30000;
$score_level['26']=30001; 

$score_title['0']="新手";
$score_title['1']="学生";
$score_title['2']="学长";
$score_title['3']="学者";
$score_title['4']="大师";
$score_title['5']="智者";
$score_title['6']="圣人";
$score_title['7']="先知";
$score_title['8']="风神";
$score_title['9']="真人";
$score_title['10']="飞仙";
$score_title['11']="天尊";
$score_title['12']="文曲星";
$score_title['13']="紫薇星";

function  get_user_title($score) {
 global $score_title;
 global $score_level;
 for($i=0;$i<=25;$i=$i+2){
   if(($score>=$score_level[$i])&&($score<=$score_level[$i+1])) break; 
   else continue;
  }
 return $score_title[$i/2];
}
?>
