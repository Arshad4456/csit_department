<?php
include 'db_connection.php'; // Include the database connection file

$successMessage = '';
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
        $daysDifference = $interval->days + 1; // Adding 1 to include the end day

        // Validate the days difference
        if ($daysDifference < 1 || $daysDifference > 15) {
            $successMessage = "Days difference should be between 1 and 15.";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO leave_applications (name, father_name, registration_no, reason, email, leave_type, start_date, end_date, days_difference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssi", $name, $fatherName, $registrationNo, $reason, $email, $leaveType, $startDate, $endDate, $daysDifference);

            if ($stmt->execute()) {
                echo "<script>alert('Application updated successfully.'); window.location.href = 'leave_dashboard/leave_dash.php';</script>";
            } else {
                echo "Error adding record: " . $conn->error;
            }
            $stmt->close();
        }
    } elseif ($leaveType == 'halfDay') {
        $daysDifference = 1;
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO leave_applications (name, father_name, registration_no, reason, email, leave_type, start_date, end_date, days_difference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $name, $fatherName, $registrationNo, $reason, $email, $leaveType, $startDate, $endDate, $daysDifference);

        if ($stmt->execute()) {
            echo "<script>alert('Application updated successfully.'); window.location.href = 'leave.php';</script>";
        } else {
            echo "Error adding record: " . $conn->error;
        }
        $stmt->close();

        
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

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
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"] {
            width: calc(100% - 10px);
            padding: 6px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .radio-group {
            display: flex;
            align-items: center;
        }

        .radio-group label {
            margin-right: 20px;
        }

        button[type="submit"] {
            background-color: #5aad5e;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button[type="submit"]:hover {
            background-color: #0cad12;
        }

        button[type="reset"] {
            background-color: #ab5858;
            color: #fff;
            float: right;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button[type="reset"]:hover {
            background-color: #bc051e;
        }

        .message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>
        <h2>Leave Application Form</h2>
        <form method="POST" action="leave.php" id="leaveForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="fatherName">Father's Name:</label>
                <input type="text" id="fatherName" name="fatherName" required>
            </div>
            <div class="form-group">
                <label for="registrationNo">Registration No:</label>
                <input type="text" id="registrationNo" name="registrationNo" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason:</label>
                <input type="text" id="reason" name="reason" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group radio-group">
                <label>Leave Type:</label>
                <input type="radio" id="halfDay" name="leaveType" value="halfDay">
                <label for="halfDay">Half Day</label>
                <input type="radio" id="fullDay" name="leaveType" value="fullDay" checked>
                <label for="fullDay">Full Day</label>
            </div>
            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate">
            </div>
            <div class="form-group">
                <label for="daysDifference">Days Difference:</label>
                <input type="text" id="daysDifference" name="daysDifference" readonly>
            </div>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>

    <script>
        document.getElementById('leaveForm').addEventListener('change', function() {
            const leaveType = document.querySelector('input[name="leaveType"]:checked').value;
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');
            const daysDifference = document.getElementById('daysDifference');

            if (leaveType === 'halfDay') {
                endDate.value = '';
                endDate.disabled = true;
                daysDifference.value = 1;
            } else {
                endDate.disabled = false;
                if (startDate.value && endDate.value) {
                    const start = new Date(startDate.value);
                    const end = new Date(endDate.value);
                    const differenceInTime = end.getTime() - start.getTime();
                    const differenceInDays = Math.ceil(differenceInTime / (1000 * 3600 * 24)) + 1; // Adding 1 to include the end day

                    if (differenceInDays < 1 || differenceInDays > 15) {
                        daysDifference.value = 'Days difference should be between 1 and 15.';
                    } else {
                        daysDifference.value = differenceInDays;
                    }
                } else {
                    daysDifference.value = '';
                }
            }
        });
    </script>
</body>
</html>
