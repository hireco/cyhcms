/**
 * 本代码用来
 * 1. 分析广告位的定制参数，并生成最终用的申请url
 * 2. 将最终用的申请广告位的url，输出到html文档中
 *
 * 目前支持输出几种格式的
 * 1. 获取填充创意js
 * 2. 直接获取html创意代码
 * 3. 为多个广告位同时申请广告的js，并将其填充
 */

/**
 * 对于参数的信息定义，分为全局参数和各广告为独立参数两种，目前有4种信息 1. 是否需要添加到申请的url中 2. 在url参数中的缩写 3.
 * 添加到url参数时是否需要encode 4. 参数的默认值，用户未指定时取默认值
 */

// ==============================================================================
// debug用函数及变量
var debug_console = null;
var sina_ads_isdebug = 0;
function sina_ads_debug(msg) {
    if (!sina_ads_isdebug) {
	return;
    }
    window.open("", "debug_console", "width=800");
    if (debug_console == null || debug_console.closed) {
	debug_console = window.open("", "debug_console",
				    "width=800, height=300, resizable");
	if (debug_console.document.getElementById('debugoutput') == null) {
	    debug_console.document
		.writeln("<body><textarea cols=120 rows=30 id=debugoutput></textarea></body>");
	}
    }
    debug_console.focus();
    debug_console.document.getElementById('debugoutput').value += msg + "\n";
}

/**
 * 从meta中取keywords的函数
 */
function getKeywordsFromMeta() {
    var keywords = '';
    var metaArray = document.getElementsByTagName("meta");
    for ( var i = 0; i < metaArray.length; i++) {
	var obj = metaArray[i];
	if (obj.name == 'Keywords') {
	    var keyArray = obj.content.split(",");
	    for ( var j = 0; j < keyArray.length; j++) {
		if (keywords != '') {
		    keywords += ' ';
		}
		keywords += keyArray[j];
	    }
	}
    }
    if (keywords == "") {
	return null;
    } else {
	return keywords;
    }
}

// ==============================================================================
// 用到的全局变量
var sina_ads_navFeatures = {};

// 广告位定制参数在参数中的信息，包括是否需要编码到url中，缩写，是否需要encode，默认值等等
var sectionParameterInfoMap = {
    'sectionid' : {
	'isUrlParam' :true,
	'abbr' :'sid',
	'needEncode' :false,
	'defaultValue' :null
    },
    'adtype' : {
	'isUrlParam' :true,
	'abbr' :'t',
	'needEncode' :false,
	'defaultValue' :null
    },
    'requesttype' : { //请求类型
	'isUrlParam' :true,
	'abbr' :'rt',
	'needEncode' :false,
	'defaultValue' :null
    },
    'secw' : {
	'isUrlParam' :false,
	'abbr' :'w',
	'needEncode' :false,
	'defaultValue' :null
    },
    'sech' : {
	'isUrlParam' :false,
	'abbr' :'h',
	'needEncode' :false,
	'defaultValue' :null
    },
    'creativeid' : {
	'isUrlParam' :true,
	'abbr' :'cid',
	'needEncode' :false,
	'defaultValue' :null
    },
    'defad' : {
	'isUrlParam' :true,
	'abbr' :'df_ad',
	'needEncode' :true,
	'defaultValue' :null
    },
    'slotnum' : {
	'isUrlParam' :true,
	'abbr' :'slotnum',
	'needEncode' :false,
	'defaultValue' :null
    },
    'output' : {
	'isUrlParam' :true,
	'abbr' :'output',
	'needEncode' :false,
	'defaultValue' :null
    },
    'id' : {
	'isUrlParam' :false
    },
    'class' : {
	'isUrlParam' :false
    },
    // 内容定向相关参数
    'keyword' : {
	'isUrlParam' :true,
	'abbr' :'kw',
	'needEncode' :true,
	'defaultValue' :null
    },
    'region' : {
	'isUrlParam' :true,
	'abbr' :'rg',
	'needEncode' :true,
	'defaultValue' :null
    },
    /*
     * 格式相关的参数outerStyle,InnerStyle,titleStyle,textStyle,domainStyle
     * outerClass,innerClass,titleClass,textClass,domainClass
     */
    'outerStyle' : {
	'isUrlParam' :false,
	'defaultValue' :null
    },
    'innerStyle' : {
	'isUrlParam' :false,
	'defaultValue' :null
    },
    'titleStyle' : {
	'isUrlParam' :false,
	'defaultValue' :null
    },
    'textStyle' : {
	'isUrlParam' :false,
	'defaultValue' :null
    },
    'domainStyle' : {
	'isUrlParam' :false,
	'defaultValue' :null
    },
    'colNum' : {
	'isUrlParam' :false,
	'defaultValue' :1
    }
};

