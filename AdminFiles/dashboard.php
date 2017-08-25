<?php
session_start();
if(!isset($_SESSION['aid']) || !isset($_SESSION['login_token']))
{
 //  alert("Please Login To see the content !");
   session_destroy();
   header("Location: AdminLogin.php");
   exit();
}
    include "../ConfigFiles/config.php";
    include "../ConfigFiles/database.php";
    $aid=$_SESSION['aid'];
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
</head>

<body>

   <!-- navigation bar -->   
     <?php include "navbar.php"; ?>
   <!-- navigation ends here -->

  <div class="container">
    
    <div class="navigation-menu" style="position: fixed;left:10px;top:60px;width:200px;background-color:yellow;height:300px">
	      <button class="btn btn-primary" type="button" style="margin:30px;width: 130px;" data-toggle="modal" data-target="#form1">
	          Add Intern
	      </button>
    </div>


     <div class="modal fade" id="form1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <form classs="form form-control" action="confirm.php" method="post" name="addinternform">
		<div class="modal-dialog">
	    	<div class="modal-content">
				<div class="modal-header" style="background-color:rgba(32,178,170,0.4)">					 
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						×
					</button>
					<h4 class="modal-title" id="myModalLabel">
					   <div class="text text-center" style="font-size:20px;">Add New Intern</div>
					</h4>
				</div>
				
				<div class="modal-body" style="background-color:rgba(128,128,128,0.2);">

				
       
					<div class="form-group">
						 
						<label for="emailaddress">
							Email address
						</label>
						<input type="email" class="form-control" name="email" id="exampleInputEmail1" required />
					</div>
			
					<div class="form-group">
	                 <label for="usertype">User Type</label>
	                   <select class="form-control" name="selecttype">
						  <option value="0">Intern</option>
						  <option value="1">Admin</option>
						  <option value="2">Others</option>
					    </select>
	                </div>

	                <div class="form-group">
						<label for="Categorytype">
							Category
						</label>
						<select class="form-control" name="selectCategory">
						  <option value="0">Select Category</option>
						  <option value="1">Web Design</option>
						  <option value="2">Graphics Design</option>
						  <option value="3">Teaching</option>
						  <option value="4">Others</option>
					    </select>
					</div>

					<div class="form-group">
						 
						<label for="dateofjoining">
				           Date of Joining
						</label>
						<input type="date" id="dateofjoining" name="details" required />
					</div>
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
		</div>

    <div class="content" style="left:100px;margin-left:100px;top:60px;margin-top:60px;">
     
       <div class="row" style="width:1100px;">
            <div class="col-md-12">
                <div class="text text-center" style="font-size:40px;font-style: bold;font-family: serif;">
                 Dashboard
                </div>
            </div>
        </div>

        <div class="table-content" style="width:1080px;margin-left:100px;">
            <div class="text text-success" style="margin-left: 30px;font-size:30px;">
               <div class="row">
                 <div class="col-md-10">
	               <ul class="nav nav-tabs">
	                 <li class="active"><a href="#activeintern" data-toggle="tab">Active</a></li>
	                <li><a href="#archive" data-toggle="tab">Archive</a></li>
	               </ul>
	             </div>
	             <div class="col-md-2" style="margin-top:20px;padding-left:0px;">
                  <select name="order" class="form-control">
                      <option value="0">Sort By:</option>
                      <option value="1">Latest</option>
                      <option value="2">Date</option>
                      <option value="3">Name</option>
                      <option value="4">Project</option>
                  </select>
 	             </div>
	           </div>
            </div>

            <div class="tab-content">

            <div class="inner-table tab-pane fade in active" style="margin:30px;" id="activeintern">
                <table class="table table-striped table-hover table-condensed table-bordered">
				   <thead>
					<tr>
						<th>
						  S.NO
						</th>
						<th>
						   Name
						</th>
						<th>
						   Email
						</th>
						<th>
						   Category
						</th>
						<th>
					    	Status
						</th>
						<th>Action</th>
						<th class="col-span-2">
						</th>

					</tr>
				</thead>
				<?php
                    
                 $q1="SELECT user.uid,name,email,category,status
                      FROM user 
                      INNER JOIN user_details ON user.uid=user_details.uid 
                      WHERE status=1 AND type=0 OR type=2";

                   $category=['Web Design','Graphics Design','Teaching','others'];
                   $status=['Deactivated','Active'];
                   $sql1=mysqli_query($connect,$q1);
                  
			      if($sql1)
			      { 
			      	$number=1;
				    while($row=mysqli_fetch_assoc($sql1))
				   {

					?>
				  <tbody>
				 
					<tr>
						<td>
						  <?php echo $number; ?>
						</td>
						<td>
							<?php echo $row['name']; ?>
						</td>
						<td>
							<?php echo $row['email']; ?>
						</td>
						<td>
						  <?php echo $category[$row['category']]; ?>
						</td>
						<td>
						<?php echo $status[$row['status']]; ?>
						</td>
						<td>
                         <a href="profile.php?q=<?php echo $row['uid']; ?>" data-href="<?php echo $row[uid]; ?>" class="profile">
                           View Details
                         </a>		
						</td>
						<td>
						  <div class="col-md-12">
			                <div class="btn-group">
				 
								<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Action <span class="caret"></span>
								</button> 
							<ul class="dropdown-menu">
								<li>
								  <a href="registerProject.php?q=<?php echo $row['uid']; ?>" data-href="<?php echo $row['uid'];?>" class="registerProject">
								      Register Project
								  </a>
								</li>
								<li class="divider">
								</li>
								<li>
								   <a href="registerTask.php?q=<?php echo $row['uid']; ?>" class="registerTask" data-href="<?php echo $row[uid]; ?>">
								       Register Task
								    </a>
								</li>
							</ul>
						</div>
				    	</div>

						</td>
					</tr>
				</tbody>
				 <?php
				  $number=$number+1;
                         }
                     }
                   else{
                       	?>
                       	<tbody>
							  <tr>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
							   </tr>
						     </tbody>
						     <?php
                         }
                  ?>
			</table>
		  </div>

		  <div class="tab-pane fade in" id="archive" style="margin:30px;">
		    <table class="table table-striped table-hover table-condensed table-bordered">
				   <thead>
					<tr>
						<th>
						  S.NO
						</th>
						<th>
						   Name
						</th>
						<th>
						   Email
						</th>
						<th>
						   Category
						</th>
						<th>
							Status
						</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php
                
				   $q1="SELECT user.uid,name,email,category,status,type FROM user 
				        INNER JOIN user_details ON user.uid=user_details.uid 
				        WHERE status=0 AND type=0 OR type=2";
				                    
                  $category=['Web Design','Graphics Design','Teaching','others'];
                  $status=["Deactivated","Active"];
                  $sql1=mysqli_query($connect,$q1);
			      if($sql1)
			      { 
			      	$number=1;
				    while($row=mysqli_fetch_assoc($sql1))
				   {

					?>
				  <tbody>
				 
					<tr>
						<td>
						  <?php echo $number; ?>
						</td>
						<td>
							<?php echo $row['name']; ?>
						</td>
						<td>
							<?php echo $row['email']; ?>
						</td>
						<td>
						  <?php echo $category[$row['category']]; ?>
						</td>
						<td>
						<?php echo $status[$row['status']]; ?>
						</td>
						<td>
						 <a href="profile.php?q=<?php echo $row['uid'];?>" data-href="<?php echo $row[uid]; ?>" class="profile">
						   View Details
						 </a>
						</td>
					</tr>
				</tbody>
				 <?php
				  $number=$number+1;
                         }
                     }
                   else{
                       	?>
                       	<tbody>
							  <tr>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
								<td><?php echo "NULL"; ?></td>
							   </tr>
						     </tbody>
						     <?php
                         }
                  ?>
			</table>
		  </div>
	   </div>
     </div>
   <div class="projectRegsiterForm" id="projectForm" style="margin-left:30px;width:1025px;">
   

   </div>
  </div>
 </div>
	
	<script type="text/javascript">
	 
	/* $(document).ready(function(){

	  $('.registerProject').click(function(){
	  	 var id=$(this).attr('data-href');
	  	 console.log("The value of the data-href is :"+id);
	      console.log(<?php// echo ADMIN_WEB_URL;?>+"registerProject.php?q="+id);
	     return false;
	  });

	  $('.registerTask').click(function(){
	  	 var id=$(this).attr('data-href');
	  	 console.log("The value of the data-href is :"+id);
	      console.log(<?php //echo ADMIN_WEB_URL;?>+"registerTask.php?q="+id);
	     return false;
	  });
	 });*/
	</script>
	<!-- /*function ShowDetails(str)
	{
	  var temp=str.split(',');
	  console.log(temp[0]);
	  console.log(temp[1]);
	  if(temp[1]==0)
	  {
	  	document.getElementById("projectForm").innerHTML = "";
        return;
	  }
	  else if(temp[1]==1){
            
		  	if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Micros	oft.XMLHTTP");
	        }

	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("projectForm").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","profile.php?q="+temp[0],true);
	        xmlhttp.send();
          }
      else if(temp[1]==2)
	     {
		  	if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }

	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("projectForm").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","projectRegister.php?q="+temp[0],true);
	        xmlhttp.send();
	     }
	    else if(temp[1]==3)
	    {
	      if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }

	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("projectForm").innerHTML = this.responseText;
	            
	            }
	        };
	        xmlhttp.open("GET","subtask.php?q="+temp[0],true);
	        xmlhttp.send();
	    }
	}*/
 -->

</body>
</html>