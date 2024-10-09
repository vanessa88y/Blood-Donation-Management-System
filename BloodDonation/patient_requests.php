<?php

include 'patientnavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Requests</title>
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
float:right;
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
/* CSS for Blood Request Form */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    max-width: 500px;
    margin: 0 auto;
    background-color:beige;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="tel"],
select,
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="number"] {
    width: calc(100% - 18px);
}

textarea {
    height: 100px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

input:invalid {
    border-color: #ff7b7b;
}

input:invalid:focus {
    background-color: #ffefef;
}

.error-message {
    color: #ff0000;
    font-size: 14px;
}


</style>
</head>
<body>
    <h1>Blood Request Form</h1>
    <form action="patient_requestprocess.php" method="post">
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
</body>
</html>
