<?php
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password is empty
$dbname = "csit_enrollment_system"; // Database name

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Uncomment the line below to confirm the connection is successful
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
    exit; // Ensure the script stops if connection fails
}
?>
