
<?php

  include 'db_connet.php';

if(isset($_GET['com_id']) & !empty($_GET['com_id'])){
     
     $com_id = $_GET["com_id"];
   
     } else{


      header("location: index.php");

     }

$company_sql = "SELECT * from  company_profile  WHERE id = '$com_id' ";
$company_result = mysqli_query($conn, $company_sql);
$company_row =  mysqli_fetch_array($company_result);



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
  <?php include 'menu.php';?>

   
<!------------ Company View Start ------------>
<section id="company_view">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="view_area">
					<div class="view_headline">
						<img src="Company_Profile/<?php echo $company_row['Company_Photo']; ?>" alt="jobscorner"/>
						<div class="company_tittle">
							<h1><?php echo $company_row['Company_Name']; ?></h1>
							<span></span>
						</div>
					</div>
					<div class="view_description">
						<h3>About Company:</h3>
						<p><?php echo $company_row['Description']; ?></p>
					</div>
					<div class="additional_information">
						<h3>Additional Information:</h3>
						<div class="row">
							<div class="col-md-6">
								<ul class="view_information">
									<li><span>Found Date :</span> <?php echo $company_row['Found_Date']; ?></li>
									<li><span>Region :</span> <?php echo $company_row['Region']; ?></li>
									<li><span>District :</span> <?php echo $company_row['District']; ?></li>
								</ul>
							</div>
							<div class="col-md-6">
								<ul class="view_information">
									<li><span>Email :</span> <?php echo $company_row['Email']; ?></li>
									<li><span>Phone :</span> <?php echo $company_row['Phone']; ?></li>
									<li><span>Website :</span> <a href="<?php echo $company_row['Website']; ?>"><?php echo $company_row['Website']; ?></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
	</div>
</section>
<!------------ Company View End --------------->





<!------------- Footer Start ------------>  
  <?php include 'footer.php';?>

<!------end footer sideber----->
 
  

   

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
