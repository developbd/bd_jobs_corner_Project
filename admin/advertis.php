<?php 
session_start();

if(!isset($_SESSION['super_admin'])) {   
      
     header("location: login");
  }

include "db_connet.php";
$page_class = 'advertisment';

   //profile

    $user_id = $_SESSION['super_admin'];  
    $Main_id = $user_id;

    $profile_quary = "SELECT * FROM `admin` WHERE  id = $user_id ";
    $profile_result= mysqli_query($conn, $profile_quary);
    $profile_row = mysqli_fetch_array($profile_result);
    $profile_name = $profile_row['Name'];
    $profile_pic = $profile_row['Photo'];


    // insert

 if (isset($_POST['Advertisment_Submit'])) {


    $Link        =   $_POST['Link'];
    $Create_Date =   date('YmdHis');

    $Image = $Main_id.'_advertisment_'.$Create_Date.basename( $_FILES['Image']['name']);


    $path_dir = "advertisment/";
    $path = $path_dir.$Image;


    $Data_Insert = "INSERT INTO advertisment (`Creator_id`,`Link`,`Image`,`Create_date`) VALUES ('$Main_id','$Link','$Image','$Create_Date')" ; 
               
                                                                                                      

    if(mysqli_query($conn, $Data_Insert)) {

      move_uploaded_file($_FILES["Image"]["tmp_name"], $path);

      header("location: advertis"); 
      
    }else {
       echo "Error: " . $Data_Insert . "<br>" . mysqli_error($conn);
     
   }

  }


    //Delete....

    if (isset($_GET['action']) && $_GET['action']=='delete'){

    $id  =  $_GET['id'];        

    $advertisment_delete = "DELETE FROM `advertisment` WHERE `id`=$id ";  

    if(mysqli_query($conn, $advertisment_delete)){


    header("location: advertis");

    } 

  }

  // Pagination.............

  if(isset($_GET['page']) & !empty($_GET['page'])){
  
  $page = $_GET["page"];

  } else {

  $page = 1;

  }


  $per_page =5;

  $start_from = ($page*$per_page)-$per_page;


  $pagesql  ="SELECT * FROM advertisment";

  $pageres  = mysqli_query($conn, $pagesql);

  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres / $per_page);

  $startpage  = 1;

  $nextpage =   $page + 1;

  $previouspage =  $page - 1;

  



   // Show Advertisment List

    $advertisment_quarye = "SELECT * FROM advertisment ORDER BY id DESC LIMIT $start_from, $per_page ";

    $advertisment_result = mysqli_query($conn,$advertisment_quarye);


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
      <h1>Site Settings</h1>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
		<li class="sub-bread"><i class="fa fa-angle-right"></i> Setting</li>
        <li><i class="fa fa-angle-right"></i> Advertisment</li>
      </ol>
    </section>
    
   <!-- Main content -->
    <section class="content">
    <form  id="Advertisment" name="Advertisment" action="" method="POST"  enctype="multipart/form-data"> 
  <div class="row">
		<div class="col-md-12 col-lg-12">
		<h4 class="adds_text">Make Your Advertisment</h4>
		</div>
        <div class="col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">				
				      <label>Adds Link</label>
				      <input class="form-control" id="basicInput" type="text"  name="Link" placeholder="http://">
            </div>
          </div>
        </div> 
		    <div class="col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
                <label for="input-file-now">Upload Adds Image (300 x 400)</label>
				        <input type="file" name="Image" id="Image" class="dropify" />         
            </div>
          </div>
        </div>
  		<div class="col-md-12 col-lg-12 m-t-3">
  			<input type="Submit" name="Advertisment_Submit" class="btn btn-lg btn-primary" value="Create">
  		</div>
  </div>
</form>
     
		
		<div class="row m-t-3">
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
                        <th>Image</th>
                        <th>Link</th>                        
                        <th>Control</th>
                        <th>Create Date</th>
                      </tr>
                    </thead>
                    <tbody class="ads_class">

<?php  while( $advertisment_row = mysqli_fetch_array($advertisment_result) ){  ?>
                      <tr>
                        <td> <?php echo $advertisment_row['id'] ; ?> </td>
                        <td><img src="advertisment/<?php echo $advertisment_row['Image'] ; ?>" class="img-circle img-w-30" alt="User Image"> </td>
                        <td><?php echo $advertisment_row['Link'] ; ?></td>
                        <td> 
                         <a href="advertis?action=delete&id=<?php echo $advertisment_row['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); "> <button type="button" class="btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                       <!--  <button type="button" class="btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                     -->  </td>
                        <td><?php echo $advertisment_row['Create_date'] ; ?></td>
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
    </section>
	
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

<!-- validation JavaScript --> 

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

$.validator.addMethod(
    "maxfilesize",
    function (value, element) {
        if (this.optional(element) || ! element.files || ! element.files[0]) {
            return true;
        } else {
            return element.files[0].size <= 1024 * 1024 ;
        }
    },
    'The file size can not exceed 1MB.'
);


$(function () {
  
  $("#Advertisment").validate({

    rules:{
    
      Link:{
        url: true,
        required:true,

      },

      Image:{
         required: true,
         accept:"jpg,png,jpeg,gif",
         maxfilesize: 1048576,
      },
  
      
    },

    messages:{

    }


  });



});



</script>

</body>

<!-- Mirrored from uxliner.com/niche/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:35:09 GMT -->
</html>
