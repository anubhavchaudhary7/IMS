<?php
session_start();
if (!isset($_SESSION['aid']) && !isset($_SESSION['login-token']))
{
   header("Location: AdminLogin.php");
   alert("Please Login To see the content !");
   session_destroy();
   exit();
}
$id=$_GET['q'];

include "../ConfigFiles/database.php";
include "../ConfigFiles/config.php";

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

<?php
 $user="SELECT name FROM user_details WHERE uid='$id'";

 $sql=mysqli_fetch_assoc(mysqli_query($connect,$user));

?>
 <div class="container-fluid" style="background-color:rgba(0,0,0,0.5);margin-bottom:10px;">
  
  <div class="col-md-2">
    <a href="dashboard.php?q=$id"><i class="fa fa-home fa-5x" aria-hidden="true"></i></a>
  </div>

  <div class="text text-success text-center" style="font-size:50px;color:white;width:1100px;  ">
      Project Details
  </div>

 </div>

  <div class="container" style="background-color:rgba(220,220,220,0.9);width:1025px;padding:20px;">
    <div class="form-container">

      <form class="form" action="submitproject.php" method="post" onsubmit="return Check();">

        <input type="hidden" name="uid" value=" <?php echo $uid=$_GET['q']; ?>" />
        <input type="hidden" name="adminid" value=" <?php echo $id; ?>" />
        
        <div class="mainDetails" style="height:640px;">

           <div class="form-group">
            <div class="row">
              <div class="col-md-2">
               <label for="projectname" style="font-size:20px;">Assign To:</label>
              </div>
              <div class="col-md-2">
                <label style="font-size:20px;"><?php echo strtoupper($sql['name']); ?></label> 
             </div>
            </div>
                      
          </div>          

          <div class="form-group">
            <label for="projectname" style="font-size:20px;">Project Name</label>
            <input type="text" class="form-control" name="projectname" placeholder="Enter the Project Name here" />          
          </div>
          <div class="form-group">
            <label for="projectdes" style="font-size:20px;">Project Description</label>
            <textarea class="form-control" name="projectdesc" rows="5" cols="5" placeholder="Enter the Project Description please...."></textarea>
          </div>
          <div class="form-group">
           <label for="projectdeadline" style="font-size:20px;">Project Deadline</label>
           <div class="datediv" style="margin:20px;">
              <div class="row">
                <div class="col-md-4">
                  <label for="startdate" style="font-size:20px;">Start Date</label>
                  <input type="date" class="form-control" id="pstartdate" name="pstartdate" />
                </div>
                 <div class="col-md-4">
                   <label for="enddate" style="font-size:20px;">End Date</label>
                   <input type="date" class="form-control" id="penddate" name="penddate"  />
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
         <div class="col-md-6" style="bottom:30px;left:230px;">
        <button type="submit" class="form-control btn btn-success btn-block">Submit</button>
        </div>
        </div>

        <div class="form-group">
         <div class="col-md-6" style="bottom:30px;left:-80px;margin-top:40px;">
          <a href="dashboard.php" class="btn btn-primary btn-lg" type="button" style="">
            Go Home <i class="fa fa-hand-o-left" aria-hidden="true"></i>
          </a>
        </div>
        </div>


      </form>
    </div>
  </div>
<script type="text/javascript">
	function Check(){
     
     var1=$('#pstartdate').val();
     var2=$('#penddate').val();
     if(var1<var2)
     	{
     		return true;
     	}
     else{
     	alert("Please check the dates again !");

     }
</script>

</body>
</html>