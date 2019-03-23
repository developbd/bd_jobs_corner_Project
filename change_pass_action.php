<?php

session_start();

include("db_connet.php");


If(isset($_SESSION['company_login_id']) or isset($_POST['user_change_pass_submit']) ){

If(isset($_POST['company_change_pass_submit'])){

 
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];


  //Company Change password

  if(isset($_SESSION['company_login_id'])){
	

		$user_id = $_SESSION['company_login_id'];
		$sql = "SELECT Password FROM `company_profile_reg` WHERE `id`= '$user_id' ";
		$result = mysqli_query($conn, $sql);
	  $row = mysqli_fetch_array( $result);
    $select_oldpass =  $row['Password'];

   


  if($oldpass == $select_oldpass){

    $update_pass = "UPDATE  company_profile_reg SET `Password` = $newpass WHERE  `id`= $user_id";

    mysqli_query($conn, $update_pass) or die (mysqli_error($conn));

    $_SESSION['pass_set'] = "Password Upadte Successfully!!!!";

    header("location: change_pass_company");

    } else{

  	$_SESSION['pass_set'] = "Old password does not match!!!!";
  	header("location: change_pass_company");

    }
    
 
   } 


 }
  
// User password change

If(isset($_POST['user_change_pass_submit'])){

 
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];

  if(isset($_SESSION['user_login_id'])){
  

    $user_id = $_SESSION['user_login_id'];
    $sql = "SELECT Password FROM  my_profile_reg  WHERE `id`= '$user_id' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array( $result);
    $select_oldpass =  $row['Password'];

   


  if($oldpass == $select_oldpass){

    $update_pass = "UPDATE   my_profile_reg SET `Password` = $newpass WHERE  `id`= $user_id";

    mysqli_query($conn, $update_pass) or die (mysqli_error($conn));

    $_SESSION['pass_set'] = "Password Upadte Successfully!!!!";

    header("location: change_pass");

    } else{

    $_SESSION['pass_set'] = "Old password does not match!!!!";
    header("location: change_pass");

    }
    
 
   } 


  }

 }else{

  header("location: logout");

}    
   
 
?>