<?php
  require_once(dirname(__FILE__)."/../../dbscripts/db_connect.php"); 
  function get_section($chapter_0="所属章",$section_0="所属节",$point_0="所属知识点") { 
  global  $table_suffix;
  echo "
  <script>
  function Dsy() 
  { 
  this.Items = {}; 
  } 
  Dsy.prototype.add = function(id,iArray) 
  { 
  this.Items[id] = iArray; 
  } 
  Dsy.prototype.Exists = function(id) 
  { 
  if(typeof(this.Items[id]) == \"undefined\") return false; 
  return true; 
  } 
   
  function change(v){ 
  var str=\"0\"; 
  for(i=0;i<v;i++){ str+=(\"_\"+(document.getElementById(s[i]).selectedIndex-1));}; 
  var ss=document.getElementById(s[v]); 
  with(ss){ 
   length = 0; 
   options[0]=new Option(opt0[v],opt0[v]); 
   if(v && document.getElementById(s[v-1]).selectedIndex>0 || !v) 
   { 
   if(dsy.Exists(str)){ 
   ar = dsy.Items[str]; 
   for(i=0;i<ar.length;i++)options[length]=new Option(ar[i],ar[i]); 
   if(v)options[1].selected = true; 
   } 
   } 
   if(++v<s.length){change(v);} 
  } 
  } 
   
  var dsy = new Dsy(); "; 
  
  $cha_string="";
  $section_string="";
  $point_string="";
  $total_section_num=0;
  $total_chapter_num=0;
  
  $result_cha=@mysql_query("select * from  ".$table_suffix."chapter where 1=1 order by top_time desc");
  if($result_cha)  { $cha_num=@mysql_num_rows($result_cha);  $total_chapter_num=$cha_num;
   $cha_string="dsy.add(\"0\",[";
    for($i=0;$i<$cha_num;$i++) 
	{ 
    if($i==0)                $cha_string=$cha_string."\"".@mysql_result($result_cha,$i,"chapter_name")."\"";
	elseif($i==$cha_num-1)   $cha_string=$cha_string.",\"".@mysql_result($result_cha,$i,"chapter_name")."\"]);";   
    else                     $cha_string=$cha_string. ",\"".@mysql_result($result_cha,$i,"chapter_name")."\"";
    
    $chapter_id=@mysql_result($result_cha,$i,"id");
	
	$result_section=@mysql_query("select * from  ".$table_suffix."section where chapter_id='$chapter_id' order by top_time desc");
    if($result_section)  { $section_num=@mysql_num_rows($result_section); if($total_section_num<$section_num)  $total_section_num=$section_num;
      if($section_num==0) {$section_string[$i]=""; continue;}
	   $section_string[$i]="dsy.add(\"0_".$i."\",[";
        for($j=0;$j<$section_num;$j++) 
	    {  
          if(($j==0)&&($j==$section_num-1))  $section_string[$i]=$section_string[$i]."\"".@mysql_result($result_section,$j,"section_name")."\"]);";
	      elseif($j==0)                      $section_string[$i]=$section_string[$i]."\"".@mysql_result($result_section,$j,"section_name")."\"";
		  elseif($j==$section_num-1)         $section_string[$i]=$section_string[$i].",\"".@mysql_result($result_section,$j,"section_name")."\"]);";   
          else                               $section_string[$i]=$section_string[$i]. ",\"".@mysql_result($result_section,$j,"section_name")."\"";
		  
		  $point_list=ereg_replace("，",",",@mysql_result($result_section,$j,"point"));
		  $point_list=explode(",",$point_list); 
		  $point_num=count($point_list);
          
		  if($point_num==0)  { $point_string[$i][$j]=""; continue; }
	      $point_string[$i][$j]="dsy.add(\"0_".$i."_".$j."\",[";
          for($k=0;$k<$point_num;$k++) 
	      {  
            if(($k==0)&&($k==$point_num-1))     $point_string[$i][$j]=$point_string[$i][$j]."\"".$point_list[$k]."\"]);";
	        elseif($k==0)                       $point_string[$i][$j]=$point_string[$i][$j]."\"".$point_list[$k]."\"";
		    elseif($k==$point_num-1)            $point_string[$i][$j]=$point_string[$i][$j].",\"".$point_list[$k]."\"]);";   
            else                                $point_string[$i][$j]=$point_string[$i][$j]. ",\"".$point_list[$k]."\"";
		   }
	      }
	    }
    }
 }
  echo $cha_string;	 
  while($temp=each($section_string))     echo $temp['value'];
     
  for($i=0;$i<$total_chapter_num;$i++)
   for($j=0;$j<$total_section_num;$j++)
    if(isset($point_string[$i][$j]))
     echo $point_string[$i][$j];
 
  
  echo " 
  var s=[\"chapter\",\"section\",\"point\"]; 
  var opt0 = [\"".$chapter_0."\",\"".$section_0."\",\"".$point_0."\"]; 
  function setup() 
  { 
  for(i=0;i<s.length-1;i++) 
   document.getElementById(s[i]).onchange=new Function(\"change(\"+(i+1)+\")\"); 
  change(0); 
  } 
   
  </script>"; 
  echo "
  <SCRIPT language=\"javascript\"> 
   setup() 
  </SCRIPT>"; 
  }
 
$chapter_default="所属章";
$section_default="所属节";
$point_default="所属知识点";
?>  


