
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

<?php 


session_start();


if(!isset($_GET['id'])){

header("location: index");

}


 include 'db_connet.php';

 if(isset($_GET['id'])){
         
   	$id = $_GET['id'];

      

  $profile_sql = "SELECT * FROM post_jobs  WHERE id = '$id' ";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $job_result_row = mysqli_fetch_array($profile_result);

  $Main_id = $job_result_row['Main_id'];

  //Company quary

   $company_sql ="SELECT * FROM  company_profile WHERE Main_id = $Main_id";
   $company_result = mysqli_query($conn,$company_sql);
   $company_details = mysqli_fetch_array($company_result);

   




}
 if(isset($_POST['Apply_submit'])) {

 	if (isset($_SESSION['user_login_id'])) {

 		 $myprofile_main_id = $_SESSION['user_login_id'] ;

 		 //My Profile

 		 $my_profile_sql ="SELECT * FROM  my_profile WHERE Main_id = '$myprofile_main_id'  ";
		 $my_profile_result = mysqli_query($conn,$my_profile_sql);
		 $count =  mysqli_num_rows($my_profile_result);


		 // my_resume

		 $my_resume_sql ="SELECT * FROM  my_resume WHERE Main_id = '$myprofile_main_id'  ";
		 $my_resume_result = mysqli_query($conn,$my_resume_sql);
		 $my_resume_count =  mysqli_num_rows($my_resume_result);


		 //All ready apply

		 $all_ready_apply_sql ="SELECT * FROM  applied_job WHERE my_profile_id = '$myprofile_main_id'  AND post_jobs_id ='$id'";
		 
		 $all_ready_apply_result = mysqli_query($conn,$all_ready_apply_sql);
		 $all_ready_apply_count =  mysqli_num_rows($all_ready_apply_result);
		 


		 	if($count == 0 ||  $my_resume_count == 0 ){

		 		echo "<script>
					// confirm

					$(document).ready(function()  {

						$.confirm({
							closeIcon: true,
					   		closeIconClass: 'fa fa-close',
							title: 'Please at fast complite youer Profile',
							content: 'Press ok to your profile page.',
							
					   		 buttons: {
					       	 ok: function(){
					            location.href = 'my_profile';
					        	}
							}
						});
					});

			   </script> ";

		 	}else{


		 		



		 		if($all_ready_apply_count >= 1){

		 		echo "<script>
					// confirm

					$(document).ready(function()  {

						$.confirm({
							closeIcon: true,
					   		closeIconClass: 'fa fa-close',
							title: 'You all ready apply on this job try to apply another job',
							content: 'Press ok to home page.',
							
					   		 buttons: {
					       	 ok: function(){
					            location.href = 'index';
					        	}
							}
						});
					});

			   </script> ";


		 		}else{

				 	$my_profile_main_id = $myprofile_main_id;;
				    $company_main_id	= $Main_id;
				    $job_id 			= $_GET['id'];
				    $date    			= date('YmdHis');


				 	$Data_insert="INSERT INTO  applied_job (`my_profile_id`,`company_profile_id`,`post_jobs_id`,`Applied_Date`)VALUES ('$my_profile_main_id','$company_main_id','$job_id','$date')";

						if (mysqli_query($conn, $Data_insert)) {

								echo "<script>
							// confirm

							$(document).ready(function()  {

								$.confirm({
									closeIcon: true,
							   		closeIconClass: 'fa fa-close',
									title: 'You successfully apply on the job',
									content: 'Press ok to home page.',
									
							   		 buttons: {
							       	 ok: function(){
							            location.href = 'index';
							        	}
									}
								});
							});

					   </script>";
							
						}else{

						    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);

						}
		 		}

		 	}

 		}else{

	 		echo " <script>
					// confirm

					$(document).ready(function()  {

						$.confirm({
							closeIcon: true,
					   		closeIconClass: 'fa fa-close',
							title: 'Apply on the job you fast login!',
							content: 'Press ok to login.',
							
					   		 buttons: {
					       	 ok: function(){
					            location.href = 'user_login_form';
					        	}
							}
						});
					});

			   </script> ";
	 	}


 }



  mysqli_close($conn);




?>





<!DOCTYPE html>
<html lang="en">

<head>
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

    <!-- Custom CSS -->
    <link href="css/Style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<style type="text/css">
	.fa{
		padding-top: 10px !important;
	}
	
</style>


</head>

<body>

