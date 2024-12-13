
<?php 

$host = "localhost"; // Your database host
$username = "root";  // Your database username
$password = "";      // Your database password (default for XAMPP is an empty string)
$database = "tamsakay"; // Replace with your actual database name

// Create a connection using mysqli
$db = new mysqli($host, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>