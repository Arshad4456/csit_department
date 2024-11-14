<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM enrollments WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Print Enrollment Record</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <h1>Enrollment Record</h1>
            <table>
                <tr><th>ID</th><td><?php echo htmlspecialchars($record['id']); ?></td></tr>
                <tr><th>Name</th><td><?php echo htmlspecialchars($record['name']); ?></td></tr>
                <tr><th>Father's Name</th><td><?php echo htmlspecialchars($record['father_name']); ?></td></tr>
                <tr><th>Registration No</th><td><?php echo htmlspecialchars($record['registration_no']); ?></td></tr>
                <tr><th>Phone No</th><td><?php echo htmlspecialchars($record['phone_no']); ?></td></tr>
                <tr><th>Email</th><td><?php echo htmlspecialchars($record['email']); ?></td></tr>
                <tr><th>Program</th><td><?php echo htmlspecialchars($record['program']); ?></td></tr>
                <tr><th>Semester</th><td><?php echo htmlspecialchars($record['semester']); ?></td></tr>
                <tr><th>Semester Type</th><td><?php echo htmlspecialchars($record['semester_type']); ?></td></tr>
                <tr><th>Course No</th><td><?php echo htmlspecialchars($record['course_no']); ?></td></tr>
                <tr><th>Course Title</th><td><?php echo htmlspecialchars($record['course_title']); ?></td></tr>
                <tr><th>Grade</th><td><?php echo htmlspecialchars($record['grade']); ?></td></tr>
                <tr><th>Status</th><td><?php echo htmlspecialchars($record['status'] ?? 'Pending'); ?></td></tr>
            </table>
            <script>
                window.print();
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "No record ID provided.";
}
?>
