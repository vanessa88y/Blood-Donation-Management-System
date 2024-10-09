<?php
include'healthcareP_navbar.php';
session_start(); // Start session if not already started

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
include 'connection.php';

// Fetch the healthcare professional's information from the database
$id = $_SESSION['id'];
$sql = "SELECT name, email FROM users WHERE id = $id AND role = 'healthcare_professional'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
} else {
    // Healthcare professional not found
    $name = "N/A";
    $email = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Professional Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .profile {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .button-container {
            text-align: center;
        }

        .edit-profile-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-profile-button:hover {
            background-color: #45a049;
        }
        nav {
            background-color: brown;
            color: #fff;
        }

        nav ul {
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
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="profile">
        <h1>Healthcare Professional Profile</h1>
        <div class="profile-info">
            <label for="name">Name:</label>
            <p><?php echo $name; ?></p>
            <label for="email">Email:</label>
            <p><?php echo $email; ?></p>
            <!-- Add more profile information here as needed -->
        </div>
        <div class="button-container">
            <button class="edit-profile-button" onclick="location.href='edit_profile.php'">Edit Profile</button>
        </div>
    </div>
</body>
</html>

