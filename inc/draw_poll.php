<?php 
         $sideedge=$_REQUEST['sideedge'];
		 $k=$_REQUEST['k'];
		 $height_bar=$_REQUEST['height_bar'];
		 $interval=$_REQUEST['interval'];
		 $width_bar=$_REQUEST['width_bar'];
		 $width=$_REQUEST['width'];
		
		 $red=split(",","255,255,255,0,0,0,255"); $green=split(",","0,166,255,255,255,0,0");  $blue=split(",","0,0,0,0,255,255,255");  
		
		 $im=imagecreate($width, $height_bar); 
		 $bgcolor=imagecolorallocate($im, 192,192,192); 
		 $fontcolor=imagecolorallocate($im, 0,0,0); 
		 $edgecolor=imagecolorallocate($im, 155,130,230);
		 
		 
		 imagefilledrectangle($im,1,1, $width-2*sideedge,$height_bar, $bgcolor); 
		 imagerectangle($im,0,0,$width-2*sideedge-1,$height_bar-1,$edgecolor); 
		 $ftcolor=imagecolorallocate($im,$red[$k],$green[$k],$blue[$k]);
		 imagefilledrectangle($im,1,1, $width_bar,$height_bar-1, $ftcolor); 
		 
		
		 header("content-type: image/jpeg");
		 imagejpeg($im); imagedestroy($im);
?>
