<?php
session_start();
if (!isset($_SESSION['aid']) && !isset($_SESSION['login_token']))
{
   alert("Please Login To see the content !");
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
}

include "../ConfigFiles/config.php";
include "../ConfigFiles/database.php";

$id=htmlspecialchars($_GET['q']);

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
 
<!-- <script src="bootstrap/js/main.js?q=12e7t187"></script>
 --> <style>
 #close{
    float:right;
    display:inline-block;
    padding:2px 5px;
    background:#ccc;
 }

 .inputCss{
  outline:0px,
  border-bottom-width:2px,
  border-bottom-color:grey,
  border-bottom-style:solid,
  border-left-width:0px,
  border-top-width:0px,
  border-right-width:0px;
 }
 </style>

</head>
<body>
  <?php 
    
    $details="SELECT * FROM projects WHERE pid=''"

  ?>
<!-- <div class="modal fade" id="EditProjectDetails" role="dialog" aria-labelledby="EditProjectDetails" aria-hidden="true">
  <form classs="form form-control" action="UpdateProjectDetails.php" method="PUT" name="UpdateProjectDetails">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:rgba(32,178,170,0.4)">           
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
             ×
            </button>
            <h4 class="modal-title" id="myModalLabel">
               <div class="text text-center" style="font-size:20px;">Edit Project Details</div>
            </h4>
        </div>
        <div class="modal-body" style="background-color:rgba(128,128,128,0.2);">
        </div>
      </div>
    </div>
         
    <div class="modal-footer">     
      <button type="button" class="btn btn-default" data-dismiss="modal">
        Close
      </button> 
      <button type="submit" class="btn btn-primary">
         Add
      </button>
    </div>
  </form>
