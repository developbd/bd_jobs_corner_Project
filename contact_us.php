<?php

session_start(); 
include 'db_connet.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);  

    //Contact info.............
   
    $contact_quarye=" SELECT * FROM site_settings ";
    $contact_result = mysqli_query($conn,$contact_quarye);
    $contact_row = mysqli_fetch_array($contact_result);
    
    
    if(isset($_POST['submit'])){

    
    
    $Name=$_POST['Name'];
    
    $Email=$_POST['Email'];
    
    $Massage=$_POST['Massage'];
    
    $today_date    = date('Y-m-d H:i:s');
    
    
    $contact_insert="INSERT INTO contact_form (`Name`,`Email`,`Massage`,`Date`)
    
    VALUES ('$Name','$Email','$Massage','$today_date')";

	if (mysqli_query($conn, $contact_insert)) {
	    
	    
        try {
    	    
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        
                         
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
    
        $mail->Host = 'sg3plcpnl0213.prod.sin3.secureserver.net';
        $mail->Port = 587;
    
        // Enable SMTP authentication
    
        $mail->Username = 'support@bdjobscorner.com';                 // SMTP username
        $mail->Password = 'Monir@1981';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                 
    
        //Recipients
        $mail->setFrom($Email, $Name);
        //$mail->addAddress('support@bdjobscorner.com', 'bdjobscorner');     // Add a 
        $mail->addAddress('nbiswajit94@gmail.com', 'bdjobscorner'); 
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Contact Us';
        $mail->Body ="
            <html>
                <body>
                    <table style='width:600px;'>
                        <tbody>
                            <tr>
                                <td style='width:150px'><strong>Name: </strong></td>
                                <td style='width:400px'>$Name</td>
                            </tr>
                            <tr>
                                <td style='width:150px'><strong>Email ID: </strong></td>
                                <td style='width:400px'>$Email</td>
                            </tr>
    
                            <tr>
                                <td style='width:150px'><strong>Message: </strong></td>
                                <td style='width:400px'>$Massage</td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>
            
            ";
               if(!$mail->Send()) {
                // Message if mail has been sent
                echo "<script>
                    alert('Sent failed.');
                </script>";
            }
            else {
                // Message if mail has been not sent
                echo "<script>
                    alert('Message has been sent successfully.');
                    window.location.href = 'contact_us';
                </script>";
            }
     
     
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
		
    }else{

	    echo "Error: " . $contact_insert . "<br>" . mysqli_error($conn);

    }

mysqli_close($conn);
    

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

    <title>Contact Us</title>

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
	
	<style>
	
	
	.main {
    
    padding-top: 8%;
    padding-bottom: 8%;
    }

    .back h1 {
         color:#DA670F;
         text-align: justify;
    }
    .right_image{
        padding:4px;
        border: 1px solid #ccc!important
    }
    
    /* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 10px; /* Some padding */  
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.back {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
    
	</style>


</head>

<body>


<?php  include('menu.php'); ?>

<section id="registration-area">
  <div class="container">
      
    <div class="row main">
        <div class="col-md-8 col-sm-12 col-xs-24">
           
           
             <div class="back">
              <h1 >Contact US</h1>
              
              
             
  <form id="contact" name ="contact" action="" method="POST" >

    <label for="Name">Name</label>
    <input type="text" id="Name" name="Name" placeholder="Name.." required>

    <label for="Email">Email</label>
    <input type="text" id="Email" name="Email" placeholder="Your Email...." required >



    <label for="Massage">Massage</label>
    <textarea id="subject" name="Massage" placeholder="Write something.." style="height:140px" required ></textarea>
<br><br>
    <input type="submit" value="SEND" name="submit">

  </form>


             </div>

           
        </div><!----/.col---->
        <div class="col-md-4 col-sm-6 col-xs-12">
<img  class="right_image" src="images/contact.jpg"/>
        </div><!----
        <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="well"><img src="images/add-reg.jpg" alt="add"/></div>
         <div class="well"><img src="images/add-reg-2.jpg" alt="add"/></div>
        </div>--/.col---->
    </div><!---end row---->
  </div><!-------end container------->
</section><!---registration-area----->

<?php include'footer.php'?>
<!-- jQuery validate 1.13.0 -->



<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    

<!-- Bootstrap Core JavaScript -->


<script src="js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
 <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

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



   