var globalParameterInfoMap = {
    'sina_ads_userid' : {
	'isUrlParam' :true,
	'abbr' :'uid',
	'needEncode' :false,
	'defaultValue' :null
    },
    'sina_ads_flash_version' : {
	'isUrlParam' :true,
	'abbr' :'fv',
	'needEncode' :false,
	'defaultValue' :getFlashVersion().toString()
    },
    'sina_ads_refer_page' : {
	'isUrlParam' :true,
	'abbr' :'rp',
	'needEncode' :true,
	'defaultValue' :/*document.referer != null ? document.referer : */document.location
    },
    'sina_ads_page_keyword' : {
	'isUrlParam' :true,
	'abbr' :'pkw',
	'needEncode' :true,
	'defaultValue' :getKeywordsFromMeta()
    },
    'sina_ads_region' : {
	'isUrlParam' :true,
	'abbr' :'prg',
	'needEncode' :true,
	'defaultValue' :null
    },
    'sina_ads_ip' : {
	'isUrlParam' :true,
	'abbr' :'ip',
	'needEncode' :false,
	'defaultValue' :null
    },
    'sina_ads_suitename' : {
	'isUrlParam' :false,
	'abbr' :null,
	'needEncode' :false,
	'defaultValue' :'sina_ads_suite'
    },
    'sina_ads_suite' : {
	'isUrlParam' :false,
	'abbr' :null,
	'needEncode' :false,
	'defaultValue' :null
    },
    'sina_ads_frame_border' : {
	'isUrlParam' :false,
	'abbr' :null,
	'needEncode' :false,
	'defaultValue' :0
    },
    'sina_ads_isdebug' : {
	'isUrlParam' :true,
	'abbr' :'debug',
	'defaultValue' :0
    },
    'sina_ads_outputmode' : {
	'isUrlParam' :false,
	'defaultValue' :'dom'
    }
};

// 将变量转换为字符串
function var2String(value) {
    return value != null ? '' + value + '' : '';
}

// ==============================================================================
// 以下函数可以从一组同name，同类型的标签中提取出一组广告位信息
function getAdParamFromElement(element) {
    var adSection = {};
    for ( var param in sectionParameterInfoMap) {
	if (element.getAttribute(param) != null) {
	    adSection[param] = element.getAttribute(param);
	} else if (sectionParameterInfoMap[param].defaultValue != null) {
	    adSection[param] = sectionParameterInfoMap[param].defaultValue;
	}
    }
    return adSection;
}

function getAdSuite(adSuiteName) {
    var adTagName = 'div';
    if (arguments.length == 2) {
	adTagName = arguments[1];
    }
    var divGroup = document.getElementsByTagName('div');
    var adSuite = [];
    for ( var i = 0; i < divGroup.length; i++) {
	if (divGroup[i].getAttribute('name') == adSuiteName) {
	    adSuite.push(getAdParamFromElement(divGroup[i]));
	}
    }
    if (adSuite.length == 0) {
	return null;
    } else {
	return adSuite;
    }
}

