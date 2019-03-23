<?php 

session_start();

if(!isset($_GET['admit_id'])){

header("location: admit_card");

}

  $admit_id = $_GET['admit_id']; 

  include 'db_connet.php';

  // Admit show............


    $admit_card_quary = "SELECT * FROM  admit_card WHERE id = $admit_id ";

    $admit_card_result = mysqli_query($conn,$admit_card_quary);

    $admit_card_row = mysqli_fetch_array($admit_card_result);

    $company_profile_id =  $admit_card_row ['company_profile_id'];

	$my_profile_id =  $admit_card_row ['my_profile_id'];



  	// My_profile show............


	 $my_profile_sql = "SELECT * FROM my_profile WHERE Main_id =  $my_profile_id  ";

	 $my_profile_result = mysqli_query($conn,$my_profile_sql);
	   
	 $my_profile_row = mysqli_fetch_array($my_profile_result);



  // Company show............


    $Company_quary = "SELECT * FROM  company_profile WHERE Main_id = $company_profile_id ";

    $Company_result = mysqli_query($conn,$Company_quary);

    $Company_row = mysqli_fetch_array($Company_result);



  mysqli_close($conn);



?>



<!DOCTYPE html>
<html lang="en">

<head>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php include('menu.php') ?>
   
<!------------ Admit Card Start --------------->
<section id="admit_card" style="
    background-color: #fff;
">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="admit_area">
					<div class="admit_header">
						<img src="Company_Profile/<?php echo $Company_row['Company_Photo'] ; ?>">
						<h3><?php echo $Company_row['Company_Name'] ; ?></h3>
						<span style="color: red;">Admit Card</span>
					</div>
					<div class="admit_body">
						<div class="row">
							<div class="col-md-8">
								<div class="applient_data">
									<ul>
										<li><span>Admit No</span>: <?php echo  $admit_card_row['roll_number'] ; ?></li>
										<li><span>Name</span>:  <?php echo  $my_profile_row['First_Name']." ".$my_profile_row['Last_Name'] ; ?></li>
										<li><span>Father Name</span>:  <?php echo  $my_profile_row['Father_Name'] ; ?></li>
										<li><span>Mother Name</span>:  <?php echo  $my_profile_row['Mother_Name'] ; ?></li>
										<li><span>Date Of Birth</span>:  <?php echo  $my_profile_row['Date_of_Birth'] ; ?></li>
										<li><span>Contact Mobile</span>:  <?php echo  $my_profile_row['Mobile_No_1'] ; ?></li>
										<li><span>National ID No</span>:  <?php echo  $my_profile_row['National_Id_No'] ; ?></li>
										<li><span>Gender</span>:  <?php echo  $my_profile_row['Gender'] ; ?></li>
										<li><span>Exam Venu</span>:  <?php echo  $admit_card_row['exam_venu'] ; ?></li>
										<li><span>Exam Time And Date</span>:  <?php echo  $admit_card_row['exam_time_date'] ; ?></li>
									</ul>
								</div>
								<div class="admit_education">
									
								</div>
							</div>
							<div class="col-md-4">
								<div class="applient_img pull-right">
									<img src="photo/<?php echo  $my_profile_row['Photo']  ?>" alt="jobscorner">
								</div>
							</div>

              <!--
							<div class="col-md-12">
								<div class="education_experience">
								<h3>Education Qualification:</h3>
								<table class="experience_table">
								  <tr>
									<th>Tittle</th>
									<th>Institute</th>
									<th>Year</th>
									<th>CGPA</th>
								  </tr>
								  <tr>
									<td>BSC In Arts</td>
									<td>University Of Cambridge,UK</td>
									<td>2011-2015</td>
									<td>3.89</td>
								  </tr>
								  <tr>
									<td>Diploma In Arts</td>
									<td>Khulna Polytechnic Institute,Khulna</td>
									<td>2011-2015</td>
									<td>3.89</td>
								  </tr>
								  <tr>
									<td>SSC</td>
									<td>Khulna Public School,Khulna</td>
									<td>2011-2015</td>
									<td>3.89</td>
								  </tr>								  
								</table>
							</div>
							</div>
            -->

							<div class="col-md-12">
								<div class="applicant_signature">
									<img src="photo/<?php echo  $my_profile_row['Signature']  ?>" alt="jobscorner">
									<span>Applicant's Signature</span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="applican_rules">
									<h3>General Instructions For applicants</h3>
									<ul>
										<li>This admit card will be applicable for written examination and viva voce.</li>
										<li>Applicant must carry this admit card during every examination.</li>
										<li>Applicant must sit in the examination hall at least 30 minutes prior to examination.</li>
										<li>Applicant is prohibited from bringing books, bag, mobile phone or any other type of communication device. Applicant can bring calculator but not scientific
calculator.</li>
										<li>Applicant must use the same signature for application, attendance sheet and answer script.</li>
										<li>Applicant will not be allowed entry in the examination hall after distribution of the question paper for examination.</li>
										<li>Applicant must use black ink ball point pen to fill up all parts and circles of preliminary test answer sheet and top sheet of written answer script.</li>
										<li>Applicant is barred from entering the examination hall 15 minutes after the written examination starts.</li>
										<li>Applicant must report at least 30 minutes before the scheduled time for viva voce.</li>
										<li>In addition to his/her educational qualification and experience, an applicant must produce original copies of all necessary documents before the Viva Board.</li>
										<li>Invigilators in the examination hall will match the photograph of the applicant in the attendance sheet with that of the admit card before taking his/her
signature. Legal action will be taken against the applicant if any irregularity is detected.</li>
										<li>Applicant will be expelled if the general instructions are not followed or if found guilty of misconduct, misbehaviour or adopting unfair means. Applicant
found guilty of copying, adopting any type of unfair means or misconduct will be barred from applying in any future examination conducted by the
Commission and will not be allowed to apply for any other posts to be advertised by the Commission. Moreover, he/she may be handed over to the law
enforcing agency for taking legal action against him/her.</li>
									</ul>
								</div>
								<div class="author_signature">
									<img src="Company_Profile/<?php echo $Company_row['Author_Signature'] ; ?>" alt="jobscorner">
									<span>Manger Of <?php echo $Company_row['Company_Name'] ; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Admit Card End ----------->





<!------------- Footer Start ------------>  
  
<?php include("footer.php"); ?>
 
  

   

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
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
