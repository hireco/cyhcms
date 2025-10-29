var auto_close_hand;
var auto_close_hand1;
var auto_close_hand2;
var is_opera_d  = (navigator.userAgent.toLowerCase().indexOf('opera') != -1);
String.prototype.trim = function()
{
	return this.replace(/(^[ |　]*)|([ |　]*$)/g, "");
}
function $(s)
{
	if(document.getElementById)
	{
		return eval('document.getElementById("' + s + '")');
	}
	else
	{
		return eval('document.all.' + s);
	}
}
function $$(s)
{
	return document.frames?document.frames[s]:$(s).contentWindow;
}
function $c(s)
{
	return document.createElement(s);
}
function swap(s,a,b,c)
{
	$(s)[a]=$(s)[a]==b?c:b;
}
function exist(s)
{
	return $(s)!=null;
}
function dw(s)
{
	document.write(s);
}
function hide(s)
{
	$(s).style.display=$(s).style.display=="none"?"":"none";
}
function isNull(_sVal)
{
	return (_sVal == "" || _sVal == null || _sVal == "undefined");
}
function removeNode(s)
{
	if(exist(s))
	{
		$(s).innerHTML = '';
		$(s).removeNode?$(s).removeNode():$(s).parentNode.removeChild($(s));
	}
}

