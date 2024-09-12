<?php
session_start(); // Start the session

include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash, user_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $userType);

    if ($stmt->execute()) {
        // Set success message in session and redirect to dashboard
        $_SESSION['message'] = 'User added successfully!';
        header('Location: login_dashboard.php'); // Redirect to the dashboard
        exit();
    } else {
        // Set error message in session
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        header('Location: login_dashboard.php'); // Redirect to the dashboard
        exit();
    }
    $stmt->close();
}

$conn->close();
?>
