<?php
include 'db_connection.php'; // Include DB connection

if (isset($_POST['user_id']) && isset($_POST['user_type'])) {
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];

    if ($user_type == 'admin') {
        $query = "SELECT * FROM admins WHERE id = $user_id";
    } elseif ($user_type == 'monitor') {
        $query = "SELECT * FROM monitors WHERE id = $user_id";
    } elseif ($user_type == 'faculty') {
        $query = "SELECT * FROM faculty WHERE id = $user_id";
    } elseif ($user_type == 'student') {
        $query = "SELECT * FROM students WHERE id = $user_id";
    }

    $result = $mysqli->query($query);
    $user = $result->fetch_assoc();

    // Display user information in the modal
    echo "<p><strong>Name:</strong> " . $user['name'] . "</p>";
    echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
    echo "<p><strong>Contact No:</strong> " . $user['contact_no'] . "</p>";
    // Add more fields based on user type if needed
}
?>
