<?php 
session_start();
$valid =$_SESSION['user_id'];
if($valid == true){

}else{
  header("location:adminlogin.php");
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
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
</head>
<body onload="newUser()">
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
      <button onclick="showPanel(1,'#4caf50')"><i class="fa-solid fa-calculator"></i> Calculate Bill</button>
      <button onclick="showPanel(2,'#2196f3')"><i class="fa-solid fa-circle-info"></i> View Info</button>
      <button onclick="showPanel(3,'#ff5722')"><i class="fa-solid fa-money-bill-transfer"></i> Bill Details</button>
      <button onclick="showPanel(4,'#ff5722')"><i class="fa-solid fa-pen-to-square"></i> Update Customer Info</button>
      <button onclick="showPanel(5,'#ff5722')"><i class="fa-solid fa-delete-left"></i> Delete Customer</button>
      <button onclick="showPanel(6,'#ff5722')"><i class="fa-solid fa-chart-simple"></i> Update Tax</button>
      <button onclick="showPanel(7,'#ff5722')"><i class="fa-solid fa-bell"></i> Meter Request</button>
      <button onclick="showPanel(8,'#ff5722')"><i class="fa-solid fa-bug"></i> Report Check</button>
      <button onclick="showPanel(9,'#ff5722')"><i class="fa-solid fa-check"></i></i> Verification Request</button>
      <button onclick="logOut()"></i> Logout</button>
    </div>
  
    <div class="item3">
      <div class="tabPanel" id="tab1">
        <div class="dashboard-head">
            <h2>Dashboard</h2>
            <div class="dashboard-head-right">
              <a href="adminsignup.php">Add Admin</a>
              <a href="usersignup.php">Add Customer</a>
            </div>
            
        </div>
        <div class="dashboard-content">
            <div class="new-user">
              <h3><i class="fa-solid fa-user"></i> New User</h3>
              <p>
                <?php 
                include_once ('connection.php');
                $date = date('Y-m');
                
                $sql = "SELECT COUNT(*) AS row_count FROM customer where opening_date='$date'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0){
                  $row = $result->fetch_assoc();
                  echo  ''. $row['row_count'];
                }else{
                  echo '0';
                }
                
                ?>
              </p>
              <a href="#">More Details</a>
            </div>
            <div class="total-bill">
              <h3><i class="fa-solid fa-file-invoice"></i> Total Bill</h3>
              <p><?php 
                include_once ('connection.php');
                $currentDate = date('Y-m-d');

                // Convert to DateTime and modify to the previous month
                $dateTime = new DateTime($currentDate);
                $dateTime->modify('-1 month');
                
                // Format the date to the desired format (YYYY-MM)
                $previousMonth = $dateTime->format('Y-m');
                
                $sql = "SELECT SUM(totalbill) AS total_bill FROM bill where billing_month_year='$previousMonth'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0){
                  $row = $result->fetch_assoc();
                  echo  $row['total_bill'];
                }else{
                  echo '0';
                }
                
                ?></p>
              <h4>For Previous Month</h4>
            </div>
            <div class="total-unit">
              <h3><i class="fa-solid fa-recycle"></i> Total Unit</h3>
              <p><?php 
                include_once ('connection.php');
                $currentDate = date('Y-m-d');

                // Convert to DateTime and modify to the previous month
                $dateTime = new DateTime($currentDate);
                $dateTime->modify('-1 month');
                
                // Format the date to the desired format (YYYY-MM)
                $previousMonth = $dateTime->format('Y-m');
                
                $sql = "SELECT SUM(units) AS total_units FROM bill where billing_month_year='$previousMonth'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0){
                  $row = $result->fetch_assoc();
                  echo  $row['total_units'];
                }else{
                  echo '0';
                }
                
                ?></p>
              <h4>For Previous month</h4>
            </div>
        </div>
      </div>  
      <div class="tabPanel" id="tab2">
        <div class="calculate-bill-head">
          <h2>Calculate Bill</h2>
        </div>
        <div class="calculate-bill-content">
          <form method="POST" id="calculate-form">
            <label for="A">Meter No:<br></label><input type="number" id="c-meter" name="meterno" size="20"placeholder="Enter user meter no" required><br>
            <label for="B">Unit:<br></label><input type="number" id="unit" name="unit" size="20"placeholder="Enter Unit" required><br>
            <label for="C">Billing Month & Year:<br></label><input type="month" name="bmy" id="bmy"size="20"  required><br>
           <label for="D">Bill Issue Date:<br></label><input type ="date"id="bid" name="bid" size= "20" required><br>
           <input type="submit" id="submit" name="submit" value="Submit">
          </form>  
          <script>
          $(document).on("submit", "#calculate-form", function(e){
            e.preventDefault();
            $.ajax({
              type: 'POST',
              url: 'calculate-bill.php',
              data :$(this).serialize(),
            success: function(response){
              response = response.trim(); // Remove any extra whitespace
        if (response === "Not Found") {
          Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Meter No doesn't Exist!!",
                  footer: '<h2>Try Different One</h2>'
                });
        } else if (response === "Success") {
          Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Bill Successfully Calculated!!",
                showConfirmButton: false,
                timer: 1500
              });
        } else {
          Swal.fire({
          title: "Bill Calculated",
          text: "Bill is already calculated for this Month!!",
          icon: "question"
            });
        }
            }
        });
          });
        </script>        
        </div>
        
      </div>
      <div class="tabPanel">
        <div class="view-info-head">
          <h2>View Customer Information</h2>
        </div>
        <div class="view-info-content">
            <form>
            <input type="number" id="meterno" name="meterno" placeholder="Search By Meter No" required>
            </form><br>
            <div style="overflow-x: auto;">
            <table class="table" cellpadding="10" cellspacing="1" width="1000" >  
              <thead class="table-head">
                 <tr>
                           <th>Name</th>
                           <th>Meter No</th>
                           <th>Address</th>
                           <th>City</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>NID</th>
                           </tr>
                           
                     </thead>  
                     <tbody id="table">
                      
                     </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() {
                // Define the function that handles the keyup functionality
                 function handleKeyup() {
                var input = $("#meterno").val();
        
                  if (input !== "") {
                        $.ajax({
                            url: "view-info-search.php",
                            method: "POST",
                            data: { query: input },
                            success: function(data) {
                            $("#table").html(data);
                }
            });
        } else {
            
        }
    }

    // Bind keyup event to call handleKeyup
    $("#meterno").on("keyup", handleKeyup);

    // Bind click event to also call handleKeyup
    $("#meterno").on("click", handleKeyup);
});
</script>
            </div>
        </div>
      </div>
      <div class="tabPanel">
        <div class="bill-details-head">
          <h2>Bill Details</h2>
        </div>
        <div class="bill-details-content">
          <form id="search-bill">
            <input type="number" id="meterno-bill" name="meterno-bill" placeholder="Search by meter no" required>
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
                            url: "bill-details-search.php",
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
          <h2>Update Customer Details</h2>
        </div>
        <div class="update-info-content">
            <form id="search-form">
            <input type="number" id="meterno-update" name="meterno-update" placeholder="Search By Meter No" required>
            <button type="submit" id="search1">Search</button>
            <p style="color: red; text-align: center;">"To update any specific information, please rewrite the existing information that you don't want to change,<br>Then write the new details as you want them to change."</p>
            </form><br>
            <div class="part-2">
           <div class="update-view">
                <h2>Current Info</h2>
                <div class="update-view-2"></div>
            </div>
            <h4>To:</h4>
            <div class="updated">
              <h2>New Info</h2>
              <form id="preview" method="POST">
              
                <input type="text" name="address" id="address" placeholder="Enter Address" required><br>
                <input type="text" name="city" id="city" placeholder=" Enter Division" required><br>
                <input type="number" name="phone" id="phone" placeholder="Enter Phone" required><br>
                <button type="submit" id="update">Update</button>
              </form>
              
            </div>
            
            <script type="text/javascript">
               $(document).ready(function () {
    // Function to perform the AJAX search
    function performSearch() {
        var input = $("#meterno-update").val();

        if (input !== "") {
                        $.ajax({
                            url: "update-info.php",
                            method: "POST",
                            data: { query: input},
                            success: function(data) {
                            $(".update-view-2").html(data);
                           
                }
            });
        } else {
            
        }
    }


    $("#search-form").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission
        performSearch(); // Call the search function
    });
});
$(document).ready(function () {
    function performUpdate() {
        var input = $("#meterno-update").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var phone = $("#phone").val();
        if (input !== "") {
                        $.ajax({
                            url: "update-info.php",
                            method: "POST",
                            data: { update: input,
                                    address: address,
                                    city: city,
                                    phone: phone,
                             
                             },
                            success: function(data) {
                              Swal.fire({
          title: "Nice",
          text: "Information Updated!!",
          icon: "success"
            });
                           
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
          <h2>Delete Customer</h2>
        </div>
        <div class="delete-content">
          <form id="delete-search">
            <input type="number" id="meterno-delete" name="meterno-delete" placeholder="Search By Meter No" required>
            <button type="submit" id="search2">Search</button>
            </form><br>
            <div class="current-info">
              <h2>Customer Information</h2>
              <div class="delete"></div>
              <button id="delete" type="submit">Delete</button>
            </div>
            <script type="text/javascript">
               $(document).ready(function () {
    // Function to perform the AJAX search
    function performSearch() {
        var input = $("#meterno-delete").val();

        if (input !== "") {
                        $.ajax({
                            url: "delete.php",
                            method: "POST",
                            data: { query: input},
                            success: function(data) {
                              if(data === 'ok'){
                                Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                                });
                              }else if(data === 'failed'){
                                Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: 'Try again!'
                                });
                              }else{
                                $(".delete").html(data);
                              }
                            
                           
                }
            });
        } else {
            
        }
    }


    $("#delete-search").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission
        performSearch(); // Call the search function
    });
});

//delete function
$(document).ready(function () {
    function performDelete() {
        var input = $("#meterno-delete").val();
        if (input !== "") {
                        $.ajax({
                            url: "delete.php",
                            method: "POST",
                            data: { delete: input,
                             },
                            success: function(data) {
                              Swal.fire({
                                title: "Nice!",
                                text: "Customer Deleted",
                                icon: "success"
                                });
                           
                }
            });
        } else {
            
        }
    }


    $("#delete").on("click", function (e) {
        e.preventDefault(); // Prevent form submission
        performDelete(); // Call the Delete function
    });
});
</script>

        </div>
      </div>
      <div class="tabPanel">
        <div class="tax-head">
            <h2>Update Tax Information</h2>
        </div>
        <div class="tax-content">
            <div class="current-tax">
                <h2>Current Tax Info</h2>
                <div id="tax-info">
                  <?php
                    include ('connection.php');

                    $sql = "select * from tax";
                    $result = mysqli_query($con, $sql);
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<p> <b>Cost Per Unit:</b> '.$row['cost_per_unit'].' <hr>
                              <b>Meter Rent:</b> '.$row['meter_rent'].' <hr>  
                              <b>Service Charge:</b> '.$row['service_charge'].' <hr>
                              <b>Service Tax:</b> '.$row['service_tax'].' <hr>   
                              <b>VAT:</b> '.$row['vat'].'<hr>    
                               </p>         
                      ';
                      }
                      
                    }
                  ?>
                </div>
            </div>
            <div class="new-tax">
              <h2>New Tax Details</h2>
              <div id="new-tax">
                  <form id="new-tax-update" method="POST">
                    <input type="number" id="cost_per_unit" name="cost_per_unit" placeholder="Enter Cost Per Unit"><br><br>
                    <input type="number" id="meter_rent" name="meter_rent" placeholder="Enter Meter Rent"><br><br>
                    <input type="number" id="service_charge" name="service_charge" placeholder="Enter Service Charge"><br><br>
                    <input type="number" id="service_tax" name="service_tax" placeholder="Enter Service Tax"><br><br>
                    <input type="number" id="vat" name="vat" placeholder="Enter VAT"><br><br>
                    <button id="tax-update" type="submit" name="tax-submit">Update</button><br><br>
                  </form>
                  <script>
                    $(document).ready(function () {
    function taxUpdate() {
        var cpu = $("#cost_per_unit").val();
        var mr = $("#meter_rent").val();
        var sc = $("#service_charge").val();
        var st = $("#service_tax").val();
        var vat = $("#vat").val();
        if (cpu !== "" && mr !== "" && sc !== "" && st !== "" && vat !== "") {
                        $.ajax({
                            url: "tax.php",
                            method: "POST",
                            data: { cpu: cpu,
                                    mr: mr,
                                    sc: sc,
                                    st: st,
                                    vat: vat,
                             },
                            success: function(data) {
                              Swal.fire({
                              title: "Good job!",
                              text: "Tax Information Succesfully Updated",
                              icon: "success"
                            });
                           
                }
            });
        } else {
          Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
          footer: 'All field required!!'
        });
        }
    }


    $("#tax-update").on("click", function (e) {
        e.preventDefault();
        taxUpdate(); 
    });
});
                  </script>
              </div>
            </div>
        </div>
      </div>
      <div class="tabPanel">
        <div class="request-head">
          <h2>Meter Request Information</h2>
        </div>
        <div class="request-content">
          <form method="post">
          <button id="request1" type="submit" name="pending" >Pending Meter Request</button>
          <button id="request2" type="submit" name="send" >Sended Meter</button>
          <button id="request3" type="submit" name="received" >Meter Received</button>
          </form><br>
            <div style="overflow-x: auto;">
            <table class="table" cellpadding="10" cellspacing="1" width="1000" >  
              <thead class="table-head">
                 <tr>
                           <th>Meter No</th>
                           <th>Status</th>
                           <th>Request Date</th>
                           <th>Sending Date</th>
                           <th>Received Date</th>
                           <th>Action</th>
                           </tr>
                           
                     </thead>  
                     <tbody id="request-data">
                      
                     </tbody>
            </table>
            <script>
              $(document).on("click", ".meterSend", function() {
          var button = $(this); // Reference to the clicked button
          var meterNo = button.data("meter-no"); // Get the meter_no from data attribute

          $.ajax({
                url: "meter_request.php",
                method: "POST",
                data: { meter_no_req: meterNo },
                success: function(response) {
            // Disable the button and give feedback
                button.prop("disabled", true)
                  .text("Sent")
                  .css({
                      "background": "#ccc",
                      "cursor": "not-allowed"
                  });
        }
    });
});

                    $(document).ready(function () {
    function meterRequest1() {

      var pending = "Pending";
                        $.ajax({
                            url: "meter_request.php",
                            method: "POST",
                            data: { pending: pending,
                                                                 
                             },
                            success: function(data) {
                              $("#request-data").html(data);
                }
            });
         
    }
    function meterRequest2() {


        var send = "Send";
        
                          $.ajax({
                              url: "meter_request.php",
                              method: "POST",
                              data: { 
                                      send: send,
                                                                   
                              },
                              success: function(data) {
                                $("#request-data").html(data);
                            
                  }
              });
          
        }
        function meterRequest3() {

var received = "Received";
                  $.ajax({
                      url: "meter_request.php",
                      method: "POST",
                      data: {
                              received: received,                              
                       },
                      success: function(data) {
                        $("#request-data").html(data);
                     
          }
      });
   
}



    $("#request1").on("click", function (e) {
        e.preventDefault();
        meterRequest1(); 
    });
    $("#request2").on("click", function (e) {
        e.preventDefault();
        meterRequest2(); 
    });
    $("#request3").on("click", function (e) {
        e.preventDefault();
        meterRequest3(); 
    });
});
                  </script>
           
            </div>
        </div>
      </div>
      <div class="tabPanel">
        <div class="report-check-head">
            <h2>Customer Report Check</h2>
        </div>
        <div class="report-check-content">
          <form method="post">
          <input type="date" id="reportDate" name="reportDate">
          <button type="submit" id="reportCheck" name="reportCheck">Check</button><br>
          </form><br>
          <div style="overflow-x: auto;">
            <table class="table" cellpadding="10" cellspacing="1" width="1000" >  
              <thead class="table-head">
                 <tr>
                           <th>Meter No</th>
                           <th>Report</th>
                           <th>Replay</th>
                           <th>Action</th>
                           </tr>
                           
                     </thead>  
                     <tbody id="report-data">
                      
                     </tbody>
            </table>
            <script>
               $(document).on("click", ".replaySend", function() {
          var button = $(this); // Reference to the clicked button
          var meterNo = button.data("meter-no"); // Get the meter_no from data attribute
          var replay = $('#replay').val();
          var replayDate = $('#reportDate').val();

          $.ajax({
                url: "reportCheck.php",
                method: "POST",
                data: { meter_no_replay: meterNo,
                        replay: replay,
                        replayDate: replayDate,
                 },
                success: function(response) {
            // Disable the button and give feedback
                button.prop("disabled", true)
                  .text("Sent")
                  .css({
                      "background": "#ccc",
                      "cursor": "not-allowed"
                  });
        }
    });
});
               $(document).ready(function () {
    function reportCheck() {

      var reportDate = $('#reportDate').val();
                        $.ajax({
                            url: "reportCheck.php",
                            method: "POST",
                            data: { reportDate: reportDate,
                                                                 
                             },
                            success: function(data) {
                              $("#report-data").html(data);
                }
            });
         
    }

    $("#reportCheck").on("click", function (e) {
        e.preventDefault();
        reportCheck(); 
    });
    
});
            </script>
          </div>
        </div>
      </div>
      <div class="tabPanel">
        <div>
          <h2>Verification Request List</h2>
        </div>
        <div class="verify-content">
        <div style="overflow-x: auto;">
            <table class="table" cellpadding="10" cellspacing="1" width="1000" >  
              <thead class="table-head">
                 <tr>
                           <th>Meter No</th>
                           <th>Name</th>
                           <th>Division</th>
                           <th>Address</th>
                           <th>Phone</th>
                           <th>NID</th>
                           <th>Action</th>
                           </tr>
                           
                     </thead>  
                     <tbody>
                     <?php 
                        include ('connection.php');


                            $sql = "select * from customer where status='Not Verified'";
                            $result = mysqli_query($con, $sql);

                            if(mysqli_num_rows($result)>0){
                                while($rows = mysqli_fetch_assoc($result)){
                                    echo '<tr>
                                                        
                                          <td>'.$rows['meter_no'].'</td>
                                          <td>'.$rows['name'].'</td>
                                          <td>'.$rows['division'].'</td>
                                          <td>'.$rows['address'].'</td>
                                          <td>'.$rows['phone'].'</td>
                                          <td>'.$rows['nid'].'</td>
                                          <td>
                                          <button class="verify" 
                                          data-meter-no="'.$rows['meter_no'].'" 
                                          style="background:#04AA6D;color:white;border:transparent;
                                          border-radius:5px;cursor:pointer;padding: 5px 10px;">
                                          Verify
                                        </button>
                                        </td>
                                    </tr>';
                                }
                            }else{
                                echo 'No data found';
                            }

                        ?>
                     </tbody>
            </table>
            <script>
              $(document).on("click", ".verify", function() {
          var button = $(this); // Reference to the clicked button
          var meterNo = button.data("meter-no"); // Get the meter_no from data attribute

          $.ajax({
                url: "verification.php",
                method: "POST",
                data: { verification: meterNo },
                success: function(response) {
            // Disable the button and give feedback
                button.prop("disabled", true)
                  .text("Sent")
                  .css({
                      "background": "#ccc",
                      "cursor": "not-allowed"
                  });
        }
    });
});
                  </script>
           
            </div>
        </div>
      </div>
      <div class="tabPanel">
        <script>
           function logOut(){
            window.location.href = "admin-logout.php";
           }
        </script>
      </div>
    </div>
  
    <div class="item4">
      <a href="https://www.facebook.com/bm.jim.2024/" target="_blank"><img src="img/Ampeross-Qetto-Facebook.128.png" alt=""></a>
      <a href="https://www.instagram.com/bm___jim?igsh=ZDZjbG9mM3FnNDMx&utm_source=qr"><img src="img/Designbolts-Free-Cute-Shaded-Social-Instagram.128.png" alt=""></a>
      <a href="https://x.com/srubaer?s=21" target="_blank"><img src="img/Graphics-Vibe-Simple-Rounded-Social-Twitter.128.png" alt=""></a>
      <a href="mailto:shafinrubaer@gmail.com"><img src="img/Guillendesign-Variations-3-Mail-Gmail.128.png" alt=""></a>
      <a href="tel:+8801727743670" target="_blank"><img src="img/Everaldo-Crystal-Clear-App-phone.128.png" alt=""></a>
    </div>
  </div>
  <script src="admindashboard.js"></script>
 
</body>
</html>