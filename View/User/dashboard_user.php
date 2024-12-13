<?php
session_start();



// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_user.php"); // Redirect to login page if not logged in
    exit();
}
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

    $is_user_in_log = false; 
    // Initialize variable to check user presence
    $user_id = intval($_SESSION['user_id']); // Get user_id from session
    // Fetch the username from for_user_registration_tbl
$username = "User "; // Default value
$username_query = "SELECT user_name FROM for_user_registration_tbl WHERE user_id = ?";
if ($stmt = $db->prepare($username_query)) {
    $stmt->bind_param("i", $user_id); // Bind user ID
    $stmt->execute();
    $stmt->bind_result($fetched_username); // Fetch username
    if ($stmt->fetch()) {
        $username = $fetched_username; // Assign fetched username to variable
    }
    $stmt->close();
} else {
    echo "Error fetching username.";
}
$user_location = null; // Initialize $user_location

// Initialize variables
$is_user_in_log = false;
$user_location = null;
$valid_locations = ['HED', 'BED', 'MAINGATE']; // Valid locations

$user_id = intval($_SESSION['user_id']); // Get user_id from session

// Fetch the user's location from passenger_logs_hed_tbl
$sql = "SELECT location FROM passenger_logs_hed_tbl WHERE user_id = ?";
if ($stmt = $db->prepare($sql)) {
    $stmt->bind_param("i", $user_id); // Bind user ID
    $stmt->execute();
    $stmt->bind_result($location); // Fetch location
    if ($stmt->fetch()) {
        $is_user_in_log = true; // User is in log
        $user_location = $location; // Normalize to lowercase
    }
    $stmt->close();
} else {
    echo "Error fetching user location.";
}

    // Query to check if user_id exists in passenger_logs_hed_tbl
    $sql = "SELECT COUNT(*) as count FROM passenger_logs_hed_tbl WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        $is_user_in_log = true; // User is in log
    }



// Initialize driver name and status
$driver_name = "Unknown Driver";
$driver_status = "No status set";

// Ensure driver ID is set in session
if (isset($_SESSION['driver_id'])) {
    $driver_id = $_SESSION['driver_id'];

    // Fetch driver's first name from for_driver_registration_tbl
    $driver_name_query = "SELECT driver_first_name FROM for_driver_registration_tbl WHERE driver_id = ?";
    if ($stmt = $db->prepare($driver_name_query)) {
        $stmt->bind_param("i", $driver_id); // Bind driver ID
        $stmt->execute();
        $stmt->bind_result($driver_first_name); // Fetch driver first name
        if ($stmt->fetch()) {
            $driver_name = $driver_first_name; // Assign name to variable
        }
        $stmt->close();
    } else {
        echo "Error fetching driver name.";
    }

    
    // Fetch driver's status from driver_status table
    $status_query = "SELECT status_driver FROM driver_status WHERE driver_id = ?";
    if ($stmt = $db->prepare($status_query)) {
        $stmt->bind_param("i", $driver_id); // Bind driver ID
        $stmt->execute();
        $stmt->bind_result($status_driver); // Fetch status
        if ($stmt->fetch()) {
            $driver_status = $status_driver; // Assign status to variable
        }
        $stmt->close();
    } else {
        echo "Error fetching driver status.";
    }

    // Fetch the type of shuttle assigned to the driver
$shuttle_query = "SELECT vehicle_type FROM create_shuttle_tbl WHERE driver_id = ?";
$vehicle_type = "Not assigned"; // Initialize to avoid warnings

if ($stmt = $db->prepare($shuttle_query)) {
    $stmt->bind_param("i", $driver_id); // Bind driver ID
    $stmt->execute();
    $stmt->bind_result($fetched_vehicle_type); // Fetch result into a variable
    if ($stmt->fetch()) {
        $vehicle_type = $fetched_vehicle_type; // Assign fetched value
    } else {
        $vehicle_type = "Not assigned"; // Fallback value if no record is found
    }
    $stmt->close();
} else {
    echo "Error preparing the shuttle query.";
}



        
// Fetch the picture URL for the driver
$driver_pic_query = "SELECT picture_url FROM driver_profile_pic WHERE driver_id = ?";
$driver_picture_url = ""; // Default to an empty string

if ($stmt = $db->prepare($driver_pic_query)) {
    $stmt->bind_param("i", $driver_id); // Bind driver ID (ensure this is an integer)
    
    // Execute the query
    $stmt->execute();
    
    // Bind the result
    $stmt->bind_result($picture_url);
    
    // Fetch the result
    if ($stmt->fetch()) {
        $driver_picture_url = $picture_url; // Assign fetched value to variable
    } else {
        $driver_picture_url = "/Tamsakay/View/Driver/settings_driver/pfp/driver_tamtam.png"; // Fallback image
    }
    
    $stmt->close();
} else {
    echo "Error preparing the query.";
}


}
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <title>User Dashboard</title> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
  <link href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/assets/plugins/bootstrap341/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/assets/plugins/swiper/css/swiper.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGINS -->
    <!-- BEGIN PAGES CSS -->
    <link class="main-stylesheet" href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="https://feuroosevelt.edu.ph/wp-content/themes/feu_theme/pages/css/pages-icons.css" rel="stylesheet" type="text/css" />
    <style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f7f6;
    }

    header {
        background-color: #05683B;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        width: 50px;
        margin-right: 15px;
    }

    header h1 {
        color: white;
        font-size: 24px;
        margin: 0;
    }

    /* Navbar for mobile */
    .navbar-nav {
        display: flex;
        justify-content: space-around;
        width: 100%;
    }

    .navbar-nav a {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        font-size: 18px;
    }

    .navbar-nav a:hover {
        background-color: #028e68;
        border-radius: 5px;
    }

    .navbar-inverse .navbar-toggle {
        background-color: #05683B;
    }

    .navbar-inverse .navbar-toggle .icon-bar {
        background-color: white;
    }

    /* Buttons and content styling */
    .content {
        text-align: center;
        margin: 20px;
    }

    .content h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .content button {
        background-color: #007bff;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        margin: 10px;
    }

    .content button:hover {
        background-color: #0056b3;
    }

    /* Status Box Styling */
    .status-driver {
        margin-top: 30px;
        padding: 30px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
        width: 70%;
        margin: 30px auto;
        text-align: center;
    }

    .status-driver img {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 3px solid #007bff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        margin-bottom: 15px;
    }

    .status-driver h1,
    .status-driver h3 {
        margin: 10px 0;
        color: #444;
    }

    .status-driver h1 span,
    .status-driver h3 span {
        color: #007bff;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: flex-start;
            display:none;
        }

        .navbar-nav {
            display: block;
            width: 100%;
        }

        .navbar-nav a {
            display: block;
            padding: 12px;
            font-size: 16px;
            text-align: left;
        }

        .content button {
            width: 100%;
            padding: 14px 0;
            font-size: 16px;
        }

        .status-driver {
            width: 90%;
            padding: 20px;
        }

        .status-driver img {
            width: 150px;
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .content h2 {
            font-size: 20px;
        }

        .content button {
            font-size: 16px;
            padding: 12px 16px;
        }

        .status-driver h1 {
            font-size: 22px;
        }

        .status-driver h3 {
            font-size: 20px;
        }
    }
