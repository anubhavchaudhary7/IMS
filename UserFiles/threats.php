           
           <?php
                     $a="SELECT * FROM sub_task INNER JOIN threads ON sub_task.cid=threads.cid WHERE sub_task.cid='$row[cid]' AND thread_status=1";

                     $b=mysqli_query($connect,$a);
                     
                     $c=mysqli_fetch_assoc($c);
                     
                     if(mysqli_num_rows($b)>0)
                     {?>
                      <a href="sub_comment,<?php echo $c['cid'] ;?> id="viewSubComments">View Comments</a>
                      <?php
                      while($task=mysqli_fetch_assoc($b))
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
                            <div class="col-md-1" style="width:70px;padding-right: 0px;" id="like,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>">
                              <a href="like,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>" >
                                 <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                   Like
                              </a>
                            </div>
                   
                            <div class="col-md-1" style="width:80px;padding-right: 0px;" id="dislike,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>">
                             <a href="dislike,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>">
                                <i class="fa fa-thumbs-down" aria-hidden="true"></i> 
                                   Dislike
                            </a>
                          </div>

                          <div class="col-md-2" style="width:90px;" id="reply,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>">
                            <a href="reply,<?php echo $row['tid'];?>,<?php echo $row['cid'];?>">
                               <i class="fa fa-reply" aria-hidden="true"></i>
                                 reply
                            </a>
                          </div>

                   
                          <div class="col-md-2 col-md-offset-5" id="delete,<?php echo $taskid;?>" style="padding-left: 50px;margin-left: 325px;">
                            <a href="delete,<?php echo $row['cid'];?>">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>

                      </div>
                  </div>
                   <?php
                      }
                     }
                    ?>