function dialog()
{
	var titile = '';
	var auto = 'y';
	var width = 240;
	var height = 120;
	var src = "";
	var path = "http://www.sinaimg.cn/pfp/ask/images/zhishi/";
	var sFunc = '<input id="dialogOk" type="button" value=" 确 定 " onclick="new dialog().reset();" /> <input id="dialogCancel" type="button" value=" 取 消 " onclick="new dialog().reset();" />';
	var sClose = '<input type="image" id="dialogBoxClose" onclick="new dialog().reset();" src="' + path + 'close_blue.gif" border="0" width="16" height="16" align="absmiddle" />';
	var sBody = '\
		<table id="dialogBodyBox" border="0" align="center" cellpadding="0" cellspacing="6" width="100%">\
			<tr height="10"><td colspan="4"></td></tr>\
			<tr><td colspan="4" align="center">\
			<div id="dialogMsgDiv" style="text-align:center"><div id="dialogMsg" style="font-size:12px;line-height:180%;"></div></div>\
			</td></tr>\
			<tr><td id="dialogFunc" colspan="4" align="center">' + sFunc + '</td></tr>\
			<tr height="5"><td colspan="4" align="center"></td></tr>\
		</table>\
	';
	var sIfram = '\
		<iframe id="dialogIframBG" name="dialogIframBG" frameborder="0" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="no" style="position:absolute;z-index:8;display:none;"></iframe>\
	';

	var sBox = '\
		<div id="dialogBox" style="border:1px solid #1e4775;display:none;z-index:10;width:'+width+'px;">\
		<table width="100%" border="0" cellpadding="0" cellspacing="0">\
			<tr height="24" bgcolor="#6795B4">\
				<td>\
					<table onselectstart="return false;" style="-moz-user-select:none;" width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#5499dc;  height:25px; border-top:1px solid #92c3ec;">\
						<tr>\
							<td width="6" height="24"></td>\
							<td id="dialogBoxTitle" onmousedown="new dialog().moveStart(event, \'dialogBox\')" style="color:#fff;cursor:move;font-size:12px;font-weight:bold;">&nbsp;</td>\
							<td id="dialogClose" width="20" align="right" valign="middle">\
								' + sClose + '\
							</td>\
							<td width="6"></td>\
						</tr>\
					</table>\
				</td>\
			</tr>\
			<tr id="dialogHeight" style="height:' + height + '" valign="top">\
				<td id="dialogBody" bgcolor="#ffffff">' + sBody + '</td>\
			</tr>\
		</table></div>\
		<div id="dialogBoxShadow" style="display:none;z-index:9;"></div>\
	';
	var sBG = '\
		<div id="dialogBoxBG" style="position:absolute;top:0px;left:0px;width:100%;height:100%;"></div>\
	';

	this.show = function()
	{
		this.middle('dialogBox');
		if ($('dialogIframBG'))
		{
			$('dialogIframBG').style.top = $('dialogBox').style.top;
			$('dialogIframBG').style.left = $('dialogBox').style.left;
			$('dialogIframBG').style.width = $('dialogBox').offsetWidth;
			$('dialogIframBG').style.height = $('dialogBox').offsetHeight;
			$('dialogIframBG').style.display = 'block';
		}		
		this.shadow();
	}

	this.reset = function()
	{
		this.close();
	}

	this.close = function()
	{
		if ($('dialogIframBG'))
		{
			$('dialogIframBG').style.display = 'none';
		}
		$('dialogBox').style.display='none';
		$('dialogBoxBG').style.display='none';
		$('dialogBoxShadow').style.display = "none";
		$('dialogBody').innerHTML = sBody;
	}
	this.html = function(_sHtml)
	{
		$("dialogBody").innerHTML = _sHtml;
		this.show();
	}

	this.init = function(big_msg)
	{
		$('dialogCase') ? $('dialogCase').parentNode.removeChild($('dialogCase')) : function(){};
		var oDiv = document.createElement('span');
		oDiv.id = "dialogCase";
		if ('yes' == big_msg)
		{
			oDiv.innerHTML = sBG + sBox;
		}
		else
		{
			if (!is_opera_d)
			{
				oDiv.innerHTML = sBG + sIfram + sBox;
			}
			else
			{
				oDiv.innerHTML = sBG + sBox;
			}
		}
		document.body.appendChild(oDiv);
		$('dialogBoxBG').style.height = document.body.scrollHeight;
	}

	this.button = function(_sId, _sFuc)
	{
		if($(_sId))
		{
			$(_sId).style.display = '';
			if($(_sId).addEventListener)
			{
				if($(_sId).act)
				{
					$(_sId).removeEventListener('click', function(){eval($(_sId).act)}, false);
				}
				$(_sId).act = _sFuc;
				$(_sId).addEventListener('click', function(){eval(_sFuc)}, false);
			}
			else
			{
				if($(_sId).act)
				{
					$(_sId).detachEvent('onclick', function(){eval($(_sId).act)});
				}
				$(_sId).act = _sFuc;
				$(_sId).attachEvent('onclick', function(){eval(_sFuc)});
			}
		}
	}

	this.shadow = function()
	{
		var oShadow = $('dialogBoxShadow');
		var oDialog = $('dialogBox');
		oShadow['style']['position'] = "absolute";
		oShadow['style']['background']	= "#000";
		oShadow['style']['display']	= "";
		oShadow['style']['opacity']	= "0.2";
		oShadow['style']['filter'] = "alpha(opacity=20)";
		oShadow['style']['top'] = oDialog.offsetTop + 6;
		oShadow['style']['left'] = oDialog.offsetLeft + 6;
		oShadow['style']['width'] = oDialog.offsetWidth;
		oShadow['style']['height'] = oDialog.offsetHeight;
	}

	this.open = function(_sUrl, _sMode)
	{
		this.show();
		if(!_sMode || _sMode == "no" || _sMode == "yes"){
			var openIframe = "<iframe width='100%' height='100%' name='iframe_parent' id='iframe_parent' src='" + _sUrl + "' frameborder='0' scrolling='" + _sMode + "'></iframe>";
			$("dialogBody").innerHTML = openIframe;
		}
	}

	this.showWindow = function(_sUrl, _iWidth, _iHeight, _sMode)
	{
		var oWindow;
		var sLeft = (screen.width) ? (screen.width - _iWidth)/2 : 0;
		var iTop = -80 + (screen.height - _iHeight)/2;
		iTop = iTop > 0 ? iTop : (screen.height - _iHeight)/2;
		var sTop = (screen.height) ? iTop : 0;
		if(window.showModalDialog && _sMode == "m"){
			oWindow = window.showModalDialog(_sUrl,"","dialogWidth:" + _iWidth + "px;dialogheight:" + _iHeight + "px");
		} else {
			oWindow = window.open(_sUrl, '', 'height=' + _iHeight + ', width=' + _iWidth + ', top=' + sTop + ', left=' + sLeft + ', toolbar=no, menubar=no, scrollbars=' + _sMode + ', resizable=no,location=no, status=no');
			this.reset();
		}
	}

	this.event = function(_sMsg, _sOk, _sCancel, _sClose)
	{
		$('dialogFunc').innerHTML = sFunc;
		$('dialogClose').innerHTML = sClose;
		$('dialogBodyBox') == null ? $('dialogBody').innerHTML = sBody : function(){};
		if (width > 400 && height > 300)
		{
			$('dialogMsg') ? $('dialogMsg').innerHTML = _sMsg  : function(){};
			$('dialogMsg') ? $('dialogMsg')['style']['fontWeight'] = "bold" : function(){};
			$('dialogMsg') ? $('dialogMsg')['style']['fontSize'] = "15px" : function(){};
			$('dialogMsg') ? $('dialogMsg')['style']['color'] = "#ff9900" : function(){};
			$('dialogMsg') ? $('dialogMsg')['style']['height'] = "150px" : function(){};
		}
		else
		{
			$('dialogMsg') ? $('dialogMsg').innerHTML = _sMsg  : function(){};
		}

		_sOk && _sOk != "" ? this.button('dialogOk', _sOk) : $('dialogOk').style.display = 'none';
		_sCancel && _sCancel != "" ? this.button('dialogCancel', _sCancel) : $('dialogCancel').style.display = 'none';
		_sClose ? this.button('dialogBoxClose', _sClose) : function(){};

		this.show();
	}
	this.set = function(_oAttr, _sVal)
	{
		var oShadow = $('dialogBoxShadow');
		var oDialog = $('dialogBox');
		var oHeight = $('dialogHeight');

		if(_sVal != '')
		{
			switch(_oAttr)
			{
				case 'title':
					$('dialogBoxTitle').innerHTML = _sVal;
					title = _sVal;
					break;
				case 'width':
					oDialog['style']['width'] = _sVal;
					width = _sVal;
					break;
				case 'height':
					oHeight['style']['height'] = _sVal;
					height = _sVal;
					break;
				case 'src':
					$('dialogMsgDiv').innerHTML = '\
						<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">\
							<tr>\
								<td width="30%" align="center"><img id="dialogBoxFace" src="' + path + 'login_wrong.gif" /></td>\
								<td id="dialogMsg" style="font-size:12px;line-height:180%;" width="70%"></td>\
							</tr>\
						</table>\
					';
					$('dialogBoxFace') ? $('dialogBoxFace').src = path + _sVal + '.gif' : function(){};
					src = _sVal;
					break;
				case 'auto':
					auto = _sVal;
			}
		}
		this.middle('dialogBox');
		oShadow['style']['top'] = oDialog.offsetTop + 6;
		oShadow['style']['left'] = oDialog.offsetLeft + 6;
		oShadow['style']['width'] = oDialog.offsetWidth;
		oShadow['style']['height'] = oDialog.offsetHeight;
	}

	this.moveStart = function (event, _sId)
	{
		var oObj = $(_sId);
		oObj.onmousemove = mousemove;
		oObj.onmouseup = mouseup;
		oObj.setCapture ? oObj.setCapture() : function(){};
		oEvent = window.event ? window.event : event;
		var dragData = {x : oEvent.clientX, y : oEvent.clientY};
		var backData = {x : parseInt(oObj.style.top), y : parseInt(oObj.style.left)};
		function mousemove()
		{
			var oEvent = window.event ? window.event : event;
			var iLeft = oEvent.clientX - dragData["x"] + parseInt(oObj.style.left);
			var iTop = oEvent.clientY - dragData["y"] + parseInt(oObj.style.top);
			oObj.style.left = iLeft;
			oObj.style.top = iTop;
			$('dialogBoxShadow').style.left = iLeft + 6;
			$('dialogBoxShadow').style.top = iTop + 6;
			if ($('dialogIframBG'))
			{
				$('dialogIframBG').style.left = iLeft;
				$('dialogIframBG').style.top = iTop;
			}
			dragData = {x: oEvent.clientX, y: oEvent.clientY};

		}
		function mouseup()
		{
			var oEvent = window.event ? window.event : event;
			oObj.onmousemove = null;
			oObj.onmouseup = null;
			if(oEvent.clientX < 1 || oEvent.clientY < 1 || oEvent.clientX > document.body.clientWidth || oEvent.clientY > document.body.clientHeight){
				oObj.style.left = backData.y;
				oObj.style.top = backData.x;
				$('dialogBoxShadow').style.left = backData.y + 6;
				$('dialogBoxShadow').style.top = backData.x + 6;
				if ($('dialogIframBG'))
				{
					$('dialogIframBG').style.left = backData.y;
					$('dialogIframBG').style.top = backData.x;
				}
			}
			oObj.releaseCapture ? oObj.releaseCapture() : function(){};
		}
	}

	this.hideModule = function(_sType, _sDisplay)
	{
		var aIframe = parent.document.getElementsByTagName("iframe");
		var aType = document.getElementsByTagName(_sType);
		var iChildObj, iChildLen;
		for (var i = 0; i < aType.length; i++)
		{
			aType[i].style.display	= _sDisplay;
		}
		for (var j = 0; j < aIframe.length; j++)
		{
			iChildObj = document.frames ? document.frames[j] : aIframe[j].contentWindow;
			try
			{
				iChildLen = iChildObj.document.body.getElementsByTagName(_sType).length;
				for (var k = 0; k < iChildLen; k++)
				{
					iChildObj.document.body.getElementsByTagName(_sType)[k].style.display = _sDisplay;
				}
			}
			catch (e){}
		}
	}

	this.middle = function(_sId)
	{
		try
		{
			var aIframe = parent.document.getElementById("iframe_parent");
		}
		catch (e){}
		if (aIframe) {
			var sClientWidth = aIframe.offsetWidth;
			var sClientHeight = aIframe.offsetHeight;
			var sScrollTop = 0;
		} else {
			var sClientWidth = parent ? parent.document.body.clientWidth : document.body.clientWidth;
			var sClientHeight = parent ? parent.document.body.clientHeight : document.body.clientHeight;
			var sScrollTop = parent ? parent.document.body.scrollTop : document.body.scrollTop;
		}
		var sleft = (document.body.clientWidth / 2) - ($(_sId).offsetWidth / 2);
		var iTop = -80 + (sClientHeight / 2 + sScrollTop) - ($(_sId).offsetHeight / 2);
		var sTop = iTop > 0 ? iTop : (sClientHeight / 2 + sScrollTop) - ($(_sId).offsetHeight / 2);
		$(_sId)['style']['display'] = '';
		$(_sId)['style']['position'] = "absolute";
		$(_sId)['style']['left'] = sleft;
		$(_sId)['style']['top'] = sTop;
	}
}
function _error_msg_show(msg, click, icon, title)
{
    click = click ? click : ' ';
    icon = icon ? icon : '';
    title = title ? title : '爱问知识人提示';
    dg=new dialog();
    dg.init();
    dg.set('src', get_icon(icon));
    dg.set('title', title);
    dg.event(msg, click, '', click);
}

