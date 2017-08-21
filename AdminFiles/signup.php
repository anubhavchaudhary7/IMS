 <html>
 <head>
   <title>Signup</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="dashboard.css">  -->

 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
</head>
<body>
 <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
     <?php
session_start();
    
include "database.php";
include "config.php";

$email=$_GET['email'];
$code=$_GET['code'];
$token=$_GET['token'];

$sql="SELECT * FROM user WHERE email='$email' AND confirm='$code' AND token='$token'";

$verify=mysqli_query($connect,$sql);
$arr=mysqli_fetch_array($verify);

$user=$arr['uid'];
?>

<?php
  if($verify)
  { 
   Echo "Email Verified !!";
   ?>
 </div>	
  <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					InternManager <small>User Application Form</small>
				</h1>
			</div>
		</div>
	</div>
</div>
<div class="container" style="margin-top: 15px;">
 <p><span style="color: red;">*</span> Fields are mandatory</p>
 <form class="form" action="signuptemplate.php?q=<?php echo $code; ?>&token=<?php echo $token; ?>" method="post" role="form" enctype="multipart/form-data" onsubmit="return checkPassword()"> 

  <input type="hidden" name="myid" value="<?php echo $user;?>" />

   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="name"><span style="color: red;">*</span>Name</label>
            <input type="text" name="name" placeholder="Enter your name" class="form-control" required />
         </div>
       </div>
       <div class="col-md-4">
          <label for="secondary email"><span style="color: red;">*</span>Secondary Email</label>
          <input type="email" name="secondemail" placeholder="e.g ABC@example.com" required class="form-control" />
       </div>
    </div>
    <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="education"><span style="color: red;">*</span>Education Qualification</label>
            <input type="text" name="education" placeholder="Enter your Education Qualification" class="form-control" required />
         </div>
       </div>
       <div class="col-md-4">
          <label for="projects"><span style="color: red;">*</span>Projects Done</label>
          <input type="text" name="project" placeholder="Your Projects" required class="form-control" />
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="address"><span style="color: red;">*</span>Address</label>
            <input type="text" name="address" placeholder="Enter your Home adress" class="form-control" required />
         </div>
       </div>
       <div class="col-md-4">
          <label for="secondary email"><span style="color: red;">*</span>Contact Number</label>
          <input type="number" name="phone" placeholder="e.g 91-XXXXXXXXXX" required class="form-control" />
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="password"><span style="color: red;">*</span>New Password</label>
            <input type="password" name="pass" id="pass1" placeholder="Enter New Password" class="form-control" required />
         </div>
       </div>
       <div class="col-md-4">
          <label for="confirmpass"><span style="color: red;">*</span>Confirm Password</label>
          <input type="password" name="confirmpass" placeholder="Confirm Password" id="pass2" required class="form-control" />
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="macAdress"><span style="color: red;">*</span>Ethernet Mac Address</label>
            <input type="text" name="ethernetadd" placeholder="e.g XX-XX-XX-XX-XX-XX" class="form-control" required />
         </div>
       </div>
       <div class="col-md-4">
          <label for="macAdress"><span style="color: red;">*</span>Wifi Mac Address</label>
          <input type="text" name="wifiadd" placeholder="e.g XX-XX-XX-XX-XX-XX" required class="form-control" />
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
         <div class="form-group">
           <label for="macAdress"><span style="color: red;">*</span>Mobile Mac Address</label>
            <input type="text" name="macadd" placeholder="e.g XX-XX-XX-XX-XX-XX" class="form-control" required />
         </div>
       </div>
    </div>
    <div class="row">
     <div class="col-md-4">
      <div class="form-group">
                 
                <label for="exampleInputFile">
                  Upload Image
                </label>
                <input type="file" id="image" name="imageUpload" required />
                <p class="help-block">
                  Use jpg,png,gif format only!
                </p>
              </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="resume">
            Upload Resume
          </label>
          <input type="file" id="resume" name="resumeUpload" required />
            <p class="help-block">
               Use pdf format only!
            </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <button type="submit" class="btn btn-success btn-lg" >Sign Up</button>
      </div>
    </div> 

</form>
<script type="text/javascript">
 function checkPassword(){
    pass1 = $("#pass1").val();
    pass2 = $("#pass2").val();
   if(pass1 == pass2 && pass1.length>6)
     return true;
   else{
     alert("Password should match and should be greater than 6 characters");
   return false;
  }
}
</script>
</body>
</html>
<?php
}
else{
 echo "database error";
}
?>