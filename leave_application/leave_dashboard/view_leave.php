<?php
include 'db_connection.php';

$id = $_GET['id'] ?? '';
$id = intval($id); // Ensure the ID is an integer

if ($id <= 0) {
    echo "<p>Invalid ID provided.</p>";
    exit;
}

$sql = "SELECT * FROM leave_applications WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>No leave application found with the provided ID.</p>";
    $stmt->close();
    $conn->close();
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Leave Application</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group p {
            margin: 5px 0;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
        }

        .button-group a,
        .button-group button {
            background-color: #5aad5e;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .button-group a:hover,
        .button-group button:hover {
            background-color: #0cad12;
        }

        .button-group button {
            background-color: #007bff;
        }

        .button-group button:hover {
            background-color: #0056b3;
        }

        .button-group a {
            background-color: #ab5858;
        }

        .button-group a:hover {
            background-color: #bc051e;
        }

        /* Print-specific styles */
        @media print {
            .button-group {
                display: none;
            }

            .form-group p {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Leave Application</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <p><?php echo htmlspecialchars($row['name']); ?></p>
        </div>
        <div class="form-group">
            <label for="fatherName">Father's Name:</label>
            <p><?php echo htmlspecialchars($row['father_name']); ?></p>
        </div>
        <div class="form-group">
            <label for="registrationNo">Registration No:</label>
            <p><?php echo htmlspecialchars($row['registration_no']); ?></p>
        </div>
        <div class="form-group">
            <label for="reason">Reason:</label>
            <p><?php echo htmlspecialchars($row['reason']); ?></p>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <p><?php echo htmlspecialchars($row['email']); ?></p>
        </div>
        <div class="form-group">
            <label for="leaveType">Leave Type:</label>
            <p><?php echo htmlspecialchars($row['leave_type']); ?></p>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <p><?php echo htmlspecialchars($row['start_date']); ?></p>
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <p><?php echo htmlspecialchars($row['end_date']); ?></p>
        </div>
        <div class="form-group">
            <label for="daysDifference">Days Difference:</label>
            <p><?php echo htmlspecialchars($row['days_difference']); ?></p>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <p><?php echo htmlspecialchars($row['status']); ?></p>
        </div>
        <div class="button-group">
            <a href="leave_dash.php">Back to Dashboard</a>
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
