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
use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

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

 $email=mysqli_real_escape_string($connect,$_POST['email']);
 $type=mysqli_real_escape_string($connect,$_POST['selectCategory']);
 $date=mysqli_real_escape_string($connect,$_POST['details']);
 $utype=mysqli_real_escape_string($connect,$_POST['selecttype']);
 $sip =mysqli_real_escape_string($connect,$_SERVER['REMOTE_ADDR']);


if(isset($email) && isset($type) && isset($date) && isset($utype) && isset($sip))
{
$sql="INSERT INTO user(email,category,type,dateofjoining,confirm,confirmstatus,token,ip_address) 
        VALUES('$email','$type','$utype','$date','$confirmcode','0','$token','$sip')";

$q=mysqli_query($connect,$sql);

if($q>0)
{
define('REQUIRED_FILE','../vendor/autoload.php'); 
define('SENDER','intern@mail.api-central.net');  
define('RECIPIENT',$email);    
define('REGION','us-west-2'); 

define('SUBJECT','Confirmation Mail');

define('HTMLBODY','<h1>This is the verification link sent from the InternManagerDesk</h1>'.
                  '<br>'.
                   'In order to complete and verify your application please click the link below'.
                   '<br><br>'.
                   'http://umesh.iiitd.me/ims/signup.php?email=$email&code=$confirmcode&token=$token');

define('TEXTBODY','This email was send with Amazon SES using the AWS SDK for PHP.');

define('CHARSET','UTF-8');

require REQUIRED_FILE;

$client = SesClient::factory(array(
    'version'=> 'latest',
    'credentials' => array(
        'key'    => 'AKIAILAA5BMHJI4W6KRA',
        'secret' => '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',
    ),     
    'region' => REGION
));

try {
     $result = $client->sendEmail([
    'Destination' => [
        'ToAddresses' => [
            RECIPIENT,
        ],
    ],
    'Message' => [
        'Body' => [
            'Html' => [
                'Charset' => CHARSET,
                'Data' => HTMLBODY,
            ],
      'Text' => [
                'Charset' => CHARSET,
                'Data' => TEXTBODY,
            ],
        ],
        'Subject' => [
            'Charset' => CHARSET,
            'Data' => SUBJECT,
        ],
    ],
    'Source' => SENDER,
]);
     $messageId = $result->get('MessageId');
     echo("Email sent! Message ID: $messageId"."\n");
     ?>
    <meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php

} catch (SesException $error) {
     echo("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
     ?>
    <meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php
}
}
else{
  echo "Unable to connect with the database";
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