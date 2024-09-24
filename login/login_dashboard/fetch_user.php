<?php
include 'db_connection.php'; // Include your DB connection

if (isset($_POST['user_type'])) {
    $user_type = $_POST['user_type'];

    if ($user_type == 'admin') {
        $query = "SELECT id, name, email FROM admins";
    } elseif ($user_type == 'monitor') {
        $query = "SELECT id, name, email FROM monitors";
    } elseif ($user_type == 'faculty') {
        $query = "SELECT id, name, email FROM faculty";
    } elseif ($user_type == 'student') {
        $query = "SELECT id, name, email FROM students";
    }

    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>";
            echo "<button class='btn btn-info' data-toggle='modal' data-target='#viewUserModal' onclick='viewUser(" . $row['id'] . ", \"$user_type\")'>View</button> ";
            echo "<button class='btn btn-warning' data-toggle='modal' data-target='#editUserModal' onclick='editUser(" . $row['id'] . ", \"$user_type\")'>Edit</button> ";
            echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteUserModal' onclick='deleteUser(" . $row['id'] . ", \"$user_type\")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No users found</td></tr>";
    }
}
?>
