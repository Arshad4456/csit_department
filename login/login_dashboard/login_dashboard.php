<?php
session_start(); // Start the session
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .add-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px 20px; /* Smaller button size */
            font-size: 16px; /* Adjust font size */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Optional shadow */
        }
        .dashboard-container {
            padding-bottom: 60px; /* To ensure content is not hidden behind the button */
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
        <h2>User Dashboard</h2>
        
        <?php
        // Display success or error message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-info alert-message" role="alert">' . $_SESSION['message'] . '</div>';
            // Clear the message after displaying
            unset($_SESSION['message']);
        }
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM users");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['user_type']}</td>
                            <td>
                                <a href='edit_user.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_user.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Add User Button -->
            <a href="add_user.php" class="btn btn-primary add-button">Add User</a>
        </div>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>
