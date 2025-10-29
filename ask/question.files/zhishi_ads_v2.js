/***
 *
 * Display Advertisement On ZhiShiRen
 * Author : Zheng Bin
 * CopyRight : Sina R&D Center 2007
 *
 ***/

//加载css
document.write("<link href=\"http://keyword.sina.com.cn/css/iaskads_v2.css\" rel=\"stylesheet\" type=\"text/css\" />");

//加载js。
//document.write("<" + "script type=\"text/javascript\" src=\"" + "http://keyword.sina.com.cn/js/json2.js" + "\"></" + "script>");
//发送请求
/**
 * 为了解决window.open()不带refer的问题
 */
function winopen(url){
	window.open(decodeURIComponent(url));
//	var win = window.open();
//	var url = decodeURIComponent(ads_url);
//	win.document.writeln('<html><body><a href=' + url + ' style="display:none">' + url + '</a></body></html>');
/*
	if(document.all)
		win.document.getElementsByTagName('A')[0].click();
	else
		win.location = url;
*/
}

/**
 * 用来向日志统计服务器发送请求
 **/
function iask_keywords_send(mod, value){
        var sender = new Image();
        sender.src = 'http://js.iask.com/' + mod + '?' + value;
        sender.onload = function(){clear(this);};
        sender.onerror = function(){clear(this);};
        sender.onabort = function(){clear(this);};
        function clear(obj){
                obj.onerror = null;
                obj.onload = null;
                obj.onabort = null;
                obj = null;
        }
}

/**
 * 供html调用打印出广告内容。
 **/
function print_ads_div(ads){
	var ads_div1=document.getElementById('ads');//这个改变了
	var inn1="";
	var ids="";
	var p_show=false;
	var u_show=false;
	var num=0;
	if(ads.length>=3){
		num=3;
	}
	else{
		num=ads.length;
	}
	for(i=0;i<num;i++){
		ids+=ads[i].id+"_";
		if(ads[i].field=="page"){
			p_show=true;
		}
		if(ads[i].field=="user"){
			u_show=true;
		}
		inn1+=print_ads(ads[i].url,ads[i].title,ads[i].content,ads[i].domain,ads[i].id,ads[i].field);
	}
	/*for(var i=0;i<2&&i<ads.length;i++){
		var ads_url=ads[i].url;
		var title=ads[i].title;
		var describe=ads[i].content;
		var domain=ads[i].domain;
		var id=ads[i].id;
		ids+=id+"_";
		inn1+=print_ads1(ads_url,title,describe,domain,id);
	}*/
	if(num > 0)
	{
		ads_div1.innerHTML=inn1;
		ads_div1.style.display="block";
	}
	var ads_div2=document.getElementById('ads1');
	var inn2="";
	inn2+=print_all_begin();
	for(var i=3;i<7&&i<ads.length;i++){
		var ads_url=ads[i].url;
		var title=ads[i].title;
		var describe=ads[i].content;
		var domain=ads[i].domain;
		var id=ads[i].id;
		var field=ads[i].field;
		ids+=id+"_";
		if(field=="page"){
			p_show=true;
		}
		if(field=="user"){
			u_show=true;
		}
		inn2+=print_all_one(ads_url,title,describe,domain,id,field);
	}
	inn2+=print_all_end();
	if(ads.length > 3)
	{
		ads_div2.innerHTML=inn2;
		ads_div2.style.display="block";
	}
	if(ads.length > 0)
	{
	//	alert(muid);
		if(p_show==true){
			iask_keywords_send("iAskAds.png","num=" + i + "&ids=" + ids + "&kind=" + kind);
		}
		if(u_show==true){
			iask_keywords_send("iAskAds.png","userFieldAdsShow");
		}
	}
}

