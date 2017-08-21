<?php
  session_start();
  if (!isset($_SESSION['uid']))
{
   header("Location: home.php");
   alert("Login please To see the content !");
   exit();
}
  include "database.php";
  include "config.php";
  $userid=$_SESSION['uid'];
  $projectid=$_POST['project_id'];
  $taskid=$_POST['task_id'];
?>
<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="taskcss.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ca6cf33c22.js"></script>
 </head>
 <body>
    <?php
    
     $a="SELECT * FROM task WHERE pid='$projectid' AND tid='$taskid'";

     $b=mysqli_query($connect,$a);
     
     $result=mysqli_fetch_assoc($b);
   ?>
<input type="hidden" value="<?php echo $taskid;?>" id="hidden_task_id" />
<input type="hidden" value="<?php echo $projectid;?>" id="hidden_project_id" />

  <div class="container-fluid" style="padding-left: 0px; padding-right: 10px;">
     <header>
      <h2>Title :<?php echo $result[t_title];?></h2>
     </header>
      <div class="main-content-of-header">

       <div class="row">
        <div class="col-md-2" style="width: 110px;">
          <label for="deadline" style="font-size:20px;font-family: italic">Deadline:</label>
        </div>
        <div class="col-md-2" style="padding:5px;font-weight: bold">
          <?php echo $result['t_deadline']; ?>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-3" style="width:115px;padding-right:0px;">
             <label>Project Name:</label>
            </div>
            <div class="col-md-4" style="padding-left: 0px;">
             <?php echo $result['p_title']; ?>
            </div>
          </div>
        </div>
        <div class="col-md-2" style="float: right">
          <button class="btn btn-info" type="button" data-toggle="modal" data-target="#taskDetailsButton">
            View Details
          </button>
        </div> 
     </div>

   <!--   End of the row.!  -->
   
      <div class="text text-left">
       <div class="custom-image">
        Comments:
      </div>
     </div>

   <hr>

   <!-- A line before the alll the comments -->

   <!-- Add comment textarea box i.e Allowing the user to add the comment to specific task  -->
   <div class="addcomment">

   <div class="row">
      <div class="col-md-2">
        <img src="https://cdn.pixabay.com/photo/2017/01/06/19/15/soap-bubble-1958650_960_720.jpg" alt="Not available" class="img-response img-thumbnail" style="width:70px;height: 70px" id="imageofthecommentor"/>
        <p style="margin-left: 10px;" id="nameofthecommentor"><?php echo "Umesh";?></p>
      </div>
      <div class="col-md-9">
       <textarea type="text" placeholder="Add a comment:" id="commentofthecommentor" name="taskCommet" class="form-control" style="word-spacing:2px;height: 94px;"></textarea>
      </div>
   </div>

   <div class="row" id="submitcomment">
     <div class="col-md-1 col-md-offset-7" style="margin-right: 15px;">
       <button class="btn btn-default" type="button" name="cancel" id="cancelofthecommentor">Cancel</button>
     </div>
     <div class="col-md-2" >
      <button class="btn btn-info" type="button" name="commentSubmit" id="submitofthecommentor" style="width:115px;height: 34px;">Add Comment</button>
     </div>
   </div>

   </div>
<!--  Add Comment Box ends here! -->

   <hr>
