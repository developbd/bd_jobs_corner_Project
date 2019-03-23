<?php


session_start(); 

$Type_of_user="";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link href="css/Style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
	<script language="JavaScript" type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>




</head>

<body>
<?php include('menu.php');

	

	
	?>
	
	<?php if($Type_of_user == "Super Admin"){ ?>
<?php




// since this form is used multiple times in this file, I have made it a function that is easily reusable


function renderForm($gid, $email, $error)

{

?>




<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>

<section id="registration-area">
  <div class="container">
      
    <div class="row">
        
        <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="registration-form">
         <div class="user"><i class="fa fa-user" aria-hidden="true"></i></div>
         <div class="registration-title">
        <h2>Update</h2>
        <hr>
      </div>
     <form class="form-horizontal" action="" id="frmFormMail" name="frmFormMail"  method="post">
      <input type="hidden" name="id" value="<?php echo $gid; ?>"/>

   <div class="form-group inputwith-icon">
      <input type="text" class="form-control my-form-cntrl col-sm-9" id="email" name="email"  value="<?php echo $email; ?>" placeholder="email">
       <i class="fa fa-user" aria-hidden="true"></i>
	   
  </div>
  
        


  <div class="form-group">
      <button type="submit" name="mail_update" id="btn" class="btn btn-default">Update Now</button>
  </div>
</form>
         </div>
      
    </div><!---end row---->
  </div><!-------end container------->
</section><!---registration-area----->


</body>

</html>

<?php
}

// connect to the database

include('Db_connet.php');


// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['mail_update']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id']; 
$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));



// check that firstname/lastname fields are both filled in

if ($email == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($gid, $email, $error);

}

else

{

// save the data to the database

$sql = "UPDATE mail_list SET Email ='$email' WHERE id ='$id'";

mysqli_query($conn, $sql)
or die(mysqli_error($conn));


// once saved, redirect back to the view page

header("Location: email_subscribe_view.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{


// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$gid = $_GET['id'];
$sql = "SELECT * FROM  mail_list WHERE id = $gid";
$result = mysqli_query($conn, $sql);

mysqli_error($conn);

$row = mysqli_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{

// get data from db

$email = $row['Email'];



// show form

renderForm($gid, $email,'');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}


?>


<?php } else{  ?>
 
<h2 style="padding:6%"><a href="Login_form.php" >Place Login and Try Again</a> &nbsp  </h2>

<?php   } ?>


<?php include('footer.php')?>
