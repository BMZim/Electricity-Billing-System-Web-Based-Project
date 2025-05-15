<?php 
include ('connection.php');
if(isset($_POST['submit'])){
    
    session_start();
    $meterno = $_SESSION['meter-no'];
    $location = $_POST['location'];
    $metertype = $_POST['meter-type'];
    $phasecode = $_POST['phase-code'];
    $billtype = $_POST['bill-type'];

    $sql = "insert into meter_info values('$meterno','$location','$metertype','$phasecode','$billtype')";
    $result=mysqli_query($con, $sql);
    if($result){
        header("Location: userlogin.php");
    }
}


?>