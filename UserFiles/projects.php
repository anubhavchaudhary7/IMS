<?php 

if (!isset($_SESSION['uid']))
{
   header("Location: home.php");
    alert("Login please To see the content !");
   exit();
}else{
  session_start();
  $id=$_SESSION['uid'];
  echo "User id is :".$id;  
}
include "database.php";
 include "config.php";
?>
<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
 <style type="text/css">
    .text{
      font-size:40px;
      padding:10px;
    }
    .error{

    width: 650px;
    font-size:30px;
    font-family: italic;
    margin: 10px;
    color:black;

    }
 
#pro ul{

  padding-left: 10px;
}
ul#pro li.active a{
  border-left: 2px solid yellow;
}
#pro ul li { 
  background:#B0E0E6; 
  display: block;
 margin:5px; 
 width:600px;
 height:40px;
 padding:10px;
 border-bottom:1px solid black;
 box-shadow:0 0 2px black;
}
#pro ul li a {
              display:block !important;
              /*text-decoration: none;*/
          } 
#pro ul li a:hover {
              
      text-decoration: none;
          } 
#pro ul li:hover {
    background: #87CEEB;
    text-decoration:none;
    border-bottom:2px solid yellow; 
    font-size:20px;
   }
   .section1{
    margin: 30px;
    width: 850px;
    margin-right:10px;
    background-color: #FFFAFA;
   }
   .section2{
    margin:30px;
    width: 300px;
    height:600px;
    float: right
    margin-left: 10px;
    background-color: #E0FFFF;
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
 
 <div class="container-fluid">
  <div class="row">
   <div class="section1 col-md-8">
   <header>
    <div class="text text-left">
      List Of Projects
     </div>
   </header>
    
   <div class="project-list" id="pro">
    <ul>
     
     <?php
      $u=$id;
     $q1="SELECT p_title,uid,pid,p_status FROM Project WHERE uid='$u'";
     $sql=mysqli_query($connect,$q1);
     $temp=mysqli_fetch_assoc($sql);
     
     if(mysqli_num_rows($sql)>0)
       {
        
         while($row=mysqli_fetch_assoc($sql))
         { 
            ?>
            <div class="row">
            <div class="col-md-9">
            <li>
               <a href="" data-href="<?php echo $row['pid'];?>" class="projectTitle">
                  
                 <?php echo $row['p_title']; ?>
                 
               </a>
            </li>
            </div>
            <div class="col-md-3" style="margin-top: 10px;" id="mark">
            <?php if($row['p_status']==1)
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
             <a href="" data-href="<?php echo $row['pid'];?>" class="markProjectAsComplete">
            <p><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i> Mark As Complete</p>
            </a>
            <?php
          }
          ?>
            </div>
            </div>

           <?php
         }
       }
       else{
         ?>
         <div class="error">
            No Project To list
         </div>
         <?php
       }
       ?>
    </ul>
   </div>


   </div>
   <div class="section2 col-md-4">
   </div>
   </div>
   </div>    
 <!-- </div> -->
<script type="text/javascript">
  $(document).ready(function(){
    
    $('.markProjectAsComplete').click(function(){
      console.log("inside the project panel");
      var temp=$(this).attr('data-href');
      var datastring='projectid='+temp;
        $.ajax({
          url: "checkProjectDone.php",
          type:"get",
          data: datastring,
          cache: false,
          success: function(response){
            if(response==1)
            {
            $('#mark').empty();
            $('#mark').load("htmlTemp.html");
            }else if(response==2){
              alert("Subtask Not done.!");
            }else if(response==3){
              alert("This is not Complete Project. Wait for more Task.!");
             }
          }
        });
     return false;
    });
  
   $('.projectTitle').click(function(){
     var temp=$(this).attr('data-href');
       $(".section1").load("projectDetails.php",{project_id:temp}); 
       return false;
   });

});
</script>
</body>
</html>