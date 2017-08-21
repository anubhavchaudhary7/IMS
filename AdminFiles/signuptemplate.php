<?php
include "database.php";
include "config.php";
session_start();

$uname=$_POST['name'];
$uemail=$_POST['secondemail'];
$id=$_POST['myid'];
$edu=$_POST['education'];
$pro=$_POST['project'];
$add=$_POST['address'];
$phone=$_POST['phone'];
$pass=$_POST['pass'];
$ethernet=$_POST['ethernetadd'];
$wifi=$_POST['wifiadd'];
$image=$_POST['imageUpload'];
$resume=$_POST['resumeUpload'];
$mobile=$_POST['macadd'];
$sip = $_SERVER['REMOTE_ADDR'];
$code=$_GET['q'];
$token=$_GET['token'];

if($uname=="" && $uemail=="" && $edu=="" && $pro=="" && $add=="" && $pass=="" && $ethernet=="" && $wifi=="" && $mobile=="")
{
  echo "Please Enter the details correctly";
  ?>
  <a href="<?php echo WEB_URL;?>index.php">Click here to login</a>
  <?php
} 
else{
        $test="SELECT * FROM user WHERE confirm='$code' AND token='$token' AND confirmstatus=0";

        $sql=mysqli_query($connect,$test);

        $userid=mysqli_fetch_assoc($sql);


        if(mysqli_num_rows($sql)>0)
        {

        mysqli_query($connect,"UPDATE user SET confirmstatus=1 WHERE uid='$userid[uid]'");
        // for the profile picture....
        $target_dir = "Images/";
        $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if (file_exists($target_file)) 
            {
               /* echo "Sorry, Picture already exists.";*/
                $uploadOk = 0;
            }
        if ($_FILES["imageUpload"]["size"] > 500000)
            {/*
                echo "Sorry, your Picture is too large.";*/
                $uploadOk = 0;
            }
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" ) 
            {
               /* echo "Sorry, only jpg, jpeg and png type are allowed";*/
                $uploadOk = 0;
            }
        if ($uploadOk != 0) 
            {
                if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) 
                    {
                      
                    } 
               /* else 
                    {
                        echo "Sorry, there was an error uploading your file.";
                    }*/
            }
  // for the resume
        $target_direc = "Resumes/";
        $target_files = $target_direc . basename($_FILES["resumeUpload"]["name"]);
        $uploadOk2 = 1;
        $imageFileTypes = pathinfo($target_files,PATHINFO_EXTENSION);
        if (file_exists($target_files)) 
            {
               /* echo "Sorry, Picture already exists.";*/
                $uploadOk2 = 0;
            }
        if ($_FILES["resumeUpload"]["size"] > 500000)
            {
              /*  echo "Sorry, your Picture is too large.";*/
                $uploadOk2 = 0;
            }
        if($imageFileTypes != "doc" && $imageFileTypes != "docx" && $imageFileTypes != "pdf" ) 
            {
                /* echo "Sorry, only doc, docx, pdf";*/
                $uploadOk2 = 0;
            }
        if($uploadOk2!=0)
            {
                if (move_uploaded_file($_FILES["resumeUpload"]["tmp_name"], $target_files)) 
                    {
                       
                    } 
            }
  

  if($uploadOk==1 && $uploadOk2==1)
  {
    $q="INSERT INTO user_details
    (uid,name,secondemail,password,status,education,projects,address,phone,wifiaddress,ethernetaddress,mobileaddress,ipaddress,resume,image) 
    VALUES('$id','$uname','$uemail','$pass','1','$edu','$pro','$add','$phone','$wifi','$ethernet','$mobile','$sip','1','1')";


$sql=mysqli_query($connect,$q);

if($sql)
{
 
  echo "Congrats You SignUP Successfully";
  ?>
  <br>
  <br>
  <a href="<?php echo WEB_URL;?>index.php">Click here to login</a>
  <?php
}
else{
	echo "you are here";
	print_r($_POST);
	echo "error"+mysqli_error($connect);
}
}
else{
  echo "Sorry,there was an error in Submiting your form.";
  ?>
  <br>
  <br>
  <a href="<?php echo WEB_URL;?>signup.php">Clikc here to Sign Up Again</a>
  <?php
}
}else
 {?>
   <div class="text text-danger" style="margin:100px;background-color:;height:200px;width:600px;text-align: center;">
      Sorry Page Not Found 440. OR <br>
      The Url has been expired Please contact admin."
   </div>
   <?php
 }

}
?>