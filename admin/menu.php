
<?php

date_default_timezone_set("Asia/Bangkok");
include 'db_connet.php';


   //profile

    $user_id = $_SESSION['super_admin'];  
    $Main_id = $user_id;

    $profile_quary = "SELECT * FROM `admin` WHERE  id = $user_id ";
    $profile_result= mysqli_query($conn, $profile_quary);
    $profile_row = mysqli_fetch_array($profile_result);
    $profile_name = $profile_row['Name'];
    $profile_pic = $profile_row['Photo'];

mysqli_close($conn); 

?>


 <header class="main-header"> 
    <!-- Logo --> 
    <a href="index" class="logo blue-bg"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><img src="" alt=""></span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><img src="" alt=""></span> </a> 
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar blue-bg navbar-static-top"> 
      <!-- Sidebar toggle button-->
      <ul class="nav navbar-nav pull-left">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href="#"></a> </li>
      </ul>    
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">                    
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="photo/<?php echo $profile_pic ; ?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $profile_name ; ?></span> </a>
            
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="photo/<?php echo $profile_pic ; ?>" class="img-circle" alt="User Image"> </div>
        <div class="info">
          <p><?php echo $profile_name ; ?></p>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li> <a href="index"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <span class="pull-right-container"></span> </a>          
        </li>        
        <li class="<?php if($page_class=='total_candidate' OR $page_class=='total_applied' OR $page_class=='today_applied'){echo 'active treeview';}else{echo "treeview" ;}  ?> "> <a href="#"> <i class="fa fa-users" aria-hidden="true"></i> <span>Candidate</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li  class="<?php if($page_class=='total_candidate'){echo 'active';} ?>"  ><a href="total_candidate">Total Candidate</a></li>
            <li  class="<?php if($page_class=='total_applied'){echo 'active';} ?>"  ><a href="total_applied">Total Applied</a></li>
			      <li  class="<?php if($page_class=='today_applied'){echo 'active';} ?>"  ><a href="today_applied">Today Applied</a></li>
          </ul>
        </li>


        <li class="<?php if($page_class=='total_company' OR $page_class=='total_job_post' OR $page_class=='today_job_post' OR $page_class=='total_admit_card' OR $page_class=='today_admit_card' ){echo 'active treeview';}else{echo "treeview" ;}  ?> "> <a href="#"> <i class="fa fa-building-o" aria-hidden="true"></i> <span>Company</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li class="<?php if($page_class=='total_company'){echo 'active';} ?>" ><a href="total_company">Total Company</a></li>
            <li class="<?php if($page_class=='total_job_post'){echo 'active';} ?>" ><a href="total_job_post">Total Job Post</a></li>
			      <li class="<?php if($page_class=='today_job_post'){echo 'active';} ?>" ><a href="today_job_post">Today Job Post</a></li>
		      	<li class="<?php if($page_class=='total_admit_card'){echo 'active';} ?>" ><a href="total_admit_card">Total Admitcard Submit</a></li>
		      	<li class="<?php if($page_class=='today_admit_card'){echo 'active';} ?>" ><a href="today_admit_card">Today Admitcard Submit</a></li>
          </ul>
        </li>
		<li class="<?php if($page_class=='advertisment' OR $page_class=='password_setting' OR $page_class=='make_admin' OR $page_class=='show_admin' OR $page_class=='site_settings' ){echo 'active treeview';}else{echo "treeview" ;}  ?> "> <a href="#"> <i class="fa fa-cogs" aria-hidden="true"></i> <span>Setting</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">

            <li class="<?php if($page_class=='advertisment'){echo 'active';} ?>"><a href="advertis">Advertisment</a></li>
            <li class="<?php if($page_class=='password_setting'){echo 'active';} ?>"><a href="password_setting">Password Setting</a></li>
      			<li class="<?php if($page_class=='make_admin'){echo 'active';} ?>" ><a href="make_admin">Make Admin</a></li>
      			<li class="<?php if($page_class=='show_admin'){echo 'active';} ?>" ><a href="show_admin">Show Admin</a></li>
      			<li class="<?php if($page_class=='site_settings'){echo 'active';} ?>" ><a href="site_settings">Site Settings</a></li>
          </ul>
        </li>		
		<li> <a href="logout"> <i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span> <span class="pull-right-container"></span> </a>          
        </li>         
      </ul>
    </section>
    <!-- /.sidebar --> 
  </aside>