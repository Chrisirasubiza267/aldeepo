

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px;
        }

        .form-header {
            background-color: chocolate;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .form-body {
            padding: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="radio"],
        .form-group input[type="checkbox"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 12px;
        }

        .form-group .checkbox-group label {
            margin-right: 10px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: chocolate;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background:chocolate;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Registration Form </h2>
        </div>
        <div class="form-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Gender:</label>
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country">
                        <option value="rwanda">Rwanda</option>
                        <option value="tz">Tanzania</option>
                        <option value="ug">Uganda</option>
                        <option value="kenya">Kenya</option>
                        <option value="burundi">Burundi</option>
                        <option value="sa">South Africa</option>
                    </select>
                    <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" name="password" placeholder="enter your password" required>
                </div>

                </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div>
            </form>
            <?php
           include('connection.php');
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $names=$conn->real_escape_string($_POST['name']);
                $gender=$conn->real_escape_string($_POST['gender']);
                $country=$conn->real_escape_string($_POST['country']);
                $email=$_POST['email'];
                $password =$_POST['password'];
                $sql = "INSERT INTO FormData (names, gender, country,password,email) VALUES ('$names', '$gender', '$country','$password','$email')";

                if ($conn->query($sql) === TRUE) {

                    header('location: Loginform[1].php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
