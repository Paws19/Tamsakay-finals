<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure the DB connection is correct

if(isset($_POST['create'])) {

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $status = $_POST['status'];
  $vehicle_name = $_POST['vehicle_name'];
  $plate_no = $_POST['plate_no'];
  $available_seat = $_POST['available_seats'];

  // Insert into shuttle_service_tbl
  $query = "INSERT INTO shuttle_driver_tbl (first_name, last_name, status , vehicle_name , available_seats , plate_no) 
VALUES ('$first_name', '$last_name', '$status' , '$vehicle_name',  '$available_seat' , '$plate_no')";

  $execute = mysqli_query($db , $query);

  if($execute){ 
    // For successful insert the data
    echo '<script language="javascript">
    alert("Edit Details Successfully!");
    window.location = "dashboard.php"; 
    </script>';
  } else {
    echo '<script language="javascript">
    alert("Edit Details Unsuccessfully!");
    window.location = "dashboard.php"; 
    </script>';
  }
}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/create.css">
    <title>Form Design</title>
  </head>
  <body>
   <div class="container-fluid bg-dark text-light py-3">
       <header class="text-center">
           <h1 class="display-6">SHUTTLE SERVICE</h1>
       </header>
   </div>
   <section class="container my-2 bg-dark w-50 text-light p-2">
    <form class="row g-3 p-3" method = "POST">
        <h1>Driver information</h1>
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationDefault01" value="" name = "first_name" required>
          </div>
          <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationDefault02" value="" name = "last_name" required>
          </div>
          <div class="col-md-4">
            <label for="validationDefaultUsername" class="form-label">Status</label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend2">@</span>
              <input type="text" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" name = "status" value="" required>
            </div>
          </div>
          <h1>Shuttle information </h1>
          <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Vehicle name</label>
          <input type="text" class="form-control" id="inputEmail4" name = "vehicle_name">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Plate No.</label>
          <input type="text" class="form-control" id="inputEmail4" name = "plate_no">
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Available seats</label>
          <input type="text" class="form-control" id="inputPassword4" name = "available_seats">
        </div>
        
        <div class="col-12">
          <center><button type="submit" class="btn btn-success" name = "create">CREATE </button> </center>
        </div>
      </form>
   </section>
  </body>
</html>