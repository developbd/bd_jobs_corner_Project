<?php 

session_start();



if(!isset($_SESSION['user_login_id'])){

header("location: user_login_form");

}


 include('menu.php') ;
  include 'db_connet.php';

  $user_id = $_SESSION['user_login_id'];  

  $profile_sql = "SELECT  * FROM my_profile 
  JOIN my_resume  
  ON  my_profile.Main_id = my_resume.Main_id 
  WHERE my_profile.Main_id =  '$user_id'  
  AND  my_resume.Category =  'Education' 
  ORDER BY my_resume.id DESC  ";

  $profile_result = mysqli_query($conn,$profile_sql);
   
  $profile_result_row = mysqli_fetch_array($profile_result);



  // My_profile show............


  $my_profile_sql = "SELECT * FROM my_profile WHERE Main_id =  $user_id  ";

  $my_profile_result = mysqli_query($conn,$my_profile_sql);
   
  $my_profile_row = mysqli_fetch_array($my_profile_result);



  if(empty($profile_result_row['Main_id'])){

    $profile_pic  ='demo_pic.png';
    $profile_Name = $name;
    $profile_title  = '';

  }else{

   $profile_pic   = $profile_result_row['Photo'];
   $profile_Name  = $profile_result_row['First_Name']." ".$profile_result_row['Last_Name'];
   $profile_title =  $profile_result_row['Tittle'];

  }
  

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

    <title>bdjobs</title>

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
     <style type="text/css">


      
    .form-group {
        margin-bottom: 2px !important;
        min-height: 82px!important;
    }

    .min_height_text {
      margin-right: 0px !important;
      margin-left: 0px !important;
      min-height: 170px !important;
    }


    form label.error{
      font:14px Tahoma,sans-serif;
      color:#ED7476;
      margin-left:2px}

    form input.error,form input.error:hover,form input.error:focus,form select.error{
      border:1px solid #ED7476;
    }       
      form textarea.error,form input.error:hover,form input.error:focus,form select.error{
      border:1px solid #ED7476;
    }
    </style>



