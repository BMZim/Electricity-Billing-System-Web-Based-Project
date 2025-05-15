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
        echo "No data Found";
    }
}else if(isset($_POST['update'])){
    $smeter = $_POST['update'];
    $address = $_POST['address'];
    $scity = $_POST['city'];
    $sphone = $_POST['phone'];
    
    
    $sql = "UPDATE customer SET address = '$address', division = '$scity', phone= '$sphone' WHERE meter_no = '$smeter'";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "ok";
    }else{
        $error = mysqli_error($con);
        echo $error;
    }
}else if(isset($_POST['user'])){
    $smeter = $_POST['user'];
    $address = $_POST['address'];
    $scity = $_POST['city'];
    $sphone = $_POST['phone'];
    $spass = $_POST['pass'];
    $squestion = $_POST['question'];
    $sanswer = $_POST['answer'];
    
    
    $sql = "UPDATE customer SET address = '$address', division = '$scity', phone= '$sphone', PASSWORD='$spass', Security_Question='$squestion', answer='$sanswer' WHERE meter_no = '$smeter'";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "ok";
    }else{
        echo "failed".$result($con);
    }
}




?>      