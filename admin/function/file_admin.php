<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php 
//��ȫɾ��Ŀ¼�����ַ���
//1���ݹ淨
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


//2��ϵͳ���÷� 
function del_dir($dir)
{
if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
       $str = "rmdir /s/q " . $dir;
} else {
       $str = "rm -Rf " . $dir;
}
} 


//3��ѭ����
function deltree($pathdir) 
{ 
echo $pathdir;//�ҵ���ʱ�õ� 
if(is_empty_dir($pathdir))//����ǿյ� 
      { 
      rmdir($pathdir);//ֱ��ɾ�� 
      } 
      else 
      {//��������Ŀ¼������.��..�� 
          $d=dir($pathdir); 
          while($a=$d->read()) 
          { 
          if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){unlink($pathdir.'/'.$a);} 

          //������ļ���ֱ��ɾ�� 
          if(is_dir($pathdir.'/'.$a) && ($a!='.') && ($a!='..')) 
          {//�����Ŀ¼ 
              if(!is_empty_dir($pathdir.'/'.$a))//�Ƿ�Ϊ�� 
              {//������ǣ���������������ԭ����·��+���¼���Ŀ¼�� 
              deltree($pathdir.'/'.$a); 
              } 
              if(is_empty_dir($pathdir.'/'.$a)) 
              {//����ǿվ�ֱ��ɾ�� 
              rmdir($pathdir.'/'.$a); 
              } 
          } 
          } 
          $d->close();          
      echo "������ɾ��Ŀ¼�µ������ļ�";//�ҵ���ʱ�õ� 
      } 
} 
function is_empty_dir($pathdir) 
{
//�ж�Ŀ¼�Ƿ�Ϊ�գ��ҵķ������Ǻܺðɣ�ֻ�ǿ�����.��..֮����������������Ϊ��
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
