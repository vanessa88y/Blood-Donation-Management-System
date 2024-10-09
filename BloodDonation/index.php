<?php
include 'index_navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
/* Reset default list and link styling */
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

        
        /* Style for the About Us section */
 #about {
    background-color: beige; 
    padding: 50px 20px;
    background-image: url('images/pic4.jpeg');
    background-size: contain;
    background-position: center center; /* Center the image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    opacity: 0.8; /* Set the opacity for the whole section */
    position: relative; /* Ensure that positioning works correctly with child elements */
    z-index: 1; /* Keep it below any other positioned elements */
}

#about h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

#about p {
    color: black;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}

#about p:first-of-type {
    margin-top: 0;
}

#about h2 + p {
    margin-top: 30px;
}

#contact {
    background-color: #f9f9f9;
    padding: 50px 20px;
}

#contact h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

#contact p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.contact-info {
    margin-bottom: 20px;
}

.contact-info p {
    margin-bottom: 10px;
}

form {
    max-width: 500px;
    margin: 0 auto;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="email"],
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}


    </style>
</head>
<body>
    
    <header>
        <!--Logo -->
        <div class="logo">Nyaduodo Dispensary    
        </div>
      



    </header>

    <!--Section for choosing activiy-->
<section>
    
</section>
<section id="about">
    <h2> About Us</h2>
    <p>Welcome to Nyaduodo Dispensary...</p>
    
    <p>The Nyaduodo Dispensary Blood Donation Management System is an innovative platform designed to streamline and enhance the blood donation process at Nyaduodo Dispensary. It serves as a centralized system for managing blood donation requests, donor information, and blood inventory, ensuring efficient and timely access to blood products for patients in need.</p>

    <h2>Mission:</h2>
    <p>Our mission is to improve healthcare outcomes by facilitating the seamless exchange of blood donations between donors and recipients. We aim to promote a culture of voluntary blood donation while ensuring the safety, quality, and accessibility of blood products for patients requiring transfusions.</p>
  


</section>
<section id="contact">
    <h2>Contact Us</h2>
    <p>Have questions or concerns? Feel free to reach out to us using the information below:</p>
    <div class="contact-info">
        <p><strong>Email:</strong> info@nyaduododispensary.com</p>
        <p><strong>Phone:</strong> +254 745 567 890</p>
        <p><strong>Address:</strong> Nyaduodo Dispensary, Nairobi, Kenya</p>
    </div>
   
</section>


<footer>
       
         <div class="footer-bottom">
            <p>copyright & copy;2024  designed by <span>V</span> </p>
         </div>
      </footer>
    
    
</body>
</html>