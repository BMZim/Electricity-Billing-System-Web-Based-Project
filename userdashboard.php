<?php 
session_start();
$valid =$_SESSION['user_no'];
if($valid == true){

}else{
  header("location:userlogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="userdashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
</head>
<body>
  <div class="grid-container">
    <div class="item1">
      <div class="head-left">
        <img src="img/Klukeart-Cubes-Box-29-Electricity.128.png" alt="">
        <h1>Electricity Billing System</h1>
      </div>
      <div class="head-right">
        <a href="#"><img src="img/Custom-Icon-Design-Flatastic-11-Sms.72.png" alt=""></a>
        <a href="#"><img src="img/Icons-Land-Vista-People-Office-Customer-Male-Light.64.png" alt=""></a>
      </div>
      

    </div>
  
    <div class="item2">
      <button onclick="showPanel(0,'black')"><i class="fa-solid fa-gauge"></i> Dashboard</button>
      <button onclick="showPanel(1,'#4caf50')"><i class="fa-solid fa-check-to-slot"></i> Apply Verification</button>
      <button onclick="showPanel(2,'#2196f3')"><i class="fa-solid fa-circle-info"></i> View Meter Info</button>
      <button onclick="showPanel(3,'#ff5722')"><i class="fa-solid fa-money-bill-transfer"></i> Bill Details</button>
      <button onclick="showPanel(4,'#ff5722')"><i class="fa-solid fa-pen-to-square"></i> Update Info</button>
      <button onclick="showPanel(5,'#ff5722')"><i class="fa-solid fa-delete-left"></i> Deactivate Connection</button>
      <button onclick="showPanel(6,'#ff5722')"><i class="fa-solid fa-bell"></i> Apply for Meter</button>
      <button onclick="showPanel(7,'#ff5722')"><i class="fa-solid fa-bug"></i> Connection Report</button>
      <button onclick="showPanel(8,'#ff5722')"><i class="fa-solid fa-hand-holding-dollar"></i> Pay Bill</button>
      <button onclick="logOut()"></i> Logout</button>
    </div>
  
    <div class="item3">
      <div class="tabPanel" id="tab1">
        <div class="dashboard-head">
            <h2>Dashboard</h2>
        </div>
        <div class="dashboard-content">
            <div class="new-user">
              <h3><i class="fa-solid fa-user"></i> Meter No</h3>
              <p>
                <?php 

                 
                  $meterno = $_SESSION['user_no'];

                  echo $meterno;

                ?>
              </p>
              <a href="#">More Details</a>
            </div>
            <div class="total-bill">
              <h3><i class="fa-solid fa-file-invoice"></i> Total Bill</h3>
              <p>
              <?php 
                include_once ('connection.php');
                $meterno = $_SESSION['user_no'];
                $currentDate = date('Y-m-d');

                // Convert to DateTime and modify to the previous month
                $dateTime = new DateTime($currentDate);
                $dateTime->modify('-1 month');
                
                // Format the date to the desired format (YYYY-MM)
                $previousMonth = $dateTime->format('Y-m');
                
                $sql = "SELECT totalbill FROM bill where meter_no='$meterno' and billing_month_year='$previousMonth'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0){
                  $row = $result->fetch_assoc();
                  echo  $row['totalbill'];
                }else{
                  echo '0';
                }
                
                ?>
              </p>
              <h4>For Previous Month</h4>
            </div>
            <div class="total-unit">
              <h3><i class="fa-solid fa-recycle"></i> Total Unit</h3>
              <p>
              <?php 
                include_once ('connection.php');
                $meterno= $_SESSION['user_no'];
                $currentDate = date('Y-m-d');

                // Convert to DateTime and modify to the previous month
                $dateTime = new DateTime($currentDate);
                $dateTime->modify('-1 month');
                
                // Format the date to the desired format (YYYY-MM)
                $previousMonth = $dateTime->format('Y-m');
                
                $sql = "SELECT units FROM bill where meter_no = '$meterno' and billing_month_year='$previousMonth'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0){
                  $row = $result->fetch_assoc();
                  echo  $row['units'];
                }else{
                  echo '0';
                }
                
                ?>
              </p>
              <h4>For Previous Month</h4>
            </div>
        </div>
        <div class="verification">
              <?php 

              include ('connection.php');

              $meterno = $_SESSION['user_no'];

              $sql = "select status from customer where meter_no = '$meterno'";
              $result = mysqli_query($con, $sql);

              $row = $result->fetch_assoc();

              if($row['status'] === "Not Verified" || $row['status'] ===  "None"){
                echo '<h3 style="color:Red;">Your Account is Not Verified</h3>';
              }else{
                echo '<h3 style="color:Green;">Your Account is Verified</h3>';
              }
              ?>
        </div>
      </div>
      <div class="tabPanel" id="tab2">
        <div class="verification-head">
          <h2>Apply For Verification</h2>
        </div>
        
        <div class="verification-content">
          <form method="POST" id="verification-form">
          <?php 
            include ('connection.php');

            $meterno = $_SESSION['user_no'];
              
            $sql = "select * from customer where meter_no ='$meterno'";
            $result = mysqli_query($con, $sql);

            $rows = $result->fetch_assoc();

            echo 'Meter No:<p id="meter-no" style="color:red; font-weight:600;">'.$rows['meter_no'].'</p>';
            echo 'Name: '.$rows['name'].'<br><br>';
            echo 'Division: '.$rows['division'].'<br><br>';
            echo 'Address: '.$rows['address'].'<br><br>';
            echo 'Phone: '.$rows['phone'].'<br><br>';
            echo 'NID: '.$rows['nid'].'<br><br>';
            echo '<p style="color:red;">⚠️ Please ensure the data you entered is accurate.<br> If it\'s incorrect, update it with the correct information.</p><br>';
            

          ?>
           <button type="submit" id="submit" name="submit" value="Apply">Apply</button>
          </form>  
          <script>
          $(document).on("submit", "#verification-form", function(e){
            e.preventDefault();

             var verify = "Verify";
             var meterno = $('#meter-no').text();
            $.ajax({
              type: 'POST',
              url: 'verification.php',
              data : {Verify: verify, meter: meterno},
            success: function(response){
              res = response.trim(); // Remove any extra whitespace
        if (res === "OK"){
          Swal.fire({
                  icon: "success",
                  title: "Verification Request Sent",
                  text: "It will take 1-7 working days!!",
                  showConfirmButton: false,
                  timer: 5000
                });
        }else{
          Swal.fire({
                  icon: "warning",
                  title: "You are Already Verified",
                  text: "Thank You",
                  showConfirmButton: false,
                  timer: 3000
                });
        }
            }
        });
          });
        </script>        
        </div>
        
      </div>
      <div class="tabPanel">
        <div class="meter-info-head">
          <h2>View Meter Information</h2>
        </div>
        <div class="meter-info-content">
              <?php 
                include ('connection.php');

                $meterno = $_SESSION['user_no'];

                $sql = "select * from meter_info where meter_no='$meterno'";
                $result = mysqli_query($con, $sql);

                $rows = $result->fetch_assoc();
                echo '<div style=" display: flex;
                flex-direction: column;
                text-align: left;
                background-color: #F5F3F4;
                padding: 30px 70px;
                border-radius: 10px;
                box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">Meter No:<p id="meter-no" style="color:red; font-weight:600;">'.$rows['meter_no'].'</p>';
                echo 'Meter Location: '.$rows['meter_location'].'<br><br>';
                echo 'Meter Type: '.$rows['meter_type'].'<br><br>';
                echo 'Bill Type: '.$rows['bill_type'].'<br><br>';
                echo 'Phase Code: '.$rows['phase_code'].'<br><br></div>';
              ?>
            </div>
      </div>
      <div class="tabPanel">
        <div class="bill-details-head">
          <h2>Bill Details</h2>
        </div>
        <div class="bill-details-content">
          <form id="search-bill">
            <input type="month" id="meterno-bill" name="meterno-bill" required>
          </form><br>
          <div style="overflow-x: auto;">
            <table class="table" cellpadding="10" cellspacing="1" width="1050" >  
              <thead class="table-head">
                 <tr>
                           <th>Meter No</th>
                           <th>Bill Issue Date</th>
                           <th>Billing Month & Year</th>
                           <th>Units</th>
                           <th>Total Bill</th>
                           <th>Status</th>
                           </tr>
                           
                     </thead>  
                     <tbody id="table-bill">
                      
                     </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() {
                // Define the function that handles the keyup functionality
                 function handleKeyup() {
                var input = $("#meterno-bill").val();
        
                  if (input !== "") {
                        $.ajax({
                            url: "bill-details-search-user.php",
                            method: "POST",
                            data: { query1: input },
                            success: function(data) {
                            $("#table-bill").html(data);
                }
            });
        } else {
            
        }
    }

    // Bind keyup event to call handleKeyup
    $("#meterno-bill").on("keyup", handleKeyup);

    // Bind click event to also call handleKeyup
    $("#meterno-bill").on("click", handleKeyup);
});
</script>
            </div>

      </div>
      </div>
      <div class="tabPanel">
        <div class="update-head">
          <h2>Update Details</h2>
        </div>
        <div class="update-info-content">
            <p style="color: red; text-align: center;">"To update any specific information, please rewrite the existing information that you don't want to change,<br>Then write the new details as you want them to change."</p>
            <br>
            <div class="part-2">
           <div class="update-view">
                <h2>Current Info</h2>
                <div class="update-view-2">
                  <?php 
                  include ('connection.php');

                  $meterno =$_SESSION['user_no'];

                  $sql ="select * from customer where meter_no='$meterno'";
                  $result = mysqli_query($con, $sql);
                  $row = $result->fetch_assoc();
                  echo '       
                      Meter No:<p id="meter-no" style="color:red;">'.$row['meter_no'].'</p>
                      Name: '.$row['name'].'<br>
                      Address: '.$row['address'].'<br>
                      City: '.$row['division'].'<br>
                      Email: '.$row['email'].'<br>
                      Phone: '.$row['phone'].'<br>
                      Opening Date: '.$row['opening_date'].'<br>
                      NID: '.$row['nid'].'<br>
                      Date of Birth: '.$row['date_of_birth'].'<br>
                      Gender: '.$row['gender'].'<br>
                      Password: '.$row['PASSWORD'].'<br>
                      Security Question: '.$row['Security_Question'].'<br>
                      Answer: '.$row['answer'].'<br>
                      
                    
                        
                        ';

                ?>
                </div>
            </div>
            <h4>To:</h4>
            <div class="updated">
              <h2>New Info</h2>
              <form id="preview" method="POST">
              
                <input type="text" name="address" id="address" placeholder="Enter new Address" required><br>
                <input type="text" name="city" id="city" placeholder=" Enter new Division" required><br>
                <input type="number" name="phone" id="phone" placeholder="Enter new Phone" required><br>
                <input type="password" name="password" id="password" placeholder="Enter new password" required><br>
                <input type="text" name="question" id="question" placeholder="Enter new Security Question" required><br>
                <input type="text" name="answer" id="answer" placeholder="Enter new answer" required><br>
                <button type="submit" id="update">Update</button>
              </form>
              
            </div>
            
            <script type="text/javascript">
        
