<?php
include 'db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];

    // For students
    if ($user_type == 'student') {
        $name = $_POST['name'];
        $father_name = $_POST['father_name'];
        $cnic = $_POST['cnic'];
        $program = $_POST['program'];
        $registration_no = $_POST['registration_no'];
        $batch = $_POST['batch'];
        $email = $_POST['email'];

        $query = "UPDATE students SET name='$name', father_name='$father_name', cnic='$cnic', program='$program', registration_no='$registration_no', batch='$batch', email='$email'
                  WHERE id='$user_id'";
    }
    // For admins, monitors, faculties
    else {
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $email = $_POST['email'];

        if ($user_type == 'admin') {
            $query = "UPDATE admins SET name='$name', designation='$designation', email='$email' WHERE id='$user_id'";
        } elseif ($user_type == 'monitor') {
            $query = "UPDATE monitors SET name='$name', designation='$designation', email='$email' WHERE id='$user_id'";
        } elseif ($user_type == 'faculty') {
            $query = "UPDATE faculties SET name='$name', designation='$designation', email='$email' WHERE id='$user_id'";
        }
    }

    if ($mysqli->query($query)) {
        header("Location: users_dashboard.php?success=1");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>
