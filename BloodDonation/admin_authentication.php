<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    // Query to check if the provided credentials match
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        // Query execution failed, display error message
        die("Error: " . mysqli_error($con));
    }

    // Check if a row is returned
    if (mysqli_num_rows($result) == 1) {
        // Authentication successful, redirect to admin dashboard
        header("Location: admin.php");
        exit();
    } else {
        header("Location: index.php");
        exit();

       
    }
}

// Close the database connection
mysqli_close($con);
?>
