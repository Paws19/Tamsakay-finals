<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

$id = $_GET['id'];

// First, delete the related records from the shuttle_service_tbl
$sql1 = "DELETE FROM create_shuttle_tbl WHERE shuttle_id = '$id'";
$execute1 = mysqli_query($db, $sql1);

// Now, proceed to delete the driver
$sql2 = "DELETE FROM for_driver_registration_tbl WHERE driver_id = '$id'";
$execute2 = mysqli_query($db, $sql2);

// Check if both queries were successful
if($execute1 && $execute2) { 
    // If both deletions were successful
    echo '<script language="javascript">
        alert("Deleted Successfully!");
        window.location = "driver_dashboard.php"; 
    </script>';
} else {
    // If either deletion failed
    echo '<script language="javascript">
        alert("Deletion Unsuccessful! Please check your database.");
        window.location = "driver_dashboard.php"; 
    </script>';
}
?>
