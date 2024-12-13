<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/login_admin_controller.php';

session_start(); // Start session

// Check if user is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
    <style>

body {

display: flex;
}

.sidebar { 

position: sticky;
top: 0;
left: 0;
bottom: 0;
width: 115px;
height: 100vh;
padding: 0 1.7em;
color: aliceblue;
overflow: hidden;
transition: all 0.6s ease-in;
background:rgb(64, 141, 85);


}

.sidebar:hover {

width: 240px;
transition:  0.10s ease-in;

}
.logo {

height: 80px;
padding: 16px;

}

.menu {

height: 88%;
position: relative;
list-style: none;
padding: 0;
}

.menu li { 

padding: 1rem;
margin: 8px 0;
border-radius: 8px;
transition: all 0.6s ease-in-out ;

}

.menu li:hover,
.active { 

background: #FF7F50;
padding: 2px;

}

.menu a {

color: aliceblue;
font-size: large;
text-decoration: none;
display: flex;
align-items: center;
gap: 1.5rem;
}

.menu a span { 

overflow: hidden;

}

.menu a i {

font-size: 1.2rem;
}

.logout {

position: absolute;
bottom:0;
left: 0;
width: 100%;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="#" onclick="loadIframe('driver_dashboard.php'); return false;">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Driver Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('driver_registration.php'); return false;">
                    <i class="fa-solid fa-book"></i>
                    <span>Driver Report</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('shuttle_dashboard.php'); return false;">
                    <i class="fa-solid fa-car"></i>
                    <span>Shuttle </span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('Passenger/passenger_info.php'); return false;">
                    <i class="fas fa-user"></i>
                    <span>Passenger</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('qr/qrcode.php'); return false;">
                    <i class="fa-solid fa-qrcode"></i>
                    <span>Qrcode</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('user_scanned/dashboard.php'); return false;">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>User scanned qrcode</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="loadIframe('archive_table.php'); return false;">
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Recycle</span>
                </a>
            </li>
            <li class="logout">
                <a href="#" onclick="logout(); return false;">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Add an iframe for loading PHP content -->
    <div class="main-content">
        <iframe id="content-frame" src="driver_dashboard.php" style="width:550%; height:750px; border:none;"></iframe>
    </div>

    <script>
        function loadIframe(page) {
            document.getElementById('content-frame').src = page;
        }

        function logout() {
            // Redirect to logout.php, which will handle the session destruction
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>
