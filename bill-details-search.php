<?php 
include ('connection.php');
//$con = mysqli_connect("localhost","zim","3235");
//$db = mysqli_select_db($con,"ebs");
$input = $_POST['query1'];
$sql = "select * from bill where meter_no like'%{$input}%'";
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


?>      