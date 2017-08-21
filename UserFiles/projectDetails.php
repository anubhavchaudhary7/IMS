<?php
  if(!isset($_SESSION['uid']))
  { 
    header("Location: home.php");
    alert("Login please To see the content !");
    exit();
  }
  else{
  	session_start();
  	include "database.php";
    include "config.php";
    $parentid=$_POST['project_id'];
    $userid=$_SESSION['uid'];
  }
   
?>
<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
  <style type="text/css">
    
      header{
       background-color:rgba(0,139,139,0.5);
       margin:5px;
       padding:10px;
       width:820px;
       height:150px;
       color:white;
       text-shadow:black;      
      }
      .main-content-of-header{
       width:820px;
       margin:5px;
       padding: 10px;
       background-color: rgb(220,220,220); 
      }
      .text{
        font-size:30px;
      padding:10px;
       }
       #pro2 ul{
  padding-left: 10px;
}
#pro2 ul li a:hover{ 
      text-decoration: none;
          } 

#pro2 ul li { 
  background:#B0E0E6; 
  display: block;
 margin:5px; 
 width:380px;
 height:40px;
 padding:10px;
  font-size:20px!important;
}
#pro2 ul li i{
margin-left:240px;
color:black;
position: fixed;;
}
#pro2 ul li i:hover{
color:#807b7b;
font-size: 25px;
}

#pro2 ul li a {display:block !important;} 
#pro2 ul li:hover {
  background: #87CEEB;
   /* text-decoration: underline;*/
    border-bottom:2px solid yellow; 
    box-shadow: 0 0 2px black;
   
   }
   .section1{
    margin: 30px;
    width: 850px;
    margin-right:5px;
    margin-left: 5px;
    padding-right: 10px;
    padding-left: 10px;
    overflow: auto;
    margin-right:10px;
    background-color: #FFFAFA;
   }
   .section2{
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 10px;
    padding-right: 10px;
    width: 370px;
   }
   #mark a{
    color:black;
    text-decoration: none;
   }
   #mark a:hover,a:focus{
    color:green;
    font-size:15px;
   }
  
  </style>
 </head>
 <body>
   <?php

    
     $a="SELECT * FROM Project INNER JOIN user_details ON Project.uid=user_details.uid WHERE Project.uid='$userid' AND Project.pid=$parentid";

     $b=mysqli_query($connect,$a);
   
      $result=mysqli_fetch_assoc($b);

      $temp=$result['p_assigned_by'];
   
      $c="SELECT name FROM user_details WHERE uid='$temp'";

     $take=mysqli_fetch_assoc(mysqli_query($connect,$c));
   ?>
     <header>
      <h2>Title :<?php echo $result['p_title'];?></h2>
     </header>
     <div class="main-content-of-header">
       <div class="row">
        <div class="col-md-2" style="width: 110px">
          <label for="deadline" style="font-size:20px;font-family: italic">Deadline:</label>
        </div>
        <div class="col-md-2" style="padding:5px;font-weight: bold">
          <?php echo $result[p_deadline];?>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-2" style="width:120px;">
             <label>Assigned By:</label>
            </div>
            <div class="col-md-3" style="padding-left: 0px;">
             <?php echo $take['name']; ?> <label> (Admin)</label>
            </div>
          </div>
        </div>
        <div class="col-md-2" style="float: right">
          <button class="btn btn-info" type="button" data-toggle="modal" data-target="#projectDetailsButton">     View Details
          </button>
        </div> 
     </div>

    
    <div class="modal fade in" id="projectDetailsButton" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
               
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
              </button>
              <h4 class="modal-title" id="myModalLabel">
               <label for="Title">Title</label><br>
                <?php echo $result['p_title']; ?>
              </h4>
            </div>
            <div class="modal-body">
            <label for="desc">Description</label><br>
             <?php echo $result['p_description']; ?>
            </div>
            <div class="modal-footer">
              <div class="row">
               <div class="col-md-2" style="text-align: left;width:105px;">
                <label>Start Date:</label>
              </div>
              <div class="col-md-3" style="text-align: left">
                 <?php echo $result['p_start']; ?>
              </div>
              <div class="col-md-2">
                <label>End Date:</label>
              </div>
              <div class="col-md-3" style="text-align: left">
                  <?php echo $result['p_deadline']; ?>
              </div>
              </div>
              <button type="button" class="btn btn-info" data-dismiss="modal">
                Close
              </button> 
            </div>
          </div>
          
        </div>
        
      </div>
      

      <div class="text text-left">
       <div class="custom-image">
        List Of Task
      </div>
     </div>


   <div class="project-list" id="pro2">
    <ul>
    <?php

       $q="SELECT t_title,Project.pid,tid,t_completed FROM task 
           INNER JOIN Project ON Project.pid=task.pid 
           WHERE Project.pid='$parentid'";
        
       $sql=mysqli_query($connect,$q);
       
       if(mysqli_num_rows($sql)>0)
       {
         while($row=mysqli_fetch_assoc($sql))
         {
            ?>
            <div class="row">
            <div class="col-md-6">
            <li>
               <a href="" data-href="<?php echo $row[tid];?>" class="title" >
                 <?php echo $row['t_title']; ?>
               </a>        
            </li>
            </div>
            <div class="col-md-3" style="margin-top: 10px;" id="markforthetask">
               <?php if($row['t_completed']==1)
             {
               ?>
                <div class="row" id="done">
                  <div class="col-md-1" id="righticon">
                     <i class="fa fa-check-circle fa-2x" aria-hidden="true" style="color:green"></i>
                  </div>
                 <div class="col-md-9" id="donetext" style="margin-top:5px;">Done Successfully</div>
                </div>
               <?php
             }
             else{
              ?>
            <a href="" data-href="<?php echo $row[tid];?>" class="markAsComplete">
            <p><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true" class="font"></i> Mark As Complete</p>
            </a>
            <?php
            }
          ?>
          </div>
            <div class="col-md-2" style="margin-top: 10px;width: 150px;" id="mark">
            <a class="CommentFortheTasks" data-href="<?php echo $row['tid'];?>">
              <p><i class="fa fa-comments fa-2x" aria-hidden="true"></i> Comments</p>
            </a>
            </div>
            </div>
           <?php
         }
       }
       else{
         ?>
         <div class="error">
            No Task To list
         </div>
         <?php
       }
       ?>
    </ul>
   </div>
  <div class="modal fade in" id="commentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:850px;">
          <div class="modal-content">
            <div class="modal-header">
               
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
              </button>
              <h4 class="modal-title" id="myModalLabel">
               <label for="Title">Comments:</label><br>
              </h4>
            </div>
            <div class="modal-body" id="modalbody">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">
                Close
              </button> 
            </div>
          </div>
          
        </div>
        
      </div>
