<?php 
include ('connection.php');

if (isset($_POST['verification'])) {
    $meter_no = mysqli_real_escape_string($con, $_POST['verification']);
    
    $sql = "UPDATE customer SET status='Verified' WHERE meter_no='$meter_no'";
    if (mysqli_query($con, $sql)) {
        echo "OK";
    } else {
        echo "Error"; 
    }
  }

  if(isset($_POST['Verify'])){
        $meter_no = $_POST['meter'];

        $sql ="SELECT status from customer where meter_no='$meter_no'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row['status'] === "Verified"){
            echo "Fail";
        }else{
            $sql1 = "UPDATE customer SET status='Not Verified' where meter_no='$meter_no'";
        $result1 = mysqli_query($con, $sql1);

        echo 'OK';
        }

        
  }

?>