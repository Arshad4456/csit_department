<?php
// Database connection
$mysqli = new mysqli("localhost", "username", "password", "csit_login_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];

    if ($user_type == 'student') {
        // Insert into 'students' table
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

        $sql = "INSERT INTO students (name, father_name, gender, cnic, program, registration_no, 
                contact_no, address, batch, email, password_hash) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssssssss", $name, $father_name, $gender, $cnic, $program, 
                          $registration_no, $contact_no, $address, $batch, $email, $password_hash);
    } else {
        // Insert into 'admins', 'monitors', or 'faculty' table
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $email = $_POST['email'];
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if ($user_type == 'admin') {
            $sql = "INSERT INTO admins (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        } elseif ($user_type == 'monitor') {
            $sql = "INSERT INTO monitors (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        } else {
            $sql = "INSERT INTO faculty (name, designation, email, password_hash) VALUES (?, ?, ?, ?)";
        }

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssss", $name, $designation, $email, $password_hash);
    }

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<script>alert('User added successfully!'); window.location.href='users_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding user: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$mysqli->close();
?>
