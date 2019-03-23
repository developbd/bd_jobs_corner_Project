<?php 
   session_start();
   

   
   if(!isset($_SESSION['company_login_id'])){
   
   header("location: company_login_form");
   
   }
   
     include('menu.php') ;
   
     include 'db_connet.php';
   
     $user_id = $_SESSION['company_login_id'];  
   
     $profile_sql = "SELECT * FROM company_profile WHERE Main_id =  $user_id  ";
   
     $profile_result = mysqli_query($conn,$profile_sql);
      
     $profile_result_row = mysqli_fetch_array($profile_result);


   

   
   
     if(empty($profile_result_row['Main_id'])){
   
       $profile_pic  ='demo_logo.jpg';
       $profile_name = $name;
   
     }else{
   
      $profile_pic   = $profile_result_row['Company_Photo'];
      $profile_name  = $profile_result_row['Company_Name'];
   
   
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
       <script src="js/jquery-1.12.0.min.js" type="text/javascript"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
         .form-group {
         margin-bottom: 2px !important;
         min-height: 82px!important;
         }
         .min_height_text {
         min-height: 155px !important;
         }
         .min_height_file{
         min-height: 95px !important;
         }
         form label.error{
         font:14px Tahoma,sans-serif;
         color:#ED7476;
         margin-left:2px
         }
         form input.error,form input.error:hover,form input.error:focus,form select.error{
         border:1px solid #ED7476;
         }       
      </style>


    <script type="text/javascript">
        $(document).ready(function(){

            $("#Job_Region").change(function(){
                var divisionsid =  $(this).children(":selected").attr("id");

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {divisions:divisionsid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#Job_Location").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];

                            $("#Job_Location").append("<option value='"+name+"'>"+name+"</option>");

                        }
                    }
                });
            });

        });
        
        
              
    
      
  
  
    </script>


   </head>
   <body>

      <!------------ Dashboard Start ------------>
      <section id="dashboard">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <div class="canditate_area">
                     <img src="Company_Profile/<?php echo $profile_pic ; ?>" alt="bdjobs"/>
                     <h3><?php echo $profile_name ; ?></h3>
                  </div>
                  <div class="dashboard_menu">
                     <ul>
                        <li class="active"><a href="company_profile">Company Profile</a></li>
                        <li><a href="manage_jobs">Manage Jobs</a></li>
                        <li><a href="post_jobs">Post A Jobs</a></li>
                        <li><a href="change_pass_company">Change Password</a></li>
                        <li><a href="logout">Sign Out</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="applied_jobs">
                     <?php if( mysqli_num_rows($profile_result)== 0 ) { ?> 
                     <h3>Company Profile:</h3><br>
                     <div class="row">
                        <form class="row view-mode" id="company_profile" name="company_profile" action="company_profile_action.php" method="POST"  enctype="multipart/form-data">
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Company Name" value="<?php echo $name ;?>" name="company_name" id="company_name" readonly  >
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" value="" name="Phone" id="Phone">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Category</label>
                                    <input type="text" class="form-control" placeholder="IT, Bank, Industry, Service" value="" name="Category" id="Category">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" value="<?php echo $profile_result_row_reg['Email'];?>" name="Email" id="Email" readonly >
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Website</label>
                                    <input type="text" class="form-control" placeholder="www.yoursite.com" value="" name="Website" id="Website">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Found Date</label>
                                    <input type="text" class="form-control" placeholder="1970/12/31" value="" name="Found_Date" id="Found_Date">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row min_height_text">
                                 <div class="form-group col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="Description" id="Description" placeholder="Enter Company Description" cols="30" class="form-control height-3x"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="">Region</label>
                                    
                    <br>
                     <select name="Region"  id="Job_Region" class="form-control" >
                                <option value="0">- Select -</option>
                                <?php 
                                // Fetch Department
                                $sql_divisions = "SELECT * FROM divisions";
                                $divisions_data = mysqli_query($conn,$sql_divisions);
                                while($row = mysqli_fetch_assoc($divisions_data) ){
                                    $divisionsid = $row['id'];
                                    $divisions_name = $row['name'];
                                  
                                    // Option
                                    echo "<option id='".$divisionsid."' value='".$divisions_name."'  >".$divisions_name."</option>";
                                }
                                ?>
                     </select>


                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                  
                                 <div class="form-group col-md-12 textarea">
                                    <label for="">District</label>
                                     <br> <div class="clear"></div>
                                       <select class="form-control" id="Job_Location"  name="District">
                                            <option value="0">- Select -</option>
                                        </select>
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row min_height_text">
                                 <div class="form-group col-md-12">
                                    <label for="">Full Address</label>
                                    <textarea name="Full_Address" id="Full_Address" placeholder="Enter Company Address" cols="30" class="form-control height-3x"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row min_height_file">
                                 <div class="form-group col-md-12">
                                    <label for="">Upload Company Photo</label>
                                    <input type="file" class="form-control" name="Company_Photo"  id="Company_Photo" accept="image/*"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row min_height_file">
                                 <div class="form-group col-md-12">
                                    <label for="">Upload Author Signature</label>
                                    <input type="file" class="form-control" name="Author_Signature"  id="Author_Signature" accept="image/*">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="btn-form-control">
                                 <input type="submit" name="submit" class="das-btn" value="Save">
                                 <input type="reset" class="das-btn" value="Cancel">
                              </div>
                           </div>
                        </form>
                     </div>
                     <?php } else{ ?>
                     <form class="row view-mode" id="company_profile" name="company_profile" action="company_profile_action.php" method="POST"  enctype="multipart/form-data">
                        <div class="row">
                           <div class=".form-group col-md-12">
                              <h3 class="myfrofile">Company Profile:</h3>
                              <i class="fa fa-pencil remove" aria-hidden="true" ></i>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Company Name" value="<?php echo $profile_result_row ['Company_Name'] ;?>" name="company_name" id="company_name" disabled >
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" value="<?php echo $profile_result_row ['Phone'] ;?>" name="Phone" id="Phone" disabled>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Category</label>
                                    <input type="text" class="form-control" placeholder="IT, Bank, Industry, Service" value="<?php echo $profile_result_row ['Phone'] ;?>" name="Category" id="Category" disabled >
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" value="<?php echo $profile_result_row ['Email'] ;?>" name="Email" id="Email" disabled >
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Website</label>
                                    <input type="text" class="form-control" placeholder="www.yoursite.com" value="<?php echo $profile_result_row ['Website'] ;?>" name="Website" id="Website" disabled >
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Found Date</label>
                                    <input type="text" class="form-control" placeholder="1970/12/31" value="<?php echo $profile_result_row ['Found_Date'] ;?>" name="Found_Date" id="Found_Date" disabled >
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row min_height_text">
                                 <div class="form-group col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="Description" id="Description" placeholder="Enter Company Description" cols="30" class="form-control height-3x" disabled ><?php echo $profile_result_row ['Description'] ;?></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">
                                 
                            <div class="form-group col-md-12">

                            <label for=""> Region</label>
                                 <br>
                                <select name="Region"  id="Job_Region" class="form-control" disabled >
                                 <option value="<?php echo $profile_result_row ['Region'] ;?>" ><?php echo $profile_result_row ['Region'] ;?></option>
                                       
                                            <option value="0">- Select -</option>
                                            <?php 
                                            // Fetch Department
                                            $sql_divisions = "SELECT * FROM divisions";
                                            $divisions_data = mysqli_query($conn,$sql_divisions);
                                            while($row = mysqli_fetch_assoc($divisions_data) ){
                                                $divisionsid = $row['id'];
                                                $divisions_name = $row['name'];
                                              
                                                // Option
                                                echo "<option id='".$divisionsid."' value='".$divisions_name."'  >".$divisions_name."</option>";
                                            }
                                            ?>
                                 </select>
                        </div>
          
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row">

                            <div class="form-group col-md-12 textarea">
                                <label for="">District</label>
                                  <br> <div class="clear"></div>
                                <select class="form-control" id="Job_Location"  name="District" disabled>
                                    <option value="<?php echo $profile_result_row ['District'] ;?>" ><?php echo $profile_result_row ['District'] ;?></option>
                                    <option value="0">- Select -</option>
                                </select>
                            </div>
                                 
                                 
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="row min_height_text">
                                 <div class="form-group col-md-12">
                                    <label for="">Full Address</label>
                                    <textarea name="Full_Address" id="Full_Address" placeholder="Enter Company Address" cols="30" class="form-control height-3x" disabled ><?php echo $profile_result_row ['Full_Address'] ;?></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="row min_height_file">
                                 <div class="form-group col-md-12">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                          <label for="">Upload Update Photo</label>
                                          <input type="file" class="form-control" name="update_Company_Photo"  id="update_Company_Photo" accept="image/*" disabled > 
                                             <input type="hidden" class="form-control" value="<?php  echo $profile_result_row['Company_Photo']; ?>" name="old_Company_Photo" disabled > 

                                       </div>
                                       <div class="form-group col-md-6">
                                          <img src="Company_Profile/<?php  echo $profile_result_row['Company_Photo']; ?>" style="width: 100px">
                                     
                                       </div >
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="row min_height_file">
                                 <div class="form-group col-md-12">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                          <label for="">Upload Update Signature</label>
                                          <input type="file" class="form-control" name="update_Author_Signature"  id="update_Author_Signature" accept="image/*" disabled > 
                                           <input type="hidden" class="form-control" value="<?php  echo $profile_result_row['Author_Signature']; ?>" name="old_Author_Signature" disabled   >
                                           
                                       </div>
                                       <div class="form-group col-md-6">
                                          <img src="Company_Profile/<?php  echo $profile_result_row['Author_Signature']; ?>" style="width: 100px">
                                       </div >
                                    </div>
                                 </div>
                              </div>
                           </div>

                       
                        <div class="col-md-12">
                           <div class="btn-form-control">
                              <input type="submit" name="update_submit" class="das-btn" value="Update" disabled>
                           </div>
                        </div>
                     </form>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
         </div>
      </section>
      <!------------ Dashboard End --------------->
      <?php  include('footer.php') ?>
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
      <style type="text/css">
         .remove {
         padding: 5px;
         color: #DA670F;
         cursor: pointer;
         font-size: 25px;
         float: right;
         }
         .remove:hover {
         padding: 5px;
         color: #014E7C;
         cursor: pointer;
         }
         .applied_jobs h3 {
         margin: 0px;
         padding-bottom: 0px;
         }
      </style>
      <script type="text/javascript">
         //Remove Disable
               $('.remove').click(function() {
                 $('textarea,input,select,file,submit').each(function() {
                     if ($(this).attr('disabled')) {
                         $(this).removeAttr('disabled');
                     }
                     else {
                         $(this).attr({
                             'disabled': 'disabled'
                         });
                     }
                 });
             });
         
         
         
         
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
           
               
         
          $( function() {
             $( "#Found_Date" ).datepicker({
         
               dateFormat: 'yy/mm/dd',
               changeYear: true,
               minDate: new Date(1970, 12, 30),
         
             });
         
         
           });
         
             
         
         $.validator.addMethod(
             "maxfilesize",
             function (value, element) {
                 if (this.optional(element) || ! element.files || ! element.files[0]) {
                     return true;
                 } else {
                     return element.files[0].size <= 1024 * 512;
                 }
             },
             'The file size can not exceed 512KB.'
         );
         
         
         
         $(function () {
           
           $("#company_profile").validate({
         
             rules:{
         
               company_name:{
                 required:true,
                 
               },
         
               Phone:{
                 required:true,
                 minlength: 11,
         
               },
             
               Category:{
                 required:true,
         
               },
               Email:{
                 required:true,
                 email:true
               },
         
               Website:{
                 url:true,
         
               },
               Found_Date:{
                 required:true,
                 
               },
               Description:{
                 required:true,
                 minlength:50,
                 maxlength:500,
         
               },
         
               Region:{
                 required:true,
         
               },
         
               Full_Address:{
                 required:true,
                 
               },
               Company_Photo:{
                  required: true,
                  accept:"jpg,png,jpeg,gif",
                  maxfilesize: 524288,
               },
               Author_Signature:{
         
                  required: true,
                  accept:"jpg,png,jpeg,gif",
                  maxfilesize: 524288,
                 
               },
               update_Company_Photo:{
                   
                  accept:"jpg,png,jpeg,gif",
                  maxfilesize: 524288,
               },
               update_Author_Signature:{

                  accept:"jpg,png,jpeg,gif",
                  maxfilesize: 524288,
                 
               }
             },
             
         
             messages:{
         
               email:{
                 required: 'Please enter an email address.',
                 email: 'Please enter a Valid email address.'
               },
         
               Phone:{
                 
                 minlength: 'Please enter at least 11 Number.'
               },
         
                Company_Photo:{
                 required: "Select Image",
                 accept: "Only image type jpg/png/jpeg/gif is allowed"
              
               },
         
               Author_Signature:{
                 required: "Select Image",
                 accept: "Only image type jpg/png/jpeg/gif is allowed"
              
               },
         
                 update_Company_Photo:{
                 accept: "Only image type jpg/png/jpeg/gif is allowed"
              
               },
         
                update_Author_Signature:{ accept: "Only image type jpg/png/jpeg/gif is allowed"
              
               }
         
             }
         
         
           });
         
         
         
         });
         
         
         
      </script>
   </body>
</html>