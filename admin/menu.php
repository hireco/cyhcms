<?php 
session_start(); 
require_once("setting.php");
require_once("inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<title>菜 单</title>

<style type="text/css">
<!--
body {
	height:100%;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(image/index_30.jpg);
}
#high {height: 100%;}
-->
</style>
</head>
<body>
<table id="high" width="160" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td rowspan="2" align="center" valign="top">
		  <table width="100%" height="50"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
		  <style type="text/css">
<!--
*{margin:0;padding:0;border:0;}
body {
 font-family: arial, 宋体, serif;
 font-size:12px;
}
#nav {
 width:140px;
    line-height: 24px; 
 list-style-type: none;
 text-align:left;
    /*定义整个ul菜单的行高和背景色*/
}

/*==================一级目录===================*/
#nav a {
 width: 140px; 
 display: block;
 padding-left:20px;
 /*Width(一定要)，否则下面的Li会变形*/
}

#nav li {
 background:none; /*一级目录的背景色*/
 border-bottom:#fff 1px solid; /*下面的一条白边*/
 float:left;
 /*float：left,本不应该设置，但由于在Firefox不能正常显示
 继承Nav的width,限制宽度，li自动向下延伸*/
}

#nav li a:hover{
 background:#CC0000; /*一级目录onMouseOver显示的背景色*/
}

#nav a:link  {
 color:#666; text-decoration:none;
}
#nav a:visited  {
 color:#666;text-decoration:none;
}
#nav a:hover  {
 color:#FFF;text-decoration:none;font-weight:bold;
}

/*==================二级目录===================*/
#nav li ul {
 list-style:none;
 text-align:left;
}
#nav li ul li{ 
 background: #EBEBEB; /*二级目录的背景色*/
}

#nav li ul a{
         padding-left:40px;
         width:140px;
 /* padding-left二级目录中文字向右移动，但Width必须重新设置=(总宽度-padding-left)*/
}

/*下面是二级目录的链接样式*/

#nav li ul a:link  {
 color:#666; text-decoration:none;
}
#nav li ul a:visited  {
 color:#666;text-decoration:none;
}
#nav li ul a:hover {
 color:#F3F3F3;
 text-decoration:none;
 font-weight:normal;
 background:#3366FF;
 /* 二级onmouseover的字体颜色、背景色*/
}

/*==============================*/
#nav li:hover ul {
 left: auto;
}
#nav li.sfhover ul {
 left: auto;
}
#content {
 clear: left; 
}
#nav ul.collapsed {
 display: none;
}
-->

