<?php 
   session_start(); 
   include 'db_connet.php';
   
   
   if(isset($_POST['company_submit'])){
   
   
   $name=$_POST['full_name'];
   $mobile=$_POST['mobile'];
   $email=$_POST['email'];
   $pass=$_POST['password'];
   
   $sql="INSERT INTO company_profile_reg(`Company_Name`, `Mobile`, `Email`, `Password`)
   VALUES ('$name','$mobile','$email','$pass')";
   
                                                             
     if (mysqli_query($conn, $sql)) {
   
       echo "<script>
             
              // alert('Thank You You have been successfully Registered.');
               location.href = 'company_login_form';
   
            </script>";      
     
     } else {
       
       header("location: registration_form_company");
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
   
   }


    //Advertisment.............
   
    $Advertisment_quarye=" SELECT * FROM advertisment ORDER BY RAND() LIMIT 2 ";
    $Advertisment_result = mysqli_query($conn,$Advertisment_quarye);
    
    
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
      <title>Registration</title>
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/Style.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script language="JavaScript" type="text/javascript" src="js/jquery.validate.min.js"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
         .form-group{
         margin-bottom: 0px !important;
         }
         .set-min-height {
         min-height: 72px;
         }
         .set-min-height span {
         padding-left: 10px;
         font-size: 14px;
         font-style: italic;
         }
      </style>
      <script type="text/javascript">
         // live loade Number
         
         
         function checknumber()
         {
         var mobile=document.getElementById( "mobile" ).value;
         
         if(mobile)
         {
         $.ajax({
         type: 'post',
         url: 'inc/checkdata_company.php',
         data: {
          mobile:mobile,
         },
         success: function (response) {
          $( '#mobile_status' ).html(response);
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
         $( '#mobile_status' ).html("");
         return false;
         }
         }
         
         
         
         function checkemail(){
         var email=document.getElementById( "email" ).value;
         
         if(email)
         {
         $.ajax({
         type: 'post',
         url: 'inc/checkdata_company.php',
         data: {
          email:email,
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
         
         
         function checkall()
         {
         var mobilehtml=document.getElementById("mobile_status").innerHTML;
         var emailhtml=document.getElementById("email_status").innerHTML;
         
         if(  mobilehtml == "OK" && emailhtml == "OK")
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
   <body>
      <?php include('menu.php');?>
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
                              <form method="post" action="company_login_form" >
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-default">Login</button>
                                 </div>
                              </form>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!----/.col---->
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="registration-form">
                     <div class="user"><i class="fa fa-user" aria-hidden="true"></i></div>
                     <div class="registration-title">
                        <h2> Company Registration Now</h2>
                        <hr>
                     </div>
                     <form class="form-horizontal" enctype="multipart/form-data"  action="" id="frmFormMail" name="frmFormMail"  method="post"  onsubmit=" return checkall()" >
                        <div class="set-min-height">
                           <div class="form-group inputwith-icon">
                              <input type="text" class="form-control my-form-cntrl col-sm-9" id="name" name="full_name" placeholder="Company Name" required  >
                              <i class="fa fa-user" aria-hidden="true"></i>
                           </div>
                        </div>
                        <div class="set-min-height" >
                           <div class="form-group inputwith-icon">
                              <input type="text" class="form-control my-form-cntrl col-sm-9" id="mobile" name="mobile" placeholder="Mobile Number" required  minlength="11" maxlength="11" onkeyup="checknumber()">
                              <i class="fa fa-phone" aria-hidden="true"></i>
                           </div>
                           <span id="mobile_status"></span>
                        </div>
                        <div class="set-min-height">
                           <div class="form-group inputwith-icon">
                              <input type="email" class="form-control my-form-cntrl col-sm-9" id="email" name="email" placeholder="Email" required onkeyup="checkemail()" >
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                           </div>
                           <span id="email_status"></span>
                        </div>
                        <div class="set-min-height">
                           <div class="form-group inputwith-icon">
                              <input type="password" class="form-control my-form-cntrl col-sm-9" id="inputPassword" name="password" placeholder="Password" required=""  minlength="8"> 
                              <i class="fa fa-eye"  onclick="pass_show()" aria-hidden="true"></i>
                           </div>
                        </div>
                        <div class="set-min-height">
                           <div class="form-group inputwith-icon">
                              <input type="password" class="form-control my-form-cntrl col-sm-9" id="inputPassword1" name="confirm_password" placeholder="Confirm Password" required="" >
                              <i class="fa fa-eye" aria-hidden="true"></i> 
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="submit" name="company_submit" id="btn";" class="btn btn-default">Ragistration Now</button>
                        </div>
                     </form>
                  </div>
               </div>
               <!----/.col---->
               <div class="col-md-2 col-sm-3 col-xs-12">
                  <?php 
                     while($advertisment_row = mysqli_fetch_array($Advertisment_result)){
                     
                     ?>
                  <div class="well">
                     <a href="<?php echo $advertisment_row['Link']; ?> "><img src="admin/advertisment/<?php echo $advertisment_row['Image']; ?>" alt="add-3"/></a>
                  </div>
                  <?php    } ?>
               </div>
               <!----/.col---->
            </div>
            <!---end row---->
         </div>
         <!-------end container------->
      </section>
      <!---registration-area----->
      <?php include'footer.php'?>
      <!-- jQuery Version 1.11.0 -->
      <script src="js/jquery-2.2.4.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <script type="text/javascript">
         var password = document.getElementById("inputPassword")
           , confirm_password = document.getElementById("inputPassword1");
         
         function validatePassword(){
           if(password.value != confirm_password.value) {
             confirm_password.setCustomValidity("Passwords Don't Match");
           } else {
             confirm_password.setCustomValidity('');
           }
         }
         
         password.onchange = validatePassword;
         confirm_password.onkeyup = validatePassword;
           
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