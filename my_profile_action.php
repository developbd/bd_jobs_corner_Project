<?php 

if(isset($_POST['submit'])){

session_start();

$First_Name=$_POST['txtFirstName'];

$Last_Name=$_POST['txtLastName'];

$Father_Name=$_POST['txtFName'];

$Mother_Name=$_POST['txtMName'];

$Date_of_Birth=$_POST['txtBirthDate'];

$Age=$_POST['txtAge'];

$Gender=$_POST['cboGender'];

$Religion =$_POST['cboReligion'];

$Marital_Status =$_POST['cboMStatus'];

$Nationality =$_POST['cboNationality'];

$National_Id_No=$_POST['txtNationalId'];

$Present_Address =$_POST['txtPresentAdd'];

$Permanent_Address=$_POST['txtPermanentAdd'];

$Current_Location =$_POST['cboLocation'];

$Mobile_No_1=$_POST['txtMobile1'];

$Mobile_No_2=$_POST['txtMobile2'];

$Email=$_POST['txtEmail1'];

$Alternate_Email=$_POST['txtEmail2'];


include 'db_connet.php';


$user_id = $_SESSION['user_login_id'];

$Main_id_my_profile    = $user_id ; 

$date    = date('YmdHis');
$today_date = date('Y-m-d') ;

$my_profile_pic = $Main_id_my_profile.'_photo_'.$date.basename( $_FILES['imageFile']['name']);
$my_profile_Signature = $Main_id_my_profile.'_signature_'.$date.basename( $_FILES['Signature']['name']);

$path_dir = "photo/";
$path = $path_dir.$my_profile_pic;
$path_sig = $path_dir.$my_profile_Signature;





$Data_insert="INSERT INTO  my_profile (`Main_id`,`First_Name`,`Last_Name`,`Father_Name`,`Mother_Name`,`Date_of_Birth`,`Age`, `Gender`,`Religion`, `Marital_Status`,
 `Nationality`, `National_Id_No`, `Present_Address`,`Permanent_Address`,`Current_Location`,`Mobile_No_1`, `Mobile_No_2`, `Email`, `Alternate_Email`,`Photo`, `Signature`,`Reg_date`)
 VALUES ('$Main_id_my_profile','$First_Name','$Last_Name','$Father_Name','$Mother_Name','$Date_of_Birth','$Age','$Gender','$Religion','$Marital_Status',
 '$Nationality','$National_Id_No','$Present_Address','$Permanent_Address','$Current_Location','$Mobile_No_1','$Mobile_No_2','$Email','$Alternate_Email','$my_profile_pic','$my_profile_Signature','$today_date')";

	if (mysqli_query($conn, $Data_insert)) {

			move_uploaded_file($_FILES['imageFile']['tmp_name'], $path) ;
			move_uploaded_file($_FILES['Signature']['tmp_name'], $path_sig) ;
			header("location: my_profile"); 

			
		
	} else {

	    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);

	}

mysqli_close($conn);

}elseif (isset($_POST['update_submit'])) {

session_start();
	

$First_Name=$_POST['txtFirstName'];

$Last_Name=$_POST['txtLastName'];

$Father_Name=$_POST['txtFName'];

$Mother_Name=$_POST['txtMName'];

$Date_of_Birth=$_POST['txtBirthDate'];

$Age=$_POST['txtAge'];

$Gender=$_POST['cboGender'];

$Religion =$_POST['cboReligion'];

$Marital_Status =$_POST['cboMStatus'];

$Nationality =$_POST['cboNationality'];

$National_Id_No=$_POST['txtNationalId'];

$Present_Address =$_POST['txtPresentAdd'];

$Permanent_Address=$_POST['txtPermanentAdd'];

$Current_Location =$_POST['cboLocation'];

$Mobile_No_1=$_POST['txtMobile1'];

$Mobile_No_2=$_POST['txtMobile2'];

$Email=$_POST['txtEmail1'];

$Alternate_Email=$_POST['txtEmail2'];

$old_profile_pic = $_POST['old_imageFile'];

$old_Signature = $_POST['old_signature'];



include 'db_connet.php';




$user_id = $_SESSION['user_login_id'];

$Main_id_my_profile    = $user_id ; 

$date    = date('YmdHis');
$today_date = date('Y-m-d') ;


    if(($_FILES['update_imageFile']['tmp_name']) !=""){
    
        $my_profile_pic = $Main_id_my_profile.'_photo_'.$date.basename( $_FILES['update_imageFile']['name']);
    }else{
        
        $my_profile_pic = $old_profile_pic;
    }


    if(($_FILES['update_signature']['tmp_name']) !=""){
    
        $my_profile_Signature = $Main_id_my_profile.'_signature_'.$date.basename( $_FILES['update_signature']['name']);
        
        //unlink("photo/$old_Signature");
    
    }else{
        $my_profile_Signature = $old_Signature;
    }



$path_dir = "photo/";
$path = $path_dir.$my_profile_pic;
$path_sig = $path_dir.$my_profile_Signature;





$Data_insert= " UPDATE  my_profile SET

`First_Name` = '$First_Name', 
`Last_Name` = '$Last_Name', 
`Father_Name` = '$Father_Name', 
`Mother_Name` = '$Mother_Name', 
`Date_of_Birth` = '$Date_of_Birth',
`Age`= '$Age', `Gender` = '$Gender',
`Religion` = '$Religion',
`Marital_Status` = '$Marital_Status',
`Nationality` = '$Nationality',
`National_Id_No` = '$National_Id_No',
`Present_Address`= '$Present_Address',
`Permanent_Address`= '$Permanent_Address',
`Current_Location` = '$Current_Location',
`Mobile_No_1`= '$Mobile_No_1',
`Mobile_No_2`= '$Mobile_No_2',
`Email` = '$Email',
`Alternate_Email` = '$Alternate_Email',
`Photo` = '$my_profile_pic',
`Signature` = '$my_profile_Signature',
`Reg_date`='$today_date'

WHERE  `Main_id` = '$user_id' " ;

	if (mysqli_query($conn, $Data_insert)) {
	    

			move_uploaded_file($_FILES['update_imageFile']['tmp_name'], $path) ;
			move_uploaded_file($_FILES['update_signature']['tmp_name'], $path_sig) ;
			header("location: my_profile"); 
			

	} else {

	    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);

	}





}




else{

header("location: index"); 

}

	?>