</div>   -->
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
           <img src="../Images/intern.png" class="img-responsive img-circle" alt="Image not found!">
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
               <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row1['pid'];?>" class="btn btn-primary btn-block">
                 Project Details
              </a>
            </div>
      
            <div class="panel-collapse collapse" id="collapse<?php echo $row1['pid']; ?>">
             
            <div class="panel-body" class="ProjectBody">
          
            <div class="col-md-12" style="font-size:20px;margin:5px;">
                <div class="col-md-offset-11">
                 <?php 
                    if($row1['p_status']==0)
                    {
                      ?>
                      <span class="badge badge-danger">Pending</span>
                      <?php
                    }
                   else if($row1['p_status']==1)
                   {
                    ?>
                      <span class="badge badge-warning">All most completed</span>
                    <?php
                   }
                   else if($row1['p_status']==2)
                   {
                    ?>
                      <span class="badge badge-warning">
                        Completed <i class="fa fa-check" aria-hidden="true" style="color:white"></i>
                      </span>
                    <?php
                   }
                 ?>
                 </div>
            </div>

             
            <div class="col-md-12" style="font-size:20px;margin:5px;">
                <div class="col-md-4">
                   <label for="name">Project Title:</label>
                </div>
                <div class="col-md-7">
                   <input id="ProjectTitle-<?php echo $row1['pid'];?>" class="ProjectDetails-<?php echo $row1['pid']; ?>" readonly="true" value="<?php echo $row1['p_title']; ?>" style="border-style:none" />
                </div>
           </div> 

            <div class="col-md-12" style="font-size:20px;margin:5px;">
                <div class="col-md-4">
                   <label for="name">Project Description:</label>
                </div>
                <div class="col-md-7">

                  <textarea id="ProjectDescription-<?php echo $row1['pid']; ?>" readonly="true" class="ProjectDetails-<?php echo $row1['pid']; ?>" style="border-style:none" cols="50" rows='2'><?php echo $row1['p_description']; ?></textarea>

                </div>
            </div>
             
            <div class="col-md-12" style="font-size:20px;margin:5px">
                <div class="col-md-4">
                   <label for="name">Assigned date:</label>
                </div>
                <div class="col-md-7" >
                  <input readonly="true" style="border-style:none" class="ProjectDetails-<?php echo $row1['pid']; ?>" type="date" id="AssignedDate-<?php echo $row1['pid'];?>" value="<?php echo $row1['p_start']; ?>" />
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;margin:5px">
                <div class="col-md-4">
                   <label for="name">Deadline:</label>
                </div>
                <div class="col-md-7">
                   <input readonly="true" class="ProjectDetails-<?php echo $row1['pid']; ?>" style="border-style:none" type="date" id="EndDate-<?php echo $row1['pid'];?>"  value="<?php echo $row1['p_deadline']; ?>" />
                </div>
            </div> 

            <div class="col-md-12" style="font-size:20px;margin:5px">
                <div class="col-md-4">
                   <label for="name">Remarks:</label>
                </div>
                <div class="col-md-7">
        <textarea id="Remarks-<?php echo $row1['pid'];?>" cols="50" rows="2" class="ProjectDetails-<?php echo $row1['pid']; ?>" readonly="true" style="border-style:none" >
           <?php echo $row1['p_remarks']; ?>
        </textarea>
                </div>
            </div>

            </div>

        <div class="panel-footer"  style="height:60px;">
             <div class="col-md-12">
               <div class="col-md-2 col-md-offset-8 AddSubmitButton-<?php echo $row1['pid'];?>">
               </div>

               <div class="CancelButton-<?php echo $row1['pid'];?> col-md-2">
               </div>
               <div class="col-md-2 EditProjectButton-<?php echo $row1['pid'];?>">
                 <a href="#"  data-href="<?php echo $row1['pid'];?>" class="Edit btn btn-info">Edit</a>
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
                 <a data-toggle="collapse" data-parent="#accordion" href="#col<?php echo $check2['tid']; ?>" class="btn btn-primary btn-block">Sub Task Details</a>
          </div>
          
          <div class="panel-collapse collapse" id="col<?php echo $check2['tid']; ?>">
            <div class="panel-body">

            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-offset-11">
                 <?php 
                    if($check2['t_status']==0)
                    {
                      ?>
                      <span class="badge badge-danger">Pending</span>
                      <?php
                    }
                   else if($check2['t_status']==1)
                   {
                    ?>
                      <span class="badge badge-warning">All most completed</span>
                    <?php
                   }
                   else if($check2['t_status']==2)
                   {
                    ?>
                      <span class="badge badge-warning">
                        Completed <i class="fa fa-check" aria-hidden="true" style="color:white"></i>
                      </span>
                    <?php
                   }
                 ?>
                 </div>
            </div>
           
           <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Title:</label>
                </div>
                <div class="col-md-3" id="status">
                  <input id="TaskTitle-<?php echo $check2['tid'];?>" class="TaskDetails-<?php echo $check2['tid']; ?>" readonly="true" value="<?php echo $check2['t_title']; ?>" style="border-style:none" />
                </div>
            </div> 
            
            <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Description:</label>
                </div>
                <div class="col-md-6">
                 <textarea id="TaskDescription-<?php echo $row1['pid']; ?>" readonly="true" class="TaskDetails-<?php echo $check2['tid']; ?>" style="border-style:none" cols="40" rows='2'><?php echo $check2['t_description']; ?></textarea>
                </div>
            </div> 
             <div class="col-md-12" style="font-size:20px;">
                <div class="col-md-6">
                   <label for="name">Task Deadline:</label>
                </div>
                <div class="col-md-3">
                   <input id="TaskDeadline-<?php echo $check2['tid'];?>" type="date" class="TaskDetails-<?php echo $check2['tid']; ?>" readonly="true" value="<?php echo $check2['t_deadline']; ?>" style="border-style:none" />
                </div>
            </div>
          
            </div>
 
          <div class="panel-footer"  style="height:60px;">
             <div class="col-md-12">
               <div class="col-md-2 col-md-offset-8 AddSubmitButtonTask-<?php echo $check2['tid'];?>">
               </div>

               <div class="CancelButtonTask-<?php echo $check2['tid'];?> col-md-2">
               </div>
               <div class="col-md-2 EditTaskButton-<?php echo $check2['tid'];?>">
                 <a href="#"  data-href="<?php echo $check2['tid'];?>" class="EditTask btn btn-info">Edit</a>
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

                <a type="button" class="btn btn-success" href="registerTask.php?q=<?php echo $id;?>&p=<?php echo $pid; ?>" style="margin:20px"">Click here to assign task</a>
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
                     <a type="button" class="btn btn-success" href="registerProject.php?q=<?php echo $id; ?>">Click here to assign Project</a>
                 </div>
        </div>
     <?php

       }

       ?>
       </div>

<!-- Projects Part ends here -->

