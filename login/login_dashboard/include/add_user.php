<?php
include 'db_connection.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = $_POST['user_type'];

    if ($user_type == 'student') {
        $name = $_POST['student_name'];
        $father_name = $_POST['father_name'];
        $gender = $_POST['gender'];
        $cnic = $_POST['cnic'];
        $program = $_POST['program'];
        $registration_no = $_POST['registration_no'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];
        $batch = $_POST['batch'];
        $email = $_POST['student_email'];
        $password_hash = password_hash($_POST['student_password'], PASSWORD_BCRYPT);

        $query = "INSERT INTO students (name, father_name, gender, cnic, program, registration_no, contact_no, address, batch, email, password_hash) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssssssssss", $name, $father_name, $gender, $cnic, $program, $registration_no, $contact_no, $address, $batch, $email, $password_hash);

    } else {
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $email = $_POST['email'];
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if ($user_type == 'admin') {
            $query = "INSERT INTO admins (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        } elseif ($user_type == 'monitor') {
            $query = "INSERT INTO monitors (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        } elseif ($user_type == 'faculty') {
            $query = "INSERT INTO faculties (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        }
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssss", $name, $designation, $email, $password_hash);
    }

    if ($stmt->execute()) {
        header("Location: users_dashboard.php?success=1");
    } else {
        header("Location: users_dashboard.php?error=1");
    }
}
?>
