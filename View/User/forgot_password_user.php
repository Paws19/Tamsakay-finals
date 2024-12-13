<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';  
require $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/vendor/autoload.php';  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_code'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM for_user_registration_tbl WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a random verification code
        $verification_code = rand(100000, 999999);

        // Update the database with the verification code
        $update_query = "UPDATE for_user_registration_tbl SET verification_code = ?, verification_status = 0 WHERE email = ?";
        $stmt = $db->prepare($update_query);
        $stmt->bind_param("ss", $verification_code, $email);

        if ($stmt->execute()) {
            // Send the email with PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pagawpawjemoyacerenado@gmail.com'; // Your email
                $mail->Password = 'ufgj dayy eamf fluu'; // Your app-specific password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('your-email@gmail.com', 'Your Service Name');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Verification Code';
                $mail->Body = "
                    <h2>Password Reset Request</h2>
                    <p>Your verification code is: <strong>$verification_code</strong></p>
                    <p>Please use this code to reset your password.</p>
                ";

                $mail->send();
                echo '<script>alert("Verification code sent to your email.");</script>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo '<script>alert("Failed to update verification code in the database.");</script>';
        }
    } else {
        echo '<script>alert("Email not found.");</script>';
    }
}


if (isset($_POST['reset_password'])) {
    //$email = $_POST['email'];
    $reset_code = $_POST['reset_code'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Verify the reset code and email
    $query = "SELECT * FROM for_user_registration_tbl WHERE verification_code = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $reset_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Check if the verification code is correct and active
        $row = $result->fetch_assoc();
        if ($row['verification_status'] == 0) { // Status 0 indicates the code is valid for use
            // Update the password
            $update_query = "UPDATE for_user_registration_tbl 
                             SET password = ?, verification_code = NULL, verification_status = 1 
                             WHERE verification_code = ?";
            $stmt = $db->prepare($update_query);
            $stmt->bind_param("ss", $new_password,  $reset_code);

            if ($stmt->execute()) {
                echo '<script>alert("Password reset successfully!"); window.location="login_user.php";</script>';
            } else {
                echo '<script>alert("Failed to reset password.");</script>';
            }
        } else {
            echo '<script>alert("This verification code has already been used. Please request a new code.");</script>';
        }
    } else {
        echo '<script>alert("Invalid reset code or email!");</script>';
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Tamsakay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
 
        header {
            background-color: #05683B;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
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
 
        /* Centering the Forgot Password box */
        .container {
            background-color: white;
            margin: 100px auto; /* Center the container with some space from the top */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
            padding: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Hover animation */
        }
 
        /* Hover effect */
        .container:hover {
            transform: scale(1.02); /* Slightly enlarge */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2); /* Stronger shadow */
        }
 
        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: black;
        }
 
        p {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }
 
        form {
            margin-top: 20px;
        }
 
        label {
            font-weight: bold;
            display: block;
            text-align: left;
            margin: 10px 0 5px;
        }
 
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px); /* Adjusted for padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
 
        button {
            display: block;
            width: calc(100% - 20px); /* Adjusted for padding */
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #05683B;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out; /* Smooth animation */
        }
 
        button:hover {
            background-color: #FFBF00;
            transform: scale(1.02); /* Slightly enlarge */
        }
 
        .divider {
            margin: 30px 0;
            border-top: none;
            border-top-width: thin;
        }
 
        /* Footer Styling */
        footer {
            background-color: #FFFFFF;
            color: white;
            text-align: center;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }
 
        footer a {
            color: white;
            text-decoration: none;
        }
 
        footer a:hover {
            text-decoration: underline;
        }
 
        /* Media Queries for Responsiveness */
        @media (max-width: 600px) {
            header h1 {
                font-size: 20px; /* Smaller heading on small screens */
            }
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            h2 {
                font-size: 18px;
            }
            p, label, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="/Tamsakay/Tamsakay Logo.png" alt="Tamsakay Logo" class="logo">
        <h1>Tamsakay Shuttle Service</h1>
    </header>
    <div class="container">
        <h2>Forgot Password</h2>
        <p>Enter your email to receive a verification code and reset your password.</p>
 
        <!-- Step 1: Send Verification Code -->
        <form action="forgot_password_user.php" method="POST">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="e.g., user@example.com" required>
            <button type="submit" name="send_code">Send Verification Code</button>
        </form>
 
        <div class="divider"></div>
 
        <!-- Step 2: Reset Password -->
        <form action="forgot_password_user.php" method="POST">
            <label for="reset_code">Verification Code:</label>
            <input type="text" id="reset_code" name="reset_code" placeholder="6-digit code" required>
           
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
           
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    </div>
 
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tamsakay. All rights reserved.</p>
    </footer>
</body>
</html>