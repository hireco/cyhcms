/***
 *
 * Display Correlative Nominated Questions On ZhiShiRen
 * Author : Song Li 
 * CopyRight : Sina R&D Center 2008
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

function print_search(){
	var e="";
	//alert(zkey);
	if(zkey==null){
		return e;
	}
	e+="<div class=\"ckgd_title\">\n<a href=\"/search_engine/search_knowledge_engine.php?key="+zkey+"\" target=\"_blank\" class=\"c0\">查看更多相关问题...</a>\n</div>"
	//alert(e);
	return e;
}


	//随机改变数组的排序
function randomOrder (targetArray)
{
    var arrayLength = targetArray.length
    //
    //先创建一个正常顺序的数组
    var tempArray1 = new Array();

    for (var i = 0; i < arrayLength; i ++)
    {
        tempArray1 [i] = i
    }
    //
    //再根据上一个数组创建一个随机乱序的数组
    var tempArray2 = new Array();

    for (var i = 0; i < arrayLength; i ++)
    {
        //从正常顺序数组中随机抽出元素
        tempArray2 [i] = tempArray1.splice (Math.floor (Math.random () * tempArray1.length) , 1)
    }
    //
    //最后创建一个临时数组存储 根据上一个乱序的数组从targetArray中取得数据
    var tempArray3 = new Array();

    for (var i = 0; i < arrayLength; i ++)
    {
	tempArray3[i] = new Array();
        tempArray3[i][0] = targetArray[tempArray2[i]][0];
	tempArray3[i][1] = targetArray[tempArray2[i]][1];
	tempArray3[i][2] = targetArray[tempArray2[i]][2];
    }
    //
    //返回最后得出的数组
    return tempArray3
}

//使用实例

//var tmp = ["1", "2", "3", "4"];
//alert(randomOrder(tmp));



/**
 * 供html调用打印出广告内容。
 **/
function print_ads_div(que){
	var que_div1=document.getElementById('ads2');//这个改变了
	var inn1="";
	var num=0;
	var n=0;
	var zlen=0;
	var qlen=que.length;
	//alert("aa");
	if(RqArr==null){
		//alert("xx");
		zlen=0;
	}
	else{
		zlen=RqArr.length;
	}
	//alert(zlen);	
	if(zlen+qlen<5){
		n=zlen;
		num=qlen;
	}
	else if(qlen < 3){
		if(zlen>5-qlen){
			n=5-qlen;
		}
		else{
			n=zlen;
		}
	}
	else{
		if(zlen>=2){
			n=2;
		}
		else {//if(ztitle.length>=1){
			n=zlen;
		}
	//else if(ztitle!=null){
	//	n=1;
	//}
	
		if(qlen>=5-n){
			num=5-n;
		}
		else{
			num=qlen;
		}
	}
	//alert(n);
	var arr=new Array();
	//alert(arr);
	if(n<1){}
	else{
		for(i=0;i<n;i++){
			//alert(RqArr[i].qtitle);
			arr[i] = new Array();
			arr[i][0] = RqArr[i].qid;
                	arr[i][1] = RqArr[i].qtitle;
        	        arr[i][2] = 0;
			//arr[zqid[i].value]=ztitle[i].value;
		}
	}
	var j=n;
	//alert(j);
	for(i=0;i<que.length;i++){
		if(j>=5){
			break;
		}
		//alert(que[i].title);
		if(arr[que[i].qno]!=null){
			continue;
		}
		//j++;
		arr[j] = new Array();
		arr[j][0] = que[i].qno;
                arr[j][1] = que[i].title;
                arr[j][2] = 1;
		j ++;
		//arr[que[i].qno]=que[i].title;
	}
    var arrayLength = arr.length;
    //alert(arr);
    //先创建一个正常顺序的数组
    var tempArray1 = new Array();

    for (var i = 0; i < arrayLength; i ++)
    {
        tempArray1 [i] = i
    }
    
    //再根据上一个数组创建一个随机乱序的数组
    var tempArray2 = new Array();

    for (var i = 0; i < arrayLength; i ++)
    {
        //从正常顺序数组中随机抽出元素
        tempArray2 [i] = tempArray1.splice (Math.floor (Math.random () * tempArray1.length) , 1);
    }
	var m;
	Arr = new Array();
	for (var i = 0; i < arrayLength; i ++){
		Arr[i] = new Array();
		m = tempArray2 [i];
		//alert(m);
		Arr[i][0] = arr[m][0];
		Arr[i][1] = arr[m][1];
		Arr[i][2] = arr[m][2];
	}
	//Arr = randomOrder(arr);
	//alert(Arr);
	i=0;
	if(j>=1){
		inn1+=print_search();
		inn1+="<div class=\"ckgd_cont\" style=\"margin:0px; padding:0 0 0 12px;\">\n<ul class=\"gd\">\n";
		for(i = 0;i < Arr.length;i ++){
		//for(x in arr){
			//alert(x);
			//if(i<n){
			//if(x[2] == 0){
			if(Arr[i][2] == 0){

                                //inn1+=print_searchque(x[0],x[1]);
				inn1+=print_searchque(Arr[i][0],Arr[i][1]);
				//inn1+=print_searchque(x,arr[x]);
			}
			else{
                                //inn1+=print_question(x[0],x[1]);
				inn1+=print_question(Arr[i][0],Arr[i][1]);
				//inn1+=print_question(x,arr[x]);
			}
			//i++;
		}
		inn1+="</ul></div>";
	}
	if(j > 0)
	{
		que_div1.innerHTML=inn1;
		que_div1.style.display="block";
		//alert("log send");
		//iask_keywords_send("iAskAds.png","num=" + i + "likelyQuid=" + muid);
	}
}

