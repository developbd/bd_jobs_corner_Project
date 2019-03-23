
<?php 

session_start();


If(!isset($_SESSION['company_login_id'])){

header("location: company_login_form");

}else{


  include 'db_connet.php';

  $user_id = $_SESSION['company_login_id'];  

  $profile_sql = "SELECT * FROM company_profile WHERE Main_id =  $user_id  ";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $profile_result_row = mysqli_fetch_array($profile_result);



  if(empty($profile_result_row['Main_id'])){

    $profile_pic  ='demo_logo.jpg';
    $profile_name = 'User id '.$user_id;

  }else{

   $profile_pic   = $profile_result_row['Company_Photo'];
   $profile_name  = $profile_result_row['Company_Name'];


  }
  

    //Delete....

    if (isset($_GET['action']) && $_GET['action']=='delete'){

    $id  =  $_GET['id'];        

    $show_admin = "DELETE FROM post_jobs  WHERE id =$id ";  

    if(mysqli_query($conn, $show_admin)){

    header("location: manage_jobs");

    }

  }


//pagination.............

  if(isset($_GET['page']) & !empty($_GET['page'])){
  
  $page = $_GET["page"];

  } else {

  $page = 1;

  }




// for all job

  $per_page = 3;

  $start_from = ($page*$per_page)-$per_page;


  $pagesql  ="SELECT * FROM post_jobs WHERE Main_id = $user_id ";

  $pageres  = mysqli_query($conn, $pagesql);

  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres / $per_page);

  $startpage  = 1;

  $nextpage =   $page + 1;

  $previouspage =  $page - 1;

  $job_read_sql="SELECT * FROM  post_jobs WHERE Main_id = $user_id  LIMIT $start_from, $per_page ";

  $job_read_query = mysqli_query($conn,$job_read_sql);


  
  


}

?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>jobscorner</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

    <!-- Custom CSS -->
    <link href="css/Style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php  include('menu.php') ?>
   
<!------------ Dashboard Start ------------>
<section id="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
        <div class="canditate_area">

          <img src="Company_Profile/<?php echo $profile_pic ; ?>" alt="bdjobs"/>
          <h3><?php echo $profile_name; ?></h3>         
        </div>

				<div class="dashboard_menu">
					<ul>
						<li ><a href="company_profile">Company Profile</a></li>
						<li class="active"><a href="manage_jobs">Manage Jobs</a></li>
						<li ><a href="post_jobs">Post A Jobs</a></li>
						<li><a href="change_pass_company">Change Password</a></li>
						<li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					<h3>Manage Jobs:</h3>
					<div class="row">
						<div class="manage_jobs">

            <table>
              <tr>
              <th>Job Title</th>
              <th>Applications</th>
              <th>Status</th>
              <th>Action</th>
              </tr>

<?php 

 while( $job_details = mysqli_fetch_array($job_read_query)){

$today = date("Y-m-d ");
$date = $job_details['App_Deadline_Date'];

if ($date < $today) {

$job_status=" Expiary";

$css_class="status_deactive";

}else{

$job_status="Active";

$css_class="status_active";
  


}

$id = $job_details['id'];

$app_id="SELECT `my_profile_id` FROM `applied_job` WHERE `post_jobs_id`= $id ";

$app_query = mysqli_query($conn,$app_id);

$totalapp = mysqli_num_rows($app_query);

if($totalapp !=0){

  $app_number = $totalapp;
}else{

$app_number = 0;

}




?>
              <tr>
              <td>



                <h4><a href="job_view?id=<?php echo $id ;?> " target='_blank'  style="color:#88BEA3;"><?php echo $job_details['Job_Title'];?></a></h4>
                <div class="manage_area">
                  <div class="jobs_date">
                    <ul>
                      <li><i class="fa fa-calendar" aria-hidden="true"></i> Created: <span><?php echo $job_details['Job_Created_Date'];?></span></li>
                      <li><i class="fa fa-calendar" aria-hidden="true"></i> Expiry: <span><?php echo $job_details['App_Deadline_Date'];?></span></li>
                    </ul>
                  </div>
                  <div class="jobs_location">
                    <ul>
                      <li><i class="fa fa-map-marker" aria-hidden="true"> <?php echo $job_details['Job_Location'];?></i></li>
                    </ul>
                  </div>
                </div>
              </td>
              <td>
                <div class="total_application">
                  <a href="apply?job_id=<?php echo $job_details['id'] ?>"><?php echo $app_number ;?> Applications </a>
                </div>
              </td>
              <td>
                <div class="<?php echo $css_class; ?>">
                  <?php echo $job_status; ?>
                </div>
              </td>
              <td>
                <div class="action_control">
                  <ul>
                    <li><a href="job_view?id=<?php echo $id ;?>" target='_blank' ;style="color:#678667;"><i class="fa fa-eye" aria-hidden="true"  ></i></a></li>
              <!--      <li><a href="post_jobs.html" style="color:#008080;"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                    <li><a href="manage_jobs?action=delete&id=<?php echo $job_details['id']  ?>" onclick="return confirm('Are you sure you want to delete this item?'); " style="color:#FF0000;"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
              </td>
              </tr>                              
              
<?php   } ?>
            </table>



<!-- Show Pagination for Job ..........-->

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
				</div>
			</div>
		</div>
	</div>
</section>
<!------------ Dashboard End --------------->


<?php  include('footer.php') ?>
   

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

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
	 
	 //for counterup
        $(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
  
//for carosel
$('.carousel').carousel({
  interval: 2000
});
</script>
</body>

</html>