<?php  include('menu.php') ?>
   
<!------------ Job View Start -------------->
<section id="job_view">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="row">
					<div class="job_area">
						<div class="col-md-8">
							<div class="job_details">
								<div class="company_job">
									<h3><?php echo  $job_result_row ['Job_Title']; ?></h3>
									<span><a href="company_view?com_id=<?php echo $company_details['id'] ?> " target='_blank'> <?php echo  $job_result_row ['Name_of_Company']; ?></a></span>
								</div>
								<div class="view_all_jobs">
									<a href="search?search=<?php echo  $job_result_row ['Name_of_Company']; ?>">View All Jobs Of This Company</a>
								</div>
								<div class="vacancy">
									<h4>Vacancy</h4>
									<span><?php echo  $job_result_row ['Needs_Employee']; ?></span>
								</div>
								<div class="job_context">
									<h4>Job Context</h4>
									<?php echo  $job_result_row ['Job_Context']; ?>
								</div>
								<div class="job_responsiblities">
									<h4>Job Responsibilities</h4>
									<?php echo  $job_result_row ['Job_Responsiblities']; ?>
								</div>
								<div class="job_type">
									<h4>Job Type</h4>
									<span><?php echo  $job_result_row ['Job_Type']; ?></span>
								</div>
								<div class="job_qualification">
									<h4>Qualification</h4>
									<span><?php echo  $job_result_row ['Qualification']; ?></span>
								</div>
								<div class="job_experience">
									<h4>Job Experience</h4>
									<?php echo  $job_result_row ['Job_Level']; ?>
								</div>
								<div class="additional_experience">
									<h4>Additional Requirements</h4>
									<?php echo  $job_result_row ['Additional_Requirements']; ?>
								</div>
								<div class="job_location">
									<h4>Job Location</h4>
									<span><?php echo  $job_result_row ['Job_Location']; ?></span>
								</div>
								<div class="job_salary">
									<h4>Salary</h4>
									<span><?php echo  $job_result_row ['Salary']; ?></span>
								</div>
								<div class="other_benifit">
									<h4>Compensation & Other Benefits</h4>
									<?php echo  $job_result_row ['Compensation']; ?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="job_details">
								<div class="job_category">
									<h4>Category:</h4>
									<a href="#"> <?php echo  $job_result_row ['Job_Category']; ?></a>
								</div>
								<div class="job_summary">
									<h4>Job Summary</h4>
									<ul>
										<li><span>Published On :</span> <?php echo  $job_result_row ['Job_Created_Date']; ?></li>
										<li><span>Vanancy :</span> <?php echo  $job_result_row ['Needs_Employee']; ?></li>
										<li><span>Job Type :</span> <?php echo  $job_result_row ['Job_Type']; ?></li>
										<li><span>Job Experience :</span>  <?php echo  $job_result_row ['Job_Level']; ?></li>
										<li><span>Job Location :</span><?php echo  $job_result_row ['Job_Location']; ?></li>
										<li><span>Salary :</span> <?php echo  $job_result_row ['Salary']; ?></li>
										<li><span>Application Deadline : </span><?php echo  $job_result_row ['App_Deadline_Date']; ?></li>
									</ul>
								</div>
								<div class="job_apply">
									<form action="" method="POST">
										<button class="apply_btn" name="Apply_submit">Apply Online</button>
									
									
								</div>
							</div>
						</div>
						<div class="col-md-12">
						<div class="apply_area">
							<div class="read_before">
								<h3>Read Before Apply</h3>
								<p>Due to the urgency of these role, we will be reviewing applications and interviewing candidate in advance of the closing date. For this reason, interested candidates are asked to submit their application as soon as possible</p>
								
								<button class="apply_btn" name="Apply_submit">Apply Online</button>
								</form>
							</div>
						</div>
					</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="company_information">
							<h4>Company Information:</h4>
							<h5><a href="company_view?com_id=<?php echo $company_details['id'] ?> " target='_blank'><?php echo $job_result_row['Name_of_Company'];  ?></a></h5>
							<ul>
								<li>Address: <?php echo $company_details['Full_Address'];  ?></li>
								<li>Web: <a href=" <?php echo $company_details['Website'];  ?>">  <?php echo $company_details['Website'];  ?> </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ads_zone">
					<img src="images/ads.jpg"/>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Job View End ---------------->
<!------------- Footer Start ------------>  


<?php  include('footer.php') ?>
 
  

   

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

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
