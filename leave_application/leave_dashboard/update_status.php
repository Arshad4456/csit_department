<?php
include 'db_connection.php';

$id = $_POST['id'] ?? '';
$status = $_POST['status'] ?? '';

$id = intval($id);

if (!empty($id) && !empty($status)) {
    $sql = "UPDATE leave_applications SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
} else {
    echo 'error';
}

$conn->close();
?>