$(document).ready(function () {
    function performUpdate() {
        var input = $("#meter-no").text();
        var address = $("#address").val();
        var city = $("#city").val();
        var phone = $("#phone").val();
        var pass = $("#password").val();
        var question = $("#question").val();
        var answer = $("#answer").val();
        if (input !== "") {
                        $.ajax({
                            url: "update-info.php",
                            method: "POST",
                            data: { user: input,
                                    address: address,
                                    city: city,
                                    phone: phone,
                                    pass: pass,
                                    question: question,
                                    answer: answer,
                             
                             },
                            success: function(data) {
                              var dat = data.trim();
                              if(dat==="ok"){
                                Swal.fire({
                                title: "Nice!",
                                text: "Information Updated",
                                icon: "success"
                                });
                              }else{
                                alert(dat);
                              }
                              
                           
                }
            });
        } else {
            
        }
    }


    $("#preview").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission
        performUpdate(); // Call the Update function
    });
});
</script>
            </div>
        </div>
      </div>
      <div class="tabPanel">
        <div class="delete-head">
          <h2>Deactivate Connection</h2>
        </div>
        <div class="delete-content">
            <div class="current-info">
              <p><b style="color: red;">Please be aware of the following important points before proceeding:</b><br>
1. Final Billing: Ensure all outstanding bills are cleared. Any unpaid balance will need to be settled prior to disconnection.<br>
2. Service Disruption: Once deactivated, your electricity supply will be permanently disconnected, and a new connection may require additional charges and approvals.<br>
3. Critical Dependency: Please confirm that no critical equipment or services (e.g., medical devices, security systems) depend on the electricity supply at this address.<br><br>

