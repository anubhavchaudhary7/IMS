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

$uid=mysqli_real_escape_string($connect,$_POST['uid']);
$admin=mysqli_real_escape_string($connect,$_SESSION['aid']);

 $name=mysqli_real_escape_string($connect,$_POST['projectname']);
 $des=mysqli_real_escape_string($connect,$_POST['projectdesc']);
 $sdate=mysqli_real_escape_string($connect,$_POST['pstartdate']);
 $edate=mysqli_real_escape_string($connect,$_POST['penddate']);
 $remark=mysqli_real_escape_string($connect,$_POST['remarks']);
 
if( !isset($name)|| !isset($des)|| !isset($sdate)|| !isset($edate)|| !isset($remark)|| !isset($admin))
{
 echo "Please Fill the Form correctly";
 ?>
 <meta http-equiv="refresh" content="2,url=registerProject.php?q=$uid">
 <?php
 }
else{	
 $sql="INSERT INTO Project(uid,p_assigned_by,p_title,p_description,p_start,p_deadline,p_remarks) 
               VALUES('$uid','$admin','$name','$des','$sdate','$edate','$remark')"; 

$status=mysqli_query($connect,$sql);

if($status)
{
  echo "Project Successfully Assigned!";
   ?>
   <meta http-equiv="refresh" content="2,url=dashboard.php">
   <?php
}
else{
	echo "Unable to connect to the database please trya after sometime";
	?>
	<meta http-equiv="refresh" content="2,url=dashboard.php">
	<?php
}
}
?>