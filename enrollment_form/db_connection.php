<?php
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password is empty
$dbname = "csit_enrollment_system"; // Database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
