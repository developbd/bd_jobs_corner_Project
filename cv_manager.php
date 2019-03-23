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


      // Delete....

    if (isset($_GET['action']) && $_GET['action']=='delete'){

    $id  =  $_GET['id'];        

    $cv_delete = "DELETE FROM cv_list WHERE id =$id ";  


     if(mysqli_query($conn, $cv_delete)){

      header("location: cv_manager");
      
      
      
       //unlink("cv_list/$cv");

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

    <title>bdjobscorner</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/Style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">
	
	 <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">


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
					<span><?php echo $profile_title  ; ?></span>
				</div>

				<div class="dashboard_menu">
					<ul>
						<li><a href="my_profile">My Profile</a></li>
						<li><a href="resume">Resume</a></li>
						<li><a href="applied_jobs">Applied Jobs</a></li>
						<li class="active"><a href="cv_manager">CV And Acceroies</a></li>
						<li><a href="admit_card">Admit Card</a></li>
						<li><a href="change_pass">Change Password</a></li>
						<li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					<h3>CV Manager:</h3>
					<div class="row">
						<form class="row view-mode" id="personalForm" action="cv_manager_action.php"  method="POST" enctype="multipart/form-data">                                        
                                        
                                        <div class="col-md-12">
                                            <div class="row">                                          
										   <div class="form-group col-md-12">
                                              <label for="">Upload Your CV or  Certificates Or Awards Or NID </label>
                                              
											  <input type="file" class="form-control" name="imageFile"  id="imageFile" accept="" enctype="multipart/form-data">                                           
                                           </div>
                                            </div>
<?php  

if(isset($_SESSION['cv_error'])){
  
?>
<h5 style="color:red"><?php echo $_SESSION['cv_error'] ?></h5>

<?php  
unset ($_SESSION['cv_error'] );

}    

?>
                                         </div> 

<!--

										 <div class="col-md-12">
                                            <div class="row">                                          
										   <div class="form-group col-md-12">
                                              <label for="">Upload Your Certificates Or Awards Or NID</label>
                                              <div action="/upload-target" class="dropzone"></div> 
											                                             
                                           </div>
                                            </div> 	
                                         </div>

-->



                                           <div class="col-md-12">
                                              <div class="btn-form-control">
                                                 <input type="submit" class="das-btn" name="submit" value="Save"/>

                                                 <input type="reset" class="das-btn" value="Cancel"/>
                                              </div>
                                           </div>
                                        </form>
					
					

						<div class="col-md-12">
						  <h2>CV Gallery</h2>
						  <div class="row">

<?php 

	$Select_data = " SELECT * FROM `cv_list` WHERE  Main_id = $user_id  ORDER BY id DESC ";

	$Select_data_result = mysqli_query($conn, $Select_data);

		While( $Select_data_result_row = mysqli_fetch_array($Select_data_result ))

		{ ?>


						    <div class="col-md-4">
						      <div class="thumbnail ">
						      	<div class="profile-pic ">
						    	  <a href="cv_list/<?php echo $Select_data_result_row['CV_id'] ;?> " target="_blank">
		<img  src="cv_list/download-9.jpg" alt="CV" style="width:100%" /></a>
		<div class="edit"><a href="cv_manager?action=delete&id=<?php echo $Select_data_result_row['id']; $cv= $Select_data_result_row['CV_id'];   ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-remove fa-lg"  style="color:#333333"></i></a></div>
								</div>        
						      </div>
						    </div>
						<?php } ?>

</div>




						</div>
  
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->





<!------------- Footer Start ------------>  
<?php  include("footer.php"); ?>


 <?php   mysqli_close($conn);


?>
  

   

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
