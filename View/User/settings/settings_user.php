<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Default profile picture URL
$default_pic_url = "/Tamsakay/View/User/settings/pfp/tamtam.png";
$profile_pic_url = $default_pic_url;
$message = ''; // Variable to hold success/error messages

// Ensure the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Retrieve the user's current profile picture
    try {
        $stmt = $db->prepare("SELECT pic_url FROM profile_pic WHERE user_id = ? LIMIT 1");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($pic_url);

        if ($stmt->fetch() && !empty($pic_url)) {
            $absolute_path = $_SERVER['DOCUMENT_ROOT'] . $pic_url;

            // Check if the profile picture file exists
            if (file_exists($absolute_path)) {
                $profile_pic_url = htmlspecialchars($pic_url);
            } else {
                error_log("Profile picture file not found: " . $absolute_path);
            }
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "Error retrieving profile picture: " . $e->getMessage();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["profile_pic"])) {
        // Prepare to upload the new image
        $target_dir = "/Tamsakay/View/User/settings/pfp/";
        // Generate a unique filename to prevent overwriting
        $target_file = $target_dir . uniqid() . '-' . basename($_FILES["profile_pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if the file is an image
        if ($check = getimagesize($_FILES["profile_pic"]["tmp_name"])) {
            $uploadOk = 1;
        } else {
            echo "<p>File is not an image.</p>";
            $uploadOk = 0;
        }
    
        // Check file size (limit to 2MB)
        if ($_FILES["profile_pic"]["size"] > 2000000) {
            echo "<p>File is too large.</p>";
            $uploadOk = 0;
        }
    
        // Allow specific file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<p>Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
            $uploadOk = 0;
        }
    
        // Attempt to upload the file
        if ($uploadOk) {
            try {
                // Fetch the current profile picture URL from the database
                $stmt = $db->prepare("SELECT pic_url FROM profile_pic WHERE user_id = ? LIMIT 1");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $stmt->bind_result($current_pic_url);
                if ($stmt->fetch() && !empty($current_pic_url)) {
                    $current_pic_absolute_path = $_SERVER['DOCUMENT_ROOT'] . $current_pic_url;
    
                    // Delete the current profile picture file from the server
                    if (file_exists($current_pic_absolute_path)) {
                        unlink($current_pic_absolute_path); // Delete the file
                    }
                }
                $stmt->close();
    
                // Delete the existing database record first
                $stmt = $db->prepare("DELETE FROM profile_pic WHERE user_id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $stmt->close();
    
                // Move the new uploaded file to the target directory
                $absolute_path = $_SERVER['DOCUMENT_ROOT'] . $target_file;
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $absolute_path)) {
                    // Save the new file path in the database (store relative path)
                    $relative_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $absolute_path);
    
                    // Insert the new profile picture into the database
                    $stmt = $db->prepare("INSERT INTO profile_pic (user_id, pic_url) VALUES (?, ?)");
                    $stmt->bind_param("is", $user_id, $relative_path);
                    if ($stmt->execute()) {
                        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to show the new picture
                        exit();
                    } else {
                        echo "<p>Error saving profile picture to database.</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p>Error uploading your file.</p>";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
    

    // Handle Change Password without hashing
    if (isset($_POST['change_password'])) {
        $new_password = $_POST['new_password'];
        
        try {
            // Update password directly without hashing as per request
            $stmt = $db->prepare("UPDATE for_user_registration_tbl SET password = ? WHERE user_id = ?");
            $stmt->bind_param("si", $new_password, $user_id); 
            if ($stmt->execute()) {
                // Set success message for UI display
                $message .= "<div class='alert success'>Password updated successfully.</div>";
            } else {
                echo "<p>Error updating password.</p>";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Handle Change Username
    if (isset($_POST['change_username'])) {
        try {
            $new_username = $_POST['new_username'];
            // Update username in database
            $stmt = $db->prepare("UPDATE for_user_registration_tbl SET user_name = ? WHERE user_id = ?");
            $stmt->bind_param("si", $new_username, $user_id);
            if ($stmt->execute()) {
                // Set success message for UI display
                $message .= "<div class='alert success'>Username updated successfully.</div>";
                header("Location: " . $_SERVER['PHP_SELF']); // Refresh to show updated username
                exit();
            } else {
                echo "<p>Error updating username.</p>";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Error: " . e.getMessage();
        }
    }

    // Handle Delete Profile Picture
    if (isset($_POST['delete_profile_picture'])) {
        try {
            // Delete old profile picture from database
            $stmt = $db->prepare("DELETE FROM profile_pic WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            
           if ($stmt->execute()) { 
               header("Location: " . $_SERVER['PHP_SELF']); 
               exit(); 
           } else { 
               echo "<p>Error deleting profile picture.</p>"; 
           } 
           stmt.close(); 
       } catch (Exception) { 
           echo "Error deleting profile picture: " . e.getMessage(); 
       } 
   } 
} else { 
   echo "User is not logged in."; 
   exit(); 
}

// Close the database connection 
$db->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Settings</title>
   
   <!-- Link to external CSS -->
   <link rel="stylesheet" href="settings_css.css">
   <script src="darkmode.js"></script>
</head>
<body>
   <div class="container">
       <h2>Settings</h2>

       <!-- Display any messages -->
       <?= isset($message) ? htmlspecialchars($message) : ''; ?>

       <!-- Profile Picture Section -->
       <div class="profile-section">
           <img src="<?= htmlspecialchars($profile_pic_url); ?>" class="profile-picture" onerror="this.onerror=null; this.src='/Tamsakay/View/User/settings/pfp/tamtam.jpg';" alt="Profile Picture">

           <form action="" method="POST" enctype="multipart/form-data" class="upload-form">
               <input type="file" name="profile_pic" accept="image/*" required>
               <button type="submit">Upload</button>
           </form>

           <!-- Button to Open Change Password Modal -->
           <button id="openPasswordModal">Change Password</button>

           <!-- Button to Delete Profile Picture -->
           <form action="" method="POST" style="display:inline;">
               <button type="submit" name="delete_profile_picture">Delete Profile Picture</button>
           </form>
       </div>

       <!-- Change Password Modal -->
       <div id="passwordModal" class="modal">
           <div class="modal-content">
               <span class="close">&times;</span>
               <h3>Change Password</h3>
               <form action="" method="POST">
                   <input type="password" name="new_password" placeholder="New Password" required>
                   <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                   <button type="submit" name="change_password">Change Password</button>
               </form>
           </div>
       </div>

       <!-- Change Username Section -->
       <div class="change-username-section">
           <h3>Change Username</h3>
           <form action="" method="POST">
               <input type="text" name="new_username" placeholder="New Username" required>
               <button type="submit" name="change_username">Change Username</button>
           </form>
       </div>

       <!-- Dark Mode Toggle -->
       <div class="dark-mode-toggle">
           <h3>Dark Mode</h3>
           <button id="darkModeToggle">Toggle Dark Mode</button>
       </div>

       <!-- Back Button -->
       <div class="back-button">
           <a href="/Tamsakay/View/User/dashboard_user.php"><button>Back to Home</button></a>
       </div>

   </div>

   <script>
       // Modal Script
       const modal = document.getElementById('passwordModal');
       const openModalButton = document.getElementById('openPasswordModal');
       const closeModalButton = document.getElementsByClassName('close')[0];

       openModalButton.onclick = function() {
           modal.style.display = 'block';
       }

       closeModalButton.onclick = function() {
           modal.style.display = 'none';
       }

       window.onclick = function(event) {
           if (event.target == modal) {
               modal.style.display = 'none';
           }
       }
   </script>

</body>
</html>