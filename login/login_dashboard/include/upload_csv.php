<?php
include 'db_connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['csv_file'])) {
    $userType = $_POST['csv_user_type'];
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        fgetcsv($handle); // Skip the header row
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($userType === 'admin' || $userType === 'monitor' || $userType === 'faculty') {
                // Assuming the CSV columns match the database fields for Admin, Monitor, Faculty
                $sql = "INSERT INTO " . ($userType === 'admin' ? 'admins' : ($userType === 'monitor' ? 'monitors' : 'faculty')) . " (honorific, name, father_name, gender, cnic, employee_number, designation, contact_number, address, qualification, email, password)
                        VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]')";
            } elseif ($userType === 'student') {
                // Assuming the CSV columns match the database fields for Student
                $sql = "INSERT INTO students (name, father_name, gender, cnic, registration_no, contact_no, address, batch, email, password)
                        VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]')";
            }

            mysqli_query($conn, $sql);
        }
        fclose($handle);
        mysqli_close($conn);
        header("Location: test.php"); // Redirect to the dashboard
    } else {
        echo "Error opening the file.";
    }
}
?>
