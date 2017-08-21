<?php
 session_start();
 function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION['token']=$randomString;
    return $randomString;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <style type="text/css">
  	#header-text{
      font-size:50px;
      font-style:italic,arial,oblique;
  	}
   
   .form-title-text{
      text-align: center;
      font-size:30px;
      font-style:italic;
   }
   .dividerme{
   	border-left:5px solid black;
   }
   .loginform{
   	padding:50px;
   }
   .SignUpform{
   	padding:50px;
   }
  </style>

</head>
<body>
 
 <div class="container-fluid">
   <header>
    <div class="tex text-center" id="header-text">
      Welcome.!!
    </div>
   </header>
   
   <div class="form-content">
     <div class="row">

       <div class="col-md-5">
         
         <div class="form-title-text">
            Login
         </div>
        
         <div class="loginform">

          <form role="form" class="form" action="userAuth.php" method="POST" id="form1">

            <input type="hidden" name="csrf-token" value="<?php echo generateRandomString(); ?>">
            
           <input type="hidden" name="formid" value="1" />
				<div class="form-group"> 
					<label for="exampleInputEmail1">
						Email address
					</label>

					<input type="email" class="form-control" id="email" name="userEmail" required />
				</div>
				<div class="form-group">
				    <label for="exampleInputPassword1">
						Password
					</label>
					<input type="password" class="form-control" id="password" name="userPass" required />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="rememberMe" id="checkBox" /> Remember me.!
	     			</label>
				</div>
				<div class="g-recaptcha" data-sitekey="6LcODyoUAAAAAFJHDfZEHatnUILhXInM87aeIsiW" style="margin-bottom: 20px;">	
				</div>

				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>

         </div>

       </div>

       <div class="col-md-1" class="dividerme">
       </div>

       <div class="col-md-5">
           <div class="form-title-text">
              Sign Up
           </div>
 
           <div class="SignUpform">
             <form class="form" role="form" action="userAuth.php" method="POST" id="form2">
              <input type="hidden" name="formid" value="2">
               
               <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="NameOfUser" class="form-control" placeholder="Enter Your Name" required>
               </div>

               <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" name="EmailOfUser" class="form-control" placeholder="Enter Your Email" required>
               </div>

               <div class="form-group">
                  <label for="name">Upload Resume</label>
                  <input type="file" name="resumeUpload" />
                  <span class="help-block">
                   only pdf,doc,docx format !
                  </span>
               </div>

               <div class="form-group">
                 <button type="submit" class="btn btn-success">Sign Up</button>
               </div>

             </form>
           </div>
       </div>

     </div>
   </div>

 </div>


</body>
</html>