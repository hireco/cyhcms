<!---top---><style>
IMG {
	BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px
}
.focus_img {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
#au {
	FILTER: progid:DXImageTransform.Microsoft.Fade(enabled=ture,overlap=1.0); WIDTH: {width}px; HEIGHT: {height}px
}
#au IMG {
	WIDTH: {width}px; HEIGHT: {height}px
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
		    for(var i=0;i<{num_of_pic};i++)
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
				    for(i=0;i<{num_of_pic};i++)i==value?children[i].style.display="block":children[i].style.display="none"; 
				    filters[0].play(); 		
			    }
		    }
		    catch(e)
		    {
			    var d = document.getElementById("au").getElementsByTagName("div");
			    for(i=0;i<{num_of_pic};i++) i==value?d[i].style.display="block":d[i].style.display="none"; 
		    }
	    }
	    function clearAuto(){clearInterval(autoStart)}
	    function setAuto(){autoStart=setInterval("auto(n)", 5000)}
	    function auto()
	    {
		    n++;
		    if(n>({num_of_pic}-1))  n=0;
		    Mea(n);
	    } 
        setAuto();
    </SCRIPT>
<DIV class=focus_img>
      <DIV id=au>
	   {string}
	  </DIV>
      <DIV id=No>
	   {string1}
	  </DIV>
</DIV>