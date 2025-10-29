<SCRIPT language=javascript>
	var screen=false;i=0;width=0;
	function  FxDownWindow()
	{   var img = document.getElementById('menuImg');
		if(screen==false)
		{
			parent.topwin.cols='0,8,*';
			screen=true;		img.src='image/FOpen.gif';
		}
		else if(screen==true)
		{
			parent.topwin.cols='169,8,*';
			screen=false;	    img.src='image/FClose.gif';
		}
	}	
</SCRIPT>
<meta http-equiv="Refresh" content="60">
<body topmargin="0" leftmargin="0" bgcolor="#EFEBEF">

<table border="1" cellspacing="0" style="CURSOR: hand; border-collapse:collapse" width="100%" cellpadding="0" height="100%">
  <tr>
    <td width="80%" onclick=FxDownWindow() title=È«ÆÁ/°ëÆÁ><img id=menuImg src="image/FClose.gif" width="8" height="100" align="absmiddle"></td>
  </tr>
</table>