<!-- line after the add comment box-->
  
  <!-- Comment list starts here -->

   <div class="comment-list" id="comment_main_list">  
    <?php
       // command to fetch the details of the comment only where status is equal to the 1;
      $q="SELECT tid,comment,comment_from,pid,cid,created_at,like_count,dislike_count
          FROM sub_task 
          Where pid='$projectid' AND
                tid='$taskid' AND
                comment_status=1 AND
                type=0 
          ORDER BY created_at DESC";

       $sql=mysqli_query($connect,$q);  
       if(mysqli_num_rows($sql)>0)
       {
         while($row=mysqli_fetch_assoc($sql))
         {
            ?>
            <div class="media" style="padding: 10px; margin:4px;">
              <a href="#" class="pull-left">
                <img alt="Bootstrap Media Preview" src="http://lorempixel.com/64/64/" class="media-object img-thumbnail img-response" />
               <p style="margin-left: 10px;" id="name"><?php echo $row['comment_from']; ?></p>
              </a>
                 <div class="media-body" style="border:1px solid black;padding:3px; margin:3px;height:70px;overflow-y:auto;font-size: 15px;">
                     <?php echo $row['comment']; ?>
                </div>
                <div class="row">
                    
                    <div class="col-md-1" style="width:70px;padding-right: 0px;" >
                      <a href="#" data-href="<?php echo $row['cid'];?>" class="like">
                         <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                           Like <div id="like_div<?php echo $row[cid];?>" class="choice pull-right">
                                 <?php if($row['like_count']!=0)
                                        {
                                          echo $row['like_count'];
                                         }
                                  ?>
                                </div>
                      </a>
                    </div>
                    <div class="col-md-1" style="width:95px;padding-right: 0px;">
                       <a href="#" data-href="<?php echo $row['cid'];?>" class="dislike">
                          <i class="fa fa-thumbs-down" aria-hidden="true"></i> 
                             Dislike <div class="choice pull-right" id="dislike_div<?php echo $row[cid];?>" style="width:15px;">
                                     <?php if($row['dislike_count']!=0)
                                         {
                                           echo $row['dislike_count'];
                                         }
                                      ?>
                                     </div>
                      </a>
                    </div>
                  <div class="col-md-2" style="width:90px;" >
                    <a href="#" data-href="<?php echo $row['cid'];?>" class="reply">
                       <i class="fa fa-reply" aria-hidden="true"></i>
                         reply
                    </a>
                  </div>
                   
                  <div class="col-md-2 col-md-offset-5" style="padding-left: 50px;margin-left: 300px;">
                    <a href="#" data-href="<?php echo $row['cid'];?>" class="delete">
                      Delete 
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                  </div>
                  </div>
                  
                  <!--threads start from here -->
                 <div class="reply-box" id="replyhere" style="width:650px;margin-left:90px;margin-right: 20px;">
                    
                  </div>
            </div>
           <?php
         }
       }
       else{
         ?>
         <div class="error">
            No Previous Comments
         </div>
         <?php
       }
       ?>

   </div>
 
 <!-- Comment  list ends here --> 

<!-- footer start here -->

   <footer>
   <div class="row" style="padding-right:30px;">
    <button class="btn btn-success btn-lg" type="button" id="backToProjects" style="float: right;width: 104px;height: 42px">
     <i class="fa fa-arrow-circle-left" aria-hidden="true" ></i> Back</button>
   </div>
 </footer>
 <!-- footer ends here  -->

 <!-- modal for the reply comment box -->

  <div class="modal fade" id="CommentSectionForTheReply" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <!-- <form class="form" action="" method="" enctype="" id="formForTheCommet"> -->
             <div class="modal-header">
                
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                 ×
               </button>
               <h4 class="modal-title" id="myModalLabel">
                <label for="Title">Comment:</label><br>
               </h4>
             </div>
             <div class="modal-body">
                <div class="row">
                  <div class="col-md-2">
                    <img src="https://cdn.pixabay.com/photo/2017/01/06/19/15/soap-bubble-1958650_960_720.jpg" alt="Not available" class="img-response img-thumbnail" style="width:70px;height: 70px" id="Modalimage"/>
                    <p style="margin-left: 10px;" id="Modalname">
                      <?php echo "Umesh";?>
                    </p>
                  </div>
                  <div class="col-md-9">
                   <textarea type="text" placeholder="Add a comment:" id="Modalcomment" name="ModalCommet" class="form-control" style="word-spacing:2px;height: 94px;"></textarea>
                  </div>
               </div>
             </div>
             <div class="modal-footer">
               <div class="row" id="submitModalcomment">
                 <div class="col-md-1 col-md-offset-7" style="margin-right: 15px;">
                   <button class="btn btn-default" type="button" name="cancel" id="cancelforCommentModal"  data-dismiss="modal" aria-label="Close">
                     Cancel
                   </button>
                 </div>
                 <div class="col-md-2" >
                  <button class="btn btn-info" type="button" name="commentModal" id="submitModal" style="width:80.156px;height: 34px;margin-left: 10px;">Submit</button>
                 </div>
              </div>
             </div>
           <!--   </form> -->
           </div>
        </div>
      </div>

<!-- reply comment box ends here -->


    <!-- Task Details modal start here.!! -->

    <div class="modal fade" id="taskDetailsButton" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
               
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
              </button>
              <h4 class="modal-title" id="myModalLabel">
               <label for="Title">Title</label><br>
                <?php echo $result['t_title']; ?>
              </h4>
            </div>
            <div class="modal-body">
            <label for="desc">Description</label><br>
             <?php echo $result['t_description']; ?>
            </div>
            <div class="modal-footer">
              <div class="row">
               <div class="col-md-2" style="text-align: left;width:105px;">
                 <label>Start Date:</label>
              </div>
              <div class="col-md-3" style="text-align: left">
                 <?php echo $result['t_start']; ?>
              </div>
              <div class="col-md-2" style="text-align: left">
               <label> End Date:</label>
              </div>
              <div class="col-md-3" style="text-align: left">
                  <?php echo $result['t_deadline']; ?>
              </div>
              </div>
              <button type="button" class="btn btn-info" data-dismiss="modal">
                Close
              </button> 
            </div>
          </div>
        </div>  
      </div>

  <!-- Modal code ends here  -->


 </div>

 <!-- Main div Container closes -->

