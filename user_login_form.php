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

    <title>login form</title>

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
    
    


</head>

<body>


<?php
include('menu.php');
?>



                           
                           
<section id="registration-area">
  <div class="container">
      
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
           
           <div class="reg-leftsid">
             <div class="reg-left-title">
              <h3>Have Any Question Or Help?</h3>
              
              <p>If you need any help, Just contact us.We are always help you gladly.</p>
             </div>
             <div class="reg-title-social-icon">
              <ul>
              <li><i class="fa fa-map-marker" aria-hidden="true"></i>
              
              <strong>Bd Jobscorner</strong>
                           <br> <?php echo $contact_row['Address']; ?></span>
                           </li>
                           <li><i class="fa fa-phone" aria-hidden="true"></i>
                              <a href="tel:<?php echo $contact_row['Mobile_No']; ?>"><?php echo $contact_row['Mobile_No']; ?> </a>
                           </li>
                           <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $contact_row['Email']; ?>"><?php echo $contact_row['Email']; ?><a></li>
                           <li><i class="fa fa-globe" aria-hidden="true"></i><a href="http://bdjobscorner.com">Bdjobscorner.com</a></li>
                           <li><i class="fa fa-facebook" aria-hidden="true"></i>Monir Academy</li>
                           <li><i class="fa fa-youtube" aria-hidden="true"></i>
                              <span>https://www.youtube.com/<br>channel/UCXGMhpZXTyXJxSKZX_FXDtQ</span>
                           </li>
                  <li>
                  <form method="post" action="registration_form_user.php">
                  <div class="form-group">
                  
                 <button type="submit" class="btn btn-default">Registration Now</button>
                  </div>
                  
                  </form>
                  </li>
              </ul>
             </div>
           </div>
        </div><!----/.col---->
        <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="registration-form">
         <div class="user"><i class="fa fa-laptop" aria-hidden="true"></i></div>
         <div class="registration-title">
             
        <h2>User Login Here</h2>
          <hr>
      </div>
      

<form class="form-horizontal" method="Post" action="user_login_form_action.php">
  <div class="form-group inputwith-icon">
      <input type="text" class="form-control my-form-cntrl col-sm-9" id="phone" name="mobile" placeholder="Mobile Number">
      <i class="fa fa-user" aria-hidden="true"></i>
  </div>
  
  <div class="form-group inputwith-icon">
      <input type="password" class="form-control my-form-cntrl col-sm-9"  name="pass" id="inputPassword" value="" placeholder="Password">
      <span onclick="pass_show()"><i class="fa fa-eye" aria-hidden="true"></i></span>
  </div>

      
  <div class="form-group form-inline">
   <a href="forgot_password?type=user"class="btn btn-link"> Forgot password? </a>
  </div>
  
  

  
  <div class="form-group">
      <button type="submit" class="btn btn-default" >Login</button>
  </div>
</form>


<?php

if (isset($_SESSION['error'])) {
    
?>
<h4 style="color:red"><?php
    echo $_SESSION['error'];
?></h4>

<?php
    unset($_SESSION['error']);
    
}

?>



         </div>
        </div><!----
        <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="well"><img src="images/add-reg.jpg" alt="add"/></div>
         <div class="well"><img src="images/add-reg-2.jpg" alt="add"/></div>
        </div> col---->
    </div><!---end row---->
  </div><!-------end container------->
</section><!---registration-area----->

<?php
include 'footer.php';
?>


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
     
<script>
    function pass_show() {
      var x = document.getElementById("inputPassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
     
</body>
</html>