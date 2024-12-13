<?php
header('Content-Type: application/json'); // Ensures JSON response
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['location'])) {
        $location = $_POST['location'];

        // Decrease the passenger count by removing all passengers for the specified location
        $delete_query = "DELETE FROM passenger_logs_hed_tbl WHERE location = ?";

        // Prepare and execute the query
        $stmt = $db->prepare($delete_query);
        $stmt->bind_param("s", $location);

        if ($stmt->execute()) {
            // Check how many rows were affected
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "All passengers dropped off successfully for $location"]);
            } else {
                echo json_encode(["success" => false, "message" => "There are no students at $location"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error updating drop-off."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Location parameter missing."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
