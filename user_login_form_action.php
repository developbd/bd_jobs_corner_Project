<?php
   session_start();

   include("db_connet.php");
  

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
 
    $myusername = mysqli_real_escape_string($conn,$_POST['mobile']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['pass']); 
      
    $sql = "SELECT id FROM my_profile_reg WHERE Mobile = '$myusername' and Password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
   
    

      
     $count = mysqli_num_rows($result);
      
        // If result matched $myusername and $mypassword, table row must be 1 row
		
		 if($count == 1) {
	 

			$row = mysqli_fetch_array($result);

			$userid = $row['id'];

			$_SESSION['user_login_id'] = $userid;
			
			header("location: my_profile");

			 //$loginsuss="You have login Successfully";	

		}else {
		  
		$error = "Sorry!! Your Login Number or Password is invalid...";
		$_SESSION['error'] = $error ;
		header("location: user_login_form");
		 
			 
		}
	}
   
?>
