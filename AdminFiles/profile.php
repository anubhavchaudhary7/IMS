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

$id=$_GET['q'];

$input=['Web Design','Graphics Design','Teaching','Others'];

$status=['User Deactivated','Active'];
$projectStatus=['Pending','All most Completed','Completed'];

?>

<html>
<head>
   <title>DashBoard</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Custom_Bootstrap/Css/dashboard.css"> 
 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
 
 <script src="bootstrap/js/main.js?q=12e7t187"></script>
 <style>
 #close{
    float:right;
    display:inline-block;
    padding:2px 5px;
    background:#ccc;
 }
 </style>

</head>
<body>   
<?php

// include "navbar.php";

$temp="SELECT * FROM user INNER JOIN user_details ON user.uid=user_details.uid WHERE user_details.uid='$id'";
                           
$check=mysqli_query($connect,$temp);

$projects=mysqli_query($connect,"SELECT * FROM Project INNER JOIN user_details ON Project.uid=user_details.uid WHERE user_details.uid='$id'");

 if(mysqli_num_rows($check)>0)
 {
  while($row=mysqli_fetch_assoc($check))
  {
   ?>
   <div class="container" style="width:1028px;padding:20px;">

   <!-- Personal Details Partition  -->

     <div class="personalDetails" style="margin:20px;padding:20px;">

     <div class="panel panel-primary"> 
       <div class="panel-heading">
          <div class="text text-center" style="font-size:40px">Personal Details</div>
        </div>

       <div class="panel-body">
       <div class="details" style="margin:10px;margin-top:20px;">
       
        <div class="col-md-12" style="font-size:20px;height:150px;">
          <div class="col-md-6">
             <label for="name">Candidate ID:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['uid']; ?>
          </div>
          <div class="col-md-3">
           <img src="Images/intern.png" class="img-responsive img-circle" alt="Image not found!">
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Name:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['name']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Primary Email:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['email']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Secondary Email:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['secondemail']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Education:</label>
          </div>
          <div class="col-md-6">
             <?php echo $row['education']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Projects Done:</label>
          </div>
          <div class="col-md-6">
             <?php echo $row['projects']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Category:</label>
          </div>
          <div class="col-md-3">
             <?php echo $input[$row['category']]; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Residential Address:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['address']; ?>
          </div>
        </div> 

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Contact Number:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['phone']; ?>
          </div>
        </div> 

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Date Of Joining:</label>
          </div>
          <div class="col-md-3">
             <?php echo $row['dateofjoining']; ?>
          </div>
        </div>

         <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Candidate Status:</label>
          </div>
          <div class="col-md-3" id="status">
             <?php echo $status[$row['status']]; ?>
          </div>
        </div> 

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Ethernet Address</label>
          </div>
          <div class="col-md-3" id="status">
             <?php echo $row['ethernetaddress']; ?>
          </div>
        </div>

         <div class="col-md-12" style="font-size:20px;">
           <div class="col-md-6">
             <label for="name">Wifi Addresss:</label>
          </div>
          <div class="col-md-3" id="status">
             <?php echo $row['wifiaddress']; ?>
          </div>
        </div>


         <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Mobile MAC Address</label>
          </div>
          <div class="col-md-3" id="status">
             <?php echo $row['mobileaddress']; ?>
          </div>
        </div>

        <div class="col-md-12" style="font-size:20px;">
          <div class="col-md-6">
             <label for="name">Download Resume</label>
          </div>
          <div class="col-md-3" id="status">
             <?php echo $row['resume']; ?>
          </div>
        </div>

       </div>
      </div>

       <div class="panel-footer" style="height:60px;">
        <div class="col-md-12">
          <div class="col-md-3 col-md-offset-9">
           <button class="btn btn-success" type="button">Edit User Details</button>
          </div>
        </div>
       </div>


     </div>
   </div>
<!-- Personal Details part Overs Here -->

<!-- Project Part start here -->    
    <div class="projectdetails" style="margin:10px;margin-top:20px;">
      <?php
        
      if(mysqli_num_rows($projects)>0)
      {
        ?>
      <div class="accordion" class="panel-group">
        <?php
        while($row1=mysqli_fetch_assoc($projects))
        {
         ?>
           <div class="panel panel-info">

            <div class="panel-heading"> 
               <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row1[pid] ; ?>" class="btn btn-primary btn-block">Project Details</a>
            </div>
      
            <div class="panel-collapse collapse" id="collapse<?php echo $row1[pid]; ?>">
             
            <div class="panel-body">
          
             
            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Project Title:</label>
                </div>
                <div class="col-md-3" id="status">
                   <?php echo $row1['p_title']; ?>
                </div>
            </div> 
            
            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Project Description:</label>
                </div>
                <div class="col-md-6">
                   <?php echo $row1['p_description']; ?>
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Status:</label>
                </div>
                <div class="col-md-3">
                   <?php echo $projectStatus[$row1['p_status']]; ?>
                </div>
            </div>

             

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Assigned date:</label>
                </div>
                <div class="col-md-3" >
                   <?php echo $row1['p_start']; ?>
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Deadline:</label>
                </div>
                <div class="col-md-3">
                   <?php echo $row1['p_deadline']; ?>
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Remarks:</label>
                </div>
                <div class="col-md-6">
                   <?php echo $row1['p_remarks']; ?>
                </div>
            </div>

            </div>
 
          <div class="panel-footer"  style="height:60px;">
             <div class="col-md-12">
              <div class="col-md-3 col-md-offset-9">
               <button class="btn btn-success" type="button">Edit Project Details</button>
              </div>
            </div>
          </div>
  
<!-- task start here  -->
     <div class="taskdetails" style="margin:10px;margin-top:20px;">
        <?php
        $pid=$row1['pid'];
        $task=mysqli_query($connect,"SELECT * FROM task INNER JOIN Project ON task.pid=Project.pid WHERE Project.uid='$id' AND Project.pid='$pid'");
         $task_status=['In Process','Completed'];
          if(mysqli_num_rows($task)>0)
          {
           while($check2=mysqli_fetch_assoc($task))
           {
            ?>
            <div class="panel panel-info">

          <div class="panel-heading">
                 <a data-toggle="collapse" data-parent="#accordion" href="#col<?php echo $check2[tid]; ?>" class="btn btn-primary btn-block">Sub Task Details</a>
          </div>
          
          <div class="panel-collapse collapse" id="col<?php echo $check2[tid]; ?>">
            <div class="panel-body">
           
           <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Title:</label>
                </div>
                <div class="col-md-3" id="status">
                   <?php echo $check2['t_title']; ?>
                </div>
            </div> 
            
            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Description:</label>
                </div>
                <div class="col-md-6">
                   <?php echo $check2['t_description']; ?>
                </div>
            </div> 

          
             <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Deadline:</label>
                </div>
                <div class="col-md-3">
                   <?php echo $check2['t_deadline']; ?>
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Status:</label>
                </div>
                <div class="col-md-3">
                   <?php echo $task_status[$check2['t_completed']]; ?>
                </div>
            </div>
          
            </div>
 
          <div class="panel-footer"  style="height:60px;">
            <div class="col-md-12">
              <div class="col-md-3 col-md-offset-9">
               <button class="btn btn-success" type="button">Edit Task Details</button>
              </div>
            </div>
          </div>


     <!-- comment section need to be implemented later on -->
          <div class="commentsSection" style="margin:20px;padding:20px;">
                 This is the comment section
          </div>
     
     </div>
  </div>
  <!-- end here -->
        <?php
        }
       }
       else{
          ?>
            <div class="jumbotron">
              <div class="text text-danger">
                No Task Assigned Yet.! Under Maintainence.!

                <a type="button" class="btn btn-success" href="registerTask.php?q=$q&p=$p" style="margin:20px"">Click here to assign task</a>
              </div>
            </div>
          <?php
         }
      ?>
     </div> <!-- task end here-->
  
    </div>
  </div>
      <?php
        // while loop closes here
        }
        ?>
      </div><?php
       }
       else{
        ?>
        <div class="panel-body">
             <div class="text text-center" style="font-size:40px">Project Details</div>
                <div class="text text-danger">
                   No Project Assigned Yet.! Under Maintainence.!
                     <a type="button" class="btn btn-success" href="registerProject.php?q=$q">Click here to assign Project</a>
                 </div>
        </div>
     <?php

       }

       ?>
       </div>

<!-- Projects Part ends here -->

<!-- Sub task Start here -->
       <div class="deactivate user">
       <div class="row">
          <?php
          if($row['status']==1)
           {
            ?>
            <div class="col-md-3 " style="padding-left: 290px; width:505px;padding-right:0px;"  >
              <a data-href="<?php echo $id;?>" class="deactivate" type="button" class="btn btn-danger btn-lg">
                Deactivate User <i class="fa fa-ban" aria-hidden="true"></i>
             </a>
           </div>
          <?php
        }
        else{
          ?>
            <div class="col-md-3 " style="padding-left: 290px; width:505px;padding-right:0px;"  >
              <a data-href="<?php echo $id;?>" class="active" type="button" class="btn btn-danger btn-lg">
                Active User <i class="fa fa-ban" aria-hidden="true"></i>
             </a>
           </div>
          <?php

        }
        ?>
          <div class="col-md-1" style="border-left: thick double #ff0000;height:50px;width:35px;"></div>
          <div class="col-md-4" style="padding-left:0px">
            <a href="dashboard.php" type="button" class="btn btn-success btn-lg">
               Go To Home <i class="fa fa-hand-o-left" aria-hidden="true"></i> 
            </a>
          </div>
        </div>

       </div>

    </div>
<?php
  }
 }
 else{
  echo "You are here!";
  print_r($_POST);
 }
?>
<script type="text/javascript">
$(document).ready(function(){

$(".active").click(function(){
  $id=$('a').attr('data-href');
  var answer=confirm('Do you want to deactivate?');
    if(answer){
     <?php
      mysqli_query($connect,"UPDATE user_details SET status='0' WHERE uid=$id")
     ?>
     alert('Deactivated Successfully');
    }
    else{
     e.preventDefault();      
    } 
})


$('#delete').on('click',function(e){
    var answer=confirm('Do you want to deactivate?');
    if(answer){
     alert('Deactivated Successfully');
    }
    else{
     e.preventDefault();      
    }
});
  
});
</script>

</body>
</html>