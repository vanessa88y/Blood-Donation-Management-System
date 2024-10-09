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
    $units = intval($_POST["units"]); // Convert to integer

    // Check if units is a positive integer
    if ($units <= 0) {
        echo "<script>
                alert('Please enter a valid number of units.');
                window.location.href = 'patient_requests.php';
              </script>";
        exit();
    }

    // Check blood availability
    $sql_check_availability = "SELECT SUM(units) as total_units FROM bloodinventory WHERE blood_group = '$blood_group'";
    $result = $con->query($sql_check_availability);
    
    if ($result) {
        $row = $result->fetch_assoc();
        $available_units = intval($row['total_units']);

        if ($available_units >= $units) {
            // Blood is available, proceed with appointment scheduling
            // Insert the blood request into the database
            $sql_insert_request = "INSERT INTO requests (id, blood_group, units, status) 
                                   VALUES ('$id', '$blood_group', '$units', 'pending')";

            if ($con->query($sql_insert_request) === TRUE) {
                // Blood request successfully submitted
                header("Location: patient_appointment.php");
                exit(); // Prevent further execution
            } else {
                // Error handling for the insert query
                echo "<script>
                        alert('Error submitting request: " . $con->error . "');
                        window.location.href = 'patient_requests.php';
                      </script>";
            }
        } else {
            // Not enough blood units available
            echo "<script>
                    alert('The requested blood type or number of units is not available. Please try again.');
                    window.location.href = 'patient_requests.php';
                  </script>";
        }
    } else {
        // Error in checking blood availability
        echo "<script>
                alert('Error checking blood availability: " . $con->error . "');
                window.location.href = 'patient_requests.php';
              </script>";
    }
}

// Close the database connection
$con->close();
?>
