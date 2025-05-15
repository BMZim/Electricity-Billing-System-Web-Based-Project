<?php 
session_start();
?>

<?php
require_once 'connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['emailOrPhone'];
    $password = $_POST['pass'];

    $sql = "select meter_no,email,PASSWORD,phone from customer where (email = '$email' OR phone='$email') AND PASSWORD = '$password'";
    
    $result = mysqli_query($con, $sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($user['PASSWORD'] === ($password)) {
            $_SESSION['user_no'] = $user['meter_no'];
            header("Location: userdashboard.php");
            exit();
        } 
    } else {
        header('Location: userlogin.php?error=Invalid Login Information');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            top: 0;
            margin: 0;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }
        body{

            background-image: url(img/userbg.jpg);
            background-position: center;
            background-size: cover;
        }
        .main{
            padding-top: 100px;
            padding-left: 140px;
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
            left: 445px;
            background: transparent;
            border: transparent;
        }
        #email{
            position: absolute;
            top: 185px;
            left: 450px;
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
        .login a{
            color: white;
            text-shadow: 0px 0px 10px #4895EF;
        }
        #check:hover{
            background-color: #4895EF;
            color: white;
            border: 2px solid white;
            transition: 0.3s;
        }
        .signup{
            padding: 50px;
            display: flex;
            flex-direction: column;
            gap: 50px;
            align-items: center;
            backdrop-filter: blur(10px);
            border: 2px solid white;
            border-radius: 30px;
            box-shadow: 0px 0px 10px white;
            color: white;
        }
        .signup #h{
            padding-top: 50px;
        }
        .signup h2{
            padding-top: 10px;
        }
        .signup #reg{
            text-decoration: none;
            color: white;
            border: 2px solid white;
            text-align: center;
            width: 100px;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px white;
        }
        #reg:hover{
            background-color: white;
            border: 2px solid black;
            color: black;
            transition: 0.3s;
        }
        #team{
            color: #4895EF;
        }
        .login #eye:hover{
            opacity: 50%;
        }
        @media (max-width: 700px){
            body{
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .main{
                height: 1200px;
                padding-left: 20px;
                padding-top: 15px;
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
                width: 24px;
                height: 24px;
            }
            #eye{
                top: 328px;
                left: 238px;
                
            }
            .signup{
                width: 180px;
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
            <p>Please log in to access your electricity billing account.</p>
            <?php 
                if(isset($_GET['error'])){  
                    echo '<p style="color:red;">'.$_GET['error'].'</p>';
                }

            ?>
            <form method="POST">
                <input  id="emailOrPhone" name="emailOrPhone" placeholder="Email Or Phone No" required>
                <input type="password"   id="password" name="pass" placeholder="Enter password" required>
                <button id="check" type="submit" name="submit">Login</button>
                <img id="email" src="img/email.png" alt="email">
                <button type="button" id="eye" onclick="togglePassword()"><img src="img/eye.png" alt=""></button>
            </form>
            <a href="forgotpassuser.php">Forgot Password?</a>
        </div>
        <div class="signup">
            <h2>Don't have an account?</h2>
            <a id="reg" href="usersignup.php">Sign Up</a>
            <h2 id="h" >Need Help?</h2>
            <p>For assistance, reach out to our <a id="team" href="#">support team</a>.</p>
        </div>
    </div>
</body>
</html>