<!-- Javascript start here -->

  <script type="text/javascript">

    $(document).ready(function(){
      
       var t_id=$("#hidden_task_id").val();
       var p_id=$("#hidden_project_id").val();
       var datatest="T_id="+t_id+"&P_id="+p_id;
        
      $('.like').click(function(){
        var temp_string=$(this).attr('data-href');
        var str="like";
        var datastore="projectid="+<?php echo $projectid; ?>+"&taskid="+<?php echo $taskid; ?>+"&commentid="+temp_string+"&prop="+str;
           $.ajax({
           url: 'updated.php',
           type: 'post',
           cache: false,
           data: datastore,
           success: function(result){
            if(result!='0')
            {
            alert("You liked the comment!");
            $("#like_div"+temp_string).html(result);
            }
            }
           });
        return false;
      });
      $('.dislike').click(function(){
        var temp_string=$(this).attr('data-href');
        var str="dislike";
        var datastore="projectid="+<?php echo $projectid; ?>+"&taskid="+<?php echo $taskid; ?>+"&commentid="+temp_string+"&prop="+str;
           $.ajax({
           url: 'updated.php',
           type: 'post',
           cache: false,
           data: datastore,
           success: function(result){
            if(result!='0')
            {
            alert("You Disliked the comment!");
            $("#dislike_div"+temp_string).html(result);
            }
            }
           });
        return false;
      });

      $('.reply').click(function(){
         var temp_string=$(this).attr('data-href');
         $("#CommentSectionForTheReply").modal('show');
         $('#submitModal').click(function(){
      
        var imageOfModal=$('#Modalimage').attr('src');
        var modalname=$('#Modalname').val();
        var text=$('#Modalcomment').val();
        var datatest_1="src="+imageOfModal+"&name="+modalname+"&content="+text+"&taskid"+<?php echo $taskid;?>+"&projectid"+<?php echo $projectid;?>+"&commentid"+temp_string+"&prop="+"reply";
        if(text !=='')
        {
          $.ajax({
           url: "mediaTemplate.php",
           type:'post',
           data: datatest_1,
           cache:false,
           success:function(response){
            if(response==1)
            {
             /*$.ajax({
              url:'comment.php',
              type:'get',
              data: datatest,
              cache: false,
              datatype:'html',
              success:function(result){
               $('#comment_main_list').html(result);
              }
             });*/
             alert("Successfully added the comment!");
            

            }
            else if(response==0){
             alert("Error in Submitting the Comment.\n Please try After Sometime");
            
            }
           }
           });
        }
      });
           return false;
      });

      $('.delete').click(function(){
        var temp_string=$(this).attr('data-href');
        $.ajax({ 
        url: "deleteComment.php",
        type: "post",
        data: {'commentid':temp_string},
        cache: false,
        success:function(response){
          if(response==1)
          { 
            $.ajax({
              url:'comment.php',
              type:'get',
              data:datatest,
              cache: false,
              datatype:'html',
              success:function(result){
               $('#comment_main_list').html(result);
             }
            });
            alert("Comment Deleted Successfully!");
            return false;
          }
          else if(response==0)
           {
             alert("Cannot connect to the database.");
             return false;
           }
        }
       });
      });

      $('#submitcomment').hide();

      $('#commentofthecommentor').focus(function(){
        $('#submitcomment').show(); 
       });

      $("#cancelofthecommentor").click(function(){
        $("#submitcomment").hide();
      });

      $('#submitofthecommentor').click(function(){
       var val = $("#commentofthecommentor").val();
       var imagesrc=$('#imageofthecommentor').attr('src');
       var imagename=$('#nameofthecommentor').val();
       var purpose="AddNewComment";
       var datastring="content="+val+"&src="+imagesrc+"&name="+imagename+"&taskid="+t_id+"&projectid="+p_id+"&prop="+purpose;
      console.log(datastring);
       if(val !== '') {
         $.ajax({
         url:"mediaTemplate.php",
         type:"post",
         data:datastring,
         cache:false,
         success:function(response){
          if(response==1)
            {
              alert("Successfully Added the comment !");
              
              $.ajax({
              url:'comment.php',
              type:'get',
              data: datatest,
              cache: false,
              datatype:'html',
              success:function(result){
               $('#comment_main_list').html(result);
               $("#commentofthecommentor").val("");
               $("#submitcomment").hide();
              }
             });
            }
            else if(response==0){
             alert("Error in Submitting the Comment.\n Please try After Sometime");
            }
         }
        });
       }
       else
          {
            $("textarea").focus().text("Enter comment first!").css("color","green");
          }
        });
  
   /*  $('#cancelforCommentModal').click(function(){
        
     });
    */
});

  </script>
 </body>
 </html>