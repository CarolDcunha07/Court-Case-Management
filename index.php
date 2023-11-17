<?php
$servername = "localhost";
$username = "root";
$password = ""; // Add your MySQL password here if you have set any
$dbname = "login_sample_db1"; // You can change this to your desired database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the register form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $user_id = $_POST["userId"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_id, password) VALUES ('$user_id', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $user_id = $_POST["userId"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";
            // Redirect to the dashboard or home page
            header("Location: dashboard.html");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>

<html>
<head>
    <title>Login and Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="fb.jpg">
                <img src="tw.png">
                <img src="gp.jpg">
            </div>

            <form id="login" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn" name="login">Log In</button>
            </form>

            <form id="register" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <input type="checkbox" class="check-box"><span>I agree to the terms & conditions</span>
                <button type="submit" class="submit-btn" name="register">Register</button>
            </form>
        </div>
    </div>

<script>
    var loginButton = document.getElementById("login");
    var registerButton = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {
        loginButton.style.left = "-400px";
        registerButton.style.left = "50px";
        z.style.left = "110px";
    }

    function login() {
        loginButton.style.left = "50px";
        registerButton.style.left = "450px";
        z.style.left = "0px";
    }

    registerButton.addEventListener("click", function () {
        // Redirect the user to the login form
        window.location.href = "#login";
    });

    // Remove the login form submit event listener
</script>

</body>
</html>
