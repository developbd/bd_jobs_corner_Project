<?php 
include 'db_connet.php';

      $site_settings_quary = "SELECT * FROM  site_settings ";
      $site_settings_result =mysqli_query($conn, $site_settings_quary);
      $site_settings_row = mysqli_fetch_array($site_settings_result);




?>	
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:500" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link href="css/Style.css" rel="stylesheet">
	<link href="css/jobsearch.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    
      <style>
         .hr { 
         width: 100% !important;
         height: 2px !important;
         background-color: #da670f!important;
         margin-top: 0px!important;
         margin-bottom: 2px!important;
         margin-left: 15px !important;
         } 
      </style>

      

<section id="my-menu">
  <nav class="navbar navbar-default">
  <div class="container">
  
	  <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand text-left" href="index"><div class="logo"><img src="admin/logo/<?php echo $site_settings_row ['Logo']; ?>" alt="logo"/></div></a>
      </div>
  
     <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
	
<?php

		try{
		$pdo = new PDO("mysql:host=148.66.147.11; dbname=bdjobs", 'jobscorner', '5471px?qhphk');
		}
		catch(PDOException $e){
		echo $e->getMessage();
		}
			$sql= "SELECT *FROM main_menu ORDER BY id ";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
		
	    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
	  
		$sub_sql = "SELECT *FROM sub_menu WHERE cat_id=:id";
		$sub_stmt = $pdo->prepare($sub_sql);
		$sub_stmt->bindParam(':id',$row->id,PDO::PARAM_INT);
		$sub_stmt->execute();
		
		?>
				
		<li class="<?php echo $row->cls;?>" ><a href="<?php echo $row->link;  ?>" > <?php echo $row->name;?></a>

		
		<?php
		
		
		if($sub_stmt->rowCount()){
		
		?>

					<ul class="dropdown-menu">

					<?php 
					while($sub_row = $sub_stmt->fetch(PDO::FETCH_OBJ)){
					
					?>
					<li> <a href="<?php echo $sub_row->href; ?>">  
					<?php echo $sub_row->sub_name; ?>
					</a>  
					</li>
				    <li role="separator" class="divider"></li>
				
					<?php
					}
					?>

					</ul>	
		
			<?php
			}
			?>
		
		</li>
		
		
		
			<?php
			

			}
			?>

			</li>
			<?php 


	if(isset($_SESSION['user_login_id'])){

	  $user_id = $_SESSION['user_login_id'];  
	  $profile_sql_reg = "SELECT * FROM  my_profile_reg WHERE id =  $user_id  ";
	  $profile_result_reg = mysqli_query($conn,$profile_sql_reg);
	  $profile_result_row_reg = mysqli_fetch_array($profile_result_reg);
	  $name = $profile_result_row_reg['Full_Name'];
	  $link_address = "my_profile";
	}
			  
	if(isset($_SESSION['company_login_id'])){

	  $user_id = $_SESSION['company_login_id'];  
	  $profile_sql_reg = "SELECT * FROM  company_profile_reg WHERE id =  $user_id  ";
	  $profile_result_reg = mysqli_query($conn,$profile_sql_reg);
	  $profile_result_row_reg = mysqli_fetch_array($profile_result_reg);
	  $name = $profile_result_row_reg['Company_Name'];
	  $link_address = "company_profile";
	}


		if( isset($_SESSION['company_login_id']) OR isset($_SESSION['user_login_id']) ){

?>
			<li class="dropdown active"> 
	
			 <span><a href="<?php echo $link_address; ?>"><?php echo $name; ?> </a>  &nbsp&nbsp <span style="color: #333"> || </span>&nbsp&nbsp <a href="logout"> Logout </a> </span>


          	</li>

          	 <?php

			}else{

			?>

			<li class="dropdown active">
          	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign in <span style="color:#000">&nbsp  or &nbsp</span> Create Account</a>
            
		   <ul class="dropdown-menu">


		   	<div class="row dropdown-sub-menu"  style="color: #d4d4d4">
				  <div class="col-sm-3 ola">

				  	<i class="fa fa-laptop " aria-hidden="true" style="font-size:30px; padding-top: 5px; color: #fff;"></i></div>

				  <div class="col-sm-9 menu"  ><span>My Bdjobs</span><br>
				  <p>Sign in or create your My Bdjobs account to manage your profile.</p>
				  <a href="user_login_form">Login</a>||<a href="registration_form_user">Registration </a>
				 </div>
				<hr class="hr" style="width: 110%;display:inline-block;">
				  <div class="col-sm-3 ola">

				  	<i class="fa fa-user " aria-hidden="true" style="font-size:30px; padding-top: 5px; color: #fff;"></i></div>

				  <div class="col-sm-9 menu"  ><span>Employers</span><br>
				  <p>Sign in or create account to find the best candidates in the fastest way</p>
				  <a href="company_login_form">Login</a>||<a href="registration_form_company">Registration </a>
				 </div>
			</div>

	
		   
        </ul>

			
			
			</li>
		<?php } 
		?>


		  

    </div><!-- /.navbar-collapse -->
	
  </div><!----- /.container----->

</nav>
</section><!---------end my-menu----------->	 