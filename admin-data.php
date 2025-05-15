<?php

include ('connection.php');

if(isset($_POST)){

    $sname = $_POST['fname'];
    $sjobid = $_POST['jobid'];
    $semail = $_POST['email'];
    $spass = $_POST['password'];
    $sdob = $_POST['dob'];
    $sgender = $_POST['gender'];
    $snid = $_POST['nid'];
    $sdivision = $_POST['division'];
    $saddress = $_POST['address'];
    $sphone = $_POST['phone'];
    $security = $_POST['security'];
    $answer = $_POST['answer'];

    $sql = "SELECT * FROM adminlogin where jobid = '$sjobid'";
    $result = mysqli_query($con, $sql);

    if($rows = mysqli_num_rows($result)>0){
        while($valid = mysqli_fetch_assoc($result)){
            if("" == $valid['email']){
                $sql1 = "UPDATE adminlogin SET name='$sname', jobid='$sjobid', email='$semail', phone='$sphone', password='$spass', date_of_birth='$sdob', address='$saddress', gender='$sgender', division='$sdivision', nid='$snid', Security_Question='$security', answer='$answer' where jobid='$sjobid'";
                mysqli_query($con, $sql1);
                echo "Success";
            }else{
                echo "Exist";
            }
        }

    }else{
        echo "NotFound";
    }
}


    
   

?>