<?php
session_start(); // Start the session
include('db_connection.php');

// Check if ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = 'Invalid record ID.';
    header('Location: enrollment_dash.php');
    exit;
}

$id = intval($_GET['id']);

// Fetch the record details
$stmt = $pdo->prepare("SELECT * FROM enrollments WHERE id = :id");
$stmt->execute([':id' => $id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    $_SESSION['message'] = 'Record not found.';
    header('Location: enrollment_dash.php');
    exit;
}

// Fetch the courses the user is enrolled in
$coursesStmt = $pdo->prepare("SELECT course_no, course_title, grade FROM course_details WHERE enrollment_id = :id");
$coursesStmt->execute([':id' => $id]);
$courses = $coursesStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .record-details {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .back-button,
        .print-button {
            margin-top: 20px;
        }
        .courses-table th, .courses-table td {
            text-align: center;
        }
        @media print {
            .print-button,
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
    <script>
        function printForm() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container record-details">
        <h2 style="text-align: center;">Enrollment Form Record</h2>
        <dl class="row">
            <dt class="col-sm-3">Name:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['name']); ?></dd>

            <dt class="col-sm-3">Father's Name:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['father_name']); ?></dd>

            <dt class="col-sm-3">Registration No:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['registration_no']); ?></dd>

            <dt class="col-sm-3">Phone No:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['phone_no']); ?></dd>

            <dt class="col-sm-3">Email:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['email']); ?></dd>

            <dt class="col-sm-3">Program:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['program']); ?></dd>

            <dt class="col-sm-3">Semester:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['semester']); ?></dd>

            <dt class="col-sm-3">Semester Type:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['semester_type']); ?></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><?php echo htmlspecialchars($record['status']); ?></dd>
        </dl>

        <h3>Enrolled Courses</h3>
        <table class="table table-bordered courses-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Course No</th>
                    <th>Course Title</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($courses) {
                    $sno = 1;
                    foreach ($courses as $course) {
                        echo "<tr>
                            <td>{$sno}</td>
                            <td>" . htmlspecialchars($course['course_no']) . "</td>
                            <td>" . htmlspecialchars($course['course_title']) . "</td>
                            <td>" . htmlspecialchars($course['grade']) . "</td>
                        </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No courses enrolled.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="enrollment_looking.php" class="btn btn-secondary back-button">Back to Dashboard</a>
        <button onclick="printForm()" class="btn btn-primary print-button">Print Form</button>
    </div>
</body>
</html>
