<?php
 session_start();
if (!isset($_SESSION['aid']) && !isset($_SESSION['login_token']))
{
   header("Location: AdminLogin.php");
   alert("Please Login To see the content !");
   session_destroy();
   exit();
}

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";

 $projectID=mysqli_real_escape_string($connect,$_POST['projectId']);
 $userId=mysqli_real_escape_string($connect,$_POST['userId']);

 $name=mysqli_real_escape_string($connect,$_POST['taskname']);
 $des=mysqli_real_escape_string($connect,$_POST['taskdesc']);
 $sdate=mysqli_real_escape_string($connect,$_POST['taskstart']);
 $edate=mysqli_real_escape_string($connect,$_POST['taskend']);
 $remark=mysqli_real_escape_string($connect,$_POST['remarks']);

 if(($projectID=='0') || !isset($name) || !isset($des) || !isset($sdate) || !isset($edate) && !isset($remark))
 {
   echo "Please Fill the Form Correctly.!";
   ?>

   <meta http-equiv="refresh" content="2,url=registerTask.php?q=$userId">
   <?php

 }
 else
 {
 $sql="INSERT INTO task(pid,t_title,t_description,t_start,t_deadline,t_remarks) 
               VALUES('$projectID','$name','$des','$sdate','$edate','$remark')"; 

$status=mysqli_query($connect,$sql);

if($status)
{ 
echo "Successfully Submitted!";
  ?>

   <meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php
   

}
else{
	echo "There's some error in your code";
	?>
	<meta http-equiv="refresh" content="2,url=dashboard.php">
	<?php
}
}
?>