function setObjectDefaultValue(anObject, defValueMap) {
    for ( var param in defValueMap) {
	var defValue = defValueMap[param].defaultValue;
	if (anObject[param] == null && defValue != null) {
	    anObject[param] = defValue;
	}
    }
}

function setDefaultSectionParameter(suite) {
    for ( var i = 0; i < suite.length; i++) {
	setObjectDefaultValue(suite[i], sectionParameterInfoMap);
    }
}

// ==============================================================================
function encodeUrl(strToEncode) {
    if (strToEncode == null) {
	return null;
    }
    if (typeof encodeURIComponent == "function") {
	// 如果有encodeURIComponent使用encodeURIComponent
	return encodeURIComponent(strToEncode);
    } else {
	return escape(strToEncode);
    }
}

// 加入一个url参数
function addAdUrlParameter(adUrlParameters, name, value) {
    if (value != null && value != '') {
	adUrlParameters.push('' + name + '=' + value);
    }
}

// 加入一个url参数
function addEncodeAdUrlParameter(adUrlParameters, name, value) {
    addAdUrlParameter(adUrlParameters, name, encodeUrl(value));
}

function resetParameters(adControler) {
    window[adControler.name] = null;
}

/**
 * 将全局参数加入到url中,如果context中指明了参数，
 * 则使用controler中的，否则使用globalContext中的参数
 */
function addGlobalUrlParameter(urlParameters, context, globalContext) {
    for ( var paramName in globalParameterInfoMap) {
	var paramValue = context[paramName] != null? context[paramName] : globalContext[paramName];
	if (globalParameterInfoMap[paramName].isUrlParam && paramValue != null) {
	    if (globalParameterInfoMap[paramName].needEncode) {
		addEncodeAdUrlParameter(urlParameters,
					globalParameterInfoMap[paramName].abbr,
					paramValue);
	    } else {
		addAdUrlParameter(urlParameters,
				  globalParameterInfoMap[paramName].abbr,
				  paramValue);
	    }
	}
    }
}

/**
 * 将一个广告位的请求参数加入到url中
 */
function addASectionUrlParameter(urlParameters, adSection, sectionIndex) {
    for ( var paramName in adSection) {
	// 如果该参数存在在表中并且需要添加到url中，则添加参数
	if (paramName in sectionParameterInfoMap
	    && sectionParameterInfoMap[paramName].isUrlParam) {
	    // 如果sectionIndex不为null，则在缩写后添加索引
	    var paramAbbr = sectionParameterInfoMap[paramName].abbr;
	    if (sectionIndex != null) {
		paramAbbr += sectionIndex;
	    }
	    if (sectionParameterInfoMap[paramName].needEncode) {
		addEncodeAdUrlParameter(urlParameters, paramAbbr,
					adSection[paramName]);
	    } else {
		addAdUrlParameter(urlParameters, paramAbbr,
				  adSection[paramName]);
	    }
	}
    }
}

function IsHasFeature(feature) // 判断是否包含某个字符串
{
    if (feature in sina_ads_navFeatures) {
	return sina_ads_navFeatures[feature];
    }
    sina_ads_navFeatures[feature] = (navigator.userAgent.toLowerCase().indexOf(
									       feature) != -1);
    return sina_ads_navFeatures[feature];
}

function IsIE() // 是否是msie 或者 opera
{
    return IsHasFeature("msie") && !window.opera;
}

/**
 * 返回flash的版本号
 */
function getFlashVersion() {
    var version = 0;
    var currentVersion = 3;
    var obj;
    if (navigator.plugins && navigator.mimeTypes.length) // 查看plugins是否存在
    {
	var flashPlugin = navigator.plugins["Shockwave Flash"];
	if (flashPlugin && flashPlugin.description) {
	    version = flashPlugin.description.replace(/([a-zA-Z]|\s)+/, "")
		.split(".")[0];
	}
    } else {
	if (navigator.userAgent
	    && navigator.userAgent.indexOf("Windows CE") >= 0) {
	    // windows CE
	    currentVersion = 3;
	    obj = 1;
	    while (obj) {
		try {
		    obj = new ActiveXObject("ShockwaveFlash.ShockwaveFlash."
					    + currentVersion);
		    currentVersion;
		} catch (e) {
		    obj = null;
		}
	    }
	} else if (IsIE()) {
	    try {
		var b = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
	    } catch (e) {
		b = null;
	    }
	    if (b != null) {
		version = b.GetVariable("$version").split(" ")[1].split(",")[0];
	    }
	}
    }
    return version; // 返回插件的版本 看是否支持相关特性
}

