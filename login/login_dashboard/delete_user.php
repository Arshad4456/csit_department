<?php
include 'db_connection.php';

$id = $_POST['id'];
$query = "DELETE FROM users WHERE id = $id";
mysqli_query($conn, $query);

// Redirect to the dashboard with success message
header("Location: users_dashboard.php?status=success");
echo 'User deleted successfully.';
?>
