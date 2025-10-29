<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php require_once(dirname(__FILE__)."/../inc/zodiac_shengxiao.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td bgcolor="#EEF7F3"><strong>关于博主</strong></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#D5D5D5"></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td id="con">
	        <?php 
			 $query="select * from ".$table_suffix."member where user_name='$host_name'";
			 $result=mysql_query($query);
			 if($row=mysql_fetch_object($result)) {
			?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><table width="100%" cellpadding="2" cellspacing="0">
                  <tr>
                    <td><strong>基本信息</strong></td>
                    <td colspan="3">&nbsp;</td>
					</tr>
                  <tr>
                    <td width="80">昵称： </td>
                    <td><?=$row->nick_name?></td>
					<td width="80">属相： </td>
                    <td><?=get_animal(substr($row->birthday,0,4))?></td>
                  </tr>
                  <tr>
                    <td>姓名： </td>
                    <td><?php echo $row->cn_name; if($row->en_name) echo "(".$row->en_name.")";?></td>
					<td>血型： </td>
                    <td><?=$blood_type[$row->blood]?></td>
                  </tr>
                  <tr>
                    <td>性别： </td>
                    <td><?=$row->sex=="m"?"<font color=blue>男</font>":"<font color=red>女</font>";?></td>
					<td>民族： </td>
                    <td><?=$nationality_name[$row->nationality]?></td>
                  </tr>
                  <tr>
                    <td>年龄： </td>
                    <td><?=$row->birthday==""?"":(date("Y")-substr($row->birthday,0,4))."岁"?></td>
					<td>国家： </td>
                    <td><?=$state[$row->state]?></td>
                  </tr>
                  <tr>
                    <td>星座： </td>
                    <td><?php $birthday=explode("-",$row->birthday); echo get_zodiac_sign($birthday[1],$birthday[2])?></td>
                    <td>地区：</td>
                    <td><?=$row->district=="省份-地级市-县、地区"?"":ereg_replace("-地级市","",ereg_replace("-县、地区","",$row->district))?></td>
				  </tr>
			    </table></td>
              </tr>
            </table>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><strong>个人相册</strong></td>
              </tr>
              <tr>
                <td>
                  <table border=0 align="left" cellpadding=4 cellspacing=0>
                    <tr>
                    <?php 
						if($row->album_id==0) echo "<td>暂未设置个人相册</td>";
						else {
						$width=70;
						$height=70*$cfg_memsimg_height/$cfg_memsimg_width;
						$i_picture=0;
						$result_picture=mysql_query("select * from ".$table_suffix."picture where object_class='member' and object_id={$row->album_id}");
						$picture_num=mysql_num_rows($result_picture);
						if(!$picture_num) echo "<td>暂无相片显示</td>";
						while($row_picture=mysql_fetch_object($result_picture)){ 
						$pic_url=get_small_img($row_picture->pic_url,$row_picture->small_pic);
						if(($i_picture%6==0)&&($i_picture<>1)) echo "<TR>"; 
						if($i_picture%6==0) echo "</TR>";
						?>
                      <td height=<?=$height+20?>>
                        <div align="center"><a href="?view=album&infor_id=<?=$row->album_id?>&idkey=<?=$_REQUEST['idkey']?>" target="_blank"><img src="<?=$pic_url?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$row_picture->pic_title==""?"点击看大图":$row_picture->pic_title?>" border="1" style="border:1px solid #000;"></a> </div></td>
                      <?php $i_picture++; 
					    }
					  }	 
					  ?>
                    </tr>
                </table></td>
              </tr>
            </table>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><strong>自我介绍</strong></td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border=0 align="left" cellpadding=4 cellspacing=0>
                    <tr><td>
                      <?php 
						$result_intro=mysql_query("select * from ".$table_suffix."member_infor where user_name='$host_name' limit 0, 1");
						if($row_intro=mysql_fetch_object($result_intro))
						echo $row_intro->content;
						else echo "暂无自我介绍";
					  ?>
					  </td>
                    </tr>
                </table></td>
              </tr>
            </table>			<?php } ?></td>
        </tr>
    </table></td>
  </tr>
</table>