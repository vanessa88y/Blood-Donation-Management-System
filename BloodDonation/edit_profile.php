<?php
include 'healthcareP_navbar.php';
session_start(); // Start session if not already started

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
include 'connection.php';

// Fetch the current profile information
$id = $_SESSION['id'];
$sql = "SELECT name, email FROM users WHERE id = $id AND role = 'healthcare_professional'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
} else {
    // Handle case where the user is not found
    $name = "";
    $email = "";
}

// Handle form submission to update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $con->real_escape_string($_POST['name']);
    $new_email = $con->real_escape_string($_POST['email']);

    // Update the profile in the database
    $sql_update = "UPDATE users SET name = '$new_name', email = '$new_email' WHERE id = $id";
    if ($con->query($sql_update) === TRUE) {
        $message = "Profile updated successfully.";
        // Refresh the page to show updated information
        header("Location: profile.php");
        exit();
    } else {
        $error = "Error updating profile: " . $con->error;
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Edit Profile</title>
    <style type="text/css">
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button-container {
            text-align: center;
        }

        .save-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: green;
            font-weight: bold;
        }

        .error {
            text-align: center;
            margin-top: 20px;
            color: red;
            font-weight: bold;
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
        <h1>Edit Profile</h1>
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="button-container">
                <button type="submit" class="save-button">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$con->close();
?>
