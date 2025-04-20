<?php
include 'db_connection.php';

if (isset($_POST['user_type'])) {
    $user_type = $_POST['user_type'];

    $table = match ($user_type) {
        'admin' => 'admins',
        'monitor' => 'monitors',
        'faculty' => 'faculty',
        'student' => 'students',
        default => ''
    };

    if ($table === '') exit;

    $query = "SELECT * FROM $table";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <button class='btn btn-sm btn-primary' onclick=\"viewUser({$row['id']}, '{$user_type}')\">View</button>
            </td>
        </tr>";
    }
}
?>
