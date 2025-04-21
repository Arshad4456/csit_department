<?php
include '../db_connection.php';

if (isset($_POST['user_id'], $_POST['user_type'])) {
    $id = intval($_POST['user_id']);
    $type = $_POST['user_type'];

    $table = match ($type) {
        'admin' => 'admins',
        'monitor' => 'monitors',
        'faculty' => 'faculty',
        'student' => 'students',
        default => exit('Invalid user type'),
    };

    $sql = "DELETE FROM $table WHERE id = $id";
    echo $mysqli->query($sql) ? "User deleted successfully." : "Failed to delete user.";
}
?>
