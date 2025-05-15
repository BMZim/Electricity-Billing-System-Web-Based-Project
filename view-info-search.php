<?php 
include 'connection.php';
$input = $_POST['query'];
$sql = "select * from customer where meter_no like'%{$input}%'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
                                echo '       
                                <tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['meter_no'].'</td>
                                <td>'.$row['address'].'</td>
                                <td>'.$row['division'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'.$row['nid'].'</td>
                                </tr>
                                ';
    }
}else{
    echo "No data Found";
}


?>      