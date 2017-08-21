<?php

 $connect=mysqli_connect('localhost','root','','ims');

 if(mysqli_connect_errno($connect))
 {
   echo "Connection failed try Again ...";
   exit();
 }
?>