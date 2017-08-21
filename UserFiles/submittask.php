<?php
 
 include "database.php";
 include "config.php";

 $projectID=$_POST['projectname'];
 $name=$_POST['taskname'];
 $des=$_POST['taskdesc'];
 $sdate=$_POST['taskstart'];
 $edate=$_POST['taskend'];
 $remark=$_POST['remarks'];

 if($projectID=='0')
 {
   echo "Please Select Project First!";
   ?>

   <meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>dashboard.php">
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

   <meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>dashboard.php">
   <?php
   

}
else{
	echo "There's some error in your code";
	?>
	<meta http-equiv="refresh" content="2,url=<?php echo WEB_URL; ?>dashboard.php">
	<?php
}
}
?>