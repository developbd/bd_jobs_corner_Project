<?php

session_start(); 
include 'db_connet.php';

    //Contact info.............
   
    $contact_quarye=" SELECT * FROM site_settings ";
    $contact_result = mysqli_query($conn,$contact_quarye);
    $contact_row = mysqli_fetch_array($contact_result);
   
   
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About us</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link href="css/Style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
	
	
	.main {
    
    padding-top: 8%;
    padding-bottom: 8%;
    }

    .reg-left-title h4 {
         color:#ffffff;
         text-align: justify;
    }
    .right_image{
        padding:4px;
        border: 1px solid #ccc!important
    }
    
    
    
	</style>


</head>

<body>


<?php  include('menu.php'); ?>

<section id="registration-area">
  <div class="container">
      
    <div class="row main">
        <div class="col-md-8 col-sm-12 col-xs-24">
           
           
             <div class="reg-left-title">
              <h1 >ABOUT US</h1>
              <hr>
              
              <h4>BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh. 
              BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh.
              BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh.
              BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh.
              BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh.
              BD JOBS CORNER (bdjobscorner.com) is one of the bigest and leading career management site in Bangladesh.
              </h4>
             </div>

           
        </div><!----/.col---->
        <div class="col-md-4 col-sm-6 col-xs-12">
<img  class="right_image" src="images/aboutus_broker_b.jpg"/>
        </div><!----
        <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="well"><img src="images/add-reg.jpg" alt="add"/></div>
         <div class="well"><img src="images/add-reg-2.jpg" alt="add"/></div>
        </div>--/.col---->
    </div><!---end row---->
  </div><!-------end container------->
</section><!---registration-area----->

<?php include'footer.php'?>


<script src="js/jquery-2.2.4.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
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