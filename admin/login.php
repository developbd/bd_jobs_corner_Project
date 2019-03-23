<?php

session_start();

if(isset($_POST['admin_login'])) {



   include  "db_connet.php";
      
    $User_name = mysqli_real_escape_string($conn,$_POST['user_name']);
    $Password = mysqli_real_escape_string($conn,$_POST['pass']); 
      
    $admin_sql = "SELECT id FROM admin WHERE (User_Name = '$User_name' OR Mobile = '$User_name' OR Email = '$User_name') AND Password = '$Password'";
    $admin_result = mysqli_query($conn,$admin_sql);
   
    $row = mysqli_fetch_array($admin_result,MYSQLI_ASSOC);
    
    $User_id  = $row['id'];
      
    $count = mysqli_num_rows($admin_result);
      
        // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($count == 1) {
     
      
     $_SESSION['super_admin'] = $User_id;
    
       
     header("location: index");

       //$loginsuss="You have login Successfully";  

    }else {
        
   $error = "Sorry!! Your Login Number or Password is invalid...";

   $_SESSION['error'] = $error ;
    
     
    }

    mysqli_close($conn);

  }




?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uxliner.com/niche/main/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jan 2018 19:36:56 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Jobs Corner Super Admin Login</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <h3 class="login-box-msg">Super Admin Sign In</h3>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" name="user_name" class="form-control sty1" placeholder="User Name or Email or Mobile Number">
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" id="pass" class="form-control sty1" placeholder="Password"><br>
        <input type="checkbox" onclick="pass_show()"> Show Password
 <br>
   <a href="../forgot_password?type=admin"class="btn btn-link"> Forgot password? </a>
      </div>
      <div>        
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <?php 

if(isset($_SESSION['error'])){
  
?>
<h5 style="color:red; padding-bottom: 30px;"><?php echo $_SESSION['error']?></h5>

<?php  
unset ($_SESSION['error']);

}    
         
   ?>
          <button type="submit" name="admin_login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script>

<script>
    function pass_show() {
      var x = document.getElementById("pass");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
</body>

</html>