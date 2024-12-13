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
        <h1>Shuttle information</h1>
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Vehicle name</label>
            <input type="text" class="form-control" id="validationDefault01" value="" name = "vehicle_name" required>
          </div>
          <br>
          <div class="col-md-4">
          <div class="form-group">
                <label for="vehicleType">Vehicle Type</label>
                <select class="form-control" id="vehicleType" name="vehicle_type">
                <option value="SELECTED">Please select type of vehicle</option>
                <option value="VAN">VAN</option>
                <option value="BUS">BUS</option>
                <option value="L3">L3</option>
                 </select>
        </div>
        </div>
          
          
          <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Plate no.</label>
          <input type="text" class="form-control" id="inputEmail4" name = "plate_no">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Available seats</label>
          <input type="text" class="form-control" id="inputEmail4" name = "available_seat">
        </div>

        
        <div class="col-12">
          <center><button type="submit" class="btn btn-success" name = "create">CREATE </button> </center>
        </div>
      </form>
   </section>
  </body>
</html>


<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure the DB connection is correct 

if(isset($_POST['create'])) {

$vehicle_name = $_POST['vehicle_name'];
$vehicle_type = $_POST['vehicle_type'];
$plate_no     = $_POST['plate_no'];
$availble_seats = $_POST['available_seat'];


$insert_query = "INSERT INTO create_shuttle_tbl(vehicle_name , vehicle_type , plate_no , available_seats) 
                VALUES ('$vehicle_name' , '$vehicle_type' , '$plate_no' , '$availble_seats')";

$query_execute = mysqli_query($db , $insert_query); 

if($query_execute){ 
    // For successful insert
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script language="javascript">
        Swal.fire({
            title: "Success!",
            text: "Added Successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "shuttle_dashboard.php"; 
            }
        });
    </script>';
} else {
    // For unsuccessful insert
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script language="javascript">
        Swal.fire({
            title: "Error!",
            text: "Added Unsuccessfully!",
            icon: "error",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "shuttle_dashboard.php"; 
            }
        });
    </script>';
}

}

?>