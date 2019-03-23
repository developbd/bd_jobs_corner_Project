<?php 

session_start();




If(!isset($_SESSION['company_login_id'])){

header("location: company_login_form");

}


if(!isset($_GET['job_id'])){

header("location: manage_jobs");

}

  $job_id = $_GET['job_id'] ; 

  include 'db_connet.php';



  $user_id = $_SESSION['company_login_id'];  

  $profile_sql = "SELECT * FROM company_profile WHERE Main_id =  $user_id  ";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $profile_result_row = mysqli_fetch_array($profile_result);



  if(empty($profile_result_row['Main_id'])){

    $profile_pic  ='demo_logo.jpg';
    $profile_name = 'User id '.$user_id;

  }else{

   $profile_pic   = $profile_result_row['Company_Photo'];
   $profile_name  = $profile_result_row['Company_Name'];


  }





  //pagination.............

  if(isset($_GET['page']) & !empty($_GET['page'])){
  
  $page = $_GET["page"];

  } else {

  $page = 1;

  }




// pagination

  $per_page = 5;

  $start_from = ($page*$per_page)-$per_page;


  $pagesql  ="SELECT * FROM applied_job WHERE post_jobs_id = $job_id";

  $pageres  = mysqli_query($conn, $pagesql);

  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres / $per_page);

  $startpage  = 1;

  $nextpage =   $page + 1;

  $previouspage =  $page - 1;

 


  $apply ="SELECT *, applied_job.id AS applied_job_id  FROM applied_job

  INNER JOIN my_profile ON applied_job.my_profile_id = my_profile.Main_id
   WHERE applied_job.post_jobs_id = $job_id LIMIT $start_from, $per_page ";

  $app_query = mysqli_query($conn,$apply);



 // $apply_row = mysqli_fetch_array($app_query);

   


  //submit Quarye

   if (isset($_POST['send_admit_card'])){

   
    $my_profile_id=$_POST['my_profile_id'];
    $company_profile_id=$user_id;     
    $post_job_id= $job_id;

    
    $roll_number=$_POST['roll_number'];
    $exam_venu=$_POST['exam_venu'];
    $exam_time_date=$_POST['exam_time_date'];
    $date    = date('YmdHis');



          $sql="INSERT INTO admit_card(`my_profile_id`, `company_profile_id`, `post_job_id`,`roll_number`, `exam_venu`, `exam_time_date`, `admit_submit_date`)
          VALUES ('$my_profile_id','$company_profile_id','$post_job_id','$roll_number','$exam_venu','$exam_time_date','$date')";
        
                                                                  
          if (mysqli_query($conn, $sql)) {


              header("location: apply?job_id=$job_id");

              
            
          
          } else {
            
            //header("location: registration_form_company.php");
            //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

    }
    
    
      // Delete  Application...
  
     if (isset($_GET['action']) && $_GET['action']=='delete'){

    $Delete_Application_id  =  $_GET['id'];        

    $Delete_Application = "DELETE FROM applied_job  WHERE id = $Delete_Application_id";  

    if(mysqli_query($conn, $Delete_Application)){

    header("location: manage_jobs");

    }

  }

  // Cancel admit
  
     if (isset($_GET['action']) && $_GET['action']=='delete'){

    $cancel_admit  =  $_GET['id'];        

    $delete_admit = "DELETE FROM admit_card  WHERE id =$cancel_admit ";  

    if(mysqli_query($conn, $delete_admit)){

    header("location: manage_jobs");

    }

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

    <title>jobscorner</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

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

<body>

<?php include('menu.php') ?>   
<!------------ Dashboard Start ------------>
<section id="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="canditate_area">
					<img src="Company_Profile/<?php echo $profile_pic ?>" alt="bdjobs"/>
					<h3><?php echo $profile_name  ?></h3>					
				</div>
        <div class="dashboard_menu">
          <ul>
            <li><a href="company_profile">Company Profile</a></li>
            <li  class="active" ><a href="manage_jobs">Manage Jobs</a></li>
            <li><a href="post_jobs">Post A Jobs</a></li>
            <li><a href="change_pass_company">Change Password</a></li>
            <li><a href="logout">Sign Out</a></li>
          </ul>
        </div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					<h3><?php echo $totalres ;?> People Apply In This Job</h3>
					<div class="row">
						<div class="cv_area">

<?php   while( $apply_row = mysqli_fetch_array($app_query)){

      // roll Generete

      $roll_quarry = "SELECT * FROM   admit_card ORDER BY  roll_number DESC ";
      $roll_result = mysqli_query($conn, $roll_quarry);
      $roll_row = mysqli_fetch_array($roll_result);

      $roll_number = $roll_row['roll_number']+1;
      
      
      
      

 ?>

  <!-- Modal Start -->
                <div class="modal fade" id="Admitcard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"> Sent Admit Card</h4>
                            </div>
                            <div class="modal-body">
                            <form class="row view-mode" id="personalForm" action="" method="POST">                                        
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="form-group col-md-12">
                                      <div class="applient_data">
                                        <ul>
                                          <li><span>Admit No</span>: <span style="color: red"><?php echo $roll_number;  ?></span></li>
                                          <li><span>Name</span>: <?php  echo  $apply_row['First_Name']." ".$apply_row['Last_Name'];?></li>
                                          <li><span>Father Name</span>: <?php echo $apply_row['Father_Name'];?></li>
                                          <li><span>Mother Name</span>: <?php echo $apply_row['Mother_Name'];?></li>
                                          <li><span>Date Of Birth</span>: <?php echo $apply_row['Date_of_Birth'];?></li>
                                          <li><span>Gender</span>: <?php echo $apply_row['Gender'];?></li>
                                        </ul>
                                      </div>
                                  </div>

                                  <input type="hidden" class="form-control" value="<?php echo $apply_row['Main_id'];?>" name="my_profile_id" id="txtMName"> 

                                  <input type="hidden" class="form-control" value="<?php echo $roll_number;?>" name="roll_number" id="txtMName">   

                                  <div class="form-group col-md-6">
                                    <label for="">Exam Venu</label>
                                    <input type="text" class="form-control" placeholder="Venu Name" value="" name="exam_venu" id="txtMName">                       
                                   </div>
                                   <div class="form-group col-md-6">
                                    <label for="">Exam Time And Date</label>
                                    <input type="text" class="form-control" placeholder="Exam Time And Date" value="" name="exam_time_date" id="Exam_Date">                      
                                   </div>
                                  
                                
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="das-btn" data-dismiss="modal">Close</button>

                            <input type="submit" class="das-btn" value="Send Admit Card" name="send_admit_card"></input>
                            </div>
                          </div>
                          </form>
                          </div>
                        </div>
                        
                      </div>
                    </div>


<!--  Modal End --> 

            <div class="submitted_cv">
              <div class="bio_area pull-left">
                <img src="photo/<?php  echo  $apply_row['Photo'];?>" alt="jobscorner">
                <div class="data_area">
                  <h4><a href="#"><?php  echo  $apply_row['First_Name']." ".$apply_row['Last_Name'];?></a></h4>
                  <ul>
                    <li>BSC In CSE</li>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php  echo  $apply_row['Present_Address'];?></li>
                  </ul>
                </div>
              </div>
              <div class="action_area pull-right">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Action
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="profile_view?id=<?php echo $apply_row['Main_id']?>"  target="_blank">View Profile</a></li>
                
                
                 <?php 
                 
                    $my_profile_id =  $apply_row['Main_id'];
                 
                    $admit_query = "SELECT id FROM admit_card WHERE post_job_id = '$job_id ' AND my_profile_id = '$my_profile_id]'";
                   
                    $admit_result = mysqli_query($conn,$admit_query);

                    $count = mysqli_num_rows($admit_result);
                    
                    $admit_row = mysqli_fetch_array($admit_result);
      
                  // If result matched $myusername and $mypassword, table row must be 1 row
		
	        	 if($count == 0) {
 
                echo'<li><a href="#Admitcard" data-toggle="modal"">Admitcard</a></li>';
                
                }else{
                    
                    ?>
                   
                    <li><a href="apply?action=delete&id=<?php echo $admit_row['id'];  ?>" onclick="return confirm('Are you sure you want to delete this item?'); " style="color:#FF0000;" >Cancel Admitcard</a></li>
                 
                  <?php   }  ?>
                
                  </ul>
                </div>
                <span><a href="apply?action=delete&id=<?php echo $apply_row['applied_job_id'];  ?>" onclick="return confirm('Are you sure you want to delete this item?'); " style="color:#FF0000;"><i class="fa fa-trash" aria-hidden="true"></i></a></span>
              </div>
            </div>


<?php } 

//Show Pagination for Job ..........--

if($totalres !=0){


?>
    <nav aria-label="Page navigation">
  <ul class="pagination">

  <?php if($page != $startpage){ ?>
    <li class="page-item">
      <a class="page-link" href="?job_id=<?php echo $job_id?>&&page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>

    <?php if($page >= 2){ ?>
    <li class="page-item"><a class="page-link" href="?job_id=<?php echo $job_id?>&&page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?job_id=<?php echo $job_id?>&&page=<?php echo $page ?>"><?php echo $page ?></a></li>

    <?php if($page != $endpage){ ?>
    <li class="page-item"><a class="page-link" href="?job_id=<?php echo $job_id?>&&page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?job_id=<?php echo $job_id?>&&page=<?php echo $endpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>


  </ul>
  </nav>
<?php } ?>

						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->



<!------------- Footer Start ------------>  
<?php include('footer.php')?>
<!--- footer-form--->
                 
  
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
    <script src="js/jquery.counterup.min.js"></script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

     <script type="text/javascript">

     //Exam Date 

    $('#Exam_Date').datetimepicker({
      timeFormat: "hh:mm tt"
    });
    	 
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
