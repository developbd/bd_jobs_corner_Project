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

    <title>Email Subscribe List </title>

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
	

	
	
	<?php  include('Menu.php'); ?>
</head>

<body>


<?php

include('Db_connet.php');

// get results from database
$sql="SELECT * FROM mail_list";
$result = mysqli_query($conn, $sql)

or die(mysqli_error($conn));


?>

	<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th, td {
		text-align: left;
		padding: 8px;
	}


	tr:nth-child(odd){background-color: #f2f2f2}

	th {
		background-color: #4CAF50;
		color: white;
	}

	tr:hover {background-color: #f5f5f5;}
	</style>
	
	<?php if($Type_of_user == "Super Admin" ){ ?>
	
	<h2><center>View Email Subscribe List</h2></center>
	
<table  border='1' cellpadding='10'>
	<thead>
	<tr class="row100 head">
	<th >ID</th>
	<th >Email</th>
	<th >Subscribe Date</th>
	<th colspan="2" > Action </th>
	</tr>
	</thead>
	
	<?php // loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array( $result )) { ?>
	<tbody>
	<tr >
	<td ><?php echo $row['id']?></td>
	<td ><?php echo $row['Email']?></td>
	<td ><?php echo $row['Subscribe_Date']?></td>

	<td><a href="Email_subscribe_edit.php?id=<?php echo $row['id']?>">Edit</a></td>
	<td><a href="Email_subscribe_delete.php?id=<?php echo $row['id']?>" onClick='return confirm("Are You sure to Delete Data...")'>Delete</a></td>

	
	
	</tr>

	</tbody>	
<?php }?>

</table>




 <?php }else{ $Type_of_user == "" ?>
 
 
 <h2 style="padding:6%"><a href="Login_form.php" >Place Login and Try Again</a> &nbsp  </h2>
 <?php } ?>
<br>
</body>

</html>


<?php include'footer.php'?>


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