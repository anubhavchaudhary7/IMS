<?php
    include "database.php";
    include "config.php";

      $taskid=$_GET['T_id'];
      $projectid=$_GET['P_id'];
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