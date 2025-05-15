<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body{
            font-family: "Poppins", sans-serif;
            font-style: normal;
            display: flex;
            justify-content: center;
            transform: translateY(150px);
            
        }
        .main{
            display: flex;
            flex-direction: column;
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            padding: 50px 70px;
            border-radius: 10px;
            transition: all 0.5s ease;
            height: 200px;

        }
        .main:hover{
            transform: translateY(-20px);
            box-shadow: 0px 15px 77px 4px #48CAE4;
        }
        .otp-send{
            display: flex;
            gap: 30px;
        }
        .otp-verify{
            display: flex;
            gap: 30px;
        }
        input{
            padding: 2px 5px;
            border: transparent;
            border-radius: 5px;
            outline: none;
            font-size: 18px;
        }
        button{
            padding: 5px 20px;
            border: transparent;
            border-radius: 6px;
            background-color: #04AA6D;
            font-weight: 600;
            font-family: "Poppins", sans-serif;
            transition: all 0.5s ease;
            cursor: pointer;
        }
        button:hover{
            transform: translateX(10px);
            background-color: #48CAE4;
            box-shadow: 0px 5px 20px 4px black;

        }
    </style>
</head>
<body>
    <div class="main">
        <div class="otp-send">
        <input type="email" id="email" placeholder="Enter Your Email">
        <button id="send">Send</button>
        </div><br><br>
        <div class="otp-verify">
        <input type="number" id="otp" placeholder="Enter OTP">
        <button id="verify">Verify</button>
        </div>
    </div>
    <script>
        
        
        const send = document.getElementById('send');
        const verify = document.getElementById('verify');
        const gen_opt = Math.floor(100000 + Math.random() * 900000);
        function sendEmail(){
            const email = document.getElementById('email');
           
            Email.send({
                SecureToken : "1586ed89-b601-4653-bfcf-7c021b711518",
                To : email.value,
                From : "shafinrubaer@gmail.com",
                Subject : "Payment Verification",
                Body : "Your OTP is: "+gen_opt+""
            }).then(
            message => {
                if(message==="OK"){
                    Swal.fire({
                    title: "OTP Send",
                    text: "Check Your gmail inbox!!",
                    icon: "success",
                    timer: 1500
                    });
                }
            }
            );
        }

        function verifyOTP(){
            const otp = document.getElementById('otp');
            if(otp.value==gen_opt){
                window.location.href = 'payment.php';
            }else{
                Swal.fire({
                    title: "Wrong OTP!!",
                    text: "Enter Correct OPT!!",
                    icon: "error",
                    timer: 1500
                    });
            }

        }

        send.addEventListener("click",sendEmail);
        verify.addEventListener("click",verifyOTP);


        
    </script>
    <script src="https://smtpjs.com/v3/smtp.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>