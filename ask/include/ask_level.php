<?php 
 /*�˼�����ģ�����˵İ��ʼ����ƶ��� 
����         ����             �������� 
����         300������        ��1�� 
ѧ��         301��350��       ��2�� 
ѧ��         351��500��       ��3�� 
ѧ��         501��1000��      ��4�� 
��ʦ         1001��2000��     ��5�� 
����         2001��3000��     ��6�� 
ʥ��         3001��5000��     ��7�� 
��֪         5001��8000��     ��8�� 
����         8001��10000��    ��9�� 
����         10001��13000��   ��10�� 
����         13001��15000��   ��11�� 
����         15001��20000��   ��12�� 
������       20001��30000��   ��13�� 
��ޱ��       30001������      ��14��
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

$score_title['0']="����";
$score_title['1']="ѧ��";
$score_title['2']="ѧ��";
$score_title['3']="ѧ��";
$score_title['4']="��ʦ";
$score_title['5']="����";
$score_title['6']="ʥ��";
$score_title['7']="��֪";
$score_title['8']="����";
$score_title['9']="����";
$score_title['10']="����";
$score_title['11']="����";
$score_title['12']="������";
$score_title['13']="��ޱ��";

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
