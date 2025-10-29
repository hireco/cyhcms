<?php 
$num_of_pic=5;
$flash_style="twpd";
$width=410-105;
$height=200-0;
$string="pics=http://202.38.220.102/upload/album/090413/161757185.jpg|http://202.38.220.102/upload/album/090413/161755630.jpg|http://202.38.220.102/upload/album/090413/161749911.jpg|http://202.38.220.102/upload/album/090413/161748100.jpg|http://202.38.220.102/upload/album/090413/161746694.jpg&links=./|./|./|./|./&texts=1|2|3|4|5";
?>
<!---top---><SCRIPT>

  var varText = ""
  function addInfo(title,photourl,link){
    if(varText!=""){
        varText+="|||";
    }
    varText+=title+"|_|"+photourl+"|_|"+link;
  }
  
  
linkarr = new Array();
picarr = new Array();
textarr = new Array();
  
   
linkarr[1] = "./";
picarr[1] = "http://202.38.220.102/upload/album/090413/161757185.jpg";
textarr[1] = "1";
addInfo(textarr[1],picarr[1],linkarr[1]);
 
linkarr[2] = "./";
picarr[2] = "http://202.38.220.102/upload/album/090413/161755630.jpg";
textarr[2] = "2";
addInfo(textarr[2],picarr[2],linkarr[2]);
 
linkarr[3] = "./";
picarr[3] = "http://202.38.220.102/upload/album/090413/161749911.jpg";
textarr[3] = "3";
addInfo(textarr[3],picarr[3],linkarr[3]);
 
linkarr[4] = "./";
picarr[4] = "http://202.38.220.102/upload/album/090413/161748100.jpg";
textarr[4] = "4";
addInfo(textarr[4],picarr[4],linkarr[4]);
 
linkarr[5] = "./";
picarr[5] = "http://202.38.220.102/upload/album/090413/161746694.jpg";
textarr[5] = "5";
addInfo(textarr[5],picarr[5],linkarr[5]);

  
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="410" height="200" id="01" align="middle">')
  document.write('<param name="allowScriptAccess" value="sameDomain" />')
  document.write('<param name="movie" value="inc/01.swf?info='+varText+'" />')
  document.write('<param name="quality" value="high" />')
  document.write('<param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent" />')
  document.write('<embed src="inc/01.swf" quality="high" bgcolor="#ffffff" width="410" height="200" name="01" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />')
  document.write('</object>')
</SCRIPT>
