<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user's name from the session
$user_name = $_SESSION['name'];

include 'patientnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 150px); /* Adjusted height to fit the screen properly */
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
    
    <div class="image-container">
        <img src="images/pic1.jpg">
    </div>
</body>
</html>
