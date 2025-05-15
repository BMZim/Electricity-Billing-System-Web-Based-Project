<?php 
include ('connection.php');
session_start();
$meterno = $_SESSION['user_no'];
//$con = mysqli_connect("localhost","zim","3235");
//$db = mysqli_select_db($con,"ebs");

if(isset($_POST['query1'])){
    $input = $_POST['query1'];
    $sql = "select * from bill where billing_month_year like'%{$input}%' and meter_no='$meterno'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
                                    echo '       
                                    <tr>
                                    <td>'.$row['meter_no'].'</td>
                                    <td>'.$row['bill_issue_date'].'</td>
                                    <td>'.$row['billing_month_year'].'</td>
                                    <td>'.$row['units'].'</td>
                                    <td>'.$row['totalbill'].'</td>
                                    <td>'.$row['status'].'</td>
                                    </tr>
                                    ';
        }
    }else{
        echo "No data Found";
    }
}


if(isset($_POST['payment'])){
    $meterno= $_POST['payment'];
    $date = $_POST['date'];
    
    $sql ="select * from bill where meter_no='$meterno' and billing_month_year='$date'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        $row = $result->fetch_assoc();
        $_SESSION["payment_month"] = $row['billing_month_year'];
        echo '<div style="text-align: left; padding: 20px 50px; border-radius: 10px; box-shadow:0px 0px 10px black;">
            
            Billing Month: '.$row['billing_month_year'].'<br>
            Units:  '.$row['units'].'<br>
            Total Bill: '.$row['totalbill'].'<br>
            Status: '.$row['status'].'<br><br>
            <div class="payment-img">
            <a href="otp.php"><img src="img/bkash.png" alt=""></a>
            <a href="otp.php"><img src="img/rocket.png" alt=""></a>
            </div>
            </div>';

    }else{
        echo 'No Data Found!!';
    }
    



}

?>      