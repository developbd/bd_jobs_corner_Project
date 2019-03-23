<?php 


include 'db_connet.php';

// For admin 


if(isset($_POST['User_Name']))
{
 $user_name=$_POST['User_Name'];

 $user_name=" SELECT User_Name FROM admin WHERE User_Name = '$user_name' ";

 $query=mysqli_query($conn, $user_name);

 if(mysqli_num_rows($query)>0)
 {
  echo "User Name Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}





if(isset($_POST['Email']))
{
 $email=$_POST['Email'];

 $email=" SELECT Email FROM admin WHERE Email = '$email' ";

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


if(isset($_POST['Contact_number']))
{
 $cnumber=$_POST['Contact_number'];

 $cnumber=" SELECT Contact FROM admin WHERE Contact = '$cnumber' ";

 $query=mysqli_query($conn, $cnumber);

 if(mysqli_num_rows($query)>0)
 {
  echo "Contact Number Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}






?>