function print_search_question(){
	var que_div1=document.getElementById('ads2');
	var inn1="";
    var num=RqArr.length;
	//alert(ztitle.length);
	if(RqArr==null){
		return;
	}
	//alert(num);
	inn1+=print_search();
	inn1+="<div class=\"ckgd_cont\" style=\"margin:0px; padding:0 0 0 12px;\">\n<ul class=\"gd\">\n";
	if(num > 0){
		for(i=0;i<num;i++){
			//alert(RqArr[i].qid+RqArr[i].qtitle);
                	inn1+=print_searchque(RqArr[i].qid,RqArr[i].qtitle);
        	}
	}
        inn1+="</ul></div>";
	//alert(inn1);
	if(num > 0)
        {
                que_div1.innerHTML=inn1;
                que_div1.style.display="block";
        }
}

/**
 * 打印每个广告。修改之后为用户点击一片区域都可以被指向到广告。
 **/
function print_searchque(que_url,title){

	var e="<li><a href=\"/b/"+ que_url +".html?from=related\" target=\"_blank\">"+ title +"</font></a></li>\n";

/*		
var e="<div style=\"WIDTH: auto; CURSOR: hand; WORD-BREAK: break-all;\"onmouseover=\"window.status='"+domain+"';return true;\" onmouseout=\"window.status='';return true;\"onclick=\" winopen('"+ads_url+"');\">";
		e+="<a><font color=\"#0000ff\">"+title+"</font></a>";
		//e+="<a><span class=\"iask_ads_display_url\">"+domain+"</span></a>";
		e+="</div><br>";
*/
	//alert(e);
	return e;
}

function print_question(que_url,title){
	var e="<li><a href=\"/b/"+ que_url +".html?from=nominated\" target=\"_blank\">"+ title +"</font></a></li>\n";
	//alert(e);
	return e;
}

//打印本页url，供调试使用。
function print_url(){
	document.write("<div class=\"debug\"><b>PAGE URL</b> : "+window.location.href+"</div>");
}

//从php获取广告。
function display_questions(){
	if(que==null && RqArr==null){
		//alert("null");
		//var pp_url=window.location.href;
		//var url = encodeURIComponent(pp_url);
		//iask_keywords_send("iAskAds.png","ads=null");
		iask_keywords_send("iAskAds.png","nominate=null&relate=null&uid=" + muid);
		//print_search_question();	
		return;
	}
	else if(que==null){
		//alert("1");
		print_search_question();
		iask_keywords_send("iAskAds.png","nominate=null&relateShow&uid=" + muid);
	}
	else{
		//alert("2");
		print_ads_div(que);
		iask_keywords_send("iAskAds.png","nominateShow&relateShow&uid=" + muid);
	}
	
}

//if (page_url==""){
//alert(page_url);
//}
/*
if(ztitle==null){
	//alert("ztitle");
	try{
		var ztitle=document.all.ztitle;
	}
	catch(e){
		//alert(e);
		ztitle=null;
	}
}
if(zqid==null){
	//alert("zqid");
	var zqid=document.all.zqid;
	//alert(zqid);
}
if(zkey==null){
	var zkey=document.all.zkey;
}*/

function getRq(page_var){
	if(!page_var)
		return;
	zkey=page_var.title;
	//alert("\u0000\u00f4\u0000\u0000"+"abc");
	RqArr=page_var.list;
	var page_url=window.location.href;
	//alert(page_url);
var u = encodeURIComponent(page_url);
var urlAddr = 'http://keyword.sina.com.cn/likelyQ.php?url='+u+'&dpc=1';
document.write("<script type='text/javascript' src='" + urlAddr + "'></script>");
}

var RqArr=null;
var zkey="";	
//alert(page_url);



//display_ads();

