<?php
// Include database connection
include 'connection.php'; // Ensure this file connects to your database

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Validate data
if (empty($name) || empty($email) || empty($message)) {
    echo "All fields are required.";
    exit();
}

// Sanitize data
$name = htmlspecialchars($name);
$email = htmlspecialchars($email);
$message = htmlspecialchars($message);

// Prepare SQL statement to insert data into the database
$sql = "INSERT INTO contact_form_submissions (name, email, message) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

// Execute SQL statement
if ($stmt->execute()) {
    // Email configuration
    $to = "info@nyaduododispensary.com";
    $subject = "Contact Form Submission from $name";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Email content
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message";

    // Send email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "Sorry, there was a problem sending your message. Please try again later.";
    }
} else {
    echo "Sorry, there was a problem saving your message. Please try again later.";
}

// Close statement and connection
$stmt->close();
$con->close();
?>
