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


if($text=='Project')
{
  $Title=mysqli_real_escape_string($connect,$_POST['Title']);
  $Description=mysqli_real_escape_string($connect,$_POST['Description']);
  $Start=mysqli_real_escape_string($connect,$_POST['Start']);
  $End=mysqli_real_escape_string($connect,$_POST['End']);
  $Remarks=mysqli_real_escape_string($connect,$_POST['Remarks']);

 if(isset($id) && isset($Title) && isset($Description) && isset($Start) && isset($End) && isset($Remarks))
{
  $q="UPDATE project SET p_title='$Title',p_description='$Description',p_deadline='$End',p_start='$Start',p_remarks='$Remarks' WHERE pid='$id'";
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

if($text=='Task'){
  $Title=mysqli_real_escape_string($connect,$_POST['Title']);
  $Description=mysqli_real_escape_string($connect,$_POST['Description']);
	$Deadline=mysqli_real_escape_string($connect,$_POST['Deadline']);
if(isset($id) && isset($text))
{
  $q="UPDATE task SET t_title='$Title',t_description='$Description',t_deadline='$Deadline' WHERE tid='$id'";
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

?>