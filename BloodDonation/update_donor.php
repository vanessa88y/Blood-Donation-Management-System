<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatedGender = $_POST['gender'];
    $updatedAge = $_POST['age'];
    $updatedWeight = $_POST['weight'];
    $updatedAddress = $_POST['address'];
    $updatedPhone = $_POST['phone'];
    $updatedBloodGroup = $_POST['blood_group'];

    // Update donor data in the database
    $sql = "UPDATE users SET name='$updatedName', email='$updatedEmail', gender='$updatedGender', age='$updatedAge', weight='$updatedWeight', address='$updatedAddress', phone='$updatedPhone', blood_group='$updatedBloodGroup' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        // Donor updated successfully
        header("Location: admin_donors.php");
        exit;
    } else {
        // Error updating donor
        echo "Error updating donor: " . $con->error;
    }
} else {
    // If the form is not submitted, redirect or display an error message
    echo "Form submission method not valid.";
    exit;
}

// Close the database connection
$con->close();
?>
