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

//ȫ��תΪ��� 
  function quan2ban($Str) 
{   
   $Queue = Array( 
   '��' => '0', '��' => '1', '��' => '2', '��' => '3', '��' => '4',
   '��' => '5', '��' => '6', '��' => '7', '��' => '8', '��' => '9',         
   '��' => 'A', '��' => 'B', '��' => 'C', '��' => 'D', '��' => 'E',          
   '��' => 'F', '��' => 'G', '��' => 'H', '��' => 'I', '��' => 'J',         
   '��' => 'K', '��' => 'L', '��' => 'M', '��' => 'N', '��' => 'O',          
   '��' => 'P', '��' => 'Q', '��' => 'R', '��' => 'S', '��' => 'T',         
   '��' => 'U', '��' => 'V', '��' => 'W', '��' => 'X', '��' => 'Y',          
   '��' => 'Z', '��' => 'a', '��' => 'b', '��' => 'c', '��' => 'd',         
   '��' => 'e', '��' => 'f', '��' => 'g', '��' => 'h', '��' => 'i',          
   '��' => 'j', '��' => 'k', '��' => 'l', '��' => 'm', '��' => 'n',         
   '��' => 'o', '��' => 'p', '��' => 'q', '��' => 'r', '��' => 's',          
   '��' => 't', '��' => 'u', '��' => 'v', '��' => 'w', '��' => 'x',         
   '��' => 'y', '��' => 'z', '��' => '-'     
    );              
   return preg_replace("/([\xA3][\xB0-\xB9\xC1-\xDA\xE1-\xFA])/e", "\$Queue[\\1]", $Str); 
 }  

//ȥ�����е�html

function strip_html($string)
{
$search = array ("'<script[^>]*?>.*?</script>'si", // ȥ�� javascript 4B+1Zs mMd 
          "'<[/!]*?[^<>]*?>'si",       // ȥ�� HTML ���
          "'([rn])[s]+'",           // ȥ���հ��ַ�
          "'&(quot|#34);'i",           // �滻 HTML ʵ��
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
