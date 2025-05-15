<?php 

include_once ('connection.php');

if(isset($_POST['pending'])){
  $status = $_POST['pending'];
  $sql = "select * from meter_request where status='$status'";
  $result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){
  while($rows = mysqli_fetch_assoc($result)){
    echo '<tr>

                    <td class="meterNo">'.$rows['meter_no'].'</td>
                    <td>'.$rows['status'].'</td>
                    <td>'.$rows['RequestDate'].'</td>
                    <td>'.$rows['SendingDate'].'</td>
                    <td>'.$rows['ReceiveDate'].'</td>
                   <td>
                    <button class="meterSend" 
                        data-meter-no="'.$rows['meter_no'].'" 
                        style="background:#04AA6D;color:white;border:transparent;
                        border-radius:5px;cursor:pointer;padding: 5px 10px;">
                        Send
                    </button>
        </td>
    </tr>';

  }
}else{
  echo 'No Request Found!!';
}
}else if(isset($_POST['send'])){
  $status = $_POST['send'];
  $sql = "select * from meter_request where status='$status'";
  $result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){
  while($rows = mysqli_fetch_assoc($result)){
    echo '<tr>

                    <td>'.$rows['meter_no'].'</td>
                    <td>'.$rows['status'].'</td>
                    <td>'.$rows['RequestDate'].'</td>
                    <td>'.$rows['SendingDate'].'</td>
                    <td>'.$rows['ReceiveDate'].'</td>
    </tr>';

  }
}else{
  echo 'No Request Found!!';
}
}else if(isset($_POST['received'])){
  $status = $_POST['received'];
  $sql = "select * from meter_request where status='$status'";
  $result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){
  while($rows = mysqli_fetch_assoc($result)){
    echo '<tr>

                    <td>'.$rows['meter_no'].'</td>
                    <td>'.$rows['status'].'</td>
                    <td>'.$rows['RequestDate'].'</td>
                    <td>'.$rows['SendingDate'].'</td>
                    <td>'.$rows['ReceiveDate'].'</td>
    </tr>';

  }
}else{
  echo 'No Request Found!!';
}
}


if (isset($_POST['meter_no_req'])) {
  $meter_no = mysqli_real_escape_string($con, $_POST['meter_no_req']);
  $date = date("Y-m-d");
  
  $sql = "UPDATE meter_request SET status='Send', SendingDate='$date' WHERE meter_no='$meter_no'";
  if (mysqli_query($con, $sql)) {
      echo "OK";
  } else {
      echo "Error"; 
  }
}

if(isset($_POST['apply'])){
  $meterno = $_POST['apply'];
  $date = date("Y-m-d");

  $sql = "select status from customer where meter_no='$meterno'";
  $result = mysqli_query($con, $sql);
  $row = $result->fetch_assoc();
  if($row['status'] === "Not Verified" || $row['status'] === "None"){
    echo "Not Verified";
  }else{
    $sql1 = "insert into meter_request values('$meterno','Pending','$date','','')";
    mysqli_query($con, $sql1);
    echo "OK";
  }
}

if(isset($_POST['confirm'])){
  $meterno = $_POST['confirm'];
  $date = date("Y-m-d");

  $sql = "UPDATE meter_request SET status='Received', ReceiveDate='$date' where meter_no='$meterno'";
  $result= mysqli_query($con, $sql);

  echo "OK";
}



?>