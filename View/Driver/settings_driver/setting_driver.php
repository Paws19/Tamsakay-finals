<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Default profile picture URL
$default_pic_url = "/Tamsakay/View/Driver/settings_driver/pfp/driver_tamtam.png";
$profile_pic_url = $default_pic_url;
$message = '';

// Ensure the user is logged in
if (isset($_SESSION['driver_id'])) {
    $driver_id = $_SESSION['driver_id'];

    // Retrieve the driver's current profile picture
    try {
        $stmt = $db->prepare("SELECT picture_url FROM driver_profile_pic WHERE driver_id = ? LIMIT 1");
        $stmt->bind_param("i", $driver_id);
        $stmt->execute();
        $stmt->bind_result($pic_url);
        if ($stmt->fetch() && !empty($pic_url)) {
            $absolute_path = $_SERVER['DOCUMENT_ROOT'] . $pic_url;
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

    // Handle profile picture upload
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["profile_pic"])) {
        $target_dir = "/Tamsakay/View/Driver/settings_driver/pfp/";
        $target_file = $target_dir . uniqid() . '-' . basename($_FILES["profile_pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($check = getimagesize($_FILES["profile_pic"]["tmp_name"])) {
            $uploadOk = 1;
        } else {
            echo "<p>File is not an image.</p>";
            $uploadOk = 0;
        }

        if ($_FILES["profile_pic"]["size"] > 2000000) {
            echo "<p>File is too large.</p>";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<p>Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
            $uploadOk = 0;
        }

        if ($uploadOk) {
            try {
                $stmt = $db->prepare("SELECT picture_url FROM driver_profile_pic WHERE driver_id = ? LIMIT 1");
                $stmt->bind_param("i", $driver_id);
                $stmt->execute();
                $stmt->bind_result($current_pic_url);
                if ($stmt->fetch() && !empty($current_pic_url)) {
                    $current_pic_absolute_path = $_SERVER['DOCUMENT_ROOT'] . $current_pic_url;
                    if (file_exists($current_pic_absolute_path)) {
                        unlink($current_pic_absolute_path);
                    }
                }
                $stmt->close();

                $stmt = $db->prepare("DELETE FROM driver_profile_pic WHERE driver_id = ?");
                $stmt->bind_param("i", $driver_id);
                $stmt->execute();
                $stmt->close();

                $absolute_path = $_SERVER['DOCUMENT_ROOT'] . $target_file;
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $absolute_path)) {
                    $relative_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $absolute_path);
                    $stmt = $db->prepare("INSERT INTO driver_profile_pic (driver_id, picture_url) VALUES (?, ?)");
                    $stmt->bind_param("is", $driver_id, $relative_path);
                    if ($stmt->execute()) {
                        header("Location: " . $_SERVER['PHP_SELF']);
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

    // Handle Change Password
    if (isset($_POST['change_password'])) {
        $new_password = $_POST['new_password'];
        try {
            $stmt = $db->prepare("UPDATE for_driver_registration_tbl SET driver_password = ? WHERE driver_id = ?");
            $stmt->bind_param("si", $new_password, $driver_id);
            if ($stmt->execute()) {
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
            $stmt = $db->prepare("UPDATE for_driver_registration_tbl SET driver_username = ? WHERE driver_id = ?");
            $stmt->bind_param("si", $new_username, $driver_id);
            if ($stmt->execute()) {
                $message .= "<div class='alert success'>Username updated successfully.</div>";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<p>Error updating username.</p>";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Handle Delete Profile Picture
    if (isset($_POST['delete_profile_picture'])) {
        try {
            $stmt = $db->prepare("DELETE FROM driver_profile_pic WHERE driver_id = ?");
            $stmt->bind_param("i", $driver_id);
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<p>Error deleting profile picture.</p>";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Error deleting profile picture: " . $e->getMessage();
        }
    }
} else {
    echo "Driver is not logged in.";
    exit();
}

$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Settings</title>
   
   <!-- Link to external CSS -->
   <link rel="stylesheet" href="settingsDriver_css.css">
   <script src="darkmode.js"></script>
</head>
<body>
   <div class="container">
       <h2>Settings</h2>

       <!-- Display any messages -->
       <?= isset($message) ? htmlspecialchars($message) : ''; ?>

       <!-- Profile Picture Section -->
       <div class="profile-section">
           <img src="<?= htmlspecialchars($profile_pic_url); ?>" class="profile-picture" onerror="this.onerror=null; this.src='/Tamsakay/View/Driver/settings_driver/pfp/tamtam.jpg';" alt="Profile Picture">

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
           <a href="/Tamsakay/View/Driver/driver_dashboard.php"><button>Back to Home</button></a>
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