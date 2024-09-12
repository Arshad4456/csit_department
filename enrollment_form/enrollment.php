<?php
// Include the database connection
include 'db_connection.php';

// Handle form submission
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

    // Insert into enrollments table
    try {
        $pdo->beginTransaction();

        // Insert into enrollments table
        $stmt = $pdo->prepare("
            INSERT INTO enrollments (name, father_name, registration_no, phone_no, email, program, semester, semester_type)
            VALUES (:name, :fatherName, :registrationNo, :phoneNo, :email, :program, :semester, :semesterType)
        ");
        $stmt->execute([
            ':name' => $name,
            ':fatherName' => $fatherName,
            ':registrationNo' => $registrationNo,
            ':phoneNo' => $phoneNo,
            ':email' => $email,
            ':program' => $program,
            ':semester' => $semester,
            ':semesterType' => $semesterType
        ]);

        // Get the last inserted enrollment ID
        $enrollmentId = $pdo->lastInsertId();

        // Insert course details into course_details table
        for ($i = 1; $i <= 5; $i++) {
            $courseNo = $_POST["courseNo$i"];
            $courseTitle = $_POST["courseTitle$i"];
            $grade = $_POST["grade$i"];

            // Ensure that the course data is valid
            if ($courseNo && $courseTitle && $grade) {
                // Check if the grade is valid
                if (in_array($grade, ['F', 'D', 'D+', 'C'])) {
                    $stmt = $pdo->prepare("
                        INSERT INTO course_details (enrollment_id, course_no, course_title, grade)
                        VALUES (:enrollmentId, :courseNo, :courseTitle, :grade)
                    ");
                    $stmt->execute([
                        ':enrollmentId' => $enrollmentId,
                        ':courseNo' => $courseNo,
                        ':courseTitle' => $courseTitle,
                        ':grade' => $grade
                    ]);
                }
            }
        }

        // Commit transaction
        $pdo->commit();

        // Redirect to a success page or show a message after form submission
        echo "<script>alert('Form submitted successfully!'); window.location.href='enrollment.php';</script>";
    } catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='enrollment.php';</script>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form id="enrollmentForm" method="post">
        <h1>Enrollment Form</h1><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="fatherName">Father's Name:</label>
        <input type="text" id="fatherName" name="fatherName" required><br><br>

        <label for="registrationNo">Registration No:</label>
        <input type="text" id="registrationNo" name="registrationNo" required><br><br>

        <label for="phoneNo">Phone No:</label>
        <input type="number" id="phoneNo" name="phoneNo" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="program">Program:</label>
        <input type="text" id="program" name="program" required><br><br>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
            <option value="">Select Semester</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <br><br>

        <label for="semesterType">Semester Type:</label>
        <select id="semesterType" name="semesterType" required>
            <option value="">Select Semester Type</option>
            <option value="Running">Running</option>
            <option value="Summer">Summer</option>
        </select>
        <br><br>

        <p style="font-weight:bold; font-size: 20px;">Kindly Enroll me in the following Courses:</p>
        <table id="coursesTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Course No</th>
                    <th>Course Title</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <tr class="course-row">
                    <td>1</td>
                    <td><input type="text" name="courseNo1" required></td>
                    <td><input type="text" name="courseTitle1" required></td>
                    <td>
                        <select name="grade1" required>
                            <option value="">Select Grade</option>
                            <option value="F">F</option>
                            <option value="D">D</option>
                            <option value="D+">D+</option>
                            <option value="C">C</option>
                        </select>
                    </td>
                </tr>
                <tr class="course-row">
                    <td>2</td>
                    <td><input type="text" name="courseNo2"></td>
                    <td><input type="text" name="courseTitle2"></td>
                    <td>
                        <select name="grade2">
                            <option value="">Select Grade</option>
                            <option value="F">F</option>
                            <option value="D">D</option>
                            <option value="D+">D+</option>
                            <option value="C">C</option>
                        </select>
                    </td>
                </tr>
                <tr class="course-row">
                    <td>3</td>
                    <td><input type="text" name="courseNo3"></td>
                    <td><input type="text" name="courseTitle3"></td>
                    <td>
                        <select name="grade3">
                            <option value="">Select Grade</option>
                            <option value="F">F</option>
                            <option value="D">D</option>
                            <option value="D+">D+</option>
                            <option value="C">C</option>
                        </select>
                    </td>
                </tr>
                <tr class="course-row">
                    <td>4</td>
                    <td><input type="text" name="courseNo4"></td>
                    <td><input type="text" name="courseTitle4"></td>
                    <td>
                        <select name="grade4">
                            <option value="">Select Grade</option>
                            <option value="F">F</option>
                            <option value="D">D</option>
                            <option value="D+">D+</option>
                            <option value="C">C</option>
                        </select>
                    </td>
                </tr>
                <tr class="course-row">
                    <td>5</td>
                    <td><input type="text" name="courseNo5"></td>
                    <td><input type="text" name="courseTitle5"></td>
                    <td>
                        <select name="grade5">
                            <option value="">Select Grade</option>
                            <option value="F">F</option>
                            <option value="D">D</option>
                            <option value="D+">D+</option>
                            <option value="C">C</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </form>

    <script>
        // Handle semester type change
        document.getElementById("semesterType").addEventListener("change", function() {
            var semesterType = this.value;
            var courseRows = document.querySelectorAll('.course-row');

            if (semesterType === "Summer") {
                // Show only the first 2 rows for summer semester
                for (var i = 0; i < courseRows.length; i++) {
                    if (i < 2) {
                        courseRows[i].style.display = "table-row";
                    } else {
                        courseRows[i].style.display = "none";
                    }
                }
            } else {
                // Show all rows for running semester
                for (var i = 0; i < courseRows.length; i++) {
                    courseRows[i].style.display = "table-row";
                }
            }
        });
    </script>
</body>
</html>
