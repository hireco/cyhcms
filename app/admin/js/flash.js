// JavaScript Document
function CheckSelTable(nnum){
	var cbox = $Obj('isokcheck'+nnum);
	var seltb = $Obj('seltb'+nnum);
	if(!cbox.checked) seltb.style.display = 'none';
	else seltb.style.display = 'block';
}

var startNum = 1;
function MakeUpload(mnum)
{
   var endNum = 0;
   var upfield = document.getElementById("uploadfield");
   var pnumObj = document.getElementById("picnum");
   var fhtml = "";
   var dsel = " checked='checked' ";
   var dplay = "display:none";
 
   if(mnum==0) endNum = startNum + Number(pnumObj.value);
   else endNum = mnum;
   if(endNum>120) endNum = 120;
   
   for(startNum;startNum < endNum;startNum++)
   {
	   if(startNum==1){
	      dsel = " checked='checked' ";
		  dplay = "block";
	   }else
	   {
	      dsel = " ";
        dplay = "display:none";
	   }
	   fhtml = "";
	   fhtml += "<table width='100%'><tr><td><input type='checkbox' name='isokcheck"+startNum+"' id='isokcheck"+startNum+"' value='1'   "+dsel+" onClick='CheckSelTable("+startNum+")' />显示图片["+startNum+"]的选取框</td></tr></table>";
	   fhtml += "<table width=\"100%\" border=\"0\" id=\"seltb"+startNum+"\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#E8F5D6\" style=\"margin-bottom:6px;margin-left:10px;"+dplay+"\"><tobdy>";
	   fhtml += "<tr bgcolor=\"#F4F9DD\">\r\n";
	   fhtml += "<td height=\"25\" colspan=\"2\">　<strong>图片"+startNum+"：</strong></td>";
	   fhtml += "</tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td width=\"40%\" height=\"25\"> 　本地上传： ";
	   fhtml += "<input type=\"file\" name='imgfile"+startNum+"' style=\"width:330px\"  onChange=\"SeePic(document.picview"+startNum+",document.form1.imgfile"+startNum+");\"></td>";
	   fhtml += "<td width=\"60%\" rowspan=\"3\" align=\"center\"><img src=\"image/picview.jpg\" width=\"150\" id=\"picview"+startNum+"\" name=\"picview"+startNum+"\"></td>";
	   fhtml += "</tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　指定网址： ";
	   fhtml += "<input type=\"text\" name='imgurl"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "<input type=\"button\" name='selpic"+startNum+"' value=\"选取\" style=\"width:65px\"  onClick=\"SelectImageN('form1.imgurl"+startNum+"','big','picview"+startNum+"','form1.imglink"+startNum+"','form1.imgtitle"+startNum+"')\">";
	   fhtml += "</td></tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　图片标题： ";
	   fhtml += "<input type=\"text\" name='imgtitle"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "</td></tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　图片链接： ";
	   fhtml += "<input type=\"text\" name='imglink"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "</td></tr>";	  
	   fhtml += "</tobdy></table>\r\n";
	   upfield.innerHTML += fhtml;
  }
     document.form1.num_of_img.value=endNum-1;
}

function SelectImageN(fname,stype,vname,lname,tname){
   if($Nav()=='IE'){ var posLeft = window.event.clientX-100; var posTop = window.event.clientY; }
   else{ var posLeft = 100; var posTop = 100; }
   if(!fname) fname = 'form1.picname';
   if(!stype) stype = '';
   window.open("../file_do/list_pic4class.php?f="+fname+"&imgstick="+stype+"&v="+vname+"&l="+lname+"&t="+tname, "popUpImagesWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=400,left="+posLeft+", top="+posTop);
}