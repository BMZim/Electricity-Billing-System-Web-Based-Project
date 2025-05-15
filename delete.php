<?php 
include ('connection.php');

if(isset( $_POST['query'])){
    $input = $_POST['query'];
    $sql = "select * from customer where meter_no like'%{$input}%'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo '       
            <p>
           Name: '.$row['name'].'<br>
            Meter No: '.$row['meter_no'].'<br>
           Address: '.$row['address'].'<br>
           City: '.$row['division'].'<br>
           Email: '.$row['email'].'<br>
           Phone: '.$row['phone'].'<br>
           Opening Date: '.$row['opening_date'].'<br>
           NID: '.$row['nid'].'<br>
           Date of Birth: '.$row['date_of_birth'].'<br>
           Gender: '.$row['gender'].'<br>
            </p>
            ';
        }
        }else{
        echo 'No Data Found';
    }
}else if(isset($_POST['delete'])){
    $smeter = $_POST['delete'];

    $sql = "DELETE FROM customer where meter_no='$smeter'";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "ok";
    }else{
        echo 'failed';
    }
}else if(isset($_POST['deactive'])){
    $smeter = $_POST['deactive'];

    $sql = "select * from bill where meter_no='$smeter' and status='Not Paid'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        echo "Fail";
    }else{
        $sql1 = "DELETE FROM customer where meter_no='$smeter'";
    $result1 = mysqli_query($con, $sql1);
    if($result1){
        echo "ok";
    }else{
        echo 'failed';
    }
    }
    
}



?>      