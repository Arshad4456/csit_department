<?php
// Database connection settings
$host = 'localhost';  // Hostname
$username = 'root';    // MySQL username
$password = '';        // MySQL password (empty in this case)
$database = 'csit_login_db';  // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Uncomment to confirm connection (for debugging purposes)
// echo "Connected successfully";

// You can now use $conn to interact with the database
?>
