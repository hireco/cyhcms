<?php 
require_once("setting.php");
require_once(dirname(__FILE__)."/../config/base_cfg.php");
session_start(); 
require_once(dirname(__FILE__)."/../dbscripts/db_connect.php");
require_once(dirname(__FILE__)."/../config/auto_set.php");
require_once(dirname(__FILE__)."/../inc/often_function.php");
require_once(dirname(__FILE__)."/../".$cfg_admin_root."function/inc_function.php");
require_once(dirname(__FILE__)."/../".$cfg_admin_root."scripts/constant.php");
if(isset($_SESSION['user_name'])){
 if(isset($_REQUEST['pic_url'])){
  if($_REQUEST['idkey']==md5(basename($_REQUEST['pic_url']).$_REQUEST['iwidth'].$_REQUEST['iheight'])){
   if($_REQUEST['action']=="cancel") 
   { $small_photo=get_small_pic($_REQUEST['pic_url']);
     $small_photo=ereg_replace($cfg_mainsite,"",$small_photo);
	 $small_photo=RROOT."/".$small_photo;
     if(is_file($small_photo))  unlink($small_photo);
     $result=mysql_query("update ".$table_suffix."picture set small_pic='0' where pic_url='{$_REQUEST['pic_url']}'");
     if(!$result)  { echo "系统出错，请稍后重试！"; return 0; } 
	 unset($_REQUEST['action']);
	 if(!isset($_SESSION['small_photo'])) {
	 echo "<script>opener.location.reload()</script>";
	 echo "<script>window.close()</script>";
     }
	 session_unregister("small_photo"); 
   }
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<STYLE type=text/css>
div,table{font-size: 12px; color: #AA5FB8; line-height: 20px;}
.filt {
	FILTER: alpha(opacity=50); BACKGROUND-COLOR: #fff; -moz-opacity: 0.5; opacity: 0.5
}
.filt1 {	FILTER: alpha(opacity=50); BACKGROUND-COLOR: #fff; -moz-opacity: 0.5; opacity: 0.5
}
.cut_update{ background:url(../image/cut_update_bn.jpg) no-repeat; border: none; width: 151px; height:34px; cursor: hand; margin: 0 0 0 100px;}
.coltable{ float:left;text-align: center; color: #7D7D7D;margin: 5px 0 0 60px !important; margin-left: 30px; line-height: 15px;}
.cut_img img{ 
	padding: 1px;
	float: left;
	border: 5px solid #E7D3FF;
	margin-right: 40px;
 }
#logo{width: 758px;} 
#cut_div_top{ width: 100%; background: url(../image/login_body_bg.gif); }
.cut_top_img{ width: 100%;  background: url(../image/login_body_bg.gif); } 
.filt11 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.filt111 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE6 {
	FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.cut_intro{margin: 15px 0 0 35px;}
.STYLE7 {	FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt112 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE71 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt1121 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE711 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt11211 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.STYLE7111 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
.filt112111 {FILTER: alpha(opacity=70); BACKGROUND-COLOR: #fff; -moz-opacity: 0.7; opacity: 0.7
}
.td_window {BORDER-RIGHT: violet 1px solid; BORDER-BOTTOM: violet 1px solid; BORDER-LEFT: violet 1px solid; BORDER-TOP: violet 1px solid;
}
.STYLE71111 {FILTER: alpha(opacity=70);
	BACKGROUND-COLOR: #fff;
	opacity: 0.7;
	color: #FF0000;
	font-weight: bold;
}
</STYLE>
<script type="text/javascript">
var div_move	=	0;
var IE = document.all?true:false;
var tempX,tempY,oldX,oldY;
var have_move	=	0;
function grasp()
{
	div_move	=	1;
	if(IE)
	{
		document.getElementById("source_div").setCapture();
	}
}

function free()
{
	div_move	=	0;
	have_move	=	0;
	document.getElementById("source_div").releaseCapture();
}

function getMouseXY(e)
{
	if (IE)
	{ // grab the x-y pos.s if browser is IE
		tempX = event.clientX + document.body.scrollLeft
		tempY = event.clientY + document.body.scrollTop
	}
	else
	{
		// grab the x-y pos.s if browser is NS
		tempX = e.pageX
		tempY = e.pageY
	}	
	// catch possible negative values in NS4
	if (tempX < 0){tempX = 0}
	if (tempY < 0){tempY = 0}	
}

function move_it(e)
{
	getMouseXY(e);
	if(div_move	==	1)
	{
		if(have_move	==	0)
		{
			//alert('a');
			oldX	=	tempX;
			oldY	=	tempY;
			have_move	=	1;
		}
		var left	=	parseInt(document.getElementById("source_div").style.left);
		var top		=	parseInt(document.getElementById("source_div").style.top);
		//alert(top);
		//alert(left);
		//alert(tempX);
		//alert(oldX);

		document.getElementById("source_div").style.left	=	left	+	tempX	-	oldX;
		document.getElementById("source_div").style.top	=	top	+	tempY	-	oldY;
		oldX	=	tempX;
		oldY	=	tempY;
	}
}

function change_size(method)
{
	if(method	==	1)
	{
		var per	=	1.25;
	}
	else
	{
		var per	=	0.8;
	}
	document.getElementById("show_img").width	=	document.getElementById("show_img").width*per;
	//document.getElementById("show_img").height	=	document.getElementById("show_img").height*per;
}

function load_move()
{
	var left	=	parseInt(document.getElementById("source_div").style.left);
	document.getElementById("source_div").style.left	=	left	+	150;
}

function micro_move(method)
{
	switch (method)
	{
		case "up":
			var top	=	parseInt(document.getElementById("source_div").style.top);
			document.getElementById("source_div").style.top	=	top	-	5;
			break;
		case "down":
			var top	=	parseInt(document.getElementById("source_div").style.top);
			document.getElementById("source_div").style.top	=	top	+	5;
			break;
		case "left":
			var left	=	parseInt(document.getElementById("source_div").style.left);
			document.getElementById("source_div").style.left	=	left	-	5;
			break;
		case "right":
			var left	=	parseInt(document.getElementById("source_div").style.left);
			document.getElementById("source_div").style.left	=	left	+	5;
			break;
	}
}

function turn(method)
{
	var i=document.getElementById('show_img').style.filter.match(/\d/)[0]
	//alert(i);
	i=parseInt(i)+parseInt(method);
	//alert(i);
	if(i<0)
	{
		i	+=	4;
	}
	if(i>=4)
	{
		i	-=	4;
	}
	//alert(i);
	document.getElementById('show_img').style.filter='progid:DXImageTransform.Microsoft.BasicImage(Rotation='+i+')'
}

function mysub()
{
	var Oform =	document.myform;
	Oform.width.value	=	document.getElementById("show_img").width;
	Oform.left.value	=	document.getElementById("source_div").style.left;
	Oform.top.value	=	document.getElementById("source_div").style.top;
	if(IE)
	{
		Oform.turn.value	=	document.getElementById('show_img').style.filter.match(/\d/)[0];
	}
	Oform.submit();
}

function get_sc_width()
{
	document.getElementById('scwidth').value	=	screen.width;
}
</script>
<META content="MSHTML 6.00.5700.6" name=GENERATOR>
</HEAD>
<BODY style="TEXT-ALIGN: left锛沺adding: 0; margin:0;" onload="get_sc_width();load_move();">
<DIV onmouseup=free() onmousedown=grasp() 
style="Z-INDEX: 2; LEFT: 0px; WIDTH: 100%; CURSOR: move; POSITION: absolute; TOP: 0px; HEIGHT: 100%; margin: auto; " 
valign="top">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="90" align="left" valign="middle" bgcolor="#E4A5F4">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top"><table  border="0" cellspacing="0" cellpadding="0" id="big_table">
        <tr>
          <td width="200" height="865" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><table width="95%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
              <td height="243" align="center" valign="top" style=""><table width="90%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td></td>
                </tr>
                <tr>
                  <td><strong>使用说明</strong></td>
                </tr>
                <tr>
                  <td>1，你可以使用上面的“方向”键“旋转方位”键“放大缩小”键来调整您的照片大小方位等。</td>
                </tr>
                <tr>
                  <td>2，然后拖动调整后合适大小的照片到形象照框内。</td>
                </tr>
                <tr>
                  <td>3，点击“好了，上传”开始上传您的形象照。</td>
                </tr>
              </table>
                <table width="60%" border="0" cellpadding="3" cellspacing="0" >
                  <tr>
                    <td colspan="2" align="center"><a style="cursor:pointer" onclick="micro_move('up');"><img src="../image/cut_up.jpg" width="24" height="24" border="0"></a></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">上</td>
                  </tr>
                  <tr>
                    <td width="50%" align="center"><a style="cursor:pointer" onclick="micro_move('left');"><img src="../image/cut_left.jpg" width="24" height="24" border="0"></a></td>
                    <td align="center"><a style="cursor:pointer" onclick="micro_move('right');"><img src="../image/cut_right.jpg" width="24" height="24" border="0"></a></td>
                  </tr>
                  <tr>
                    <td align="center">左</td>
                    <td align="center">右</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><a style="cursor:pointer" onclick="micro_move('down');"><img src="../image/cut_down.jpg" width="24" height="24" border="0"></a></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">下</td>
                  </tr>
                  <tr>
                    <td align="center"><a style="cursor:pointer" onclick="turn(1);"><img src="../image/cut_turnleft.jpg" width="32" height="31" border="0"></a></td>
                    <td align="center"><a style="cursor:pointer" onclick="turn(-1);"><img src="../image/cut_turnright.jpg" width="32" height="31" border="0"></a></td>
                  </tr>
                  <tr>
                    <td>顺时针</td>
                    <td>逆时针</td>
                  </tr>
                  <tr>
                    <td align="center"><a style="cursor:pointer" onclick="change_size(1);"><img src="../image/cut_zoneout.jpg" width="33" height="33" border="0"></a></td>
                    <td align="center"><a style="cursor:pointer" onclick="change_size(-1);"><img src="../image/cut_zonein.jpg" width="34" height="33" border="0"></a></td>
                  </tr>
                  <tr>
                    <td align="center">放大</td>
                    <td align="center">缩小</td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
          <td width="600" height="600" align="left" valign="top"><TABLE height=100% cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TBODY>
              <TR>
                <TD width="<?=(600-$_REQUEST['iwidth'])/2?>" height="<?=(500-$_REQUEST['iheight'])/2?>" class=filt112111>&nbsp;</TD>
                <TD width="<?=$_REQUEST['iwidth']?>" class=filt112111></TD>
                <TD width="<?=(600-$_REQUEST['iwidth'])/2?>" height="<?=(500-$_REQUEST['iheight'])/2?>" class=filt112111></TD>
              </TR>
              <TR>
                <TD  height="<?=$_REQUEST['iheight']?>" class=filt112111></TD>
                <TD width="<?=$_REQUEST['iwidth']?>" height="<?=$_REQUEST['iheight']?>" vAlign=top align=left>
                  <TABLE width="<?=$_REQUEST['iwidth']?>" height="<?=$_REQUEST['iheight']?>" border=0 cellpadding="0" cellspacing="0">
                    <TBODY>
                      <TR>
                        <TD align="left" valign="top" class=td_window><TABLE width="<?=$_REQUEST['iwidth']?>" height="<?=$_REQUEST['iheight']?>" border=0 cellpadding="0" cellspacing="0">
                            <TBODY>
                              <TR>
                                <TD></TD>
                              </TR>
                            </TBODY>
                        </TABLE></TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
                <TD class=STYLE7111><span class="STYLE71111">&lt;--请将您的头像置于居中的位置<br>
&lt;--请将您的头像调至合适大小</span>                
              </TR>
              <TR>
                <TD width="<?=(600-$_REQUEST['iwidth'])/2?>" height="<?=(500-$_REQUEST['iheight'])/2?>" class=filt112111>&nbsp;</TD>
                <TD class=filt112111></TD>
                <TD width="<?=(600-$_REQUEST['iwidth'])/2?>" height="<?=(500-$_REQUEST['iheight'])/2?>" class=filt112111></TD>
              </TR>
              <TR>
                <TD height=100 colspan="3" bgcolor="#FFFFFF"><div align="center">
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div align="center"><a style="cursor:pointer" onclick="mysub();"><img src="../image/update_bn.jpg" width="149" height="50" border="0"></a></div></td>
                      <td><div align="center"><a style="cursor:pointer" href="cut_pic.php?pic_url=<?=$_REQUEST['pic_url']?>&iwidth=<?=$_REQUEST['iwidth']?>&iheight=<?=$_REQUEST['iheight']?>&action=cancel&idkey=<?=$_REQUEST['idkey']?>">删除现有缩略图</a></div></td>
                    </tr>
                  </table>
                </div></TD>
              </TR>
            </TBODY>
          </TABLE></td>
          <td rowspan="2" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="400" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</DIV>
<DIV onmouseup=free() onmousedown=grasp() id='source_div' style="Z-INDEX: 1; LEFT: 70px; CURSOR: move; POSITION: absolute; TOP: 100px">
<IMG onmousedown="return false;" id='show_img' style="FILTER: progid:DXImageTransform.Microsoft.BasicImage(Rotation=0)" src="<?=$_REQUEST['pic_url']?>">
</DIV>
<script type="text/javascript">
document.onmousemove = move_it;
document.onmouseup	=	free;
var table=document.getElementById('big_table');
table.width = screen.width;
</script>
<form action="cut_result.php" name="myform" method="POST">
<input type=hidden name="width">
<input type=hidden name="left">
<input type=hidden name="top">
<input type=hidden name="turn">
<input type=hidden name="iwidth" value="<?=$_REQUEST['iwidth']?>">
<input type=hidden name="iheight" value="<?=$_REQUEST['iheight']?>">
<input type=hidden name="pic_url" value="<?=$_REQUEST['pic_url']?>">
<input type=hidden name="idkey" value="<?=$_REQUEST['idkey']?>">
<input type=hidden name="scwidth" id="scwidth">
</form>
</BODY></HTML>
<?php } else ShowMsg("对不起,操作错误或者没有权限!",-1);
  } else  ShowMsg("对不起,没有操作对象!",-1);
} else  ShowMsg("对不起,您没有权限!",-1);?>