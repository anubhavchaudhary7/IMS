<?php
 
 include "database.php";
 include "config.php";

$uid=$_POST['uid'];
$admin=$_POST['adminid'];
 //$projectID=$_POST['projectname'];
 $name=$_POST['projectname'];
 $des=$_POST['projectdesc'];
 $sdate=$_POST['pstartdate'];
 $edate=$_POST['penddate'];
 $remark=$_POST['remarks'];
if($edate<$start)
{
 echo "You entered wrong dates.! please check again";
 ?>
 <meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>registerProject.php?q=$uid">
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
   <meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>dashboard.php">
   <?php
}
else{
	echo "There is some error please check";
	?>
	<meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>dashboard.php">
	<?php
}
}
?>