<?php require_once(dirname(__FILE__)."/often_function.php");?>
<?php require_once("config/auto_set.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
							  $query="select article_title,id from ".$table_suffix."album order by recommend desc, top desc, top_time desc limit 0, 1";
			                  $result=mysql_query($query);
			                  if($row=mysql_fetch_object($result)) { 
							  $object_id=$row->id;
							  $article_title=$row->article_title;
							  $query="select * from ".$table_suffix."picture where object_id=$object_id and object_class='album_list'";
			                  $result=mysql_query($query);
?>
							  <TABLE class=table height=26 cellSpacing=0 cellPadding=0 width="100%" 
      background=image/tbg.jpg border=0>
        <TBODY>
        <TR>
          <TD align=middle width=35><IMG height=12 src="image/sp.gif" 
            width=5></TD>
          <TD class=fontg>精彩图片：<?=$article_title?></TD>
          <TD class=fontg align=middle width=50><a href="tuwen.php"><IMG 
            src="image/more.gif" width=53 height=15 border="0"></a></TD>
        </TR></TBODY></TABLE>
		 <TABLE height=100 cellSpacing=1 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top>
             <DIV align=center>
            <DIV id=aaa style="OVERFLOW: hidden; WIDTH: <?php echo ($cfg_body_width-190)."px"; ?>; HEIGHT: 125px">
            <DIV align=center>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" align=center 
            border=0 cellspace="0">
              <TBODY>
              <TR>
                <TD id=aaa1 vAlign=top>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                    align=center><TBODY>
                    <TR>
                      <TD vAlign=top>
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                          <TBODY>
                          <TR>
                            <?php 
			                  while($row=mysql_fetch_object($result)) {
							  $height=100;
					          $width=100*$cfg_albsimg_width/$cfg_albsimg_height;
						      $pic_url=get_small_img($row->pic_url,$row->small_pic);
					          if(!empty($pic_url)) { 
							?>
							<TD class=piclist align=middle>							
                              <TABLE width=<?=$width?> border=0 align="center" cellPadding=1 cellSpacing=0 class=table>
                                <TBODY>
                                <TR>
                                <TD align=middle bgColor=#ffffff><A 
                                href="<?php if($row->pic_link=="") echo "show_album.php?id=$object_id"; else echo $row->pic_link; ?>" 
                                target=_self><IMG height=<?=$height?> 
                                src="<?=$pic_url?>" width=<?=$width?>
                                border=0></A></TD></TR>
                                <TR>
                                <TD align=middle bgColor=#f0f0f0 height=23><A 
                                class=pictitle   href="<?php if($row->pic_link=="") echo "show_album.php?id=$object_id"; else echo $row->pic_link; ?>"; 
                                target=_self><?=$row->pic_title?></A></TD></TR></TBODY></TABLE>
							</TD>
						   <?php  						         
							   }
							  }
							?>							
                            <TD class=piclist align=middle></TD>
                            <TD class=piclist align=middle></TD>
                            <TD class=piclist align=middle></TD>
                            <TD class=piclist 
                      align=middle></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                <TD id=aaa2 vAlign=top 
            width=1></TD></TR></TBODY></TABLE></DIV></DIV></DIV>
            <SCRIPT>
			var speed1=15 //
			aaa2.innerHTML=aaa1.innerHTML
			function Marquee(){
			if(aaa2.offsetWidth-aaa.scrollLeft<=0)
			aaa.scrollLeft-=aaa.offsetWidth
			else{
			aaa.scrollLeft++
			}
			}
			var MyMrr=setInterval(Marquee,speed1)
			aaa.onmouseover=function() {clearInterval(MyMrr)}
			aaa.onmouseout=function() {MyMrr=setInterval(Marquee,speed1)}
			</SCRIPT>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR align=right>
                <TD><A class=more 
                  href="xyfm/class/?1.html"></A></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<?php } ?>
