<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/Tamsakay/db.php'; // Ensure db.php contains a mysqli connection

// Create an instance of the User class
class Driver_verification{

    //Create attributes for verification code
    public int $verification_code = 0;

    //add method for verify the code
    public function verify_code($db,$verification_code) {

        $sts = $db->prepare("SELECT verification_code FROM for_driver_registration_tbl WHERE verification_code = ?");
        $sts->bind_param('i', $verification_code);
        $sts->execute();
        $result = $sts->get_result();
        $row = $result->fetch_assoc();
      
        // if ($row['verification_code'] == $verification_code) {
        //     echo 'Verified';
        // } else {
        //     echo 'Invalid verification code';
        // }

        if(mysqli_num_rows($result) > 0) {

            $update = $db->prepare("UPDATE for_driver_registration_tbl SET verification_status = 1 WHERE verification_code = ?");
            $update->bind_param('i', $verification_code);
            $update->execute();
        
            echo '<script language = "javascript">
            alert("Verify successfully!");
            window.location="login.php";
            </script>';


        }else {

           // echo "Error: ". mysqli_error($db);
        
            //for successfull insert the data
            echo '<script language="javascript">
            alert("Wrong verification code!"); 
            </script>';
        }

    }

  



}



?>