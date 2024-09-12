<?php
session_start(); // Start the session
include('db_connection.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'User deleted successfully!';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['message'] = 'No user ID provided.';
}

$conn->close();

// Redirect back to the dashboard
header('Location: login_dashboard.php');
exit();
?>
