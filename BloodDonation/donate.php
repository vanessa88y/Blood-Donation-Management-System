<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: beige;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        select,
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            height: 40px;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        input[type="submit"]:focus {
            outline: none;
        }
        .error {
            color: red;
        }
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
    </style>
</head>
<body>
    <h1>Blood Donation Form</h1>
    <form action="donate_process.php" method="post">
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

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" min="1" required><br>

        <label for="weight">Weight (in kg):</label>
        <input type="number" id="weight" name="weight" min="1" required><br>

        <label for="units">Number of Units:</label>
        <input type="number" id="units" name="units" min="1" required><br>

        <label for="diseases">Disease if any:</label><br>
        <textarea id="diseases" name="diseases" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
