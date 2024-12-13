
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/login_admin_controller.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/active.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';
$id = $_GET['id'];
$sql = "SELECT 
          *
        FROM 
          for_driver_registration_tbl
       
        WHERE driver_id = '$id'";

$execute = mysqli_query($db , $sql);

while($rows = mysqli_fetch_assoc($execute)) { 

    $driver = $rows['driver_id'];
    $first_name = $rows['driver_first_name'];
    $last_name = $rows['driver_last_name'];
   

}

if(isset($_POST['edit'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];


    $update = "UPDATE for_driver_registration_tbl 
    
                 SET driver_first_name = '$first_name',
                     driver_last_name = '$last_name'
                WHERE driver_id = '$id';";


    $execute = mysqli_query($db , $update);
    
    if($execute){ 

        //for successfull insert the data
     echo '<script language="javascript">
     alert("Edit Details Successfully!");
    window.location = "driver_registration.php"; 
    </script>';


    } else {

        echo '<script language="javascript">
        alert("Edit Details Unsuccessfully!");
       window.location = "driver_dashboard.php"; 
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
    <title>Edit</title>
  </head>
  <body>
   <div class="container-fluid bg-dark text-light py-3">
       <header class="text-center">
           <h1 class="display-6">Driver Information</h1>
       </header>
   </div>
   <br>
 
   <section class="container my-2 bg-dark w-50 text-light p-2">
    <form class="row g-3 p-3" method = "POST">
        <h1>Driver information</h1>
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationDefault01" name = "first_name" value="<?php echo "$first_name"?>" required>
          </div>
          <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationDefault02" name = "last_name" value="<?php echo "$last_name"?>" required>
          </div>
       
        <div class="col-12">
          <center><button type="submit" class="btn btn-success" name = "edit">UPDATE </button> </center>
        </div>
      </form>
   </section>
  </body>
</html>