If you have any concerns or wish to proceed, please contact our support team at <a href="#">Customer Support.</a><br> Thank you for your attention to this matter.
</p>
<?php 
$meterno = $_SESSION['user_no'];

echo '<h4 id="meter-no" style="color:red; font-weight: 600; text-shadow: 0px 0px 10px yellow; text-transform: uppercase;">Your Meter No is: '.$meterno.'</h4>';
?>
            <div class="delete"></div>
              <button id="delete" type="submit">Deactive</button>
            </div>
            <script type="text/javascript">
//delete function
$(document).ready(function () {
    function performDeactivate() {
        var input = $("#meter-no").text();
        if (input !== "") {
                        $.ajax({
                            url: "delete.php",
                            method: "POST",
                            data: { deactive: input,
                             },
                            success: function(data) {
                              var dat = data.trim();
                              if(dat==="ok"){
                                Swal.fire({
                                title: "Nice!",
                                text: "Connection Deactivated",
                                icon: "success"
                                }).then(()=>{
                                    window.location.href = 'userlogin.php';
                                });
                              }else if(dat==="Fail"){
                                Swal.fire({
                                title: "Opps!!",
                                text: "You have Unpaid Bills!!!",
                                icon: "error"
                                });
                              }
                              
                           
                }
            });
        } else {
            
        }
    }


    $("#delete").on("click", function (e) {
        e.preventDefault(); // Prevent form submission
        performDeactivate(); // Call the Delete function
    });
});
</script>

        </div>
      </div>
      <div class="tabPanel">
        <div class="request-head">
          <h2>Send Meter Request</h2>
        </div>
        <div class="request-content">
          <div class="send-request">
          <?php 
          include ('connection.php');

          $meterno = $_SESSION['user_no'];

          $check = "select * from meter_request where meter_no='$meterno'";
          $result= mysqli_query($con, $check);
          if(mysqli_num_rows($result)>0){
            $rows= $result->fetch_assoc();
            if($rows['status']==="Pending"){
              echo 'Dear User, Your meter request is still being processed. We\'re working on it and will update you soon. <br>Thank you for your patience!';
            }else if($rows['status']==="Send"){
              echo 'Please confirm that you have successfully received your meter.<br><br>';
              echo 'Your Meter No is:<p id="meter-no" style="color:red;">'.$rows['meter_no'].' </p>'; 
              echo '<button id="received" name="received">Received</button>';
            }else if($rows['status']==="Received"){
              echo 'Dear User, <br>We are pleased to confirm that your meter has been successfully received.<br> If you have any further questions or need assistance, feel free to contact us.<br>
              Thank you for your cooperation!';
            }
          }else{
            $sql = "SELECT * FROM customer
            JOIN meter_info ON customer.meter_no = meter_info.meter_no where customer.meter_no='$meterno'";

        $result1 = mysqli_query($con, $sql);
        $row = $result1->fetch_assoc();
    echo '       
                Meter No:<p id="meter-no" style="color:red;">'.$row['meter_no'].'</p>
                Name: '.$row['name'].'<br>
                Address: '.$row['address'].'<br>
                City: '.$row['division'].'<br>
                Email: '.$row['email'].'<br>
                Phone: '.$row['phone'].'<br>
                Opening Date: '.$row['opening_date'].'<br>
                NID: '.$row['nid'].'<br>
                Date of Birth: '.$row['date_of_birth'].'<br>
                Gender: '.$row['gender'].'<br>
                Meter Type: '.$row['meter_type'].'<br>
                Bill Type: '.$row['bill_type'].'<br>
                Meter Location: '.$row['meter_location'].'<br>
                Phase Code: '.$row['phase_code'].'<br><br>
                <button id="request" name="request">Request</button>
                  ';
          }

         

          ?>
          
          <script>

              $(document).ready(function () {
              function meterRequest() {

                var meterno = $('#meter-no').text();
                                  $.ajax({
                                      url: "meter_request.php",
                                      method: "POST",
                                      data: { apply: meterno,
                                                                          
                                      },
                                      success: function(data) {
                                        var dat = data.trim();
                                        if(dat === "Not Verified"){
                                          Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text: "You are Not a Verified User",
                                          footer: 'Please verify your account first!!!'
                                        });
                                        }else if (dat === "OK"){
                                          Swal.fire({
                                          title: "Congratulations",
                                          text: "Your meter will deliver in 1-2 days",
                                          icon: "success",
                                          timer: 2000
                                        });
                                        }
                          }
                      });
                  
              }


              $("#request").on("click", function (e) {
                  e.preventDefault();
                  meterRequest(); 
              });
              });
              $(document).ready(function () {
              function meterReceived() {

                var meterno = $('#meter-no').text();
                                  $.ajax({
                                      url: "meter_request.php",
                                      method: "POST",
                                      data: { confirm: meterno,
                                                                          
                                      },
                                      success: function(data) {
                                        var dat = data.trim();
                                        if(dat === "OK"){
                                          Swal.fire({
                                          title: "Thank You!!",
                                          text: "Enjoy YourWe hope you enjoy our service! For assistance, contact us anytime.",
                                          icon: "success",
                                          timer: 2000
                                        });
                                        }else{
                                          alert("Verified");
                                        }
                          }
                      });
                  
              }


              $("#received").on("click", function (e) {
                  e.preventDefault();
                  meterReceived(); 
              });
              });
              </script>
          </div>
            </div>
        </div>
      <div class="tabPanel">
        <div class="report-check-head">
            <h2>Connection Issue Report</h2>
        </div>
        <div class="report-check-content">
         <div class="report">
          <?php 
            $meterno = $_SESSION['user_no'];
            echo 'Your Meter No is:<p id="meter-no" style="color:red;">'.$meterno.'</p>'
          ?>
              <form method="post">
              <textarea id="sms" name="sms" rows="10" cols="30" placeholder="Write your issue here......."></textarea><br><br>
              <button id="report-submit" name="report-submit">Submit</button>
              </form>
              <script>
                $(document).ready(function () {
              function sms() {

                var meterNo = $('#meter-no').text(); // Get the meter_no from data attribute
                var sms = $('#sms').val();
                $.ajax({
                url: "reportCheck.php",
                method: "POST",
                data: { sms: sms,
                        meter: meterNo,
                        
                 },
                success: function(response) {
                  var res = response.trim();

                  if (res==="OK"){
                    Swal.fire({
                    title: "Report Recorded",
                    text: "We will contact with you as soon as possible",
                    icon: "success"
                  });
                  }else if(res==="Fail"){
                    Swal.fire({
                    title: "Opss...!!",
                    text: "You have alreay reported today, please be patience, we are working on your issue. Check replay",
                    icon: "error"
                  });
                  }
           
                
        }
    });
                  
              }


              $("#report-submit").on("click", function (e) {
                  e.preventDefault();
                  sms(); 
              });
              });
             </script>
         </div>
         <div class="replay">
              <form method="post">
                <input type="date" id="replayCheck" name="replayCheck">
                <button id="check-replay" name="check-replay">Check</button>
              </form><br><br>

              <p id="replay"></p>
              <script>
                $(document).ready(function () {
              function checkReplay() {

                var meterNo = $('#meter-no').text(); // Get the meter_no from data attribute
                var date = $('#replayCheck').val();
                $.ajax({
                url: "reportCheck.php",
                method: "POST",
                data: { replayCheck: meterNo,
                  date: date,
                        
                 },
                success: function(response) {
                  var res = response.trim();
                  if(res === "No Report"){
                    $("#replay").html("No Report");
                  }else{
                    $("#replay").html(res);
                  }
                  
                 
           
                
        }
    });
                  
              }


              $("#check-replay").on("click", function (e) {
                  e.preventDefault();
                  checkReplay(); 
              });
              });
             </script>
         </div>
            
        </div>
      </div>
      <div class="tabPanel">
        <div class="paybill-head">
              <h2>Pay Your Electricity Bill</h2>
        </div>
        <div class="paybill-content">
              <form method="post">
                Meter No:
                <p id="meter-no" style="color: red;">
                  <?php 
                    $meterno = $_SESSION['user_no'];
                    echo $meterno;
                  ?>
                </p>
                Billing Month:
                <input type="month" id="billDate" name="billDate" >
                <button id="billCheck" name="billCheck">Check</button>
              </form><br><br>
              <div id="details" style="display: flex; justify-content:center;"></div>
              <script>
                $(document).ready(function () {
              function billCheck() {

                var meterNo = $('#meter-no').text(); // Get the meter_no from data attribute
                var date = $('#billDate').val();
                $.ajax({
                url: "bill-details-search-user.php",
                method: "POST",
                data: { payment: meterNo,
                  date: date,
                        
                 },
                success: function(response) {
                  
                  $("#details").html(response);
                 
           
                
        }
    });
                  
              }


              $("#billCheck").on("click", function (e) {
                  e.preventDefault();
                  billCheck(); 
              });
              });
             </script>
        </div>
      </div>
      
      <div class="tabPanel">
        <script>
           function logOut(){
            window.location.href = "user-logout.php";
           }
        </script>
      </div>
    </div>
  
    <div class="item4">
      <a href="https://www.facebook.com/bm.jim.2024/" target="_blank"><img src="img/Ampeross-Qetto-Facebook.128.png" alt=""></a>
      <a href="https://www.instagram.com/bm___jim?igsh=ZDZjbG9mM3FnNDMx&utm_source=qr" target="_blank"><img src="img/Designbolts-Free-Cute-Shaded-Social-Instagram.128.png" alt=""></a>
      <a href="https://x.com/srubaer?s=21" target="_blank"><img src="img/Graphics-Vibe-Simple-Rounded-Social-Twitter.128.png" alt=""></a>
      <a href="mailto:shafinrubaer@gmail.com"><img src="img/Guillendesign-Variations-3-Mail-Gmail.128.png" alt=""></a>
      <a href="tel:+8801727743670" target="_blank"><img src="img/Everaldo-Crystal-Clear-App-phone.128.png" alt=""></a>
    </div>
  </div>
  <script src="userdashboard.js"></script>
 
</body>
</html>