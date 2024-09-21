<?php
session_start(); // Start the session
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from POST
    $user_id = $mysqli->real_escape_string($_POST['user_id']);

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id='$user_id'";

    if ($mysqli->query($sql) === TRUE) {
        // Set success message
        $_SESSION['success_message'] = "User deleted successfully!";
        // Redirect to users_dashboard.php
        header("Location: users_dashboard.php");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}
?>
