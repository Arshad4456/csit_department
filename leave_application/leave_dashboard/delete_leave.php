<?php
include 'db_connection.php';

$id = $_GET['id'] ?? '';
$id = intval($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        $sql = "DELETE FROM leave_applications WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Application deleted successfully.'); window.location.href = 'leave_dash.php';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Deletion canceled.'); window.location.href = 'leave_dash.php';</script>";
    }
    $conn->close();
} else {
    // Fetch details of the leave application to show in confirmation message
    $sql = "SELECT * FROM leave_applications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Leave Application</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        button {
            background-color: #d9534f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 10px;
        }

        button:hover {
            background-color: #c9302c;
        }

        .button-group a {
            background-color: #5bc0de;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .button-group a:hover {
            background-color: #31b0d5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Leave Application</h2>
        <p>Are you sure you want to delete the leave application with ID: <?php echo htmlspecialchars($id); ?>?</p>
        <form method="post" action="delete_leave.php?id=<?php echo $id; ?>">
            <button type="submit" name="confirm" value="yes">Yes, Delete</button>
            <a href="leave_dash.php">Cancel</a>
        </form>
    </div>
</body>
</html>
