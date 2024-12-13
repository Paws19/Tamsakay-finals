<?php 


//include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/Controller/active.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php';

$sql = "SELECT 
          
          *

        FROM 
          for_user_registration_tbl";

$execute = mysqli_query($db , $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Info</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>


<div class="container mt-5">
    <h2 class="mb-4">Passenger Information</h2>
    <table class="table table-hover table-striped">
   
        <thead class="thead-dark">
       
            <tr>
            
           
                <th scope="col">Passenger #</th>
                <th scope="col">Passenger Firstname</th>
                <th scope="col">Passenger Lastname</th>
                <th scope="col">Passenger Email</th>
                <th scope="col">Passenger Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        
        while($rows = mysqli_fetch_assoc($execute)) { 
            $user_id = $rows['user_id'];
            $first_name = $rows['first_name'];
            $last_name = $rows['last_name'];
            $email = $rows['email'];
            $passenger_type = $rows['passenger_type'];
        
        ?>

            <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $first_name; ?></td>
                <td><?php echo $last_name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $passenger_type; ?></td>
                <td>
                    <a href="edit_passenger_info.php?passenger_id=<?php echo $user_id; ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $user_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                   
                </td>
            </tr>


        <?php 
        }
        ?>

      
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
    $(document).ready(function() {
        $('table').DataTable({
            dom: 'Bfrtip',
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        });
    });
</script>



</body>
</html>
