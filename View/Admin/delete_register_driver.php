<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';
$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete passenger info</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script language="javascript">
// SweetAlert2 confirmation prompt
Swal.fire({
    title: "Are you sure?",
    text: "Do you really want to delete this driver and all related records?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, keep it"
}).then((result) => {
    if (result.isConfirmed) {
        // If confirmed, proceed with deletion via PHP
        window.location = "delete_register_driver_confirm.php?driver_id=<?php echo $id; ?>"; // Redirect to a separate file to handle the deletion
    } else {
        // If canceled, redirect back to the driver dashboard
        window.location = "driver_registration.php";
    }
});
</script>

</body>
</html>
