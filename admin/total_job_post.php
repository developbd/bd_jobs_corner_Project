<?php

session_start();

      
if(!isset($_SESSION['super_admin'])) {   
      
   
       header("location: login");
 

  }

  $User_id = $_SESSION['super_admin'] ;
  include  "db_connet.php";

  $page_class = 'total_job_post';

    // Delete....

    if (isset($_GET['action']) && $_GET['action']=='delete'){

    $id  =  $_GET['id'];        

    $total_job_post = "DELETE FROM post_jobs WHERE id =$id ";  

      if(mysqli_query($conn, $total_job_post)){

      header("location: total_job_post");

      } 

    }


   // Pagination.............

  if(isset($_GET['page']) & !empty($_GET['page'])){
  
  $page = $_GET["page"];

  } else {

  $page = 1;

  }


  $per_page =10;

  $start_from = ($page*$per_page)-$per_page;


  $pagesql  ="SELECT * FROM post_jobs";

  $pageres  = mysqli_query($conn, $pagesql);

  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres / $per_page);

  $startpage  = 1;

  $nextpage =   $page + 1;

  $previouspage =  $page - 1;

  $total_job_post = $totalres ;


    // Total Cadndidate Show....

  $total_job_post_quary = "SELECT * FROM  post_jobs ORDER BY id  LIMIT $start_from, $per_page ";

  $total_job_post_result = mysqli_query($conn, $total_job_post_quary);
   



   
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
 <?php  include('menu.php') ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header sty-one">
      <h1>Total Job Post <?php echo $total_job_post ; ?></h1>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
		<li class="sub-bread"><i class="fa fa-angle-right"></i> Company</li>
        <li><i class="fa fa-angle-right"></i> Total Job Post</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          <div class="info-box">
            <div class="row">
              <div class="col-lg-12">
                <div class="box-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Job Type</th>
                        <th>Location</th>
                        <th>Recuirement</th>
                        <th>Control</th>
                        <th>Create Date</th>
                      </tr>
                    </thead>
                    <tbody>

              <?php  while($total_job_post_row = mysqli_fetch_array($total_job_post_result) ){  
              
                $id =$total_job_post_row['Main_id'];
                include  "db_connet.php";

                $company_profile_quarry = "SELECT * FROM company_profile  WHERE  Main_id = $id ";
                $company_profile_result = mysqli_query($conn, $company_profile_quarry);
                $company_profile_row = mysqli_fetch_array($company_profile_result);

             ?>
                      <tr>
                        <td><?php echo $total_job_post_row['id']; ?> </td>
                        <td><img src="../Company_Profile/<?php echo $company_profile_row ['Company_Photo']; ?>" class="img-circle img-w-30" alt="User Image">
                          <a href="../company_view?com_id=<?php echo $company_profile_row['id'] ?> " target='_blank'><?php echo $company_profile_row ['Company_Name']; ?></a></td>
                        <td><?php echo $total_job_post_row ['Job_Title'] ; ?></td>
                        <td><?php echo $total_job_post_row ['Job_Location'] ; ?></td>
                        <td><?php echo $total_job_post_row ['Qualification'] ; ?></td>
                        <td> <a href="total_job_post?action=delete&id=<?php echo $total_job_post_row['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); "><button type="button" class="btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a> </td>
                        <td><?php echo $total_job_post_row ['Job_Created_Date'] ; ?></td>
                      </tr>
                      
      <?php } ?>   
                    </tbody>                    
                  </table>
                  </div>

<nav aria-label="Page navigation">
  <ul class="pagination">

  <?php if($page != $startpage){ ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>

    <?php if($page >= 2){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>

    <?php if($page != $endpage){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>


  </ul>
</nav>

				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Main row --> 
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


</html>
