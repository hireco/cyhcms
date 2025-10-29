<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="refresh" content="60">
<title>iframe</title>
<?php echo "
<script> 
 var time_diff=".$_SESSION['time_diff'].";
 function showtime() {
  var myDate = new Date();
  var cur_time=myDate.getTime()/1000; 
  var start_time=".$_SESSION['start_time'].";
  var left_time=100-(cur_time-start_time+time_diff)/60;
  document.all.show.innerHTML=\"<font color=red>ªπ £\"+left_time.toFixed(1)+\"∑÷÷”</font>\";
  setTimeout(\"showtime()\",1000);
 }
</script>";
?>
</head>
<body onload="showtime()"> 
<span id="show"> </span>
</body>
</html>