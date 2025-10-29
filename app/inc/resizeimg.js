function resizeImages(cfg_body_width) { 
if(document.getElementById("con")) {
var table_obj   = document.getElementById("con");
var width_value = table_obj.offsetWidth||table_obj.clientWidth;
if(width_value>(cfg_body_width-400)) width_value=cfg_body_width-400; 
else width_value=width_value-400;
var areaImages = document.getElementById("con").getElementsByTagName("img"); 
var areaImagesCount = areaImages.length; 
var w = 0; 
for(var i=0;i<areaImagesCount;i++) { 
if(areaImages[i].width>width_value){ 
w = areaImages[i].width ; 
h = areaImages[i].height ;
areaImages[i].width = width_value; 
areaImages[i].height = h*width_value/w; 
if(areaImages[i].align=="")     areaImages[i].align="left"; 
if(areaImages[i].hspace=="")    areaImages[i].hspace="5"; 
if(areaImages[i].vspace=="")  areaImages[i].vspace="5"; 
   } 
  } 
 }
}
