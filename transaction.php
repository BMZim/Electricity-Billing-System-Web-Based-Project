<?php 
include ('connection.php');

if(isset($_POST['payment'])){
    $meterno = $_POST['payment'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $paymentMonth = $_POST['paymentMonth'];
    $date = date("Y-m-d");
    
    
    $sql = "select status from bill where meter_no='$meterno' and billing_month_year='$paymentMonth'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        $row = $result->fetch_assoc();
        
        if($row['status'] === "Paid"){
            echo "Paid";
        }else if($row['status'] === "Not Paid"){
            $sql1 = "UPDATE bill SET status='Paid' where meter_no='$meterno' and billing_month_year='$paymentMonth'";
            mysqli_query($con, $sql1);
    
            $sql2 = "insert into transaction values('$meterno','$number','$amount','$date','$paymentMonth')";
            mysqli_query($con, $sql2);
            echo "OK";
        }else{
            echo $row['status'];
        }
    }else{
        echo "Fails";
    }
   
}


?>