// JavaScript Document
function $Obj(objname){
	return document.getElementById(objname);
}
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
	   fhtml += "<td height=\"25\" colspan=\"3\">　<strong>图片"+startNum+"：</strong></td>";
	   fhtml += "</tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td width=\"90\" height=\"25\"> 　本地上传： </td><td width=\"260\">";
	   fhtml += "<input class=\"INPUT\" type=\"file\" name='imgfile"+startNum+"' style=\"width:260px\"  onChange=\"SeePic(document.picview"+startNum+",document.form1.imgfile"+startNum+");\"></td>";
	   fhtml += "<td rowspan=\"5\" align=\"center\"><img src=\"image/picview.jpg\" width=\"150\" id=\"picview"+startNum+"\" name=\"picview"+startNum+"\"></td>";
	   fhtml += "</tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　指定网址： </td><td>";
	   fhtml += "<input class=\"INPUT\" type=\"text\" name='imgurl"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "</td></tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　图片标题： </td><td>";
	   fhtml += "<input class=\"INPUT\" type=\"text\" name='imgtitle"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "</td></tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"25\"> 　图片链接： </td><td>";
	   fhtml += "<input class=\"INPUT\" type=\"text\" name='imglink"+startNum+"' style=\"width:260px\"> ";
	   fhtml += "</td></tr>";
	   fhtml += "<tr bgcolor=\"#FFFFFF\"> ";
	   fhtml += "<td height=\"56\">　图片简介： </td><td>";
	   fhtml += "<textarea class=\"TEXTAREA\"  name='imgmsg"+startNum+"' style=\"height:46px;width:260px\"></textarea> </td>";
	   fhtml += "</tr></tobdy></table>\r\n";
	   upfield.innerHTML += fhtml;
  }
     document.form1.num_of_img.value=endNum-1;
}

    var maxWidth=160; 
	var maxHeight=100;
    function reload_pic(main_pic) {
    var imageArr=document.getElementById(main_pic);
    var imageRate = imageArr.offsetWidth / imageArr.offsetHeight;    
    
    if(imageArr.offsetWidth > maxWidth)
    {
        imageArr.style.width=maxWidth + "px";
        imageArr.style.Height=maxWidth / imageRate + "px";
    }
    
    if(imageArr.offsetHeight > maxHeight)
    {
        imageArr.style.width = maxHeight * imageRate + "px";
        imageArr.style.Height = maxHeight + "px";
    }
 }
