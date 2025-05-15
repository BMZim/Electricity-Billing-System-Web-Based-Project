<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
        const passwordField = document.getElementById("D");
        const button = document.querySelector("button");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            
        } else {
            passwordField.type = "password";
        }
    }
    
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        body{
            display: flex;
            justify-content: center;
            padding-top: 50px;
            font-family: "Poppins", sans-serif;
            font-style: normal;
            font-weight: 600;
            background-image: url(img/adbg.jpg);
            background-position: center;
            background-size: cover;
    
        }
        .main{
            width: fit-content;
            display: flex;
            background: transparent;
            padding: 20px;
            font-size: 12px;
            gap: 100px;
            padding-left: 100px;
            padding-right: 100px;
            backdrop-filter: blur(10px);
            color: white;
            border: 2px solid white;
            border-radius: 20px;
            box-shadow: 0px 0px 10px black;
        }
        .main .container1 input{
            width: 200px;
            font-size: 15px;
            height: 25px;
            padding-left: 5px;
            border: 2px solid #588157;
            border-radius: 8px;
        } 
        .main .container2 #phone{
            width: 200px;
            font-size: 15px;
            height: 25px;
            padding-left: 5px;
            border: 2px solid #588157;
            border-radius: 8px;
        }
        .main .container2 #nid{
            width: 200px;
            font-size: 15px;
            height: 25px;
            padding-left: 5px;
            border: 2px solid #588157;
            border-radius: 8px;
        }
        .main .container2 #address{
            padding-left: 5px;
            padding-top: 5px;
        }
        h1{
            border-bottom: 2px solid white;
        }
        #eye{
            position: absolute;
            top: 285px;
            left: 320px;
            background: transparent;
            border: transparent;
            cursor: pointer;
        }
        .container1 button:hover{
            opacity: 50%;
        }
        .btn{
            display: flex;
            justify-content: space-between;
        }
        .btn input{
            width: 100px;
            height: 30px;
            border-radius: 8px;
            font-weight: 500;
            color: black;
            text-transform: uppercase;
            border: 2px solid white;
            background-color: #A2D2FF;
            box-shadow: 0px 0px 30px black;
        }
        .btn input:hover{
            border: 2px solid white;
            background-color: transparent;
            color: white;
            box-shadow: 0px 0px 30px white;
            transition: 0.4s;
        }
        @media (max-width: 700px){
            body{
                height: 950px ;
                display: flex;
                justify-content: left;
                padding-left: 10px;
                padding-top: 10px;
            }
            .main{
                display: flex;
                flex-direction: column;
                gap: 0px;
                padding-left: 10px;
                padding-right: 20px;
            }
            #eye{
                
                left: 222px;
            }
        }
    </style>
</head>

<body>
    
 <form method="POST" >
    <div class="main">
        <div class="container1">
            <h1>Admin Sign Up</h1><br>
     <label for="A">Full Name:<br></label><input type="text" id="fname" name="fname" size="20"placeholder="Enter Your Full Name" required><br><br>
     <label for="B">Job ID:<br></label><input type="number" id="jobid" name="jobid" size="20"placeholder="Enter Your Job ID" required><br><br>
     <label for="C">Email:<br></label><input type="email"  id="email"size="20" name="email" placeholder="Enter Your Email" required><br><br>
      <label for="D">Password:<br></label><input type="password" id="password" name="password" size="20" placeholder="Enter Password" required><br><br>
    <label for="E">Date of Birth:<br></label><input type ="date"id="date" name="date" size= "20" placeholder="Enter Date of Birth" required><br><br>
    <select id="security" name="security" required>
        <option value="" disabled selected>(Please select a security Question)</option>
        <option value="What is your pet name?">What is your pet name?</option>
        <option value="What is your father name?">What is your father name?</option>
        <option value="What is your favourite sports?">What is your favourite sport?</option>
    </select><br>
    <input type="text" id="answer" name="answer" placeholder=" Security Answer" required>
    <button type="button" id="eye" onclick="togglePassword()"><img src="img/eye.png" alt=""></button>
        </div>
        <div class="container2"><br>
            Gender:<br>
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Another"> Another<br><br>
            <label for="F">NID:<br></label><input type="number" id="nid" name="nid" size="20" maxlength="15" placeholder ="Enter NID"required><br><br>
            Division:<br>
    <select id="division" name="division">
    <option>(Please select your Division)</option>
    <option value="Dhaka">Dhaka</option>
    <option value="Khulna">Khulna</option>
    <option value="Slyhet">Slyhet</option>
    <option value="Rajshahi">Rajshahi</option>
    <option value="Rangpur">Rangpur</option>
    <option value="Chattogram">Chattogram</option>
    <option value="Mymensingh">Mymensingh</option>
    <option value="Barishal">Barishal</option>
    </select><br><br>
    <label for="G" >Address:</label><br>
     <textarea rows="5" cols="30" id="address" name="address" placeholder="Enter Your Present Address(including distric,Upazila,home no, road no, flat no.)"></textarea><br><br>
     <label for="I">Phone No:<br></label><input type="number" id="phone" name="phone" size="20" maxlength="15" placeholder ="Enter Phone No"required><br><br>
        <div class="btn">
            <input type="reset" value="Reset">
            <input type="submit" value="Submit" id="submit" name="submit">
        </div>
        
    
        </div>
        
    </div>
    
    

</form>
<script type="text/javascript">

	$(function(){
		$('#submit').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){
            
                var fname = $('#fname').val();
                var jobid = $('#jobid').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                var address = $('#address').val();
                var dob = $('#date').val();
                var security = $('#security').val();
                var answer = $('#answer').val();
                var division = $('#division').val();
                var gender = $('input[name="gender"]:checked').val();
                var nid = $('#nid').val();

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'admin-data.php',
					data: {
                            fname: fname,
                            jobid: jobid,
                            email: email,
                            phone: phone,
                            password: password,
                            address: address,
                            dob: dob,
                            security: security,
                            answer: answer,
                            division: division,
                            gender: gender,
                            nid: nid,
                },
					success: function(data){

                        if(data.trim() ===  "Success"){
                            Swal.fire({
                                title: "Good job!",
                                text: "SignUp Successfull",
                                icon: "success"
                                }).then(()=>{
                                    window.location.href = 'adminlogin.php';
                                });
                        }else if(data.trim() ===  "Exist"){
                            alert(data);
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            footer: 'Account Already Exist!!'
                            });
                        }else{
                            alert(data);
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            footer: 'Job ID Not Found Contact With Head Admin'
                            });
                        }
                        
							
					}
				});

				
			}else{
				alert("Fill all field");
			}

			



		});		

		
	});
	
</script>
</body>
</html>