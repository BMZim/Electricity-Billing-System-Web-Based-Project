<?php 
session_start();

?>

<?php
require_once 'connection.php';

if (isset($_POST['submit'])) {
    $jobid = $_POST['jobid'];
    $password = $_POST['pass'];

    $sql = "select jobid,PASSWORD from adminlogin where jobid = '$jobid' AND PASSWORD = '$password'";
    
    $result = mysqli_query($con, $sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($user['PASSWORD'] === ($password)) {
            $_SESSION['user_id'] = $user['jobid'];
            header("Location: admindashboard.php");
            exit();
        } 
    } else {
        header('Location: adminlogin.php?error=Invalid Login Information');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            top: 0;
            margin: 0;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }
        body{

            background-image: url(img/adminbg.jpg);
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            
        }
        .main{
            padding-top: 80px;
            display: flex;
            gap: 30px;
            
        }
        .login{
            display: flex;
            flex-direction: column;
            color: white;
            backdrop-filter: blur(5px);
            padding: 50px;
            gap: 30px;
            align-items: center;
            border: 2px solid white;
            border-radius: 30px;
            box-shadow: 0px 0px 10px white;
        }
        form{
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        input{
            width: 300px;
            font-size: 12px;
            padding: 8px;
            border: transparent;
            border-radius: 8px;
        }
        #eye{
            position: absolute;
            top: 235px;
            left: 370px;
            background: transparent;
            border: transparent;
        }
        #email{
            position: absolute;
            top: 183px;
            left: 375px;
            height: 32px;
            width: 32px;
        }
        #check{
            padding: 6px;
            margin-top: 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 8px;
            border: transparent;
            width: 200px;
            margin-left: 55px;
            border: 2px solid #4361EE;
            
        }
        form a{
            padding-left: 80px;
            color: white;
            text-shadow: 0px 0px 10px #4895EF;
        }
        #check:hover{
            background-color: #4895EF;
            color: white;
            border: 2px solid white;
            transition: 0.3s;
        }
        #signup{
            color: #4895EF;
        }
        .login button:hover{
            opacity: 50%;
        }
       
        
        
        @media (max-width: 700px){
            body{
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .main{
                height: 1000px;
                padding-left: 20px;
                padding-top: 100px;
                display: flex;
                flex-direction: column;
            }
            .login{
                width: 180px;
            }
            input{
                width: 200px;
                margin-left: -20px;
            }
            #check{
                margin-left: 30px;
                width: 100px;
            }
            form a{
                padding-left: 15px;
            }
            #email{
                top: 280px;
                left: 245px;
                width: 28px;
                height: 28px;
            }
            #eye{
                top: 328px;
                left: 238px;
                
            }
            .login h1, p{
                text-align: center;
            }
        }

    </style>
    <script>
         function togglePassword() {
        const passwordField = document.getElementById("password");
        const button = document.querySelector("button");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            
        } else {
            passwordField.type = "password";
        }
    }
    </script>
</head>
<body>
    <div class="main">
        <div class="login">
            <h1>Welcome Back!</h1>
            <p>Please log in to manage electricity bill.</p>
            <?php 
                if(isset($_GET['error'])){  
                    echo '<p style="color:red;">'.$_GET['error'].'</p>';
                }

            ?>
            <form method="POST">
                <input  id="jobid" name="jobid" placeholder="Enter JobID" required>
                <input type="password"  id="password" name="pass" placeholder="Enter password" required>
                <button id="check" type="submit" name="submit">Login</button>
                <img id="email" src="img/id.png" alt="email">
                <button type="button" id="eye" onclick="togglePassword()"><img src="img/eye.png" alt=""></button>
                <a href="forgotpassadmin.php">Forgot Password?</a>    
            </form>
            <p>Don't have an account? <a href="#" id="signup" >Sign Up</a></p>
        </div>
        
    </div>
</body>
</html>
