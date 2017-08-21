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

 $q=$_GET['q'];
?>
<html>
<head>
  <title>
    Project
  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>

</head>
<body style="background-color:rgba(0,139,139,0.9);color:#000">
                <div class="container-fluid" style="background-color:rgba(0,0,0,0.5);margin-bottom:10px;">
                  <div class="col-md-2">
                    <a href="dashboard.php?q=$q"><i class="fa fa-home fa-5x" aria-hidden="true"></i></a>
                  </div>
                  <div class="text text-success" style="font-size:50px;color:white;margin-left:350px;">
                     Task Details For Project
                  </div>

               </div>
 <?php
                
                $temp="SELECT p_title,pid FROM Project INNER JOIN user ON user.uid=Project.uid WHERE user.uid='$q'";
                
                $verify=mysqli_query($connect,$temp);
               
                $res=mysqli_fetch_assoc($verify);
                if(mysqli_num_rows($verify)>0)
                {

                    ?>
                 <div class="container" style="background-color:rgba(220,220,220,0.9);width:1025px;">
                      <div class="form-container">

                       <form class="form" method="post" action="submittask.php" onsubmit="return Checkdate()">

                         <input type="hidden" name="projectId" value="<?php echo $res['pid'];?>" />
                         <input type="hidden" name="userId" value="<?php echo $q; ?>" />
                          
                          <div class="text text-center"><h2>Sub-Task</h2></div>

                             <div class="taskDetails" style="">
                                <div class="form-group">
                                  <label for="projectname" style="font-size:20px;">Select Project</label>
                                    <select id="select name of project" name="projectname" class="form-control">
                                      <option value="0">Select Project Name</option>
                                         <?php
                                           while($row=mysqli_fetch_assoc($verify))
                                             {
                                          ?>
                                        <option value="<?php echo $row['pid']; ?>"><?php echo $row['p_title']; ?></option>
                                     <?php
                                          }
                                      ?>
                             </select>
                            </div>       
 
                             <div class="form-group">
                                <label for="taskname" style="font-size:20px;">Task Name</label>
                                <input type="text" class="form-control" name="taskname" placeholder="Enter the Task Name here" />          
                            </div>

                            <div class="form-group">
                                <label for="projectdes" style="font-size:20px;">Task Description</label>
                                <textarea class="form-control" name="taskdesc" rows="5" cols="5" placeholder="Enter the Project Description please...."></textarea>
                            </div>


                            <div class="form-group">
                             <label for="projectdeadline" style="font-size:20px;">Task Deadline</label>
                             <div class="datediv" style="margin:20px;">
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="startdate" style="font-size:20px;">Start Date</label>
                                    <input type="date" class="form-control" id="tstartdate" name="taskstart" />
                                  </div>
                                   <div class="col-md-4">
                                     <label for="enddate" style="font-size:20px;">End Date</label>
                                     <input type="date" class="form-control" id="tenddate" name="taskend" />
                                  </div>
                               </div>
                             </div>
                          </div>
        
                           <div class="form-group">
                            <label for="projectdes" style="font-size:20px;">Project Remarks</label>
                            <textarea class="form-control" name="remarks" rows="5" cols="5" placeholder="Enter the Project Description please...."></textarea>
                          </div>

                    </div>
        
                           <div class="form-group">
                                     <div class="col-md-6" style="bottom:30px;left:230px;margin-top:30px;">
                                    <button type="submit" id="submitbutton" class="form-control btn btn-success btn-block">
                                       Submit
                                    </button>
                                    </div>
                           </div>

                           <div class="form-group">
                             <div class="col-md-6" style="bottom:30px;left:-80px;margin-top:80px;">
                              <a href="dashboard.php" class="btn btn-primary btn-lg" type="button" style="">
                                Go Home <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                              </a>
                            </div>
                         </div>
                  </form>

              </div>
            </div>
            <?php
                }
               else{
                ?>
                
                <br>
                    <div class="text text-danger">
                       <script type="text/javascript">
                         
                         alert('No task Assign Yet..!');

                       </script>

                       <a href="dashboard.php" class="btn btn-success btn-lg" type="button" style="margin-left:600px;margin-top:50px;">
                         Go Home <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                       </a>

                     </div>
                <?php
               }
              ?>
  <script type="text/javascript">
  function Checkdate(){
     var1=$('#tstartdate').val();
     var2=$('#tenddate').val();
     if(var1<var2)
      {
        return 1;
      }
     else{
      aler("Date should be correct");
      return 0;

     }
  }
</script>  
 

</body>
</html>