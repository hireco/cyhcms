// JavaScript Document
//校验是否全由数字组成
function isDigit(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[0-9]{1,20}$/;
if (!patrn.test(s)) { alert("此域要求是数字"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验登录名：只能输入5-20个以字母开头、可带数字、“_”、“.”的字串
function isRegisterUserName(id){ 
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/; 
if(!patrn.test(s)) { alert("用户名不符合要求"); obj.value="";  obj.focus();  return false;} 
return true;
} 
//校验用户姓名：只能输入1-30个以字母开头的字串

function isTrueName(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z]{1,30}$/;
if (!patrn.test(s)) { alert("英文姓名不符合要求"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验用户中文姓名
function isChineseName(id)
{
var obj=document.getElementById(id);
var s=obj.value;
if (s.match(/[^\u4e00-\u9fa5]/gi)) { alert("只能写中文"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验密码：只能输入5-20个字母、数字、下划线
function isPasswd(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^(\w){6,20}$/;
if (!patrn.test(s)) { alert("密码不符合要求"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验普通电话、传真号码：可以“+”开头，除数字外，可含有“-”

function isTel(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
if (!patrn.test(s)) { alert("电话号码不符合格式"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验手机号码：必须以数字开头，除数字外，可含有“-”

function isMobil(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
if (!patrn.test(s)) { alert("手机号码格式不符合"); obj.value="";  obj.focus();  return false;} 
return true;
}

//校验邮政编码

function isPostalCode(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z0-9 ]{3,12}$/;
if (!patrn.test(s)) { alert("邮政编码格式不符合"); obj.value="";  obj.focus();  return false;} 
return true;
}

function isQQ(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[1-9]\d{4,10}$/;
if (!patrn.test(s)) { alert("QQ格式不符合"); obj.value="";  obj.focus();  return false;} 
return true;
}

//检验邮件地址========================================================
//mail.js 
function char_test(chr) 
//字符检测函数 
{ 
var i; 
var smallch="abcdefghijklmnopqrstuvwxyz"; 
var bigch="ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
for(i=0;i<26;i++) 
  if(chr==smallch.charAt(i) || chr==bigch.charAt(i)) 
    return(1); 
return(0); 
} 

function spchar_test(chr) 
//数字和特殊字符检测函数 
{ 
var i; 
var spch="_-.0123456789"; 
for (i=0;i<13;i++) 
   if(chr==spch.charAt(i)) 
    return(1); 
return(0); 
} 

function email_test(str) 
{ 
var i,flag=0; 
var at_symbol=0; 
//“@”检测的位置 
var dot_symbol=0; 
//“.”检测的位置 
if(char_test(str.charAt(0))==0 ) 
  return (1); 
//首字符必须用字母 

for (i=1;i<str.length;i++) 
  if(str.charAt(i)=='@') 
    { 
    at_symbol=i; 
    break; 
    } 
//检测“@”的位置 

if(at_symbol==str.length-1 || at_symbol==0) 
  return(2); 
//没有邮件服务器域名 

if(at_symbol<3) 
  return(3); 
//帐号少于三个字符 

if(at_symbol>19 ) 
  return(4); 
//帐号多于十九个字符 

for(i=1;i<at_symbol;i++) 
  if(char_test(str.charAt(i))==0 && spchar_test(str.charAt(i))==0) 
    return (5); 
for(i=at_symbol+1;i<str.length;i++) 
  if(char_test(str.charAt(i))==0 && spchar_test(str.charAt(i))==0) 
    return (5); 
//不能用其它的特殊字符    
    
for(i=at_symbol+1;i<str.length;i++) 
  if(str.charAt(i)=='.') dot_symbol=i; 
for(i=at_symbol+1;i<str.length;i++)  
  if(dot_symbol==0 || dot_symbol==str.length-1) 
//简单的检测有没有“.”，以确定服务器名是否合法 
  return (6); 
   
return (0);  
//邮件名合法 
} 

 
<!-- 
function chk_mail(id) 
{ 
var obj=document.getElementById(id);
var stringin=obj.value;
var num=email_test(stringin); 
var str=""; 
if (num!=0) 
{ 
switch (num) 
  { 
   case 1: 
      str="首字符必须用字母！或不能为空！请返回重填。"; 
      break; 
   case 2: 
      str="您忘了填写邮件服务器的地址了！请返回重填。"; 
      break;     
   case 3: 
      str="您的帐号太短，不能少于三个字符!请返回重填。"; 
      break; 
   case 4: 
      str="您的帐号太长，不能多于十九个字符!请返回重填。"; 
      break; 
   case 5: 
      str="您使用了非法字符!请返回重填。"; 
      break; 
   case 6: 
      str="您的邮件服务器的地址不合法!请返回重填。"; 
      break; 
   default: 
      str="您的email地址不合法!请返回重填。"; 
  } 
 alert(str);  obj.value="";  obj.focus();   return false;
 
 }  
} 
//特殊字符过滤
//--------------------------------------
/**   
 * 校验所有输入域是否含有特殊符号   
 * 所要过滤的符号写入正则表达式中，注意，一些符号要用'\'转义.   
 * 要转义的字符包括：1， 点号 .   
 *                   2,  中括号 []   
 *                   3,  大括号 {}   
 *                   4,  加号   +   
 *                   5,  星号   *   
 *                   6,  减号   -   
 *                   7,  斜杠   \   
 *                   8,  竖线   |   
 *                   9,  尖号   ^   
 *                   10, 钱币   $   
 *                   11, 问号   ？   
 * 试例：   
 * if(checkAllTextValid(document.forms[0]))   
 *  alert("表单中所有文本框通过校验！");   
 */   
function checkAllTextValid(form)    
{    
    //记录不含引号的文本框数量    
 var resultTag = 0;    
    //记录所有text文本框数量    
    var flag = 0;    
 for(var i = 0; i < form.elements.length; i ++)    
 {    
  if(form.elements[i].type=="text")    
  {    
            flag = flag + 1;    
   //此处填写所要过滤的特殊符号    
   //注意：修改####处的字符，其它部分不许修改.    
   //if(/^[^####]*$/.test(form.elements[i].value))     
   
   if(/^[^\|"'<>]*$/.test(form.elements[i].value))   
                resultTag = resultTag+1;   
   else   
    form.elements[i].select();   
  }   
 }   
  
    /**   
     * 如果含引号的文本框等于全部文本框的值，则校验通过   
     */   
 if(resultTag == flag)   
  return true;   
 else   
 {   
  alert("文本框中不能含有\n\n 1 单引号: ' \n 2 双引号: \" \n 3 竖  杠: | \n 4 尖角号: < > \n\n请检查输入！");    
  return false;    
 }    
}    
   


