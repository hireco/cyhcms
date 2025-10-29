<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <?php
  require_once("setting.php");
  require_once(dirname(__FILE__)."/../dbscripts/db_connect.php"); 
  function hometown($province_0="省份",$city_0="地级市",$district_0="县/地区") { 
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
  
  $pro_string="";
  $city_string="";
  $district_string="";
  $total_city_num=0;
  $total_province_num=0;
  
  $result_pro=@mysql_query("select * from  ".$table_suffix."province where 1=1 order by top_time desc");
  if($result_pro)  { $pro_num=@mysql_num_rows($result_pro);  $total_province_num=$pro_num;
   $pro_string="dsy.add(\"0\",[";
    for($i=0;$i<$pro_num;$i++) 
	{ 
    if($i==0)                $pro_string=$pro_string."\"".@mysql_result($result_pro,$i,"prov_name")."\"";
	elseif($i==$pro_num-1)   $pro_string=$pro_string.",\"".@mysql_result($result_pro,$i,"prov_name")."\"]);";   
    else                     $pro_string=$pro_string. ",\"".@mysql_result($result_pro,$i,"prov_name")."\"";
    
    $province_id=@mysql_result($result_pro,$i,"id");
	
	$result_city=@mysql_query("select * from  ".$table_suffix."city where prov_id='$province_id' order by id");
    if($result_city)  { $city_num=@mysql_num_rows($result_city); if($total_city_num<$city_num)  $total_city_num=$city_num;
      if($city_num==0) {$city_string[$i]=""; continue;}
	   $city_string[$i]="dsy.add(\"0_".$i."\",[";
        for($j=0;$j<$city_num;$j++) 
	    {  
          if(($j==0)&&($j==$city_num-1))  $city_string[$i]=$city_string[$i]."\"".@mysql_result($result_city,$j,"city_name")."\"]);";
	      elseif($j==0)                   $city_string[$i]=$city_string[$i]."\"".@mysql_result($result_city,$j,"city_name")."\"";
		  elseif($j==$city_num-1)         $city_string[$i]=$city_string[$i].",\"".@mysql_result($result_city,$j,"city_name")."\"]);";   
          else                            $city_string[$i]=$city_string[$i]. ",\"".@mysql_result($result_city,$j,"city_name")."\"";
		  
		  $district_list=explode(",",@mysql_result($result_city,$j,"district_list")); 
		  $district_num=count($district_list);
          
		  if($district_num==0)  { $district_string[$i][$j]=""; continue; }
	      $district_string[$i][$j]="dsy.add(\"0_".$i."_".$j."\",[";
          for($k=0;$k<$district_num;$k++) 
	      {  
            if(($k==0)&&($k==$district_num-1))  $district_string[$i][$j]=$district_string[$i][$j]."\"".$district_list[$k]."\"]);";
	        elseif($k==0)                       $district_string[$i][$j]=$district_string[$i][$j]."\"".$district_list[$k]."\"";
		    elseif($k==$district_num-1)         $district_string[$i][$j]=$district_string[$i][$j].",\"".$district_list[$k]."\"]);";   
            else                                $district_string[$i][$j]=$district_string[$i][$j]. ",\"".$district_list[$k]."\"";
		   }
	      }
	    }
    }
 }
  echo $pro_string;	 
  while($temp=each($city_string))     echo $temp['value'];
     
  for($i=0;$i<$total_province_num;$i++)
   for($j=0;$j<$total_city_num;$j++)
    if(isset($district_string[$i][$j]))
     echo $district_string[$i][$j];
 
  
  echo " 
  var s=[\"province\",\"city\",\"county\"]; 
  var opt0 = [\"".$province_0."\",\"".$city_0."\",\"".$district_0."\"]; 
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
 
$province_default="省份";
$city_default="地级市";
$district_default="县、地区";
?>  


