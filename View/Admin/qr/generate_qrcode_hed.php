<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/qr_code/phpqrcode/qrlib.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

// Generate QR code with a dynamic filename
$path = $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/qr_code/phpqrcode/img/';
$qrcodeFileName = "hed_qrcode_" . time() . ".png"; // Dynamic file name
$qrcodePath = $path . $qrcodeFileName;

// Set the QR code content URL (fixed for all users)
$qrContent = "http://localhost/Tamsakay/View/Admin/qr/insert_testing.php"; // Static URL

// Generate and save the QR code image
QRcode::png($qrContent, $qrcodePath, 'H', 4, 4);

// Display the generated QR code image
echo "<img src='/Tamsakay/qr_code/phpqrcode/img/" . basename($qrcodePath) . "' alt='Generated QR Code'>";

// Save QR code path in the database
$qrcodePathDB = "/Tamsakay/qr_code/phpqrcode/img/" . $qrcodeFileName; // Path for database (relative to web server root)
$userId = $_SESSION['user_id']; // Assuming you have a user ID in the session

// Prepare and execute the SQL insert statement
$insert = "INSERT INTO qrcode_tbl_hed( qr_code_path) VALUES (?)";
$stmt = mysqli_prepare($db, $insert);
mysqli_stmt_bind_param($stmt, 's',  $qrcodePathDB);

if (mysqli_stmt_execute($stmt)) {
    echo "QR code image path saved successfully in the database.";
} else {
    echo "Error saving QR code image path: " . mysqli_error($db);
}

mysqli_stmt_close($stmt);
?>
