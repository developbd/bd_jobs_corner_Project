<?php 


session_start();

if(!isset($_GET['id'])){

header("location: index");

}

include 'db_connet.php';

 if(isset($_GET['id'])){
         
    $id = $_GET['id'];


  $profile_sql = "SELECT * FROM my_profile  WHERE Main_id =  '$id'  ";
  $profile_result = mysqli_query($conn,$profile_sql); 
  $profile_result_row = mysqli_fetch_array($profile_result);

  //Education

  $my_resume_edu_sql = "SELECT * FROM my_resume WHERE Main_id = '$id' AND Category = 'Education' ";
  $my_resume_edu_result = mysqli_query($conn,$my_resume_edu_sql); 
 
    //Experience

  $my_resume_exp_sql = "SELECT * FROM my_resume WHERE Main_id = '$id' AND Category = 'Experience' ";
  $my_resume_exp_result = mysqli_query($conn, $my_resume_exp_sql); 

    //Experience

  $my_resume_Awards_sql = "SELECT * FROM my_resume WHERE Main_id = '$id' AND Category = 'Awards' ";
  $my_resume_Awards_result = mysqli_query($conn, $my_resume_Awards_sql); 
 


  
   // Certificate Or Awards or  cv_list

  $cv_list_sql = "SELECT * FROM  cv_list WHERE Main_id = '$id' ";
  $cv_list_result = mysqli_query($conn, $cv_list_sql); 


  //Advertisment

  $Advertisment_quarye=" SELECT * FROM advertisment ORDER BY RAND() LIMIT 5 ";
  $Advertisment_result = mysqli_query($conn,$Advertisment_quarye);
  
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
	<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php  include('menu.php') ?>
   
<!------------- Profile View Start -------------->
<section id="view_profile">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="view_profile_area">
					<div class="row">
						<div class="col-md-8">
							<div class="basic_information">
								<h2>Personal Details</h2>
								<ul>
									<li><span>Full Name </span>: <?php echo  $profile_result_row['First_Name'].' '.$profile_result_row['Last_Name'] ; ?></li>
									<li><span>Father's Name </span>: <?php echo  $profile_result_row['Father_Name'] ; ?></li>
									<li><span>Mother's Name </span>: <?php echo  $profile_result_row['Mother_Name'] ; ?></li>
									<li><span>Address </span>: <?php echo  $profile_result_row['Permanent_Address'] ; ?></li>
									<li><span>Email </span>: <?php echo  $profile_result_row['Email'] ; ?></li>
									<li><span>Mobile No </span>: <?php echo  $profile_result_row['Mobile_No_1'] ; ?></li>
									<li><span>Current Location </span>: <?php echo  $profile_result_row['Current_Location'] ; ?></li>
									<li><span>Date of Birth </span>: <?php echo  $profile_result_row['Date_of_Birth'] ; ?></li>
									<li><span>Age </span>: <?php echo  $profile_result_row['Age'] ; ?></li>
									<li><span>Gender </span>: <?php echo  $profile_result_row['Gender'] ; ?></li>
									<li><span>Religion </span>: <?php echo  $profile_result_row['Religion'] ; ?></li>
									<li><span>Marital Status </span>: <?php echo  $profile_result_row['Marital_Status'] ; ?></li>
									<li><span>Nationality </span>: <?php echo  $profile_result_row['Nationality'] ; ?></li>
									<li><span>National Id No </span>: <?php echo  $profile_result_row['National_Id_No'] ; ?></li>
									
								</ul>
							</div>
							<div class="education_experience">
								<h3>Education Qualification</h3>
								<table class="experience_table">
								  <tr>
									<th>Tittle</th>
									<th>Institute</th>
									<th>Year</th>
									<th>CGPA</th>
								  </tr>

<?php  while( $profile_edu_row = mysqli_fetch_array($my_resume_edu_result) ){  ?>

								  <tr>
									<td><?php echo $profile_edu_row['Tittle'] ; ?></td>
									<td><?php echo $profile_edu_row['Institute_Name'] ; ?></td>
									<td><?php echo $profile_edu_row['From_Date'].'-'.$profile_edu_row['To_Date'] ; ?></td>
									<td><?php echo $profile_edu_row['CGPA'] ; ?></td>
								  </tr>
 <?php } ?>
								 				  
								</table>
							</div>
							<div class="working_experience">
								<h3>Working Experience</h3>
								<table class="experience_table">
								  <tr>
									<th>Company Name</th>
									<th>Position</th>
									<th>Year</th>									
								  </tr>

<?php  while( $profile_exp_row = mysqli_fetch_array($my_resume_exp_result) ){  ?>

                  <tr>
                  <td><?php echo $profile_exp_row['Tittle'] ; ?></td>
                  <td><?php echo $profile_exp_row['Institute_Name'] ; ?></td>
                  <td><?php echo $profile_exp_row['From_Date'].'-'.$profile_exp_row['To_Date'] ; ?></td>
                  </tr>
 <?php } ?>
								  
								</table>
							</div>
							<div class="achive_awards">
								<h3>Awards</h3>
								<table class="experience_table">
								  <tr>
									<th>Organization Name</th>
									<th>Awards Name</th>
									<th>Year</th>									
								  </tr>

<?php  while( $profile_Awards_row = mysqli_fetch_array($my_resume_Awards_result) ){  ?>

                  <tr>
                  <td><?php echo $profile_Awards_row['Tittle'] ; ?></td>
                  <td><?php echo $profile_Awards_row['Institute_Name'] ; ?></td>
                  <td><?php echo $profile_Awards_row['From_Date'] ; ?></td>
                  </tr>
 <?php } ?>								  


								</table>
							</div>
							<div class="certificate_awards">
								<h3>Certificate Or Awards</h3>
									<ul>
<?php  while( $cv_list_row = mysqli_fetch_array($cv_list_result) ){  ?>

                  <li>
                    <a rel="example_group" target="_blank" href="cv_list/<?php echo $cv_list_row['CV_id'] ; ?>" title="Certificate Or Awards"><img alt="jobs corner" src="cv_list/download-9.jpg"/></a>
                  </li>
 <?php } ?>   
																	
								</ul>	
							</div>
						</div>
						<div class="col-md-4">
							<div class="profile_img">
								<img src="photo/<?php echo  $profile_result_row['Photo'] ; ?>" alt="jobs corner"/>
								<!--<img class="candiadte_sign" src="images/signature.png" alt="jobs corner"/> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ads_zone">

					           <?php 
                     while($advertisment_row = mysqli_fetch_array($Advertisment_result)){
                     
                     ?>
                  <div class="well">
                     <a href="<?php echo $advertisment_row['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row['Image']; ?>" alt="add-3"/></a>
                  </div>
                  <?php    } ?>
                  
				</div>
			</div>
		</div>
	</div>
	
</section>
<!------------- Profile View End ---------->


<!------------- Footer Start ------------>  


<?php  include('footer.php') ?>
 

   

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
	<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

    
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
