<?php
include 'db_connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['user_type'];

    if ($userType === 'admin' || $userType === 'monitor' || $userType === 'faculty') {
        // Common fields for Admin, Monitor, and Faculty
        $honorific = $_POST['honorific'];
        $name = $_POST['name'];
        $fatherName = $_POST['father_name'];
        $gender = $_POST['gender'];
        $cnic = $_POST['cnic'];
        $employeeNumber = $_POST['employee_number'];
        $designation = $_POST['designation'];
        $contactNumber = $_POST['contact_number'];
        $address = $_POST['address'];
        $qualification = $_POST['qualification'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Insert into the respective table
        $table = $userType === 'admin' ? 'admins' : ($userType === 'monitor' ? 'monitors' : 'faculty');
        $sql = "INSERT INTO $table (honorific, name, father_name, gender, cnic, employee_number, designation, contact_number, address, qualification, email, password)
                VALUES ('$honorific', '$name', '$fatherName', '$gender', '$cnic', '$employeeNumber', '$designation', '$contactNumber', '$address', '$qualification', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif ($userType === 'student') {
        // Fields for Student
        $studentName = $_POST['student_name'];
        $fatherName = $_POST['father_name'];
        $gender = $_POST['gender'];
        $cnic = $_POST['cnic'];
        $registrationNo = $_POST['registration_no'];
        $contactNo = $_POST['contact_no'];
        $address = $_POST['address'];
        $batch = $_POST['batch'];
        $studentEmail = $_POST['student_email'];
        $studentPassword = $_POST['student_password'];

        // Insert into the students table
        $sql = "INSERT INTO students (name, father_name, gender, cnic, registration_no, contact_no, address, batch, email, password)
                VALUES ('$studentName', '$fatherName', '$gender', '$cnic', '$registrationNo', '$contactNo', '$address', '$batch', '$studentEmail', '$studentPassword')";

        if (mysqli_query($conn, $sql)) {
            echo "New student record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    header("Location: test.php"); // Redirect to the dashboard
}
?>
