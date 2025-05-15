<?php

session_start();
include ('connection.php');

if(isset($_POST)){


    $sname = $_POST['fname'];
    $semail = $_POST['email'];
    $cdate = date('Y-m');
    $spass = $_POST['password'];
    $sdob = $_POST['dob'];
    $sgender = $_POST['gender'];
    $snid = $_POST['nid'];
    $sdivision = $_POST['division'];
    $saddress = $_POST['address'];
    $sphone = $_POST['phone'];
    $security = $_POST['security'];
    $answer = $_POST['answer'];
    $meter = "";

    $email_valid = "select * from customer where email ='$semail'";
    $result = mysqli_query($con, $email_valid);
    if($rows = mysqli_num_rows($result)>0){
        echo "Exist";
    }else{
        $sql = "insert into customer values('$sname','$meter','$saddress','$sdivision','$semail','$sphone ','$spass','$cdate','$snid','$sdob','$sgender', '$security', '$answer', 'None')";
        $done=mysqli_query($con, $sql);
        if($done){
         $email="select * from customer where email='$semail'";
        $ok= mysqli_query($con, $email);
        $row = $ok->fetch_assoc();
        $_SESSION['meter-no'] = $row['meter_no'];
        echo "Success";
        }
        
    }
    
}
?>