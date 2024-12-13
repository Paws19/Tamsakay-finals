<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure db.php contains a mysqli connection

class Driver {

    public $username;
    public $password;

    public function validation($db, $username, $password) {
        // Prepare the SQL statement
        $query = "SELECT driver_username, driver_password FROM for_driver_registration_tbl WHERE driver_username = ? AND driver_password = ?";
        $stmt = $db->prepare($query); // Prepare the statement
        $stmt->bind_param('ss', $username, $password); // Bind parameters

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching record exists
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['driver_logged_in'] = true;
            $_SESSION['driver_username'] = $username;
            echo '<script language="javascript">
                alert("Login Successful");
                window.location="driver_dashboard.php";
            </script>';
            // Redirect to homepage
           // header("Location: homepage.php");
            exit();
        } else {
            // Invalid credentials
            echo '<script>alert("Invalid username or password.");</script>';
        }

        // Close the statement
        $stmt->close();
    }
}

?>
