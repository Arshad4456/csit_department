<?php
session_start(); // Start the session
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $userType = $_POST['user_type'];
    $password = $_POST['password'];

    // Start building the SQL query
    $sql = "UPDATE users SET username = ?, user_type = ?";
    $params = [$username, $userType];

    // If a new password is provided, hash it and add it to the query
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password_hash = ?";
        $params[] = $hashedPassword;
    }

    $sql .= " WHERE id = ?";
    $params[] = $userId;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'User updated successfully!';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header('Location: login_dashboard.php'); // Redirect to the dashboard
exit();
?>
