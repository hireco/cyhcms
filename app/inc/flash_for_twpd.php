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
  
  {string}
  
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="{width}" height="{height}" id="01" align="middle">')
  document.write('<param name="allowScriptAccess" value="sameDomain" />')
  document.write('<param name="movie" value="inc/01.swf?info='+varText+'" />')
  document.write('<param name="quality" value="high" />')
  document.write('<param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent" />')
  document.write('<embed src="inc/01.swf" quality="high" bgcolor="#ffffff" width="{width}" height="{height}" name="01" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />')
  document.write('</object>')
</SCRIPT>
