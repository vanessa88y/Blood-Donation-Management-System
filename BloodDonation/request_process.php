<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user's ID from session
$id = $_SESSION['id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $blood_group = mysqli_real_escape_string($con, $_POST["blood_group"]);
    $units = mysqli_real_escape_string($con, $_POST["units"]);

    // Insert the request into the database
    $sql = "INSERT INTO requests (id, blood_group, units, status) 
            VALUES ('$id', '$blood_group', '$units', 'pending')";
    
    if ($con->query($sql) === TRUE) {
        // Request successful
        header("Location: request.php"); // Redirect back to the request page
        exit(); // Prevent further execution
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