// ------------------------------------------------------------------------------
// 显示部分的函数,目前除flash外采用模板方法
//显示一个广告位flash
function showFlashForOneSection(section, adData) {
    var sectionId = section['id'];
    var width = adData['width'] != null ? adData['width']
	: section['secw'] != null ? section['secw'] : "100%";
    var height = adData['height'] != null ? adData['height']
	: section['sech'] != null ? section['sech'] : "100%";
    var feedBackUrl = adData['clickUrl'];
    var flashSrc = adData['srcUrl'];
    var flashAD = new sinaFlash(flashSrc, "", width, height, "7", "", false,
				"high");
    flashAD.addParam("adlink", escape(feedBackUrl));
    flashAD.addVariable("adlink", escape(feedBackUrl));
    flashAD.addParam("wmode", "transparent");
    flashAD.addParam("scale", "exactfit");
    flashAD.write(sectionId);
}

//默认的模板
var sina_ads_adstyles = {};
sina_ads_adstyles['defaultTextStyle'] = {
    'head' :'<table width=300 border=1 bordercolor="blue"><tr style="padding:0pt 0pt 0pt 10px;background-color:yellow"><td>Sina广告</td></tr>',
    'span' :'<tr style="background-color:red"><td><div style="height:5px"></div></td></tr>',
    'body' :'<tr><td border=0><table onclick="window.open(\'%clickUrl%\')">' + '<tr style="font-weight:bold;color:blue;"><td>%title%</td></tr>' + '<tr><td>%text%</td></tr>' + '<tr style="font-size:12px;color:#060;"><td>%textUrl%</td></tr></table></td></tr>',
    'foot' :'</table>'
};

sina_ads_adstyles['defaultImageStyle'] = {
	'span' : '',
	'body' : '<a href="%clickUrl%" target="_blank">' + 
	    '<image border="0" src=%srcUrl% width=%width% height=%height%/></a>'
};
// 进行模板替换的函数
var templateVariables = [ 'title', 'text', 'textUrl', 'clickUrl', 'srcUrl', 'height', 'width' ];
function doTemplateReplace(template, adData) {
    var htmlText = template.concat();
    for ( var i = 0; i < templateVariables.length; i++) {
	var varName = templateVariables[i];
	var pattern = new RegExp('%' + varName + '%', 'g');
	htmlText = htmlText.replace(pattern, adData[varName]);
    }
    return htmlText;
}

function getHtmlForTextByTemplate(adData) {
    var htmlTemplate = sina_ads_config.textTemplate;
    var htmlCode = htmlTemplate['head'];
    for ( var i = 0; i < adData.length; i++) {
	if (i != 0) {
	    htmlCode += doTemplateReplace(htmlTemplate['span'], adData[i]);
	}
	htmlCode += doTemplateReplace(htmlTemplate['body'], adData[i]);
    }
    htmlCode += htmlTemplate['foot'];
    return htmlCode;
}

function getHtmlForImageByTemplate(adData) {
    var htmlTemplate = sina_ads_config.imageTemplate;
    var htmlCode = '';
    for ( var i = 0; i < adData.length; i++) {
	if (i != 0) {
	    htmlCode += doTemplateReplace(htmlTemplate['span'], adData[i]);
	}
	htmlCode += doTemplateReplace(htmlTemplate['body'], adData[i]);
    }
    return htmlCode;
}

