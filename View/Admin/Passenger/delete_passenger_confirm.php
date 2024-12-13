<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

$id = $_GET['id'];

// Proceed with deletion for both queries
$sql = "DELETE FROM for_user_registration_tbl WHERE user_id = '$id'";
$execute2 = mysqli_query($db, $sql);

// Check if both queries were successful
if($execute2) { 
    // If both deletions were successful
    echo '<script language="javascript">
        alert("Deleted Successfully!");
       window.location = "passenger_info.php"; 
    </script>';
} else {
    // If either deletion failed
    echo '<script language="javascript">
        alert("Deletion Unsuccessful! Please check your database.");
      window.location = "passenger_info.php"; 
    </script>';

    //window.location = "passenger_info.php"; 
}

?>
