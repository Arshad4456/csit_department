<?php
include 'db_connection.php';

// Retrieve and sanitize form data
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Validation (you can add more checks as needed)
if (empty($full_name) || empty($email) || empty($message)) {
    echo "All fields are required.";
    exit;
}

// Email configuration
$to = "rawikhan057@gmail.com"; // Replace with your email address
$subject = "Contact Form Submission";
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Email body
$email_body = "<h2>Contact Form Submission</h2>";
$email_body .= "<p><strong>Name:</strong> $full_name</p>";
$email_body .= "<p><strong>Email:</strong> $email</p>";
$email_body .= "<p><strong>Message:</strong></p>";
$email_body .= "<p>$message</p>";

// Send email
if (mail($to, $subject, $email_body, $headers)) {
    echo "Your message has been sent successfully.";
} else {
    echo "Failed to send your message. Please try again later.";
}

// Close the database connection
mysqli_close($conn);
?>
