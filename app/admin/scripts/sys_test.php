<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
////////////////////////////////////////////
//如果您看见这句话，说明您现在使用的服务器不支持PHP
////////////////////////////////////////////


// =================== 以下变量为用户选项,请更据你的具体情况设置 ====================

	$admessage = "红棉网络科技让您的网络建站更快捷,<br>
	<a href=http://www.hongmian.net target=_blank>www.hongmian.net".
	"</a><br>让我们一起做得更好！";
// 如果这个探针你是用来演示的，你可以在上面变量中输入相关信息(会显示在页面底部,支持html)

	$defstyle = "sim"; 
// 上面的变量为设置默认的风格(sim=[灰色天空],yel=[粉色情人],sum=[清爽夏日])

// ============================================================================


error_reporting(E_CORE_ERROR);
set_time_limit(0);
header("Content-Type: text/html; charset=gb2312");

$mtime = explode(" ", microtime());
$starttime = $mtime[1] + $mtime[0];

if(!get_cfg_var("register_globals")){
	foreach($HTTP_GET_VARS as $key => $val){
		$$key = $val;
	}
	foreach($HTTP_POST_VARS as $key => $val){
		$$key = $val;
	}
}

//if(!$style)
if(!$style) $style = $defstyle; 

$PHP_SELF = $HTTP_SERVER_VARS[PHP_SELF] ? $HTTP_SERVER_VARS[PHP_SELF] : $HTTP_SERVER_VARS[SCRIPT_NAME];

$phpos = PHP_OS;
if($phpos=="BSD" || $phpos=="FreeBSD" || $phpos=="Linux" ||$phpos=="NetBSD" || $phpos=="OpenBSD" || $phpos=="Darwin"){
	$osinfo = uptime();
}else{
	$osinfo = "对不起".$phpos."系统不支持";
}

if(get_cfg_var("safemode")){
	$safemode = "是";
}else {
	$safemode = "否";
}

if (get_cfg_var("file_uploads") == "1"){
	$upsize = get_cfg_var("upload_max_filesize");
}else {
	$upsize = "不允许上传";
}

if (isset($_SERVER["SERVER_ADMIN"])){
	$adminmail = "<a href=\"mailto:".$_SERVER["SERVER_ADMIN"]."\" title=\"发送邮件\">".$_SERVER["SERVER_ADMIN"]."</a>";
}else{
	$adminmail = "<a href=\"mailto:".get_cfg_var("sendmail_from")."\" title=\"发送邮件\">".get_cfg_var("sendmail_from")."</a>";
}

$dis_func = get_cfg_var("disable_functions");
if ($dis_func == ""){
	$dis_func = "<span class=\"false\" ><b>×</b></span>";
}else {
	$dis_func = str_replace(" ","<br />",$dis_func);
	$dis_func = str_replace(",","<br />",$dis_func);
}

if(ereg("phpinfo",$dis_func)){
	$phpinfo = "<span class=\"false\"><b>×</b></span><span class=\"s\">PHPINFO</span>";
}else{
	$phpinfo = "<span class=\"ture\"><b>√</b></span><a href=\"$PHP_SELF?style=$style&testinfo=phpinfo#bottom\" title=\"点此查看PHPINFO细信息\">PHPINFO</a>";
}


// -----------------------------------------------------------
function find_program ($program)
{
    $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
    while ($this_path = current($path)) {
        if (is_executable("$this_path/$program")) {
        return "$this_path/$program";
    }
    next($path);
    }
    return;
}

function execute_program ($program, $args = '')
{
    $buffer = '';
    $program = find_program($program);

    if (!$program) { return; }

    // see if we've gotten a |, if we have we need to do patch checking on the cmd
    if ($args) {
        $args_list = split(' ', $args);
        for ($i = 0; $i < count($args_list); $i++) {
            if ($args_list[$i] == '|') {
                $cmd = $args_list[$i+1];
                $new_cmd = find_program($cmd);
                $args = ereg_replace("\| $cmd", "| $new_cmd", $args);
            }
        }
    }
}
	    function grab_key ($key)
    {
        return execute_program('sysctl', "-n $key");
    }

	   function get_sys_ticks ()
    {
        $s = explode(' ', grab_key('kern.boottime'));
        $a = ereg_replace('{ ', '', $s[3]);
        $sys_ticks = time() - $a;
        return $sys_ticks;
    }
	    function uptime ()
    {
        if(PHP_OS=="Linux"){
		$fd = fopen('/proc/uptime', 'r');
        $ar_buf = split(' ', fgets($fd, 4096));
        fclose($fd);

        $sys_ticks = trim($ar_buf[0]);
		}else{
		$sys_ticks = get_sys_ticks();
		}

        $min   = $sys_ticks / 60;
        $hours = $min / 60;
        $days  = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min   = floor($min - ($days * 60 * 24) - ($hours * 60));

        if ($days != 0) {
            $result = "".$days."日";
        }

        if ($hours != 0) {
            $result .= "".$hours."小时";
        }
        $result .= "".$min."分钟";

        return "$result";

    }
