<?php
// Start session and include the database connection file
session_start();

// Include both database connections
include '../db_connection.php'; // This connects to leave_management
include 'csit_login_db_connection.php'; // New connection to csit_login_db

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit;
}

// Get the logged-in username from the session
$username = $_SESSION['username'];

// Fetch leave records from leave_management using username
$query = "SELECT * FROM leave_applications WHERE registration_no = ? AND status != 'rejected' ORDER BY start_date DESC LIMIT 12";
$stmt_leave = $conn->prepare($query);
$stmt_leave->bind_param("s", $username);
$stmt_leave->execute();
$leave_result = $stmt_leave->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Records</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <style>
        
        /* Style for the leave records table */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

.print-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin: 20px;
    text-decoration: none;
}

.print-btn:hover {
    background-color: #45a049;
}

@media print {
            .print-btn,
            .back-button {
                display: none;
            }
            .record-details {
                box-shadow: none;
                padding: 0;
                margin: 0;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Leave Records for the Last 12 Months</h1>

    <?php if ($leave_result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>Reason</th>
                    <th>Days</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $leave_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['start_date']); ?></td>
                        <td><?= htmlspecialchars($row['reason']); ?></td>
                        <td><?= htmlspecialchars($row['days_difference']); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No leave records found for the last 12 months.</p>
    <?php endif; ?>

    <!-- Print Button -->
    <button class="print-btn" onclick="window.print()">Print Records</button>

    <!-- Back Button -->
    <a href="../faculty_dashboard.php" class="print-btn">Back to Leave Dashboard</a>
</div>

<script src="../assets/bootstrap.bundle.min.js"></script>

</body>
</html>
