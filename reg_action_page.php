<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<?php 
session_start();

include 'db_connet.php';

if(isset($_POST['user_submit'])){


$name=$_POST['full_name'];
$gender=$_POST['gender'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$pass=$_POST['password'];



// get results from database
$sql="SELECT * FROM  my_profile_reg WHERE  Mobile = '$mobile'";
$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);

	if($row['Mobile'] == $mobile  ) {

	 $_SESSION['Mobile_Already_Use'] = "    Sorry!! Mobile Number is Already Use. Try e Another Mobile...";
		   
	 header("location: registration_form_user");

	} else{


			    $sql="INSERT INTO my_profile_reg(`Full_Name`,`Gender`, `Mobile`, `Email`, `Password`)
			    VALUES ('$name','$gender','$mobile','$email','$pass')";
				
																																	
					if (mysqli_query($conn, $sql)) {


						  header("location: index");

						   $_SESSION['succ_reg'] = "<b> Thank You </b> You have been successfully Registered";
						
					
					} else {
						
						header("location: registration_form");
						//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}

		}

}




if(isset($_POST['company_submit'])){


$name=$_POST['full_name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$pass=$_POST['password'];

$sql="INSERT INTO company_profile_reg(`Company_Name`, `Mobile`, `Email`, `Password`)
VALUES ('$name','$mobile','$email','$pass')";

																													
	if (mysqli_query($conn, $sql)) {


		  //sheader("location: index.php");
		echo "<script>
					// confirm

					$(document).ready(function()  {

						$.confirm({
							closeIcon: true,
					   		closeIconClass: 'fa fa-close',
							title: '<b> Thank You </b> You have been successfully Registered',
							content: 'Press ok to home page.',
							
					   		 buttons: {
					       	 ok: function(){
					            location.href = 'index';
					        	}
							}
						});
					});

			   </script>";


		
	
	} else {
		
		header("location: registration_form_company");
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

		

}


mysqli_close($conn); 

			 
		
		

	 


	?>