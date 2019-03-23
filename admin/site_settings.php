<?php 
session_start();

if(!isset($_SESSION['super_admin'])) {   
      
   
       header("location: login");

  }


include 'db_connet.php';
$page_class = 'site_settings';


   //profile

      $user_id = $_SESSION['super_admin'];  
      $Main_id = $user_id;

      $profile_quary = "SELECT * FROM `admin` WHERE  id = $user_id ";
      $profile_result= mysqli_query($conn, $profile_quary);
      $profile_row = mysqli_fetch_array($profile_result);
      $profile_name = $profile_row['Name'];
      $profile_pic = $profile_row['Photo'];


      $site_settings_quary = "SELECT * FROM  site_settings ";
      $site_settings_result =mysqli_query($conn, $site_settings_quary);
      $site_settings_row = mysqli_fetch_array($site_settings_result);





      if (isset($_POST['site_settings_submit'])) {


       if(empty($_FILES['Logo']['tmp_name'])) {
         $Site_logo= $site_settings_row['Logo'];
       }else{


      $date    = date('YmdHis');

     $Site_logo = 'Site_logo_'.$date.basename( $_FILES['Logo']['name']);


       }


       if(empty($_POST["About"])){
         $About=$site_settings_row['About'];
       }else{
         $About = mysqli_real_escape_string($conn, $_POST['About']);
       }
       
        if(empty($_POST["News"])){
         $News=$site_settings_row['News'];
       }else{
         $News = mysqli_real_escape_string($conn, $_POST['News']);
       }

       if(empty($_POST["Address"])){
         $Address=$site_settings_row['Address'];
       }else{
         $Address=$_POST['Address'];
       }


      if(empty($_POST["Mobile_No"])){
         $Mobile_No=$site_settings_row['Mobile_No'];
       }else{
         $Mobile_No = $_POST['Mobile_No'];
       }

      if(empty($_POST["Email"])){
         $Email=$site_settings_row['Email'];
       }else{
         $Email=$_POST['Email'] ;
       }

      $path_dir = "logo/";
      $path = $path_dir.$Site_logo;

      $Data_Update = "UPDATE site_settings SET  `Logo` = '$Site_logo', `About` = '$About',`News` = '$News', `Address`= '$Address', `Mobile_No` = '$Mobile_No', `Email`= '$Email'" ; 
               
                                                                                                      

    if(mysqli_query($conn, $Data_Update)) {

       move_uploaded_file($_FILES["Logo"]["tmp_name"], $path);

     header("location: site_settings"); 
      
    }else {
       echo "Error: " . $Data_Update . "<br>" . mysqli_error($conn);
     
   }



}        
      
      
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
               <h1>Site Settings</h1>
               <ol class="breadcrumb">
                  <li><a href="index">Home</a></li>
                  <li class="sub-bread"><i class="fa fa-angle-right"></i> Setting</li>
                  <li><i class="fa fa-angle-right"></i> Site Settings</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">

    

                  <div class="col-lg-6 col-md-6">

                    <form class="form-horizontal" enctype="multipart/form-data"  action="" id="site_settings" name="site_settings"  method="post">

                     <div class="card">
                        <div class="card-body">
                           <h4 class="text-black">Upload Site Logo</h4>
                           <label for="input-file-now">upload your site logo. It will be add header and footer.</label>
                           <input type="file" name="Logo" id="input-file-now" class="dropify" />
                        </div>
                     </div>
                     <br>
                     <div class="card">
                        <div class="card-body">
                           <h4 class="text-black">Write About This Site</h4>
                           <label for="input-file-now">write your site about,that will show in your site.</label>
                           <fieldset class="form-group">          
                              <textarea name="About" class="form-control" id="placeTextarea" rows="3" placeholder="About"></textarea>
                           </fieldset>
                        </div>
                     </div>
                     <br>
                     
                    <div class="card">
                        <div class="card-body">
                           <h4 class="text-black">Latest Jobs News</h4>
                           <label for="input-file-now">write your latest news</label>
                           <fieldset class="form-group">          
                              <textarea name="News" class="form-control" id="placeTextarea" rows="3" placeholder="News"></textarea>
                           </fieldset>
                        </div>
                     </div>
                     <br>
                     
                     
                     <div class="card">
                        <div class="card-body">
                           <h4 class="text-black">Write Contact Information</h4>
                           <fieldset class="form-group">
                              <label>Address</label>
                              <input name="Address" class="form-control" id="basicInput" type="text" placeholder="Address">
                              <label>Mobile No</label>
                              <input name="Mobile_No" class="form-control" id="basicInput" type="text" placeholder="Mobile Number">
                              <label>Email Address</label>
                              <input name="Email" class="form-control" id="basicInput" type="email" placeholder="Email">
                           </fieldset>
                        </div>
                     </div>
                     <div class="control_area">
                        <input type="Submit"name="site_settings_submit" class="btn btn-lg btn-primary" value="Save" />
                        <input type="reset" class="btn btn-lg btn-secondary" value=" Cancel" />
                     </div>


                   </form>

                  </div>

                  <div class="col-lg-6 col-md-6">
                     <div class="card">
                        <div class="card-body">
                           <img src="logo/<?php  echo $site_settings_row ['Logo'];?>">            
                        </div>
                     </div>
                     <br>
                     <div class="card">
                        <div class="card-body">
                              <h4 class="text-black">About </h4>
                           <p><?php echo $site_settings_row ['About']; ?></p>
                        </div>
                     </div>
                     <br>
                     
                     <div class="card">
                        <div class="card-body">
                            <h4 class="text-black">News </h4>
                           <p><?php echo $site_settings_row ['News']; ?></p>
                        </div>
                     </div>
                     <br>
                     
                     <div class="card">
                        <div class="card-body">
                             <h4 class="text-black">Contact Information </h4>
                           <ul>
                              <li><span>Address: </span> <?php  echo $site_settings_row ['Address']; ?></li>
                              <li><span>Mobile No:</span> <?php  echo $site_settings_row ['Mobile_No']; ?></li>
                              <li><span>Email:</span><?php  echo $site_settings_row ['Email'];?></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            Copyright © 2018 <a href="developbd.net">DevelopBD</a> All rights reserved.
         </footer>
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