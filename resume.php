<?php 
   session_start();
   
   
   
   if(!isset($_SESSION['user_login_id'])){
   
   header("location: user_login_form");
   
   }
   
   
     include("menu.php");
   
     include 'db_connet.php';
   
     $user_id = $_SESSION['user_login_id'];  
   
      $profile_sql = "SELECT  * FROM my_profile 
     JOIN my_resume  
     ON  my_profile.Main_id = my_resume.Main_id 
     WHERE my_profile.Main_id =  '$user_id'  
     AND  my_resume.Category =  'Education' 
     ORDER BY my_resume.id DESC ";
   
     $profile_result = mysqli_query($conn,$profile_sql);
      
     $profile_result_row = mysqli_fetch_array($profile_result);
   
   
   
   
     if(empty($profile_result_row['Main_id'])){
   
       $profile_pic  ='demo_pic.png';
       $profile_Name = $name;
       $profile_title  = '';
   
     }else{
   
      $profile_pic   = $profile_result_row['Photo'];
      $profile_Name  = $profile_result_row['First_Name']." ".$profile_result_row['Last_Name'];
      $profile_title =  $profile_result_row['Tittle'];
   
     }  
   
   
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>bdjobs</title>
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/Style.css" type="text/css" rel="stylesheet">
      <link href="css/responsive.css" type="text/css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <style type="text/css">
   	.fa {
   		padding-top: 10px!important;
   	}

   </style>
   <body>
      <!------------ Dashboard Start ------------>
      <section id="dashboard">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <div class="canditate_area">
                     <img src="photo/<?php echo  $profile_pic; ?>" alt="bdjobs"/>
                     <h3><?php echo $profile_Name ; ?></h3>
                     <span><?php echo $profile_title ; ?></span>
                  </div>
                  <div class="dashboard_menu">
                     <ul>
                        <li><a href="my_profile">My Profile</a></li>
                        <li class="active"><a href="resume">Resume</a></li>
                        <li><a href="applied_jobs">Applied Jobs</a></li>
                        <li><a href="cv_manager">CV And Acceroies</a></li>
                        <li><a href="admit_card">Admit Card</a></li>
                        <li><a href="change_pass">Change Password</a></li>
                        <li><a href="logout">Sign Out</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="applied_jobs">
                     <h3>My Resume:</h3>
                     <div class="resume_area">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="education_area">
                                 <!--  Start  Education Section   -->
                                 <h3 class="pull-left">Education</h3>
                                 <div class="add_education pull-right">							
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add Education
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="show_area">
                           <?php 
                              $Select_data = " SELECT * FROM `my_resume` WHERE  Main_id = $user_id AND Category = 'Education' ORDER BY id DESC ";
                              
                              $Select_data_result = mysqli_query($conn, $Select_data);
                              
                              
                              
                              
                              	While( $Select_data_result_row = mysqli_fetch_array($Select_data_result ) )
                              
                              	{
                              
                              
                               ?>
                           <div class="row show_education">
                              <div class="col-md-12">
                                 <div class="education_part pull-left">
                                    <h4><?php echo $Select_data_result_row['Tittle']; ?> <sub>(<?php echo $Select_data_result_row['CGPA']." cgpa"; ?>)</sub></h4>
                                    <h5><?php echo $Select_data_result_row['Institute_Name']; ?></h5>
                                    <span><?php echo $Select_data_result_row['From_Date']."-".$Select_data_result_row['To_Date']; ?></span>
                                 </div>
                                 <div class="education_control pull-right">
                                    <a href="#edit<?php echo $Select_data_result_row['id'];?> " data-toggle="modal" ><i class="fa fa-pencil" aria-hidden="true" ></i></a>					
                                    <a href="resume_action?action=delete&id=<?php echo $Select_data_result_row['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); "><i class="fa fa-trash" aria-hidden="true" name=""></i></a>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal Start -->  
                           <div class="modal fade" id="edit<?php echo $Select_data_result_row['id'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Update Education</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" role="form" method="POST" action="resume_action.php">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <input type="hidden" name="Edit_eduction_id" value="<?php echo $Select_data_result_row['id']; ?>">
                                                   <label for="">Tittle/Degree Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Education Degree" value="<?php echo $Select_data_result_row['Tittle']; ?>" name="Edit_Degree_Name" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">From Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Admit Date" value="<?php echo $Select_data_result_row['From_Date']; ?>" name="Edit_From_Date" id="fromdatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">To Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Complete Date" value="<?php echo $Select_data_result_row['To_Date']; ?>" name="Edit_To_Date" id="todatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Institute Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Institute Name" value="<?php echo $Select_data_result_row['Institute_Name']; ?>" name="Edit_Institute_Name" id="txtMName">											 
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">CGPA</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your CGPA" value="<?php echo $Select_data_result_row['CGPA']; ?>" name="Edit_CGPA" id="txtMName">		 
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="Edit_eduction"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal End -->
                           <?php	  
                              } 	 ?>
                           <!-- Modal Start -->
                           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Add Education</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" id="personalForm" action="resume_action.php" method="POST">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <label for="">Tittle/Degree Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Education Degree" value="" name="Degree_Name" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">From Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Admit Date" value="" name="From_Date" id="fromdatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">To Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Complete Date" value="" name="To_Date" id="todatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Institute Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Institute Name" value="" name="Institute_Name" id="txtMName">											 
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">CGPA</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your CGPA" value="" name="CGPA" id="txtMName">											 
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="add_education"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--  Modal End -->	
                        </div>
                     </div>
                     <!--  End Education Section   -->	
                     <!--  Start Experience Section   -->	
                     <div class="resume_area">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="education_area">
                                 <h3 class="pull-left">Experience</h3>
                                 <div class="add_education pull-right">								
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_Experience">
                                    Add Experience
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="show_area">
                           <?php 
                              $Select_data = " SELECT * FROM `my_resume` WHERE  Main_id = $user_id AND Category = 'Experience' ORDER BY id DESC ";
                              
                              $Select_data_result = mysqli_query($conn, $Select_data);
                              
                              	While( $Select_data_result_row = mysqli_fetch_array($Select_data_result ) )
                              
                              	{
                              
                              
                               ?>
                           <div class="row show_education">
                              <div class="col-md-12">
                                 <div class="education_part pull-left">
                                    <h4><?php echo $Select_data_result_row['Tittle']; ?></h4>
                                    <h5><?php echo $Select_data_result_row['Institute_Name']; ?></h5>
                                    <span><?php echo $Select_data_result_row['From_Date']."-".$Select_data_result_row['To_Date']; ?></span>
                                 </div>
                                 <div class="education_control pull-right">
                                    <a href="#edit<?php echo $Select_data_result_row['id'];?> " data-toggle="modal" ><i class="fa fa-pencil" aria-hidden="true" ></i></a>
                                    <a href="resume_action?action=delete&id=<?php echo $Select_data_result_row['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); " ><i class="fa fa-trash" aria-hidden="true" name=""></i></a>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal Start -->  
                           <div class="modal fade" id="edit<?php echo $Select_data_result_row['id'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Update Experience</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" role="form" method="POST" action="resume_action.php">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <input type="hidden" name="Edit_experience_id" value="<?php echo $Select_data_result_row['id']; ?>">
                                                   <label for="">Tittle</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Experience Name" value="<?php echo $Select_data_result_row['Tittle']; ?>" name="Edit_Exp_Tittle" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">From Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Start Date" value="<?php echo $Select_data_result_row['From_Date']; ?>" name="Edit_From_Date" id="fromdatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">To Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Leave Date" value="<?php echo $Select_data_result_row['To_Date']; ?>" name="Edit_To_Date" id="todatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Company Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Company Name" value="<?php echo $Select_data_result_row['Institute_Name']; ?>" name="Edit_Company_Name" id="txtMName">			 
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="Edit_experience"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal End -->
                           <?php	 } 
                              ?>
                           <!-- Modal Start -->
                           <div class="modal fade" id="myModal_Experience" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Add Experience</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" id="personalForm" action="resume_action.php" method="POST">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <label for="">Tittle</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Experience Name" value="" name="Exp_Tittle" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">From Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Start Date" value="" name="From_Date" id="fromdatepicker">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">To Date</label>
                                                   <input type="text" class="form-control" placeholder="Enter Leave Date" value="" name="To_Date" id="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Company Name</label>
                                                   <input type="text" class="form-control" placeholder="Enter Company Name" value="" name="Company_Name" id="txtMName">			 
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="Add_Experience"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--  Modal End -->
                        </div>
                     </div>
                     <!--  End Experience Section   -->	
                     <!--  Start Awards Section   -->	
                     <div class="resume_area">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="education_area">
                                 <h3 class="pull-left">Awards</h3>
                                 <div class="add_education pull-right">								
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_Awards">
                                    Add Honors Or Awards
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="show_area">
                           <?php 
                              $Select_data = " SELECT * FROM `my_resume` WHERE  Main_id = $user_id AND Category = 'Awards' ORDER BY id DESC ";
                              
                              $Select_data_result = mysqli_query($conn, $Select_data);
                              
                              	While( $Select_data_result_row = mysqli_fetch_array($Select_data_result ) )
                              
                              	{
                              
                              
                               ?>
                           <div class="row show_education">
                              <div class="col-md-12">
                                 <div class="education_part pull-left">
                                    <h4><?php echo $Select_data_result_row['Tittle']; ?></h4>
                                    <h5><?php echo $Select_data_result_row['Institute_Name']; ?></h5>
                                    <span><?php echo $Select_data_result_row['From_Date']; ?></span>
                                 </div>
                                 <div class="education_control pull-right">
                                    <a href="#edit<?php echo $Select_data_result_row['id'];?> " data-toggle="modal" ><i class="fa fa-pencil" aria-hidden="true" ></i></a>
                                    <a href="resume_action?action=delete&id=<?php echo $Select_data_result_row['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); " ><i class="fa fa-trash" aria-hidden="true" name=""></i></a>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal Start -->  
                           <div class="modal fade" id="edit<?php echo $Select_data_result_row['id'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Update Awards</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" role="form" method="POST" action="resume_action.php">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <input type="hidden" name="Edit_awards_id" value="<?php echo $Select_data_result_row['id']; ?>">
                                                   <label for="">Awards Or Honors Tittle</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Awards Or Honors Tittle" value="<?php echo $Select_data_result_row['Tittle']; ?>" name="Edit_Awards_Tittle" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Year</label>
                                                   <input type="text" class="form-control" placeholder="Enter Year" value="<?php echo $Select_data_result_row['From_Date']; ?>" name="Edit_Year" id="txtLastName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Organization</label>
                                                   <input type="text" class="form-control" placeholder="Enter Organization" value="<?php echo $Select_data_result_row['Institute_Name']; ?>" name="Edit_Organization" id="txtFName">
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="Edit_awards"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Edit Modal End -->
                           <?php	 } 
                              ?>
                           <!-- Modal Start -->
                           <div class="modal fade" id="myModal_Awards" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Add Awards</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form class="row view-mode" id="personalForm" action="resume_action.php" method="POST">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                   <label for="">Awards Or Honors Tittle</label>
                                                   <input type="text" class="form-control" placeholder="Enter Your Awards Or Honors Tittle" value="" name="Awards_Tittle" id="txtFirstName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Year</label>
                                                   <input type="text" class="form-control" placeholder="Enter Year" value="" name="Year" id="txtLastName">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="">Organization</label>
                                                   <input type="text" class="form-control" placeholder="Enter Organization" value="" name="Organization" id="txtFName">
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="das-btn" data-dismiss="modal">Close</button>
                                                <input type="submit" class="das-btn" value="Save changes" name="Add_awards"></input>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--  Modal End -->
                        </div>
                     </div>
                     <!--  End Awards Section   -->	
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!------------ Dashboard End --------------->
      <!------------- Footer Start ------------>  
      <?php include('footer.php')?><!--- footer-form--->
      <!-- for scrollup -->
      <div class="scrolltop">
         <div class="scrollup">
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
         </div>
      </div>
      <!-- jQuery Version 1.11.0 -->
      <script src="js/jquery-1.11.0.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
         
         //for counterup
               $(document).ready(function($) {
                   $('.counter').counterUp({
                       delay: 10,
                       time: 1000
                   });
               });
         
         //for carosel
         $('.carousel').carousel({
         interval: 2000
         });
         
         
         
      </script>
   </body>
</html>