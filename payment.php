<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body{
            display: flex;
            justify-content: center;
            transform: translateY(150px);
            background-image: linear-gradient(to top, #fff1eb 0%, #ace0f9 100%);
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }
        .main{
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            padding: 30px 70px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            border-radius: 10px;
            transition: all 0.5s ease;
            box-shadow: 0px 0px 5px black;
            margin: 50px;
        }
        .main:hover{
            transform: translateY(-20px);
            box-shadow: 0px 15px 77px 4px black;
        }
        .payment form{
            display: flex;
            flex-direction: column;
        }
        form input{
            padding: 2px 5px;
            font-size: 18px;
            border: transparent;
            border-radius: 5px;
            outline: none;
        }
        form button{
            padding: 5px 20px;
            border: transparent;
            border-radius: 6px;
            background-color: #04AA6D;
            font-weight: 600;
            font-family: "Poppins", sans-serif;
            transition: all 0.5s ease;
            cursor: pointer;
        }
        form button:hover{
            transform: translateX(10px);
            background-color: #48CAE4;
            box-shadow: 0px 0px 15px 4px black;
        }
    </style>
</head>
<body>
    <div class="main">
        <div id="details" class="details">
            <?php 
                include ('connection.php');

                $meterno = $_SESSION['user_no'];
                $paymentMonth = $_SESSION['payment_month'];

                echo 'Meter No: '.$meterno;
                echo '<br><br>Billing Month: '.$paymentMonth;

                $sql = "select * from bill where meter_no='$meterno' and billing_month_year='$paymentMonth'";
                $result = mysqli_query($con, $sql);
                $row = $result->fetch_assoc();
                echo '<br><br>Total Bill: '.$row['totalbill'];
            ?>
        </div>
        <div class="payment">
            <form method="post">
                <input type="number" id="number" name="number" placeholder="Enter transaction number"><br>
                <input type="number" id="amount" name="amount" placeholder="Enter Amount"><br>
                <button id="pay" name="pay">Pay</button>
            </form>
            <script>
                $(document).ready(function () {
              function pay() {

                var meterno = "<?php echo $meterno; ?>";
                var number = $('#number').val();
                var amount = $('#amount').val();
                var paymentMonth  = "<?php echo $paymentMonth ; ?>";
                $.ajax({
                url: "transaction.php",
                method: "POST",
                data: { payment: meterno,
                  number: number,
                  amount: amount,
                  paymentMonth: paymentMonth,
                        
                 },
                success: function(response) {
                  
                  var res = response.trim();
                  if(res==="OK"){
                    Swal.fire({
                    title: "Nice!!",
                    text: "Payment Successful!!",
                    icon: "success"
                    }).then(()=>{
                                    window.location.href = 'invoice.php';
                                });
                  }else if(res==="Paid"){
                    Swal.fire({
                    title: "Opss...!!",
                    text: "Your Bill is already paid for this month!!",
                    icon: "error"
                    });
                  }else{
                    alert(response);
                  }
                 
           
                
        }
    });
                  
              }


              $("#pay").on("click", function (e) {
                  e.preventDefault();
                  pay(); 
              });
              });
             </script>
        </div>
    </div>
    

</body>
</html>

