<?php 

session_start();



if(!isset($_SESSION['user_login_id'])){

header("location: user_login_form");

}


  include("menu.php");
  include 'db_connet.php';

  $user_id = $_SESSION['user_login_id'];  



   // Pagination.............

  if(isset($_GET['page']) & !empty($_GET['page'])){
  
  $page = $_GET["page"];

  } else {

  $page = 1;

  }


  $per_page =5;

  $start_from = ($page*$per_page)-$per_page;


  $pagesql  ="SELECT * FROM admit_card WHERE my_profile_id = $user_id ";

  $pageres  = mysqli_query($conn, $pagesql);

  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres / $per_page);

  $startpage  = 1;

  $nextpage =   $page + 1;

  $previouspage =  $page - 1;

  $total_job_post = $totalres ;


  // My_profile show............


  $profile_sql = "SELECT  * FROM my_profile 
  JOIN my_resume  
  ON  my_profile.Main_id = my_resume.Main_id 
  WHERE my_profile.Main_id =  '$user_id'  
  AND  my_resume.Category =  'Education' 
  ORDER BY my_resume.id DESC  ";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $profile_result_row = mysqli_fetch_array($profile_result);




  if(empty($profile_result_row['Main_id'])){

    $profile_pic  ='demo_pic.png';
    $profile_Name = $name;
    $profile_title  = '';

  }else{

   $profile_pic   = $profile_result_row['Photo'];
   $profile_Name  = $profile_result_row['First_Name']." ".$profile_result_row['Last_Name'];
   $profile_title =  $profile_result_row['Tittle'];

  }




    $admit_card_quary = "SELECT * FROM  admit_card WHERE my_profile_id = $user_id  LIMIT $start_from, $per_page  ";

    $admit_card_result = mysqli_query($conn,$admit_card_quary);

  

  mysqli_close($conn);



?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>bdjobscorner</title>

    <!-- Bootstrap Core CSS -->
   
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>
<style type="text/css">
      .fa  {
      padding-top: 10px!important;
    }
</style>
<body>

<!------------ Dashboard Start ------------>
<section id="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
        
        <div class="canditate_area">
          <img src="photo/<?php echo  $profile_pic; ?>" alt="bdjobs"/>
          <h3><?php echo $profile_Name; ?></h3>
          <span><?php echo $profile_title; ?></span>
        </div>

				<div class="dashboard_menu">
					<ul>
						<li ><a href="my_profile">My Profile</a></li>
						<li><a href="resume">Resume</a></li>
						<li><a href="applied_jobs">Applied Jobs</a></li>
						<li><a href="cv_manager">CV And Acceroies</a></li>
                        <li class="active" ><a href="admit_card">Admit Card</a></li>
						<li><a href="change_pass">Change Password</a></li>
						<li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					

 <h3>Admit Card:</h3>   
 <br>   
					<div class="row">
		                                       
                  <div class="col-md-12">

     
      <div class="table-responsive">        
      <table id="example2" class="table table-bordered table-hover">
                   
          <thead>
                   
           <th>ID</th>
             <th>Job Title</th>
              <th>Company</th>
               <th>Roll</th>
                 <th>Exam Venu</th>
                   <th>Exam Time And Date</th>
              <th>Action</th>

          </thead>

      <tbody>


      <?php  while($admit_card_row = mysqli_fetch_array($admit_card_result) ){ 
      include  "db_connet.php";
      $company_id =  $admit_card_row['company_profile_id'] ;

      $company_quarry = "SELECT * FROM   post_jobs WHERE  Main_id = '$company_id'  ";
      $company_result = mysqli_query($conn, $company_quarry);
      $company_row = mysqli_fetch_array($company_result);


       ?>

        <tr>
        
        <td><?php echo $admit_card_row['id'] ; ?></td>
        <td><?php echo $company_row['Job_Title'] ; ?></td>
        <td><?php echo $company_row['Name_of_Company'] ; ?></td>
        <td><?php echo $admit_card_row['roll_number'] ; ?></td>
        <td><?php echo $admit_card_row['exam_venu'] ; ?></td>
        <td><?php echo $admit_card_row['exam_time_date'] ; ?></td>
        <td> 
                <div class="action_control">
                  <ul>
                    <li><a href="admit_card_view?admit_id=<?php echo $admit_card_row['id'] ?>" target="_blank" style="color:#678667;"><i class="fa fa-eye" aria-hidden="true"></i></a></li>

                    <li><a href="admit_card_download?admit_id=<?php echo $admit_card_row['id'] ?>" style="color:#FF0000;"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
        </td>
        </tr>
        
<?php } ;?>
       
   
      </tbody>
          
  </table>

    
      
  </div>
   
   
    <nav aria-label="Page navigation">
  <ul class="pagination">

  <?php if($page != $startpage){ ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>

    <?php if($page >= 2){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>

    <?php if($page != $endpage){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>


  </ul>
</nav>
  
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->



<?php include("footer.php"); ?>
  

<!-- jQuery validate 1.13.0 -->

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    

<!-- Bootstrap Core JavaScript -->


<script src="js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>


<script type="text/javascript">

   //for scrolltop
   $(window).scroll(function() {
     
     if ($(this).scrollTop() >150) {  
  $('.scrollup').fadeIn();
  } else{
    $('.scrollup').fadeOut();
    }
     
   });
   
   $('.scrollup').click(function (){  
     $("html, body").animate({
    scrollTop: 0
    }, 700);
     return false;
  
  });


</script>

</body>

</html>