<!-- Sub task Start here -->
       <div class="deactivateUser">
       <div class="row">
          <?php
          if($row['status']==1)
           {
            ?>
            <div class="col-md-3 " style="padding-left: 290px; width:505px;padding-right:0px;"  >
              <a href="#"  class="btn btn-danger btn-lg deactivate" data-href="<?php echo $id; ?>" type="button" >
                Deactivate User <i class="fa fa-ban" aria-hidden="true"></i>
             </a>
           </div>
          <?php
        }
        else{
          ?>
            <div class="col-md-3 " style="padding-left: 290px; width:505px;padding-right:0px;"  >
              <a  href="#" class="btn btn-success btn-lg active" data-href="<?php echo $id; ?>" type="button" >
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


$('.Edit').click(function(){
   var id=$(this).attr('data-href');

   $('.EditProjectButton-'+id).empty();

   $('.AddSubmitButton-'+id).html(
   '<button type="button" class="btn btn-success">Update</button>');

   $('.CancelButton-'+id).html(
   '<button type="button" class="btn btn-danger">Cancel</button>');
   
  
   $('.ProjectDetails-'+id).attr('readonly',false);
    $('.ProjectDetails-'+id).css({
                             'outline':'0px',
                         'border-bottom-width':'2px',
                         'border-bottom-color':'grey',
                         'border-bottom-style':'solid',
                         'border-left-width':'0px',
                         'border-top-width':'0px',
                         'border-right-width':'0px'
   });
  
   var PreTitle=$('#ProjectTitle-'+id).val();
   var PreDescription=$('#ProjectDescription-'+id).val();
   var PreAssignedDate=$('#AssignedDate-'+id).val();
   var PreEndDate=$('#EndDate-'+id).val();
   var PreRemarks=$('#Remarks-'+id).val();
  
    $('.AddSubmitButton-'+id).click(function(){

       var NewTitle=$('#ProjectTitle-'+id).val();
       var NewDescription=$('#ProjectDescription-'+id).val();
       var NewAssignedDate=$('#AssignedDate-'+id).val();
       var NewEndDate=$('#EndDate-'+id).val();
       var NewRemarks=$('#Remarks-'+id).val();


      /* var inputs={};
        
       if(NewTitle!=PreTitle)
        {
          inputs["p_title"]=(NewTitle).trim();
          console.log("You are here");
        }
        if(NewDescription!=PreDescription){
          inputs["p_description"]=(NewDescription).trim();
        }
        if(NewAssignedDate!=PreAssignedDate)
        {
          inputs["p_start"]=(NewAssignedDate);
        }
        if(NewEndDate!=PreEndDate)
        {
          inputs["p_deadline"]=(NewEndDate);
        }
        if(NewRemarks!=PreRemarks)
        {
          inputs["p_remarks"]=(NewRemarks).trim();
        }*/

    /*  var newString=JSON.stringify(inputs);
      console.log(newString);*/

      var For="Project";
      var d="string="+For+"&id="+id+"&Title="+NewTitle.trim()+"&Description="+NewDescription.trim()+"&Start="+NewAssignedDate+"&End="+NewEndDate+"&Remarks="+NewRemarks.trim();

      $.ajax({
       url:'update_project_details.php',
       type:'post',
       data:d,
       cache:false,
       success:function(response){
         if(response=='0')
         {
           alert("Updated Successfully");
         }
        else if(response=='1')
        {
         alert('Unable to Update the record');
        }
        else{
          alert(response);
        }
       }
      });

       $('.ProjectDetails-'+id).attr('readonly',true);
       $('.ProjectDetails-'+id).css({
                             'outline':'none',
                             'border-bottom-width':'0px',
                             'border-bottom-color':'none',
                             'border-bottom-style':'none',
                             'border-left-width':'0',
                             'border-top-width':'0',
                             'border-right-width':'0'
        });
      $('.AddSubmitButton-'+id).empty();
      $('.CancelButton-'+id).empty();
       $('.EditProjectButton-'+id).html("<a href='#' data-href="+id+" class='Edit btn btn-info'>Edit</a>");
          console.log("<a href='#' data-href="+id+"class='Edit btn btn-info'>Edit</a>")
       });

       $('.CancelButton-'+id).click(function(){
          $('.ProjectDetails-'+id).attr('readonly',true);
          $('.ProjectDetails-'+id).css({
                             'outline':'none',
                             'border-bottom-width':'0px',
                             'border-bottom-color':'none',
                             'border-bottom-style':'none',
                             'border-left-width':'0',
                             'border-top-width':'0',
                             'border-right-width':'0'
          });
          $('.AddSubmitButton-'+id).empty();
          $('.CancelButton-'+id).empty();
          $('.EditProjectButton-'+id).html("<a href='#' data-href="+id+" class='Edit btn btn-info'>Edit</a>");
          console.log("<a href='#' data-href="+id+"class='Edit btn btn-info'>Edit</a>")
       });

   return false;
});

// Details for the Task to Edit

$('.EditTask').click(function(){
   var id=$(this).attr('data-href');
   $('.EditTaskButton-'+id).empty();

   $('.AddSubmitButtonTask-'+id).html(
   '<button type="button" class="btn btn-success">Update</button>');

   $('.CancelButtonTask-'+id).html(
   '<button type="button" class="btn btn-danger">Cancel</button>');
   
   
   $('.TaskDetails-'+id).attr('readonly',false);
    $('.TaskDetails-'+id).css({
                             'outline':'0px',
                         'border-bottom-width':'2px',
                         'border-bottom-color':'grey',
                         'border-bottom-style':'solid',
                         'border-left-width':'0px',
                         'border-top-width':'0px',
                         'border-right-width':'0px'
   });
  
   var PreTitle=$('#TaskTitle-'+id).val();
   var PreDescription=$('#TaskDescription-'+id).val();
   var PreEndDate=$('#TaskDeadline-'+id).val();
  
    $('.AddSubmitButtonTask-'+id).click(function(){

       var NewTitle=$('#TaskTitle-'+id).val();
       var NewDescription=$('#TaskDescription-'+id).val();
       var NewEndDate=$('#TaskDeadline-'+id).val();

       /*var inputs={};

       if(NewTitle!=PreTitle)
        {
          inputs["t_title"]=(NewTitle);
          console.log("You are here");
        }
        if(NewDescription!=PreDescription){
          inputs["t_description"]=(NewDescription);
        }
        if(NewEndDate!=PreEndDate)
        {
          inputs["p_deadline"]=(NewEndDate);
        }

      var newString=JSON.stringify(inputs);*/
      
      var For="Task";

      var d="string="+For.trim()+"&id="+id+"&Title="+NewTitle.trim()+"&Description="+NewDescription.trim()+"&Deadline="+NewEndDate;

      $.ajax({
       url:'update_project_details.php',
       type:'post',
       data:d,
       cache:false,
       success:function(response){
         if(response=='0')
         {
           alert("Updated Successfully");
         }
        else if(response=='1')
        {
         alert('Unable to Update the record');
        }
        else{
          alert(response);
        }
       }
      });

       $('.TaskDetails-'+id).attr('readonly',true);
       $('.TaskDetails-'+id).css({
                             'outline':'none',
                             'border-bottom-width':'0px',
                             'border-bottom-color':'none',
                             'border-bottom-style':'none',
                             'border-left-width':'0',
                             'border-top-width':'0',
                             'border-right-width':'0'
        });
      $('.AddSubmitButtonTask-'+id).empty();
      $('.CancelButtonTask-'+id).empty();
       $('.EditTaskButton-'+id).html("<a href='#' data-href="+id+" class='EditTask btn btn-info'>Edit</a>");
          console.log("<a href='#' data-href="+id+"class='EditTask btn btn-info'>Edit</a>")
       });

       $('.CancelButtonTask-'+id).click(function(){
          $('.TaskDetails-'+id).attr('readonly',true);
          $('.TaskDetails-'+id).css({
                             'outline':'none',
                             'border-bottom-width':'0px',
                             'border-bottom-color':'none',
                             'border-bottom-style':'none',
                             'border-left-width':'0',
                             'border-top-width':'0',
                             'border-right-width':'0'
          });
          $('.AddSubmitButtonTask-'+id).empty();
          $('.CancelButtonTask-'+id).empty();
          $('.EditTaskButton-'+id).html("<a href='#' data-href="+id+" class='EditTask btn btn-info'>Edit</a>");
          console.log("<a href='#' data-href="+id+"class='EditTask btn btn-info'>Edit</a>")
       });

   return false;
});


  $(".active").click(function(){
    var new_id=$(this).attr('data-href');
    var answer=confirm('Do you want to Activate this user?');
      if(answer){
       <?php
        mysqli_query($connect,"UPDATE user_details SET status='1' WHERE uid=<script type='text/javascript'>new_id</script>");
       ?>
       alert('Activated Successfully');
      }
      else{
        alert("Unable to Activate the user Please try After sometime");
      } 

    return false;
  });

  $(".deactivate").click(function(){
    var new_id=$(this).attr('data-href');
    var answer=confirm('Do you want to De-activate this user?');
      if(answer){
       <?php
        mysqli_query($connect,"UPDATE user_details SET status='0' WHERE uid=<script type='text/javascript'>new_id</script>")
       ?>
       alert('De-activated Successfully');
      }
      else{
        alert("Unable to De-activate the user Please try After sometime");
      }

    return false;
    });
});
</script>

</body>
</html>