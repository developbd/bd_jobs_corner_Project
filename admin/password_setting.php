
<?php

session_start();

if(!isset($_SESSION['super_admin'])) {   
      
   
       header("location: login");

  }


include "db_connet.php";
$page_class = 'password_setting';

  $user_id = $_SESSION['super_admin'];

  If(isset($_POST['admin_change_pass_submit'])){


    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass']; 


    $sql = "SELECT Password FROM `admin` WHERE `id`= '$user_id' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array( $result);
    $select_oldpass =  $row['Password'];


    if($oldpass == $select_oldpass){

    $update_pass = " UPDATE admin SET `Password` = '$newpass' WHERE Password = '$oldpass' ";
    
    mysqli_query($conn, $update_pass) or die (mysqli_error($conn));

    header("location: password_setting");

     $_SESSION['pass_set'] = "Password Upadte Successfully!!!!";
    
    }else{

     $_SESSION['pass_set'] = "Old password does not match!!!!";

    header("location: password_setting");

    }
 
   }

  
   
 
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
      <h1>Password Setting</h1>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Setting</li>
        <li><i class="fa fa-angle-right"></i> Password Setting</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-6">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Change Password</h5>
             
            </div>
            <div class="card-body">
                <span style="color:red"> <?php 
                
                
                if(isset($_SESSION['pass_set'])){
                
                echo "<script>alert('{$_SESSION["pass_set"]}');</script>";
                
                unset($_SESSION['pass_set']);
                 
                } ?>
                
                
            </span><br><br>
              <form  name="admin_change_pass" action="" method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">Old Password</label>
                <input type="password" name="oldpass" class="form-control" id="exampleInputEmail1" placeholder="Old Password" required="">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="password" name="newpass" class="form-control" id="newpass" placeholder="New Password" required=""  maxlength="20" minlength="8" >
              </div>
			  <div class="form-group">
                <label for="exampleInputPassword1">Retype New Password</label>
                <input type="password" name="rnewpass" id="rnewpass" class="form-control" id="exampleInputPassword1" placeholder="Retype New Password" required="" maxlength="20" minlength="8">
              </div>
              <input type="submit" name="admin_change_pass_submit" class="btn btn-success" value="Change">
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    Copyright © 2018 <a href="devlopbd.net">DevelopBD</a> All rights reserved.</footer>
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

<script type="text/javascript">
  
//Machine password
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


</script>>
</body>

<!-- Mirrored from uxliner.com/niche/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:35:09 GMT -->
</html>
