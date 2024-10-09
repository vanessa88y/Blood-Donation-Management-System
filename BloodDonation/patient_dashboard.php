<?php
// Include the database connection file
include 'connection.php';
include 'patientnavbar.php';

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user's ID from session
$id = $_SESSION['id'];

// Query to retrieve donor's information
$sql_donations = "SELECT * FROM requests WHERE id = '$id'";
$result_donations = $con->query($sql_donations);

// Query to retrieve pending requests
$sql_pending = "SELECT * FROM requests WHERE id = '$id' AND status = 'pending'";
$result_pending = $con->query($sql_pending);

// Query to retrieve accepted requests
$sql_accepted = "SELECT * FROM requests WHERE id = '$id' AND status = 'accepted'";
$result_accepted = $con->query($sql_accepted);

// Query to retrieve rejected 
$sql_rejected = "SELECT * FROM requests WHERE id = '$id' AND status = 'rejected'";
$result_rejected = $con->query($sql_rejected);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="">
    <style>
        nav ul {
            background-color: brown;
            color: #fff;
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        nav ul li {
            float: right;
        }
        nav ul li a {
            display: block;
            color: black;
            text-align: center;
            padding: 10px 16px;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: grey;
        }
        .container {
            display: block;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .box {
            flex: 0 1 45%; /* Adjust the width as needed */
            background-color: #f2f2f2;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
      
        
        
       </style>
</head>
<body>
    <div class= "container">
    <div class="box">
<h2>Blood Requested:</h2>
    <ul>
        <?php
        // Display blood requests
        if ($result_donations->num_rows > 0) {
            while ($row_donations = $result_donations->fetch_assoc()) {
                echo "<li>" . $row_donations['units'] . " units of " . $row_donations['blood_group'] . " blood</li>";
            }
        } else {
            echo "<li>No blood requests yet</li>";
        }
        ?>
    </ul>
    </div>
    <div class="box">
    <h2>Pending Requests:</h2>
    <ul>
        <?php
        // Display pending requests
        if ($result_pending->num_rows > 0) {
            while ($row_pending = $result_pending->fetch_assoc()) {
                echo "<li>" . $row_pending['units'] . " units of " . $row_pending['blood_group'] . " blood requested</li>";
            }
        } else {
            echo "<li>No pending requests</li>";
        }
        ?>
    </ul>
    </div>

    <div class="box">
    <h2>Accepted Requests:</h2>
    <ul>
        <?php
        // Display accepted requests
        if ($result_accepted->num_rows > 0) {
            while ($row_accepted = $result_accepted->fetch_assoc()) {
                echo "<li>" . $row_accepted['units'] . " units of " . $row_accepted['blood_group'] . " blood accepted</li>";
            }
        } else {
            echo "<li>No accepted requests</li>";
        }
        ?>
    </ul>
    </div>

    <div class="box">
    <h2>Rejected Requests:</h2>
    <ul>
        <?php
        // Display rejected donations
        if ($result_rejected->num_rows > 0) {
            while ($row_rejected = $result_rejected->fetch_assoc()) {
                echo "<li>" . $row_rejected['units'] . " units of " . $row_rejected['blood_group'] . " blood rejected</li>";
            }
        } else {
            echo "<li>No rejected requests</li>";
        }
        ?>
    </ul>
    </div>
    </div>

</body>
</html>