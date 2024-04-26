<?php
session_start();

// Include database configuration
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "stock_prediction_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_SESSION['login_error'])) {
    unset($_SESSION['login_error']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: welcome.html"); // Redirect to welcome page
        exit();
    } else {
        // Invalid credentials
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: index.php"); // Redirect back to login page
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>
