<?php

session_start();

include 'db_connet.php';



if (isset($_GET['action']) && $_GET['action']=='delete'){

$id  =  $_GET['id'];				

$my_resume_education_delete = "DELETE FROM `my_resume` WHERE `id`=$id ";	

if(mysqli_query($conn, $my_resume_education_delete)){


header("location: resume.php");

}	





}


// Eduction


if (isset($_POST['add_education'])) {

$Degree_Name	 	= 	$_POST['Degree_Name'];
$From_Date		 	=	$_POST['From_Date'];
$To_Date 			=	$_POST['To_Date'];
$Institute_Name 	= 	$_POST['Institute_Name'];
$CGPA 				= 	$_POST['CGPA'];



$user_id  = $_SESSION['user_login_id']; 

$Main_id 	= $user_id ;

$Category	=  "Education";

	$my_resume_education_insert = "INSERT INTO  my_resume ( `Main_id`, `Category`, `Tittle`, `From_Date`, `To_Date`, `Institute_Name`, `CGPA`)  VALUES ('$Main_id', '$Category','$Degree_Name','$From_Date','$To_Date','$Institute_Name','$CGPA')";


	if (mysqli_query($conn, $my_resume_education_insert)) {

					header("location: resume.php");		
				
		} else {
								 
		echo "Error: " . $my_resume_education_insert . "<br>" . mysqli_error($conn);
					
		}

}



if(isset($_POST['Edit_eduction'])){


$Edit_eduction_id = $_POST['Edit_eduction_id'];

$Edit_Degree_Name = $_POST['Edit_Degree_Name'];
$Edit_From_Date	 =	$_POST['Edit_From_Date'];
$Edit_To_Date	 =	$_POST['Edit_To_Date'];
$Edit_Institute_Name = $_POST['Edit_Institute_Name'];
$Edit_CGPA	=		$_POST['Edit_CGPA'];

$Edit_eduction = "UPDATE my_resume SET `Tittle`= '$Edit_Degree_Name' ,`From_Date`= '$Edit_From_Date',`To_Date` = '$Edit_To_Date', `Institute_Name`= '$Edit_Institute_Name', `CGPA` = '$Edit_CGPA' WHERE id = '$Edit_eduction_id' ";

if (mysqli_query($conn, $Edit_eduction)) {
			
		header("Location: resume.php");	
			} else{	
					 //header("Location: fb.php");
				echo "Error: " . $Edit_eduction . "<br>" . mysqli_error($conn);
			}
}


// Experience


if (isset($_POST['Add_Experience'])) {

$Exp_Tittle	 		= 	$_POST['Exp_Tittle'];
$From_Date		 	=	$_POST['From_Date'];
$To_Date 			=	$_POST['To_Date'];
$Company_Name 		= 	$_POST['Company_Name'];
$CGPA 				= 	" ";


$user_id  = $_SESSION['user_login_id']; 

$Main_id 	= $user_id ; 

$Category		=  "Experience";

	$my_resume_experience_insert = "INSERT INTO  my_resume ( `Main_id`, `Category`, `Tittle`, `From_Date`, `To_Date`, `Institute_Name`, `CGPA`)  VALUES ('$Main_id', '$Category','$Exp_Tittle','$From_Date','$To_Date','$Company_Name','$CGPA')";


	if (mysqli_query($conn, $my_resume_experience_insert)) {

			header("location: resume.php");
							
			} else {
									 
				echo "Error: " . $my_resume_experience_insert . "<br>" . mysqli_error($conn);
			}

	}


if(isset($_POST['Edit_experience'])){


$Edit_experience_id = $_POST['Edit_experience_id'];

$Edit_Exp_Tittle = $_POST['Edit_Exp_Tittle'];
$Edit_From_Date	 =	$_POST['Edit_From_Date'];
$Edit_To_Date	 =	$_POST['Edit_To_Date'];
$Edit_Company_Name = $_POST['Edit_Company_Name'];



$Edit_experience = "UPDATE my_resume SET `Tittle`= '$Edit_Exp_Tittle' ,`From_Date`= '$Edit_From_Date',`To_Date` = '$Edit_To_Date', `Institute_Name`= '$Edit_Company_Name' WHERE id = '$Edit_experience_id' ";

	if (mysqli_query($conn, $Edit_experience)) {
						
			  header("Location: resume.php");	
		} else {

		//header("Location: fb.php");
		echo "Error: " . $Edit_experience . "<br>" . mysqli_error($conn);
	}

}



// Awards


if (isset($_POST['Add_awards'])) {

$Awards_Tittle	 	= 	$_POST['Awards_Tittle'];
$Year			 	=	$_POST['Year'];
$Organization 		=	$_POST['Organization'];
$To_Date 			= 	" ";
$CGPA 				= 	" ";


$user_id  = $_SESSION['user_login_id']; 

$Main_id 	= $user_id ;

$Category		=  "Awards";

	$my_resume_awards_insert = "INSERT INTO  my_resume ( `Main_id`, `Category`, `Tittle`, `From_Date`, `To_Date`, `Institute_Name`, `CGPA`)  VALUES ('$Main_id', '$Category','$Awards_Tittle','$Year','$To_Date','$Organization','$CGPA')";


	if (mysqli_query($conn, $my_resume_awards_insert)) {

			header("location: resume.php");			
					
		} else {
							 
			echo "Error: " . $my_resume_awards_insert . "<br>" . mysqli_error($conn);
		}

}



if(isset($_POST['Edit_awards'])){


$Edit_awards_id = $_POST['Edit_awards_id'];



$Edit_Awards_Tittle = $_POST['Edit_Awards_Tittle'];
$Edit_Year	 =	$_POST['Edit_Year'];
$Edit_Organization = $_POST['Edit_Organization'];


$Edit_awards = "UPDATE my_resume SET `Tittle`= '$Edit_Awards_Tittle' ,`From_Date`= '$Edit_Year', `Institute_Name`= '$Edit_Organization' WHERE id = '$Edit_awards_id' ";

	if (mysqli_query($conn, $Edit_awards)) {
						
			header("Location: resume.php");	
		} else {
						
			 //header("Location: fb.php");
			echo "Error: " . $Edit_awards . "<br>" . mysqli_error($conn);
		}

}

mysqli_close($conn); 




			
		


?>