<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
////////////////////////////////////////////
//�����������仰��˵��������ʹ�õķ�������֧��PHP
////////////////////////////////////////////


// =================== ���±���Ϊ�û�ѡ��,�������ľ���������� ====================

	$admessage = "��������Ƽ����������罨վ�����,<br>
	<a href=http://www.hongmian.net target=_blank>www.hongmian.net".
	"</a><br>������һ�����ø��ã�";
// ������̽������������ʾ�ģ��������������������������Ϣ(����ʾ��ҳ��ײ�,֧��html)

	$defstyle = "sim"; 
// ����ı���Ϊ����Ĭ�ϵķ��(sim=[��ɫ���],yel=[��ɫ����],sum=[��ˬ����])

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
	$osinfo = "�Բ���".$phpos."ϵͳ��֧��";
}

if(get_cfg_var("safemode")){
	$safemode = "��";
}else {
	$safemode = "��";
}

if (get_cfg_var("file_uploads") == "1"){
	$upsize = get_cfg_var("upload_max_filesize");
}else {
	$upsize = "�������ϴ�";
}

if (isset($_SERVER["SERVER_ADMIN"])){
	$adminmail = "<a href=\"mailto:".$_SERVER["SERVER_ADMIN"]."\" title=\"�����ʼ�\">".$_SERVER["SERVER_ADMIN"]."</a>";
}else{
	$adminmail = "<a href=\"mailto:".get_cfg_var("sendmail_from")."\" title=\"�����ʼ�\">".get_cfg_var("sendmail_from")."</a>";
}

$dis_func = get_cfg_var("disable_functions");
if ($dis_func == ""){
	$dis_func = "<span class=\"false\" ><b>��</b></span>";
}else {
	$dis_func = str_replace(" ","<br />",$dis_func);
	$dis_func = str_replace(",","<br />",$dis_func);
}

if(ereg("phpinfo",$dis_func)){
	$phpinfo = "<span class=\"false\"><b>��</b></span><span class=\"s\">PHPINFO</span>";
}else{
	$phpinfo = "<span class=\"ture\"><b>��</b></span><a href=\"$PHP_SELF?style=$style&testinfo=phpinfo#bottom\" title=\"��˲鿴PHPINFOϸ��Ϣ\">PHPINFO</a>";
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
            $result = "".$days."��";
        }

        if ($hours != 0) {
            $result .= "".$hours."Сʱ";
        }
        $result .= "".$min."����";

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
			$su = "<span class=\"ture\"><b>��</b></span>";
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
					$vale = "С��0.001��";
				}else{
					$vale = $val."��";
				}
			}else{
				$vale = "δ����";
			}
	return $vale;
	}




if($style == "sim"){
	$skin[bdcolor]	= "#ffffff";	// ��ɫ
	$skin[tdfont]	= "#666666";	// �����������ɫ
	$skin[tdborder] = "#cccccc";	// �߿���ɫ
	$skin[tdbg]		= "#fcfcfc";	// ����ﱳ��ɫ
	$skin[flink]	= "#336699";	// ������ɫ
	$skin[fhove]	= "#b4c8d8";	// ����ʱ��ɫ
}elseif($style == "red"){
	$skin[bdcolor]	= "#ffffff";	// ��ɫ
	$skin[tdfont]	= "#333333";	// �����������ɫ
	$skin[tdborder] = "#FF6600";	// �߿���ɫ
	$skin[tdbg]		= "#FFAC84";	// ����ﱳ��ɫ
	$skin[flink]	= "#FF3399";	// ������ɫ
	$skin[fhove]	= "#FF9999";	// ����ʱ��ɫ
}elseif($style == "blu"){
	$skin[bdcolor]	= "#ffffff";	// ��ɫ
	$skin[tdfont]	= "#626262";	// �����������ɫ
	$skin[tdborder] = "#009900";	// �߿���ɫ
	$skin[tdbg]		= "#D1FCF9";	// ����ﱳ��ɫ
	$skin[flink]	= "#33CC99";	// ������ɫ
	$skin[fhove]	= "#0099FF";	// ����ʱ��ɫ
}


