<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
//完全删除目录的三种方法
//1、递规法
function deleteDir($dir)
{
if (rmdir($dir)==false && is_dir($dir)) {
    if ($dp = opendir($dir)) {
     while (($file=readdir($dp)) != false) {
      if (is_dir($file) && $file!='.' && $file!='..') {
       deleteDir($file);
      } else {
       unlink($file);
      }
     }
     closedir($dp);
    } else {
     exit('Not permission');
    }
} 
} 


//2、系统调用法 
function del_dir($dir)
{
if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
       $str = "rmdir /s/q " . $dir;
} else {
       $str = "rm -Rf " . $dir;
}
} 


//3、循环法
function deltree($pathdir) 
{ 
echo $pathdir;//我调试时用的 
if(is_empty_dir($pathdir))//如果是空的 
      { 
      rmdir($pathdir);//直接删除 
      } 
      else 
      {//否则读这个目录，除了.和..外 
          $d=dir($pathdir); 
          while($a=$d->read()) 
          { 
          if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){unlink($pathdir.'/'.$a);} 

          //如果是文件就直接删除 
          if(is_dir($pathdir.'/'.$a) && ($a!='.') && ($a!='..')) 
          {//如果是目录 
              if(!is_empty_dir($pathdir.'/'.$a))//是否为空 
              {//如果不是，调用自身，不过是原来的路径+他下级的目录名 
              deltree($pathdir.'/'.$a); 
              } 
              if(is_empty_dir($pathdir.'/'.$a)) 
              {//如果是空就直接删除 
              rmdir($pathdir.'/'.$a); 
              } 
          } 
          } 
          $d->close();          
      echo "必须先删除目录下的所有文件";//我调试时用的 
      } 
} 
function is_empty_dir($pathdir) 
{
//判断目录是否为空，我的方法不是很好吧？只是看除了.和..之外有其他东西不是为空
$d=opendir($pathdir); 
$i=0; 
      while($a=readdir($d)) 
      { 
      $i++; 
      } 
closedir($d); 
if($i>2){return false;} 
else return true; 
}

?>
