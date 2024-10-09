<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Insert donor data into the database
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($con->query($sql) === TRUE) {
        // Donor added successfully
        echo "Donor added successfully.";
    } else {
        // Error adding donor
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
