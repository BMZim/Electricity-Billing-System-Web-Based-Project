<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="print.css" media="print">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body{
            font-family: "Poppins", sans-serif;
            font-style: normal;
            display: flex;
            justify-content: center;
        }
        .receipt{
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .invoice{
            display: flex;
            flex-direction: column;
            gap: 50px;
            align-items: center;
            background-color: #F5F3F4;
            padding: 10px 50px;
           border-radius: 10px;
           box-shadow: 0px 2px 5px black;
           transition: all 0.5s ease;
        }
        .invoice:hover{
            transform: translateY(-20px);
            box-shadow: 0px 15px 77px 4px #48CAE4;
        }
        .invoice .head{
            text-align: center;
        }
        .btn{
            display: flex;
            gap: 100px;
            padding-bottom: 15px;
        }
        .btn button {
            padding: 5px 15px;
            border: transparent;
            border-radius: 5px;
            color: #F5F3F4;
            transition: all 0.5s ease;
            box-shadow: 0px 0px 5px black;
            cursor: pointer;
        }
        
        .btn button:hover{
            transform: translateY(-5px);
            box-shadow: 0px 15px 77px 4px #48CAE4;
        }
        #cancel{
            background-color: red;
        }
        #print{
            background-color: #04AA6D;
        }
    </style>
</head>
<body>
    <div class="receipt">
            <?php 
            include ('connection.php');

            $meterno = $_SESSION['user_no'];

            $paymentMonth = $_SESSION['payment_month'];
            
            $sql = "SELECT * FROM customer
            JOIN meter_info ON customer.meter_no = meter_info.meter_no JOIN bill ON meter_info.meter_no = bill.meter_no JOIN transaction ON bill.meter_no = transaction.meter_no where customer.meter_no='$meterno' and bill.billing_month_year ='$paymentMonth'";
            $result = mysqli_query($con, $sql);
            $sql1 = "select * from tax";
            $result1 = mysqli_query($con, $sql1);
            $tax = $result1->fetch_assoc();

            if(mysqli_num_rows($result)>0){
                $rows = $result->fetch_assoc();
                $sql2 ="select * from bill where meter_no='$meterno' and billing_month_year ='$paymentMonth'";
                $result2 = mysqli_query($con, $sql2);
                $rows1 = $result2->fetch_assoc();

                echo '<div class="invoice">
                        <div class="head">
                    <img src="img/Klukeart-Cubes-Box-29-Electricity.128.png" alt="">
                    <h1>Electricity Billing System</h1>
                    <h3>Payment Receipt</h3>
                    </div>
                    <div class="details">
                        Customer Name:----------> '.$rows['name'].'<br>
                        Meter No:-----------------> '.$rows['meter_no'].'<br>
                        Address:------------------> '.$rows['address'].'<br>
                        Division:-------------------> '.$rows['division'].'<br>
                        Email:---------------------> '.$rows['email'].'<br>
                        Phone No:------------------> '.$rows['phone'].'<br>
                        NID:------------------------> '.$rows['nid'].'<br>
                        Gender:--------------------> '.$rows['gender'].'<br>
                        Billing Month:---------------> '.$rows1['billing_month_year'].'<br>
                        Units:----------------------> '.$rows1['units'].'<br>
                        Cost Per Unit:---------------> '.$tax['cost_per_unit'].'/=<br>
                        Meter Rent:----------------->'.$tax['meter_rent'].'/=<br>
                        Service Charge:-------------> '.$tax['service_charge'].'/=<br>
                        Service Tax:-----------------> '.$tax['service_tax'].'/=<br>
                        VAT:------------------------> '.$tax['vat'].'/=<br>
                        Transaction No:--------------> '.$rows['TRANSACTIONNO'].'<br>
                        Transaction Date:------------> '.$rows['TRANSACTION_date'].'<br>
                        Status:----------------------> '.$rows['status'].'<br>
                        Total Bill:--------------------> '.$rows1['totalbill'].'/=<br>
                        <<--------------------------------------------------------------------->><br>
                        Paid Amount:----------------> '.$rows['amount'].'/=<br>
                    </div>
                    <div class="btn">
                    <a href="userdashboard.php"><button id="cancel">Cancel</button></a>
                    <button onclick="window.print()" id="print">Print</button>
                    </div>
                    </div>
                    ';

            }


            ?>
        </div>
</body>
</html>