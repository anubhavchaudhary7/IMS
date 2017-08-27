<?php
 session_start();
 if(!isset($_SESSION['aid']) && !isset($_SESSION['login_token']))
 {
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
 }

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";

$id=mysqli_real_escape_string($connect,$_POST['id']);
$text=mysqli_real_escape_string($connect,$_POST['string']);
$val=mysqli_real_escape_string($connect,$_POST['val']);

$decode=json_decode($val,true);

echo $decode;

foreach ($decode as $k => $v) {
   echo $v[$k];
}

/*if($text=='p_title')
{
 if(isset($id) && isset($text))
{
  $q="UPDATE project SET p_title='$val' WHERE pid='$id'";
  $sql=mysqli_query($connect,$q);
  if($sql>0)
  {
   echo '0';
  }
  else{
  	echo '1';
  }
}
else{
	echo '1';
}	
}
else if($text=='p_description'){
	
if(isset($id) && isset($text))
{
  $q="UPDATE project SET p_description='$val' WHERE pid='$id'";
  $sql=mysqli_query($connect,$q);
  if($sql>0)
  {
   echo '0';
  }
  else{
  	echo '1';
  }
}
else{
	echo '1';
}	
}


?>*/