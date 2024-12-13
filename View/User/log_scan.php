<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

// Retrieve posted data
$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id']; // Logged-in user ID
$qr_data = $data['qr_data']; // QR data from the scan

// Ensure database connection
if (!$db) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

// Insert scan data into database
try {
    $stmt = $db->prepare("INSERT INTO passenger_logs_hed_tbl (user_id, location, scan_time, qr_data) VALUES (?, 'HED', NOW(), ?)");
    $stmt->bind
