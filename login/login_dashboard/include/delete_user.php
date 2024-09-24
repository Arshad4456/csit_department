<?php
include 'db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];

    // For students
    if ($user_type == 'student') {
        $query = "DELETE FROM students WHERE id='$user_id'";
    }
    // For admins, monitors, faculties
    else {
        if ($user_type == 'admin') {
            $query = "DELETE FROM admins WHERE id='$user_id'";
        } elseif ($user_type == 'monitor') {
            $query = "DELETE FROM monitors WHERE id='$user_id'";
        } elseif ($user_type == 'faculty') {
            $query = "DELETE FROM faculties WHERE id='$user_id'";
        }
    }

    if ($mysqli->query($query)) {
        header("Location: users_dashboard.php?success=1");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>
