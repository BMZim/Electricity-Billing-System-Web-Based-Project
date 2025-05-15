<?php 
include ('connection.php');


if(isset($_POST['reportDate'])){
    $date = $_POST['reportDate'];


    $sql = "select * from customer_report where date_month_year='$date' and replay=''";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){
        while($rows = mysqli_fetch_assoc($result)){
            echo '<tr>
                                
                                <td>'.$rows['meter_no'].'</td>
                                <td>'.$rows['report'].'</td>
                                <td><input type="text" id="replay" name="replay" placeholder="Enter your Replay"></td>
                                <td>
                                <button class="replaySend" 
                                    data-meter-no="'.$rows['meter_no'].'" 
                                    style="background:#04AA6D;color:white;border:transparent;
                                    border-radius:5px;cursor:pointer;padding: 5px 10px;">
                                    Send
                                    </button>
                                </td>
                                </tr>';
        }
    }else{
        echo 'No data found';
    }
}


if (isset($_POST['meter_no_replay'])) {
    $meter_no = mysqli_real_escape_string($con, $_POST['meter_no_replay']);
    $replay = $_POST['replay'];
    $replayDate = $_POST['replayDate'];
    
    $sql = "UPDATE customer_report SET replay='$replay' WHERE meter_no='$meter_no' and date_month_year='$replayDate'";
    if (mysqli_query($con, $sql)) {
        echo "OK";
    } else {
        echo "Error"; 
    }
  }

  if(isset($_POST['sms'])){
    $sms = $_POST['sms'];
    $meterno = $_POST['meter'];
    $date = date("Y-m-d");

    $sql = "select * from customer_report where meter_no='$meterno' and date_month_year='$date'";
    $result =mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
        echo "Fail";
    }else{
        $sql1 = "insert into customer_report values('$meterno','$sms','$date','')";
        mysqli_query($con, $sql1);
        echo "OK";
    }

    
  }

  if(isset($_POST['replayCheck'])){
    $meterno = $_POST['replayCheck'];
    $date = $_POST['date'];
    
    $sql = "select * from customer_report where meter_no='$meterno' and date_month_year='$date'";
    $result =mysqli_query($con, $sql);
    $row = $result->fetch_assoc();
    if(empty($row['report'])){
        echo "No Report";
    } else{
        if($row['replay'] === null){
        
            echo 'No Replay';
        }else{
            echo 'Report: '.$row['report'].'<br>
            Replay: '.$row['replay'].'
        
        
        ';
        }
        
    }
  }



?>