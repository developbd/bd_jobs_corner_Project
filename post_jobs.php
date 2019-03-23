
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<?php 


session_start();


if(!isset($_SESSION['company_login_id'])){

header("location: company_login_form");

}



  include 'db_connet.php';

  $user_id = $_SESSION['company_login_id'];  

  $profile_sql = "SELECT * FROM company_profile WHERE Main_id =  $user_id  ";

  $profile_result = mysqli_query($conn,$profile_sql);

 $check_profile_complete = mysqli_num_rows($profile_result);
   
  $profile_result_row = mysqli_fetch_array($profile_result);



  if(empty($profile_result_row['Main_id'])){

    $profile_pic  ='demo_logo.jpg';
    $profile_name = 'User id '.$user_id;

  }else{

   $profile_pic   = $profile_result_row['Company_Photo'];
   $profile_name  = $profile_result_row['Company_Name'];


  }
  




if(isset($_POST['job_submit'])) {


if($check_profile_complete == 1){

include 'Db_connet.php';

$Job_Title=$_POST['Job_Title'];

$Job_Level=$_POST['Job_Level'];

$Needs_Employee=$_POST['Needs_Employee'];

$Salary=$_POST['Salary'];

$Qualification=$_POST['Qualification'];

$Job_Region=$_POST['Job_Region'];

$Job_Type=$_POST['Job_Type'];

$Job_Category =$_POST['Job_Category'];

$Job_Tags =$_POST['Job_Tags'];

$Gender =$_POST['Gender'];

$Job_Created_Date    = date('Y-m-d');

$App_Deadline_Date =$_POST['App_Deadline_Date'];

$Job_Location =$_POST['Job_Location'];

$Job_Context = mysqli_real_escape_string($conn, $_POST['Job_Context']);

$Job_Responsiblities = mysqli_real_escape_string($conn,  $_POST['Job_Responsiblities']);

$Additional_Requirements = mysqli_real_escape_string($conn,  $_POST['Additional_Requirements']);

$Compensation  = mysqli_real_escape_string($conn,  $_POST['Compensation']);

$Company_Name = $_POST['Company_Name'];

$Company_Website = $_POST['Company_Website'];



$company_id = $_SESSION['company_login_id'];

$Company_Main_id  = $company_id;


$date    = date('YmdHis');

$Job_Banner = $Company_Main_id.'_Job_Banner_'.$date.basename( $_FILES['Job_Banner']['name']);


$path_dir = "Company_Profile/";
$path = $path_dir.$Job_Banner;



$Data_insert="INSERT INTO  post_jobs (`Main_id`,`Job_Title`,`Job_Level`,`Needs_Employee`,`Salary`,`Qualification`,`Job_Region`, `Job_Type`,`Job_Category`, `Job_Tags`, `Gender`,`Job_Created_Date`, `App_Deadline_Date`, `Job_Location`, `Job_Context`, `Job_Responsiblities`, `Additional_Requirements`, `Compensation`, `Name_of_Company`, `Company_Website`, `Job_Banner`)
 VALUES ('$Company_Main_id','$Job_Title','$Job_Level','$Needs_Employee','$Salary','$Qualification','$Job_Region','$Job_Type','$Job_Category','$Job_Tags', '$Gender', '$Job_Created_Date', '$App_Deadline_Date', '$Job_Location', '$Job_Context','$Job_Responsiblities', '$Additional_Requirements',  '$Compensation ', '$Company_Name', '$Company_Website', '$Job_Banner')";


if (mysqli_query($conn, $Data_insert)) {

 move_uploaded_file($_FILES["Job_Banner"]["tmp_name"], $path);

          echo "<script>
          // confirm

          $(document).ready(function()  {

            $.confirm({
              closeIcon: true,
                closeIconClass: 'fa fa-close',
              title: 'Successful!! Post Your Job',
              content: 'Press ok to your profile page.',
              
                 buttons: {
                   ok: function(){
                      location.href = 'company_profile';
                    }
              }
            });
          });

         </script>  ";

  

  
}else{

    echo "Error: " . $Data_insert . "<br>" . mysqli_error($conn);
}






}else{

          echo "<script>
          // confirm

          $(document).ready(function()  {

            $.confirm({
              closeIcon: true,
                closeIconClass: 'fa fa-close',
              title: 'Please, Complete your profile first then post your job',
              content: 'Press ok to your profile page.',
              
                 buttons: {
                   ok: function(){
                      location.href = 'company_profile';
                    }
              }
            });
          });

         </script>  ";
    
  }
}
 

?>



<!DOCTYPE html>
<html lang="en">