function print_ads_div_u(ads){
	var ads_div1=document.getElementById('ads');//这个改变了
	var inn1="";
	var ids="";
	var num=0;
	if(ads.length>=3){
		num=3;
	}
	else{
		num=ads.length;
	}
	for(i=0;i<num;i++){
		ids+=ads[i].id+"_";
		inn1+=print_ads(ads[i].url,ads[i].title,ads[i].content,ads[i].domain,ads[i].id,ads[i].field);
	}
	
	if(num > 0)
	{
		ads_div1.innerHTML=inn1;
		ads_div1.style.display="block";
	}
	if(ads.length > 0)
	{
		iask_keywords_send("iAskAds.png","u_num=" + i + "&ids=" + ids + "&kind=" + kind);
		//alert("unum");
	}
}

function print_ads_div_p(ads){
	var ids="";
	var p_show=false;
	var u_show=false;
	var num=0;
	if(ads.length>=4){
		num=4;
	}
	else{
		num=ads.length;
	}
	var ads_div2=document.getElementById('ads1');
	var inn2="";
	inn2+=print_all_begin();
	for(var i=0;i<4&&i<ads.length;i++){
		var ads_url=ads[i].url;
		var title=ads[i].title;
		var describe=ads[i].content;
		var domain=ads[i].domain;
		var id=ads[i].id;
		var field=ads[i].field;
		ids+=id+"_";
		inn2+=print_all_one(ads_url,title,describe,domain,id,field);
	}
	inn2+=print_all_end();
	if(ads.length > 0)
	{
		ads_div2.innerHTML=inn2;
		ads_div2.style.display="block";
	}


	
	var ads_div1=document.getElementById('ads');//这个改变了
	var inn1="";
	if(ads.length>=7){
		num=7;
	}
	else{
		num=ads.length;
	}
	for(i=4;i<num;i++){
		ids+=ads[i].id+"_";
		inn1+=print_ads(ads[i].url,ads[i].title,ads[i].content,ads[i].domain,ads[i].id,ads[i].field);
	}
	
	if(ads.length > 4)
	{
		ads_div1.innerHTML=inn1;
		ads_div1.style.display="block";
	}


	if(ads.length > 0)
	{
		//alert(muid);
		if(ads[0].field=="page"){
			iask_keywords_send("iAskAds.png","p_num=" + i + "&ids=" + ids + "&kind=" + kind + "&uid=" + muid);
		}
		else{
			iask_keywords_send("iAskAds.png","u_num=" + i + "&ids=" + ids + "&kind=" + kind + "&uid=" + muid);
		}
		//alert("pnum");
	}
}

function print_all_begin(){
	//var e="<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"lh13 f12\" style=\"table-layout:fixed;word-wrap:break-word; padding-bottom:10px;\"><tr valign=\"top\">";
	var e="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"f12\" style=\"table-layout:fixed;word-wrap:break-word; line-height:136%;\"><tr valign=\"top\">";
	return e;
}

function print_all_end(){
	var e="</tr></table>";
	return e;
}

function print_all_one(ads_url,title,describe,domain,id,field){
	//var e="<td width=\"165\" nowrap>"+print_ads1(ads_url,title,describe,domain,id)+"</td>";
	var e="<td width=2%></td><td width=23%>"+print_ads1(ads_url,title,describe,domain,id,field)+"</td>";
	return e;
}

/*function print_all(ads_url0,title0,describe0,domain0,id0,ads_url1,title1,describe1,domain1,id1){
	var e="<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"lh13 f12\" style=\"table-layout:fixed;word-wrap:break-word; padding-bottom:10px;\"><tr valign=\"top\">";
    e+="<td width=\"150\" nowrap>"+print_ads1(ads_url0,title0,describe0,domain0,id0)+"</td>";
    e+="<td width=\"150\" nowrap>"+print_ads1(ads_url1,title1,describe1,domain1,id1)+"</td>";
	e+="</tr></table>";
	return e;
}*/

/**
 * 打印每个广告。修改之后为用户点击一片区域都可以被指向到广告。
 **/
