<?php


if(!isset($_GET['admit_id'])){

header("location: admit_card");

}



// Include autoloader
require_once 'dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class
$dompdf = new Dompdf();
//---------------------------------------

  include 'db_connet.php';

   $admit_id = $_GET['admit_id']; 

   // Admit show............


    $admit_card_quary = "SELECT * FROM  admit_card WHERE id = $admit_id ";

    $admit_card_result = mysqli_query($conn,$admit_card_quary);

    $admit_card_row = mysqli_fetch_array($admit_card_result);

    $company_profile_id =  $admit_card_row ['company_profile_id'];

	$my_profile_id =  $admit_card_row ['my_profile_id'];



  	// My_profile show............


	 $my_profile_sql = "SELECT * FROM my_profile WHERE Main_id =  $my_profile_id  ";

	 $my_profile_result = mysqli_query($conn,$my_profile_sql);
	   
	 $my_profile_row = mysqli_fetch_array($my_profile_result);



  // Company show............


    $Company_quary = "SELECT * FROM  company_profile WHERE Main_id = $company_profile_id ";

    $Company_result = mysqli_query($conn,$Company_quary);

    $Company_row = mysqli_fetch_array($Company_result);

  
// Load HTML content

$Output='
	<style>


.head{
	padding-bottom:50px;

}

img.logo{

	height:100px;
	margin-left: 42%;

}

img.photo{

	height:200px;
	margin:5px;




}
.title{
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    color:red;
    text-align: center;
}
.admit{

    width: 100%;
    padding: 10px 0px;
    background-color: #666;
    display: block;
    color: #fff;
    font-size: 22px;
    text-align:center;
  

}

.section {
 	border: 1px solid #111;
	padding-bottom:30px;
}

 .left_section {
    border: 0px solid #111;
    width:80%;
   
    
   
}
 .left_section ul li {
    padding: 5px 0px;
    font-size: 18px;
    list-style: none; 
}

.left_section ul li span {
    width: 170px;
    display: inline-block;
}


.right_section{
	float:right;
	margin:5px;
	padding-top:-325px;

}

.right_section span{

	margin-right:50px;
}

.general{
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    color:red;
    text-align: center;
}


.applient_data{

	border: 1px solid #111;
	width:100%;
	
}

.title2{
	font-family: Barlow Semi Condensed - 400;
    border-collapse: collapse;
    width: 100%;
    background-color: #EEEEEE;
    color:#333333;
    text-align: center;
    padding:3px;
}

.applican_rules ul li {
   list-style-type: decimal;
   padding-bottom: 10px;
}

.sig{

	height:50px;
	margin-left: 42%;

}

div.page_break{
    page-break-before: always;
}
.page_break { width: 100%;}

.user_sig{

	height:50px;
	padding:5px;

}

.footer{
text-align: center;

}


</style>

<div class="head">

<img  class="logo" src="Company_Profile/'.$Company_row['Company_Photo'].'">

<h1 class="title">'.$Company_row['Company_Name'].'</h1>

<span class="admit">Admit Card</span>

</div>

<div class="section">

	<div class="left_section">
		<ul>
			<li><span>Admit No</span>:'.$admit_card_row['roll_number'].'</li>
			<li><span>Name</span>: '.$my_profile_row['First_Name']." ".$my_profile_row['Last_Name'].'</li>
			<li><span>Father Name</span>:'.$my_profile_row['Father_Name'].'</li>
			<li><span>Mother Name</span>:'.$my_profile_row['Mother_Name'].'</li>
			<li><span>Date Of Birth</span>:'.$my_profile_row['Date_of_Birth'].'</li>
			<li><span>Contact Mobile</span>:'. $my_profile_row['Mobile_No_1'].'</li>
			<li><span>National ID No</span>: '. $my_profile_row['National_Id_No'].'</li>
			<li><span>Gender</span>: '. $my_profile_row['Gender'].'</li>
			<li><span>Exam Venu</span>:'.$admit_card_row['exam_venu'].'</li>
			<li><span>Exam Time And Date</span>:'.$admit_card_row['exam_time_date'].'</li>
		</ul>
	</div>

	<div class="right_section">

		<img  class="photo" src= "photo/'.$my_profile_row['Photo'].'">

		<br><br>
		<img class="user_sig"  src= "photo/'.$my_profile_row['Signature'].'">

		<p>Applicant`s Signature</p>

	</div>

</div>
<div class="page_break"></div>
<br> <br>
<div class="applient_data">
	<div class="applican_rules">
	<h2 class="title2">General Instructions For applicants</h2>
		<ul>
			<li>This admit card will be applicable for written examination and viva voce.</li>
			<li>Applicant must carry this admit card during every examination.</li>
			<li>Applicant must sit in the examination hall at least 30 minutes prior to examination.</li>
			<li>Applicant is prohibited from bringing books, bag, mobile phone or any other type of communication device. Applicant can bring calculator but not scientific calculator.</li>
			<li>Applicant must use the same signature for application, attendance sheet and answer script.</li>
			<li>Applicant will not be allowed entry in the examination hall after distribution of the question paper for examination.</li>
			<li>Applicant must use black ink ball point pen to fill up all parts and circles of preliminary test answer sheet and top sheet of written answer script.</li>
			<li>Applicant is barred from entering the examination hall 15 minutes after the written examination starts.</li>
			<li>Applicant must report at least 30 minutes before the scheduled time for viva voce.</li>
			<li>In addition to his/her educational qualification and experience, an applicant must produce original copies of all necessary documents before the Viva Board.</li>
			<li>Invigilators in the examination hall will match the photograph of the applicant in the attendance sheet with that of the admit card before taking his/her
		    signature. Legal action will be taken against the applicant if any irregularity is detected.</li>
			<li>Applicant will be expelled if the general instructions are not followed or if found guilty of misconduct, misbehaviour or adopting unfair means. Applicant
		found guilty of copying, adopting any type of unfair means or misconduct will be barred from applying in any future examination conducted by the
		Commission and will not be allowed to apply for any other posts to be advertised by the Commission. Moreover, he/she may be handed over to the law
		enforcing agency for taking legal action against him/her.</li>
		</ul>
  	</div>

  <img class="sig" src= "Company_Profile/'.$Company_row['Author_Signature'].'">
  <p class="footer">Manger Of '.$Company_row['Company_Name'].'</p>

</div>



';


$dompdf->loadHtml($Output);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'protest');


// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Admit Card");


?>