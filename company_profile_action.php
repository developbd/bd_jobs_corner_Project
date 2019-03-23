<?php 

if(isset($_POST['submit'])){

session_start();


include 'db_connet.php';



$company_name=$_POST['company_name'];

$Phone=$_POST['Phone'];

$Category=$_POST['Category'];

$Email=$_POST['Email'];

$Website=$_POST['Website'];

$Found_Date=$_POST['Found_Date'];

$Description= mysqli_real_escape_string($conn, $_POST["Description"]);

$Region =$_POST['Region'];

$District =$_POST['District'];

$Full_Address =$_POST['Full_Address'];



$user_id = $_SESSION['company_login_id'];  

$Main_id_company_profile    = $user_id;

$date    = date('YmdHis');

$Company_Photo = $Main_id_company_profile.'_photo_'.$date.basename( $_FILES['Company_Photo']['name']);

$Author_Signature = $Main_id_company_profile."_signature_".$date.basename( $_FILES['Author_Signature']['name']);

$path_dir = "Company_Profile/";
$path = $path_dir.$Company_Photo;
$path_sig = $path_dir.$Author_Signature;


$insert_date    = date('YmdHis');

$Data_insert="INSERT INTO  company_profile (`Main_id`, `Company_Name`,`Email`,`Phone`,`Website`,`Category`,`Found_Date`, `Description`,`Region`, `District`, `Full_Address`, `Company_Photo`, `Author_Signature`, `Reg_date`)
 VALUES ('$Main_id_company_profile','$company_name','$Email','$Phone','$Website','$Category','$Found_Date','$Description','$Region','$District', '$Full_Address', '$Company_Photo', '$Author_Signature','$insert_date')";

if (mysqli_query($conn, $Data_insert)) {

 move_uploaded_file($_FILES["Company_Photo"]["tmp_name"], $path);
 move_uploaded_file($_FILES["Author_Signature"]["tmp_name"], $path_sig);

	
 header("location: company_profile"); 
	
} else {
    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


}elseif (isset($_POST['update_submit'])) {
	
	session_start();



include 'db_connet.php';


$company_name=$_POST['company_name'];

$Phone=$_POST['Phone'];

$Category=$_POST['Category'];

$Email=$_POST['Email'];

$Website=$_POST['Website'];

$Found_Date=$_POST['Found_Date'];

$Description= mysqli_real_escape_string($conn, $_POST["Description"]);

$Region =$_POST['Region'];

$District =$_POST['District'];

$Full_Address =$_POST['Full_Address'];

$old_Company_Photo =$_POST['old_Company_Photo'];

$old_Author_Signature =$_POST['old_Author_Signature'];

$user_id = $_SESSION['company_login_id'];  

$Main_id_company_profile    = $user_id;

$date    = date('YmdHis');



    if(($_FILES['update_Company_Photo']['tmp_name']) !=""){
    
        $Company_Photo = $Main_id_company_profile.'_photo_'.$date.basename( $_FILES['update_Company_Photo']['name']);
     
    }else{
        
        $Company_Photo = $old_Company_Photo;
    }


    if(($_FILES['update_Author_Signature']['tmp_name']) !=""){
    
      
       $Author_Signature = $Main_id_company_profile."_signature_".$date.basename( $_FILES['update_Author_Signature']['name']);
     
        //unlink("photo/$old_Signature");
    
    }else{
        $Author_Signature = $old_Author_Signature;
    }
    
    




$path_dir = "Company_Profile/";
$path = $path_dir.$Company_Photo;
$path_sig = $path_dir.$Author_Signature;


$insert_date    = date('YmdHis');


$Data_insert= " UPDATE  company_profile SET `Company_Name` = '$company_name' , `Email` = '$Email', `Phone` = '$Phone' , `Website` = '$Website', `Category` = '$Category',`Found_Date`= '$Found_Date', `Description` = '$Description',`Region` = '$Region', `District` = '$District', `Full_Address` = '$Full_Address', `Company_Photo` = '$Company_Photo', `Author_Signature`= '$Author_Signature', `Reg_date`= '$insert_date' WHERE  `Main_id` = '$user_id' " ;



if (mysqli_query($conn, $Data_insert)) {
    
 move_uploaded_file($_FILES["update_Company_Photo"]["tmp_name"], $path);
 move_uploaded_file($_FILES["update_Author_Signature"]["tmp_name"], $path_sig);

 header("location: company_profile"); 
	
} else {
    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


}




else{


 header("location: index"); 


}


?>