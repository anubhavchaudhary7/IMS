<?php
session_start();
if(!isset($_SESSION['aid']))
{
   echo "Please Login To see the content !";
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
}

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";
//ini_set()
 function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$token=generateRandomString();
$confirmcode=rand();
//echo "You are here!";

 $email=mysqli_real_escape_string($connect,$_POST['email']);
 $type=mysqli_real_escape_string($connect,$_POST['selectCategory']);
 $date=mysqli_real_escape_string($connect,$_POST['details']);
 $utype=mysqli_real_escape_string($connect,$_POST['selecttype']);
 $sip =mysqli_real_escape_string($connect,$_SERVER['REMOTE_ADDR']);


if(isset($email) && isset($type) && isset($date) && isset($utype) && isset($sip))
{
$sql="INSERT INTO user(email,category,type,dateofjoining,confirm,confirmstatus,token,ip_address) 
      VALUES('$email','$type','$utype','$date','$confirmcode','0','$token','$sip')";

//echo "you are here 1";
// print_r($_POST);

$subject="Confirmation Mail";	
$message="This is the verification link sent from the InternManagerDesk.
          <br>
          In order to complete and verify your application please click the link below
          <br><br>
          http://umesh.iiitd.me/ims/signup.php?email=$email&code=$confirmcode&token=$token";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@gmail.com>' . "\r\n";
$headers .= 'Cc: myboss@gaile.com' . "\r\n";

if(mysqli_query($connect,$sql))
{
  
  if(mail($email,$subject,$message,$headers))
  {
  	echo "Successfully send the verification for the user";
  	?>
  	<meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php
   }
}
else{
	echo "Error detected ...";
  ?>
   <meta http-equiv="refresh" content="2,url=dashboard.php">
 <?php
   }
}
else{
   echo "Some of the field is empty. Fill the form correctly";
    ?>
    <meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php
   }
?>