// -----------------------------------------------------------
	function gettimeout(){
		GLOBAL $starttime;

		$mtime = explode(" ", microtime());
		$endtime = $mtime[1] + $mtime[0];
		$totaltime = ($endtime - $starttime);
		$totaltime = number_format($totaltime, 7);
		$debuginfo = "Processed in $totaltime second(s)";
		return $debuginfo;
	}


	function issupp($func_name,$func="function_exists")
	{
		if ($func($func_name)){
			$su = "<span class=\"ture\"><b>√</b></span>";
		}else {
			$su = "<span class=\"false\"><b>x</b></span>";
		}
		return $su;
	}
	
	function int_test()
	{		
		$time_start=gettimeofday();
		for($index=0;$index<=3000000;$index++);
		{
			$count=1+1;
		}
		$time_end=gettimeofday();
		$time=($time_end["usec"]-$time_start["usec"])/1000000;
		$time=$time+$time_end["sec"]-$time_start["sec"];
		$time=round($time*1000)/1000;
		return($time);		
	}
	
	function float_test()
	{
		$test=pi();
		$time_start=gettimeofday();
		for($index=0;$index<=3000000;$index++);
		{
			sqrt($test);
		}
		$time_end=gettimeofday();
		$time=($time_end["usec"]-$time_start["usec"])/1000000;
		$time=$time+$time_end["sec"]-$time_start["sec"];
		$time=round($time*1000)/1000;
		return($time);
	}
	
	function io_test()
	{
		global $PHP_SELF;
		$fp=fopen(".$PHP_SELF","r");
		$time_start=gettimeofday();
		for($index=0;$index<10000;$index++)
		{
			fread($fp,10240);
			rewind($fp);
		}
		$time_end=gettimeofday();
		fclose($fp);
		$time=($time_end["usec"]-$time_start["usec"])/1000000;
		$time=$time+$time_end["sec"]-$time_start["sec"];
		$time=round($time*1000)/1000;
		return($time);
	}

	if ($test)
	{
		switch($test)
		{
			case "int":
				$vint	= int_test();
				break;
			case "float":
				$vfloat	= float_test();
				break;
			case "io":
				$vio	= io_test();
				break;
		}
	}

	function te_val($val){
			if($val){
				if($val == '0'){
					$vale = "小于0.001秒";
				}else{
					$vale = $val."秒";
				}
			}else{
				$vale = "未测试";
			}
	return $vale;
	}




if($style == "sim"){
	$skin[bdcolor]	= "#ffffff";	// 底色
	$skin[tdfont]	= "#666666";	// 表格里字体颜色
	$skin[tdborder] = "#cccccc";	// 边框颜色
	$skin[tdbg]		= "#fcfcfc";	// 表格里背景色
	$skin[flink]	= "#336699";	// 链接颜色
	$skin[fhove]	= "#b4c8d8";	// 访问时颜色
}elseif($style == "red"){
	$skin[bdcolor]	= "#ffffff";	// 底色
	$skin[tdfont]	= "#333333";	// 表格里字体颜色
	$skin[tdborder] = "#FF6600";	// 边框颜色
	$skin[tdbg]		= "#FFAC84";	// 表格里背景色
	$skin[flink]	= "#FF3399";	// 链接颜色
	$skin[fhove]	= "#FF9999";	// 访问时颜色
}elseif($style == "blu"){
	$skin[bdcolor]	= "#ffffff";	// 底色
	$skin[tdfont]	= "#626262";	// 表格里字体颜色
	$skin[tdborder] = "#009900";	// 边框颜色
	$skin[tdbg]		= "#D1FCF9";	// 表格里背景色
	$skin[flink]	= "#33CC99";	// 链接颜色
	$skin[fhove]	= "#0099FF";	// 访问时颜色
}


