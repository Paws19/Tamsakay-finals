<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/Registration_user.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

if (isset($_POST['submit'])) {
    // Variables for user input
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $list = $_POST['passenger_type'];

    // Registration logic
    $registration = new User_registration(); // Object
    $registration->registration($db, $first_name, $last_name, $username, $password, $email, $list);
}
?>

<div class="container mx-auto mt-10">
    <div class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Passenger Info</h2>
        
        <form method="POST" class="space-y-5">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-300" required>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-300" required>
            </div>

            <div>
                <label for="passenger_type" class="block text-sm font-medium text-gray-700">Where are you at ?</label>
                <select name="passenger_type" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-300" required>
                    <option value="" selected>Please select current location:L</option>
                    <option value="STUDENT">HED</option>
                    <option value="FACULTY">BED</option>
                    <option value="VISITOR">MAINGATE</option>
                </select>
            </div>
          
            </div>
            <div class="flex justify-center">
                <button type="submit" name="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-700 transition duration-300">Submit</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
