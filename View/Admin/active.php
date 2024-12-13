<?php 


include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

$id = $_GET['id'];
$status = $_GET['status'];

$updatequery = "UPDATE for_driver_registration_tbl SET driver_status = '$status' WHERE driver_id = '$id'";
mysqli_query($db, $updatequery);

header('location:driver_dashboard.php');


?>