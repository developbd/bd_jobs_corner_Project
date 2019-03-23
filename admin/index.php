<?php

session_start();

      
if(!isset($_SESSION['super_admin'])) {   
      
   
       header("location: login");
 

  }

    $User_id = $_SESSION['super_admin'] ;

    include  "db_connet.php";


    $today = date("Y-m-d ");

     //job Quary

    $job_quary = "SELECT * FROM `post_jobs` ";
    $job_result = mysqli_query($conn, $job_quary);
    $job_count = mysqli_num_rows($job_result);

    $job_quary_today = "SELECT * FROM `post_jobs` WHERE  Job_Created_Date = '$today' ";
    $job_result_today= mysqli_query($conn, $job_quary_today);
    $job_count_today = mysqli_num_rows($job_result_today);

    //User Quary

    $user_quary = "SELECT * FROM `my_profile_reg`  ";
    $user_result = mysqli_query($conn, $user_quary);
    $user_count = mysqli_num_rows($user_result);

    //Company quary

    $company_quary = "SELECT * FROM `company_profile_reg`  ";
    $company_result = mysqli_query($conn, $company_quary);
    $company_count = mysqli_num_rows($company_result);

    //Admit card submit quary

    $admit_quary = "SELECT * FROM `admit_card`  ";
    $admit_result = mysqli_query($conn, $admit_quary);
    $admit_count = mysqli_num_rows($admit_result);


    
    // Job applied

    $applied_job_quary = "SELECT * FROM `applied_job` ";
    $applied_job_result= mysqli_query($conn, $applied_job_quary);
    $applied_job_count = mysqli_num_rows($applied_job_result);

    $applied_job_quary_today = "SELECT * FROM `applied_job` WHERE  Applied_Date =  '$today'";
    $applied_job_result_today= mysqli_query($conn, $applied_job_quary_today);
    $applied_job_count_today = mysqli_num_rows($applied_job_result_today);



    
   

    $Total_Jobs_Post  = $job_count;

    $Total_candidate  = $user_count;

    $Total_company    = $company_count;
  
    $Total_applied_job = $applied_job_count;

    $Today_Job_Posts   = $job_count_today ;

    $Today_Admit_Card_Submit = $admit_count;

    $Today_Job_Applied  = $applied_job_count_today ;


    mysqli_close($conn);

  




   
?>





<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uxliner.com/niche/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:34:56 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Jobs Corner Super Admin</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="dist/css/style.css">
<link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="dist/css/et-line-font/et-line-font.css">
<link rel="stylesheet" href="dist/css/themify-icons/themify-icons.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">

<?php include('menu.php');   ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header sty-one">
      <h1>Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><i class="fa fa-angle-right"></i> Dashboard</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Total_Jobs_Post ;?></span> <span class="info-box-text">Total Jobs Post</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-users" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Total_candidate ;?></span> <span class="info-box-text">Total Candidate</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-building-o" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Total_company ;?></span> <span class="info-box-text">Total Company</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
		<div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Total_applied_job ;?></span> <span class="info-box-text">Total Job Applied</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-4 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Today_Job_Posts ;?></span> <span class="info-box-text">Today Job Posts</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
		<div class="col-lg-4 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-key" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Today_Admit_Card_Submit ;?></span> <span class="info-box-text">Today Admit Card Submit</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
		<div class="col-lg-4 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $Today_Job_Applied ;?></span> <span class="info-box-text">Today Job Applied</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
  
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    Copyright © 2018 <a href="developbd.net">DevelopBD</a> All rights reserved.</footer>
</div>
<!-- ./wrapper --> 

<!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script> 

<!-- Morris JavaScript --> 
<script src="dist/plugins/raphael/raphael-min.js"></script> 
<script src="dist/plugins/morris/morris.js"></script> 
<script src="dist/plugins/functions/dashboard1.js"></script>
</body>

<!-- Mirrored from uxliner.com/niche/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:35:09 GMT -->
</html>