function getHtmlByTemplate(adData) {
    var htmlCode = '';
    switch (adData[0]['type']) {
    case 'text':
	htmlCode += getHtmlForTextByTemplate(adData);
	break;
    case 'image':
	htmlCode += getHtmlForImageByTemplate(adData);
	break;
    default:
	// htmlCode += secConfig.sectionid + '没有符合条件的广告';
	break;
    }
    return htmlCode;
}

//调整广告数据形状大小
function adJustAdSizeForImageAndFlash(secConfig, adData)
{
    if (adData[0].type != 'image'/* && adData[0].type != 'flash'*/) {
	return;
    }
    if(adData[0].width == null) {
	if (secConfig.secw) {
	    adData[0].width = secConfig.secw;
	} else {
	    adData[0].width = "100%";
	}
    }
    if(adData[0].height == null) {
	if (secConfig.sech) {
	    adData[0].height = secConfig.sech;
	} else {
	    adData[0].height = "100%";
	}
    }
}

function reduceAdData(adData)
{
    if (adData == null) {
        return;
    }
    for (var i = adData.length - 1; i >=0; i--) {
        if (adData[i].type == null) {
            adData.splice(i, 1);
        }
    }
}

function showOneSection(secConfig, adData) {
    // 确定secDiv
    var secDiv;
    if (secConfig.domobject) {
	secDiv = secConfig.domobject;
    } else {
	secDiv = document.getElementById(secConfig.id);
    }
    //规范化adData
    reduceAdData(adData);
    if (adData == null || adData.length == 0) {
	// 无合适广告,隐藏div
	secDiv.innerHTML = "" + "";
    } else {
	adJustAdSizeForImageAndFlash(secConfig, adData);
	secDiv.style.display = "block";
	// 套模板
	if (adData[0]['type'] != 'flash') {
	    var innerHTML = getHtmlByTemplate(adData);
	    secDiv.innerHTML = innerHTML;
	} else {// 写入flash
	    showFlashForOneSection(secConfig, adData[0]);
	}
    }

    // /执行callback函数，可能是flowad需要
    if (secConfig.callbackAfterShow) {
	eval(secConfig.callbackAfterShow);
    }
}
function showAdControler(adControler) {
    var ads_data = adControler.ads_data;
    var ads_suite = adControler.suite;
    for ( var secIndex = 0; secIndex < ads_suite.length; secIndex++) {
	showOneSection(ads_suite[secIndex], ads_data[secIndex]);
    }
}
/**
 * showAd : 从服务端得到数据后显示最终的广告
 */
function showAd(adControler) {
    var ads_data = null;
    var ads_suite = null;
    if (adControler == null) {
	ads_data = window.sina_ads_data;
	ads_suite = window.sina_ads_suite;
    } else {
	showAdControler(adControler);
    }
    // 根据sina_ads_suite和sina_ads_data中的数据显示广告，可以从外部覆盖此方法
    if (ads_data == null || ads_data.length == null) {
	return;
    }
    for ( var secIndex = 0; secIndex < ads_suite.length; secIndex++) {
	showOneSection(ads_suite[secIndex], ads_data[secIndex]);
    }
}

// ------------------------------------------------------------------------------
/*
 * 设置申请用参数的各种函数
 */
var sina_ads_config_init = false;
var sinaAdDefaultConfig = {
    'adClientUrl' : {
	'defaultValue' :'http://match.sina.com.cn/dli/dli.php?'
    },
    'textTemplate' : {
	'defaultValue' :sina_ads_adstyles['defaultTextStyle']
    },
    'imageTemplate' : {
	'defaultValue' :sina_ads_adstyles['defaultImageStyle']
    },
    'keywordsElementName' : {
	'defaultValue' :'sina_flowad'
    },
    'keywordsQueryUrl' : {
	'defaultValue' :'http://match.sina.com.cn/admatchkeyword.php?'
    }
};

var sina_ads_globalParameter = {};
if (window['sina_ads_config'] == null) {
    window['sina_ads_config'] = {};
}