function print_ads(ads_url,title,describe,domain,id,field){
/*
	var e="<div style=\"cursor:pointer;\" onmouseover=\"window.status='"+domain+"';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"iask_keywords_send('iAskAds.png','id="+id+"');winopen('"+ads_url+"');\">";
		e+="<p><font color=\"#0000ff\">"+title+"</font></p>";
		e+="<div style=\"margin-top:3px;\"><span class=\"f12\">"+describe+"</span><br>";
		e+="<p>"+domain+"</p>";
		e+="</div>";
*/
		var e="<div style=\"WIDTH: auto; CURSOR: hand; WORD-BREAK: break-all;\"onmouseover=\"window.status='"+domain+"';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"iask_keywords_send('iAskAds.png','id="+id+"&uid="+muid+"&kind="+kind+"&field="+field+"');winopen('"+ads_url+"');\">";
		e+="<a><font color=\"#0000ff\">"+title+"</font></a>";
		e+="<div style=\"margin-top:3px;\"><span class=\"f12\">"+describe+"</span></div>";
		e+="<a><span class=\"iask_ads_display_url\">"+domain+"</span></a>";
		e+="</div><br>";
	return e;
}

function print_ads1(ads_url,title,describe,domain,id,field){
        /*var e="<div style=\"WIDTH: auto; CURSOR: hand; WORD-BREAK: break-all;margin-right:5px ; margin-left:5px\" onmouseover=\"window.status='"+domain+"';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"iask_keywords_send('iAskAds.png','id="+id+"');winopen('"+ads_url+"');\">";
        e+="<a href=\"\" target=\"_blank\">"+title+"</a>";
        e+="<div style=\"margin-top:3px;\"><span class=\"f12\">"+describe+"</span><br>";
        e+="<a href=\"\" target=\"_blank\" style=\"text-decoration:none;\"><span class=\"iask_ads_display_url\">"+domain+"</span></a>";
        e+="</div>";
		*/
		//alert(kind);
		var e="<div style=\"WIDTH: auto; CURSOR: hand; WORD-BREAK: break-all;\" onmouseover=\"window.status='"+domain+"';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"iask_keywords_send('iAskAds.png','id="+id+"&uid="+muid+"&kind="+kind+"&field="+field+"');winopen('"+ads_url+"');\">";
		e+="<a><font color=\"#0000ff\">"+title+"</font></a>";
		e+="<div style=\"margin-top:3px;\"><span class=\"f12\">"+describe+"</span><br>";
		e+="<a><span class=\"iask_ads_display_url\">"+domain+"</span></a>";
		e+="</div>";
		return e;
}

//打印本页url，供调试使用。
function print_url(){
	document.write("<div class=\"debug\"><b>PAGE URL</b> : "+window.location.href+"</div>");
}

var keyword = document.getElementsByName("Keywords");
for(var i = 0; i < keyword.length; i ++){
	kind=keyword[i].content;
}

//从php获取广告。
function display_ads(){
	if(ads==null){
		var pp_url=window.location.href;
		var url = encodeURIComponent(pp_url);
		//iask_keywords_send("iAskAds.png","ads=null");
		iask_keywords_send("iAskAds.png","ads=null&content=" + kind + "&url=" + url);
		return;
	}
	else{
		print_ads_div_p(ads);
	}
	//if(ads!=null){
	//	print_ads_div_p(ads);
	//}
	//if(u_ads!=null){
	//	print_ads_div_u(u_ads);
	//}
	//alert(ads_u);
	
}

if (page_url==""){
	var page_url=window.location.href;
}
var u = encodeURIComponent(page_url);
var urlAddr = 'http://keyword.sina.com.cn/zhishiads.php?url='+u+'&dpc=1&uid='+muid;
document.write("<script type='text/javascript' src='" + urlAddr + "'></script>");



//display_ads();

