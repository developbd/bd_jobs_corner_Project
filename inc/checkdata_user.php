<?php 


include '../db_connet.php';



// For User Reg

if(isset($_POST['mobile']))
{
 $mobile=$_POST['mobile'];

 $checkdata=" SELECT Mobile FROM my_profile_reg WHERE Mobile = '$mobile' ";

 $query=mysqli_query($conn, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "Mobile Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}


if(isset($_POST['email']))
{
 $email=$_POST['email'];

 $email=" SELECT Email FROM my_profile_reg WHERE Email = '$email' ";

 $query=mysqli_query($conn, $email);

 if(mysqli_num_rows($query)>0)
 {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}







?>