function _confirm_msg_show(msg, click_ok, click_no, title, width, height)
{
    click_ok = click_ok ? click_ok : ' ';
    click_no = click_no ? click_no : ' ';
    title = title ? title : '爱问知识人提示';

    dg=new dialog();
    dg.init();
    dg.set('src', get_icon(''));
    dg.set('title', title);
	if (width)
    {
        dg.set('width', width);
    }
    if (height)
    {
        dg.set('height', height);
    }
    dg.event(msg, click_ok, click_no, click_no);
	$("dialogOk").value="继续提交";
	$("dialogCancel").value="我要修改";
}

function _set_id_focus(idname)
{
	if (idname != "")
	{
		try {$(idname).focus();}catch (e){}
	}
}

function get_icon(icons)
{
	var icon = 'login_wrong';
	return icon;
}
function openWindow(_sUrl, _sWidth, _sHeight, _sTitle, _sScroll, ok)
{
	if (ok == null && document.readyState != "complete")
	{
		setTimeout(function(){openWindow( _sUrl, _sWidth, _sHeight, _sTitle, _sScroll, 1);},500);
		return false;
	}
	var oEdit = new dialog();
	oEdit.init('yes');
	oEdit.set('title', _sTitle ? _sTitle : "系统提示信息" );
	oEdit.set('width', _sWidth);
	oEdit.set('height', _sHeight);
	oEdit.set('auto', 'n');
	oEdit.open(_sUrl, _sScroll != "yes" ? 'no' : 'yes');
}
function getFrameNode(sNode){
	return document.frames ? document.frames[sNode] : document.getElementById(sNode).contentWindow;
}
function strLen(key){
	var l=escape(key),len
	len=l.length-(l.length-l.replace(/\%u/g,"u").length)*4
	l=l.replace(/\%u/g,"uu")
	len=len-(l.length-l.replace(/\%/g,"").length)*2
	return len
}
function zsxz(ta, zs, maxl)
{
	var l = ta.value.length;//.replace(/[^\x00-\xff]/gi,'xx')
	if(l > maxl)
	{
		ta.value = ta.value.substring(0,maxl);
	}
	else
	{
		zs.value = maxl - l;
	}
}
//处理浏览器，用来选择不同的XML读取函数
var agt = navigator.userAgent.toLowerCase();
var is_opera = (agt.indexOf("opera") != -1);
var is_ie = (agt.indexOf("msie") != -1) && document.all && !is_opera;
var is_ie5 = (agt.indexOf("msie 5") != -1) && document.all;
var uniqnum_counter = (new Date).getTime();
var is_regexp = (window.RegExp) ? true : false;
var xmlhttp = null;

