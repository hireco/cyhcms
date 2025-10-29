<DIV class=titlebg>
      <H2 class=ly>留言</H2></DIV>
     <DIV id=message_area>
      <iframe name="post_msg" style="display:none" src="_blank"></iframe>
	  <FORM  action=post_msg.php method=post name="member_msg" target="post_msg">
        <textarea  name=content rows=4 cols=80 onkeydown=gbcount(this.form.content,this.form.total,this.form.used,this.form.remain); 
		onkeyup=gbcount(this.form.content,this.form.total,this.form.used,this.form.remain);></textarea>
        <P style="FLOAT: left; COLOR: #999"><SPAN style="DISPLAY: none">
		<INPUT class=inputtext disabled maxLength=4 size=3 value=120 name=total> 
		<INPUT class=inputtext disabled maxLength=4 size=3 value=0 name=used> </SPAN>
		还可输入 <INPUT class=inputtext disabled maxLength=4 size=3 value=120 name=remain>个汉字 </P>
		<P style="FLOAT: right"><INPUT style="FONT-SIZE: 14px; WIDTH: 105px; HEIGHT: 26px"  type=submit value=提交留言 name=submit_msg 
		onClick="return chk_if_blank();">
	   </P>
      <DIV class=cb>
        <input type="hidden" name="msgtowho" value="<?=$row->id?>">
      </DIV></FORM></DIV>
      </DIV>