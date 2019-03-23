<?php 
include 'db_connet.php';

      $site_settings_quary = "SELECT * FROM  site_settings ";
      $site_settings_result =mysqli_query($conn, $site_settings_quary);
      $site_settings_row = mysqli_fetch_array($site_settings_result);


?>



 <script language="JavaScript" type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script>



</script>

 <footer id="footer-main">
  <div class="footer-overlay">
     <div class="container">
     <div class="row">
     <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="about-widget">
                <div class="footer-title">
                <h4>About</h4>
                <hr>
                </div>                
                    <div class="text text-justify"><p><?php echo $site_settings_row ['About']; ?></p></div>
                    <div class="link">
                       <!-- <a href="#" class="default_link">Read More<i class="fa fa-arrow-right"></i></a> -->
                    </div>
               
            </div>
     </div><!-----/.col-3------------>
     <div class="col-md-3 col-sm-6 col-xs-12">
       <div class="useful-link-widget">
        <div class="footer-title">
        <h4>Useful Link</h4>
        <hr>
        </div>
        <div class="footer-nav">
          <ul>
          <li><a href="contact_us"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact</a></li>
           <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Suggestion</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Current Affairs</a></li>
             <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Journalt</a></li>
             <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Upcoming</a></li>
              <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>FAQ</a></li>
               <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Current Jobs</a></li>
                 <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Privacy Policy</a></li>
          </ul>
        </div>
       </div>
     </div><!-----/.col-3------------>
     <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="latest-post-widget">
            <div class="footer-title">
            <h4>Latest Post</h4>
            <hr>
            </div>
            <div class="latest-post-ul">
            
                  
                  
                  <?php
                  
                    
                include 'db_connet.php';
                
                 $sort_job_read_sql="SELECT * FROM post_jobs WHERE App_Deadline_Date  >='$today'    ORDER BY id DESC   LIMIT 4 ";

                 $sort_job_read_query = mysqli_query($conn,$sort_job_read_sql); 
                        
                        
                     if (mysqli_num_rows($sort_job_read_query)>0) {
                         
                     while( $sort_view_job_details = mysqli_fetch_array($sort_job_read_query)){
    
                    // echo $view_job_details['Job_Title'];
    
                      ?>
                      <ul>
              <li>
                  <div class="content">
                 <i class="fa fa-map-marker"></i>
                      <a href="job_view?id= <?php echo $sort_view_job_details['id'] ; ?>">  <?php echo $sort_view_job_details['Job_Title'] ;?></a><br>
                      <span><?php echo $sort_view_job_details['App_Deadline_Date'] ; ?></span>
                  </div>
                  
                 
              
              </ul>
               <?php
                    }
                         }
                            ?>
              </li>
            </div>
            
        </div>
     </div><!-----/.col-3------------>
     <div class="col-md-3 col-sm-6 col-xs-12">
       <div class="footer-contanct-widget">
                <div class="footer-title">
                <h4>Contact Form</h4>
                <hr>
                </div>
                <div class="footer-contact">
                    <ul>
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <div class="continfo">
                                <strong>Bd Jobscorner</strong><br>
                               <?php echo $site_settings_row ['Address']; ?>
                            </div>

                        </li>
                        <li>
                            <i class="fa fa-phone"></i>
                            <div class="continfo">
                                <a href="tel:<?php echo $site_settings_row ['Mobile_No']; ?>"><?php echo $site_settings_row ['Mobile_No']; ?></a>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <div class="continfo">
                                <a href="mailto:<?php echo $site_settings_row ['Email']; ?>"><?php echo $site_settings_row ['Email']; ?></a>
                            </div>
                        </li>
                      
                    </ul>
                </div>
                <!--
                <div class="subscribe_now">
                    <form action="" method="post" name="subscribe">
                        <input placeholder="Email address" type="email" name="email">
                        <button class="subscbtn" type="submit" name="subscribe" id="subscribe">SUBSCRIBE</button>
                    </form>
                </div>
               </div><!--- footer-form--->
			   
			  
			   <?php
			   
			   		 if(isset($_POST['subscribe']) && $_POST['email'] != '' ){
	
					/* -------------------Connect DB---------------*/
					include 'db_connet.php';
					/* -------------------Connect DB End---------------*/
					
					
					$name=$_POST['email'];
					$Email_Subscribe_date=date("Y-m-d");
									
					$sql="INSERT INTO mail_list(`Email`,`Subscribe_Date`) VALUES('$name','$Email_Subscribe_date')";
									
					if (mysqli_query($conn, $sql)) {
					
						
						
						?>
						<script>
						alert("Thank You For Successfully Subscribe!!!");
						</script>
						
					<?php
          
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}

					mysqli_close($conn);
					}
			   ?>
                 
     </div><!-----/.col-3------------>
     </div><!--- /.row--->
     </div><!--- /.container--->
     </div><!----end footer overlay--->
  </footer><!--------end-footer------->
  
  <!-- for scrollup -->
  <div class="scrolltop">
    <div class="scrollup">
     <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </div>
  </div>
  
   <!-- start footer-sidber-->  
  <div class="footer-sidber">
   <div class="container">
      <div class="row">
       <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12  text-center">
       
           <div class="footer-sidber-icon">
              <div class="icon-bar">
              <ul>
              <li><a href="https://www.facebook.com/BD-Jobs-Corner-2049117825123715/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="https://twitter.com/BDJobsCorner"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="https://www.youtube.com/channel/UCPJM04z3ODwV5u-T6aiRPNQ?view_as=subscriber"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              </ul>
              </div>
              <div class="sidber-text">
              <p>Copyrights&copy; 2019 Bdjobscorner.com All Rights Reserved <br> Developed By <a href="http://developbd.net/" style="color: #002e5b;"> Developbd </a> </p>
              </div>
           </div> 
      
       </div><!---/.col-4--->
      
      </div><!--- /.row--->
   </div><!--- /.container--->
   </div><!------end footer sideber----->
