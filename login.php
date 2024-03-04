<?php
include('db.php');
session_start();

// Check if logout parameter is present in the URL
if (isset($_GET['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to the home page
    header("Location: home.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $sql = "SELECT * FROM patients WHERE username = '$enteredUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($enteredPassword, $row["password"])) {
            $_SESSION["patient_id"] = $row["id"];
            $_SESSION["patient_name"] = $row["name"];
            $_SESSION["patient_age"] = $row["age"];
            $_SESSION["patient_gender"] = $row["gender"];
            $_SESSION["patient_address"] = $row["address"];
            $_SESSION["patient_phone"] = $row["phone"];
            header("Location: login.php"); // Redirect to a success page
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
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
            width: 300px;
            font-size: large;
            width: 450px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        form h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
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

        p {
            margin-top: 16px;
            font-weight: bold;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            margin-top: 8px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
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
            <a href="contact.php">CONTACT US</a>
        </div>
    </header>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>PATIENT LOGIN</h2>
        <?php
        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">

        <?php
        if (isset($_SESSION["patient_id"])) {
            echo "<h2>Patient Details</h2>";
            echo "<p><strong>ID:</strong> {$_SESSION['patient_id']}</p>";
            echo "<p><strong>Name:</strong> {$_SESSION['patient_name']}</p>";
            echo "<p><strong>Age:</strong> {$_SESSION['patient_age']}</p>";
            echo "<p><strong>Gender:</strong> {$_SESSION['patient_gender']}</p>";
            echo "<p><strong>Address:</strong> {$_SESSION['patient_address']}</p>";
            echo "<p><strong>Phone Number:</strong> {$_SESSION['patient_phone']}</p>";
            echo "<p><a href='?logout=true'>Logout</a></p>";
        }
        ?>
    </form>
</body>
</html>
