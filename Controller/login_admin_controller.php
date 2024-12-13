<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

class Admin {
    public function validation($db, $username, $password) {
        // Check if fields are empty
        if (empty($username) || empty($password)) {
            echo '<script>alert("Please fill in all fields.");</script>';
            return;
        }

        // SQL query to validate username and password directly
        $query = "SELECT admin_username FROM admin WHERE admin_username = ? AND admin_password = ?";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            die("Database error: " . $db->error);
        }

        // Bind username and password parameters
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching record exists
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            echo '<script language="javascript">
                alert("Login Successful");
                window.location="homepage.php";
            </script>';
            // Redirect to homepage
           // header("Location: homepage.php");
            exit();
        } else {
            // Invalid credentials
            echo '<script>alert("Invalid username or password.");</script>';
        }

        $stmt->close();
    }
}
?>
