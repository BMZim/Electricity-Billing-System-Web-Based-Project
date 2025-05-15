
<?php
include 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="input">
        <form method="post">
        <label for="A">Meter No:</label> <input type="number" name="meterno" id="A">
        <button type="submit" name="submit">Search</button>
        </form>
        <div class="content">
            <table border=5 cellspacing=10>
                <?php 
                    if(isset($_POST['submit'])){
                        $search=$_POST['meterno'];

                        $sql="select * from `customer` where `meter_no` = '$search'";
                        $result=mysqli_query($con,$sql);

                        if($result){
                            if(mysqli_num_rows($result)>0){
                                echo '<thead>
                                <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Email</th>
                                </tr>
                                </thead>';
                                $row=mysqli_fetch_assoc($result);
                                echo '<tbody>
                                <tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['address'].'</td>
                                <td>'.$row['city'].'</td>
                                <td>'.$row['email'].'</td>
                                </tr>
                                </tbody>';
                            }else{
                                echo 'No Data Found';
                            }
                           
                        }
                        
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>