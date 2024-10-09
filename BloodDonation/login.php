<?php
include 'index_navbar.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* login.css */
        
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav {
            background-color: brown;
            padding: 5px 0;
        }

        .nav ul li {
            float: right;
        }

        .nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 10px 10px;
            text-decoration: none;
            font-size: 16px;
        }

        .nav ul li a:hover {
            background-color: white;
            color: black;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: brown;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        section {
            text-align: center;
            margin-top: 20px;
        }

        section a {
            color: #007bff;
            text-decoration: none;
        }

        section a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <form action="authentication.php" onsubmit="return validation(event)" method="post">
        <label for="login_email">Email:</label>
        <input type="text" id="login_email" name="login_email" value="<?php echo isset($_SESSION['login_email']) ? htmlspecialchars($_SESSION['login_email']) : ''; ?>"><br>
        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="login_password"><br>
        <input type="submit" value="Login">
    </form>
    <section>
        Not a member? <a href="register.php">Register here</a>
    </section>
    <?php
    // Display error messages
    if (isset($_SESSION['login_error'])) {
        echo "<p class='error'>" . $_SESSION['login_error'] . "</p>";
        unset($_SESSION['login_error']); // Clear the error message after displaying
    }

    // Retain email value for re-entering
    if (isset($_POST['login_email'])) {
        $_SESSION['login_email'] = $_POST['login_email'];
    }
    ?>
    <script>
        function validation(event) {
            var email = document.getElementById("login_email").value.trim();
            var password = document.getElementById("login_password").value.trim();
            
            // Regular expression for basic email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email === "" && password === "") {
                alert("Email and Password fields are empty");
                event.preventDefault(); // Prevent form submission
                return false;
            } else {
                if (email === "") {
                    alert("Email field is empty");
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
                if (!emailPattern.test(email)) {
                    alert("Invalid email format");
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
                if (password === "") {
                    alert("Password field is empty");
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
                if (password.length < 6) {
                    alert("Password must be at least 6 characters long");
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
            }

            // If all validations pass, allow form submission
            return true;
        }
    </script>
</body>
</html>
