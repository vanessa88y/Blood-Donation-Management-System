<?php
// Include the database connection file
include 'connection.php';
include 'index_navbar.php';

// Initialize a success message variable
$success_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $gender = $_POST["gender"];
    $blood_group = $_POST["blood_group"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Hash the password using MD5
    $hashed_password = md5($password);

    // Connect to your database
    $conn = new mysqli('localhost', 'root', '', 'BDMS');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO users (name, email, password, role, gender,  phone, address) 
            VALUES ('$name', '$email', '$hashed_password', '$role', '$gender',  '$phone', '$address')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Registration successful, set success message
        $success_message = "Registration successful! Welcome, $name.";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="">
    <style>
        ul {
    list-style-type: none; /* Remove default list bullets */
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
    overflow: hidden; /* Prevent overflow */
}

.nav {
    background-color: brown; /* Background color for the nav bar */
    padding: 5px 0; /* Top and bottom padding for the nav bar */
}

.nav ul li {
    float: right; /* Align list items horizontally */
}

.nav ul li a {
    display: block; /* Block-level link for padding and margin */
    color: white; /* Link text color */
    text-align: center; /* Center align text */
    padding: 10px 10px; /* Padding for the links */
    text-decoration: none; /* Remove underline from links */
    font-size: 16px; /* Font size for the links */
}

.nav ul li a:hover {
    background-color: white; /* Background color on hover */
    color: black; /* Text color on hover */
}


        .wrapper {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        body {
            background-color: brown;
        }
        /* Form */
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        /* Labels */
        label {
            display: block;
            margin-bottom: 5px;
        }
        /* Inputs */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        /* Submit Button */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Already a member section */
        section {
            margin-top: 20px;
            text-align: center;
        }
        section a {
            color: #007bff;
            text-decoration: none;
        }
        section a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <?php
    if (!empty($success_message)) {
        echo "<div style='background-color: #dff0d8; padding: 10px; border-radius: 5px; color: #3c763d; margin-bottom: 20px;'>
                $success_message
              </div>";
    }
    ?>
    <section>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="donor">Donor</option>
                <option value="patient">Patient</option>
                <option value="healthcare_professional">Healthcare Professional</option>
            </select><br>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
            
            
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone"><br>
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea><br>
            <input type="submit" value="Register">
        </form>
    </section> 
    <section>
        Already a member?
        <a href="login.php">Login here</a>
    </section>
</div>

<script>
    function validateForm() {
        // Retrieve form values
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var password = document.getElementById("password").value.trim();
        var role = document.getElementById("role").value;
        var gender = document.getElementById("gender").value;
        
        var phone = document.getElementById("phone").value.trim();
        var address = document.getElementById("address").value.trim();

        // Regular expression for basic email validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate each field and display alert if there are errors
        if (name === "") {
            alert("Name is required.");
            return false;
        }

        if (email === "") {
            alert("Email is required.");
            return false;
        } else if (!emailPattern.test(email)) {
            alert("Invalid email format.");
            return false;
        }

        if (password === "") {
            alert("Password is required.");
            return false;
        } else if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        if (role === "") {
            alert("Role is required.");
            return false;
        }

        if (gender === "") {
            alert("Gender is required.");
            return false;
        }


        if (phone === "") {
            alert("Phone number is required.");
            return false;
        }

        if (address === "") {
            alert("Address is required.");
            return false;
        }

        // If no errors, allow form submission
        return true;
    }
</script>

</body>
</html>
