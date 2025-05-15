<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meter Info</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            transform: translateY(30%);
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
            background-blend-mode: multiply,multiply;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }
        .meter-info{
            background-color: #F5F3F4;
            padding: 20px 100px;border-radius: 10px;
            box-shadow: 0px 0px 10px black;
            
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form select{
            padding:  2px 5px;
            border-radius: 5px;
            border-color: #4CC9F0;
            outline: none;
        }
        form button{
                width: fit-content;
                margin-left: 30%;
                padding: 5px 20px;
                background-color: #4CC9F0;
                border: transparent;
                border-radius: 8px;
                transition: all 0.5s ease;
                cursor: pointer;
                box-shadow: 0px 2px 10px black;
        }
        form button:hover{
            background-color: #4895EF;
            color: white;
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="meter-info">
        <form action="meter.php" method="post">
        <h4 id="meter-no" name="meter-no">
            <?php 
                session_start();
                $meterno = $_SESSION['meter-no'];
                echo 'Meter No: '.$meterno;
            ?>
        </h4>
        Meter Location:<br>
    <select id="location" name="location" required>
    <option value="" disabled selected>(Select your meter Location )</option>
    <option value="Inside">Inside</option>
    <option value="Outside">Outside</option>
    </select><br>
    Meter Type:<br>
    <select id="meter-type" name="meter-type" required>
    <option value="" disabled selected>(Select your meter type )</option>
    <option value="Electrical">Electrical</option>
    </select><br>
    Phase Code:<br>
    <select id="phase-code" name="phase-code" required>
    <option value="" disabled selected>(Select your phase code )</option>
    <option value="101">101</option>
    <option value="102">102</option>
    <option value="103">103</option>
    <option value="104">104</option>
    <option value="105">105</option>
    </select><br>
    Bill Type:<br>
    <select id="bill-type" name="bill-type" required>
    <option value="" disabled selected>(Select your meter type )</option>
    <option value="Normal">Normal</option>
    <option value="Industrial">Industrial</option>
    </select><br>
    <h4 style="color: red;">Bill will be calculated for 30-31 days.</h4>

    <button id="submit" name="submit">Submit</button>
        </form>
        
        
    </div>
</body>
</html>