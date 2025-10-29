// JavaScript Document
function ShowItem1(){
  ShowObj('head1'); ShowObj('needset'); HideObj('head2'); HideObj('adset');
}

function ShowItem2(){
  ShowObj('head2'); ShowObj('adset'); HideObj('head1'); HideObj('needset');
}

function ShowObj(objname){
   var obj = $Obj(objname);
   obj.style.display = "block";
}

function HideObj(objname){
   var obj = $Obj(objname);
   obj.style.display = "none";
}

function $Obj(objname){
	return document.getElementById(objname);
}

function ShowColor(){
	var fcolor=showModalDialog("scripts/color.htm?ok",false,"dialogWidth:107px;dialogHeight:137px;status:0;dialogTop:"+(window.event.clientY+120)+";dialogLeft:"+(window.event.clientX));
	if(fcolor!=null && fcolor!="undefined") document.form1.title_color.value = fcolor;
}
function $Nav(){
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
  else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
  else return "OT";
}
function OpenMywin(inc_url){
   if($Nav()=='IE'){ var posLeft = window.event.clientX-200; var posTop = window.event.clientY-50; }
   else{ var posLeft = 100; var posTop = 100; }
   window.open(inc_url, "popUpImagesWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=400,left="+posLeft+", top="+posTop);
}

function OpenMywin_wider(inc_url){
   if($Nav()=='IE'){ var posLeft = window.event.clientX-200; var posTop = window.event.clientY-50; }
   else{ var posLeft = 100; var posTop = 100; }
   window.open(inc_url, "popUpImagesWin", "scrollbars=yes,resizable=yes,statebar=no,width=800,height=400,left="+posLeft+", top="+posTop);
}
function PutSource(str){
	var osource = window.opener.document.form1.source_input;
	if(osource) osource.value = str;
	window.close();
}

function PutWriter(str){
	var owriter = window.opener.document.form1.writer_input;
	if(owriter) owriter.value = str;
	window.close();
}
function CkRemote_Local(ckname1,fname1,fname2,ckname2){
	var ckBox1 = $Obj(ckname1); ckBox2 = $Obj(ckname2); 
	if(ckBox1.checked) {HideObj(fname1); ShowObj(fname2); ckBox2.checked=false;}  
	else  {
		 if(ckBox2.checked)  { HideObj(fname2); ShowObj(fname1); ckBox1.checked=false;}
	     else { ShowObj(fname2); ShowObj(fname1); ckBox1.checked=false; ckBox2.checked=false; }
	  }
}

function SeePic(img,f){
   if ( f.value != "" ) { img.src = f.value; }
}

function SelectImage(fname,stype){
   if($Nav()=='IE'){ var posLeft = window.event.clientX-100; var posTop = window.event.clientY; }
   else{ var posLeft = 100; var posTop = 100; }
   window.open("../file_do/select_images.php?f="+fname+"&imgstick="+stype, "popUpImagesWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=400,left="+posLeft+", top="+posTop);
}


    var maxWidth=160; 
	var maxHeight=100;
    function reload_pic(main_pic) {
    var imageArr=document.getElementById(main_pic);
    var imageRate = imageArr.offsetWidth / imageArr.offsetHeight;    
    
    if(imageArr.offsetWidth > maxWidth)
    {
        imageArr.style.width=maxWidth + "px";
        imageArr.style.Height=maxWidth / imageRate + "px";
    }
    
    if(imageArr.offsetHeight > maxHeight)
    {
        imageArr.style.width = maxHeight * imageRate + "px";
        imageArr.style.Height = maxHeight + "px";
    }
 }