$info[0]  = array("服务器时间",date("Y年m月d日 h:i:s",time()));
$info[1]  = array("服务器域名","<a href=\"http://$_SERVER[SERVER_NAME]\"  title=\"访问此域名\" target=\"_blank\">$_SERVER[SERVER_NAME]</a>");
$info[2]  = array("服务器IP地址",gethostbyname($_SERVER["SERVER_NAME"]));
$info[3]  = array("服务器操作系统",PHP_OS);
$info[4]  = array("服务器运行时间",$osinfo);
$info[5]  = array("服务器操作系统文字编码",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$info[6]  = array("服务器解译引擎",$_SERVER["SERVER_SOFTWARE"]);
$info[7]  = array("Web服务端口",$_SERVER["SERVER_PORT"]);
$info[8]  = array("PHP运行方式",strtoupper(php_sapi_name()));
$info[9]  = array("PHP版本",PHP_VERSION);
$info[10] = array("运行于安全模式",$safemode);
$info[11] = array("服务器管理员",$adminmail);
$info[12] = array("本文件路径",$_SERVER["SCRIPT_FILENAME"]);

$info[13] = array("允许使用URL打开文件allow_url_fopen",issupp("allow_url_fopen","get_cfg_var"));
$info[14] = array("允许动态加载链接库enable_dl",issupp("enable_dl","get_cfg_var"));
$info[15] = array("显示错误信息display_errors",issupp("display_errors","get_cfg_var"));
$info[16] = array("自动定义全局变量register_globals",issupp("register_globals","get_cfg_var"));
$info[17] = array("程序最多允许使用内存量memory_limit",get_cfg_var("memory_limit"));
$info[18] = array("POST最大字节数post_max_size",get_cfg_var("post_max_size"));
$info[19] = array("允许最大上传文件upload_max_filesize",$upsize);
$info[20] = array("程序最长运行时间max_execution_time",get_cfg_var("max_execution_time")."秒");
$info[21] = array("被禁用的函数disable_functions",$dis_func);
$info[22] = array("PHP信息PHPINFO",$phpinfo);
$info[23] = array("目前还有空余空间diskfreespace",intval(diskfreespace(".") / (1024 * 1024)).'Mb');

$info[24] = array("拼写检查 ASpell Library",issupp("aspell_new"));
$info[25] = array("高精度数学运算 BCMath",issupp("bcadd"));
$info[26] = array("历法运算 Calendar",issupp("JDToGregorian"));
$info[27] = array("DBA数据库",issupp("dba_close"));
$info[28] = array("dBase数据库",issupp("dbase_close"));
$info[29] = array("DBM数据库",issupp("dbmclose"));
$info[30] = array("FDF表单资料格式 Forms Data Format",issupp("FDF_close"));
$info[31] = array("FilePro数据库",issupp("filepro"));
$info[32] = array("Hyperwave数据库",issupp("hw_close"));
$info[33] = array("图形处理 GD Library",issupp("imageline"));
$info[34] = array("IMAP电子邮件系统",issupp("imap_close"));
$info[35] = array("Informix数据库",issupp("ifx_close"));
$info[36] = array("InterBase数据库",issupp("ibase_close"));
$info[37] = array("LDAP目录协议",issupp("ldap_close"));
$info[38] = array("MCrypt加密处理",issupp("mcrypt_cbc"));
$info[39] = array("哈稀计算 MHash",issupp("mhash"));
$info[40] = array("mSQL数据库",issupp("msql_close"));
$info[41] = array("SQL Server数据库",issupp("mssql_close"));
$info[42] = array("MySQL数据库",issupp("mysql_close"));
$info[43] = array("SyBase数据库",issupp("sybase_close"));
$info[44] = array("Yellow Page系统",issupp("yp_match"));
$info[45] = array("Oracle数据库",issupp("ora_close"));
$info[46] = array("Oracle 8 数据库",issupp("OCILogOff"));
$info[47] = array("PREL相容语法 PCRE",issupp("preg_match"));
$info[48] = array("PDF文档支持",issupp("pdf_close"));
$info[49] = array("Postgre SQL数据库",issupp("pg_close"));
$info[50] = array("SNMP网络管理协议",issupp("snmpget"));
$info[51] = array("VMailMgr邮件处理",issupp("vm_adduser"));
$info[52] = array("WDDX支持(Web Distributed Data Exchange)",issupp("wddx_add_vars"));
$info[53] = array("压缩文件支持(Zlib)",issupp("gzclose"));
$info[54] = array("XML解析",issupp("xml_set_object"));
$info[55] = array("FTP",issupp("ftp_login"));
$info[56] = array("ODBC数据库连接",issupp("odbc_close"));
$info[57] = array("Session支持",issupp("session_start"));
$info[58] = array("Socket支持",issupp("fsockopen"));

?>