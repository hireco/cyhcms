// JavaScript Document
//У���Ƿ�ȫ���������
function isDigit(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[0-9]{1,20}$/;
if (!patrn.test(s)) { alert("����Ҫ��������"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У���¼����ֻ������5-20������ĸ��ͷ���ɴ����֡���_������.�����ִ�
function isRegisterUserName(id){ 
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/; 
if(!patrn.test(s)) { alert("�û���������Ҫ��"); obj.value="";  obj.focus();  return false;} 
return true;
} 
//У���û�������ֻ������1-30������ĸ��ͷ���ִ�

function isTrueName(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z]{1,30}$/;
if (!patrn.test(s)) { alert("Ӣ������������Ҫ��"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У���û���������
function isChineseName(id)
{
var obj=document.getElementById(id);
var s=obj.value;
if (s.match(/[^\u4e00-\u9fa5]/gi)) { alert("ֻ��д����"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У�����룺ֻ������5-20����ĸ�����֡��»���
function isPasswd(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^(\w){6,20}$/;
if (!patrn.test(s)) { alert("���벻����Ҫ��"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У����ͨ�绰��������룺���ԡ�+����ͷ���������⣬�ɺ��С�-��

function isTel(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
if (!patrn.test(s)) { alert("�绰���벻���ϸ�ʽ"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У���ֻ����룺���������ֿ�ͷ���������⣬�ɺ��С�-��

function isMobil(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
if (!patrn.test(s)) { alert("�ֻ������ʽ������"); obj.value="";  obj.focus();  return false;} 
return true;
}

//У����������

function isPostalCode(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[a-zA-Z0-9 ]{3,12}$/;
if (!patrn.test(s)) { alert("���������ʽ������"); obj.value="";  obj.focus();  return false;} 
return true;
}

function isQQ(id)
{
var obj=document.getElementById(id);
var s=obj.value;
var patrn=/^[1-9]\d{4,10}$/;
if (!patrn.test(s)) { alert("QQ��ʽ������"); obj.value="";  obj.focus();  return false;} 
return true;
}

//�����ʼ���ַ========================================================
//mail.js 
function char_test(chr) 
//�ַ���⺯�� 
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
//���ֺ������ַ���⺯�� 
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
//��@������λ�� 
var dot_symbol=0; 
//��.������λ�� 
if(char_test(str.charAt(0))==0 ) 
  return (1); 
//���ַ���������ĸ 

for (i=1;i<str.length;i++) 
  if(str.charAt(i)=='@') 
    { 
    at_symbol=i; 
    break; 
    } 
//��⡰@����λ�� 

if(at_symbol==str.length-1 || at_symbol==0) 
  return(2); 
//û���ʼ����������� 

if(at_symbol<3) 
  return(3); 
//�ʺ����������ַ� 

if(at_symbol>19 ) 
  return(4); 
//�ʺŶ���ʮ�Ÿ��ַ� 

for(i=1;i<at_symbol;i++) 
  if(char_test(str.charAt(i))==0 && spchar_test(str.charAt(i))==0) 
    return (5); 
for(i=at_symbol+1;i<str.length;i++) 
  if(char_test(str.charAt(i))==0 && spchar_test(str.charAt(i))==0) 
    return (5); 
//�����������������ַ�    
    
for(i=at_symbol+1;i<str.length;i++) 
  if(str.charAt(i)=='.') dot_symbol=i; 
for(i=at_symbol+1;i<str.length;i++)  
  if(dot_symbol==0 || dot_symbol==str.length-1) 
//�򵥵ļ����û�С�.������ȷ�����������Ƿ�Ϸ� 
  return (6); 
   
return (0);  
//�ʼ����Ϸ� 
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
      str="���ַ���������ĸ������Ϊ�գ��뷵�����"; 
      break; 
   case 2: 
      str="��������д�ʼ��������ĵ�ַ�ˣ��뷵�����"; 
      break;     
   case 3: 
      str="�����ʺ�̫�̣��������������ַ�!�뷵�����"; 
      break; 
   case 4: 
      str="�����ʺ�̫�������ܶ���ʮ�Ÿ��ַ�!�뷵�����"; 
      break; 
   case 5: 
      str="��ʹ���˷Ƿ��ַ�!�뷵�����"; 
      break; 
   case 6: 
      str="�����ʼ��������ĵ�ַ���Ϸ�!�뷵�����"; 
      break; 
   default: 
      str="����email��ַ���Ϸ�!�뷵�����"; 
  } 
 alert(str);  obj.value="";  obj.focus();   return false;
 
 }  
} 
//�����ַ�����
//--------------------------------------
/**   
 * У�������������Ƿ����������   
 * ��Ҫ���˵ķ���д��������ʽ�У�ע�⣬һЩ����Ҫ��'\'ת��.   
 * Ҫת����ַ�������1�� ��� .   
 *                   2,  ������ []   
 *                   3,  ������ {}   
 *                   4,  �Ӻ�   +   
 *                   5,  �Ǻ�   *   
 *                   6,  ����   -   
 *                   7,  б��   \   
 *                   8,  ����   |   
 *                   9,  ���   ^   
 *                   10, Ǯ��   $   
 *                   11, �ʺ�   ��   
 * ������   
 * if(checkAllTextValid(document.forms[0]))   
 *  alert("���������ı���ͨ��У�飡");   
 */   
function checkAllTextValid(form)    
{    
    //��¼�������ŵ��ı�������    
 var resultTag = 0;    
    //��¼����text�ı�������    
    var flag = 0;    
 for(var i = 0; i < form.elements.length; i ++)    
 {    
  if(form.elements[i].type=="text")    
  {    
            flag = flag + 1;    
   //�˴���д��Ҫ���˵��������    
   //ע�⣺�޸�####�����ַ����������ֲ����޸�.    
   //if(/^[^####]*$/.test(form.elements[i].value))     
   
   if(/^[^\|"'<>]*$/.test(form.elements[i].value))   
                resultTag = resultTag+1;   
   else   
    form.elements[i].select();   
  }   
 }   
  
    /**   
     * ��������ŵ��ı������ȫ���ı����ֵ����У��ͨ��   
     */   
 if(resultTag == flag)   
  return true;   
 else   
 {   
  alert("�ı����в��ܺ���\n\n 1 ������: ' \n 2 ˫����: \" \n 3 ��  ��: | \n 4 ��Ǻ�: < > \n\n�������룡");    
  return false;    
 }    
}    
   


