<?php
 session_start();
 function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION['login_token']=$randomString;
    return $randomString;
  }
  
?>
<html>
<head>

  <meta charset="utf-8">
  <meta name="description" content="Intern Management Platform">
  <meta name="keywords" content="Html,css,JavaScript,xml">
  <meta name="author" content="Umesh Kumar">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>Intern Management System</title>	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../Custom_Bootstrap/Css/style.css">
 <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
<script>
 	$(document).ready(function(){
   
     $('#clickme').click(function(){
   
      $('html,body').animate({
      scrollTop: $("#formforintern").offset().top
      },'slow');
     });
     
  });
 </script>
 </head>

 <body>

<!-- header of the page begins here -->

 <div class="header parallax" style="background-image:url('../Images/pic1.jpeg');">
    <div class="row">
       <div class="col-md-10 col-md-offset-2" id="title">
         Intern Management System
       </div>
    </div>
    <div class="row">
        <div class="col-md-6  col-md-offset-5" id="intern">
            <button type="button" class="btn btn-primary btn-lg" id="clickme" style="width:134px;">
                 Login
                <span><i class="fa fa-angle-double-down" aria-hidden="true"></i></span>
            </button>
        </div>
    </div>
 </div>

 <!-- end of the header part -->

 <div id="formforintern">

 <div class="row">

   <div class="col-md-8 col-md-offset-2" style="background-color:white;margin-top: 30px;padding-bottom:10px;border-style: inset">
        <div class="text text-danger">     
          Enter Your Credentials
        </div>
     <!-- Form start here  -->

    <form class="form" action="auth.php" method="post">

      <input type="hidden" name="token" value="<?php echo generateRandomString(); ?>" />

        <div class="row">
            <div class="col-md-2" style="text-align: right">
                <label for="category" >Email:</label>
            </div>
            <div class="col-md-6">
                <div class="input-group">
				    <span class="input-group-addon">
				    	<i class="fa fa-envelope" aria-hidden="true"></i>
				    </span>
                <input class="form-control" type="mail" name="email" placeholder="Enter email">
                </div>
            </div>
        </div>
       
        <div class="row" style="margin-top: 20px;">
	            <div class="col-md-2" style="text-align: right">
	                <label for="Password">Password:</label>
	            </div>
	            <div class=col-md-6>
				    <div class="input-group">
				        <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
				        </span>
				        <input type="password" name="pass" class="form-control" placeholder="Enter your password">
				    </div>
	            </div>
	        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-6 col-md-offset-2">
			         <button type="submit" class="btn btn-success btn-lg" style="width:134px;">
                 Log In
               </button>
            </div>
        </div>

      </form>
      <!-- form ends here -->
    </div>
  </div>
</div>

<!-- end of the second section of the page i.e login part of the admin -->


<div id="aboutus" style="background-image: url('../Images/about.png');">
  <div class="text text-center">
    About Us
  </div>
  <div class="about-content">
     <div class=row>
        <div class=col-md-3>
           <img src="../Images/image.jpg" alt="Image not Found" class="img-circle img-responsive" style="width:300px;height:300px;"> 
        </div>
        <div class="col-md-6" style="padding-top: 50px">
             <p style="color:white">Hello Friends!.<br>
                This site is about our web projects . we are going to start a internship program soon.
             </p>
             <br><br>
              <p>
                Basically, We work with web technologies like - Wordpress, PHP, Web Design, WAMP Server, Linux, Android Application Development, Facebook Apps, Google Developers Integrations, Photoshop and much more .
            </p>
        </div>
     </div> 
  </div>
</div>
<!-- end of the about us page -->
</body>

</html>
