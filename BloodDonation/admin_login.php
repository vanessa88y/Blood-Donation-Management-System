<?php
include 'admin_authentication.php';
include 'index_navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

.nav ul li a.active {
    background-color: #4CAF50; /* Background color for active link */
    color: white; /* Text color for active link */
    font-weight: bold; /* Bold text for active link */
}
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 50px;
    color: #333;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: beige;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
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
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 50px;
    color: #333;
}

nav {
    background-color: brown;
    color: black;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

nav ul li {
    float: left;
}

nav ul li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav ul li a:hover {
    background-color: #555;
}

    </style>
</head>
<body>
<h1>Admin Login</h1>
<form action="admin_authentication.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Login">
    </form>
    <!-- Add admin dashboard content here -->
</body>
</html>