<?php
session_start(); // Start session
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

// Ensure driver ID is set in session
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

if (!isset($_SESSION['driver_id'])) {
    echo 'Driver ID not set in session.';
    exit();
}

$driver_id = $_SESSION['driver_id'];

// Check if the form is submitted and the required fields are set
if (isset($_POST['status'])) {
    $status = $_POST['status'];

    // SQL query to insert or update the status of the driver
    // This will update the status if a row with the same driver_id exists
    $insert_query = "
        INSERT INTO driver_status (driver_id, status_driver) 
        VALUES (?, ?) 
        ON DUPLICATE KEY UPDATE status_driver = VALUES(status_driver)
    ";

    // Prepare and execute the statement
    if ($stmt = $db->prepare($insert_query)) {
        $stmt->bind_param("is", $driver_id, $status); // Bind both driver ID and status

        if ($stmt->execute()) {
            echo '<script>alert("Status updated successfully!");</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating status. Please try again.</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to prepare statement.</div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">Dont forget to select a status. . . </div>';
}


?>



<!DOCTYPE html> 
<html lang="en"> 
<head> 

  <title>Driver Dashboard</title> 

  <meta charset="utf-8"> 

  <meta name="viewport" content="width=device-width, initial-scale=1"> 

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

  <style> 

    .row.content {height: 550px} 

    .sidenav {background-color: #f1f1f1; height: 100%;} 

    @media screen and (max-width: 767px) {.row.content {height: auto;}} 

 

    .status-btn { 

        padding: 10px 20px; 

        margin: 5px; 

        font-size: 16px; 

        color: white; 

        border: none; 

        border-radius: 5px; 

    } 

    .on-break {background-color: #f39c12;} 

    .on-the-way {background-color: #27ae60;} 

    .not-available {background-color: #e74c3c;} 

  </style> 

</head> 

<body> 

 

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

        <li><a href="/Tamsakay/View/Driver/settings_driver/setting_driver.php">Settings</a></li> 

        <li><a href="logout.php">Logout</a></li> 

      </ul> 

    </div> 

  </div> 

</nav> 

 

<div class="container-fluid"> 

  <div class="row content"> 

    <div class="col-sm-3 sidenav hidden-xs"> 

      <h2>Logo</h2> 

      <ul class="nav nav-pills nav-stacked"> 

        <li class="active"><a href="#section1">Dashboard</a></li> 

        <li><a href="/Tamsakay/View/Driver/settings_driver/setting_driver.php">Settings</a></li> 

      </ul><br> 

    </div> 

    <br> 

     

    <?php 

    include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; 

 

    // Query to count passengers per location 

    $SELECT = "SELECT location, COUNT(*) as total_passenger 

               FROM passenger_logs_hed_tbl 

               WHERE location IN ('HED', 'BED', 'MAINGATE') 

               GROUP BY location"; 

 

    $execute = mysqli_query($db, $SELECT); 

 

    // Initialize location counts 

    $passengerCounts = ['HED' => 0, 'BED' => 0, 'MAINGATE' => 0]; 

 

    // Fetch results and populate the counts 

    while ($row = mysqli_fetch_assoc($execute)) { 

        $location = $row['location']; 

        $passengerCounts[$location] = $row['total_passenger']; 

    } 

    ?> 

 

    <div class="col-sm-9"> 

        <div class="well"> 

            <h2>HED</h2> 

            <button class="btn btn-info" onclick="dropOff('HED')">Drop Off</button> 

            <p id="hed-count"><?php echo $passengerCounts['HED']; ?> students</p> 

        </div> 

         

        <div class="row"> 

            <div class="col-sm-3"> 

                <div class="well"> 

                    <h2>BED</h2> 

                    <button class="btn btn-info" onclick="dropOff('BED')">Drop Off</button> 

                    <p id="bed-count"><?php echo $passengerCounts['BED']; ?> students</p>  

                </div> 

            </div> 

             

            <div class="col-sm-3"> 

                <div class="well"> 

                    <h2>MAIN GATE</h2> 

                    <button class="btn btn-info" onclick="dropOff('MAINGATE')">Drop Off</button> 

                    <p id="maingate-count"><?php echo $passengerCounts['MAINGATE']; ?> students</p>  

                </div> 

            </div> 

        </div> 

    </div> 

 

    <script> 

   function dropOff(location) { 

    $.ajax({ 

        type: "POST", 

        url: "drop_off.php", 

        data: { location: location }, 

        dataType: "json", // Ensure the response is parsed as JSON 

        success: function(response) { 

            console.log(response); // Log the response for debugging 

            if (response.success) { 

                document.getElementById(location.toLowerCase() + '-count').innerText = "0 students"; 

                alert(response.message); 

            } else { 

                alert("Error: " + response.message); 

            } 

        }, 

        error: function(jqXHR, textStatus, errorThrown) { 

            console.log("AJAX error:", textStatus, errorThrown); // Log any AJAX errors 

            alert("Failed to update drop-off. Please try again."); 

        } 

    }); 

} 

 

    </script> 

     



<h2>Driver Status</h2> 

<form method="POST"> 
    <!-- Add a hidden input to pass the driver_id -->
    <input type="hidden" name="driver_id" value="<?php echo $_SESSION['driver_id']; ?>"> <!-- Replace '1' with dynamic driver ID -->

    <center> 
        <button type="submit" name="status" value="On Break" class="status-btn on-break">On Break</button> 
        <button type="submit" name="status" value="On the Way HED" class="status-btn on-the-way">On the Way <strong>HED</strong></button> 
        <button type="submit" name="status" value="On the Way MAINGATE" class="status-btn on-the-way">On the Way  <strong>MAINGATE</strong></button> 
        <button type="submit" name="status" value="Not Available" class="status-btn not-available">Not Available</button> 
    </center> 
</form> 


 

    <p id="status-display">Current Status: <strong><span id="current-status"> 

        <?php echo isset($status) ? $status : "None"; ?> 

    </span></strong></p> 

  </div> 

</div> 

 

</body> 

</html> 

 

 


 