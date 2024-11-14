<?php
session_start();
include('db_connection.php');




// Handle record deletion

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
                            
                                <form action='enrollment_dash.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='record_id' value='{$row['id']}'>
                                    <select name='status' onchange='this.form.submit()' class='btn btn-secondary btn-sm'>
                                        
                                    </select>
                                    <input type='hidden' name='action' value='update_status'>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
           
        </div>
    </div>
</body>
</html>
