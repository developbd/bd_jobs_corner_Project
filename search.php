<?php
   session_start(); 
   
   include'db_connet.php';
   
   
     //Advertisment Left.............
   
     $Advertisment_quarye_left=" SELECT * FROM advertisment ORDER BY RAND() LIMIT 5 ";
   
     $Advertisment_result_left = mysqli_query($conn,$Advertisment_quarye_left);
   
   
     //Advertisment Right .............
   
     $Advertisment_quarye_right=" SELECT * FROM advertisment ORDER BY RAND() LIMIT 4 ";
   
     $Advertisment_result_right = mysqli_query($conn,$Advertisment_quarye_right);
   
   
      $today = date("Y-m-d ");
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <style>
         .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
         padding-right: 20px!important;
         margin-left: 0px!important;
         padding-left: 20px!important;
      </style>
   </head>
   <body>
      <?php include'menu.php'; ?>
      <?php
         if(isset($_GET['search'])){
         
         $get = $_GET['search'];  
         
         
         if($get) {
         
           //pagination.............
         
           if(isset($_GET['page']) & !empty($_GET['page'])){
           
           $page = $_GET["page"];
         
           } else {
         
           $page = 1;
         
           }
         
         
             // Searchjob.....
           
         
           $per_page = 10;
         
           $start_from = ($page*$per_page)-$per_page;
         
         
           $pagesql  ="SELECT * FROM post_jobs WHERE Name_of_Company like '%$get%' OR Job_Region like '%$get%' OR Job_category like '%$get%' OR Job_Tags like '%$get%' OR Job_Type like '%$get%'  AND App_Deadline_Date >='$today' ";
         
           $pageres  = mysqli_query($conn, $pagesql);
         
           $totalres = mysqli_num_rows($pageres);
         
           $endpage = ceil($totalres / $per_page);
         
           $startpage  = 1;
         
           $snextpage =   $page + 1;
         
           $spreviouspage =  $page - 1;
         
          
         
          $job_read_sql="SELECT * FROM post_jobs  WHERE App_Deadline_Date >= '$today'AND Name_of_Company like '%$get%' OR Job_Region like '%$get%' OR Job_Category like '%$get%' OR Job_Tags like '%$get%' OR Job_Type like '%$get%'   ORDER BY id DESC LIMIT $start_from, $per_page  ";
         
           $job_read_query = mysqli_query($conn,$job_read_sql);
         
         
         ?>
      <section id="job-searcharea">
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                  <div class="searc-box">
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search <?php  echo $get ;?>" name="search" name="search" required="" />
                           <div class="input-group-btn">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true" name=""></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-------------/.col-------------->
            </div>
            <!------row---------->
         </div>
         <!------------container------------>
      </section>
      <!-------job searcharea-------->
      <!-------------page content------------->
      <section id="page-content">
      <div class="container">
      <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-12">
         <div class="left-side-add">
            <div class="well">
               <?php 
                  while($advertisment_row_left = mysqli_fetch_array($Advertisment_result_left)){
                  
                  ?>
               <div class="well">
                  <a href="<?php echo $advertisment_row_left['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row_left['Image']; ?>" alt="add-3"/></a>
               </div>
               <?php    } ?>
            </div>
         </div>
         <!------leftsideadd------>
      </div>
      <!----------col-2------------>
      <!-------- for job-detail---------->
      <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="jobdetail-content">
      <div class="row">
         <div class="col-md-8">
            <div class="description-heading">
               <h4>Every link open in new tab for view description</h4>
            </div>
         </div>
         <div class="col-md-4"></div>
      </div>
      <?php  while ($rows=mysqli_fetch_array($job_read_query)){ ?>
      <div class="company-detail-wrapper">
         <div class="row">
            <div class="col-md-12">
               <div class="company-name">
                  <h5><a href="<?php echo "job_view?id=".$rows['id'] ;?> " target="_blank"> <?php echo $rows['Name_of_Company'] ;?></a></h5>
               </div>
            </div>
            <div class="col-md-12">
               <div class="post-name-title">
                  <?php echo $rows['Job_Title']?></a>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row">
                  <div class="education-text">
                     <div class="col-sm-4">
                        <p>Educational qualifications:</p>
                     </div>
                     <div class="col-sm-8">
                        <p><?php echo $rows['Qualification']?></p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row">
                  <div class="experience-text">
                     <div class="col-sm-4">
                        <p>Job Region:</p>
                     </div>
                     <div class="col-sm-8">
                        <p><?php echo $rows['Job_Region']?></p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                     <div class="job-posted-date">
                        <p>Job posted:  <strong><?php echo$rows['Job_Created_Date']?></strong></p>
                     </div>
                  </div>
                  <div class="col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                     <div class="job-deadline">
                        <p>Job deadline:  <strong><?php echo$rows['App_Deadline_Date']?> </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-----/row----->
      </div>
      <!-----end wrapper--->
      <?php }
         // Show Pagination for Search Job ............
         
         if( $totalres != 0 ){
         
         
         
         ?>
      <nav aria-label="Page navigation">
         <ul class="pagination">
            <?php if($page != $startpage){ ?>
            <li class="page-item">
               <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
               <span aria-hidden="true">&laquo;</span>
               <span class="sr-only">First</span>
               </a>
            </li>
            <?php } ?>
            <?php if($page >= 2){ ?>
            <li class="page-item"><a class="page-link" href="?search=<?php echo $get ?>&&page=<?php echo $spreviouspage ?>"><?php echo $spreviouspage ?></a></li>
            <?php } ?>
            <li class="page-item active"><a class="page-link" href="?search=<?php echo $get ?>&&page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php if($page != $endpage){ ?>
            <li class="page-item"><a class="page-link" href="?search=<?php echo $get ?>&&page=<?php echo $snextpage ?>"><?php echo $snextpage ?></a></li>
            <li class="page-item">
               <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
               <span aria-hidden="true">&raquo;</span>
               <span class="sr-only">Last</span>
               </a>
            </li>
            <?php } ?>
         </ul>
      </nav>
      <?php 
         }else{
         
         echo "No job Found............";
         
         }
         
         
         
            } ?>   
      <?php } else {
         //pagination.............
         
         if(isset($_GET['page']) & !empty($_GET['page'])){
         
         $page = $_GET["page"];
         
         } else {
         
         $page = 1;
         
         }
         
         
         
         
         // for all job
         
         $per_page = 10;
         
         $start_from = ($page*$per_page)-$per_page;
         
         
         $pagesql  ="SELECT * FROM post_jobs  WHERE  App_Deadline_Date  >='$today'";
         
         $pageres  = mysqli_query($conn, $pagesql);
         
         $totalres = mysqli_num_rows($pageres);
         
         $endpage = ceil($totalres / $per_page);
         
         $startpage  = 1;
         
         $nextpage =   $page + 1;
         
         $previouspage =  $page - 1;
         
         
          $_GET['search']=" ";  
         
          $get= ' ';
            
         $job_read_sql="SELECT * FROM post_jobs  WHERE  App_Deadline_Date  >='$today' ORDER BY id DESC LIMIT $start_from, $per_page  ";
         
          $job_read_query = mysqli_query($conn,$job_read_sql);
         
         ?>
      <section id="job-searcharea">
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                  <div class="searc-box">
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search <?php  echo $get ;?>" name="search" required="" />
                           <div class="input-group-btn">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true" name=""></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-------------/.col-------------->
            </div>
            <!------row---------->
         </div>
         <!------------container------------>
      </section>
      <!-------job searcharea-------->
      <!-------------page content------------->
      <section id="page-content">
         <div class="container">
            <div class="row">
               <div class="col-md-2 col-sm-2 col-xs-12">
                  <div class="left-side-add">
                     <div class="well">
                        <?php 
                           while($advertisment_row_left = mysqli_fetch_array($Advertisment_result_left)){
                           
                           ?>
                        <div class="well">
                           <a href="<?php echo $advertisment_row_left['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row_left['Image']; ?>" alt="add-3"/></a>
                        </div>
                        <?php    } ?>
                     </div>
                  </div>
                  <!------leftsideadd------>
               </div>
               <!----------col-2------------>
               <!-------- for job-detail---------->
               <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="jobdetail-content">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="description-heading">
                              <h4>Every link open in new tab for view description</h4>
                           </div>
                        </div>
                        <div class="col-md-4"></div>
                     </div>
                     <?php  while ($rows = mysqli_fetch_array($job_read_query)) { ?>
                     <div class="company-detail-wrapper">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="company-name">
                                 <h5><a href="<?php echo "job_view?id=".$rows['id'] ;?> " target="_blank"> <?php echo $rows['Name_of_Company'] ;?></a></h5>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="post-name-title">
                                 <?php echo $rows['Job_Title']?></a>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="education-text">
                                    <div class="col-sm-4">
                                       <p>Educational qualifications:</p>
                                    </div>
                                    <div class="col-sm-8">
                                       <p><?php echo $rows['Qualification']?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="experience-text">
                                    <div class="col-sm-4">
                                       <p>Job Region:</p>
                                    </div>
                                    <div class="col-sm-8">
                                       <p><?php echo $rows['Job_Region']?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                                    <div class="job-posted-date">
                                       <p>Job posted:  <strong><?php echo$rows['Job_Created_Date']?></strong></p>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                                    <div class="job-deadline">
                                       <p>Job deadline:  <strong><?php echo$rows['App_Deadline_Date']?> </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-----/row----->
                     </div>
                     <!-----end wrapper--->
                     <?php } 
                        // Show Pagination for All Job ............
                        
                        ?>  
                     <nav aria-label="Page navigation">
                        <ul class="pagination">
                           <?php if($page != $startpage){ ?>
                           <li class="page-item">
                              <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">First</span>
                              </a>
                           </li>
                           <?php } ?>
                           <?php if($page >= 2){ ?>
                           <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                           <?php } ?>
                           <li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
                           <?php if($page != $endpage){ ?>
                           <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                           <li class="page-item">
                              <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Last</span>
                              </a>
                           </li>
                           <?php } ?>
                        </ul>
                     </nav>
                     <?php } ?>
                  </div>
                  <!-------- end job ditail content----------->
               </div>
               <!----------col-6------------>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="right-side-add">
                     <div class="well">
                        <?php 
                           while($advertisment_row_right = mysqli_fetch_array($Advertisment_result_right)){
                           
                           ?>
                        <div class="well">
                           <a href="<?php echo $advertisment_row_right['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row_right['Image']; ?>" alt="add-3"/></a>
                        </div>
                        <?php    } ?>
                     </div>
                  </div>
                  <!------leftsideadd------>
               </div>
               <!----------col-3------------>
            </div>
            <!-------row----------->
         </div>
         <!-------end container------------->
      </section>
      <!-----------end page content------------>
      <?php include'footer.php'?>
      <!-- jQuery Version 2.2.4.min.js -->
      <script src="js/jquery-2.2.4.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script type="text/javascript">
         //for scrolltop
         $(window).scroll(function() {
          
            if ($(this).scrollTop() >150) { 
         $('.scrollup').fadeIn();
         } else{
         $('.scrollup').fadeOut();
         }
            
         });
         
         $('.scrollup').click(function (){  
           $("html, body").animate({
         scrollTop: 0
         }, 700);
           return false;
         
         });
         
         
      </script>
   </body>
</html>