</head>

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
						<li class="active"><a href="my_profile">My Profile</a></li>
						<li><a href="resume">Resume</a></li>
						<li><a href="applied_jobs">Applied Jobs</a></li>
						<li><a href="cv_manager">CV And Acceroies</a></li>
                        <li><a href="admit_card">Admit Card</a></li>
						<li><a href="change_pass">Change Password</a></li>
						<li><a href="logout">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="applied_jobs">
					

 <?php if( mysqli_num_rows($my_profile_result)== 0 ) { ?>   
 <h3>My Profile:</h3>      
					<div class="row">
						<form class="row view-mode" id="my_profile" name="=my_profile" action="my_profile_action.php" method="POST"  enctype="multipart/form-data">                                        
                                        <div class="col-md-6">
                                        	<div class="row">
                                            	<div class="form-group col-md-12">
                                       			<label for="">First Name</label>
                                       			<input type="text" class="form-control" placeholder="Enter First Name" value="" name="txtFirstName" id="txtFirstName">
                                    		</div>
                                            	<div class="form-group col-md-12">
                                       			<label for="">Last Name</label>
                                       			<input type="text" class="form-control" placeholder="Enter Last Name" value="" name="txtLastName" id="txtLastName">
                                    		</div>
                                            	<div class="form-group col-md-12">
                                              <label for="">Father's Name</label>
                                              <input type="text" class="form-control" placeholder="Enter Father Name" value="" name="txtFName" id="txtFName">
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Mother's Name</label>
                                              <input type="text" class="form-control" placeholder="Enter Mother Name" value="" name="txtMName" id="txtMName">
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Date of Birth</label>
                                              <input type="text" class="form-control" placeholder="Enter Date Of Birth" value="" name="txtBirthDate" id="txtBirthDate">
                                           </div>
										   <div class="form-group col-md-12">
                                              <label for="">Age</label>
                                              <input type="text" class="form-control" placeholder="Enter Your Age" value="" name="txtAge" id="txtAge">
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="" >Gender &nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboGender"  id="cboGender" class="form-control">
                                                 <option value="" selected>Select</option>
                                                 <option value="Male" >Male</option>
                                                 <option value="Female" >Female</option>
                                                 <option value="Others" >Others</option>
                                              </select>
												
                                       		</div>
                                            	<div class="form-group col-md-12">
                                              <label for="">Religion &nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboReligion"  id="cboReligion" class="form-control">
                                                 <option value="" selected>Select</option>
                                                 <option value="Islam" >Islam</option>
                                                 <option value="Hindu" >Hindu</option>
                                                 <option value="Cristian" >Cristian</option>
												 <option value="Buddism" >Buddism</option>
												 <option value="Cristian" >Cristian</option>
												 <option value="Atheist" >Atheist</option>
                                              </select>
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Marital Status&nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboMStatus" id="cboMStatus" class="form-control">
                                                <option value="" selected="selected">Select</option>
                                                <option value="Unmarried" >Unmarried</option>
                                                <option value="Married" > Married </option>                                               
                                              </select>
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Nationality&nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboNationality" id="cboNationality" class="form-control">
                                                <option value="" selected="selected">Select</option>
                                                <option value="Bangladeshi" >Bangladeshi</option>
                                                <option value="Indian" > Indian </option>
												<option value="American" > American </option>
												<option value="England" > England </option> 
                                              </select>
                                                                                           
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">National Id No</label>
                                             <input type="text" class="form-control" placeholder="Enter NID Number" value="" name="txtNationalId" id="txtNationalId">
                                           </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row ">
                                              <div class="row min_height_text">
                                                
                                            <div class="form-group col-md-12 " >
                                            <label for="">Present Address&nbsp;<abbr title="Required" class="required"></abbr></label>
                                            <textarea name="txtPresentAdd" id="txtPresentAdd" cols="30" placeholder="Enter Present Address"  class="form-control  height-4x"></textarea>
                                         </div>

                                              </div>
                                              <div class="row min_height_text">
                                                

                                            <div class="form-group col-md-12">
                                            <label for="">Permanent Address</label>
                                            <textarea name="txtPermanentAdd" id="txtPermanentAdd" placeholder="Enter Permanent Address" cols="30" class="form-control height-4x"></textarea>
                                            </div>


                                              </div>


    									   		<div class="form-group col-md-12">
                                               <label for="">Current Location&nbsp;<abbr title="Required" class="required"></abbr></label>
                                               <select name="cboLocation" id="cboLocation" class="form-control">
                                                <option value="" selected="selected">Select</option>
                                                <option value="Inside Bangladesh" >Inside Bangladesh</option>
                                                <option value="Outside Indian" >Outside Indian </option>												 
                                              </select>
                                            </div>
    									   		<div class="form-group col-md-12">
                                              <label for="">Mobile No 1 <small  class="btn-form-control hidden color-green">(Provide at least one Phone Number)</small></label>
                                              <input type="text" class="form-control" placeholder="Enter Valid Mobile Number" value="" name="txtMobile1" id="txtMobile" >
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Mobile No 2</label>
                                             <input type="text" class="form-control" placeholder="Enter Valid Mobile Number" value="" name="txtMobile2" id="txtMobile2">
                                           </div>

                                           		<div class="form-group col-md-12">
                                              <label for="">Email <small  class="btn-form-control hidden color-green">(Do not enter/provide more than one e-mail address in either of the fields)</small></label>
                                              <input type="text" class="form-control" placeholder="Enter Your Email Address"  name="txtEmail1" id="txtEmail1">
                                           </div>
                                           		<div class="form-group col-md-12">
                                              <label for="">Alternate Email</label>
                                              <input type="text" class="form-control" placeholder="Enter Alternate Email" value="" name="txtEmail2"  id="txtEmail2">                                             
                                           </div>

                                             <div class="form-group col-md-12">
                                              <label for="">Upload Your Signature </label>
                                               <input type="file" class="form-control" name="Signature"  id="Signature" accept="image/*">
                                          
                                           </div>

										                       <div class="form-group col-md-12">
                                              <label for="">Upload Your Photo</label>
                                              <input type="file" class="form-control" name="imageFile"  id="imageFile" accept="image/*">                                             
                                           </div>
                                            </div>
                                     		
                                         </div>
                                           <div class="col-md-12">
                                              <div class="btn-form-control">
                                                 <button type="submit" class="das-btn" name="submit" ">Save</button>
                                                 <button type="reset" class="das-btn">Cancel</button>
                                              </div>
                                           </div>
                                        </form>
					
					</div>


        <?php } else{ ?>
          


            <form class="row view-mode" id="my_profile" name="=my_profile" action="my_profile_action.php" method="POST"  enctype="multipart/form-data">
             
             <div class="row">
                        
             <div class=".form-group col-md-12"><h3 class="myfrofile">My Profile:</h3><i class="fa fa-pencil remove" aria-hidden="true" ></i></div>
         

                             
                                        <div class="col-md-6">
                                          <div class="row">
                                              <div class="form-group col-md-12">
                                            <label for="">First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter First Name" value="<?php  echo $my_profile_row['First_Name']; ?>" name="txtFirstName" id="txtFirstName" disabled >
                                        </div>
                                              <div class="form-group col-md-12">
                                            <label for="">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Last Name" value="<?php  echo $my_profile_row['Last_Name']; ?>" name="txtLastName" id="txtLastName" disabled>
                                        </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Father's Name</label>
                                              <input type="text" class="form-control" placeholder="Enter Father Name" value="<?php  echo $my_profile_row['Father_Name']; ?>" name="txtFName" id="txtFName" disabled >
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Mother's Name</label>
                                              <input type="text" class="form-control" placeholder="Enter Mother Name" value="<?php  echo $my_profile_row['Mother_Name']; ?>" name="txtMName" id="txtMName" disabled>
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Date of Birth</label>
                                              <input type="text" class="form-control" placeholder="Enter Date Of Birth" value="<?php  echo $my_profile_row['Date_of_Birth']; ?>" name="txtBirthDate" id="txtBirthDate" disabled>
                                           </div>
                       <div class="form-group col-md-12">
                                              <label for="">Age</label>
                                              <input type="text" class="form-control" placeholder="Enter Your Age" value="<?php  echo $my_profile_row['Age']; ?>" name="txtAge" id="txtAge" disabled >
                                           </div>
                                           
                                           
                                              <div class="form-group col-md-12">
                                              <label for="" >Gender &nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboGender"  id="cboGender" class="form-control" disabled >
                                                 <option value="<?php  echo $my_profile_row['Gender']; ?>" ><?php  echo $my_profile_row['Gender']; ?></option>
                                                 <option value="" >Select</option>
                                                 <option value="Male" >Male</option>
                                                 <option value="Female" >Female</option>
                                                 <option value="Others" >Others</option>
                                              </select>
                        
                                          </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Religion &nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboReligion"  id="cboReligion" class="form-control" disabled >
                                                <option value="<?php  echo $my_profile_row['Religion']; ?>" selected=""><?php  echo $my_profile_row['Religion']; ?> </option>
                                                 <option value="" >Select</option>
                                                 <option value="Islam" >Islam</option>
                                                 <option value="Hindu" >Hindu</option>
                                                 <option value="Cristian" >Cristian</option>
                                                 <option value="Buddism" >Buddism</option>
                                                 <option value="Cristian" >Cristian</option>
                                                 <option value="Atheist" >Atheist</option>
                                              </select>
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Marital Status&nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboMStatus" id="cboMStatus" class="form-control" disabled >
                                                <option value="<?php  echo $my_profile_row['Marital_Status']; ?>" selected=""><?php  echo $my_profile_row['Marital_Status']; ?></option>
                                                <option value=""> Select </option>
                                                <option value="Unmarried" >Unmarried</option>
                                                <option value="Married" > Married </option>                                               
                                              </select>
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Nationality&nbsp;<abbr title="Required" class="required"></abbr></label>
                                              <select name="cboNationality" id="cboNationality" class="form-control" disabled >
                                                
                                                <option value="<?php  echo $my_profile_row['Nationality']; ?>" selected="selected"><?php  echo $my_profile_row['Nationality']; ?></option>
                                                <option value="" >Select</option>
                                                <option value="Bangladeshi" >Bangladeshi</option>
                                                <option value="Indian" > Indian </option>
                                                <option value="American" > American </option>
                                                <option value="England" > England </option> 
                                              </select>
                                                                                           
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">National Id No</label>
                                             <input type="text" class="form-control" placeholder="Enter NID Number" name="txtNationalId" id="txtNationalId" value="<?php  echo $my_profile_row['National_Id_No']; ?> "  disabled >
                                           </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="row ">
                                            <div class="row min_height_text">
                                            <div class="form-group col-md-12 " >
                                            <label for="">Present Address&nbsp;<abbr title="Required" class="required"></abbr></label>
                                            <textarea name="txtPresentAdd" id="txtPresentAdd" cols="30" placeholder="Enter Present Address"  class="form-control  height-4x"  disabled ><?php echo $my_profile_row['Present_Address']; ?> </textarea>
                                         </div>

                                              </div>
                                        <div class="row min_height_text">
                                            <div class="form-group col-md-12">
                                            <label for="">Permanent Address</label>
                                            <textarea name="txtPermanentAdd" id="txtPermanentAdd" placeholder="Enter Permanent Address" cols="30" class="form-control height-4x" disabled ><?php  echo $my_profile_row['Permanent_Address']; ?></textarea>
                                            </div>
                                        </div>


                            <div class="form-group col-md-12">
                                               <label for="">Current Location&nbsp;<abbr title="Required" class="required"></abbr></label>
                                               <select name="cboLocation" id="cboLocation" class="form-control" disabled >
                                                <option value="<?php  echo $my_profile_row['Current_Location']; ?>" selected="selected"><?php  echo $my_profile_row['Current_Location']; ?></option>
                                                <option value="" >select</option>
                                                <option value="Inside Bangladesh" >Inside Bangladesh</option>
                                                <option value="Outside Indian" >Outside Indian </option>                         
                                              </select>
                                            </div>
                            <div class="form-group col-md-12">
                                              <label for="">Mobile No 1 <small  class="btn-form-control hidden color-green">(Provide at least one Phone Number)</small></label>
                                              <input type="text" class="form-control" placeholder="Enter Valid Mobile Number" value="<?php  echo $my_profile_row['Mobile_No_1']; ?>" name="txtMobile1" id="txtMobile" disabled >
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Mobile No 2</label>
                                             <input type="text" class="form-control" placeholder="Enter Valid Mobile Number" value="<?php  echo $my_profile_row['Mobile_No_2']; ?>" name="txtMobile2" id="txtMobile2" disabled >
                                           </div>

                                              <div class="form-group col-md-12">
                                              <label for="">Email <small  class="btn-form-control hidden color-green">(Do not enter/provide more than one e-mail address in either of the fields)</small></label>
                                              <input type="text" class="form-control" placeholder="Enter Your Email Address"  name="txtEmail1" id="txtEmail1" value="<?php  echo $my_profile_row['Email']; ?>" disabled  >
                                           </div>
                                              <div class="form-group col-md-12">
                                              <label for="">Alternate Email</label>
                                              <input type="text" class="form-control" placeholder="Enter Alternate Email" value="<?php  echo $my_profile_row['Alternate_Email']; ?>" name="txtEmail2"  id="txtEmail2" disabled >                                             
                                           </div>

                                          <div class="form-group col-md-12">
                                          <div class="row">
                                               <div class="form-group col-md-6">
                                              <label for="">Upload Update Signature</label>
                                              <input type="file" class="form-control" name="update_signature"  id="update_signature" accept="image/*"  disabled >
                                              <input type="hidden" class="form-control" value="<?php  echo $my_profile_row['Signature']; ?>" name="old_signature" disabled   >
                                           </div> 
                                              <div class="form-group col-md-6">

                                                <img src="photo/<?php  echo $my_profile_row['Signature']; ?>" style="width: 100px">
                                               </div >  
                                          </div>
                                       
                                          </div>


                                        <div class="form-group col-md-12">
                                          <div class="row">
                                               <div class="form-group col-md-6">
                                              <label for="">Upload Update Photo</label>
                                              <input type="file" class="form-control" name="update_imageFile"  id="update_imageFile" accept="image/*"  disabled >     
                                              <input type="hidden" class="form-control" value="<?php  echo $my_profile_row['Photo']; ?>" name="old_imageFile" disabled   >
                                            </div > 
                                              <div class="form-group col-md-6">

                                                <img src="photo/<?php  echo $my_profile_row['Photo']; ?>" style="width: 100px">
                                               </div >  
                                          </div>
                                       
                                           </div>
                                            </div>
                                        
                                         </div>
                                           <div class="col-md-12">
                                              <div class="btn-form-control">
                                                 <input type="submit" class="das-btn" name="update_submit" value="Update" disabled >
                                                
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



<?php include("footer.php"); ?>
  

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

 


 $( function() {
    $( "#txtBirthDate" ).datepicker({

      dateFormat: 'yy/mm/dd',
      changeYear: true,
    

    });

  });
	 
$.validator.addMethod(
    "maxfilesize",
    function (value, element) {
        if (this.optional(element) || ! element.files || ! element.files[0]) {
            return true;
        } else {
            return element.files[0].size <= 1024 * 512 ;
        }
    },
    'The file size can not exceed 512KB.'
);

$(function () {
  
  $("#my_profile").validate({

    rules:{

      txtFirstName:{
        required:true,
        
      }, 

      txtLastName:{
        required:true,
        
      },

      txtFName:{
        required:true,    

      },


      txtMName:{
        required:true,

      },
    
      txtBirthDate:{
        required:true,

      },
      txtAge:{
        required:true,
        
      },

      cboGender:{
        required:true,
        
      },
      cboReligion:{
        required:true,
        
      },

      cboMStatus:{
        required:true,
        
      },

      cboNationality:{
        required:true,
      },

      txtNationalId:{
        required:true,

      },
      txtPresentAdd:{
        required:true,
        
      },

      txtPermanentAdd:{
        required:true,
        
      },
      cboLocation:{
        required:true,
      },
     
      
      txtMobile1:{
        required:true,
     
      },     

      txtEmail1:{
        required:true,
        email:true,
      },     

      Signature:{
         required: true,
         accept:"jpg,png,jpeg,gif",
         maxfilesize: 524228,
      },

      imageFile:{

         required: true,
         accept:"jpg,png,jpeg,gif",
         maxfilesize: 524228,
         
      },     

      update_signature:{
      
         accept:"jpg,png,jpeg,gif",
         maxfilesize: 524228,
      },

      update_imageFile:{

         accept:"jpg,png,jpeg,gif",
         maxfilesize: 524228,
         
      }

      },

    messages:{

      email:{

        required: 'Please enter an email address.',
        email: 'Please enter a Valid email address.'
      },
      Region:{

        required: 'Please enter an valid address.',
      },
      Phone:{
        
        minlength: 'Please enter at least 11 Number.'
      },

      imageFile:{
        required: "Select Image",
        accept: "Only image type jpg/png/jpeg/gif is allowed"
     
      },

        Signature:{
        required: "Select Signature",
        accept: "Only image type jpg/png/jpeg/gif is allowed"
     
      },

      update_signature:{
        accept: "Only image type jpg/png/jpeg/gif is allowed"
     
      },

        update_imageFile:{
        accept: "Only image type jpg/png/jpeg/gif is allowed"
     
      }
    }


  });



});

</script>


</body>

</html>
