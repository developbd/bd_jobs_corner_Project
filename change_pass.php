<?php

session_start(); 

if(!isset($_SESSION['user_login_id'])){

header("location: user_login_form");

}



  include('menu.php') ;
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




  

  $profile_sql = "SELECT * FROM my_profile JOIN my_resume  ON  my_profile.id = my_resume.Main_id";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $profile_result_row = mysqli_fetch_array($profile_result);


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
          <img src="photo/<?php echo $profile_pic; ?>" alt="bdjobs"/>
          <h3><?php echo $profile_Name ; ?></h3>
          <span><?php echo $profile_title ; ?></span>
        </div>

				<div class="dashboard_menu">
					<ul>
            <li ><a href="my_profile">My Profile</a></li>
            <li><a href="resume">Resume</a></li>
            <li><a href="applied_jobs">Applied Jobs</a></li>
            <li><a href="cv_manager">CV And Acceroies</a></li>
            <li><a href="admit_card">Admit Card</a></li>
            <li class="active" ><a href="change_pass" >Change Password</a></li>
            <li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					<h3>Change Password:</h3>
<?php 

if(isset($_SESSION['pass_set'])){
  
?>
<h4 style="color:red; padding-bottom: 30px;"><?php echo $_SESSION['pass_set']?></h4>

<?php  
unset ($_SESSION['pass_set']);

}    


           

            ?> </span>

					<div class="row">
						<form class="row view-mode" id="personalForm" action="change_pass_action.php" method="POST">                                        
                                        <div class="col-md-6">
                                        	<div class="row">
                                            	<div class="form-group col-md-12">
                                       			<label for="">Old Password</label>
                                       			<input type="password" class="form-control" placeholder="Enter Old Password" value="" name="oldpass" id="oldpass" required="">
                                    		</div>
                                            	<div class="form-group col-md-12">
                                       			<label for="">New Password</label>
                                       			<input type="text" class="form-control" placeholder="Enter New Password" value="" name="newpass" id="newpass" required="" minlength="8">
                                    		</div>
                                            	<div class="form-group col-md-12">
                                              <label for="">Retype New Password</label>
                                              <input type="text" class="form-control" placeholder="Enter Retype New Password" value="" name="rnewpass" id="rnewpass" required="">
                                           </div>                                  
                                            </div>
                                        </div>                                        
                                           <div class="col-md-12">
                                              <div class="btn-form-control">
                                                 <button type="submit" name="user_change_pass_submit"class="das-btn">Save</button>
                                                 <button type="reset" class="das-btn">Cancel</button>
                                              </div>
                                           </div>
                                        </form>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->





<!------------- Footer Start ------------>  
 
 <?php include('footer.php') ?>
  

   

 
<!-- jQuery Version 2.2.4.min.js -->
  <script src="js/jquery-2.2.4.min.js"></script>

  
<!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script type="text/javascript">


var password = document.getElementById("newpass")
  , confirm_password = document.getElementById("rnewpass");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

   
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
