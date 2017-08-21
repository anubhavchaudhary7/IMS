<?php

 include "database.php";
 include "config.php";

 $commentid=$_POST['commentid'];
 $project=$_POST['projectid'];
 $task=$_POST['taskid'];
 $stat=$_POST['prop'];

 if($stat=='like')
 {
   if(mysqli_query($connect,"UPDATE sub_task
   	                         SET like_count=like_count+1
   	                         WHERE cid='$commentid'"))
   {
   	 $q=mysqli_query($connect,"SELECT like_count FROM sub_task WHERE cid='$commentid'");
     $a=mysqli_fetch_assoc($q);
     echo $a['like_count'];
   }
   else
   {
   	echo "0";
   }

 }
 else if($stat=='dislike'){
  if(mysqli_query($connect,"UPDATE sub_task
   	                         SET dislike_count=dislike_count+1
   	                         WHERE cid='$commentid'"))
   {
   	 $q=mysqli_query($connect,"SELECT dislike_count FROM sub_task WHERE cid='$commentid'");
     $a=mysqli_fetch_assoc($q);
     echo $a['dislike_count'];
   }
   else
   {
   	echo "0";
   }

 }

?>