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
  ORDER BY my_resume.id DESC  ";

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
  


    

    $profile_sql = "SELECT * FROM my_profile JOIN my_resume  ON  my_profile.id = my_resume.Main_id";

    $profile_result = mysqli_query($conn,$profile_sql);
   
    $profile_result_row = mysqli_fetch_array($profile_result);



    $applied_job = "SELECT * FROM applied_job  
                    JOIN company_profile  
                    ON  applied_job.company_profile_id = company_profile.Main_id 
                    JOIN post_jobs ON applied_job.post_jobs_id = post_jobs.id 
                    WHERE my_profile_id = $user_id ";


    $applied_job_query = mysqli_query($conn, $applied_job);
    
    mysqli_close($conn);
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

<body>

   
<!------------ Dashboard Start ------------>
<section id="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="canditate_area">
					<img src="photo/<?php echo $profile_pic ; ?>" alt="bdjobs"/>
					<h3><?php echo $profile_Name ; ?></h3>
					<span><?php echo $profile_title ; ?></span>
				</div>
				<div class="dashboard_menu">
					<ul>
						<li><a href="my_profile">My Profile</a></li>
						<li><a href="resume">Resume</a></li>
						<li class="active"><a href="applied_jobs">Applied Jobs</a></li>
						<li><a href="cv_manager">CV And Acceroies</a></li>
						<li><a href="admit_card">Admit Card</a></li>
						<li><a href="change_pass">Change Password</a></li>
						<li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>


			<div class="col-md-9">
				<div class="applied_jobs">
					<h3>Applied Jobs:</h3>
					<div class="row">

 <?php 

	
if (mysqli_num_rows($applied_job_query)>0) {
	while( $applied_job_details = mysqli_fetch_array($applied_job_query)){

 ?>

						<div class="col-md-4">
							<a href="job_view?id=<?php echo $applied_job_details['id']; ?>" target="_blank" >
								<div class="post_date">
									<img src="Company_Profile/<?php echo $applied_job_details['Company_Photo']; ?>" alt="bdjobs">
									<h4><?php echo $applied_job_details['Company_Name']; ?></h4>
									<ul>
										<li>Post Type: <?php echo $applied_job_details['Job_Title']; ?></li>
										<li>Applied Date: <?php echo $applied_job_details['Applied_Date']; ?></li>
									</ul>
								</div>
							</a>
						</div>


<?php } } else{

?>
<h4 style="padding-left: 10px;">Sorry!! You do not apply any job...</h4>
<?php

}

 ?>


					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->


<?php include('footer.php'); ?>

  




    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    
     <script type="text/javascript">
	 
	 //for scrolltop
	 $(window).scroll(function() {
		 
     if ($(this).srollTop() >150) {	
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