#PARENT{
 width:140px;
 padding-left:0px;
}
    </style>
            <table width="140"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="middle">
                  <div id="PARENT">
                    <ul id="nav">
					  <li><a href="admin.php" target=frmright >管理首页</a></li>					  
					  <li><a href="#Menu=ChildMenu1" onclick="DoMenu('ChildMenu1')">频道管理</a>
                          <ul id="ChildMenu1" class="collapsed">
                            <?php 
							$query="select * from ".$table_suffix."infor_class order by id asc";
							$result=mysql_query($query); 
							while($row=mysql_fetch_object($result)) {
							?>
							<li><a href="infor.php?infor_class=<?=$row->class_name?>" target=frmright><?=$row->chinese_name?></a></li>
                           <?php } ?>						   
                          </ul>
                      </li>                      
                      <li><a href="infor_all.php" target=frmright>内容管理</a></li> 
					  <li><a href="chapter_admin.php" target=frmright>课程设置</a></li> 
					  <li><a href="#Menu=ChildMenu7" onclick="DoMenu('ChildMenu7')">问答管理</a>
                          <ul id="ChildMenu7" class="collapsed">
                            <li><a href="ask_admin.php" target=frmright>问题列表</a></li>
                            <li><a href="asker_admin.php" target=frmright>人员列表</a></li>
                          </ul>
                      </li> 
					  <li><a href="#Menu=ChildMenu8" onclick="DoMenu('ChildMenu8')">在线测试</a>
                          <ul id="ChildMenu8" class="collapsed">
                            <li><a href="test_admin.php" target=frmright>试题管理</a></li>
                            <li><a href="test.php" target=frmright>添加试题</a></li>
							<li><a href="test_record_admin.php" target=frmright>测试记录</a></li>
                          </ul>
                      </li>
					  <li><a href="#Menu=ChildMenu4" onclick="DoMenu('ChildMenu4')">附加功能</a>
                          <ul id="ChildMenu4" class="collapsed">
						    <li><a href="add_apply.php?add_apply=kanwu.php" target=frmright>每周刊物</a></li>
							<li><a href="add_apply.php?add_apply=comment.php" target=frmright>评论管理</a></li>
                            <li><a href="add_apply.php?add_apply=fri_link_admin.php" target=frmright>友情链接</a></li>
                            <li><a href="add_apply.php?add_apply=poll_admin.php" target=frmright>调查投票</a></li>
							<li><a href="add_apply.php?add_apply=guestbook.php" target=frmright>留言管理</a></li>
							<li><a href="add_apply.php?add_apply=inner_infor.php" target=frmright>站内信息</a></li>
                          </ul>
                      </li>
					  <li><a href="keywords.php?infor_class=b" target=frmright>标签统计</a></li>
					  <li><a href="html_edit.php" target=frmright >静态文件</a></li>
					  <li><a href="sys_config.php?action_do=base" target=frmright >系统设置</a></li>   
					  <li><a href="#Menu=ChildMenu5" onclick="DoMenu('ChildMenu5')">会员管理</a>
                          <ul id="ChildMenu5" class="collapsed">
                            <li><a href="member_admin.php" target=frmright>普通会员</a></li>
                            <li><a href="admin_id_edit.php" target=frmright>管理会员</a></li>
                          </ul>
                      </li>
					  <li><a href="file_manage_main.php" target=frmright >文件管理</a></li>
					  <li><a href="#Menu=ChildMenu6" onclick="DoMenu('ChildMenu6')">图片管理</a>
                          <ul id="ChildMenu6" class="collapsed">
                            <li><a href="file_pic_view.php" target=frmright >目录浏览</a></li>
                            <li><a href="../file_do/list_picture.php?img_class=all" target=frmright >分类浏览</a></li>
							<li><a href="flash.php" target=frmright >动画编辑</a></li>
                          </ul>
                      </li>					  
					  <li><a href="district.php" target=frmright >地区管理</a></li>
					  <li><a href="logout.php" target=_top >退出系统</a></li>
					  <li><a href="logout.php" target="_parent">返回主页</a></li>
                    </ul>
                  </div>
                  <script type=text/javascript><!--
var LastLeftID = "";

function menuFix() {
 var obj = document.getElementById("nav").getElementsByTagName("li");
 
 for (var i=0; i<obj.length; i++) {
  obj[i].onmouseover=function() {
   this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  obj[i].onMouseDown=function() {
   this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  obj[i].onMouseUp=function() {
   this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  obj[i].onmouseout=function() {
   this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"), "");
  }
 }
}

function DoMenu(emid)
{
 var obj = document.getElementById(emid); 
 obj.className = (obj.className.toLowerCase() == "expanded"?"collapsed":"expanded");
 if((LastLeftID!="")&&(emid!=LastLeftID)) //关闭上一个Menu
 {
  document.getElementById(LastLeftID).className = "collapsed";
 }
 LastLeftID = emid;
}

function GetMenuID()
{

 var MenuID="";
 var _paramStr = new String(window.location.href);

 var _sharpPos = _paramStr.indexOf("#");
 
 if (_sharpPos >= 0 && _sharpPos < _paramStr.length - 1)
 {
  _paramStr = _paramStr.substring(_sharpPos + 1, _paramStr.length);
 }
 else
 {
  _paramStr = "";
 }
 
 if (_paramStr.length > 0)
 {
  var _paramArr = _paramStr.split("&");
  if (_paramArr.length>0)
  {
   var _paramKeyVal = _paramArr[0].split("=");
   if (_paramKeyVal.length>0)
   {
    MenuID = _paramKeyVal[1];
   }
  }
  /*
  if (_paramArr.length>0)
  {
   var _arr = new Array(_paramArr.length);
  }
  
  //取所有#后面的，菜单只需用到Menu
  //for (var i = 0; i < _paramArr.length; i++)
  {
   var _paramKeyVal = _paramArr[i].split('=');
   
   if (_paramKeyVal.length>0)
   {
    _arr[_paramKeyVal[0]] = _paramKeyVal[1];
   }  
  }
  */
 }
 
 if(MenuID!="")
 {
  DoMenu(MenuID)
 }
}

GetMenuID(); //*这两个function的顺序要注意一下，不然在Firefox里GetMenuID()不起效果
menuFix();
--></script></td>
              </tr>
        </table></td>
        <td width="42" height="101" align="center" valign="top" background="image/index_22.jpg"><img src="image/index_03.jpg" width="42" height="101"></td>
      </tr>
      <tr>
        <td align="center" valign="middle" background="image/index_22.jpg">&nbsp;</td>
      </tr>
</table>
</body>
</html>
