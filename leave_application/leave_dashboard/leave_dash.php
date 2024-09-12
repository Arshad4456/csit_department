<?php
include 'db_connection.php';

$sql = "SELECT id, name, leave_type, status FROM leave_applications";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .action-buttons a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #007bff;
            font-size: 14px;
            display: inline-block;
        }

        .action-buttons a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .status-select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin: 0;
        }

        .status-select:focus {
            border-color: #007bff;
            outline: none;
        }

        .container {
    position: relative;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.add-application-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
}

.add-application-button:hover {
    background-color: #0056b3;
}


        .status-cell {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Leave Applications Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Leave Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['leave_type']); ?></td>
                            <td class="status-cell">
                                <select class="status-select" onchange="updateStatus(<?php echo $row['id']; ?>, this.value)">
                                    <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="approved" <?php echo $row['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                                    <option value="rejected" <?php echo $row['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                            </td>
                            <td class="action-buttons">
                                <a href="view_leave.php?id=<?php echo $row['id']; ?>">View</a>
                                <a href="edit_leave.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_leave.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="../leave.php" class="add-application-button">Add Leave Application</a>
    
    <script>
        function updateStatus(id, status) {
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&status=${status}`
            })
            .then(response => response.text())
            .then(result => {
                if (result === 'success') {
                    alert('Status updated successfully.');
                } else {
                    alert('Error updating status.');
                }
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