</style>

</head>

<header>
    <img src="/Tamsakay/Tamsakay Logo.png" alt="Tamsakay Logo" class="logo">
    <h1>Tamsakay</h1>
    <div>
        <a href="dashboard_user.php">Dashboard</a>
        <a href="settings/settings_user.php">Settings</a>
    </div>
</header>

<nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Tamsakay</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="settings/settings_user.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="content">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <a href="scanner.php">
        <button type="button" class="btn btn-primary">
            Scan QR Code
        </button>
    </a>
    
    <!-- Button for Waiting Room HED -->
    <a href="/Tamsakay/View/Admin/qr/User/waiting_room_hed.php">
        <button type="button" class="btn btn-primary" 
            <?php echo ($is_user_in_log && $user_location === 'HED') ? '' : 'disabled'; ?>>
            Go to Waiting Room HED
        </button>
    </a>

    <!-- Button for Waiting Room BED -->
    <a href="/Tamsakay/View/Admin/qr/User/waiting_room_bed.php">
        <button type="button" class="btn btn-primary" 
            <?php echo ($is_user_in_log && $user_location === 'BED') ? '' : 'disabled'; ?>>
            Go to Waiting Room BED
        </button>
    </a>

    <!-- Button for Waiting Room Gate -->
    <a href="/Tamsakay/View/Admin/qr/User/waiting_room_gate.php">
        <button type="button" class="btn btn-primary" 
            <?php echo ($is_user_in_log && $user_location === 'MAINGATE') ? '' : 'disabled'; ?>>
            Go to Waiting Room Gate
        </button>
    </a>
</div>

<div class="status-driver">
    <div class="image_ni_driver">
        <h3>Picture ni Kuya Driver:</h3>
        <img src="<?php echo htmlspecialchars($driver_picture_url); ?>" alt="Driver Picture">
    </div>

    <h1>Name ni Driver: <span><?php echo htmlspecialchars($driver_name); ?></span></h1>
    <h3>Status ni Driver: <strong style="color: #28a745;"><?php echo htmlspecialchars($driver_status); ?></strong></h3>
    <h3>Type ng Shuttle: <span style="color: #ff7f50;"><?php echo htmlspecialchars($vehicle_type); ?></span></h3>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
