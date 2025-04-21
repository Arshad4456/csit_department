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

    $fields = [];
    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['user_id', 'user_type'])) {
            $value = $mysqli->real_escape_string($value);
            $fields[] = "$key = '$value'";
        }
    }

    $sql = "UPDATE $table SET " . implode(", ", $fields) . " WHERE id = $id";
    if ($mysqli->query($sql)) {
        echo "<script>alert('User updated successfully.'); window.history.back();</script>";
    } else {
        echo "Error updating user: " . $mysqli->error;
    }
}
?>
