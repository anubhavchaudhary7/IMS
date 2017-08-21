<?php
session_start();
if (!isset($_SESSION['uid']) && !isset($_SESSION['token']))
{
   header("Location: home.php");
   alert("Login please To see the content !");
   session_destroy();
   exit();
}
$id=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/ca6cf33c22.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
             
            $('li').hover(
            function(){
              $(this).css('background-color','rgba(176,224,230,0.6)');
            },
            function(){
            	$(this).css({'background-color':'','opacity':''});

            });
    
          $('#project').click(function(event){
          	event.preventDefault();
            $(".content").load('projects.php');
            });
          $("#logout").click(function(e){
              e.preventDefault();
              $.ajax({ 
                  url: "logout",
                  cache: false,
              });
          });
 
		});


	</script>
	<style type="text/css">
	body{
		background-color: rgb(176,224,230);
	   }
	    .addColor{
	    	background-color:rgba(176,224,230,0.6);
	    }
		.side-nav-bar{
			width:80px;
			height:600px;
			position: fixed;
			margin-left: 0px;
			left:0px;
			top:60px;
			background-color:black;
		}
		.nav-block{
			list-style-type: none;
			padding-left: 0px;
		}
	  .nav-block li{
	  	height:70px;
	  	width:80px;
	  	padding:5px;
	  	padding-left:20px;
	  	padding-bottom:10px;
	  	border-bottom-color: white;
	  	border-bottom-width: 2px;
	  	border-bottom-style: solid;
	  	background-color:rgba(255,255,255,0.3);
	  }

      .nav-block li:hover{
      	border-left-width: 2px;
	  	border-left-style:solid;
	  	border-left-color: yellow;

      }
	  .nav-block li a{
	  	color:#333;
	  }
      
	  .nav-block li a:focus,a:hover{
	  	text-decoration: none;
	  	background-color: none;
	  	
	  }
	  .nav-block p{
	  	color: white;
	  }
	  .side-bar{
	  	position:relative;
       width:100px;
       height: 600px;
       background-color: black;
	  }
	  .content{
	  	position: relative;
        background-color: white;
        height: 100%;
        overflow: auto;
        width:1250px;
        left:80px;
        top:60px;
	  }
	  nav ul li:hover{
     	border-top:2px solid rgba(128,128,128,0.9); 
           }
	</style>
</head>

<body>
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#">User Dashboard</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar-left" role="search" style="margin-left: 60px;">
						<div class="form-group">
							<input type="text" class="form-control" style="width:467px" id="search" name="searchBar" placeholder="Search anything you wish.!!" />
						</div> 
						<button type="submit" class="btn btn-info">
							Submit
						</button>
					</form>
					<ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
					    <li>
					      <div class="col-md-1" style="padding-top: 10px;height: 50px;">
					        <a href="#">
					          <i class="fa fa-bell fa-2x" aria-hidden="true" style="color:#FFD700"></i>
					        </a>
					       </div>
					    </li>
					    <li>
					    <div class="col-md-1" style="padding-top: 10px;height:50px;">
					       <i class="fa fa-commenting-o fa-2x" aria-hidden="true" style="color:blue"></i>
					     </div>
					    </li>
					    <li>
					    <div class="col-md-1" style="padding-top: 10px;height: 50px;">
					       <i class="fa fa-envelope fa-2x" aria-hidden="true" style="color:rgba(250,128,114,1.0);"></i>
					     </div>
					    </li>

						<li>
							<a href="#">Profile</a>
						</li>
						<li class="dropdown">
						   <a  href="logout.php">Logout</a>
						 </li>
							 <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							   Setting<strong class="caret"></strong>
							  </a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
								  
								</li> -->
			    	</ul>
				</div>
				
			</nav>
 
<div class="container-fluid">
 
 <div class="side-nav-bar">
  <ul class="nav-block" id="list">

    <li style="padding-left:18px;padding-top:10px;">
    
    <a href="#" id="collapser">
      <i class="fa fa-align-justify fa-3x" aria-hidden="true"></i>
    </a>
   
   <li>
   <a href="#" id="profile">
    <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>
    <p>Profile</p>
    </a>
   </li>

   <li>
    <a href="#" id="home">
    <i class="fa fa-home fa-3x" aria-hidden="true"></i>
    <p>Home</p>
    </a>
   </li>

   <li>
    <a href="#" id="project">
    <i class="fa fa-code-fork fa-3x" aria-hidden="true"></i>
    <p>Projects</p>
    </a>
   </li>


  <li>
   <a href="#" id="status">
    <i class="fa fa-area-chart fa-3x" aria-hidden="true"></i>
    <p>Status</p>
    </a>
   </li>

  <li>
  <a href="#" id="others">
  <i class="fa fa-random fa-3x" aria-hidden="true"></i>
    <p>Others</p>
   </a>
   </li>
  
  </ul>

 </div>

 <div class="content">
    <h1>Hello umesh</h1>
 </div> 


 </div>

<!-- <?php //include "javascript.php"; ?> -->

</body>
</html>