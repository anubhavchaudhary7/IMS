<?php

 start_session();
 if(!isset($_SESSION['aid']) && !isset($_SESSION['login_token']))
 {
   //alert("Please Login To see the content !");
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
 }

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";

var $id=mysqli_real_escape_string($connect,$_POST['id']);
var $text=mysqli_real_escape_string($connect,$_POST['string']);
var $val=mysqli_real_escape_string($connect,$_POST['val']);

if(isset($id) && isset($text) && $text=="p_title")
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

?>