function InitSuiteParameter(adControler) {
    // 初始化sina_ads_config
    if (!sina_ads_config_init) {
	setObjectDefaultValue(sina_ads_config, sinaAdDefaultConfig);
	sina_ads_config_init = true;
    }
    setObjectDefaultValue(sina_ads_config, globalParameterInfoMap);
    for ( var param in globalParameterInfoMap) {
	// TODO modify from window to an object
	if (window[param] == null) {
	    window[param] = globalParameterInfoMap[param].defaultValue;
	}
    }
    // 为广告位增加非null的默认参数
    setDefaultSectionParameter(adControler.suite);
}

function printAdDynamicly(adUrl) {
    adUrl = adUrl.substring(0, 2000).replace(/%\w?$/, "");
    sina_ads_debug("申请url: " + adUrl);
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = var2String(adUrl);
    document.getElementsByTagName("head")[0].appendChild(script);
}

/**
 * 根据申请的url，浏览器的类型和是否支持DHTML及用户指定的格式等因素填充 输出申请代码
 */
function printAd(adUrl) {
    // 现在改为全部为js格式输出
    adUrl = adUrl.substring(0, 2000).replace(/%\w?$/, "");
    sina_ads_debug("申请url: " + adUrl);
    document
	.write('<script language="JavaScript" src=' + var2String(adUrl) + '><\/script>');
}

function createSinaAdDynamicly(adControler, isStatic) {
    // 先生成最后在url中需要捎带的参数数组，此时需要进行转码
    var suite = adControler.suite;
    var urlParameters = new Array();
    // 单独增加secnum
    addAdUrlParameter(urlParameters, 'secnum', suite.length);
    addAdUrlParameter(urlParameters, 'ctl', adControler.name);
    // 增加其他全局变量
    addGlobalUrlParameter(urlParameters, adControler.context, window);
    for (i = 0; i < suite.length; i++) {
	addASectionUrlParameter(urlParameters, suite[i], i);
    }
    if (adControler.adUrl == null) {
	adControler.adUrl = sina_ads_config.adClientUrl
	    + urlParameters.join('&');
    } else {
	adControler.adUrl += urlParameters.join('&');
    }
    // 用此url进行申请
    if (isStatic != null && isStatic == true) {
	printAd(adControler.adUrl);
    } else {
	printAdDynamicly(adControler.adUrl);
    }
}

// 此类用来存储suite信息和对应取回的data信息，供showAd使用
function SinaAdControler(ctlname, suite) {
    this.name = ctlname;
    this.suite = suite;
    this.adUrl = null;
    this.context = {};
}
// ------------------------------------------------------------------------------
/*
 * 获取广告的外部接口 1. 根据广告位名称获取广告 2. 根据已经定义好的suite获取广告 3. 根据定义好的单个广告位获取广告
 */
// 根据广告位名称获取广告,默认名字sina_ads_suite
function showSinaAds(suitename) {
    var suite_name;
    if (suitename != null) {
	suite_name = suitename;
    } else {
	suite_name = 'sina_ads_suite';
    }
    var suite = getAdSuite(suite_name);
    ;
    var ctlname = 'ad_controler_' + suitename;
    window[ctlname] = new SinaAdControler(ctlname, suite);
    InitSuiteParameter(window[ctlname]);
    createSinaAdDynamicly(window[ctlname], true);
}
// 根据定义好的suite数组获取广告，使用动态插入js而非document.write
function showAdsSuiteDynamicly(adControler) {
    InitSuiteParameter(adControler);
    createSinaAdDynamicly(adControler);
}

// ------------------------------------------------------------------------------
/*
 * 获取用户id的函数
 */
function getUserID() {
    userIDUrl = 'http://admatch.sina.com.cn/getuser.php';
    document
	.write('<script language="JavaScript" src=' + var2String(userIDUrl) + '><\/script>');
}
//------------------------------------------------------------------------------
getUserID();