$info[0]  = array("������ʱ��",date("Y��m��d�� h:i:s",time()));
$info[1]  = array("����������","<a href=\"http://$_SERVER[SERVER_NAME]\"  title=\"���ʴ�����\" target=\"_blank\">$_SERVER[SERVER_NAME]</a>");
$info[2]  = array("������IP��ַ",gethostbyname($_SERVER["SERVER_NAME"]));
$info[3]  = array("����������ϵͳ",PHP_OS);
$info[4]  = array("����������ʱ��",$osinfo);
$info[5]  = array("����������ϵͳ���ֱ���",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$info[6]  = array("��������������",$_SERVER["SERVER_SOFTWARE"]);
$info[7]  = array("Web����˿�",$_SERVER["SERVER_PORT"]);
$info[8]  = array("PHP���з�ʽ",strtoupper(php_sapi_name()));
$info[9]  = array("PHP�汾",PHP_VERSION);
$info[10] = array("�����ڰ�ȫģʽ",$safemode);
$info[11] = array("����������Ա",$adminmail);
$info[12] = array("���ļ�·��",$_SERVER["SCRIPT_FILENAME"]);

$info[13] = array("����ʹ��URL���ļ�allow_url_fopen",issupp("allow_url_fopen","get_cfg_var"));
$info[14] = array("����̬�������ӿ�enable_dl",issupp("enable_dl","get_cfg_var"));
$info[15] = array("��ʾ������Ϣdisplay_errors",issupp("display_errors","get_cfg_var"));
$info[16] = array("�Զ�����ȫ�ֱ���register_globals",issupp("register_globals","get_cfg_var"));
$info[17] = array("�����������ʹ���ڴ���memory_limit",get_cfg_var("memory_limit"));
$info[18] = array("POST����ֽ���post_max_size",get_cfg_var("post_max_size"));
$info[19] = array("��������ϴ��ļ�upload_max_filesize",$upsize);
$info[20] = array("���������ʱ��max_execution_time",get_cfg_var("max_execution_time")."��");
$info[21] = array("�����õĺ���disable_functions",$dis_func);
$info[22] = array("PHP��ϢPHPINFO",$phpinfo);
$info[23] = array("Ŀǰ���п���ռ�diskfreespace",intval(diskfreespace(".") / (1024 * 1024)).'Mb');

$info[24] = array("ƴд��� ASpell Library",issupp("aspell_new"));
$info[25] = array("�߾�����ѧ���� BCMath",issupp("bcadd"));
$info[26] = array("�������� Calendar",issupp("JDToGregorian"));
$info[27] = array("DBA���ݿ�",issupp("dba_close"));
$info[28] = array("dBase���ݿ�",issupp("dbase_close"));
$info[29] = array("DBM���ݿ�",issupp("dbmclose"));
$info[30] = array("FDF�����ϸ�ʽ Forms Data Format",issupp("FDF_close"));
$info[31] = array("FilePro���ݿ�",issupp("filepro"));
$info[32] = array("Hyperwave���ݿ�",issupp("hw_close"));
$info[33] = array("ͼ�δ��� GD Library",issupp("imageline"));
$info[34] = array("IMAP�����ʼ�ϵͳ",issupp("imap_close"));
$info[35] = array("Informix���ݿ�",issupp("ifx_close"));
$info[36] = array("InterBase���ݿ�",issupp("ibase_close"));
$info[37] = array("LDAPĿ¼Э��",issupp("ldap_close"));
$info[38] = array("MCrypt���ܴ���",issupp("mcrypt_cbc"));
$info[39] = array("��ϡ���� MHash",issupp("mhash"));
$info[40] = array("mSQL���ݿ�",issupp("msql_close"));
$info[41] = array("SQL Server���ݿ�",issupp("mssql_close"));
$info[42] = array("MySQL���ݿ�",issupp("mysql_close"));
$info[43] = array("SyBase���ݿ�",issupp("sybase_close"));
$info[44] = array("Yellow Pageϵͳ",issupp("yp_match"));
$info[45] = array("Oracle���ݿ�",issupp("ora_close"));
$info[46] = array("Oracle 8 ���ݿ�",issupp("OCILogOff"));
$info[47] = array("PREL�����﷨ PCRE",issupp("preg_match"));
$info[48] = array("PDF�ĵ�֧��",issupp("pdf_close"));
$info[49] = array("Postgre SQL���ݿ�",issupp("pg_close"));
$info[50] = array("SNMP�������Э��",issupp("snmpget"));
$info[51] = array("VMailMgr�ʼ�����",issupp("vm_adduser"));
$info[52] = array("WDDX֧��(Web Distributed Data Exchange)",issupp("wddx_add_vars"));
$info[53] = array("ѹ���ļ�֧��(Zlib)",issupp("gzclose"));
$info[54] = array("XML����",issupp("xml_set_object"));
$info[55] = array("FTP",issupp("ftp_login"));
$info[56] = array("ODBC���ݿ�����",issupp("odbc_close"));
$info[57] = array("Session֧��",issupp("session_start"));
$info[58] = array("Socket֧��",issupp("fsockopen"));

?>