<head>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!-- Custom CSS -->
    <link href="css/Style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">


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
      margin-left:2px;

    }

  form input.error,form input.error:hover,form input.error:focus,form select.error{
      border:1px solid #ED7476;
    }   
  
  .fa {
    padding-top: 10px!important;
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

<?php  include('menu.php') ?>
   
<!------------ Dashboard Start ------------>
<section id="dashboard">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        
        <div class="canditate_area">
          <img src="Company_Profile/<?php echo  $profile_pic; ?>" alt="bdjobs"/>
          <h3><?php echo  $profile_name; ?></h3>         
        </div>


        <div class="dashboard_menu">
          <ul>
            <li ><a href="company_profile">Company Profile</a></li>
            <li><a href="manage_jobs">Manage Jobs</a></li>
            <li class="active"><a href="post_jobs">Post A Jobs</a></li>
            <li><a href="change_pass_company">Change Password</a></li>
            <li><a href="logout">Sign Out</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="applied_jobs">
          <h3>Post New Jobs:</h3>
          <div class="row">
            <form class="row view-mode" id="post_jobs" name="post_jobs" action="" method="POST"  enctype="multipart/form-data">                                        
                                        <div class="col-md-6">
                                          <div class="row">
                                            <div class="form-group col-md-12">
                                            <label for="">Job Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Job Title" value="" name="Job_Title" id="Job_Title">
                                        </div> 
                      <div class="form-group col-md-12">
                                            <label for="">Job Level</label>
                                            <input type="text" class="form-control" placeholder="Enter Job Level" value="" name="Job_Level" id="Job_Level">
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Needs Employee</label>
                                            <input type="text" class="form-control" placeholder="Enter Employee Limit" value="" name="Needs_Employee" id="Needs_Employee">
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Salary</label>
                                            <input type="text" class="form-control" placeholder="Enter Salary" value="" name="Salary" id="Salary">
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Qualification</label>
                                            <input type="text" class="form-control" placeholder="Enter Qualification" value="" name="Qualification" id="Qualification">
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Job Region</label>

<br>
 <select name="Job_Region"  id="Job_Region" class="form-control" >
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
                      <div class="form-group col-md-12">
                                            <label for="">Job Type</label>
                                            
                                            <select name="Job_Type"  id="Job_Type" class="form-control">
                                              <option value="" selected>Select</option>
                                              <option value="Full-Time" >Full-Time</option>
                                              <option value="Part-Time" >Part-Time</option>
                                            </select>
                                            
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Job Category</label>
                                            
                                            <!--<input type="text" class="form-control" placeholder="Enter Job Category" value="" name="Job_Category" id="Job_Category"> -->
                                            
                                            <select name="Job_Category"  id="Job_Category" class="form-control">
                                              <option value="" selected>Select</option>
                                              <option value="Accounting/Finance" >Accounting/Finance</option>
                                              <option value="Bank/Non-Bank Fin. Institution" >Bank/Non-Bank Fin. Institution</option>
                                              <option value="Commercial/Supply Chain" >Commercial/Supply Chain</option>
                                              <option value="Education/Training" >Education/Training</option>
                                              <option value="Engineer/Architectsn" >Engineer/Architectsn</option>
                                              <option value="Garments/Textile" >Garments/Textile</option>
                                              <option value="HR/Org. Development" >HR/Org. Development</option>
                                              <option value="Design/Creative" >Design/Creative</option>
                                              <option value="Production/Operation" >Production/Operation</option>
                                              <option value="Hospitality/ Travel/ Tourism" >Hospitality/ Travel/ Tourism</option>
                                              <option value="Beauty Care/ Health & Fitness" > Beauty Care/ Health & Fitness</option>
                                              <option value="Electrician/ Construction/ Repair" >Electrician/ Construction/ Repair</option>
                                              <option value="IT & Telecommunication" >IT & Telecommunication</option>
                                              <option value="Marketing/Sales" >Marketing/Sales</option>
                                              <option value="Customer Support/Call Centre" >Customer Support/Call Centre</option>
                                              <option value="Medical/Pharma" >Medical/Pharma</option>
                                              <option value="NGO/Development" >NGO/Development</option>
                                              <option value="Research/Consultancy" >Research/Consultancy</option>
                                              <option value="Secretary/Receptionist" >Secretary/Receptionist</option>
                                              <option value="Data Entry/ Computer Operator" >Data Entry/ Computer Operator</option>
                                              <option value="Driving/Motor Technician" >Driving/Motor Technician</option>
                                              <option value="Security/Support Service" >Security/Support Service</option>
                                              <option value="Law/Legal" >Law/Legal</option>
                                              <option value="Others" >Others</option>
                                              
                                            </select>
                                            
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Job Tags</label>
                                            <input type="text" class="form-control" placeholder="java,C#,python" value="" name="Job_Tags" id="Job_Tags">
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Gender</label>
                                            <select name="Gender"  id="Gender" class="form-control">
                          <option value="" selected>Select</option>
                          <option value="Male" >Male</option>
                          <option value="Female" >Female</option>
                          <option value="All" >All</option>
                                              </select>
                                        </div>
                      <div class="form-group col-md-12">
                                            <label for="">Application Deadline Date</label>
                                            <input type="text" class="form-control" placeholder="Enter Deadline" value="" name="App_Deadline_Date" id="App_Deadline_Date">
                       </div>
                       
                       
                            <div class="form-group col-md-12">
                                <label for="">Job Location</label>
                                  <br> <div class="clear"></div>
                                <select class="form-control" id="Job_Location"  name="Job_Location">
                                    <option value="0">- Select -</option>
                                </select>
                            </div>
                                            
                                            </div>                                        
                                         </div>


										 <div class="col-md-12">
											<div class="row">
												<div class="form-group col-md-12">
													<label for="">Job Context</label>
													<textarea name="Job_Context" id="Job_Context" placeholder="Job Context" cols="30" class="form-control height-3x"></textarea>
												</div>
											</div>
										</div>
										 <div class="col-md-12">
											<div class="row">
												<div class="form-group col-md-12">
													<label for="">Job Responsiblities</label>
													<textarea name="Job_Responsiblities" id="Job_Responsiblities" placeholder="Job Responsiblities" cols="30" class="form-control height-3x"></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="row">
												<div class="form-group col-md-12">
													<label for="">Additional Requirements</label>
													<textarea name="Additional_Requirements" id="Additional_Requirements" placeholder="Additional Requirements" cols="30" class="form-control height-3x"></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="row">
												<div class="form-group col-md-12">
													<label for="">Compensation & Other Benefits</label>
													<textarea name="Compensation" id="Compensation" placeholder="Compensation & Other Benefits" cols="30" class="form-control height-3x"></textarea>
												</div>
											</div>
										</div>
										
                              <div class="col-md-6">
                                            <div class="row">                     
                      <div class="form-group col-md-12">
                                            <label for="">Company Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Company Name" value="" name="Company_Name" id="Company_Name">
                                        </div>                  
                                            </div>                                        
                                         </div>
                     <div class="col-md-6">
                                            <div class="row">                     
                      <div class="form-group col-md-12">
                                            <label for="">Company Website(optional)</label>
                                            <input type="text" class="form-control" placeholder="http://" value="" name="Company_Website" id="Company_Website">
                                        </div>                  
                                            </div>                                        
                                         </div>
                     <div class="col-md-12">
                                            <div class="row">                                          
                       <div class="form-group col-md-12">
                                              <label for="">Upload Job Banner</label>
                                              <input type="file" class="form-control" name="Job_Banner"  id="Job_Banner" accept="image/*"> 
                                                                   
                                           </div>
                                            </div>
                                        
                                         </div>
                                           <div class="col-md-12">
                                              <div class="btn-form-control">
                                                 <input type="submit" name="job_submit" type="submit" class="das-btn" value="Post"/>

                                                 <input type="reset" name="" class="das-btn" value="Cancel"/>
                                              </div>
                                           </div>
                       
                                        </form>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!------------ Dashboard End --------------->



<?php  include('footer.php') ?>
<!-- jQuery validate 1.13.0 -->



<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    

<!-- Bootstrap Core JavaScript -->


<script src="js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
 <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

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
      


 $( function() {
    $( "#App_Deadline_Date" ).datepicker({

      dateFormat: 'yy/mm/dd',
      changeYear: true,
      minDate: 0,

    });

  });




$(function () {
  
  $("#post_jobs").validate({

    rules:{

      Job_Title:{
        required:true,
        
      }, 

      Job_Type:{
        required:true,
        
      },


      Job_Level:{
        required:true,    

      },


      Job_Category:{
        required:true,

      },
    
      Job_Tags:{
        required:true,

      },
      Needs_Employee:{
        required:true,
        
      },

      Gender:{
        required:true,
        
      },

      Job_Tags:{
        required:true,

      },
      Salary:{
        required:true,
        
      },

      Qualification:{
        required:true,

      },
      App_Deadline_Date:{
        required:true,
        
      },

      
       Job_Context:{
        required:true,

      },
       
       Job_Responsiblities:{
        required:true,

      },
        
      Additional_Requirements:{
        required:true,

      },
      
      Compensation:{
        required:true,

      },
      Company_Name:{
        required:true,
        
      },

      Job_Banner:{
         required: true,
         accept:"jpg,png,jpeg,gif",
         maxfilesize: 524288,
         
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

      Job_Banner:{
        required: "Select Image",
        accept: "Only image type jpg/png/jpeg/gif is allowed"
     
      }

    }


  });



});


 
   

   
   
        tinyMCE.init({
            // General options
            mode: "textareas",
            theme: "advanced",
            plugins: "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups",

        });

</script>


   
</body>

</html>



   