function UniqueNum() {  
	++uniqnum_counter;  
	return uniqnum_counter;
}
//创建Get请求
function StartGETRequest(url, handler)
{
	xmlhttp = null;
	if (is_ie) {    
		var control = (is_ie5) ? "Microsoft.XMLHTTP" : "Msxml2.XMLHTTP";
		try {      
			xmlhttp = new ActiveXObject(control);
		} catch(e) {
			alert("You need to enable active scripting and activeX controls");
			DumpException(e);
		}
	} else {
		xmlhttp = new XMLHttpRequest();
	}
	xmlhttp.onreadystatechange = function() {handler();}
	if (url.indexOf("?") != -1){
		var urltemp = url + "&rand=" + UniqueNum();
	} else {
		var urltemp = url + "?rand=" + UniqueNum();
	}
	//alert(urltemp);
	xmlhttp.open('GET', urltemp, true);
	
	xmlhttp.send(null);	
}
//创建POST请求
function StartPOSTRequest(url, data, handler)
{
	xmlhttp = null;
	if (is_ie) {    
		var control = (is_ie5) ? "Microsoft.XMLHTTP" : "Msxml2.XMLHTTP";
		try {      
			xmlhttp = new ActiveXObject(control);
		} catch(e) {
			alert("You need to enable active scripting and activeX controls");
			DumpException(e);
		}
	} else {
		xmlhttp = new XMLHttpRequest();
	}
	xmlhttp.onreadystatechange = function() {handler();}
	xmlhttp.open('POST', url, true);
	if (typeof(xmlhttp.setRequestHeader) != "undefined") {
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; Charset=GB2312');
	}
	xmlhttp.send(data);	
}
//处理方法
function GetObjValue(objName)
{
	if(document.getElementById){
		return eval('document.getElementById("' + objName + '")');
	}else{
		return eval('document.all.' + objName);
	}
}
function fetchObject(idname)
{
	if (document.getElementById) {
		return document.getElementById(idname);
	} else if (document.all) {
		return document.all[idname];
	} else if (document.layers) {
		return document.layers[idname];
	} else {
		return null;
	}
}
// function to emulate document.getElementsByTagName
function fetchTags(parentobj, tag)
{
	if (typeof parentobj.getElementsByTagName != 'undefined') {
		return parentobj.getElementsByTagName(tag);
	} else if (parentobj.all && parentobj.all.tags) {
		return parentobj.all.tags(tag);
	} else {
		return null;
	}
}
function fetchXmlValue(parentobj, tag)
{
	try{
		var tags = fetchTags(parentobj, tag);
		return tags[0].firstChild.nodeValue;
	} catch(e) {
		return null;
	}
}
function checkpic(this_form)
{	
	var fso,f; 
	if (this_form.upload_file.value.length > 0){
		var filesize = 1;  
		try {
			fso=new ActiveXObject("Scripting.FileSystemObject");  
   			f = fso.GetFile(this_form.upload_file.value); filesize = f.size;
		} catch (e1) {}
		if (filesize >200000 || filesize == 0) {
			_error_msg_show("文件不能为空，并且小于200K");
			return false;
		}
	}
	return true;
}
function checkForm(this_form)
{
	if ((this_form.answer.value == '') || (this_form.answer.value.length > 20000)) {
		_error_msg_show("回答的内容长度必须为1-10000个汉字！");
		this_form.answer.focus();
		return false;
	}
	if (this_form.referto.value.length > 120) {
		_error_msg_show("对不起，参考文献内容长度不能大于60个汉字！");
		this_form.referto.focus();
		return false;
	}

	return true;
}
function showSending() 
{
	document.getElementById("sending").style.visibility="visible";
	document.getElementById("cover").style.visibility="visible";
}

