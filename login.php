<?php
// Connect to the database (replace with your database credentials)
$servername = "localname";
$username = "root";
$password = " ";
$dbname = "userdetails";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // TODO: Validate the username and password against the database
    // For demonstration purposes, let's assume the database table is named "users"
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication successful, set up a session variable
        session_start();
        $_SESSION["username"] = $username;

        // Redirect to another page after successful login
        header("Location: welcome.php");
        exit;
    } else {
        // Authentication failed, show an error message or redirect back to login page
        header("Location: signin.html?error=1"); // Redirect back to the login page with an error flag
        exit;
    }
}

// Close the database connection
$conn->close();
?>
