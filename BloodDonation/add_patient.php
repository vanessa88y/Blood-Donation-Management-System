<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];

    // Insert patient data into the users table with the role 'patient'
    $sql_insert_user = "INSERT INTO users (name, email, role, gender, address, phone) 
                        VALUES ('$name', '$email', 'patient', '$gender', '$address', '$phone')";

    if ($con->query($sql_insert_user) === TRUE) {
        // Get the last inserted user ID
        $user_id = $con->insert_id;

        // Insert blood group into the requests table
        $sql_insert_request = "INSERT INTO requests (id, blood_group, status) 
                               VALUES ('$user_id', '$blood_group', 'pending')";

        if ($con->query($sql_insert_request) === TRUE) {
            // Patient and request added successfully
            // Redirect to the admin page
            header("Location: admin.php");
            exit(); // Ensure that no further code is executed
        } else {
            // Error adding request
            echo "Error: " . $sql_insert_request . "<br>" . $con->error;
        }
    } else {
        // Error adding patient
        echo "Error: " . $sql_insert_user . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
