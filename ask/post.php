<?php 
  require_once("../config/base_cfg.php");
  require_once("../config/auto_set.php");
  require_once("include/showmsg.php");
  require_once(dirname(__FILE__)."/include/section_list.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?=$cfg_site_name?> 问答知识系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312"><LINK 
href="style/zhishi_style.css" type=text/css rel=stylesheet>
<LINK href="style/z2.css" type=text/css rel=stylesheet><LINK 
href="style/grzx_v2.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3429" name=GENERATOR></HEAD>
<BODY>
<TABLE class=topline cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD noWrap align=middle width=170 height=65><A 
      href="./"><IMG height=45 alt=爱问知识人 
      src="post.files/logo_zhishi.gif" width=145 border=0></A></TD>
    <TD noWrap width=25></TD>
    <TD vAlign=top>
      <?php require_once("include/top_right_nav.php"); ?>
	  </TD></TR></TBODY></TABLE>
<TABLE class="f13 cc" cellSpacing=0 cellPadding=0 width="100%" 
background=post.files/bg_nav_30.gif border=0>
  <TBODY>
  <TR vAlign=bottom align=middle>
    <TD width=20 height=23></TD>
    <TD width=3>|</TD>
    <TD noWrap width="5%"><A class=nav 
    href="./">首页</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="7%"><A class=nav 
      href="ask_class.php">问题分类</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="9%"><A class=nav 
      href="ask_rank.php">问题排行榜</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_star.php">用户榜</A></TD>
    <TD width=3>|</TD>
    <TD noWrap width="6%"><A class=nav 
      href="ask_expert.php">专家团</A></TD>
    <TD width=3><IMG src="ask_expert.files/nav_left.gif" border=0></TD>
    <TD noWrap width="6%" background=ask_expert.files/bg_nav_sy.gif 
    bgColor=#ffc52e><B class="cf fs13">提问题</B></TD>
    <TD width=3><IMG src="ask_expert.files/nav_right.gif" border=0></TD>
    <TD align=right><A 
      href="user.php"><IMG height=19 
      src="post.files/grzx.gif" width=78 border=0></A></TD>
    <TD width=15></TD></TR>
  <TR>
    <TD colSpan=9 height=7></TD></TR></TBODY></TABLE>

<IFRAME style="DISPLAY: none" name=iframe_data src="about:blank"></IFRAME>
<FORM name=form_q method=post action="post_submit.php"
encType=multipart/form-data target="iframe_data">
<TABLE class=f12 cellSpacing=0 cellPadding=0 width=780 align=center   border=0> 
  <TBODY>
  <TR vAlign=top>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD>&nbsp;</TD>
          <TD height=40><IMG height=37 alt=提问 src="post.files/tw_new.gif" 
            width=73 border=0>
			<?php showmsg("请填写问题的主题","question_title");?>
			<?php showmsg("请填写问题的内容","question_cont");?>
		    <?php showmsg("请选择所属的章","chapter_select");?>
			<?php showmsg("请选择所属的节","section_select");?>	
			<?php showmsg("成功的发布问题","ask_true");?>
	        <?php showmsg("错误的账号和密码！","login_false");?>	
			<?php showmsg("发布失败，请重来！","ask_false");?>			</TD></TR>
        <TR vAlign=top>
          <TD noWrap align=middle width=70><B class=ttc>问题标题</B></TD>
          <TD class=tdof id=td1>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD><INPUT class=f14 id=idtitle  style="WIDTH: 325px"  maxLength=50 name=question 
				onkeydown=gbcount(this.form.question,this.form.total,this.form.used,this.form.remain); 
		        onkeyup=gbcount(this.form.question,this.form.total,this.form.used,this.form.remain);>
                &nbsp;<IMG height=22   alt=重新搜索相关答案 src="post.files/z2_tw_cxss.gif" width=22  align=absMiddle border=0>
				<P style="FLOAT: left; COLOR: #999"><SPAN style="DISPLAY: none">
		        <INPUT class=inputtext disabled maxLength=4 size=3 value=50 name=total> 
		        <INPUT class=inputtext disabled maxLength=4 size=3 value=0 name=used> </SPAN>
	        	还可输入 <INPUT class=inputtext disabled maxLength=4 size=3 value=50 name=remain>个汉字 </P>
				  </TD></TR>
              </TBODY></TABLE></TD></TR>
        <TR>
          <TD colSpan=9 height=5></TD></TR>
        <TR vAlign=top>
          <TD noWrap align=middle><B class=ttc>问题描述</B></TD>
          <TD class=tdof id=td2>
            <DIV style="POSITION: relative">
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD colSpan=2><TEXTAREA  name=question_content cols=45 rows=9 class="w100 f14" id="question_content"></TEXTAREA></TD></TR>
              <TR>
                <TD vAlign=bottom height=22><FONT 
                  color=#668342>上传相关图片</FONT><IMG src="post.files/z2_tw_tjfj.gif" align=absMiddle border=0 onClick="showdiv('howgetFile');"></TD>
                <TD vAlign=top align=right>&nbsp;</TD></TR>
              <TR>
                <TD colSpan=2>
                  <DIV id=howgetFile style="display:none;">
                    <INPUT name=img_upload 
                  type=file id="img_upload" 
                  style="WIDTH: 350px" size=50> 
                    </DIV></TD></TR></TBODY></TABLE>
				  </DIV></TD></TR>
        <TR>
          <TD colSpan=9 height=5></TD></TR>
        <TR vAlign=top>
          <TD noWrap align=middle><B class=ttc>问题分类</B></TD>
          <TD>
		  <div style="position:relative;">
		   <div id="showtitleclass">
		   <table border="0" cellspacing="0" cellpadding="0">
             
             <tr>
               <td valign="top"><SELECT NAME="chapter" size="4" id="chapter" runat="server">
               </SELECT>               </td>
			   <td width="10"> </td>
               <td valign="top"><SELECT NAME="section" size="4" id="section" runat="server">
               </SELECT>               </td>
			   <td width="10"> </td>
               <td valign="top"><SELECT NAME="point" size="4" multiple id="point" runat="server">
               </SELECT>
               </td>
			   <td valign="top">&nbsp;&nbsp;*知识点可以通过Shift键选取多项</td>
             </tr>
           </table>
		   </div>
		  </div>
		   <?php 
		    get_section($chapter_default,$section_default,$point_default);
		   ?>
		   <input type="hidden" name="allpoint"></TD>
        </TR>
        <TR>
          <TD colSpan=9 height=5></TD></TR>
        <TR vAlign=top>
          <TD align=middle valign="top" noWrap><B class=ttc>悬赏分</B></TD>
          <TD>
		   <SELECT   name=score  id="score">
                  <OPTION value=0>0</OPTION><OPTION 
                    value=5 selected>5</OPTION><OPTION value=10>10</OPTION><OPTION 
                    value=15>15</OPTION><OPTION value=20>20</OPTION><OPTION 
                    value=30>30</OPTION><OPTION value=40>40</OPTION><OPTION 
                    value=50>50</OPTION><OPTION value=75>75</OPTION><OPTION 
                    value=100>100</OPTION></SELECT>
		   <strong>注意</strong>：提问的分数在问题被解决后，将从您的积分中扣除，送与问题解决者</TD>
		  </TR>
        <TR vAlign=top>
          <TD align=middle valign="top" noWrap>&nbsp;</TD>
          <TD>&nbsp;</TD>
        </TR>
        <TR vAlign=top>
          <TD align=middle valign="top" noWrap><B class=ttc>有效期</B></TD>
          <TD>
            <select name="end_time" id="end_time">
              <option value="1">1天</option>
              <option value="3">3天</option>
              <option value="7" selected>7天</option>
              <option value="15">15天</option>
              <option value="40">40天</option>
            </select>
            <input name="pic_to_up" type="hidden" id="pic_to_up" value="0">
         </TD>
        </TR>
        <TR vAlign=top>
          <TD align=middle valign="top" noWrap>&nbsp;</TD>
          <TD>&nbsp;</TD>
        </TR>
        <TR vAlign=top>
          <TD noWrap align=middle></TD>
          <TD id=td5>
            <?php if(!isset($_SESSION['user_name'])) { ?>
			<DIV style="POSITION: relative">
            <FIELDSET style="BORDER-RIGHT: #d1e5b7 1px dashed; BORDER-TOP: #d1e5b7 1px dashed; BORDER-LEFT: #d1e5b7 1px dashed; BORDER-BOTTOM: #d1e5b7 1px dashed"><LEGEND   class="f14 c0" style="BACKGROUND: #fff"><IMG hspace=5 src="post.files/z2_tw_hydl.gif" align=absMiddle  border=0>会员请直接登录</LEGEND>
            <TABLE class=f12 border=0>
              <TBODY>
              <TR>
                <TD height=5></TD></TR>
              <TR>
                <TD noWrap align=right width=60><SPAN class=f13>会员名：</SPAN></TD>
                <TD width=115><INPUT  
                  style="WIDTH: 100%; HEIGHT: 22px" 
                  maxLength=50 size=25 name=user_name></TD>
                <TD noWrap align=right width=50><SPAN class=f13>密码：</SPAN></TD>
                <TD width=115><INPUT 
                  style="WIDTH: 100%; HEIGHT: 22px"  
                  type=password maxLength=50 size=25 name=user_pass></TD></TR>
              <TR>
                <TD vAlign=bottom align=right colSpan=4 height=20><A 
                  href="../register.php?to_go=<?=urlencode("ask/post.php")?>" target=_blank><FONT 
                  color=#668342>快速注册</FONT></A>　<A 
                  href="../lostpass.php" 
                  target=_blank><FONT color=#668342>忘记密码</FONT></A></TD>
              </TR>
              <TR>
                <TD height=5></TD></TR></TBODY></TABLE></FIELDSET> 
			</DIV>
			<?php } ?>			</TD></TR></TBODY></TABLE>
      <INPUT name="submit"  type=submit class=sc onClick="return check_form();" value=" 提 交 "></TD>
    <TD width=20>&nbsp;</TD>
  </TR></TBODY></TABLE>
</FORM><!--开始：底部--><!-- 尾部 begin --><BR>
<?php  require_once("htm/foot.htm");?>
<script>
function check_form() {  
    if(document.form_q.question.value=="") {
	 showobj(question_title);
	 return false;
	}
	
	if(document.form_q.question_content.value=="") {
	 showobj(question_cont);
	 return false;
	}
	
	var point_list = document.form_q.point;
	var allpoint = "";
	for(var i=0;i<point_list.options.length;i++){
		if((point_list.options[i].selected)&&(point_list.options[i].text!="不限知识点")){
		if(allpoint == "")
			allpoint = point_list.options[i].text;
		else
			allpoint = allpoint +","+ point_list.options[i].text;
		}
	  }
	document.form_q.allpoint.value = allpoint;
 
 if((document.form_q.chapter.value=="")||(document.form_q.chapter.value=="所属章")){
 showobj(chapter_select);
 return false;
 }
 
 if((document.form_q.section.value=="")||(document.form_q.section.value=="所属节")){
 showobj(section_select);
 return false;
 }
  
 if(document.form_q.user_name) {
   if((document.form_q.user_name.value=="")||(document.form_q.user_pass.value=="")) {
   showobj(login_false);
   return false;
   }
  }
 else return true;
 
} 


function gbcount(message,total,used,remain)
{
var max;
max = total.value;
if (message.value.length > max) {
message.value = message.value.substring(0,max);
used.value = max;
remain.value = 0;
}
else {
used.value = message.value.length;
remain.value = max - used.value;
}
}

function showdiv(divid) {
var obj = document.getElementById(divid);
if(obj.style.display=="none")  { obj.style.display="block"; document.all.pic_to_up.value="1";}
else { obj.style.display="none"; document.all.pic_to_up.value="0"; }
}
</script>
</BODY></HTML>
