/**
 * ����������
 * 1. �������λ�Ķ��Ʋ����������������õ�����url
 * 2. �������õ�������λ��url�������html�ĵ���
 *
 * Ŀǰ֧��������ָ�ʽ��
 * 1. ��ȡ��䴴��js
 * 2. ֱ�ӻ�ȡhtml�������
 * 3. Ϊ������λͬʱ�������js�����������
 */

/**
 * ���ڲ�������Ϣ���壬��Ϊȫ�ֲ����͸����Ϊ�����������֣�Ŀǰ��4����Ϣ 1. �Ƿ���Ҫ��ӵ������url�� 2. ��url�����е���д 3.
 * ��ӵ�url����ʱ�Ƿ���Ҫencode 4. ������Ĭ��ֵ���û�δָ��ʱȡĬ��ֵ
 */

// ==============================================================================
// debug�ú���������
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
 * ��meta��ȡkeywords�ĺ���
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
// �õ���ȫ�ֱ���
var sina_ads_navFeatures = {};

// ���λ���Ʋ����ڲ����е���Ϣ�������Ƿ���Ҫ���뵽url�У���д���Ƿ���Ҫencode��Ĭ��ֵ�ȵ�
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
    'requesttype' : { //��������
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
    // ���ݶ�����ز���
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
     * ��ʽ��صĲ���outerStyle,InnerStyle,titleStyle,textStyle,domainStyle
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

// ������ת��Ϊ�ַ���
function var2String(value) {
    return value != null ? '' + value + '' : '';
}

// ==============================================================================
// ���º������Դ�һ��ͬname��ͬ���͵ı�ǩ����ȡ��һ����λ��Ϣ
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
	// �����encodeURIComponentʹ��encodeURIComponent
	return encodeURIComponent(strToEncode);
    } else {
	return escape(strToEncode);
    }
}

// ����һ��url����
function addAdUrlParameter(adUrlParameters, name, value) {
    if (value != null && value != '') {
	adUrlParameters.push('' + name + '=' + value);
    }
}

// ����һ��url����
function addEncodeAdUrlParameter(adUrlParameters, name, value) {
    addAdUrlParameter(adUrlParameters, name, encodeUrl(value));
}

function resetParameters(adControler) {
    window[adControler.name] = null;
}

/**
 * ��ȫ�ֲ������뵽url��,���context��ָ���˲�����
 * ��ʹ��controler�еģ�����ʹ��globalContext�еĲ���
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
 * ��һ�����λ������������뵽url��
 */
function addASectionUrlParameter(urlParameters, adSection, sectionIndex) {
    for ( var paramName in adSection) {
	// ����ò��������ڱ��в�����Ҫ��ӵ�url�У�����Ӳ���
	if (paramName in sectionParameterInfoMap
	    && sectionParameterInfoMap[paramName].isUrlParam) {
	    // ���sectionIndex��Ϊnull��������д���������
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

function IsHasFeature(feature) // �ж��Ƿ����ĳ���ַ���
{
    if (feature in sina_ads_navFeatures) {
	return sina_ads_navFeatures[feature];
    }
    sina_ads_navFeatures[feature] = (navigator.userAgent.toLowerCase().indexOf(
									       feature) != -1);
    return sina_ads_navFeatures[feature];
}

function IsIE() // �Ƿ���msie ���� opera
{
    return IsHasFeature("msie") && !window.opera;
}

/**
 * ����flash�İ汾��
 */
function getFlashVersion() {
    var version = 0;
    var currentVersion = 3;
    var obj;
    if (navigator.plugins && navigator.mimeTypes.length) // �鿴plugins�Ƿ����
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
    return version; // ���ز���İ汾 ���Ƿ�֧���������
}

// ------------------------------------------------------------------------------
// ��ʾ���ֵĺ���,Ŀǰ��flash�����ģ�巽��
//��ʾһ�����λflash
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

//Ĭ�ϵ�ģ��
var sina_ads_adstyles = {};
sina_ads_adstyles['defaultTextStyle'] = {
    'head' :'<table width=300 border=1 bordercolor="blue"><tr style="padding:0pt 0pt 0pt 10px;background-color:yellow"><td>Sina���</td></tr>',
    'span' :'<tr style="background-color:red"><td><div style="height:5px"></div></td></tr>',
    'body' :'<tr><td border=0><table onclick="window.open(\'%clickUrl%\')">' + '<tr style="font-weight:bold;color:blue;"><td>%title%</td></tr>' + '<tr><td>%text%</td></tr>' + '<tr style="font-size:12px;color:#060;"><td>%textUrl%</td></tr></table></td></tr>',
    'foot' :'</table>'
};

sina_ads_adstyles['defaultImageStyle'] = {
	'span' : '',
	'body' : '<a href="%clickUrl%" target="_blank">' + 
	    '<image border="0" src=%srcUrl% width=%width% height=%height%/></a>'
};
// ����ģ���滻�ĺ���
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
	// htmlCode += secConfig.sectionid + 'û�з��������Ĺ��';
	break;
    }
    return htmlCode;
}

//�������������״��С
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
    // ȷ��secDiv
    var secDiv;
    if (secConfig.domobject) {
	secDiv = secConfig.domobject;
    } else {
	secDiv = document.getElementById(secConfig.id);
    }
    //�淶��adData
    reduceAdData(adData);
    if (adData == null || adData.length == 0) {
	// �޺��ʹ��,����div
	secDiv.innerHTML = "" + "";
    } else {
	adJustAdSizeForImageAndFlash(secConfig, adData);
	secDiv.style.display = "block";
	// ��ģ��
	if (adData[0]['type'] != 'flash') {
	    var innerHTML = getHtmlByTemplate(adData);
	    secDiv.innerHTML = innerHTML;
	} else {// д��flash
	    showFlashForOneSection(secConfig, adData[0]);
	}
    }

    // /ִ��callback������������flowad��Ҫ
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
 * showAd : �ӷ���˵õ����ݺ���ʾ���յĹ��
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
    // ����sina_ads_suite��sina_ads_data�е�������ʾ��棬���Դ��ⲿ���Ǵ˷���
    if (ads_data == null || ads_data.length == null) {
	return;
    }
    for ( var secIndex = 0; secIndex < ads_suite.length; secIndex++) {
	showOneSection(ads_suite[secIndex], ads_data[secIndex]);
    }
}

