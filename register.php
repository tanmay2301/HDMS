<?php
include('db.php');

$registrationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO patients (username, password, name, age, gender, address, phone) VALUES ('$username', '$password', '$name', $age, '$gender', '$address', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $registrationMessage = "Registration successful!";
    } else {
        $registrationMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecd0a9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: beige;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: large;
            width: 950px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        form h2{
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: 550;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 20px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .registration-details {
            text-align: center;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .registration-details p {
            margin: 8px 0;
        }
    </style>
</head>
<body>
        <header class="header">
            <a href="home.html">
                <img src="logo3.png" id="logo" alt="" >
    
            </a>
            <nav class="navbar">
                <a href="home.html">HOME</a>
                <a href="about.html">ABOUT</a>
                <a href="services.html">SERVICES</a>
                <a href="register.php">REGISTER</a>
                <a href="login.php">LOGIN</a>
            </nav>
            <div class="icons">
                <div id="menubar" class="fas fa-bars"></div>
                <a href="contact.php">CONTACT US</a>
            </div>
        </header>

    
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>PATIENT REGISTRATION FORM</h2>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="age">Age:</label>
        <input type="number" name="age" required>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" required>

        <input type="submit" value="Submit">
        
        <?php if (!empty($registrationMessage)) : ?>
            <div class="registration-details">
                
                <p><?php echo $registrationMessage; ?></p>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>
