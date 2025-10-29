<?php 
$num_of_pic=5;
$flash_style="kuan";
$width=320-0;
$height=181-0;
$string="pics=http://202.38.220.102/upload/image/090413/154243970.jpg|http://202.38.220.102/upload/image/090413/154243308.jpg|http://202.38.220.102/upload/image/090413/154243653.jpg|http://202.38.220.102/upload/image/090413/154243735.jpg|http://202.38.220.102/upload/image/090413/154243345.jpg&links=http://202.38.220.102/show_album.php?id=1|http://202.38.220.102/show_album.php?id=3|http://202.38.220.102/show_album.php?id=2|http://202.38.220.102/show_album.php?id=4|http://202.38.220.102/show_album.php?id=4&texts=1|2|3|4|5";
?>
<!---top---><style>
IMG {
	BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px
}
.focus_img {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
#au {
	FILTER: progid:DXImageTransform.Microsoft.Fade(enabled=ture,overlap=1.0); WIDTH: 320px; HEIGHT: 181px
}
#au IMG {
	WIDTH: 320px; HEIGHT: 181px
}
#No {
	MARGIN-TOP: -20px; Z-INDEX: 1; LEFT: <?php echo $width-$num_of_pic*25;?>px; POSITION: relative
}
#No SPAN {
	BORDER-RIGHT: #fff 1px solid; PADDING-RIGHT: 3px; BORDER-TOP: #fff 1px solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 0px; BORDER-LEFT: #fff 1px solid; PADDING-TOP: 0px; BORDER-BOTTOM: #fff 1px solid
}
.bbg1 {
	BACKGROUND: #cb1800; CURSOR: hand; COLOR: #fff
}
.bbg0 {
	CURSOR: hand; COLOR: #fff
}
</style>
<SCRIPT type=text/javascript>
	    var n=0;
	    function Mea(value)
	    {
		    n=value;
		    setBg(value);
		    plays(value);
	    }
	    function setBg(value)
	    {
		    for(var i=0;i<5;i++)
			    document.getElementById("t"+i+"").className="bbg0";
		    document.getElementById("t"+value+"").className="bbg1";
	    } 
	    function plays(value)
	    {
		    try
		    {
			    with (au)
			    {
				    filters[0].Apply();
				    for(i=0;i<5;i++)i==value?children[i].style.display="block":children[i].style.display="none"; 
				    filters[0].play(); 		
			    }
		    }
		    catch(e)
		    {
			    var d = document.getElementById("au").getElementsByTagName("div");
			    for(i=0;i<5;i++) i==value?d[i].style.display="block":d[i].style.display="none"; 
		    }
	    }
	    function clearAuto(){clearInterval(autoStart)}
	    function setAuto(){autoStart=setInterval("auto(n)", 5000)}
	    function auto()
	    {
		    n++;
		    if(n>(5-1))  n=0;
		    Mea(n);
	    } 
        setAuto();
    </SCRIPT>
<DIV class=focus_img>
      <DIV id=au>
	    <DIV style="DISPLAY: block"><A href="http://202.38.220.102/show_album.php?id=1" target=_blank><IMG  alt="1"  src="http://202.38.220.102/upload/image/090413/154243970.jpg"></A></DIV>
 <DIV style="DISPLAY: none"><A href="http://202.38.220.102/show_album.php?id=3" target=_blank><IMG  alt="2"  src="http://202.38.220.102/upload/image/090413/154243308.jpg"></A></DIV>
 <DIV style="DISPLAY: none"><A href="http://202.38.220.102/show_album.php?id=2" target=_blank><IMG  alt="3"  src="http://202.38.220.102/upload/image/090413/154243653.jpg"></A></DIV>
 <DIV style="DISPLAY: none"><A href="http://202.38.220.102/show_album.php?id=4" target=_blank><IMG  alt="4"  src="http://202.38.220.102/upload/image/090413/154243735.jpg"></A></DIV>
 <DIV style="DISPLAY: none"><A href="http://202.38.220.102/show_album.php?id=4" target=_blank><IMG  alt="5"  src="http://202.38.220.102/upload/image/090413/154243345.jpg"></A></DIV>

	  </DIV>
      <DIV id=No>
	    <SPAN class=bbg1 id=t0 onmouseover=Mea(0);clearAuto(); onmouseout=setAuto()>1</SPAN>
 <SPAN class=bbg0 id=t1 onmouseover=Mea(1);clearAuto(); onmouseout=setAuto()>2</SPAN>
 <SPAN class=bbg0 id=t2 onmouseover=Mea(2);clearAuto(); onmouseout=setAuto()>3</SPAN>
 <SPAN class=bbg0 id=t3 onmouseover=Mea(3);clearAuto(); onmouseout=setAuto()>4</SPAN>
 <SPAN class=bbg0 id=t4 onmouseover=Mea(4);clearAuto(); onmouseout=setAuto()>5</SPAN>

	  </DIV>
</DIV>