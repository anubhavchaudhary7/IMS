<?php 
include "database.php";
include "config.php";

$no=$_POST['prop'];
$content=$_POST['content'];
$src=$_POST['src'];
$name=$_POST['name'];
$taskid=$_POST['taskid'];
$projectid=$_POST['projectid'];

if($no=='AddNewComment')
{
$q="INSERT INTO sub_task(tid,pid,comment_from,comment)
           VALUES('$taskid','$projectid','$name','$content')";

$sql=mysqli_query($connect,$q);

if($sql)
{
  echo "1";
}
else{
  echo "0";
 }
} 
else if($no=='reply'){
            $CommentId=$_POST['commentid'];
            if(mysqli_query($connect,"INSERT INTO sub_task(tid,pid,comment_from,comment,type,p_cid)
                                      VALUES('$taskid','$projectid','$name','$content','1','$CommentId')"))  
            {
              echo "1";
            }
            else{
              echo "0";
            }
  }