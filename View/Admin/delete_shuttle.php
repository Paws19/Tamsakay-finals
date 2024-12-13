<?php 

$id = $_GET['shuttle_id']; 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

// Check if the ID is a valid number
if (!isset($id) || !is_numeric($id)) {
    die("Invalid ID");
}

$sql = "DELETE FROM create_shuttle_tbl WHERE shuttle_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id); // "i" means the parameter is an integer

$execute = $stmt->execute();

if ($execute) {
    echo '<script language="javascript">
    alert("Deleted Successfully!");
    window.location = "shuttle_dashboard.php"; 
    </script>';
} else {
    echo '<script language="javascript">
    alert("Deletion Failed: ' . $db->error . '");
    window.location = "shuttle_dashboard.php"; 
    </script>';
}

$stmt->close();
$db->close();
?>
