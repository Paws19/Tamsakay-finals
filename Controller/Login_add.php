<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure db.php contains a mysqli connection

class User {

    public string $name;
    public string $pass;

   
    // Method for verifying credentials
    public function verification( $db , $name , $pass): void {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT user_name, password FROM for_user_registration_tbl WHERE user_name = '$name' AND password = '$pass'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if any rows are returned
        if ($result->num_rows > 0) {
            echo '<script language="javascript">
            alert("Login Successful");
            window.location="Homepage_user.php";
            </script>';
        } else {
            echo '<script language="javascript">
            alert("Invalid credentials, please try again.");
            </script>';
        }
    
        // Close the statement
        $stmt->close();
    }

       
        


    
}
?>
