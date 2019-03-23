<?php
  include 'db_connet.php';

$divisionsid = $_POST['divisions'];   // department id

$sql = "SELECT * FROM districts WHERE division_id=".$divisionsid;

$result = mysqli_query($conn,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['id'];
    $name = $row['dis_name'];

    $users_arr[] = array("id" => $userid, "name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);