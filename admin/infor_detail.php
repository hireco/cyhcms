<?php session_start();
require_once("setting.php");
require_once("inc.php");
require_once("scripts/constant.php");
require_once("../config/auto_set.php");
$query="select * from ".$table_suffix."infor where 1";
$result=mysql_query($query);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script>
    var maxWidth=<?php echo $cfg_colsimg_width;?>; 
	var maxHeight=<?php echo $cfg_colsimg_height;?>;
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
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="613"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="613" valign="top">
	<?php require_once("scripts/header.php");?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="image/body_title_bg.gif">
  <tr>
    <td><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td>
            <table width="100%" height="25"  border="0" cellpadding="0" cellspacing="0">              
              <tr>
                <td><img src="../image/body_title_left.gif" width="3" height="27"></td>
                <td width="80" valign="bottom" bgcolor="#FFFFFF"><div class="bigtext_b">
                  <div align="center">������Ŀ</div>
                </div></td>
                <td><img src="../image/body_title_right.gif" width="3" height="27"></td>
              </tr>              
          </table></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>      <div align="center">
      </div></td>
  </tr>
</table>

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#0B3625">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
			  <?php while($row=mysql_fetch_object($result)) { ?>
			  <a name="<?=$row->id?>"></a>			  <table width="100%"  border="0" cellspacing="0" cellpadding="2">
                <tr bgcolor="#F4D8AC">
                  <td colspan="5"><table border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="10">&nbsp;</td>
                        <td><a href="infor.php?infor_class=<?=$row->infor_class?>"><strong><?=$row->class_name?></strong></a>>></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="120" rowspan="6" align="center" valign="middle">
                    <table border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
                          <tr>
                            <td bgcolor="#FFFFFF"><?php if($row->picture!="") { ?>
                              <a href="cut_pic.php?pic_url=<?=$row->picture?>&iwidth=<?=$cfg_colsimg_width?>&iheight=<?=$cfg_colsimg_height?>&cut_self" target="_blank"><img src="<?=$row->picture?>" border="0" id="img<?=$row->id?>" onload="reload_pic('img<?=$row->id?>');" ></a>                              <?php } else echo "δ��ͼƬ";?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  <td width="100" valign="top" nowrap><strong>[��Ŀ����] </strong>                    <div align="center"></div></td>
                  <td width="400" valign="top" nowrap><?php echo $row->class_name;?> </td>
                  <td width="100" valign="top" nowrap><div align="center"><strong>[��������]</strong></div></td>
                  <td valign="top" nowrap><?=$row->infor_class?></td>
                </tr>
                <tr>
                  <td valign="top">
                    <div align="left"><strong>[��Ŀģ��] </strong></div></td>
                  <td valign="top"><?=$row->template==""?"Ĭ��":$row->template?></td>
                  <td valign="top"><div align="center"><strong>[��ƪģ��]</strong></div></td>
                  <td valign="top"><?=$row->template_list?>  <a href="template_list.php?activepath=/template/<?=$row->infor_class?>&for_class=infor&for_id=<?=$row->id?>&description=<?=urlencode("Ϊ".$row->class_name."���ģ��")?>" target="_blank">&lt;���ģ��&gt;</a></td>
                </tr>
                <tr>
                  <td valign="top"><strong>[�ؼ��ֱ�] </strong>                    <div align="center"></div>                    <div align="left">
                    </div></td>
                  <td valign="top"><?=$row->keywords?></td>
                  <td valign="top"><div align="center"><strong>[��Ŀ���]</strong></div></td>
                  <td valign="top"><?=$row->introduction?></td>
                </tr>
                <tr>
                  <td><strong>[����Ȩ��]</strong></td>
                  <td width="400"><?php
					echo $hide_type[$row->hide_type];				
					 ?>
                  </td>
                  <td width="100"><div align="center"><strong>[��������]</strong></div></td>
                  <td><?php
					if($row->top_navi=="1") echo "�Ѿ���ʾ";
					else echo "δ��ʾ";					
					 ?></td>
                </tr>
                <tr>
                  <td><strong>[����Ȩ��]</strong></td>
                  <td><?php
					echo $post_type[$row->post_type];				
					 ?>
                  </td>
                  <td><div align="center"><strong>[��ർ��]</strong></div></td>
                  <td><?php
					if($row->left_navi=="1") echo "�Ѿ���ʾ";
					else echo "δ��ʾ";					
					 ?></td>
                </tr>
                <tr>
                  <td><strong>[��Ŀ�ö�]</strong></td>
                  <td><?php
					if($row->top=="1")  { echo "�Ѿ��ö� ���:"; echo "<font color=red>".$row->top."</font>"; }
					else echo "û���ö�";
				    ?>
                  </td>
                  <td><div align="center"><strong>[��Ŀ����]</strong></div></td>
                  <td><?php  echo $class_attribute[$row->class_attribute];?></td>
                </tr>
              </table>
			  <?php } ?>			  </td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
    </td>
  </tr>
</table>
</body>
<?php require_once("scripts/footer.php"); ?></html>