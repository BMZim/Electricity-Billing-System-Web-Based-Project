<?php 
include ('connection.php');


$smeter = $_POST['meterno'];
$sunit = $_POST['unit'];
$sbmy = $_POST['bmy'];
$sbid = $_POST['bid'];

$sql = "select * from customer where meter_no='$smeter'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) == 0){
    
    $value = "Not Found";
    echo $value;
}else{
    $sql1 = "select * from bill where meter_no='$smeter' and billing_month_year='$sbmy'";
    $result1 = mysqli_query($con, $sql1);

if(mysqli_num_rows($result1) == 0){

    $totalbill = 0;
    $unit_consumed = floatval($sunit);

    $query1 = "SELECT * FROM tax";
    $tax = mysqli_query($con, $query1);

if (mysqli_num_rows($tax) > 0) {
    while ($row = $tax->fetch_assoc()) {
        $totalbill += $unit_consumed * floatval($row['cost_per_unit']);
        $totalbill += floatval($row['meter_rent']);
        $totalbill += floatval($row['service_charge']);
        $totalbill += floatval($row['service_tax']);
        $totalbill += floatval($row['vat']);
    }
}
    $sql3 = "insert into bill values ('$smeter','$sbid','$sbmy','$sunit','$totalbill','Not Paid')";
    $result3 = mysqli_query($con, $sql3);
    $value = "Success";
    echo $value;
    
}else{
    $value = "Already Calculated";
    echo $value;
}

}





?>