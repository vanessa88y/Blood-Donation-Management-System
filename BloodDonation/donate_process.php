<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $blood_group = $_POST["blood_group"];
    $units = $_POST["units"];
    $diseases = isset($_POST["diseases"]) ? $_POST["diseases"] : ''; // Check if diseases are set
    $weight = isset($_POST["weight"]) ? $_POST["weight"] : ''; // Check if weight is set
    $age = isset($_POST["age"]) ? $_POST["age"] : ''; // Check if age is set

    // Retrieve the user's ID from the session
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id']; 

        // Insert the donation into the database
        $sql = "INSERT INTO donations (id, blood_group, units, diseases, age, weight) 
                VALUES ('$id', '$blood_group', '$units', '$diseases', '$age', '$weight')";

        if ($con->query($sql) === TRUE) {
            // Donation successful
            header("Location: donor_appointment.php"); // Redirect back to the donate page
            exit(); // Prevent further execution
        } else {
            // Error handling
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        // Redirect to login page if user session is not set
        header("Location: login.php");
        exit();
    }
}

// Close the database connection
$con->close();
?>
