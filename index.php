<?php
   session_start(); 
    
   include 'db_connet.php';
   
   
      // User Count
   
      $usql = "SELECT * from  my_profile_reg";
      $uresult = mysqli_query($conn, $usql);
      $usernumber =  mysqli_num_rows($uresult);
      
   
       //Company Count
   
      $company_sql = "SELECT * from  company_profile_reg";
       $company_result = mysqli_query($conn, $company_sql);
       $companycount =  mysqli_num_rows($company_result);
   
       // Job Count
       
       $Total_job="SELECT * from  post_jobs ORDER BY id DESC ";
       $Total_job_quary = mysqli_query($conn, $Total_job);
       $jobnumber =  mysqli_num_rows($Total_job_quary);
          
       // Current job Count
     
       $current_job = 0;
       $today = date("Y-m-d ");


   
       while ($Total_job_row = mysqli_fetch_array($Total_job_quary)) {
   
           
   
           $date = $Total_job_row['App_Deadline_Date'];
   
           if ( $date > $today) {
   
             $current_job ++;
   
             }
       }
   
   
      
   
       
   
     //pagination.............
   
     if(isset($_GET['page']) & !empty($_GET['page'])){
     
     $page = $_GET["page"];
   
     } else {
   
     $page = 1;
   
     }
   
   
     $per_page = 10;
   
     $start_from = ($page*$per_page)-$per_page;
   
     $pagesql  ="SELECT * FROM post_jobs WHERE App_Deadline_Date  >='$today'";
   
     $pageres  = mysqli_query($conn, $pagesql);
   
     $totalres = mysqli_num_rows($pageres);
   
     $endpage = ceil($totalres / $per_page);
   
     $startpage  = 1;
   
     $nextpage =   $page + 1;
   
     $previouspage =  $page - 1;

     
     
   
     $job_read_sql="SELECT * FROM post_jobs WHERE App_Deadline_Date  >='$today'   ORDER BY id DESC   LIMIT $start_from, $per_page ";
   
     $job_read_query = mysqli_query($conn,$job_read_sql);
   
   
   
     //Advertisment.............
   
      $Advertisment_quarye=" SELECT * FROM advertisment ORDER BY RAND() LIMIT 5 ";
   
     $Advertisment_result = mysqli_query($conn,$Advertisment_quarye);
   
      
     //Site Settings.............
   
      $Site_quarye ="SELECT * FROM  site_settings ";
   
      $Site_result = mysqli_query($conn, $Site_quarye);
      
      $site_row   = mysqli_fetch_array($Site_result);
          
       
       
   ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Bdjobscorner</title>

   </head>
   <body>
      <section class="header-top">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xs-4 col-sm-2 col-md-2">
                  <div class="latest">
                     <p>Latest Jobs:</p>
                  </div>
               </div>
               <div class="col-xs-4 col-sm-6 col-md-8">
                  <div class="marque-jobs">
                     <marquee direction = "left" scrolldelay="200" onMouseDown="start" onMouseOver="this.stop"><?php echo $site_row['News'] ; ?></marquee>
                  </div>
               </div>
               <div class="col-xs-4 col-sm-4 col-md-2">
                  <div class="header-top-social-icon">
                     <ul>
                        <li class="faceebook"><a href="https://www.facebook.com/BD-Jobs-Corner-2049117825123715/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li class="twiitter"><a href="https://twitter.com/BDJobsCorner"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li class="youutube"><a href="https://www.youtube.com/channel/UCPJM04z3ODwV5u-T6aiRPNQ?view_as=subscriber"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <!---------/row----------->
         </div>
      </section>
      <!---------end header-top----------->
      <?php include 'menu.php';?>
   
      <section id="banner">
         <div class="banner-overlay">
            <div class="container">
               <div class="row">
                  <div class="col-md-9">
                     <div class="search-area">
                        <h2>Search here for the right job</h2>
                        <div class="search-form">
                           <form class="form-inline" action="search.php" method="GET">
                              <div class="form-group">
                                 <input type="text" class="form-control" id="exampleInputName2" placeholder="Organization Name, Job location, Job Category, Job Type......." name="search" required="">
                              </div>
                              <button type="submit" class="btn btn-default" name="">Search</button>
                           </form>
                        </div>
                     </div>
                     <div class="row">
                        <div class="counterup">
                           <div class="col-md-3 col-sm-4 col-xs-6 ">
                              <div class="count">
                                 <i class="fa fa-users" aria-hidden="true"></i>
                                 <h4>Our users</h4>
                                 <span class="counter"><?php echo $usernumber; ?></span>
                              </div>
                           </div>
                           <!----/col----->
                           <div class="col-md-3 col-sm-4 col-xs-6">
                              <div class="count">
                                 <i class="fa fa-th-list" aria-hidden="true"></i>
                                 <h4>Our Company</h4>
                                 <span class="counter"><?php echo $companycount; ?></span>
                              </div>
                           </div>
                           <!----/col----->
                           <div class="col-md-3 col-sm-4 col-xs-6">
                              <div class="count">
                                 <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                 <h4>Total jobs</h4>
                                 <span class="counter"><?php echo $jobnumber;?></span>
                              </div>
                           </div>
                           <!----/col----->
                           <div class="col-md-3 col-sm-4 col-xs-6">
                              <div class="count">
                                 <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                 <h4>Current jobs</h4>
                                 <span class="counter"><?php echo $current_job ;?></span>
                              </div>
                           </div>
                           <!----/col----->
                        </div>
                     </div>
                     <!----- /.row----->
                  </div>
                  <!----- /.col-md-9---->
                  <?php
                  
                     $Accounting            = "Accounting/Finance";
                     $Bank_Non_Bank         = "Bank/Non-Bank Fin. Institution ";
                     $Commercial            = "Commercial/Supply Chain";
                     $Education_Training    = "Education/Training ";
                     $Engineer              = "Engineer/Architectsn";
                     $Garments              = "Garments/Textile";
                     $Org                   = "HR/Org. Development ";
                     $Design                = "Design/Creative";
                     
                     
                     $Production            = "Production/Operation";
                     $Hospitality           = "Hospitality/ Travel/ Tourism";
                     $Beauty                = "Beauty Care/ Health & Fitness";
                     $Electrician           = "Electrician/ Construction/ Repair";
                     $IT_Telecommunication  = "IT & Telecommunication";
                     $Marketing             = "Marketing/Sales";
                     $Customer              = "Customer Support/Call Centre";
                     $Medical               = "Medical/Pharma";
                     
                     $NGO                   = "NGO/Development";
                     $Research              = "Research/Consultancy";
                     $Secretary             = "Secretary/Receptionist";
                     $Data_Entry            = "Data Entry/ Computer Operator";
                     $Driving               = "Driving/Motor Technician";
                     $Security              = "Security/Support Service";
                     $Law                   = "Law/Legal";
                     $Others                = "Others";
                     
                     $Dhaka = "Dhaka";
                     $Khulna = "Khulna";
                     $Rajshahi = "Rajshahi";
                     $Barishal = "Barishal";
                     $Chittagong = "Chittagong";
                     $Sylhet = "Sylhet";
                     $Rangpur = "Rangpur";
                     
                     $Full_Time_Jobs = "Full Time Jobs";
                     $Part_Time_Jobs = "Part Time Jobs";
                     $What_New = "What's New";
                     $Hot_Jobs = "Hot Jobs";
                     
                     
                     ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="divitional-job-bg">
                        <h3>Divitional Jobs</h3>
                        <ul>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Dhaka >" ?><?php echo $Dhaka ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Khulna >" ?><?php echo $Khulna ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Rajshahi >" ?><?php echo $Rajshahi ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Barishal >" ?><?php echo $Barishal ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Chittagong >" ?><?php echo $Chittagong ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Sylhet >" ?><?php echo $Sylhet ?> </a></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Rangpur >" ?><?php echo $Rangpur ?> </a></li>
                           <li><strong>Hot Links</strong></li>
                           <li><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Full_Time_Jobs >" ?><?php echo $Full_Time_Jobs ?> </a></li>
                           <li><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php  echo "<a href=search?search=$Part_Time_Jobs >" ?><?php echo $Part_Time_Jobs ?></a></li>
                           <li><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php  echo "<a href=search?search=Government >" ?><?php echo "Government Job" ?></a></li>
                           <li><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php  echo "<a href=search?search=Private >" ?><?php echo "Private Job" ?></a></li>
                        </ul>
                     </div>
                  </div>
                  <!----- /.col-md-3----->
               </div>
               <!----- /.row----->
            </div>
            <!----- /.container----->
         </div>
         <!---------end banner-overlay----------->
      </section>
      <!---------end banner----------->
      <!-----for pagecontent ------>
      <section id="alljoblist">
         <div class="container">
            <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="govment-job">
                     <h1>Hot job list</h1>
                     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                         
                 <!-- Wrapper for slides -->
                        
                        <div class="carousel-inner" role="listbox">
                            
                            
                         <div class="item active">
                          <div class="govtjoblist">
                             <ul>
                                 <?php
                                 
                              $sort_job_read_sql="SELECT * FROM post_jobs WHERE App_Deadline_Date  >='$today'    ORDER BY id DESC   LIMIT 4 ";
   
                            $sort_job_read_query = mysqli_query($conn,$sort_job_read_sql); 
                                    
                                    
                                 if (mysqli_num_rows($sort_job_read_query)>0) {
                                     
                                 while( $sort_view_job_details = mysqli_fetch_array($sort_job_read_query)){
                
                                // echo $view_job_details['Job_Title'];
                
                                  ?>
                                 
                                 <div class="item active">
                              <div class="govtjoblist">
                                 <ul>
                                <a href="job_view?id= <?php echo $sort_view_job_details['id'] ; ?>"  target='_blank' > <li>  <i class="fa fa-angle-right"> </i> <strong><?php echo $sort_view_job_details['Job_Title'] ;?></strong><br>  <?php echo $sort_view_job_details['Job_Location'] ;?>  </a></li>
                                   </ul>
                              </div>
                           </div>
                             
                             <?php
             
                                 }
                                 
                             }else{ echo "No job Found............"; }
                                 
                                 ?>
                             
                             </ul>
                          </div>
                       </div>
                            
                            
                          <!-- 
                           <div class="item active">
                              <div class="govtjoblist">
                                 <ul>
                                    <li> <?php  echo "<a href=search?search=$Education_Training >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Education_Training ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Bank_Non_Bank >" ?> <i class="fa fa-angle-right"> </i>  <strong>Education</strong><br> <?php echo $Bank_Non_Bank ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$What_New >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $What_New ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Hot_Jobs >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Hot_Jobs ?> </a></li>
                                 </ul>
                              </div>
                           </div>
                         
                          <div class="item">
                              <div class="govtjoblist">
                                 <ul>
                                    <li> <?php  echo "<a href=search?search=$Education_Training >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Education_Training ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Bank_Non_Bank >" ?> <i class="fa fa-angle-right"> </i>  <strong>Education</strong><br> <?php echo $Bank_Non_Bank ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$What_New >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $What_New ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Hot_Jobs >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Hot_Jobs ?> </a></li>
                                 </ul>
                              </div>
                           </div>
                           <div class="item">
                              <div class="govtjoblist">
                                 <ul>
                                    <li> <?php  echo "<a href=search?search=$Education_Training >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Education_Training ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Bank_Non_Bank >" ?> <i class="fa fa-angle-right"> </i>  <strong>Education</strong><br> <?php echo $Bank_Non_Bank ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$What_New >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $What_New ?> </a></li>
                                    <li> <?php  echo "<a href=search?search=$Hot_Jobs >" ?> <i class="fa fa-angle-right"> </i> <strong>Education</strong><br>  <?php echo $Hot_Jobs ?> </a></li>
                                 </ul>
                              </div>
                           </div>
                           -->
                        </div>
                     </div>
                     <button type="button" class="btn btn-link view-details"><a href="search">View All</a></button>
                  </div>
                  <!----- /.govmentjob----->
               </div>
               <!----- /.col-3----->
               <div class="col-md-9 col-sm-12 col-xs-12">
                  <div class="job-catagori bg-warning">
                     <h1>Job Categori</h1>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="job-catagori-list">
                              <ul>
                                 <li><?php  echo "<a href=search?search=$Accounting > " ?> <i class="fa fa-angle-right"></i> <?php echo $Accounting ?></a></li>
                                 <li><?php  echo "<a href=search?search=$Bank_Non_Bank >" ?> <i class="fa fa-angle-right"></i> <?php echo $Bank_Non_Bank ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Commercial >" ?> <i class="fa fa-angle-right"></i> <?php echo $Commercial ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Education_Training > " ?><i class="fa fa-angle-right"></i> <?php echo $Education_Training ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Engineer > " ?><i class="fa fa-angle-right"></i> <?php echo $Engineer ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Garments > " ?><i class="fa fa-angle-right"></i> <?php echo $Garments ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Org > "  ?><i class="fa fa-angle-right"></i> <?php echo $Org ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Design >" ?><i class="fa fa-angle-right"></i> <?php echo $Design ?>  </a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="job-catagori-list">
                              <ul>
                                 <li><?php  echo "<a href=search?search=$Production > " ?><i class="fa fa-angle-right"></i> <?php echo $Production ?></a></li>
                                 <li><?php  echo "<a href=search?search=$Hospitality > " ?><i class="fa fa-angle-right"></i> <?php echo $Hospitality ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Beauty > " ?><i class="fa fa-angle-right"></i> <?php echo $Beauty ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Electrician > " ?><i class="fa fa-angle-right"></i> <?php echo $Electrician ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$IT_Telecommunication > " ?><i class="fa fa-angle-right"></i> <?php echo $IT_Telecommunication ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Marketing > " ?><i class="fa fa-angle-right"></i> <?php echo $Marketing ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Customer > " ?><i class="fa fa-angle-right"></i> <?php echo $Customer ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Medical > " ?><i class="fa fa-angle-right"></i> <?php echo $Medical ?>  </a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="job-catagori-list">
                              <ul>
                                 <li><?php  echo "<a href=search?search=$NGO > " ?><i class="fa fa-angle-right"></i> <?php echo $NGO ?></a></li>
                                 <li><?php  echo "<a href=search?search=$Research > " ?><i class="fa fa-angle-right"></i> <?php echo $Research ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Secretary > " ?><i class="fa fa-angle-right"></i> <?php echo $Secretary ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Data_Entry > " ?><i class="fa fa-angle-right"></i> <?php echo $Data_Entry ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Driving > " ?><i class="fa fa-angle-right"></i> <?php echo $Driving ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Security > " ?><i class="fa fa-angle-right"></i> <?php echo $Security ?> </a></li>
                                 <li><?php  echo "<a href=search?search=$Law > " ?><i class="fa fa-angle-right"></i> <?php echo $Law ?>  </a></li>
                                 <li><?php  echo "<a href=search?search=$Others > " ?><i class="fa fa-angle-right"></i> <?php echo $Others ?>  </a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <!----- /.row----->
                  </div>
               </div>
               <!----- /.col-9----->
            </div>
            <!----- /.row----->
         </div>
         <!----- /.container----->
      </section>
      <!---------end alljoblist----------->
      <!---------add&section start---------->
      <section id="company-add">
         <div class="container">
            <div class="row">
               <div class="col-md-9">
                  <div class="row bg-warning" >
                     <div class="company-adfd-leftside" >
                        <h2> &nbsp &nbsp  Current Jobs</h2>
                        <?php 
                 if (mysqli_num_rows($job_read_query)>0) {
                 while( $view_job_details = mysqli_fetch_array($job_read_query)){

                  $Main_id =  $view_job_details['Main_id'];

                  $company_sql ="SELECT * FROM  company_profile WHERE Main_id = $Main_id  ";
                  $company_result = mysqli_query($conn,$company_sql);
                  $company_details = mysqli_fetch_array($company_result);

                    $id= $view_job_details['id'];

                              ?>
                        <div class="col-md-6" >
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="company-logo">
                                   
                                 <a href="company_view?com_id=<?php echo $company_details['id'] ?> " target='_blank'>  

                                    <img src="<?php echo "Company_Profile/".$company_details['Company_Photo']; ?>" alt="cl-logo-1"/></a>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="company-heading">
                                    <ul>
                                       <li><?php  echo "<a href='job_view?id=$id' target='_blank' > "; ?><strong><?php echo $view_job_details['Job_Title'];?></strong></a></li>
                                       <li><?php echo $view_job_details['Job_Category'];?></a></li>
                                       <li><?php echo $view_job_details['Job_Location']?></a></li>
                                       <li><?php echo $view_job_details['Qualification']?></a></li>
                                       <li> <?php echo $view_job_details['Job_Level'];?></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!----- /.col-6----->
                        <div class="col-md-6">
                           <div class="one-company-add">
                              <img src="Company_Profile/<?php echo $view_job_details['Job_Banner'];?>" alt="cadd-1"/>
                           </div>
                        </div>
                        <!----- /.col-6----->
                        <hr class="hr_tag">
                        <?php } }else{ ?>
                    <h4 style="padding-left: 20px;">Sorry!! No Job are aavailable now ...</h4>
                        <?php } ?>
                     </div>
                     <!----- company-addleftside----->
                  </div>
                  <!----- /.row----->
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
               </div>
               <!----- /.col-9----->
               <!----- /.advertisment row----->

               <div class="col-md-3">
                  <?php 
                     while($advertisment_row = mysqli_fetch_array($Advertisment_result)){
                     
                     ?>
                  <div class="well">
                     <a href="<?php echo $advertisment_row['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row['Image']; ?>" alt="add-3"/></a>
                  </div>
                  <?php    } ?>
               </div>
               
               <!----- /.col-3----->
            </div>
            <!----- /.row----->
         </div>
         <!----- /.container----->
      </section>
      <!---------company-add----------->
      <div class="join-us">
         <div class="joinus-overlay">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-6">
                     <div class="joinus-heading">
                        <h1>JOINE WITH US FOR SMART CAREEAR</h1>
                     </div>
                  </div>
                  <!--------/.col-8-------->
                  <div class="col-md-4 col-sm-4 col-xs-6">
                     <div class="joinus-btn">
                        <button class="myjoinus-btn"><a href="registration_form_user">JOINE US</a></button>
                     </div>
                  </div>
                  <!--------/.col-4-------->
               </div>
               <!--- /.row--->
            </div>
            <!--------container---------------->
         </div>
         <!------joinus-overlay------->
      </div>
      <!--- /.join-us--->
      <section id="careear-windows" class="bg-warning">
         <div class="container">
            <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="item-list">
                     <h3>Our Classes</h3>
                     <hr>
                     <ul>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i> Play to Class-4</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i> Class-5 (PSC)</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i> Class-6,7</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i> Class-8 (JSC)</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i>Class-9,10 (SSC)</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i> HSC</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i>Honours</a></li>
                        <li><a href=""><i class="fa fa-book" aria-hidden="true"></i>Masters</a></li>
                     </ul>
                  </div>
                  <!------ end item list----->
               </div>
               <!--------/.col-3-------->
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="item-list">
                     <h3>Our Courses</h3>
                     <hr>
                     <ul>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>Admission</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>Banking Diploma</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>BCS</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>Bank Job</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>Others</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>BBA</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>MBA</a></li>
                        <li><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i>Web Design & Development</a></li>
                     </ul>
                  </div>
                  <!------ end item list----->
               </div>
               <!--------/.col-3-------->
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="item-list">
                     <h3>Our Exam</h3>
                     <hr>
                     <ul>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>BCS</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Bank Job</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Class-3,4</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Class-5(PSC</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Class-6,7</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Class-8(JSC)</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>(SSC)</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>Dhaka Univercity Admission Unit-A,B,C,D</a></li>
                        <li><a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>IBA</a></li>
                     </ul>
                  </div>
                  <!------ end item list----->
               </div>
               <!--------/.col-3-------->
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="item-list">
                     <h3>Our Training</h3>
                     <hr>
                     <ul>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>MS Office</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>Web Design</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>Web Development</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>IELTS, TOEFL, SPOKEN</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>Basic Math</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>IOS Development</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>GMAT & GRE</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>Digital Graphics Design</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>Sql Data solution</a></li>
                        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>SAT & GED</a></li>
                     </ul>
                  </div>
                  <!------ end item list----->
               </div>
               <!--------/.col-3-------->
            </div>
            <!--- /.row--->
         </div>
         <!--- /.container--->
      </section>
      <!----careear-windows------>
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