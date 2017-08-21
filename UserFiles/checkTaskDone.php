<?php
 
 include "database.php";
 include "config.php";

 $t=$_GET['taskid'];
 $p=$_GET['projectid'];
 
 $sql="SELECT t_completed FROM task WHERE pid='$p' AND tid='$t'";
 $q=mysqli_query($connect,$sql);
 $flag=0;
 if(mysqli_num_rows($q)>0)
 {
  $row=mysqli_fetch_assoc($q);
  if($row['t_completed']==0)
   	{
      mysqli_query($connect,"UPDATE task SET t_completed=1 WHERE pid='$p'");
      echo "1";
   	}
 }else{
  echo "Connecting Problem";
 }
?>