function on(tdbg)
{
	tdbg.style.background="#fff17d";
}

function off(tdbg)
{
	tdbg.style.background="#EFF7FE";
}

function checkLogin()
{
if (document.login.U_Loginname.value=="")
{
_error_msg_show("会员名不能为空，请输入会员名！");
document.login.U_Loginname.focus();
return false;
}
if (document.login.U_Pass.value=="")
{
_error_msg_show("密码不能为空，请输入密码！");
document.login.U_Pass.focus();
return false;
}
return true;
}
function getCommentHtmlList(qid, aid)
{
	var strText;
	var fError = false;
	if (xmlhttp.readyState == 4){
		if (xmlhttp.status == 200){			
			strText = fetchXmlValue(xmlhttp.responseXML, 'body');
			if (null == strText) {
				fError = true;
			} else {
				fetchObject("commentsec" + qid + aid).innerHTML = strText;
			}
		}else{
			fError = true;
		}
	}

	if (fError) {
		fetchObject("commentsec" + qid + aid).innerHTML = "";			
		fetchObject("comment" + qid + aid).style.display = "none";
	} else {
		fetchObject("comment" + qid + aid).scrollIntoView(true);
	}
}

function submitComment(qid, aid)
{
	var strText;
	var fnServerError = DisplayPostCommentError(qid, aid);
	if (xmlhttp.readyState == 4){
		if (xmlhttp.status == 200){
			var res = fetchXmlValue(xmlhttp.responseXML, 'result');
			strText = fetchXmlValue(xmlhttp.responseXML, 'body');
			if (null == strText) {
				fnServerError();
			} else {
				if (res.toLowerCase() == 'ok') {				
					var t_total = fetchXmlValue(xmlhttp.responseXML, 'total');
					fetchObject("commenttotal" + qid + aid).innerHTML = t_total;
					fetchObject("commentsec" + qid + aid).innerHTML = strText;
				} else {
					fetchObject("Err" + qid + aid).innerHTML = "<div><img src='http://www.sinaimg.cn/pfp/ask/images/zhishi/error_icon.gif' width=15 height=16 border=0>"+ strText +"</div>";
				}
			}
		}else{
			fnServerError();
		}
	}
}
function OpenSection(qid, aid, pages)
{
	var sectionTitleObj = fetchObject("comment" + qid + aid);
	var sectionDescObj = fetchObject("commentsec" + qid + aid);
	
	if (sectionTitleObj.style.display == 'none' || sectionTitleObj.style.display == '') {
		sectionTitleObj.style.display = "block";
	}
	try{
		if (fetchObject("commentimg" + qid + aid).src == "http://www.sinaimg.cn/pfp/i/z2/z2_zz_fbpl_da1.gif")
		{
			if (pages == null)
			{
				fetchObject("commentimg" + qid + aid).src = "http://www.sinaimg.cn/pfp/i/z2/z2_zz_fbpl_da2.gif";
				Close(qid, aid, pages);
				return ;
			}
		}
		else
		{
			fetchObject("commentimg" + qid + aid).src = "http://www.sinaimg.cn/pfp/i/z2/z2_zz_fbpl_da1.gif";
		}
	}catch(e){};
	if (pages==null && sectionDescObj.style.display == "block")
	{
		Close(qid, aid, pages);
		return ;
	}
	if (sectionDescObj.style.display == "none")
	{
		sectionDescObj.style.display = 'block';
	}
	var strA = "questionid="+ qid;
	strA += "&answerid=" + aid;
	if (pages >= 0)
		strA += "&pages=" + pages;
	StartGETRequest('/browse/zhishi_request_comment.php?'+strA, function() {getCommentHtmlList(qid, aid)});
}
function Close(qid, aid, pages)
{
	try{
		fetchObject("commentimg" + qid + aid).src = "http://www.sinaimg.cn/pfp/i/z2/z2_zz_fbpl_da2.gif";
	}catch(e){};
		fetchObject("commentsec" + qid + aid).style.display = "none";
}
function CloseComment(qid, aid)
{
	if (fetchObject("err"+ qid + aid) != null) {
		fetchObject("Err"+qid + aid).innerHTML = "";
		fetchObject("txtComment"+qid + aid).value = "";
	}
	Close(qid, aid);
}
function DisplayPostCommentError(qid, aid)
{
	return function(){
		document.getElementById("Err"+qid+aid).innerHTML = "<div><img src='http://www.sinaimg.cn/pfp/ask/images/zhishi/error_icon.gif' width=15 height=16 border=0>服务器出现问题，请重试。</div>";
	}
}
function PostComment(qid, aid)
{
	var strComment = fetchObject("txtComment"+qid + aid);
	var strError = "";
	nCommentLength = strComment.value.length;
	if (nCommentLength == 0 || nCommentLength > 200 ) {
		if (strError.length == 0) {
			strComment.focus();
		}
	}
	if (nCommentLength == 0) {
		strError = "<div><img src='http://www.sinaimg.cn/pfp/ask/images/zhishi/error_icon.gif' width=15 height=16 border=0>评论不能为空，请输入评论。</div>";
	} else if (nCommentLength > 200) {
		strError = "<div><img src='http://www.sinaimg.cn/pfp/ask/images/zhishi/error_icon.gif' width=15 height=16 border=0>评论太长，请缩短您的评论。</div>";
	}
	if (strError.length > 0)
	{
		document.getElementById("Err" + qid + aid).innerHTML = strError;
		return false;
	}
	if (window.RegExp && window.encodeURIComponent) {
		var newStrComment = encodeURIComponent(strComment.value);
	} else {
		var newStrComment = strComment.value;
	}

	var strA = "questionid="+ qid;
	strA += "&answerid=" + aid;
	strA += "&do=add";
	strA += "&answer_flag=5";
	strA += "&txtcomment="+newStrComment;
	StartGETRequest('/browse/zhishi_request_comment.php?'+strA, function() {submitComment(qid, aid)});
}
<!--
function iask_submit(fn,strName)
{
	if(strName == "ask")
	{
		fn.action = "http://iask.sina.com.cn/question/ask_new_2.php";
		fn.title.value = fn.key.value;
		fn.key.value = '';
		fn.submit();
		return false;
	}
	else if(strName == "know")
	{
		if(fn.key.value == "" || fn.key.value == "请输入查询词" || fn.key.value == "请输入问题标题")
		{
			fn.key.value = "请输入查询词";
			fn.key.focus();
			return false;
		}
		fn.action = "http://iask.sina.com.cn/search_engine/search_knowledge_engine.php";
		fn.submit();
		return false;
	}
	else
	{
		return false;
	}
}

