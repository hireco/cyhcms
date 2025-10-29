<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
//写入图集的图片信息
if(isset($_POST['submit_s'])) {
if($result) { 
  if($_POST['action']=="edit"){ 
    $result=mysql_query("delete from ".$table_suffix."picture where object_class='member' and object_id=$object_id");
    if($result)  $result=mysql_query("delete from ".$table_suffix."picture_msg where object_class='member' and object_id=$object_id");
    if(!$result) { ShowMsg("数据库写失败！","-1");  exit();  }
    }
   $upload_child_dir=$cfg_album_root;
   $dir_relate=RROOT."/";
   
   for($i=1;$i<=$num_of_img; $i++) {
	$imgfile="imgfile".$i; $imgurl="imgurl".$i; $imgtitle="imgtitle".$i; $imglink="imglink".$i; $imgmsg="imgmsg".$i;
	if(is_uploaded_file($_FILES[$imgfile]['tmp_name'])) 
	 $$imgurl=image_upload($dir_relate,$upload_child_dir,$imgfile,$imgtitle,$imglink);
	 //上传新的图片
	 
	elseif($$imgurl<>"") 	$$imgurl=get_content_url($$imgurl,RROOT);
     //直接提供地址或者其他远程网站的图片的地址 
	 
	 if($$imgurl<>"") {
	  $pic_url=$$imgurl;
	  $pic_title=$$imgtitle;
	  $pic_link =$$imglink;
	  $pic_msg  =$$imgmsg;
	  $object_class="member";
	  
	  $query="insert into ".$table_suffix."picture  (pic_url, object_class,object_id, pic_title,pic_link,sample_pic,small_pic) values
                                                    ('$pic_url','$object_class','$object_id','$pic_title', '$pic_link','0','0')";
      if($result) $result=mysql_query($query); 
      
	  if($pic_msg<>"") {
	  $pic_id=@mysql_insert_id();
	  $query="insert into ".$table_suffix."picture_msg (pic_id,pic_msg,object_class,object_id) values ('$pic_id','$pic_msg','$object_class','$object_id')";
	  if($result) $result=mysql_query($query);
	  
	  }
	 
	 }
   
   }

 }

}
else {
if($_REQUEST['action']=="edit"||$_REQUEST['action']=="add") {
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="90" valign="top"><div align="center">相册介绍</div></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top"><textarea name="body" rows="7" class="TEXTAREA" style="width:100%"><?=$row->content?>
    </textarea></td>
  </tr>
  <tr>
                            <td valign="top"> <div align="center">图片数量：</div></td>
                            <td colspan="3"><input name="picnum" type="text" class="INPUT" id="picnum" style="width:30px" value="10"/>
                              <input name="add_picnum" type="button" class="INPUT" id="add_picnum" onclick="MakeUpload(0);" value="增加图片数量"/>
（ 注：最大120幅，图片地址允许填写远程网址） 
<input name="num_of_img" type="hidden" id="num_of_img" value="12" /></td>
  </tr>
</table>
<?php if($_REQUEST['action']=="edit") {
	$query="select * from ".$table_suffix."picture  where object_class='member' and object_id={$row->id}";
	$result_mate=mysql_query($query);
	$j=1;
	while($row_mate=mysql_fetch_object($result_mate)) {
	$imgurl=$row_mate->pic_url;
	$imgid=$row_mate->id;
	$query="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
	$imgmsg=mysql_result(mysql_query($query),0,"pic_msg");
	$imgtitle=$row_mate->pic_title;
	$imglink=$row_mate->pic_link;
	
	$fhtml = "";
	$fhtml .= "<table width='100%'><tr><td><input type='checkbox' name='isokcheck$j' id='isokcheck$j' value='1'   onClick='CheckSelTable($j)' checked='checked'>显示图片[$j]的选框</td></tr></table>";
	$fhtml .= "<table width=\"100%\" border=\"0\" id=\"seltb$j\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#E8F5D6\" style=\"margin-bottom:6px;margin-left:10px\"><tobdy>";
	$fhtml .= "<tr bgcolor=\"#F4F9DD\">\r\n";
	$fhtml .= "<td height=\"25\" colspan=\"3\">　<strong>图片{$j}：</strong></td>";
	$fhtml .= "</tr>";
	$fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	$fhtml .= "<td width=\"90\" height=\"25\"> 　本地上传： </td><td width=\"260\">";
	$fhtml .= "<input class=\"INPUT\" type=\"file\" name='imgfile$j' style=\"width:260px\" onChange=\"SeePic(document.picview$j,document.form1.imgfile$j);\"></td>";
	$fhtml .= "<td rowspan=\"5\" align=\"center\"><a href=\"action/cut_pic.php?pic_url=".urlencode($imgurl)."&iwidth=$cfg_memsimg_width&iheight=$cfg_memsimg_height&idkey=".md5(basename($imgurl).$cfg_memsimg_width.$cfg_memsimg_height)."\" target=\"_blank\"><img alt=\"点击截取缩略图\" src=\"{$imgurl}\" width=\"$cfg_albsimg_width\" id=\"picview$j\" border=\"0\" name=\"picview$j\"></a></td>";
	$fhtml .= "</tr>";
	$fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	$fhtml .= "<td height=\"25\"> 　指定网址： </td><td width=\"260\">";
	$fhtml .= "<input class=\"INPUT\" type=\"text\" name='imgurl$j' style=\"width:260px\" value=\"{$imgurl}\" > ";
	$fhtml .= "</td></tr>"; 
	$fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	$fhtml .= "<td height=\"25\"> 　图片标题： </td><td width=\"260\">";
	$fhtml .= "<input class=\"INPUT\" type=\"text\" name='imgtitle$j' style=\"width:260px\" value=\"{$imgtitle}\"> ";
	$fhtml .= "</td></tr>";
	$fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	$fhtml .= "<td height=\"25\"> 　图片链接： </td><td width=\"260\">";
	$fhtml .= "<input class=\"INPUT\" type=\"text\" name='imglink$j' style=\"width:260px\"  value=\"{$imglink}\"> ";
	$fhtml .= "</td></tr>";
	$fhtml .= "<tr bgcolor=\"#FFFFFF\"> ";
	$fhtml .= "<td height=\"56\">　图片简介： </td><td width=\"260\">";
	$fhtml .= "<textarea name='imgmsg$j' style=\"height:46px;width:260px\">".$imgmsg."</textarea> </td>";
	$fhtml .= "</tr></tobdy></table>\r\n";
				 echo $fhtml; 
				 $j++;
	  } 
	 echo "<span id=\"uploadfield\"></span>\r\n<script language=\"JavaScript\">\r\n
	 startNum = $j;\r\n</script>";
	} 
   else echo "<span id=\"uploadfield\"></span>\r\n  <script language=\"JavaScript\">\r\n
   MakeUpload(13);\r\n</script>";
 }
else if($_REQUEST['action']=="view") { ?>
  <table width="560"  border=0 align="center" cellpadding="0" cellspacing="0">
											<tr>
											  <td align="center" valign="top"><TABLE border=0 align="center" cellPadding=4 cellSpacing=0>
												<TR>
												<?php 
												$width=90;
												$height=90*$cfg_memsimg_height/$cfg_memsimg_width;
												$i_picture=0; 
												$query="select * from  ".$table_suffix."picture where object_class='member' and object_id={$_REQUEST['id']}";
												$result_picture=mysql_query($query); 
												while($row_picture=mysql_fetch_object($result_picture)){ 
												$pic_url=get_small_img($row_picture->pic_url,$row_picture->small_pic);
												$imgid=$row_picture->id;
												$query_msg="select pic_msg from ".$table_suffix."picture_msg  where pic_id=$imgid";
												$result_msg=mysql_query($query_msg);
												$row_msg=mysql_fetch_object($result_msg);
												
												if(($i_picture%5==0)&&($i_picture<>1)) echo "<TR>"; 
												if($i_picture%5==0) echo "</TR>";
												?>
												  <TD>
													<div align="center"><a href="user_infor.php?view=album&infor_id=<?=$_REQUEST['id']?>&idkey=<?=$md5_idkey?>" target="_blank"><img src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$row_picture->pic_title==""?"点击看大图":$row_picture->pic_title?>" border="1" style="border:1px solid #000;"></a> </div>
												    <div align="center"><?=$row_picture->pic_title==""?"无标题":msubstr($row_picture->pic_title,0,12)?></div>
												  </TD>
												  <?php $i_picture++; 
												} ?>
												</TR>
											  </TABLE></td>
											</tr>
</table>
<?php }
 }  
?>