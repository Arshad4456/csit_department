<?php
include 'db_connection.php';

if (isset($_POST['user_type'])) {
    $user_type = $_POST['user_type'];
    $table = "";

    switch ($user_type) {
        case 'admin': $table = 'admins'; break;
        case 'monitor': $table = 'monitors'; break;
        case 'faculty': $table = 'faculty'; break;
        case 'student': $table = 'students'; break;
        default: exit;
    }

    $query = "SELECT * FROM $table";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <button class='btn btn-primary btn-sm' onclick=\"viewUser({$row['id']}, '{$user_type}')\">View</button>
            </td>
        </tr>";
    }
}
?>
