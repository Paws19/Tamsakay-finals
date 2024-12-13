<?php
// Prevent browser caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/absolute/path/to/View/css/login_admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Login</title>
</head>



<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "css/login_admin.css" />
    <title>Login</title>
 
</head>
<body>


<?php 
//This is the PHP
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/login_admin_controller.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';


if (isset($_POST['submit'])) {
    //variables for user input
    $name = $_POST['username'];
    $pass = $_POST['password'];

    // Create an instance of the User class
    $admin = new Admin(); // Object
    // Call the verification method with the database connection
    $admin->validation($db , $name , $pass);
}

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
  // If logged in, redirect to the homepage/dashboard
  header("Location:login.php");
  exit();
}


?>

<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://cdn-icons-png.flaticon.com/512/9703/9703596.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method = "POST">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <!---<i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> This is the logo---> 
                    <span class="h1 fw-bold mb-0">Admin</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form2Example17" name = "username" class="form-control form-control-lg" /> 
                    <label class="form-label" for="form2Example17">Username</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="form2Example27" name = "password" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="button">Login</button>
                  </div>

                 <!-- Uncomment if needed -->
                 <!-- <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a> -->
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>



</body>
</html>