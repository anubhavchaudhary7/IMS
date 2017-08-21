<?php
session_start();
/*if (!isset($_SESSION['aid']) && !isset($_SESSION['login_token']))
{
   alert("Please Login To see the content !");
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
}*/

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";

function generateRandomNumber()
{ 
  $store=rand(10,100000);
  return $store;
}

$formid=$_POST['formid'];
if($formid==1)
{
  $token=$_POST['csrf-token'];
  $session_token=$_SESSION['token'];
  if(isset($token) && isset($_POST['csrf-token']))
  {
    if($token==$session_token)
    {
      if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'])
        {
          $secret="6LcODyoUAAAAAHyQW4Ws0f_9grTCGuIRIc-Dn_WA";
          $ip=$_SERVER["REMOTE_ADDR"];
          $captcha=$_POST['g-recaptcha-response'];
          $rsp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
          //var_dump($rsp);
          $arr=json_decode($rsp,TRUE);
          if($arr['success'])
          {
            $email=$_POST['userEmail'];
            $pass=$_POST['userPass'];
           
            $q=mysqli_query($connect,"SELECT user.uid,email,secondemail,password,status,type FROM user INNER JOIN user_details ON user.uid=user_details.uid WHERE password='$pass' AND status=1 AND type=0 AND (email='$email' OR secondemail='$email')");
             $temp=mysqli_fetch_assoc($q);
            if(mysqli_num_rows($q)>0)
              { 
                $_SESSION['user_email'] = $temp['email'];
                $_SESSION['password'] = $temp['password'];
                $_SESSION['ipAddress']=$ip;
                $_SESSION['uid'] = generateRandomNumber();
                $present_user_id=$_SESSION['uid'];
               if(mysqli_query($connect,"INSERT INTO logTable (user_id,ip_address) VALUES('$present_user_id','$ip')"))
               {
                echo "Logged in Successfully";
                 ?>
                  <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>user.php">
                 <?php
                 
               }
               else{
                echo "Unable to connect with the database";
               ?>
               <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
               <?php
               }
             }
              else{
                $_SESSION['uid']=0;
              echo "Email Or Password not correct";
               ?>
              <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
               <?php 
               }
           }
            else{
              echo "Entered Wrong Captcha";
              ?>
            <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
             <?php 
            }
      }
      else{
        echo "Captcha is Empty";
        ?>
      <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
       <?php 
      }
    }else{
        $_SESSION['token']=0;
        session_destroy();
        ?>
      <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
       <?php 
    }
 } 
}
else if($formid==2){
   
   $name=$_POST['NameOfUser'];
   $email=$_POST['EmailOfUser'];
   $ip=$_SERVER['REMOTE_ADDR'];

   $uploadOk=1;

  if($uploadOk!=0)
  {
 
    if(mysqli_query($connect,"INSERT INTO temp_user(name,email,resume,ip_address) VALUES('$name','$email','$uploadOk','$ip')"))
    {
   
     echo "Your Request have been successfully sent Wait for the email verification.!!";
     ?>
     <meta http-equiv="refresh" content="1 url=<?php echo WEB_URL; ?>home.php">
    <?php    
    }
    else{
    	echo "Unable to connect to the database please try again.!";

    	?>
     <meta http-equiv="refresh" content="2 url=<?php echo WEB_URL; ?>home.php">
    <?php  


    }
  }
  else{

  	echo "There is some error in uploading your resume please try again.!";
  	 ?>
     <meta http-equiv="refresh" content="2 url=<?php echo WEB_URL; ?>home.php">
    <?php   

  }
}
?>