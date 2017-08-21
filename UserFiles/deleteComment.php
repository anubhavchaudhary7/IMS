<?php
 include "database.php";
 include "config.php";

 $commentid=$_POST['commentid'];

 if(mysqli_query($connect,"UPDATE sub_task SET comment_status=0 WHERE cid='$commentid'"))
 {
   echo "1";
 }
 else{
 	echo "2";
 }

?>