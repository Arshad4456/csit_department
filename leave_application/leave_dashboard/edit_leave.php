<?php
include 'db_connection.php';

$id = $_GET['id'] ?? '';
$id = intval($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $fatherName = $_POST['fatherName'] ?? '';
    $registrationNo = $_POST['registrationNo'] ?? '';
    $reason = $_POST['reason'] ?? '';
    $email = $_POST['email'] ?? '';
    $leaveType = $_POST['leaveType'] ?? '';
    $startDate = $_POST['startDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';

    $daysDifference = '';
    if ($leaveType == 'fullDay' && !empty($startDate) && !empty($endDate)) {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = $start->diff($end);
        $differenceInDays = $interval->days + 1; // Include the end date
        if ($differenceInDays < 1 || $differenceInDays > 15) {
            $daysDifference = 'Days difference should be between 1 and 15.';
        } else {
            $daysDifference = $differenceInDays;
        }
    } elseif ($leaveType == 'halfDay') {
        $daysDifference = 1;
    }

    $status = $_POST['status'] ?? 'pending';

    $sql = "UPDATE leave_applications SET name = ?, father_name = ?, registration_no = ?, reason = ?, email = ?, leave_type = ?, start_date = ?, end_date = ?, days_difference = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $name, $fatherName, $registrationNo, $reason, $email, $leaveType, $startDate, $endDate, $daysDifference, $status, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Application updated successfully.'); window.location.href = 'leave_dash.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
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
    <title>Edit Leave Application</title>
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

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[readonly] {
            background-color: #f9f9f9;
        }

        button {
            background-color: #5aad5e;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0cad12;
        }

        .button-group a {
            background-color: #ab5858;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .button-group a:hover {
            background-color: #bc051e;
        }

        @media print {
            .container {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .button-group {
                display: none;
            }

            .form-group input,
            .form-group select {
                border: none;
                background-color: transparent;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Leave Application</h2>
        <form method="post" action="edit_leave.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fatherName">Father's Name:</label>
                <input type="text" id="fatherName" name="fatherName" value="<?php echo htmlspecialchars($row['father_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="registrationNo">Registration No:</label>
                <input type="text" id="registrationNo" name="registrationNo" value="<?php echo htmlspecialchars($row['registration_no']); ?>" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason:</label>
                <input type="text" id="reason" name="reason" value="<?php echo htmlspecialchars($row['reason']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="leaveType">Leave Type:</label>
                <select id="leaveType" name="leaveType" onchange="handleLeaveTypeChange()" required>
                    <option value="fullDay" <?php echo $row['leave_type'] == 'fullDay' ? 'selected' : ''; ?>>Full Day</option>
                    <option value="halfDay" <?php echo $row['leave_type'] == 'halfDay' ? 'selected' : ''; ?>>Half Day</option>
                </select>
            </div>
            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" value="<?php echo htmlspecialchars($row['start_date']); ?>">
            </div>
            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" value="<?php echo htmlspecialchars($row['end_date']); ?>">
            </div>
            <div class="form-group">
                <label for="daysDifference">Days Difference:</label>
                <input type="text" id="daysDifference" name="daysDifference" value="<?php echo htmlspecialchars($row['days_difference']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="approved" <?php echo $row['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="rejected" <?php echo $row['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Update</button>
                <a href="leave_dash.php">Back to Dashboard</a>
            </div>
        </form>
    </div>

    <script>
        function handleLeaveTypeChange() {
            const leaveType = document.getElementById('leaveType').value;
            const endDateField = document.getElementById('endDate');
            const daysDifferenceField = document.getElementById('daysDifference');

            if (leaveType === 'halfDay') {
                endDateField.value = '';
                endDateField.disabled = true;
                daysDifferenceField.value = '1';
            } else {
                endDateField.disabled = false;
                daysDifferenceField.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            handleLeaveTypeChange();
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
