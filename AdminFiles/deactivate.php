<?php
 
 include "database.php";
 include "config,php";
 
 $q=$_GET['q'];
 $sta=$_GET['sta'];
 
if($sta==1)
{
if(mysqli_query($connect,"UPDATE user_details SET status=0 WHERE uid='$q'"))
{
?>
  	<meta http-equiv="refresh" content="2,url= <?php WEB_URL;?>dashboard.php">
   <?php
}
else{
	echo "User cannot be deactivated Encountered some error !";
?>
  	<meta http-equiv="refresh" content="2,url= <?php WEB_URL;?>profile.php?q=<?php echo $q; ?>">
   <?php
}
}
else{
	if(mysqli_query($connect,"UPDATE user_details SET status=1 WHERE uid='$q'"))
{
	echo "User Account Activated.!!";
?> 
  	<meta http-equiv="refresh" content="2,url= <?php WEB_URL;?>dashboard.php">
   <?php
}
else{
	echo "User cannot be Activated Encountered some error !";
?>
  	<meta http-equiv="refresh" content="2,url= <?php WEB_URL;?>profile.php?q=<?php echo $q; ?>">
   <?php
}

}


?>