function ckwords(obj)
{
	if(obj.value == "请输入查询词" || obj.value == "请输入问题标题")
	{
		obj.value = "";
		obj.focus();
		return false;
	}
}
function swapPic(_sId,_sAttr,_sTxt1, _sTxt2) {
	$(_sId)[_sAttr] = $(_sId)[_sAttr].indexOf(_sTxt1) > -1 ? _sTxt2 : _sTxt1;
}
//-->
<!--
function getClassify () {
	return window.document.classify;
}
function setSize (w, h) {
	getClassify ().width = w;
	getClassify ().height = h;
}
//-->
function setClassifyObj (type, bgcolor, classid, args) {
	var size = args.split ("|");
	var query = "sw=" + size[0] + "&wi=" + size[1] + "&hi=" + size[2] + "&t=" + type + "&id=" + classid;
	var uri = "http://www.sinaimg.cn/pfp/iask/zsr/classify.swf?";
	var clo = '<object style="z-index: -1;" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" id="classify" width="406" height="77"  align="middle">'
	 + '<param name="allowScriptAccess" value="always" />'
	 + '<param name="movie" value="'+ uri +'?' + query + '" />'
	 + '<param name="quality" value="high" />'
	 + '<param name="bgcolor" value="' + bgcolor + '" />'
	 + '  <embed src="'+ uri + query + '" quality="high" bgcolor="'+ bgcolor +'" swLiveConnect=true id="classify" name="classify" width="406" height="77" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'
	+ '</object>'
	document.write (clo);
}
