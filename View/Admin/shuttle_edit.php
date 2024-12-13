<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure the DB connection is correct 

$id = $_GET['id'];
$select_query = "SELECT 

                    * 
                
                FROM create_shuttle_tbl WHERE shuttle_id = '$id'"; 

$select_execute = mysqli_query($db , $select_query);

while($rows = mysqli_fetch_assoc($select_execute) ){

$shuttle_id  = $rows['shuttle_id'];
$vehiclename = $rows['vehicle_name'];
$vehicletype = $rows['vehicle_type'];
$plateno     = $rows['plate_no'];
$availbleseats = $rows['available_seats'];


}



if(isset($_POST['create'])) {

$vehicle_name = $_POST['vehicle_name'];
$vehicle_type = $_POST['vehicle_type'];
$plate_no     = $_POST['plate_no'];
$availble_seats = $_POST['available_seat'];


$update_query = "UPDATE create_shuttle_tbl 
                 SET vehicle_name = '$vehicle_name', 
                     vehicle_type = '$vehicle_type', 
                     plate_no = '$plate_no', 
                     available_seats = '$availble_seats' 
                 WHERE shuttle_id = '$id'";

$query_execute = mysqli_query($db , $update_query); 

if($query_execute){ 
    // For successful insert the data
    echo '<script language="javascript">
    alert("Edit Details Successfully!");
    window.location = "shuttle_dashboard.php"; 
    </script>';
  } else {
    echo '<script language="javascript">
    alert("Edit Details Unsuccessfully!");
    window.location = "shuttle_dashboard.php"; 
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
    <title>Shuttle service</title>
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
            <input type="text" class="form-control" id="validationDefault01" value="<?php echo $vehiclename?>" name = "vehicle_name" required>
          </div>
          <br>
          <div class="col-md-4">
          <div class="form-group">
                <label for="vehicleType">Vehicle Type</label>
                <select class="form-control" id="vehicleType" value = "<?php echo $vehicletype?>" name="vehicle_type">
                <option  value = "<?php echo $vehicletype?>">Please select type of vehicle</option>
                <option value="VAN">VAN</option>
                <option value="BUS">BUS</option>
                <option value="L3">L3</option>
                 </select>
        </div>
        </div>
          
          
          <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Plate no.</label>
          <input type="text" class="form-control" id="inputEmail4" name = "plate_no" value = "<?php echo $plateno?>">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Available seats</label>
          <input type="text" class="form-control" id="inputEmail4" name = "available_seat" value = "<?php echo $availbleseats?>">
        </div>

        
        <div class="col-12">
          <center><button type="submit" class="btn btn-success" name = "create">UPDATE </button> </center>
        </div>
      </form>
   </section>
  </body>
</html>


