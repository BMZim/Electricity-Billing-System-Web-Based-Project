<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            transform: translateY(100px);
        }
        .main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px 70px;
            background-color: beige;
            border-radius: 10px;
            box-shadow: 0px 0px 10px;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        form input{
            padding: 3px 5px;
            border-radius: 5px;
            outline: none;
            border: transparent;
            background-color: aliceblue ;
            
        }
        #submit{
            background-color: green;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 0px 7px black;
            cursor: pointer;
            transition: all 0.5s ease;
        }
        #submit:hover{
            transform: translateY(-5px);
        }
        
    </style>
</head>
<body>
    <div class="main">
    <h2>Recover Your Password</h2>
        <form action="forgotpassadmin.php" method="post">
        <input type="text" id="email" name="email" placeholder="Enter your email" required><br><br>
        <select id="security" name="security" required>
        <option value="" disabled selected>(Please select a security Question)</option>
        <option value="What is your pet name?">What is your pet name?</option>
        <option value="What is your father name?">What is your father name?</option>
        <option value="What is your favourite sports?">What is your favourite sport?</option>
    </select><br><br>
    <input type="text" name="answer" placeholder="Enter your answer" required><br><br>
    <input type="password" name="password" id="password" placeholder="Enter new password" required><br><br>
    <button name="submit" id="submit">Recover</button>

        </form>
        
    </div>
</body>
</html>

<?php 
include('connection.php');


if(isset($_POST['submit'])){
    $question = $_POST['security'];
    $answer = $_POST['answer'];
    $jobid = $_POST['email'];
    $pass = $_POST['password'];


    $sql = "select * from customer where email='$jobid'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){
       $rows = $result->fetch_assoc();

       if($question === $rows['Security_Question'] && $answer=== $rows['answer']){
        $sql1 = "update customer set PASSWORD='$pass' where email='$jobid'";
        $result1 = mysqli_query($con, $sql1);
        if($result1){
            header("Location: userlogin.php");
        }else{
            echo 'Failed';
        }
       }else{
        echo 'Your Question or Answer is incorrect!!';
       }
    }else{
        echo 'Email does not Exist';
    }

}

?>