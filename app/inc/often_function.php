<?php 
function get_small_pic($picture) {
 if(ereg("_lit\.",$picture)) 
  return $picture;
 global $cfg_mainsite;
 $picture=ereg_replace($cfg_mainsite,"",$picture); 
 $picture=explode(".",$picture);
 $file_name=$picture[0]."_lit.".$picture[1];
 $file_name=$cfg_mainsite.$file_name;
 return $file_name;
 }
 
 function get_small_img($picture,$small_pic) {
 if($small_pic=="0") return $picture;
 elseif($small_pic=="1") { 
  if(ereg("_lit\.",$picture))   return $picture;
  global $cfg_mainsite;
  $picture=ereg_replace($cfg_mainsite,"",$picture); 
  $picture=explode(".",$picture);
  $file_name=$picture[0]."_lit.".$picture[1];
  $file_name=$cfg_mainsite.$file_name;
  return $file_name;
  } 
 else return "";
 } 
 
 function show_pic($pic_id,$iwidth,$iheight) {
  if(!$pic_id) return false;
  else {
  global $table_suffix;
  $query="select * from ".$table_suffix."picture where id=$pic_id";
  $result=mysql_query($query);
  if($row=mysql_fetch_object($result)) {
  echo "<table width=\"100%\"   border=\"0\" cellpadding=\"0\" cellspacing=\"10\"><tr><td><div align=\"center\">";
  echo "<img id=\"pic_id".$row->id."\" onload=\"reload_pic('pic_id".$row->id."',$iwidth,$iheight);\" alt=\"".$row->pic_title."\" src=".$row->pic_url.">";
  echo "</div></td></tr></table>";
    } 
  }
 }

//全角转为半角 
  function quan2ban($Str) 
{   
   $Queue = Array( 
   '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
   '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',         
   'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',          
   'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',         
   'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',          
   'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',         
   'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',          
   'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',         
   'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',          
   'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',         
   'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',          
   'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',         
   'ｙ' => 'y', 'ｚ' => 'z', '－' => '-'     
    );              
   return preg_replace("/([\xA3][\xB0-\xB9\xC1-\xDA\xE1-\xFA])/e", "\$Queue[\\1]", $Str); 
 }  

//去掉所有的html

function strip_html($string)
{
$search = array ("'<script[^>]*?>.*?</script>'si", // 去掉 javascript 4B+1Zs mMd 
          "'<[/!]*?[^<>]*?>'si",       // 去掉 HTML 标记
          "'([rn])[s]+'",           // 去掉空白字符
          "'&(quot|#34);'i",           // 替换 HTML 实体
          "'&(amp|#38);'i",
          "'&(lt|#60);'i",
          "'&(gt|#62);'i",
          "'&(nbsp|#160);'i",
          "'&(iexcl|#161);'i",
          "'&(cent|#162);'i",
          "'&(pound|#163);'i",
          "'&(copy|#169);'i",
          "'&#(d+);'e");
$replace = array(
         "",
            "",
            "\1",
            "\"",
            "&",
            "<",
            ">",
            " ",
            chr(161),
            chr(162),
            chr(163),
            chr(169),
            "chr(\1)");
return preg_replace($search, $replace, $string); 
}
?>
