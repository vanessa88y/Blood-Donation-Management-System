<?php
// Include the database connection file
include 'connection.php';

// Check if the donor ID is provided via GET request
if(isset($_GET['id'])) {
    // Sanitize the donor ID to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Construct the SQL query to delete the donor
    $sql = "DELETE FROM users WHERE id = '$id'";

    // Execute the query
    if(mysqli_query($con, $sql)) {
        // patient deleted successfully
        header("Location: admin_donors.php"); // Redirect back to the donors list page
        exit();
    } else {
        // Error occurred while deleting the donor
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Donor ID not provided, redirect back to the donors list page
    header("Location: admin_donors.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