// ------------------------------------------------------------------------------
/*
 * ���������ò����ĸ��ֺ���
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
    // ��ʼ��sina_ads_config
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
    // Ϊ���λ���ӷ�null��Ĭ�ϲ���
    setDefaultSectionParameter(adControler.suite);
}

function printAdDynamicly(adUrl) {
    adUrl = adUrl.substring(0, 2000).replace(/%\w?$/, "");
    sina_ads_debug("����url: " + adUrl);
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = var2String(adUrl);
    document.getElementsByTagName("head")[0].appendChild(script);
}

/**
 * ���������url������������ͺ��Ƿ�֧��DHTML���û�ָ���ĸ�ʽ��������� ����������
 */
function printAd(adUrl) {
    // ���ڸ�Ϊȫ��Ϊjs��ʽ���
    adUrl = adUrl.substring(0, 2000).replace(/%\w?$/, "");
    sina_ads_debug("����url: " + adUrl);
    document
	.write('<script language="JavaScript" src=' + var2String(adUrl) + '><\/script>');
}

function createSinaAdDynamicly(adControler, isStatic) {
    // �����������url����Ҫ�Ӵ��Ĳ������飬��ʱ��Ҫ����ת��
    var suite = adControler.suite;
    var urlParameters = new Array();
    // ��������secnum
    addAdUrlParameter(urlParameters, 'secnum', suite.length);
    addAdUrlParameter(urlParameters, 'ctl', adControler.name);
    // ��������ȫ�ֱ���
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
    // �ô�url��������
    if (isStatic != null && isStatic == true) {
	printAd(adControler.adUrl);
    } else {
	printAdDynamicly(adControler.adUrl);
    }
}

// ���������洢suite��Ϣ�Ͷ�Ӧȡ�ص�data��Ϣ����showAdʹ��
function SinaAdControler(ctlname, suite) {
    this.name = ctlname;
    this.suite = suite;
    this.adUrl = null;
    this.context = {};
}
// ------------------------------------------------------------------------------
/*
 * ��ȡ�����ⲿ�ӿ� 1. ���ݹ��λ���ƻ�ȡ��� 2. �����Ѿ�����õ�suite��ȡ��� 3. ���ݶ���õĵ������λ��ȡ���
 */
// ���ݹ��λ���ƻ�ȡ���,Ĭ������sina_ads_suite
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
// ���ݶ���õ�suite�����ȡ��棬ʹ�ö�̬����js����document.write
function showAdsSuiteDynamicly(adControler) {
    InitSuiteParameter(adControler);
    createSinaAdDynamicly(adControler);
}

// ------------------------------------------------------------------------------
/*
 * ��ȡ�û�id�ĺ���
 */
function getUserID() {
    userIDUrl = 'http://admatch.sina.com.cn/getuser.php';
    document
	.write('<script language="JavaScript" src=' + var2String(userIDUrl) + '><\/script>');
}
//------------------------------------------------------------------------------
getUserID();
