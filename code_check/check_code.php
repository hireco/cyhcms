<?php
session_start(); 
$im=imagecreatefromjpeg("code.jpeg");
$color[0]=imagecolorallocate($im,255,0,9);
$color[1]=imagecolorallocate($im,0,0,0);
$color[2]=imagecolorallocate($im,0,0,255);
$ttf[0]="ariali.ttf";
$ttf[1]="comic.ttf";
$ttf[2]="lucon.ttf";
$temp=explode(",", $_SESSION['result_string']);
for($i=0;$i<=4;$i++)
{ $chr=$temp[$i]; $fontsize=rand(15,20);
  imagettftext($im,$fontsize, $i*5, 20*$i+5, 25, $color[$i%3], $ttf[$i%3],$chr);
 }
for($i=0;$i<=20;$i++) {
$x1=rand(1,80);$y1=rand(1,30);
imageline($im,$x1,$y1,$x1+1, $y1+1,$color[$i/3]);
 }
header("content-type: image/jpeg");
imagejpeg($im);
imagedestroy($im);


?> 


