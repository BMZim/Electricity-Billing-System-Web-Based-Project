<?php 
    include ('connection.php');

    if(isset($_POST['tax-submit'])){
        $cpu = $_POST['cpu'];
        $mr = $_POST['mr'];
        $sc =$_POST['sc'];
        $st = $_POST['st'];
        $vat = $_POST['vat'];

        $sql = "UPDATE tax SET cost_per_unit ='$cpu', meter_rent='$mr', service_charge = '$sc', service_tax='$st', vat='$vat'";
        $result = mysqli_query($con, $sql);
        echo 'Success';
    }
    
    


?>