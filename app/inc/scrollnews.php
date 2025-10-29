<?php require_once(dirname(__FILE__)."/often_function.php");?>
<?php require_once("config/auto_set.php");?>
<?php 
   require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
   $query="select * from ".$table_suffix."infor_index  where show_attribute='1' order by show_attribute_time desc, top desc,recommend desc limit 0,10";
   $result=mysql_query($query); 
   if(mysql_num_rows($result)) {
 ?>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="BORDER-RIGHT: #8bd 1px solid; BORDER-TOP: #8bd 1px solid; BACKGROUND: #ebf3fa; OVERFLOW: hidden; BORDER-LEFT: #8bd 1px solid; WIDTH: 100%; LINE-HEIGHT: 23px; BORDER-BOTTOM: #8bd 1px solid; HEIGHT: 74px;">
<SCRIPT language=JavaScript>
//Math.random()
 var scrollerheight=72;  
 var html,total_area=0,wait_flag=true;
 
 var bMouseOver = 1;
 var scrollspeed = 8;         
 var waitingtime = 3600;  
 var s_tmp = 0, s_amount = 18.8;
 var scroll_content=new Array();
 var startPanel=0, n_panel=0, i=0;
 
 function startscroll()
 { 
  i=0;
  for (i in scroll_content)
   n_panel++;
   
  n_panel = n_panel -1 ;
  startPanel = Math.round(Math.random()*n_panel);
  if(startPanel == 0)
  {
   i=0;
   for (i in scroll_content) 
    insert_area(total_area, total_area++); 
  }
  else if(startPanel == n_panel)
  {
   insert_area(startPanel, total_area);
   total_area++;
   for (i=0; i<startPanel; i++) 
   {
    insert_area(i, total_area);
    total_area++;
   }
  }
  else if((startPanel > 0) || (startPanel < n_panel))
  {
   insert_area(startPanel, total_area);
   total_area++;
   for (i=startPanel+1; i<=n_panel; i++) 
   {
    insert_area(i, total_area); 
    total_area++;
   }
   for (i=0; i<startPanel; i++) 
   {
    insert_area(i, total_area); 
    total_area++;
   }
  }
  window.setTimeout("scrolling()",waitingtime);
 }
 function scrolling(){ 
  if (bMouseOver && wait_flag)
  {
   for (i=0;i<total_area;i++){
    tmp = document.getElementById('scroll_area'+i).style;
    tmp.top = parseInt(tmp.top)-scrollspeed;
    if (parseInt(tmp.top) <= -scrollerheight){
     tmp.top = scrollerheight*(total_area-1);
    }
    if (s_tmp++ > (s_amount-1)*scroll_content.length){
     wait_flag=false;
     window.setTimeout("wait_flag=true;s_tmp=0;",waitingtime);
    }
   }
  }
  window.setTimeout("scrolling()",1);
 }
 function insert_area(idx, n){ 
  html='<div style="left: 0px; width: 100%; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">\n';
  html+=scroll_content[idx]+'\n';
  html+='</div>\n';
  document.write(html);
 }
<?php $scroll_i=0; 
   $height=64;
   $width=64*$cfg_artsimg_height/$cfg_artsimg_width;
   while($row=mysql_fetch_object($result)){ 
   $infor_class=$row->infor_class;
   $infor_id=$row->infor_id;
   $result_pic=mysql_query("select * from ".$table_suffix.$infor_class." where id=$infor_id");
   $row_pic=mysql_fetch_object($result_pic);
   $pic_id=$row_pic->pic_id;
   $url_result=mysql_query("select * from ".$table_suffix."picture where id=$pic_id");
   $url_row=mysql_fetch_object($url_result); 
   $pic_url=get_small_img($url_row->pic_url,$url_row->small_pic);
   $abstract=$row_pic->abstract;
   echo "scroll_content[".$scroll_i."]=\"<TABLE cellSpacing=0 cellPadding=3 width=100% border=0><TBODY><TR><TD width=70><TABLE height=".$height." cellSpacing=1 cellPadding=0  bgColor=#e6e6e6 border=0><TBODY><TR><TD align=center bgColor=#ffffff><a href='show_".$row->infor_class.".php?id=".$row->infor_id."' target='_blank'><img src='".$pic_url."' height=".$height." width=".$width." border='0'></a></TD></TR></TBODY></TABLE></TD><TD width=6></TD><TD valign=top><a href='show_".$row->infor_class.".php?id=".$row->infor_id."' target='_blank'><font color='#FF0000'><span style='font-size:9pt;line-height: 15pt'><b>¡¾".$row->article_title."¡¿</b></font></a><BR><a href='show_".$row->infor_class.".php?id=".$row->infor_id."' target='_blank'>".$abstract."</a></TD></TR></TBODY></TABLE>\";";
   $scroll_i++;  
} 
?>
startscroll();
</SCRIPT>
</div></td>
  </tr>
</table>
<table width="100%" height="5"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<?php } ?>