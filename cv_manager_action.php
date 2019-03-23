<?php

session_start();

include 'db_connet.php';







$user = $_SESSION['user_login_id'];


$Main_id = $user;

$date    = date('YmdHis');

$CV_id = $Main_id.$date.basename( $_FILES['imageFile']['name']);


$path_dir = "cv_list/";
$path = $path_dir.$CV_id;
          

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {

        $_SESSION['cv_error'] =  "File is not an image.";
        header("location: cv_manager");
        $uploadOk = 0;
    }
}*/
// Check if file already exists
if (file_exists($path)) {

    $_SESSION['cv_error'] =  "Sorry, file already exists.";
    header("location: cv_manager");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["imageFile"]["size"] > 1000000) {

    $_SESSION['cv_error'] =  "Sorry, your file is too large.";
    header("location: cv_manager");
    $uploadOk = 0;
}
// Allow certain file formats 
/*
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "PDF" && $imageFileType != "doc" && $imageFileType != "docx") {

    $_SESSION['cv_error'] =  "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
    header("location: cv_manager");
    $uploadOk = 0;

}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

   $_SESSION['cv_error'] =  "Sorry, your file was not uploaded.";
    header("location: cv_manager");

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $path)) {
     //   echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";



     $Data_insert="INSERT INTO   cv_list (`Main_id`, `CV_id`) VALUES ('$Main_id', '$CV_id')";

    if (mysqli_query($conn, $Data_insert)) {

           
         //move_uploaded_file($_FILES['imageFile']['tmp_name'], $path) ;
      $_SESSION['cv_error'] =  "Your file has been successfully uploaded!!";

          
      header("location: cv_manager");
      
    } else {

      $_SESSION['cv_error'] =  "Error: " . $Data_insert . "<br>" . mysqli_error($conn);

      header("location: cv_manager");
    }







    } else {

        $_SESSION['cv_error'] =  "Sorry, there was an error uploading your file.";

       header("location: cv_manager");
    }
}




mysqli_close($conn);


?>