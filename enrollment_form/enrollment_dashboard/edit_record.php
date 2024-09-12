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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $fatherName = $_POST['fatherName'];
    $registrationNo = $_POST['registrationNo'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $semesterType = $_POST['semesterType'];
    $status = $_POST['status'];
    $courses = $_POST['courses']; // Array of courses data

    try {
        // Start transaction
        $pdo->beginTransaction();

        // Update the record in the enrollments table
        $stmt = $pdo->prepare("
            UPDATE enrollments
            SET name = :name,
                father_name = :fatherName,
                registration_no = :registrationNo,
                phone_no = :phoneNo,
                email = :email,
                program = :program,
                semester = :semester,
                semester_type = :semesterType,
                status = :status
            WHERE id = :id
        ");
        $stmt->execute([
            ':name' => $name,
            ':fatherName' => $fatherName,
            ':registrationNo' => $registrationNo,
            ':phoneNo' => $phoneNo,
            ':email' => $email,
            ':program' => $program,
            ':semester' => $semester,
            ':semesterType' => $semesterType,
            ':status' => $status,
            ':id' => $id
        ]);

        // Delete old courses
        $stmt = $pdo->prepare("DELETE FROM course_details WHERE enrollment_id = :id");
        $stmt->execute([':id' => $id]);

        // Insert new courses
        foreach ($courses as $index => $course) {
            if (!empty($course['course_no']) && !empty($course['course_title']) && !empty($course['grade'])) {
                $stmt = $pdo->prepare("
                    INSERT INTO course_details (enrollment_id, course_no, course_title, grade)
                    VALUES (:id, :courseNo, :courseTitle, :grade)
                ");
                $stmt->execute([
                    ':id' => $id,
                    ':courseNo' => $course['course_no'],
                    ':courseTitle' => $course['course_title'],
                    ':grade' => $course['grade']
                ]);
            }
        }

        // Commit transaction
        $pdo->commit();

        $_SESSION['message'] = 'Record updated successfully.';
        header('Location: enrollment_dash.php');
        exit;
    } catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        $_SESSION['message'] = 'Error: ' . $e->getMessage();
        header('Location: enrollment_dash.php');
        exit;
    }
}

// Fetch the record details for editing
$stmt = $pdo->prepare("SELECT * FROM enrollments WHERE id = :id");
$stmt->execute([':id' => $id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    $_SESSION['message'] = 'Record not found.';
    header('Location: enrollment_dash.php');
    exit;
}

// Fetch course details for this record
$stmt = $pdo->prepare("SELECT * FROM course_details WHERE enrollment_id = :id");
$stmt->execute([':id' => $id]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .edit-form {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            margin-top: 20px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container edit-form">
        <h2>Edit Enrollment Record</h2>
        <form method="post">
            <!-- Other fields here -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fatherName">Father's Name:</label>
                <input type="text" class="form-control" id="fatherName" name="fatherName" value="<?php echo htmlspecialchars($record['father_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="registrationNo">Registration No:</label>
                <input type="text" class="form-control" id="registrationNo" name="registrationNo" value="<?php echo htmlspecialchars($record['registration_no']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phoneNo">Phone No:</label>
                <input type="text" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo htmlspecialchars($record['phone_no']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($record['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="program">Program:</label>
                <input type="text" class="form-control" id="program" name="program" value="<?php echo htmlspecialchars($record['program']); ?>" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select class="form-control" id="semester" name="semester" required>
                    <option value="">Select Semester</option>
                    <option value="1" <?php echo ($record['semester'] == '1') ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo ($record['semester'] == '2') ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo ($record['semester'] == '3') ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo ($record['semester'] == '4') ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?php echo ($record['semester'] == '5') ? 'selected' : ''; ?>>5</option>
                    <option value="6" <?php echo ($record['semester'] == '6') ? 'selected' : ''; ?>>6</option>
                    <option value="7" <?php echo ($record['semester'] == '7') ? 'selected' : ''; ?>>7</option>
                    <option value="8" <?php echo ($record['semester'] == '8') ? 'selected' : ''; ?>>8</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="semesterType">Semester Type:</label>
                <select class="form-control" id="semesterType" name="semesterType" required>
                    <option value="">Select Semester Type</option>
                    <option value="Running" <?php echo ($record['semester_type'] == 'Running') ? 'selected' : ''; ?>>Running</option>
                    <option value="Summer" <?php echo ($record['semester_type'] == 'Summer') ? 'selected' : ''; ?>>Summer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending" <?php echo ($record['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Approved" <?php echo ($record['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                    <option value="Rejected" <?php echo ($record['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>

            <h3>Course Details</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course No</th>
                        <th>Course Title</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="courseTable">
                    <?php foreach ($courses as $index => $course): ?>
                    <tr>
                        <td><input type="text" class="form-control" name="courses[<?php echo $index; ?>][course_no]" value="<?php echo htmlspecialchars($course['course_no']); ?>" required></td>
                        <td><input type="text" class="form-control" name="courses[<?php echo $index; ?>][course_title]" value="<?php echo htmlspecialchars($course['course_title']); ?>" required></td>
                        <td><input type="text" class="form-control" name="courses[<?php echo $index; ?>][grade]" value="<?php echo htmlspecialchars($course['grade']); ?>" required></td>
                        <td><button type="button" class="btn btn-danger" onclick="removeCourseRow(this)">Delete</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="enrollment_dash.php" class="btn btn-secondary back-button">Cancel</a>
        </form>
    </div>

    <script>
        function removeCourseRow(button) {
            var row = button.closest('tr');
            row.remove();
        }
    </script>
</body>
</html>
