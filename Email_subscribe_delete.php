<?php



include('Db_connet.php');



// check if the 'id' variable is set in URL, and check that it is valid

if (isset($_GET['id']) && is_numeric($_GET['id']))
{

// get id value

$ID = $_GET['id'];



// delete the entry
$sql = "DELETE FROM mail_list WHERE id=$ID";
mysqli_query($conn, $sql);



// redirect back to the view page

header("Location: Email_subscribe_view.php");

}

else

// if id isn't set, or isn't valid, redirect back to view page

{


header("Location: index.php");
mysqli_error($conn);
}



?>