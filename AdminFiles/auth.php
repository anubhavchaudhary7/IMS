<?php
session_start();
include "../ConfigFiles/database.php";
include "../ConfigFiles/config.php";
if($connect)
{
function RandomNumber()
{ 
  $store=rand(10,100000);
  return $store;
}

$mail=mysqli_real_escape_string($connect,$_POST['email']);
$pass=mysqli_real_escape_string($connect,$_POST['pass']);

$token_value=mysqli_real_escape_string($connect,$_POST['token']);

if(isset($mail) && isset($pass) && isset($token_value) && ($token_value==$_SESSION['login_token']))
 {
     $q="SELECT user.uid,email,password 
          FROM user 
          INNER JOIN user_details ON user.uid=user_details.uid
          WHERE email='$mail' AND password='$pass'";

      $sql=mysqli_query($connect,$q);
      if(mysqli_num_rows($sql)>0)
      {
        $d=mysqli_fetch_array($sql);
        //echo $d['uid'];
        $_SESSION['aid']=$d['uid'];
        $present_user_id=$d['uid'];
        $ip=$_SERVER['REMOTE_ADDR'];
        //echo "You are here";
        //echo "$_SESSION['aid'] is : "+$_SESSION['aid']+"\n";
        //echo "parent_user_id is : ".$present_user_id."\n";
        //print_r($connect);
        //print_r($sql);
        //print_r(mysqli_query($connect,"INSERT INTO logtable(user_id,type,ip_address) VALUES('$present_user_id','1','$ip')"));
        if(mysqli_num_rows($sql)>0)
        {
         ?>
           Loggged in Successfully,Redirecting in 2 sec..
        <meta http-equiv="refresh" content="2,url=dashboard.php">
         <?php
         }
         else{
           ?>
           Unable to connect to the Database please try after Sometime please please!
         <!--    <meta http-equiv="refresh" content="2,url=AdminLogin.php"> -->
         <?php 
         }
        }
      else{
      ?>
      <h2>Invalid Username and Password or use primary email to login</h2><br>
      <br>
        Redirecting in 2 sec...
        <meta http-equiv="refresh" content="1 url=AdminLogin.php">
      <?php
    }  
  }
  else{
    ?>
  <meta http-equiv="refresh" content="1 url=AdminLogin.php">
  <?php
  }
}
else{
  echo "Unable to connect to the database please try after some time please please";
  ?>
  <meta http-equiv="refresh" content="1 url=AdminLogin.php">
  <?php
}
?>
