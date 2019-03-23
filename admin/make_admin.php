

<?php 
session_start();

if(!isset($_SESSION['super_admin'])) {   
      
   
       header("location: login");

  }


include 'db_connet.php';
$page_class = 'make_admin';


 if (isset($_POST['make_admin_submit'])) {

    $Name        =   $_POST['Name'];
    $Email       =   $_POST['Email'];
    $Password    =   $_POST['Password'];
    $User_Name   =   $_POST['User_Name'];
    $Contact     =   $_POST['Contact_number'];

    $Create_Date    = date('YmdHis');

    $user_id = $_SESSION['super_admin'];  

    $Photo = $user_id.'_photo_'.$Create_Date.basename( $_FILES['Photo']['name']);


    $path_dir = "photo/";
    $path = $path_dir.$Photo;




      $Data_Insert = "INSERT INTO admin (`Creator_id`,`Name`,`Email`,`User_Name`,`Mobile`,`Password`,`Photo`,`Create_Date`) VALUES ('$user_id','$Name','$Email','$User_Name','$Contact','$Password','$Photo','$Create_Date')" ; 
               
                                                                                                      

    if(mysqli_query($conn, $Data_Insert)) {

      move_uploaded_file($_FILES["Photo"]["tmp_name"], $path);
      echo "<script>alert('You have  successfully make new admin!!')</script>";
    //  header("location: make_admin.php"); 
      
    }else {
       echo "Error: " . $Data_Insert . "<br>" . mysqli_error($conn);
       header("location: make_admin");
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
<style type="text/css">
  .form-group {
    margin-bottom: 8px;
}
.col-md-6{

  min-height: 95px;
}


</style>
<script type="text/javascript">
   // live loade Number
   
   // User Name

   function checkuser_name()
   {
   var User_Name=document.getElementById( "User_Name" ).value;
   
   if(User_Name)
   {
   $.ajax({
   type: 'post',
   url: 'checkdata_admin.php',
   data: {
    User_Name:User_Name,
   },
   success: function (response) {
    $( '#User_Name_status' ).html(response);
    if(response=="OK") 
    {
     return true;  
    }
    else
    {
     return false; 
    }
   }
   });
   }
   else
   {
   $( '#User_Name_status' ).html("");
   return false;
   }
   }
   
   //Email
    function checkemail(){
   var Email=document.getElementById( "Email" ).value;
   
   if(Email)
   {
   $.ajax({
   type: 'post',
   url: 'checkdata_admin.php',
   data: {
    Email:Email,
   },
   success: function (response) {
    $( '#email_status' ).html(response);
    if(response=="OK") 
    {
     return true;  
    }
    else
    {
     return false; 
    }
   }
   });
   }
   else
   {
   $( '#email_status' ).html("");
   return false;
   }
   }
   

   //Number
   
   function checknumber(){
   var Contact_number=document.getElementById( "Contact_number" ).value;
   
   if(Contact_number)
   {
   $.ajax({
   type: 'post',
   url: 'checkdata_admin.php',
   data: {
    Contact_number:Contact_number,
   },
   success: function (response) {
    $( '#number_status' ).html(response);
    if(response=="OK") 
    {
     return true;  
    }
    else
    {
     return false; 
    }
   }
   });
   }
   else
   {
   $( '#number_status' ).html("");
   return false;
   }
   }
   
   
   function checkall()
   {
   var usernamestatus=document.getElementById("User_Name_status").innerHTML;
   var emailhtml=document.getElementById("email_status").innerHTML;
   var numberhtml=document.getElementById("number_status").innerHTML;
   
   if(  usernamestatus == "OK" && emailhtml == "OK" && numberhtml == "OK")
   {
   return true;
   }
   else
   {
   return false;
   }
   }
   
</script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
  
 <?php include('menu.php');   ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header sty-one">
      <h1>Make An Admin</h1>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
		<li class="sub-bread"><i class="fa fa-angle-right"></i> Setting</li>
        <li><i class="fa fa-angle-right"></i> Make Admin</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">      
      <div class="row m-t-3">
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Make A New Admin</h5>
            </div>
            <div class="card-body">
              
              <form id="make_admin" name="make_admin" action="" method="POST"  onsubmit=" return checkall()" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">Name</label>
                    <input class="form-control" placeholder="First Name" type="text" name="Name" required="">
                    <span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">User Name</label>
                    <input class="form-control" placeholder="User Name" type="text" name="User_Name" id="User_Name" required="" onkeyup="checkuser_name()">
                    <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                    <span id="User_Name_status" style="font-size: 10px; "></span> </div>
                </div>
				
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">E-mail</label>
                    <input class="form-control" placeholder="E-mail" type="Email" id="Email" name="Email" required="" onkeyup="checkemail()">
                    <span class="fa fa-envelope-o form-control-feedback" aria-hidden="true"></span>
                    <span id="email_status" style="font-size: 10px; "></span> </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">Contact Number</label>
                    <input class="form-control" placeholder="Contact Number" type="text" name="Contact_number" id="Contact_number" required=""  onkeyup="checknumber()" >
                    <span class="fa fa-phone form-control-feedback" aria-hidden="true"></span>
                    <span id="number_status" style="font-size: 10px; "></span> </div>
                </div>				
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">Password</label>
                    <input class="form-control" placeholder="Password" type="password" id="Password" name="Password" required="" maxlength="20" minlength="8">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                    <label class="control-label">Re-Enter Password</label>
                    <input class="form-control" placeholder="Re-Enter Password" type="password" name="rPassword"  id="rPassword" required="" maxlength="20" minlength="8">
                 </div>
                </div> 
                   <div class="col-md-2">
                  <div class="form-group has-feedback">
                    <label >
                      <h5>Upload Image :</h5>
                      </label>
                  </div>
                </div>

                <div class="col-md-10">
                  <div class="form-group has-feedback">
                    <label class="custom-file center-block block">
                      <input id="file" type="file" name="Photo">
                      </label>
                  </div>
                </div>
                <div class="col-md-12">
                  <input name="make_admin_submit" type="submit" class="btn btn-success" value="Create" >
                </div>
                 </div>
              </form>
           
            </div>
          </div>
        </div>
      </div>
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
<script type="text/javascript">
  //Machine password

 var password = document.getElementById("Password")
  , confirm_password = document.getElementById("rPassword");

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

<!-- template --> 
<script src="dist/js/niche.js"></script> 

<!-- Morris JavaScript --> 
<script src="dist/plugins/raphael/raphael-min.js"></script> 
<script src="dist/plugins/morris/morris.js"></script> 
<script src="dist/plugins/functions/dashboard1.js"></script>
</body>

<!-- Mirrored from uxliner.com/niche/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:35:09 GMT -->
</html>
