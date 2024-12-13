<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Include database connection

// Check if the connection is established
if (!$db) {
    die("Database connection failed."); // Stop execution if no DB connection
}



// Check if `user_id` is provided in the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Ensure user_id is an integer

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO passenger_logs_hed_tbl (user_id, scan_time , location) VALUES (?, NOW() , 'HED')");
        $stmt->bind_param("i", $user_id); // Bind parameters (i for integer)
        $stmt->execute(); // Execute the prepared statement

        echo '<script language="javascript">
        alert("User credentials inserted successfully");
      
       </script>';
   
       //  window.location = "driver_registration.php"; echo "User credentials inserted successfully."; // Success message
    } catch (mysqli_sql_exception $e) {
        // Handle any SQL errors
        echo "Error inserting user credentials: " . $e->getMessage();
    }
} else {
    echo "User ID not provided."; // Message when user ID is not set
}
// // Add the current user to the waiting room table if not already added
// $add_user_sql = "INSERT INTO passenger_logs_hed_tbl (user_id) VALUES (?)
//ON DUPLICATE KEY UPDATE user_id = user_id"; // Prevent duplication
// $stmt = $db->prepare($add_user_sql);

// if ($stmt) {
//$stmt->bind_param("i", $user_id);
//$stmt->execute();
//$stmt->close();
// } else {
//die("Error adding user to waiting room: " . $db->error);
?>
