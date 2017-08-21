<?php
 
 include "database.php";
 include "config.php";

 $u=$_GET['userid'];
 $p=$_GET['projectid'];
 
 $sql="SELECT tid,t_completed FROM task WHERE pid='$p'";
 $q=mysqli_query($connect,$sql);
 $q1=mysqli_query($connect,"SELECT p_status FROM Project WHERE pid='$p'");
 $store=mysqli_fetch_assoc($q1);
 if($store['p_status']==1)
 {
   echo "Already marked as done";
 }else{
 $flag=0;
 if(mysqli_num_rows($q)>0)
 {
   while($row=mysqli_fetch_assoc($q))
   {
   	if($row['t_completed']==1)
   	{
   	  $flag=1;

   	}else if($row['t_completed']==0){
      $flag=0;
      break;
   	}
   }

  if(mysqli_query($connect,"UPDATE Project SET p_status=1 WHERE pid='$p'") AND $flag)
  	{
  		echo "1";
  	}
  else{
  	mysqli_query($connect,"UPDATE Project SET p_status=0 WHERE pid='$p'");
  	echo "2";
  } 
 }
 else{
 	echo "3";
 }
}
?>