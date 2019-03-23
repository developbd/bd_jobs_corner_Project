<?php
$servername = "148.66.147.11";
$username = "jobscorner";
$password = "5471px?qhphk";
$dbname = "bdjobs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>