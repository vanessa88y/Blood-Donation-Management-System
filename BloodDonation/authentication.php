<?php
include('connection.php');
session_start();

// Retrieve email and password from POST request
$email = $_POST['login_email'];
$password = $_POST['login_password'];

// To prevent from MySQL injection
$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysqli_real_escape_string($con, $email);

// Hash the provided password using MD5
$hashed_password = md5($password);

// Retrieve the hashed password and name from the database for the provided email
$sql = "SELECT id, name, password, role FROM users WHERE email = '$email'";
$result = mysqli_query($con, $sql);

if (!$result) {
    // Query execution failed, display error message
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Check if a user with the provided email exists
if ($row) {
    $stored_hash = $row['password'];

    // Compare the hashed password from the database with the hashed password provided by the user
    if ($hashed_password === $stored_hash) {
        // Passwords match, start session and redirect user based on role
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name']; // Store the user's name in the session

        switch ($row['role']) {
            case 'patient':
                header("Location: patient.php");
                exit();
            case 'donor':
                header("Location: donor.php");
                exit();
            case 'healthcare_professional':
                header("Location: healthcareP.php");
                exit();
            default:
                // Handle unexpected role
                echo "Unknown role";
                break;
        }
    } else {
        // Incorrect password
        $_SESSION['login_error'] = "Incorrect password. Please try again.";
        header("Location: login.php");
        exit();
    }
} else {
    // User not found
    $_SESSION['login_error'] = "User not found. Please try again.";
    header("Location: login.php");
    exit();
}
?>
