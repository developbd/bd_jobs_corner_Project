<?php
include("db_connet.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_GET['type'])){
    
        
    $type = $_GET['type'];
    
    if($type == 'user'){
        $database_name= 'my_profile_reg';
        $location='user_login_form';
    }
    
    if($type == 'company'){
        $database_name= 'company_profile_reg';
        $location='company_login_form';
    }
    
    if($type == 'admin'){
        $database_name= 'admin';
        $location='admin/login';
    }
   
}   
    if(isset($_POST['get_password'])){
        
    $mobile = $_POST['moblie'];

    $sql = "SELECT * FROM $database_name  WHERE Mobile = '$mobile' ";
    
    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);
   
   	$row = mysqli_fetch_array($result);
   	
   	  if($count == 1){
       
        $mobile  = $row['Mobile'];
        
        $password  = $row['Password'];
        $email     = $row['Email'];
    
    
        $mail = new PHPMailer(true);             
        
        try {
            //Server settings
            
            $mail->SMTPDebug = 0;                        // Enable verbose debug output
            $mail->isSMTP();                             // Set mailer to use SMTP
            $mail->SMTPAuth = true;                    // Enable SMTP authentication
            $mail->Host = 'sg3plcpnl0213.prod.sin3.secureserver.net';
            $mail->Port = 587;
        
            // Enable SMTP authentication
        
            $mail->Username = 'support@bdjobscorner.com';     // SMTP username
            $mail->Password = 'Monir@1981';                   // SMTP password
            $mail->SMTPSecure = 'tls';                          
                                     
        
            //Recipients
            $mail->setFrom('support@bdjobscorner.com', 'bdjobscorner');
            $mail->addAddress($email, 'bdjobscorner');     // Add a 
        
        
            //Content
            $mail->isHTML(true);                       // Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->Body = "
                <html>
                    <body>
                        <table style='width:600px;'>
                            <tbody>
                                <tr>
                                <td style='width:150px'><strong>Mobile: </strong></td>
                                <td style='width:400px'>$mobile</td>
                                </tr>
                                <tr>
                                <td style='width:150px'><strong>Password: </strong></td>
                                 <td style='width:400px'>$password</td>
                                </tr>
                            </tbody>
                        </table>
                    </body>
                </html>
                ";
                
                // HTML Message Ends here
                 
                    if(!$mail->Send()) {
                        // Message if mail has been sent
                        echo "<script>
                            alert('sent failed.');
                        </script>";
                    }
                    else {
                        // Message if mail has been not sent
                        echo "<script>
                            alert('Password has been sent successfully on your registered email. Please check your email');
                            window.location.href='$location ';
                        </script>";
                    }
        
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            
   	  }else{
   	      
   	     echo "<script>
   	     
                alert('Please! input your Correct information');
                        window.location.href='$location';    
               </script>";
   	  }   
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forget Password</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link href="css/Style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    
    


</head>

<body>


<?php
include('menu.php');
?>

                           
<section id="registration-area">
  <div class="container">
      
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="registration-form">
        <div class="registration-title">
        <h2>Enter Your Phone Number</h2>
         <hr>
    </div>
      

    <form class="form-horizontal" method="POST" action="">
        <div class="form-group inputwith-icon">
             <input type="text" class="form-control my-form-cntrl col-sm-9" id="phone" name="moblie" placeholder="Mobile Number">
             <i class="fa fa-phone" aria-hidden="true"></i>
        </div>
     
         <div class="form-group">
              <button type="submit" class="btn btn-primary" name="get_password" > Get Password</button>
         </div>
    </form>



         </div>
        </div>
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
     
     
</body>

</html>