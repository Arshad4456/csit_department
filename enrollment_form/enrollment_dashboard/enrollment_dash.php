<?php
session_start();
include('db_connection.php');

// Handle record status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($status) {
        try {
            // Update status in the database
            $stmt = $pdo->prepare("UPDATE enrollments SET status = :status WHERE id = :id");
            $stmt->execute([':status' => $status, ':id' => $recordId]);

            // Get email of the record owner
            $stmt = $pdo->prepare("SELECT email, name FROM enrollments WHERE id = :id");
            $stmt->execute([':id' => $recordId]);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            // Prepare email content
            $subject = "Enrollment Status Update";
            $message = "<html><body>";
            $message .= "<h1>Your Enrollment Status</h1>";
            $message .= "<p>Dear " . htmlspecialchars($record['name']) . ",</p>";
            $message .= "<p>Your enrollment has been updated to: " . htmlspecialchars($status) . ".</p>";
            $message .= "</body></html>";

            // Send email
            $headers = "From: mdarshadkhan344@gmail.com\r\n";
            $headers .= "Reply-To: mdarshadkhan344@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            mail($record['email'], $subject, $message, $headers);

            $_SESSION['message'] = "Status updated and email sent!";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Status is not set.";
    }

    header('Location: enrollment_dash.php');
    exit;
}

// Handle record deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM enrollments WHERE id = :id");
        $stmt->execute([':id' => $deleteId]);

        $_SESSION['message'] = "Record deleted successfully!";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
    }

    header('Location: enrollment_dash.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .add-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .dashboard-container {
            padding-bottom: 60px;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
            padding-left: 15px;
        }
        .table-container {
            position: relative;
        }
        .alert-message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container mt-5">
        <h2>Enrollment Dashboard</h2>
        
        <?php
        // Display success or error message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info alert-message" role="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Program</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $pdo->query("SELECT * FROM enrollments");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['program']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='view_record.php?id={$row['id']}' class='btn btn-info btn-sm'>View</a>
                                <a href='edit_record.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='enrollment_dash.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                                <form action='enrollment_dash.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='record_id' value='{$row['id']}'>
                                    <select name='status' onchange='this.form.submit()' class='btn btn-secondary btn-sm'>
                                        <option value='Pending' " . ($row['status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                                        <option value='Approved' " . ($row['status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                                        <option value='Rejected' " . ($row['status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                                    </select>
                                    <input type='hidden' name='action' value='update_status'>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Add User Button -->
            <a href="../enrollment.php" class="btn btn-primary add-button">Add User Enrollment</a>
        </div>
    </div>
</body>
</html>