<footer>
   <div class="row" style="padding-right:30px;">
    <button class="btn btn-success btn-lg" type="button" id="backToProjects" style="float: right;width: 104px;height: 42px">
     <i class="fa fa-arrow-circle-left" aria-hidden="true" ></i> Back</button>
   </div>
 </footer>

 </div>

 <script type="text/javascript">
  $(document).ready(function(){
   
   $('.markAsComplete').click(function(event){
      var store=$(this).attr('data-href');
      var datastring='projectid='+<?php echo $parentid;?>+'&taskid='+store;
      $.ajax({
          url: "checkTaskDone.php",
          type:"get",
          data: datastring,
          cache: false,
          success: function(response){
            console.log(p);
            
            if(response==1)
            {
            $('#markforthetask').empty();
            $('#markforthetask').load("htmlTemp.html");
            }
            else{
                alert(response);
             }
          }
        });
    });

   $(".title").click(function(){
      var store=$(this).attr('data-href');
      console.log(store);
      console.log("project id is"+<?php echo $parentid;?>);
      $('.section1').load("taskdetails.php",{project_id:<?php echo $parentid;?>,task_id:store});
      return false;

   });
   $('#backToProjects').click(function(){
    
    $('.section1').empty();
    $('.section1').load("projects.php?q=<?php echo $userid; ?>");    
   });

   $('.CommentFortheTasks').click(function(){
      var task_id=$(this).attr('data-href');
      console.log(task_id);
      var datatest="T_id="+task_id+"&P_id="+<?php echo $parentid; ?>; 
      console.log(datatest);
      $.ajax({
              url:'comment.php',
              type:'get',
              data:datatest,
              cache: false,
              datatype:'html',
              success:function(result){
               $('#modalbody').html(result);
               $('#commentModal').modal('show');
             }
            });
   });

 });
 </script>
 </body>
 </html>