<?php
include('db.php');

$submissionMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $submissionMessage = "Submission successful!";
    } else {
        $submissionMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            width: 400px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        form h2 {
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

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .submission-details {
            text-align: center;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .submission-details p {
            margin: 8px 0;
        }
    </style>

</head>
<body>
    <header class="header">
        <a href="home.html">
            <img src="logo3.png" id="logo" alt="">
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
        </div>
    </header>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>Contact Us</h2>

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" required>

        <input type="submit" value="Submit">

        <?php if (!empty($submissionMessage)) : ?>
            <div class="submission-details">
                
                <p><?php echo $submissionMessage; ?></p>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>

