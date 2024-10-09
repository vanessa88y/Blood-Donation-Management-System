<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <link rel="stylesheet" href=""> 
    <style>
    /* navbar.css */
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

/* Container styles */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: beige;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Form styles */
form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
}

input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Header styles */
h1 {
    text-align: center;
    color: #333;
}

        </style>
<body>
    <?php include 'navbar.php'; ?> <!-- Include the navigation bar -->
    
    <div class="container">
        <h1>Request Blood</h1>
        <form action="request_process.php" method="post">
            <label for="blood_group">Blood Group:</label>
            <select id="blood_group" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select><br>

            <label for="units">Number of Units:</label>
            <input type="number" id="units" name="units" min="1" required><br>

            <input type="submit" value="Submit Request">
        </form>
    </div>
</body>
</html>
