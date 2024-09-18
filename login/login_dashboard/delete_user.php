<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: users_dashboard.php?message=UserDeleted");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
